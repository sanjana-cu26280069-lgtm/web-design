<?php
require_once __DIR__ . '/../shared/config/database.php';
$email=filter_var($_POST['email']??'',FILTER_VALIDATE_EMAIL);
$password=$_POST['password']??'';
if(!$email) exit('Invalid credentials.');
$s=$pdo->prepare('SELECT id,password_hash,failed_attempts,locked_until FROM users WHERE email=?');
$s->execute([$email]); $u=$s->fetch();
if(!$u) exit('Invalid credentials.');
if($u['locked_until'] && strtotime($u['locked_until'])>time()) exit('Account temporarily locked.');
if(password_verify($password,$u['password_hash'])){
    $pdo->prepare('UPDATE users SET failed_attempts=0,locked_until=NULL WHERE id=?')->execute([$u['id']]);
    echo 'Login accepted.';
}else{
    $attempts=(int)$u['failed_attempts']+1;
    $locked=$attempts>=5 ? date('Y-m-d H:i:s',time()+15*60) : null;
    $pdo->prepare('UPDATE users SET failed_attempts=?,locked_until=? WHERE id=?')->execute([$attempts,$locked,$u['id']]);
    exit('Invalid credentials.');
}
