<?php
require_once '../config/config.php';
$center_id = getValue('center_id','int','GET','');
$user_student_id = getValue('user_student_id','int','GET','');
$type_save = getValue('type_save','int','GET','');
$user_type = 3;
if ($type_save == 0) {
	if ($user_type == 3) {
		$data = [
			'center_id'=>$center_id,
			'user_student_id'=>$user_student_id,
		];

		add('save_center', $data);
	}else if ($user_type == 2){
		$data = [
			'teacher_id'=>$center_id,
			'user_student_id'=>$user_student_id,
		];

		add('save_teacher', $data);
	}
	echo 'HỦY THEO DÕI';
}else if ($type_save == 1) {
	if ($user_type == 3) {
		$qr = new db_query("DELETE FROM save_center WHERE user_student_id = '$user_student_id' AND center_id = '$center_id'");
	}else{
		$qr = new db_query("DELETE FROM save_teacher WHERE user_student_id = '$user_student_id' AND teacher_id = '$center_id'");
	}
	echo 'THEO DÕI';
}
?>