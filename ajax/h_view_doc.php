<?php
require_once '../config/config.php';
if(isset($_GET['lesson_id'])){
    $lesson_id = $_GET['lesson_id'];
    $qr = new db_query("SELECT document FROM course_lesson WHERE lesson_id = $lesson_id");
    $rowl = mysql_fetch_array($qr->result);
    $document = $rowl['document'];
    $file = "/document/tailieu/$document";
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}

?>