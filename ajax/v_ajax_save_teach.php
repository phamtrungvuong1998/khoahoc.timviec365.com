<?php
require_once '../config/config.php';

$user_student_id = getValue('user_student_id','int','GET','');
$teacher_id = getValue('teacher_id','int','GET','');
$type = getValue('type','int','GET','');

if ($type == 2) {
	$qrDel = new db_query("DELETE FROM save_teacher WHERE user_student_id = $user_student_id AND teacher_id = $teacher_id");
}else if ($type == 1) {
	$data1 = [
		'user_student_id'=>$user_student_id,
		'teacher_id'=>$teacher_id
	];

	add('save_teacher',$data1);
}

$data = [
	'result'=>true
];

echo json_encode($data);
?>