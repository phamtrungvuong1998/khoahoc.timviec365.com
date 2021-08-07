<?php
require_once '../config/config.php';
if (!isset($_COOKIE['adm_id'])) {
	header("Location: loginAdmin.php");
}else{
	$adm_id = $_COOKIE['adm_id'];
}

if (isset($_COOKIE['student_id'])) {
	setcookie('student_id','',time()-300,'/');
}

if ($_COOKIE['adm_type'] == 1) {
	$qr = new db_query("SELECT * FROM admin WHERE adm_id = '$adm_id'");
	$important = "display:block !important";
}else{
	$qr = new db_query("SELECT * FROM admin JOIN admin_permission ON admin.adm_id = admin_permission.adm_id WHERE admin.adm_id = '$adm_id'");
	$important = "";
}
$row = mysql_fetch_array($qr->result);


?>