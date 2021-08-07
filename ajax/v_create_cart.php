<?php
require_once '../config/config.php';
$course_id = getValue('course_id','int','GET','');
$qrCart = new db_query("SELECT cart_id FROM carts WHERE course_id = $course_id AND user_student_id = " . $_COOKIE['user_id']);
if (mysql_num_rows($qrCart->result) == 0) {
	$data = [
		'user_student_id'=>$_COOKIE['user_id'],
		'course_id'=>$course_id,
		'day_buy'=>strtotime(date("d-m-Y"))
	];

	add('carts',$data);
	$data1 = [
		'type'=>true
	];
}else{
	$data1 = [
		'type'=>false
	];
}

echo json_encode($data1);
?>