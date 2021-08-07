<?php 
session_start();
require_once '../config/config.php';
$type = getValue('type','int','GET','');
header("Cache-Control: no-cache, must-revalidate");
unset($_COOKIE['user_id']);
unset($_COOKIE['user_type']);
unset($_COOKIE['general_login']);
setcookie('user_id', NULL ,-1,'/');
setcookie('user_type', NULL ,-1,'/');
if (isset($_COOKIE['user_active'])) {
	unset($_COOKIE['user_active']);
	setcookie('user_active', null,-1,'/');
}

//------TVT thêm ngày 06/07------
setcookie('general_login', null, -1,'/','.timviec365.com');
//------------
session_destroy();
if ($type == 1) {
	$data = [
		'type'=>1
	];
}else{
	header("Location: /");
}
echo json_encode($data);
?>