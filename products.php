<?php
require_once __DIR__ . '/../backend/db.php';
$pdo = getPDO();
$stmt = $pdo->query('SELECT id, title, price, short_desc FROM products');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="pt-BR">
<head><meta charset="utf-8"><title>Produtos - Planet Gamer</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<?php include 'header_stub.php'; ?>
<main class="wrap section">
  <h2>Produtos</h2>
  <div class="card-grid">
    <?php foreach($rows as $row): ?>
      <div class="card">
        <img src="assets/img/product-<?= $row['id'] ?>.png" alt="">
        <h3><?= htmlspecialchars($row['title']) ?></h3>
        <p><?= htmlspecialchars($row['short_desc']) ?></p>
        <div class="meta"><strong>R$ <?= number_format($row['price'],2,',','.') ?></strong>
        <a class="btn" href="product.php?id=<?= $row['id'] ?>">Comprar</a></div>
      </div>
    <?php endforeach; ?>
  </div>
</main>
</body>
</html>
