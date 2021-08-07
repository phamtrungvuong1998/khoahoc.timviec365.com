<?php
require_once '../config/config.php';
header("Cache-Control: no-cache, must-revalidate");
if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_type'])){
	$cookie_id = $_COOKIE['user_id'];
    $cookie_type = $_COOKIE['user_type'];
	$db = new db_query("SELECT * FROM users WHERE user_id = $cookie_id");
    $row = mysql_fetch_array($db->result);
	if ($row['user_active'] == 0) {
		header("Location: /xac-thuc-tai-khoan.html");
	}
}else{
    $cookie_id = 0;
    $cookie_type = 0;
}
?>