<?php
require_once __DIR__ . '/../shared/config/database.php';
// Generate token after verifying the account email via a generic response.
$email=filter_var($_POST['email']??'',FILTER_VALIDATE_EMAIL);
if($email){
    $token=bin2hex(random_bytes(32)); $hash=hash('sha256',$token);
    $s=$pdo->prepare('UPDATE users SET reset_token_hash=?,reset_expires_at=DATE_ADD(NOW(), INTERVAL 30 MINUTE) WHERE email=?');
    $s->execute([$hash,$email]);
    // Email $token in a reset URL using PHPMailer; do not display it to the user.
    echo 'If the account exists, a reset link will be sent.';
}
// On reset: hash provided token, query WHERE reset_token_hash=? AND reset_expires_at>NOW(),
// update password_hash=password_hash($newPassword, PASSWORD_DEFAULT), then clear reset fields.
