<?php
require_once __DIR__ . '/../shared/config/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('POST required.'); }
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) { http_response_code(400); exit('Invalid ID.'); }
// Add session authentication and CSRF verification before production use.
$stmt = $pdo->prepare('DELETE FROM products WHERE id = ?'); $stmt->execute([$id]);
header('Location: products.php'); exit;
