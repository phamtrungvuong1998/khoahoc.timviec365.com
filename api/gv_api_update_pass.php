<?php
require_once 'api_info.php';
if ($user_type != 2) {
	set_error('404','Phải đăng nhập tài khoản giảng viên');
	die();
}

$password = getValue('password','str','POST','');

$password = md5($password);

$dataId = [
	'user_id'=>$user_id
];

$data = [
	'user_pass'=>$password,
	'updated_at'=>strtotime(date("d-m-Y"))
];

update('users',$data,$dataId);

$data1 = [
	'result'=>true
];

success('Cập nhật mật khẩu thành công', $data1);
?>