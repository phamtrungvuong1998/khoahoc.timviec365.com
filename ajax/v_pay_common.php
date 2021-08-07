<?php
require_once '../config/config.php';
$course_id = getValue('course_id','int','POST','');

$qrCommon2 = new db_query("SELECT * FROM order_common WHERE course_id = $course_id AND common_id = (SELECT MAX(common_id) FROM order_common WHERE course_id = $course_id)");
$rowCommon2 = mysql_fetch_array($qrCommon2->result);

$qrC = new db_query("SELECT * FROM courses INNER JOIN users ON courses.user_id = users.user_id WHERE course_id = $course_id");
$rowc = mysql_fetch_array($qrC->result);

$qrUser = new db_query("SELECT user_money FROM users WHERE user_id = " . $_COOKIE['user_id']);
$rowUser = mysql_fetch_array($qrUser->result);

if ($rowUser['user_money'] < $rowc['price_discount']) {
	$data = [
		'type'=>false,
		'msg'=>'Số tiền trong tài khoản của bạn không đủ để thanh toán'
	];
}else{
	$data1 = [
		'user_money'=>$rowUser['user_money'] - $rowc['price_discount']
	];

	$dataId1 = [
		'user_id'=>$_COOKIE['user_id']
	];

	update('users',$data1,$dataId1);

	$qrDelCart = new db_query("DELETE FROM carts WHERE course_id = $course_id AND user_student_id = " . $_COOKIE['user_id']);

	if ($rowCommon2['numbers'] == $rowc['quantity_std'] || mysql_num_rows($qrCommon2->result) == 0) {
		$data1 = [
			'course_id'=>$course_id,
			'course_type'=>2,
			'numbers'=>1,
			'day_buy'=>strtotime(date("d-m-Y"))
		];
		add('order_common',$data1);
		$common_id = mysql_insert_id();
	}else{
		$data1 = [
			'numbers'=>$rowCommon2['numbers'] + 1
		];

		$dataId1 = [
			'common_id'=>$rowCommon2['common_id']
		];

		update('order_common',$data1,$dataId1);

		$common_id = $rowCommon2['common_id'];
	}

	$data4 = [
		'course_id'=>$course_id,
		'user_student_id'=>$_COOKIE['user_id'],
		'course_id'=>$course_id,
		'common_id'=>$common_id
	];

	add('order_student_common',$data4);

	$data2 = [
		'user_money'=>$rowc['user_money'] + $rowc['price_discount']
	];

	$dataId2 = [
		'user_id'=>$rowc['user_id']
	];

	update('users',$data2,$dataId2);

	$data = [
		'type'=>true,
		'msg'=>'Mua khóa học thành công',
		'user_id'=>$_COOKIE['user_id']
	];
}

echo json_encode($data);
?>