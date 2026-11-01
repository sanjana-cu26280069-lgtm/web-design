<?php
$storage=dirname(__DIR__,2).'/storage/uploads/'; // Configure to a directory not served by Apache.
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_FILES['file'])){
    $f=$_FILES['file'];
    if($f['error']!==UPLOAD_ERR_OK || $f['size']>3*1024*1024) exit('Invalid upload or file too large.');
    $mime=(new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
    $allowed=['application/pdf'=>'pdf','image/jpeg'=>'jpg','image/png'=>'png'];
    if(!isset($allowed[$mime])) exit('File type not allowed.');
    if(!is_dir($storage)) mkdir($storage,0700,true);
    $name=bin2hex(random_bytes(20)).'.'.$allowed[$mime];
    if(!move_uploaded_file($f['tmp_name'],$storage.$name)) exit('Save failed.');
    echo 'Stored securely.';
}
?>
<form method="post" enctype="multipart/form-data"><input type="file" name="file" required><button>Upload</button></form>
