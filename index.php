<?php
// Simple PHP file upload demo
// NOTE: This is intentionally minimal. For production, validate file types, sizes, and handle name collisions.
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>File Upload Demo</title>
  <style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;padding:24px;max-width:720px;margin:auto;}
    form{margin:16px 0;padding:16px;border:1px solid #ddd;border-radius:12px}
    .files{margin-top:24px}
    code{background:#f6f8fa;padding:2px 6px;border-radius:6px}
    a{word-break:break-all}
  </style>
</head>
<body>
  <h2>Upload a File</h2>
  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="uploadfile" required />
    <button type="submit">Upload</button>
  </form>

  <?php
  $uploadDir = __DIR__ . "/uploads/";
  if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['uploadfile'])) {
      $name = basename($_FILES['uploadfile']['name']);
      $target = $uploadDir . $name;
      if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $target)) {
          echo "<p>✅ File uploaded: <a href='uploads/" . htmlspecialchars($name, ENT_QUOTES) . "' target='_blank'>" . htmlspecialchars($name, ENT_QUOTES) . "</a></p>";
      } else {
          echo "<p>❌ File upload failed.</p>";
      }
  }

  // List uploaded files
  $items = array_values(array_filter(scandir($uploadDir), function($f) {
      return $f !== '.' && $f !== '..';
  }));
  if (count($items)) {
      echo "<div class='files'><h3>Uploaded Files</h3><ul>";
      foreach ($items as $f) {
          $href = "uploads/" . rawurlencode($f);
          echo "<li><a href='$href' target='_blank'>" . htmlspecialchars($f, ENT_QUOTES) . "</a></li>";
      }
      echo "</ul></div>";
  }
  ?>
  <hr />
  <p>Running in Docker. Host access: <code>http://localhost:8080</code></p>
</body>
</html>
