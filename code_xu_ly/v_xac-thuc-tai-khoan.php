<?php
require_once '../config/config.php';

$token = getValue('token','str','GET','');
$user_id = getValue('user_id','str','GET','');

$queryToken = new db_query("SELECT `token`,`user_id` FROM `tokens` WHERE `token` = '$token' AND `user_id` = '$user_id'");
$rowToken = mysql_fetch_array($queryToken->result);
if ($rowToken['token'] == $token && $rowToken['user_id'] == $user_id) {
	$dataUser = [
		'user_active'=>1,
	];

	$tableUser = [
		'user_id'=>$user_id,
	];

	update('users', $dataUser ,$tableUser);
	header("Location: /xac-thuc-thanh-cong.html");
}
?>