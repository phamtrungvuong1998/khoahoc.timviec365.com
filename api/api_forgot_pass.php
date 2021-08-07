<?php
include_once '../config/config.php';
include_once 'functions.php';
use Firebase\JWT\JWT;

$email = getValue('email','str','POST','');
$qr = new db_query("SELECT user_id FROM users WHERE user_mail = '$email'");
echo mysql_num_rows($qr->result);
if (mysql_num_rows($qr->result) == 0) {
	set_error('404','Email không tồn tại');
}else{
	$row = mysql_fetch_array($qr->result);
	$otp = rand(100000,999999);
	$data = [
		'user_id'=>$row['user_id'],
		'otp'=>$otp,
		'time'=>time()
	];

	$arr_token['token'] = JWT::encode($data,$key);

	success('Mã xác thực đã được gửi. Vui lòng kiểm tra email',$arr_token);
}
?>