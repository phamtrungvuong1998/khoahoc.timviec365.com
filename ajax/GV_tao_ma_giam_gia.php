<?php
require_once '../config/config.php';
$code_name = getValue('code_name','str','POST','');
$date_start = getValue('date_start','str','POST','');
$date_end = getValue('date_end','str','POST','');
$discount_money = getValue('discount_money','int','POST','');
$course_value = getValue('course_value','int','POST','');
$quantity = getValue('quantity','int','POST','');
$show_code = getValue('show_code','int','POST','');
$submit = getValue('submit','int','POST','');
$code_id = getValue('code_id','int','POST','');

if ($submit == 1) {
	$qrCode = new db_query("SELECT code_id FROM discount_code WHERE code_name = '$code_name' AND user_id = " . $_COOKIE['user_id']);
	if (mysql_num_rows($qrCode->result) > 0) {
		$data = [
			'type'=>0
		];
	}else{
		$data1 = [
			'user_id'=>$_COOKIE['user_id'],
			'code_name'=>$code_name,
			'date_start'=>$date_start,
			'date_end'=>$date_end,
			'discount_money'=>$discount_money,
			'course_value'=>$course_value,
			'quantity'=>$quantity,
			'show_code'=>$show_code,
			'created_at'=>strtotime(date("d-m-Y")),
			'updated_at'=>strtotime(date("d-m-Y"))
		];
		add('discount_code', $data1);
		$data = [
			'type'=>1,
			'user_id'=>$_COOKIE['user_id']
		];
	}
}else if ($submit == 2) {
	$qrCode = new db_query("SELECT code_id FROM discount_code WHERE code_id != $code_id AND code_name = '$code_name' AND user_id = " . $_COOKIE['user_id']);
	if (mysql_num_rows($qrCode->result) > 0) {
		$data = [
			'type'=>0
		];
	}else{
		$data1 = [
			'user_id'=>$_COOKIE['user_id'],
			'code_name'=>$code_name,
			'date_start'=>$date_start,
			'date_end'=>$date_end,
			'discount_money'=>$discount_money,
			'course_value'=>$course_value,
			'quantity'=>$quantity,
			'show_code'=>$show_code,
			'created_at'=>strtotime(date("d-m-Y")),
			'updated_at'=>strtotime(date("d-m-Y"))
		];

		$dataId = [
			'code_id'=>$code_id
		];
		update('discount_code', $data1,$dataId);
		$data = [
			'type'=>1,
			'user_id'=>$_COOKIE['user_id']
		];
	}
}

echo json_encode($data);
?>