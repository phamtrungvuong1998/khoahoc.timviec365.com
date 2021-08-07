<?php
require_once '../config/config.php';
$user_name = getValue('user_name', 'str', 'POST', '');

$name = getValue('name', 'str', 'POST', '');

$phone = getValue('phone', 'str', 'POST', '');

$password = getValue('password', 'str', 'POST', '');

$password = md5($password);

$email = getValue('email', 'str', 'POST', '');

$student_select = getValue('student_select', 'int', 'POST','');

$student_create = getValue('student_create', 'int', 'POST','');

$student_edit = getValue('student_edit', 'int', 'POST','');

$student_delete = getValue('student_delete', 'int', 'POST','');

$qrCheck = new db_query("SELECT * FROM admin WHERE adm_login_name = '$user_name' OR adm_email = '$email'");

if (mysql_num_rows($qrCheck->result) > 0) {
	echo '1';
}else{
	$data = [
		'adm_login_name'=>$user_name,
		'adm_name'=>$name,
		'adm_phone'=>$phone,
		'adm_password'=>$password,
		'adm_email'=>$email,
		'created_at'=>date("Y-m-d")
	];

	add('admin', $data);

	$id = mysql_insert_id();

	$data2 = [
		'adm_id'=>$id,
		'student_see'=>$student_select,
		'student_create'=>$student_create,
		'student_delete'=>$student_delete,
		'student_edit'=>$student_edit
	];

	add('admin_student',$data2);
}
?>