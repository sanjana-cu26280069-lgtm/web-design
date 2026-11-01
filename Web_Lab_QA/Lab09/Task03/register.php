<?php
require_once __DIR__ . '/../shared/config/database.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    if ($name === '' || mb_strlen($name) > 100) $errors[] = 'Enter a name (max 100 characters).';
    if (!$email) $errors[] = 'Enter a valid email.';
    if (strlen($password) < 10) $errors[] = 'Password must be at least 10 characters.';
    if (!$errors) {
        $stmt = $pdo->prepare('INSERT INTO users (name,email,password_hash) VALUES (:name,:email,:hash)');
        try {
            $stmt->execute(['name'=>$name, 'email'=>$email, 'hash'=>password_hash($password, PASSWORD_DEFAULT)]);
            echo 'Registration successful.';
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') $errors[] = 'Email already registered.';
            else { error_log($e->getMessage()); http_response_code(500); $errors[] = 'Could not register.'; }
        }
    }
}
?>
<form method="post">
<label>Name <input name="name" required maxlength="100"></label>
<label>Email <input name="email" type="email" required></label>
<label>Password <input name="password" type="password" minlength="10" required></label>
<button>Register</button></form>
<?php foreach ($errors as $error) echo '<p>'.htmlspecialchars($error, ENT_QUOTES, 'UTF-8').'</p>'; ?>
