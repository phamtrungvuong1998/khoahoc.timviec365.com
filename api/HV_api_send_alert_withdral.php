<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$token = getValue('token','str','POST','');

if ($token == "") {
	set_error('404','Đăng nhập trước');
	die();
}else{
	$token_decode = JWT::decode($token,$key,['HS256']);
	$bank_id = getValue('bank_id','int','POST','');
	$amount = getValue('amount','int','POST','');
	$recharge_form_id = getValue('recharge_form_id','int','POST','');
	$bank_recharge = getValue('bank_recharge','int','POST','');
	$recharge_name = getValue('recharge_name','str','POST','');
	$bank_account = getValue('bank_account','int','POST','');
	$time_recharge = getValue('time_recharge','str','POST','');
	$time_recharge = strtotime($time_recharge);
	$content_recharge = getValue('content_recharge','str','POST','');

	$data1 = [
		'bank_id'=>$bank_id,
		'amount'=>$amount,
		'recharge_form_id'=>$recharge_form_id,
		'bank_recharge'=>$bank_recharge,
		'recharge_name'=>$recharge_name,
		'bank_account'=>$bank_account,
		'time_recharge'=>$time_recharge,
		'content_recharge'=>$content_recharge,
	];

	add('rechange_notice',$data1);

	$data = [
		'result'=>1
	];

	success('Gửi thông báo thành công',$data);
}
?>