<?php
require_once '../config/config.php';
$student_name = getValue('student_name','str','POST','');
$student_email = getValue('student_email','str','POST','');
$student_phone = getValue('student_phone','str','POST','');
$student_city = getValue('student_city','int','POST','');
$student_district = getValue('student_district','int','POST','');
$student_address = getValue('student_address','str','POST','');
$student_cate = getValue('student_cate','arr','POST','');
if ($student_cate == '') {
	$cate_id = 0;
}else{
	$cate_id = implode(",", $student_cate);
}


$dataId = [
	'user_id'=>$_COOKIE['student_id']
];

$data = [
	'user_name'=>$student_name,
	'user_mail'=>$student_email,
	'user_phone'=>$student_phone,
	'cit_id'=>$student_city,
	'district_id'=>$student_district,
	'user_address'=>$student_address,
	'cate_id'=>$cate_id
];

update('users',$data,$dataId);
header("Location: /Admin/admin_list_sudent.php");
?>