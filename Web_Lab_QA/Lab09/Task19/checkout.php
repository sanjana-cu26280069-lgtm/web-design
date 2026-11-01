<?php
require_once __DIR__ . '/../shared/config/database.php';
session_start();
if(empty($_SESSION['user_id'])) { http_response_code(401); exit('Login required.'); }
$cart=$_SESSION['cart'] ?? [];
if(!$cart) exit('Cart is empty.');
try{
    $pdo->beginTransaction(); $total=0; $lines=[];
    $get=$pdo->prepare('SELECT id,price FROM products WHERE id=? FOR UPDATE');
    foreach($cart as $id=>$qty){
        $get->execute([(int)$id]); $p=$get->fetch();
        if(!$p || $qty<1 || $qty>99) throw new RuntimeException('Invalid cart item.');
        $total+=(float)$p['price']*$qty; $lines[]=['id'=>$p['id'],'qty'=>$qty,'price'=>$p['price']];
    }
    $s=$pdo->prepare('INSERT INTO orders(user_id,total) VALUES(?,?)');
    $s->execute([$_SESSION['user_id'],$total]); $orderId=(int)$pdo->lastInsertId();
    $item=$pdo->prepare('INSERT INTO order_items(order_id,product_id,quantity,unit_price) VALUES(?,?,?,?)');
    foreach($lines as $line) $item->execute([$orderId,$line['id'],$line['qty'],$line['price']]);
    $pdo->commit(); unset($_SESSION['cart']); echo 'Order placed. Order #'.$orderId;
}catch(Throwable $e){ if($pdo->inTransaction()) $pdo->rollBack(); error_log($e->getMessage()); http_response_code(400); echo 'Checkout failed; no order was saved.'; }
