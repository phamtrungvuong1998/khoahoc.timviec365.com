<?php
require_once '../config/config.php';
header("Cache-Control: no-cache, must-revalidate");
if(!isset($_COOKIE['user_id']) || $_COOKIE['user_type'] != 2){
	header('location:/');
}else{
	$cookie_id = $_COOKIE['user_id'];
	$db = new db_query("SELECT * FROM users JOIN user_teach_cooperation ON user_teach_cooperation.user_id = users.user_id JOIN user_teach_experience ON user_teach_experience.user_id = users.user_id WHERE users.user_id = '$cookie_id'");
	$row = mysql_fetch_array($db->result);
	if ($row['user_active'] == 0) {
		header("Location: /xac-thuc-tai-khoan.html");
	}
}
?>