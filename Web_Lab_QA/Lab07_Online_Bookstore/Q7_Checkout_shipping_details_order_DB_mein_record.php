<?php include 'header.php'; require_login();
$cart = $_SESSION['cart'] ?? [];
if (!$cart) die("Cart is empty");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $addr = trim($_POST['name']) . ", " . trim($_POST['address']) . ", " . trim($_POST['city']) . " - " . trim($_POST['pin']);
    try {
        $pdo->beginTransaction();
        $total = 0; $items = [];
        foreach ($cart as $id => $qty) {
            $s = $pdo->prepare("SELECT price, stock FROM books WHERE id = ? FOR UPDATE"); $s->execute([$id]); $b = $s->fetch();
            if ($b['stock'] < $qty) throw new Exception("Not enough stock for book #$id");
            $total += $b['price'] * $qty; $items[] = [$id, $qty, $b['price']];
        }
        $pdo->prepare("INSERT INTO orders (user_id, total, address) VALUES (?, ?, ?)")->execute([$_SESSION['uid'], $total, $addr]);
        $oid = $pdo->lastInsertId();
        foreach ($items as [$id, $qty, $price]) {
            $pdo->prepare("INSERT INTO order_items (order_id, book_id, qty, price) VALUES (?, ?, ?, ?)")->execute([$oid, $id, $qty, $price]);
            $pdo->prepare("UPDATE books SET stock = stock - ? WHERE id = ?")->execute([$qty, $id]);
        }
        $pdo->commit();
        unset($_SESSION['cart']);
        header("Location: invoice.php?id=$oid"); exit;
    } catch (Exception $ex) { $pdo->rollBack(); echo "<p style='color:red'>" . e($ex->getMessage()) . "</p>"; }
}
?>
<form method="post" id="checkoutForm" style="padding:24px"><h2>Shipping Details</h2>
  <input name="name" placeholder="Full name"><br><input name="address" placeholder="Address"><br>
  <input name="city" placeholder="City"><br><input name="pin" placeholder="PIN code"><br>
  <button>Place Order</button></form>
<script src="validate.js"></script>
<?php include 'footer.php'; ?>
