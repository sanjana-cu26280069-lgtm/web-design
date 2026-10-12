<?php
require 'db.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { die("Invalid ID"); }
$stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
$stmt->execute([$id]);
echo $stmt->rowCount() ? "Deleted." : "No such record.";
