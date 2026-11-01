<?php
$destination=__DIR__.'/../shared/public/uploads/';
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_FILES['photo'])){
    $f=$_FILES['photo'];
    if($f['error']!==UPLOAD_ERR_OK) exit('Upload failed.');
    if($f['size']>2*1024*1024) exit('Maximum size is 2 MB.');
    $mime=(new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
    $types=['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'];
    if(!isset($types[$mime]) || getimagesize($f['tmp_name'])===false) exit('Only JPG, PNG, WEBP images allowed.');
    if(!is_dir($destination)) mkdir($destination,0755,true);
    $name=bin2hex(random_bytes(16)).'.'.$types[$mime];
    if(!move_uploaded_file($f['tmp_name'],$destination.$name)) exit('Could not save file.');
    echo 'Uploaded: '.htmlspecialchars($name,ENT_QUOTES,'UTF-8');
}
?>
<form method="post" enctype="multipart/form-data"><input type="file" name="photo" accept="image/jpeg,image/png,image/webp" required><button>Upload</button></form>
