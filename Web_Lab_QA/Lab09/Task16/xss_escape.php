<?php
$comment=$_POST['comment'] ?? '';
function h($v){return htmlspecialchars((string)$v,ENT_QUOTES|ENT_SUBSTITUTE,'UTF-8');}
?>
<form method="post"><textarea name="comment"></textarea><button>Show safely</button></form>
<p>Comment: <?=h($comment)?></p>
