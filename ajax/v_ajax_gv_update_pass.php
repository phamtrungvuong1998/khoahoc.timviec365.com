<?php
require_once '../config/config.php';

$user_id = $_COOKIE['user_id'];

$pass0 = getValue('pass0','str','POST','');
$pass1 = getValue('pass1','str','POST','');

$pass0 = md5($pass0);
$pass1 = md5($pass1);

$qrPass = new db_query("SELECT user_pass FROM users WHERE user_id = $user_id");
$rowPass = mysql_fetch_array($qrPass->result);
if ($pass0 != $rowPass['user_pass']) {
	$data = [
		'result'=>0
	]; 
}else{
	$data1 = [
		'user_pass'=>$pass1
	];

	$dataId = [
		'user_id'=>$user_id
	];

	update('users',$data1,$dataId);

	$data = [
		'result'=>1
	]; 
}

echo json_encode($data);
?>