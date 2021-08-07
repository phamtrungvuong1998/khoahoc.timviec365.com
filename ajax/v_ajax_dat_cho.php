<?php
require_once '../config/config.php';

$user_id = $_COOKIE['user_id'];
$course_id = getValue('course_id','int','GET','');
$qr = new db_query("SELECT * FROM orders WHERE user_student_id = $user_id AND course_id = $course_id");

if (mysql_num_rows($qr->result) == 0) {
	$data = [
		'user_student_id'=>$user_id,
		'course_id'=>$course_id,
		'course_type'=>1,
		'day_buy'=>strtotime(date('d-m-Y'))
	];

	add('orders',$data);

	$num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
	$num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");

	$count_student = mysql_num_rows($num2->result) + mysql_num_rows($num3->result);
	$data1 = [
		'result'=>true,
		'count_student'=>$count_student
	];

	echo json_encode($data1);
}else{
	$data1 = [
		'result'=>false
	];
	echo json_encode($data1);
}
?>