// Galat: injection ho sakta hai
$pdo->query("SELECT * FROM books WHERE id = " . $_GET['id']);
// Sahi
$st = $pdo->prepare("SELECT * FROM books WHERE id = ?"); $st->execute([(int)$_GET['id']]);
