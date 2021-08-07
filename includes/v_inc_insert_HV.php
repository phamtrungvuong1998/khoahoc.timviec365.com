<?php
require_once '../config/config.php';
header("Cache-Control: no-cache, must-revalidate");
if (!isset($_COOKIE['user_id']) || !isset($_COOKIE['user_type'])) {
	header("Location: /");
}else{
	$user_id = $_COOKIE['user_id'];

	$qrHV = new db_query("SELECT * FROM users WHERE user_id = $user_id");

	$rowHV = mysql_fetch_array($qrHV->result);

	if ($rowHV['user_active'] == 0) {
		header("Location: /xac-thuc-tai-khoan.html");
	}
	if ($rowHV['user_avatar'] == 0) {
		$v_link_avatar = "../img/v_avatar_default.png";
	}else{
		$v_link_avatar = "../img/avatar/" . $rowHV['user_avatar'];
	}
}
?>