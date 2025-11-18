<?php
function getPDO(){
    static $pdo = null;
    if($pdo) return $pdo;
    $host = 'localhost'; // CHANGE: set to your Hostinger MySQL host
    $db   = 'planetgamer_db';
    $user = 'db_user';
    $pass = 'db_pass';
    $dsn = "mysql:host={$host};dbname={$db};charset=utf8mb4";
    try{
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
        ]);
        return $pdo;
    }catch(PDOException $e){
        echo 'Database connection failed: '.$e->getMessage();
        exit;
    }
}
