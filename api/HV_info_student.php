<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$qr = new db_query("SELECT * FROM users INNER JOIN city ON users.cit_id = city.cit_id WHERE user_id = $user_id");
$row = mysql_fetch_array($qr->result);

$qrDistrict = new db_query("SELECT * FROM city WHERE cit_parent = " . $row['cit_id']);
$rowD = mysql_fetch_array($qrDistrict->result);
$data['user_info'] = [
	'user_avatar'=>$row['user_avatar'],//Ảnh đại diện
	'user_name'=>$row['user_name'],//Tên học viên
	'user_gender'=>$row['user_gender'],//Giới tính
	'user_birth'=>$row['user_birth'],//Ngày sinh
	'user_phone'=>$row['user_phone'],//Số điện thoại
	'user_mail'=>$row['user_mail'],//Email
	'city'=>[
		'cit_id'=>$row['cit_id'],
		'cit_name'=>$row['cit_name'],
	],//Tỉnh, thành phố
	'district'=>[
		'district_id'=>$row['district_id'],
		'district_name'=>$rowD['cit_name']
	],//Quận, huyện
	'address'=>$row['user_address'],//Địa chỉ
	'cate_id'=>$row['cate_id'],//Môn học quan tâm
];

success('',$data);
?>