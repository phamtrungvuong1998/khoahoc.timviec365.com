<?php
require_once '../config/config.php';

$studentId = getValue('studentId','str','GET','');
$status_save = getValue('status_save','int','GET','');
$teacherId = $_COOKIE['user_id']; 

if ($status_save == 0) {
	$save = 'save';
	$data = [
		'user_teacher_id'=>$_COOKIE['user_id'],
		'user_student_id'=>$studentId,
		'save'=>'save'
	];

	add('save_student', $data);

}else if ($status_save == 1) {
	$qrDelete = new db_query("DELETE FROM `save_student` WHERE `user_student_id` = '$studentId' AND `user_teacher_id` = '$teacherId'");
}

?>