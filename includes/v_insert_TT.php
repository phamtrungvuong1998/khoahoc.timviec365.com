<?php
header("Cache-Control: no-cache, must-revalidate");
if ($_COOKIE['user_type'] != 3 || !isset($_COOKIE['user_id'])) {
	header("Location: /");
} else {
	require_once '../config/config.php';
	$user_id = $_COOKIE['user_id'];
	$qr = new db_query("SELECT * FROM `users` WHERE `user_id` = '$user_id'");
	$row = mysql_fetch_array($qr->result);

	if ($row['user_active'] == 0) {
		header("Location: /xac-thuc-tai-khoan.html");
	}

	if ($row['user_avatar'] == 0) {
		$l_link_avatar = "../img/v_avatar_default.png";
	} else {
		$l_link_avatar = "../img/avatar/" . $row['user_avatar'];
	}
}
?>
