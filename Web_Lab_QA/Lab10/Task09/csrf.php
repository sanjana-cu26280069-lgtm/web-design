<?php
session_start();
if(empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32));
if($_SERVER['REQUEST_METHOD']==='POST'){
    $sent=$_POST['csrf'] ?? '';
    if(!is_string($sent) || !hash_equals($_SESSION['csrf'],$sent)){
        http_response_code(419); exit('CSRF validation failed.');
    }
    echo 'Form accepted.';
}
?>
<form method="post">
<input type="hidden" name="csrf" value="<?=htmlspecialchars($_SESSION['csrf'],ENT_QUOTES,'UTF-8')?>">
<input name="example" required><button>Submit</button></form>
