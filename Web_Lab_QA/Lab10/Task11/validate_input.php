<?php
$email=filter_var($_POST['email']??'',FILTER_VALIDATE_EMAIL);
$url=filter_var($_POST['url']??'',FILTER_VALIDATE_URL);
$age=filter_var($_POST['age']??null,FILTER_VALIDATE_INT,['options'=>['min_range'=>1,'max_range'=>120]]);
$name=trim($_POST['name']??'');
if($email===false) echo 'Invalid email. ';
if($url===false) echo 'Invalid URL. ';
if($age===false) echo 'Invalid integer. ';
if($name==='' || mb_strlen($name)>100) echo 'Invalid name.';
