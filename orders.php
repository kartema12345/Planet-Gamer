<?php
require_once __DIR__ . '/../backend/db.php';
session_start();
if(empty($_SESSION['user_id'])){ header('Location: login.php'); exit; }
$pdo = getPDO();
$stmt = $pdo->prepare('SELECT o.*, p.title FROM orders o LEFT JOIN products p ON p.id=o.product_id WHERE o.user_id=?');
$stmt->execute([$_SESSION['user_id']]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?><!doctype html><html><head><meta charset="utf-8"><title>Pedidos</title><link rel="stylesheet" href="assets/css/style.css"></head><body><?php include 'header_stub.php'; ?><main class="wrap"><h2>Meus pedidos</h2><?php foreach($orders as $o){echo '<div class="card"><h3>'.htmlspecialchars($o['title']).'</h3><p>Status: '.htmlspecialchars($o['status']).'</p></div>';} ?></main></body></html>