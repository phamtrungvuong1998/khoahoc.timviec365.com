<?php
require_once '../config/config.php';
$code_name = getValue('code_name', 'str', 'POST', '');
$course_id = getValue('course_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');

$db_code = new db_query("SELECT * FROM discount_code WHERE code_name = '$code_name' AND user_id = $user_id");
$db_course = new db_query("SELECT * FROM courses WHERE course_id = $course_id");
$row_course = mysql_fetch_array($db_course->result);

$db_cart = new db_query("SELECT * FROM carts INNER JOIN courses ON carts.course_id = courses.course_id WHERE user_student_id = " . $_COOKIE['user_id']);
$total_price = 0;

while ($row_cart = mysql_fetch_array($db_cart->result)) {
	if ($row_cart['price_promotional'] == -1) {
		$total_price = $total_price + $row_cart['price_listed'];
	}else{
		$total_price = $total_price + $row_cart['price_promotional'];
	}
}

if ($row_course['price_promotional'] == -1) {
	$price = $row_course['price_listed'];
}else{
	$price = $row_course['price_promotional'];
}

// echo number_format($course_id);
$row = mysql_fetch_array($db_code->result);
if (mysql_num_rows($db_code->result) == 0) {
	$data1 = [
		'type'=>false,
		'msg'=>'Mã giảm giá không tồn tại',
		'discount_money'=>number_format($price - $row['discount_money']) . " đ",
		'total_price'=>number_format($total_price - $row['discount_money']) . " đ",
	];
}else{
	if ($row['quantity'] == 0) {
		$data1 = [
			'type'=>false,
			'msg'=>'Số lượng mã giảm giá đã hết',
			'discount_money'=>number_format($price - $row['discount_money']) . " đ",
			'total_price'=>number_format($total_price - $row['discount_money']) . " đ",
		];
	}else if (strtotime(date("d-m-Y")) < strtotime($row['date_start'])) {
		$data1 = [
			'type'=>false,
			'msg'=>'Mã giảm giá chưa đến thời gian sử dụng',
			'discount_money'=>number_format($price - $row['discount_money']) . " đ",
			'total_price'=>number_format($total_price - $row['discount_money']) . " đ",
		];
	}else if (strtotime(date("d-m-Y")) > strtotime($row['date_end'])) {
		$data1 = [
			'type'=>false,
			'msg'=>'Mã giảm giá đã hết thời gian sử dụng',
			'discount_money'=>number_format($price - $row['discount_money']) . " đ",
			'total_price'=>number_format($total_price - $row['discount_money']) . " đ",
		];
	}else if($row['course_value'] > $price){
		$data1 = [
			'type'=>false,
			'msg'=>'Giá khóa học chưa đủ điều kiện để sử dụng mã giảm giá này',
			'discount_money'=>number_format($price - $row['discount_money']) . " đ",
			'total_price'=>number_format($total_price - $row['discount_money']) . " đ",
		];
	}else{
		$data1 = [
			'type'=>true,
			'msg'=>'Áp dụng mã giảm giá thành công',
			'discount_money'=>number_format($price - $row['discount_money']) . " đ",
			'total_price'=>number_format($total_price - $row['discount_money']) . " đ",
			'code_id'=>$row['code_id']
		];
	}
}

echo json_encode($data1);
?>