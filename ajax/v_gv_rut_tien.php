<?php
require_once '../config/config.php';
$today = strtotime(date("d-m-Y"));
$withdrawal_amount= getValue('withdrawal_amount','int','POST','');
$transaction_name = getValue('transaction_name','str','POST','');
$acc_number = getValue('acc_number','str','POST','');
$bank_id = getValue('bank_id','int','POST','');
$transaction_content = getValue('transaction_content','str','POST','');
$bank_branch = getValue('bank_branch','str','POST','');
$qrUser = new db_query("SELECT user_money FROM users WHERE user_id = " . $_COOKIE['user_id']);
$row = mysql_fetch_array($qrUser->result);
if($withdrawal_amount > $row['user_money']){
	$data1 = [
		'type'=>0
	];
}else{
	$data = [
		'user_id'=>$_COOKIE['user_id'],
		'bank_id'=>$bank_id,
		'withdrawal_amount'=>$withdrawal_amount,
		'acc_number'=>$acc_number,
		'transaction_name'=>$transaction_name,
		'transaction_content'=>$transaction_content,
		'bank_branch'=>$bank_branch,
		'created_at'=>$today,
		'updated_at'=>$today
	];
	add('user_transaction',$data);
	$data1 = [
		'type'=>1
	];
}

echo json_encode($data1);
?>