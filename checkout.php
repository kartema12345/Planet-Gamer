<?php
require_once __DIR__ . '/../backend/db.php';
session_start();
$pdo = getPDO();
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
  header('Location: products.php'); exit;
}
$product_id = (int)($_POST['product_id'] ?? 0);
$stmt = $pdo->prepare('SELECT id, title, price FROM products WHERE id=?');
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$product){ header('Location: products.php'); exit; }
// create order (status pending)
$stmt = $pdo->prepare('INSERT INTO orders (product_id, amount, status, created_at) VALUES (?,?,?,NOW())');
$stmt->execute([$product['id'],$product['price'],'pending']);
$order_id = $pdo->lastInsertId();

// Prepare MercadoPago (placeholder) - replace with actual MercadoPago SDK or API call
$preference = [
  'order_id'=>$order_id,
  'external_reference'=>$order_id,
  'payment_method'=>'pix',
  'qr_code'=>'INSTRUCTED-QR-CODE-PLACEHOLDER',
  'qr_image_url'=>'/assets/img/qr-placeholder.png'
];

// For production call MP API, then redirect to payment page or show QR
header('Content-Type: application/json; charset=utf-8');
echo json_encode($preference, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
