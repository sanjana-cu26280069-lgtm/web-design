<?php
// Install: composer require phpmailer/phpmailer
require __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail=new PHPMailer(true);
try{
    $mail->isSMTP();
    $mail->Host=getenv('SMTP_HOST');
    $mail->SMTPAuth=true;
    $mail->Username=getenv('SMTP_USER');
    $mail->Password=getenv('SMTP_PASS');
    $mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port=587;
    $mail->setFrom(getenv('SMTP_FROM'),'Web App');
    $mail->addAddress('recipient@example.com');
    $mail->Subject='Account notification';
    $mail->Body='Your account action was received.';
    $mail->send();
}catch(Exception $e){error_log('Mailer error: '.$mail->ErrorInfo); echo 'Email could not be sent.';}
