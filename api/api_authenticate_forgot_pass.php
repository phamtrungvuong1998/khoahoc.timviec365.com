<?php
include_once '../config/config.php';
include_once 'functions.php';
use Firebase\JWT\JWT;

$token = getValue('token','str','POST','');
$otp = getValue('otp','int','POST',''); //OTP người dùng nhập
$token_decode = JWT::decode($token,$key,['HS256']);

if ($token_decode->otp != $otp) {
	set_error('404','Mã otp không chính xác');
}else if (time() > ($token_decode->time + 900)) {
	set_error('404','Mã otp đã hết hạn');
}else{
	$data = [
		'user_id'=>$token_decode->user_id
	];
	$arr_token['token'] = JWT::encode($data,$key);
	success('Mã otp đúng. Vui lòng đổi mật khẩu',$arr_token);
}
?>