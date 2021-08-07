<?php
require_once '../config/config.php';
$id = getValue('id','int','POST','');
$password = getValue('password','str','POST','');
$password = md5($password);

$data = [
	'user_pass'=>$password
];

$dataId = [
	'user_id'=>$id
];

update('users',$data,$dataId);
$qr = new db_query("SELECT user_type FROM users WHERE user_id = $id");
$row = mysql_fetch_array($qr->result);

setcookie('forgot_pass','',time() - 3600 ,'/');
setcookie('user_type_login',$row['user_type'],time() + 3600 ,'/dang-nhap.html');
setcookie('user_type_login',$row['user_type'],time() + 3600 ,'/quen-mat-khau.html');

$data1 = [
	'type'=>1
];

echo json_encode($data1);
?>