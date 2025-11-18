<?php
require_once __DIR__ . '/../backend/db.php';
session_start();
$pdo = getPDO();
$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $stmt = $pdo->prepare('SELECT id, password_hash FROM users WHERE email=? LIMIT 1');
  $stmt->execute([$email]);
  $u = $stmt->fetch(PDO::FETCH_ASSOC);
  if($u && password_verify($pass, $u['password_hash'])){
    $_SESSION['user_id']=$u['id'];
    header('Location: dashboard.php'); exit;
  } else {
    $err='Credenciais inválidas';
  }
}
?>
<!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><title>Entrar</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<?php include 'header_stub.php'; ?>
<main class="wrap">
  <h2>Entrar</h2>
  <?php if($err) echo '<p style="color:#f55">'.$err.'</p>'; ?>
  <form method="post">
    <label>Email <input name="email" type="email" required></label><br>
    <label>Senha <input name="password" type="password" required></label><br>
    <button class="btn" type="submit">Entrar</button>
  </form>
  <p>Não tem conta? <a href="register.php">Registrar</a></p>
</main></body></html>
