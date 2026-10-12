<?php include 'header.php';
$q = trim($_GET['q'] ?? ''); $cat = $_GET['cat'] ?? '';
$sql = "SELECT * FROM books WHERE 1=1"; $p = [];
if ($q !== '')   { $sql .= " AND (title LIKE ? OR author LIKE ?)"; $p[] = "%$q%"; $p[] = "%$q%"; }
if ($cat !== '') { $sql .= " AND category = ?"; $p[] = $cat; }
$st = $pdo->prepare($sql); $st->execute($p);
?>
<h2 class="ttl">Results</h2><div class="grid">
<?php foreach ($st as $b): ?>
  <div class="card"><h3><a href="book.php?id=<?= $b['id'] ?>"><?= e($b['title']) ?></a></h3><p><?= e($b['author']) ?></p><b>Rs. <?= $b['price'] ?></b></div>
<?php endforeach; ?></div>
<?php include 'footer.php'; ?>
