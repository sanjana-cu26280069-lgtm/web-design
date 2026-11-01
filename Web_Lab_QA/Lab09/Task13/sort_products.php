<?php
require_once __DIR__ . '/../shared/config/database.php';
$allowed=['name'=>'name','category'=>'category','price'=>'price','created'=>'created_at'];
$sort=$_GET['sort'] ?? 'name'; $direction=strtoupper($_GET['dir'] ?? 'ASC');
if(!isset($allowed[$sort])) $sort='name';
if(!in_array($direction,['ASC','DESC'],true)) $direction='ASC';
$sql='SELECT id,name,category,price FROM products ORDER BY '.$allowed[$sort].' '.$direction;
$rows=$pdo->query($sql)->fetchAll();
foreach($rows as $p) echo htmlspecialchars($p['name'],ENT_QUOTES,'UTF-8').'<br>';
?>
<a href="?sort=name&dir=ASC">Name ↑</a> | <a href="?sort=price&dir=DESC">Price ↓</a>
