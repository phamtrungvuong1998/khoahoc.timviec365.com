<?php
require_once '../config/config.php';
$recharge_id = getValue('recharge_id','int','GET','');
$status = getValue('status','int','GET','');

$data = [
	'status_recharge'=>$status
];

$dataId = [
	'recharge_id'=>$recharge_id
];

update('rechange_notice',$data,$dataId);
if ($status == 2) {
	$qr = new db_query("SELECT recharge_id,users.user_id,amount,user_money FROM rechange_notice INNER JOIN users ON rechange_notice.user_id = users.user_id WHERE recharge_id = $recharge_id");
	$row = mysql_fetch_array($qr->result);
	$data2 = [
		'user_money'=>$row['amount']+$row['user_money']
	];

	$dataId2 = [
		'user_id'=>$row['user_id']
	];

	update('users',$data2,$dataId2);
}


echo json_encode("vuong");
?>