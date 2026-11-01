<?php
require_once __DIR__ . '/../shared/config/database.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { http_response_code(400); exit('Invalid product ID.'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? ''); $category = trim($_POST['category'] ?? '');
    $price = filter_var($_POST['price'] ?? null, FILTER_VALIDATE_FLOAT);
    if ($name === '' || $category === '' || $price === false || $price < 0) exit('Invalid input.');
    $s = $pdo->prepare('UPDATE products SET name=?, category=?, price=? WHERE id=?');
    $s->execute([$name,$category,$price,$id]); header('Location: products.php'); exit;
}
$s=$pdo->prepare('SELECT * FROM products WHERE id=?'); $s->execute([$id]); $p=$s->fetch();
if (!$p) { http_response_code(404); exit('Product not found.'); }
function h($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
?>
<form method="post"><input name="name" value="<?=h($p['name'])?>" required>
<input name="category" value="<?=h($p['category'])?>" required>
<input name="price" type="number" step=".01" min="0" value="<?=h($p['price'])?>" required>
<button>Update</button></form>
