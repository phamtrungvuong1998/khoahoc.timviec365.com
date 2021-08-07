<?php
require_once '../config/config.php';

$course = getValue('course','arr','POST','');
$price = getValue('price','int','POST','');
$tamtinh = getValue('tamtinh','arr','POST','');
$arr_code = getValue('arr_code','arr','POST','');

$qr = new db_query("SELECT user_money FROM users WHERE user_id = " . $_COOKIE['user_id']);

$row = mysql_fetch_array($qr->result);

if ($row['user_money'] < $price) {
	$data = [
		'type'=> false,
		'msg'=>'Tài khoản của bạn không đủ để thanh toán'
	];
}else{
	$data1 = [
		'user_money'=>$row['user_money'] - $price
	];

	$dataId1 = [
		'user_id'=>$_COOKIE['user_id']
	];

	update('users',$data1,$dataId1);

	if ($arr_code != "") {
		for ($i = 0; $i < count($arr_code); $i++) {
			if ($arr_code[$i] != '') {
				$qrCode = new db_query("SELECT quantity FROM discount_code WHERE code_id = " . $arr_code[$i]);
				$rowCode = mysql_fetch_array($qrCode->result);

				$data2 = [
					'quantity'=>$rowCode['quantity'] - 1
				];

				$dataId2 = [
					'code_id'=>$arr_code[$i]
				];

				update('discount_code',$data2,$dataId2);
			}
		}
	}

	$arr_ct_id = [];
	for ($i = 0; $i < count($course); $i++) {
		$data4 = [
			'user_student_id'=>$_COOKIE['user_id'],
			'course_id'=>$course[$i],
			'course_type'=>2,
			'price'=>$tamtinh[$i],
			'day_buy'=>strtotime(date("d-m-Y"))
		];
		add('orders',$data4);

		$qrDelCart = new db_query("DELETE FROM carts WHERE user_student_id = " . $_COOKIE['user_id'] . " AND course_id = " . $course[$i]);
		$qrC = new db_query("SELECT * FROM courses WHERE course_id = " . $course[$i]);
		$rowC = mysql_fetch_array($qrC->result);

		$arr_ct_id[] = $rowC['user_id'];
	}

	for ($i = 0; $i < count($tamtinh); $i++) {
		for ($j = 0; $j < count($arr_ct_id); $j++) {
			if ($j == $i) {
				$qrCT = new db_query("SELECT user_money FROM users WHERE user_id = " . $arr_ct_id[$i]);

				$rowCT = mysql_fetch_array($qrCT->result);

				$data3 = [
					'user_money'=>$rowCT['user_money'] + $tamtinh[$i]
				];

				$dataId3 = [
					'user_id'=>$arr_ct_id[$i]
				];

				update('users',$data3,$dataId3);
			}
		}
	}

	$data = [
		'type'=> true,
		'msg'=>'Mua khóa học thành công',
		'user_id'=>$_COOKIE['user_id']
	];
}

echo json_encode($data);
?>