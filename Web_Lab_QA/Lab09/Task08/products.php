<?php
require_once __DIR__ . '/../shared/config/database.php';
$rows = $pdo->query('SELECT id,name,category,price FROM products ORDER BY id DESC')->fetchAll();
function h($v){ return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
?>
<table border="1"><thead><tr><th>ID</th><th>Name</th><th>Category</th><th>Price</th></tr></thead><tbody>
<?php foreach ($rows as $p): ?><tr><td><?=h($p['id'])?></td><td><?=h($p['name'])?></td><td><?=h($p['category'])?></td><td><?=h($p['price'])?></td></tr><?php endforeach; ?>
</tbody></table>
