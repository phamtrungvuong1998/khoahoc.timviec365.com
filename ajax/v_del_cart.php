<?php
require_once '../config/config.php';
$cart_id = getValue('cart_id','int','GET','');

$qr = new db_query("SELECT * FROM carts WHERE cart_id = $cart_id AND user_student_id = " . $_COOKIE['user_id']);
$row = mysql_fetch_array($qr->result);
if (mysql_num_rows($qr->result) > 0) {
	$qrDel = new db_query("DELETE FROM carts WHERE cart_id = $cart_id");

	$qrC = new db_query("SELECT * FROM carts INNER JOIN courses ON carts.course_id = courses.course_id WHERE user_student_id = " . $_COOKIE['user_id']);
	$total_price = 0;
	while ($rowc = mysql_fetch_array($qrC->result)) {
		if ($rowc['price_promotional'] == -1) {
			$price = $rowc['price_listed'];
		}else{
			$price = $rowc['price_promotional'];
		}

		$total_price = $total_price + $price;
	}
	$data1 = [
		'type'=>true,
		'price'=>number_format($total_price) . " đ"
	];
}else{
	$data1 = [
		'type'=>false
	];
}

echo json_encode($data1);
?>