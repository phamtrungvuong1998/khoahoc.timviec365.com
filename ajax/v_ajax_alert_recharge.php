<?php
require_once '../config/config.php';
$user_id = $_COOKIE['user_id'];
$bank_get = getValue('bank_get', 'int', 'GET', '');
$amount = getValue('amount', 'int', 'GET', '');
$form_recharge = getValue('form_recharge','int','GET','');
$bank_set = getValue('bank_set','int','GET','');
$name_recharge = getValue('name_recharge','int','GET','');
$bank_account = getValue('bank_account','int','GET','');
echo $bank_account;
$time_recharge = getValue('time_recharge','int','GET','');
$content_recharge = getValue('content_recharge','int','GET','');

$data = [
	'user_id'=>$user_id,
	'bank_id'=>$bank_get,
	'amount'=>$amount,
	'recharge_form_id'=>$form_recharge,
	'bank_recharge'=>$bank_set,
	'recharge_name'=>$name_recharge,
	'bank_account'=>$bank_account,
	'time_recharge'=>strtotime($time_recharge),
	'content_recharge'=>$content_recharge,
	'status_recharge'=>0
];

add('rechange_notice', $data);

echo 'Gửi thông báo thành công. Vui lòng chờ phản hồi';
?>