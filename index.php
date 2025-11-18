<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Planet Gamer</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
  <div class="wrap header-row">
    <div class="brand">
      <img src="assets/img/logo.png" class="brand-logo" alt="Planet Gamer">
      <span class="brand-text">Planet <strong>Gamer</strong></span>
    </div>
    <nav class="nav">
      <a href="index.php">Início</a>
      <a href="products.php">Produtos</a>
      <a href="services.php">Serviços</a>
      <a href="contact.php">Contato</a>
      <a href="login.php">Entrar</a>
    </nav>
  </div>
</header>

<main class="wrap hero">
  <h1>Compre contas de RuneScape com segurança</h1>
  <p class="lead">Vendedores verificados, entrega rápida e suporte via WhatsApp.</p>

  <section class="card-grid">
    <?php
    require_once __DIR__ . '/../backend/db.php';
    $pdo = getPDO();
    $stmt = $pdo->query('SELECT id, title, price, short_desc FROM products LIMIT 6');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      echo '<article class="card">';
      echo '<img src="assets/img/product-'.$row['id'].'.png" alt="">';
      echo '<h3>'.htmlspecialchars($row['title']).'</h3>';
      echo '<p>'.htmlspecialchars($row['short_desc']).'</p>';
      echo '<div class="meta"><strong>R$ '.number_format($row['price'],2,',','.').'</strong>';
      echo ' <a class="btn" href="product.php?id='.$row['id'].'">Comprar</a></div>';
      echo '</article>';
    }
    ?>
  </section>

</main>

<footer class="wrap">
  <p>© <?=date('Y')?> Planet Gamer – Todos os direitos reservados</p>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
