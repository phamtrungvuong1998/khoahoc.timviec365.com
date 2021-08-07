<?php
	require_once '../config/config.php';
	if (isset($_COOKIE['user_type']) && $_COOKIE['user_type'] == 1) {
		$user_id = $_COOKIE['user_id'];
		$qr = new db_query("SELECT * FROM users WHERE user_id = '$user_id'");
		$row = mysql_fetch_array($qr->result);
	}
?>