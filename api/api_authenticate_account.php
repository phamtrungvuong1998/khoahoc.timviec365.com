<?php
include_once '../config/config.php';
include_once 'functions.php';
use Firebase\JWT\JWT;

$token = getValue('token','str','GET','');
$otp = getValue('otp','int','GET',''); //OTP người dùng nhập
$token_decode = JWT::decode($token,$key,['HS256']);
// print_r($token_decode);
// die();

if ($token_decode->otp != $otp) {
	set_error('404','Mã otp không đúng');
}else if (time() > ($token_decode->time + 900)) {
	set_error('404','Mã otp đã hết hạn');
}else{
	$data = [
		'user_active'=>1,
		'updated_at'=>strtotime(date("d-m-Y"))
	];

	$dataId = [
		'user_id'=>$token_decode->user_id
	];

	update('users',$data,$dataId);
	$data1 = [
		'result'=>1
	];
	success('Kích hoạt tài khoản thành công',$data1);
}


?>