<?php
require_once '../config/config.php';
$lesson_id = getValue('lesson_id','int','GET','');

$qrDel = new db_query("DELETE FROM course_lesson WHERE lesson_id = $lesson_id OR lesson_parent = $lesson_id");

$qr = new db_query("SELECT video, document FROM course_lesson WHERE lesson_parent = $lesson_id");

$target_dir_video = "../document/video/";
$target_dir_document = "../document/tailieu/";

while ($row = mysql_fetch_array($qr->result)) {
    unlink($target_dir_video.$row['video']);
    unlink($target_dir_document.$row['document']);
}

$data = [
	'type'=>0
];

echo json_encode($data);
?>