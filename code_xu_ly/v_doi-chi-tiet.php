<?php
require_once '../config/config.php';
$address = getValue('address','str','POST','');
$avatar = getValue('avatar','arr','POST','');
$name = getValue('name','str','POST','');
$city = getValue('city','int','POST','');
$district = getValue('district','int','POST','');
$gender = getValue('gender','int','POST','');
$phone = getValue('phone','str','POST','');
$birth = getValue('birth','str','POST','');
$cate_id = getValue('cate_id','arr','POST','');
$cate_id = implode(",", $cate_id);

$data = [
	'user_address'=>$address,
	'user_name'=>$name,
	'cit_id'=>$city,
	'district_id'=>$district,
	'user_gender'=>$gender,
	'user_phone'=>$phone,
	'user_birth'=>$birth,
	'cate_id'=>$cate_id,
	'updated_at'=>strtotime(date("d-m-Y"))
];

$dataId = [
	'user_id'=>$_COOKIE['user_id']
];

update('users',$data,$dataId);

$data1 = [
	'alert'=>'Cập nhật thành công',
	'name'=>$name
];
//    --------đồng bộ cập nhật thông tin ứng viên-------------
$qr_info = new db_query("SELECT user_mail FROM users WHERE user_id = '".$_COOKIE['user_id']."'");
$row_info = mysql_fetch_assoc($qr_info->result);
if ($gender == 1) {
    $gt = 'nam';
} else {
    $gt = 'nu';
}
//$avt = "https://khoahoc.timviec365.com/img/avatar/" . $newfilename;
$data_api = [
    'email' => $row_info['user_mail'],
    'name' => $name,
    'birthday' => $birth,
    'gender' => $gt,
    'city_id' => $city,
    'district_id' => $district,
    'address' => $address,
    'phone' => $phone,
];
$loop = [
    'vltg' => "https://vieclamtheogio.timviec365.com/api/update_info_uv.php",
    'giasu' => "https://giasu.timviec365.com/api/update_info_uv.php",
    'freelancer' => "https://freelancer.timviec365.com/api/update_info_uv.php",
    'timviec365' => "https://timviec365.com/api/update_info_uv.php",
];
foreach ($loop as $key => $value) {
    call_api($value, $data_api);
}

//    ---------------------
echo json_encode($data1);
?>