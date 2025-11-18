<?php
require_once __DIR__ . '/../backend/db.php';
$pdo = getPDO();
$id = isset($_GET['id'])? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare('SELECT * FROM products WHERE id=? LIMIT 1');
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$product) { header('Location: products.php'); exit; }
?>
<!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><title><?=htmlspecialchars($product['title'])?></title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<?php include 'header_stub.php'; ?>
<main class="wrap">
  <h1><?=htmlspecialchars($product['title'])?></h1>
  <p><?=htmlspecialchars($product['long_desc'])?></p>
  <p><strong>R$ <?=number_format($product['price'],2,',','.')?></strong></p>
  <form method="post" action="checkout.php">
    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
    <button class="btn" type="submit">Comprar com Pix</button>
  </form>
</main>
</body></html>
