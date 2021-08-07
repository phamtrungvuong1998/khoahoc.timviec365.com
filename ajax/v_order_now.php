<?php
require_once '../config/config.php';
$price = getValue('price','int','POST','');
$course_id = getValue('course_id','int','POST','');
$code_name = getValue('code_name','str','POST','');
$use_code = getValue('use_code','int','POST','');
$center_teacher_id = getValue('center_teacher_id','int','POST','');

$qrUser = new db_query("SELECT user_money FROM users WHERE user_id = " . $_COOKIE['user_id']);
$rowUser = mysql_fetch_array($qrUser->result);
if($rowUser['user_money'] < $price){
	$data = [
		'type'=>false,
		'msg'=>"Số tiền trong tài khoản của bạn không đủ để mua khóa học này"
	];
}else{
	if ($use_code == 1) {
		$qrCode = new db_query("SELECT * FROM discount_code WHERE code_name = '$code_name' AND user_id = $center_teacher_id");
		if (mysql_num_rows($qrCode->result) > 0) {
			$rowCode = mysql_fetch_array($qrCode->result);
			$data1 = [
				'quantity'=>$rowCode['quantity'] - 1
			];

			$dataId = [
				'code_id'=>$rowCode['code_id']
			];

			update('discount_code',$data1,$dataId);
		}
	}
	$data2 = [
		'user_money'=>$rowUser['user_money'] - $price
	];

	$dataId2 = [
		'user_id'=>$_COOKIE['user_id']
	];
	update('users',$data2,$dataId2);

	$qr_course = new db_query("SELECT user_id FROM courses WHERE course_id = $course_id");

	$rowc = mysql_fetch_array($qr_course->result);

	$qrTeacher = new db_query("SELECT user_money FROM users WHERE user_id = " . $rowc['user_id']);
	$rowT = mysql_fetch_array($qrTeacher->result);
	$data3 = [
		'user_money'=>$rowT['user_money'] + $price
	];

	$dataId3 = [
		'user_id'=>$rowc['user_id']
	];

	update('users',$data3,$dataId3);

	$data1 = [
		'user_student_id'=>$_COOKIE['user_id'],
		'course_id'=>$course_id,
		'course_type'=>2,
		'price'=>$price,
		'day_buy'=>strtotime(date("d-m-Y"))
	];
	add('orders',$data1);
	$data = [
		'type'=>true,
		'user_id'=>$_COOKIE['user_id'],
		'course_id'=>$course_id
	];
}

echo json_encode($data);
?>