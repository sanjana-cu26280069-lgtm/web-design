<?php
require_once __DIR__ . '/../shared/config/database.php';
session_start();
if($_SERVER['REQUEST_METHOD']==='POST' && !empty($_POST['remember']) && !empty($_SESSION['user_id'])){
    $token=bin2hex(random_bytes(32)); $hash=hash('sha256',$token);
    $s=$pdo->prepare('UPDATE users SET remember_token_hash=? WHERE id=?');
    $s->execute([$hash,$_SESSION['user_id']]);
    setcookie('remember_token',$token,['expires'=>time()+60*60*24*30,'path'=>'/','secure'=>!empty($_SERVER['HTTPS']),'httponly'=>true,'samesite'=>'Lax']);
    echo 'Remember-me cookie set. Store only its hash in the database.';
}
?>
<form method="post"><label><input type="checkbox" name="remember" value="1"> Remember me</label><button>Save preference</button></form>
