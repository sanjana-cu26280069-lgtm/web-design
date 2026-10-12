<?php
require 'db.php';
$stmt = $pdo->prepare("INSERT INTO students (name, email, enrollment_date) VALUES (:name, :email, :date)");
$stmt->execute([':name' => 'Amit Kumar', ':email' => 'amit@example.com', ':date' => date('Y-m-d')]);
echo "Inserted ID: " . $pdo->lastInsertId();
