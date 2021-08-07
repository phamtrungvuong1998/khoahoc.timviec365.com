<?php
include_once '../config/config.php';
include_once 'functions.php';
use Firebase\JWT\JWT;
$token = getValue('token','str','POST','');

if ($token == '') {
	set_error('404','Đăng nhập trước');
	die();
}else{
	$data = [];
	$token_decode = JWT::decode($token,$key,['HS256']);

	$user_id = $token_decode->user_id;
	$user_type = $token_decode->user_type;
	$qr = new db_query("SELECT user_name,user_avatar,user_money FROM users WHERE user_id = " . $user_id);
	$dataUser = [];
	$row = mysql_fetch_array($qr->result);

	$dataUser['user_name'] = $row['user_name'];
	$dataUser['user_avatar'] = $row['user_avatar'];
	$data['user'] = $dataUser;

}
?>