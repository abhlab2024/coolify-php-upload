<?php
$uploadDir = getenv('UPLOAD_PATH') ?: '/var/www/html/uploads/';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $filename = uniqid() . '_' . basename($_FILES['file']['name']);
    $destination = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
        echo 'File uploaded successfully: ' . htmlspecialchars($filename);
    } else {
        echo 'Upload failed.';
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Simple PHP Upload</title></head>
<body>
<h2>Upload a file</h2>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <button type="submit">Upload</button>
</form>
</body>
</html>
