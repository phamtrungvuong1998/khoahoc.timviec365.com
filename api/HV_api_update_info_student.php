<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$token = getValue('token','str','POST','');

if ($token == '') {
	set_error('404','Đăng nhập trước');
	die();
}else{
	$token_decode = JWT::decode($token,$key,['HS256']);
	$user_id = $token_decode->user_id;

	$dataId = [
		'user_id'=>$user_id
	];

	if (isset($_FILES['user_avatar'])) {
		$qr = new db_query("SELECT user_avatar FROM users WHERE user_id = $user_id");
		$row = mysql_fetch_array($qr->result);

		$duoi = explode('/', $_FILES['user_avatar']['type']);
		$duoi = $duoi[(count($duoi) - 1)];

		$_FILES['user_avatar']['name'] = md5(rand()) . "." . $duoi;

		move_uploaded_file($_FILES['user_avatar']['tmp_name'], '../img/avatar/'.$_FILES['user_avatar']['name']);
		if ($row['user_avatar'] != 0) {
			unlink('../img/avatar/'.$row['user_avatar']);
		}
		$data1 = [
			'user_avatar'=>$_FILES['user_avatar']['name']
		];

		update('users',$data1,$dataId);
	}

	$user_name = getValue('user_name','str','POST','');
	$user_gender = getValue('user_gender','int','POST','');
	$user_birth = getValue('user_birth','str','POST','');
	$user_phone = getValue('user_phone','int','POST','');
	$cit_id = getValue('cit_id','int','POST','');
	$district = getValue('district','int','POST','');
	$user_address = getValue('user_address','str','POST','');
	$cate_id = getValue('cate_id','str','POST','');


	$data1 = [
		'user_name'=>$user_name,
		'user_gender'=>$user_gender,
		'user_birth'=>$user_birth,
		'user_phone'=>$user_phone,
		'cit_id'=>$cit_id,
		'district_id'=>$district_id,
		'user_address'=>$user_address,
		'cate_id'=>$cate_id,
		'updated_at'=>strtotime(date("d-m-Y"))
	];

	update('users',$data1,$dataId);

	$data = [
		'result'=>1
	];

	success('Cập nhật thành công',$data);
	
}
?>