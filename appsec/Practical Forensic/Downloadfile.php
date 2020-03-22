<?php

include("connection.php");

$fileid = $_GET['fileid'];

$sel = "select file from evidence where id='$fileid'";
$res=$con->query($sel);
$data = mysqli_fetch_assoc($res);
$file = $data['file'];
$file = "files/".$file;

$contenttype = "application/force-download";
header("Content-Type: " . $contenttype);
header("Content-Disposition: attachment; filename=\"" . basename($file) . "\";");
readfile($file);
exit();

?>