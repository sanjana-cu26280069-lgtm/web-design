<?php
require_once __DIR__ . '/../shared/config/database.php';
$q=trim($_GET['q'] ?? ''); $category=trim($_GET['category'] ?? '');
$min=filter_var($_GET['min'] ?? '0',FILTER_VALIDATE_FLOAT); $max=filter_var($_GET['max'] ?? '99999999',FILTER_VALIDATE_FLOAT);
if($min===false || $max===false || $min>$max) exit('Invalid price range.');
$sql='SELECT id,name,category,price FROM products WHERE name LIKE :q AND category LIKE :cat AND price BETWEEN :min AND :max';
$s=$pdo->prepare($sql); $s->execute(['q'=>"%$q%",'cat'=>"%$category%",'min'=>$min,'max'=>$max]);
foreach($s as $p) echo htmlspecialchars($p['name'].' - '.$p['price'],ENT_QUOTES,'UTF-8').'<br>';
?>
<form><input name="q" placeholder="Name"><input name="category" placeholder="Category">
<input name="min" type="number" step=".01" placeholder="Min price"><input name="max" type="number" step=".01" placeholder="Max price"><button>Filter</button></form>
