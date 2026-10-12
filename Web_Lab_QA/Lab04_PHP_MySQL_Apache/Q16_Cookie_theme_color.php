<?php
if (isset($_POST['theme'])) {
    setcookie('theme', $_POST['theme'], time() + 86400 * 30, "/");
    $_COOKIE['theme'] = $_POST['theme'];
}
$theme = $_COOKIE['theme'] ?? 'white';
?>
<body style="background:<?= htmlspecialchars($theme) ?>">
<form method="post">
  <select name="theme"><option>white</option><option>lightblue</option><option>lightgreen</option></select>
  <button>Save theme</button>
</form>
<p>Current theme: <?= htmlspecialchars($theme) ?></p>
</body>
