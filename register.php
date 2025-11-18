<?php
require_once __DIR__ . '/../backend/db.php';
session_start();
$pdo = getPDO();
$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $hash = password_hash($pass, PASSWORD_DEFAULT);
  $stmt = $pdo->prepare('INSERT INTO users (email,password_hash,created_at) VALUES (?,?,NOW())');
  try{
    $stmt->execute([$email,$hash]);
    $_SESSION['user_id']=$pdo->lastInsertId();
    header('Location: dashboard.php'); exit;
  }catch(Exception $e){
    $err='Erro ao registrar (email pode já existir).';
  }
}
?>
<!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><title>Registrar</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<?php include 'header_stub.php'; ?>
<main class="wrap">
  <h2>Registrar</h2>
  <?php if($err) echo '<p style="color:#f55">'.$err.'</p>'; ?>
  <form method="post">
    <label>Email <input name="email" type="email" required></label><br>
    <label>Senha <input name="password" type="password" required></label><br>
    <button class="btn" type="submit">Criar conta</button>
  </form>
</main></body></html>
