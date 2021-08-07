<?php
include_once '../config/config.php';
include_once 'functions.php';
use Firebase\JWT\JWT;
$password = getValue('password','str','POST','');
$token = getValue('token','str','POST','');
if ($password == "") {
	set_error('404','Mật khẩu không được để trống');
}else{
	$today = strtotime(date('d-m-Y'));
	$password = md5($password);
	$token_decode = JWT::decode($token,$key,['HS256']);
	$data1 = [
		'user_pass'=>$password,
		'updated_at'=>$today
	];

	$dataId = [
		'user_id'=>$token_decode->user_id
	];

	update('users',$data1,$dataId);

	$data = [
		'result'=>1
	];
	success('Mật khẩu thay đổi thành công',$data);
}

?>