<?php
require_once 'api_info.php';
if ($user_type != 2) {
	set_error('404','Phải đăng nhập tài khoản giảng viên');
	die();
}

$qr = new db_query("SELECT * FROM users INNER JOIN user_teach_experience ON users.user_id = user_teach_experience.user_id WHERE user_id = $user_id");

$rowTeach = mysql_fetch_array($qr->result);
if ($rowTeach['user_gender'] == 1) {
	$gender = 'Nam';
}else if($rowTeach['user_gender'] == 2) {
	$gender = 'Nữ';
}
if ($rowTeach['cit_id'] != 0) {
	$qrCit = new db_query("SELECT * FROM city WHERE cit_id = " . $rowTeach['cit_id']);
	$rowCit = mysql_fetch_array($qrCit->result);
	$city = $rowCit['cit_name'];
}else{
	$city = 0;
}

if ($rowTeach['district_id'] != 0) {
	$qrCit = new db_query("SELECT * FROM city WHERE cit_parent = " . $rowTeach['cit_id']);
	$rowDistrict = mysql_fetch_array($qrCit->result);
	$district = $rowCit['cit_name'];
}else{
	$district = 0;
}

$arr_cate = explode(",", $rowTeach['cate_id']);

$cate_name = '';
for ($i = 0; $i < count($arr_cate); $i++) {
	$qrCate = new db_query("SELECT * FROM categories WHERE cate_id = " . $arr_cate[$i]);
	$rowCate = mysql_fetch_array($qrCate->result);
	if ($i == count($arr_cate) - 1) {
		$cate_name = $cate_name . $rowCate['cate_name'];
	}else{
		$cate_name = $cate_name . $rowCate['cate_name'] . ",";
	}
}

$dataTeach = [
	'teacher_name'=>$rowTeach['user_name'],//Tên giảng viên
	'teacher_gender'=>$gender,//Giới tính
	'teacher_birth'=>$rowTeach['user_birth'],//Ngày sinh
	'teacher_phone'=>$rowTeach['user_phone'],//Phone
	'teacher_email'=>$rowTeach['user_mail'],//Email
	'teacher_city'=>$city,//Tỉnh, thành phố
	'teacher_district'=>$district,//Quận, huyện
	'teacher_address'=>$rowTeach['user_address'],//Địa chỉ
	'teacher_exp_teach'=>$rowTeach['exp_teach'],//Kinh nghiêm giảng dạy
	'teacher_exp_work'=>$rowTeach['exp_work'],//Kinh nghiệm làm việc
	'teacher_qualification'=>$rowTeach['qualification'],//Bằng cấp chứng chỉ
	'teacher_current_position'=>$rowTeach['current_position'],//Chức vụ hiện tại
	'teacher_current_company'=>$rowTeach['current_company'],//Công ty hiện tại
	'teacher_link_student_community'=>$rowTeach['link_student_community'],//Link cộng đồng học viên
	'teacher_link_lecture_online'=>$rowTeach['link_lecture_online'],//Link bài giảng online
	'teacher_cate'=>$cate_name
];

success("",$dataTeach);
?>