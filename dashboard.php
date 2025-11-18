<?php
require_once __DIR__ . '/../backend/db.php';
session_start();
if(empty($_SESSION['user_id'])){ header('Location: login.php'); exit; }
$pdo = getPDO();
$stmt = $pdo->prepare('SELECT email FROM users WHERE id=?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><title>Painel</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body><?php include 'header_stub.php'; ?>
<main class="wrap">
  <h2>Painel do usuário</h2>
  <p>Bem vindo, <?=htmlspecialchars($user['email'])?></p>
  <p><a href="orders.php">Meus pedidos</a></p>
</main></body></html>
