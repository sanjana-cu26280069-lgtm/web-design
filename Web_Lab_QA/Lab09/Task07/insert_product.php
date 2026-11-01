<?php
require_once __DIR__ . '/../shared/config/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $price = filter_var($_POST['price'] ?? null, FILTER_VALIDATE_FLOAT);
    if ($name === '' || $category === '' || $price === false || $price < 0) exit('Invalid product data.');
    $stmt = $pdo->prepare('INSERT INTO products (name,category,price) VALUES (:name,:category,:price)');
    $stmt->execute(compact('name','category','price'));
    echo 'Product saved. ID: ' . (int)$pdo->lastInsertId();
}
?>
<form method="post"><input name="name" required><input name="category" required>
<input name="price" type="number" min="0" step=".01" required><button>Save</button></form>
