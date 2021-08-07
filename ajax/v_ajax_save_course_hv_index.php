<?php
require_once '../config/config.php';
$user_id = $_COOKIE['user_id'];
$course_id = getValue('course_id','int','GET','');

$qr = new db_query("SELECT save_id FROM save_course WHERE user_student_id = $user_id AND course_id = $course_id");

if (mysql_num_rows($qr->result) == 0) {
	$qrType = new db_query("SELECT course_type FROM courses WHERE course_id = $course_id");
	$row = mysql_fetch_array($qrType->result);
	$data = [
		'user_student_id'=>$user_id,
		'course_id'=>$course_id,
		'course_type'=>$row['course_type']
	];

	add('save_course', $data);
}else{
	$qrDel = new db_query("DELETE FROM save_course WHERE user_student_id = $user_id AND course_id = $course_id");
}
?>