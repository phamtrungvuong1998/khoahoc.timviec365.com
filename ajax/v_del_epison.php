<?php
require_once '../config/config.php';
$lesson_id = getValue('lesson_id','int','GET','');
$qr = new db_query("SELECT video, document FROM course_lesson WHERE lesson_id = $lesson_id");
$data = [
	'type'=>0
];
$row = mysql_fetch_array($qr->result);

$target_dir_video = "../document/video/";
$target_dir_document = "../document/tailieu/";
unlink("../document/video/".$row['video']);
unlink($target_dir_document.$row['document']);

$qrDel = new db_query("DELETE FROM course_lesson WHERE lesson_id = $lesson_id");
echo json_encode($data);
?>