<?php
require_once __DIR__ . '/../shared/config/database.php';
$perPage=5; $page=max(1, filter_input(INPUT_GET,'page',FILTER_VALIDATE_INT) ?: 1);
$total=(int)$pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
$pages=max(1,(int)ceil($total/$perPage)); $page=min($page,$pages); $offset=($page-1)*$perPage;
$stmt=$pdo->prepare('SELECT id,name,category,price FROM products ORDER BY id DESC LIMIT :lim OFFSET :off');
$stmt->bindValue(':lim',$perPage,PDO::PARAM_INT); $stmt->bindValue(':off',$offset,PDO::PARAM_INT); $stmt->execute();
$items=$stmt->fetchAll();
foreach($items as $p) echo htmlspecialchars($p['name'],ENT_QUOTES,'UTF-8').'<br>';
if($page>1) echo '<a href="?page='.($page-1).'">Previous</a> ';
for($i=1;$i<=$pages;$i++) echo '<a href="?page='.$i.'">'.$i.'</a> ';
if($page<$pages) echo '<a href="?page='.($page+1).'">Next</a>';
