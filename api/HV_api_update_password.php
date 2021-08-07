<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$token = getValue('token','str','POST','');

if ($token == '') {
	set_error('404','Đăng nhập trước');
	die();
}else{
	$password = getValue('password','str','POST','');
	$password = md5($password);
	$token_decode = JWT::decode($token,$key,['HS256']);
	$user_id = $token_decode->user_id;

	$data1 = [
		'user_pass'=>$password,
		'updated_at'=>strtotime(date("d-m-Y"))
	];

	$dataId = [
		'user_id'=>$user_id
	];

	update('users',$data1,$dataId);

	$data = [
		'result'=>1
	];

	success('Đổi mật khẩu thành công',$data);
	
}
?>