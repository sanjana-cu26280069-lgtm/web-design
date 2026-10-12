<?php
require 'db.php';
$hash = password_hash("MySecret123", PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->execute(['amit', $hash]);
echo "User saved. Hash: " . $hash;

<?php
require 'db.php';
$stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
$stmt->execute(['amit']);
$hash = $stmt->fetchColumn();
echo password_verify("MySecret123", $hash) ? "Password correct" : "Wrong password";
