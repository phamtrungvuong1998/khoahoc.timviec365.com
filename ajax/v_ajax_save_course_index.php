<?php
require_once '../config/config.php';
$course_id = getValue('course_id','int','GET','');

$user_id = getValue('user_id','int','GET','');

$qr = new db_query("SELECT save_id FROM save_course WHERE course_id = '$course_id' AND user_student_id = '$user_id'");

if (mysql_num_rows($qr->result) > 0) {
	$qrDel = new db_query("DELETE FROM save_course WHERE course_id = '$course_id' AND user_student_id = '$user_id'");
}else if(mysql_num_rows($qr->result) == 0){
	$data = [
		'course_id'=>$course_id,
		'user_student_id'=>$user_id,
		'course_type'=>$course_type
	];

	add('save_course', $data);
}

?>