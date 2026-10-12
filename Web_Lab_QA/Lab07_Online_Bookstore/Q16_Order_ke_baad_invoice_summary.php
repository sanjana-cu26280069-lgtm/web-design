<?php include 'header.php'; require_login();
$id = (int)$_GET['id'];
$o = $pdo->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?"); $o->execute([$id, $_SESSION['uid']]); $order = $o->fetch();
if (!$order) die("Order not found");
$it = $pdo->prepare("SELECT oi.*, b.title FROM order_items oi JOIN books b ON b.id = oi.book_id WHERE order_id = ?"); $it->execute([$id]);
?>
<div style="padding:24px"><h2>Invoice #<?= $order['id'] ?></h2>
<p>Date: <?= $order['created_at'] ?><br>Ship to: <?= e($order['address']) ?><br>Status: <?= $order['status'] ?></p>
<table border="1" cellpadding="6"><tr><th>Book</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr>
<?php foreach ($it as $i): ?>
<tr><td><?= e($i['title']) ?></td><td><?= $i['qty'] ?></td><td><?= $i['price'] ?></td><td><?= $i['qty'] * $i['price'] ?></td></tr>
<?php endforeach; ?>
<tr><td colspan="3"><b>Grand Total</b></td><td><b>Rs. <?= $order['total'] ?></b></td></tr></table>
<p><button onclick="window.print()">Print Invoice</button></p></div>
<?php include 'footer.php'; ?>
