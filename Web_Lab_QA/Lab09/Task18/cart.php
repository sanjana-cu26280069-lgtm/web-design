<?php
session_start(); $_SESSION['cart'] ??= [];
if($_SERVER['REQUEST_METHOD']==='POST'){
    $id=filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
    $qty=filter_input(INPUT_POST,'qty',FILTER_VALIDATE_INT);
    $action=$_POST['action'] ?? 'add';
    if($id && $qty!==false && $qty!==null){
        if($action==='remove') unset($_SESSION['cart'][$id]);
        elseif($qty>0 && $qty<=99) $_SESSION['cart'][$id]=$qty;
    }
}
?>
<form method="post"><input name="id" type="number" min="1" placeholder="Product ID" required>
<input name="qty" type="number" min="1" max="99" value="1"><button name="action" value="add">Add / update</button>
<button name="action" value="remove">Remove</button></form>
<pre><?php echo htmlspecialchars(print_r($_SESSION['cart'],true),ENT_QUOTES,'UTF-8'); ?></pre>
