<?php
require 'db.php';
$stmt = $pdo->prepare("UPDATE students SET email = :email WHERE id = :id");
$stmt->execute([':email' => 'newmail@example.com', ':id' => 1]);
echo $stmt->rowCount() . " row(s) updated.";
