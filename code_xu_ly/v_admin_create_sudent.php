<?php 
require_once '../config/config.php';
$student_name = getValue('student_name','str','POST','');
$student_email = getValue('student_email','str','POST','');
$student_phone = getValue('student_phone','str','POST','');
$student_city = getValue('student_city','int','POST','');
$student_district = getValue('student_district','int','POST','');
$student_address = getValue('student_address','str','POST','');
$student_gender = getValue('student_gender','int','POST','');
$student_birth = getValue('student_birth','str','POST','');
$student_cate = getValue('student_cate','arr','POST','');
$student_pass = getValue('student_pass','str','POST','');

$cate_id = implode(",", $student_cate);

$data = [
	'cit_id'=>$student_city,
	'district_id'=>$student_district,
	'cate_id'=>$cate_id,
	'user_name'=>$student_name,
	'user_mail'=>$student_email,
	'user_phone'=>$student_phone,
	'user_pass'=>md5($student_pass),
	'user_address'=>$student_address,
	'user_gender'=>$student_gender,
	'user_birth'=>$student_birth,
	'user_slug'=>ChangeToSlug($student_name),
	'user_type'=>1,
	'user_active'=>1,
	'created_at'=>strtotime(date("d-m-Y")),
	'updated_at'=>strtotime(date("d-m-Y"))
];

add('users',$data);
header("Location: /Admin/admin_create_student.php");
?>