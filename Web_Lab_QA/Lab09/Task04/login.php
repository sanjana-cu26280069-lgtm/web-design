<?php
require_once __DIR__ . '/../shared/config/database.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('SELECT id,name,password_hash FROM users WHERE email = ?');
    $stmt->execute([trim($_POST['email'] ?? '')]);
    $user = $stmt->fetch();
    if ($user && password_verify($_POST['password'] ?? '', $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: dashboard.php'); exit;
    }
    $error = 'Invalid email or password.';
}
?>
<form method="post"><input type="email" name="email" required>
<input type="password" name="password" required><button>Login</button></form>
<?php if (!empty($error)) echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
