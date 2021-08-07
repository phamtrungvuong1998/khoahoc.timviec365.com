<?php
require_once '../config/config.php';
$course_id = getValue('course_id','int','GET','');
$user_student_id = $_COOKIE['user_id'];

$qr = new db_query("SELECT save_id FROM save_course WHERE course_id = $course_id AND user_student_id = $user_student_id");
if (mysql_num_rows($qr->result) == 0) {
	$qrC = new db_query("SELECT course_type FROM courses WHERE course_id = $course_id");
	$rowC = mysql_fetch_array($qrC->result);
	$data1 = [
		'course_id'=>$course_id,
		'user_student_id'=>$user_student_id,
		'course_type'=>$rowC['course_type']
	];

	$data = [
		'type'=>1
	];
	add('save_course', $data1);
}else{
	$qrDel = new db_query("DELETE FROM save_course WHERE course_id = $course_id AND user_student_id = $user_student_id");
	$data = [
		'type'=>0
	];
}

echo json_encode($data);
?>