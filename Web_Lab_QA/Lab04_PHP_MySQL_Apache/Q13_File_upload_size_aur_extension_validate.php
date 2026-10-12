<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['img'])) {
    $f = $_FILES['img'];
    $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if ($f['error'] !== UPLOAD_ERR_OK)          $msg = "Upload error.";
    elseif (!in_array($ext, $allowed))          $msg = "Only JPG, PNG, GIF allowed.";
    elseif ($f['size'] > 2 * 1024 * 1024)       $msg = "File too large (max 2 MB).";
    else {
        @mkdir("uploads", 0755);
        $new = uniqid("img_") . "." . $ext;
        move_uploaded_file($f['tmp_name'], "uploads/" . $new);
        $msg = "Uploaded as $new";
    }
}
echo $msg;
?>
<form method="post" enctype="multipart/form-data">
  <input type="file" name="img"><button>Upload</button>
</form>
