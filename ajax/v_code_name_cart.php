<?php
require_once '../config/config.php';

$code_name = getValue('code_name','str','POST','');
$teacher_id = getValue('teacher_id','int','POST','');

$qr = new db_query("SELECT * FROM discount_code WHERE code_name = '$code_name' AND user_id = '$teacher_id'");

if (mysql_num_rows($qr->result) == 0) {
	$data = [
		'type'=>false,
		'msg'=>"Mã giảm giá không tồn tại"
	];
}else{
	$row = mysql_fetch_array($qr->result);

	
}
?>