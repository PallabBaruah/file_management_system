<?php
$file_path = $_GET['nama'];  
if (file_exists($file_path)) {
  $file_name = basename($file_path);
  $file_size = filesize($file_path);
  header('Content-type: application/octet-stream');
  header('Content-Transfer-Encoding: binary');
  header('Content-Length: '.$file_size);
  header('Content-Disposition: attachment; filename='.$file_name);
  readfile($file_path);
  exit();
}
else {
  die('File Doesnot Exist');
} 
?>