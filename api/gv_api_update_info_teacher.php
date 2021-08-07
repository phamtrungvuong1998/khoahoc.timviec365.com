<?php
require_once 'api_info.php';
if ($user_type != 2) {
	set_error('404','Phải đăng nhập tài khoản giảng viên');
	die();
}
$user_name = getValue('user_name','str','POST','');
$user_gender = getValue('user_gender','int','POST','');
$user_birth = getValue('user_birth','str','POST','');
$user_phone = getValue('user_phone','int','POST','');
$user_mail = getValue('user_mail','str','POST','');
$cit_id = getValue('cit_id','int','POST','');
$district_id = getValue('district_id','int','POST','');
$user_address = getValue('user_address','str','POST','');
$cate_id = getValue('cate_id','arr','POST','');

$arr_cate_id = implode(",", $cate_id);

$dataId = [
	'user_id'=>$user_id
];

$data = [
	'user_name'=>$user_name,
	'user_gender'=>$user_gender,
	'user_birth'=>$user_birth,
	'user_phone'=>$user_phone,
	'user_mail'=>$user_mail,
	'cit_id'=>$cit_id,
	'district_id'=>$district_id,
	'user_address'=>$user_address,
	'cate_id'=>$arr_cate_id,
	'updated_at'=>strtotime(date("d-m-Y"))
];

update('users',$data,$dataId);

$exp_teach = getValue('exp_teach','str','POST','');//Kinh nghiệm giảng dạy
$exp_work = getValue('exp_work','str','POST','');//Kinh nghiệm làm việc
$qualification = getValue('qualification','str','POST','');//Bằng cấp chứng chỉ
$current_position = getValue('current_position','str','POST','');//Chức vụ hiện tại
$current_company = getValue('current_company','str','POST','');//Công ty hiện tại

$data1 = [
	'exp_teach'=>$exp_teach,
	'exp_work'=>$exp_teach,
	'qualification'=>$qualification,
	'current_position'=>$current_position,
	'current_company'=>$current_company
];


update('user_teach_experience',$data,$data1);

$link_lecture_online = getValue('link_lecture_online','str','POST','');
$link_student_community = getValue('link_student_community','str','POST','');

$data2 = [
	'link_student_community'=>$link_student_community,//Link cộng đồng học viên
	'link_lecture_online'=>$link_lecture_online //Link bài giảng học viên
];

update('user_teach_cooperation',$data2,$dataId);

$data3 = [
	'result'=>true
];

success('Cập nhật thành công',$data3);
?>
