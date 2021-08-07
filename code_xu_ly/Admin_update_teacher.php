<?php
require_once '../config/config.php';

	$teacher_name = getValue('teacher_name','str','POST','');
	$teacher_email = getValue('teacher_email','str','POST','');
	$teacher_phone = getValue('teacher_phone','str','POST','');
	$teacher_city = getValue('teacher_city','int','POST','');
	$teacher_district = getValue('teacher_district','int','POST','');
	$teacher_address = getValue('teacher_address','str','POST','');
	$teacher_cate = getValue('teacher_cate','arr','POST','');
	$teacher_gender = getValue('teacher_gender','int','POST','');
	$teacher_birth = getValue('teacher_birth','str','POST','');
	$cate_id = implode(",", $teacher_cate);
	$today = strtotime(date("d-m-Y"));

	$dataId = [
		'user_id'=>$_COOKIE['teacher_id']
	];

	$data = [
		'user_name'=>$teacher_name,
		'user_mail'=>$teacher_email,
		'user_phone'=>$teacher_phone,
		'user_gender'=>$teacher_gender,
		'user_birth'=>$teacher_birth,
		'cit_id'=>$teacher_city,
		'district_id'=>$teacher_district,
		'user_address'=>$teacher_address,
		'cate_id'=>$cate_id,
		'updated_at'=>$today
	];

	update('users',$data,$dataId);

	$current_position = getValue('current_position', 'str', 'POST', '');
	$current_company = getValue('current_company', 'str', 'POST', '');
	$exp_work = getValue('exp_work', 'str', 'POST', '');
	$exp_teach = getValue('exp_teach', 'str', 'POST', '');
	$qualification = getValue('qualification', 'str', 'POST', '');

	$data2= [
			'current_position'=>$current_position,
			'current_company'=>$current_company,
			'exp_work'=>$exp_work,
			'exp_teach'=>$exp_teach,
			'qualification'=>$qualification,
		];
	update('user_teach_experience', $data2,$dataId);

	$link_lecture_online = getValue('link_lecture_online', 'str', 'POST', '');
	$link_student_community = getValue('link_student_community', 'str', 'POST', '');

	$data3= [
			'link_lecture_online'=>$link_lecture_online,
			'link_student_community'=>$link_student_community,
		];
	update('user_teach_cooperation', $data3,$dataId);

	header("Location: /Admin/admin_list_teacher.php");
?>