<?php
// Save as live_search.php; endpoint returns JSON.
if($_SERVER['REQUEST_METHOD']==='GET' && isset($_GET['q'])){
    require_once __DIR__ . '/../shared/config/database.php';
    header('Content-Type: application/json; charset=utf-8');
    $s=$pdo->prepare('SELECT id,name FROM products WHERE name LIKE ? ORDER BY name LIMIT 10');
    $s->execute(['%'.trim($_GET['q']).'%']);
    echo json_encode($s->fetchAll(),JSON_THROW_ON_ERROR); exit;
}
?>
<input id="search" placeholder="Search products"><ul id="results"></ul>
<script>
const input=document.querySelector('#search'), list=document.querySelector('#results');
input.addEventListener('input', async () => {
  const response=await fetch('live_search.php?q='+encodeURIComponent(input.value));
  const items=await response.json(); list.replaceChildren();
  for(const item of items){ const li=document.createElement('li'); li.textContent=item.name; list.append(li); }
});
</script>
