<?php
require_once __DIR__ . '/../shared/config/database.php';
$email=$_GET['email'] ?? '';
// VULNERABLE: never use this pattern with user input.
$vulnerableSql="SELECT id,email FROM users WHERE email = '$email'";
// SAFE: use a parameterized query.
$safe=$pdo->prepare('SELECT id,email FROM users WHERE email = ?');
$safe->execute([$email]);
$user=$safe->fetch();
echo 'Unsafe SQL example (do not execute): '.htmlspecialchars($vulnerableSql,ENT_QUOTES,'UTF-8').'<br>';
echo $user ? 'Safe query found a user.' : 'Safe query returned no user.';
