<?php
require_once '../config/config.php';

$type = getValue('type','int','POST','');
$adm_id = $_COOKIE['adm_id'];

if ($type == 2) {
	$old_pass = getValue('old_pass','str','POST','');

	$old_pass = md5($old_pass);

	$new_pass = getValue('new_pass','str','POST','');

	$qrCheck = new db_query("SELECT * FROM admin WHERE adm_id = '$adm_id' AND adm_password = '$old_pass'");
	if (mysql_num_rows($qrCheck->result) == 0) {
		echo '0';
	}else{
		$new_pass = md5($new_pass);
		$data = [
			'adm_password'=>$new_pass
		];

		$id = [
			'adm_id'=>$adm_id
		];

		update('admin', $data, $id);
	}
}else if ($type == 1) {
	$email = getValue('email','str','POST','');

	$data = [
		'adm_email'=>$email
	];

	$id = [
		'adm_id'=>$adm_id
	];

	update('admin', $data, $id);
	
	echo 'Cập nhật email thành công';

}
?>