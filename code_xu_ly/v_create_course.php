<?php
require_once '../config/config.php';
$user_id = $_COOKIE['user_id'];
$qr24 = new db_query("SELECT created_at FROM courses WHERE user_id = $user_id AND course_id = (SELECT MAX(course_id) FROM courses WHERE user_id = $user_id)");
$row24 = mysql_fetch_array($qr24->result);
$time1 = date("d-m-Y",$row24['created_at']);
$time2 = strtotime($time1);
if (strtotime(date("d-m-Y")) - $time2 >= 86400) {
	$data24 = [
		'24_course'=>0
	];

	$data_id = [
		'user_id'=>$user_id
	];

	add('users',$data24,$data_id);
}

if (time() > $row24['created_at'] + 30) {
	$qr = new db_query("SELECT 24_course FROM users WHERE user_id = $user_id");
	$row = mysql_fetch_array($qr->result);
	if ($row['24_course'] == 24) {
		$data = [
			'type'=>-2
		];
	}else{
		$data_time_out = [
			'24_course'=>$row['24_course'] + 1,
			'updated_at'=>strtotime(date("d-m-Y"))
		];

		$dataIdUser = [
			'user_id'=>$user_id
		];

		update('users',$data_time_out,$dataIdUser);
		$submit = getValue('submit','int','POST','');
		$course_name = getValue('course_name','str','POST','');
		$course_name_slug = ChangeToSlug($course_name);
		$qr_course_slug = new db_query("SELECT course_slug FROM courses WHERE course_slug = '$course_name_slug' AND user_id = $user_id");
		if (mysql_num_rows($qr_course_slug->result) > 0) {
			$data = [
				'type'=>0
			];
		}else{
			if ($submit == 1) {
				$course_name = getValue('course_name','str','POST','');
				$course_name_slug = ChangeToSlug($course_name);
				$qr_course_slug = new db_query("SELECT course_slug FROM courses WHERE course_slug = '$course_name_slug' AND user_id = $user_id");
				if (mysql_num_rows($qr_course_slug->result) > 0) {
					$data = [
						'type'=>0
					];
				}else{
					$cate_id = getValue('cate_id','int','POST','');
					$tag_id = getValue('tag_id','int','POST','');
					$duoi = explode('/', $_FILES['file']['type']);
					$duoi = $duoi[(count($duoi) - 1)];
					$_FILES['file']['name'] = md5(rand()) . "." . $duoi;
					move_uploaded_file($_FILES['file']['tmp_name'], '../img/course/'.$_FILES['file']['name']);
					$description = getValue('description','str','POST','');
					$get_what = getValue('get_what','str','POST','');
					$object = getValue('object','str','POST','');
					$teach = getValue('teach','int','POST','');
					$time_learn = getValue('time_learn','int','POST','');
					$slide = getValue('slide','int','POST','');
					$prices_listed = getValue('prices_listed','int','POST','-1');
					$price_promotional = getValue('price_promotional','int','POST','-1');
					$quantity_std = getValue('quantity_std','int','POST','');
					$price_discount = getValue('price_discount','int','POST','');
					$qualification = getValue('qualification','int','POST','');
					$level = getValue('level','int','POST','');
					$month_study = getValue('month_study','int','POST','');
	
					$arr_city = getValue('city','arr','POST','');
					$arr_city = explode(",", $arr_city);
					$arr_district = getValue('district','arr','POST','');
					$arr_district = explode(",", $arr_district);
					$arr_address = getValue('address','arr','POST','');
					$arr_address = explode(",", $arr_address);
					$arr_basis = getValue('basis','arr','POST','');
					$arr_basis = explode(",", $arr_basis);
					$arr_adventags = getValue('advantages_id','arr','POST','');
					if ($arr_adventags == "") {
						$arr_adventags = 0;
					}
					$addtienich = getValue('addtienich','str','POST','');
	
					$data1 = [
						'user_id'=>$user_id,
						'course_name'=>$course_name,
						'cate_id'=>$cate_id,
						'tag_id'=>$tag_id,
						'level_id'=>$level,
						'center_teacher_id'=>$teach,
						'course_describe'=>$description,
						'course_avatar'=>$_FILES['file']['name'],
						'course_learn'=>$get_what,
						'course_object'=>$object,
						'time_learn'=>$time_learn,
						'course_slide'=>$slide,
						'price_listed'=>$prices_listed,
						'price_promotional'=>$price_promotional,
						'quantity_std'=>$quantity_std,
						'price_discount'=>$price_discount,
						'certification'=>$qualification,
						'month_study'=>$month_study,
						'course_slug'=>$course_name_slug,
						'course_type'=>1,
						'teacher_center'=>3,
						'advantages_id'=>$arr_adventags,
						'created_at'=>time(),
						'updated_at'=>time()
					];
					add('courses',$data1);
	
					$course_id = mysql_insert_id();
	
					for ($i = 0; $i < count($arr_city); $i++) {
						$data2 = [
							'course_id'=>$course_id,
							'cit_id'=>$arr_city[$i],
							'district_id'=>$arr_district[$i],
							'address_name'=>$arr_basis[$i],
							'course_address'=>$arr_address[$i],
						];
						add('course_basis',$data2);
					}
	
					$qrTeacher = new db_query("SELECT * FROM user_center_teacher WHERE center_teacher_id = $teach");
					$row1 = mysql_fetch_array($qrTeacher->result);
					if ($row1['course_id'] == 0) {
						$data3 = [
							'course_id'=>$course_id
						];
						$where = [
							'center_teacher_id'=>$teach
						];
					}else{
						$arr_teacher = explode(',',$row1['course_id']);
						$arr_teacher[] = $teach;
						$center_teacher_course_id = implode(",", $arr_teacher);
						$data3 = [
							'course_id'=>$center_teacher_course_id
						];
						$where = [
							'center_teacher_id'=>$teach
						];
					}
					update('user_center_teacher',$data3,$where);
					$data = [
						'type'=>1,
						'user_id'=>$user_id
					];
				}
			}else if ($submit == 2) {
				$course_name = getValue('course_name','str','POST','');
				$course_name_slug = ChangeToSlug($course_name);
				$qr_course_slug = new db_query("SELECT course_id FROM courses WHERE course_slug = '$course_name_slug' AND user_id = $user_id");
				if (mysql_num_rows($qr_course_slug->result) > 0) {
					$data = [
						'type'=>0
					];
				}else{
					$course_describe = getValue('course_describe','str','POST','');
					$duoi = explode('/', $_FILES['file']['type']);
					$duoi = $duoi[(count($duoi) - 1)];
					$_FILES['file']['name'] = md5(rand()) . "." . $duoi;
					move_uploaded_file($_FILES['file']['tmp_name'], '../img/course/'.$_FILES['file']['name']);
					$cate_id = getValue('cate_id','int','POST','');
					$teach = getValue('teach','int','POST','');
					$course_benefit = getValue('course_benefit','str','POST','');
					$course_match = getValue('course_match','str','POST','');
					$course_request = getValue('course_request','str','POST','');
					$general_describe = getValue('general_describe','str','POST','');
					$certification = getValue('certification','int','POST','');
					$level = getValue('level','int','POST','');
					$tag_id = getValue('tag_id','int','POST','');
					$advantages_id = getValue('advantages_id','arr','POST','');
					if ($advantages_id == "") {
						$advantages = 0;
					}else{
						$advantages = $advantages_id;
					}
	
					$data1 = [
						'user_id'=>$user_id,
						'course_name'=>$course_name,
						'course_describe'=>$course_describe,
						'cate_id'=>$cate_id,
						'center_teacher_id'=>$teach,
						'course_benefit'=>$course_benefit,
						'course_match'=>$course_match,
						'course_request'=>$course_request,
						'general_describe'=>$general_describe,
						'certification'=>$certification,
						'course_avatar'=>$_FILES['file']['name'],
						'level_id'=>$level,
						'course_slug'=>$course_name_slug,
						'tag_id'=>$tag_id,
						'teacher_center'=>3,
						'course_type'=>2,
						'advantages_id'=>$advantages,
						'created_at'=>time(),
						'updated_at'=>time()
					];
					add('courses',$data1);
					$qrTeacher = new db_query("SELECT * FROM user_center_teacher WHERE center_teacher_id = $teach");
					$row1 = mysql_fetch_array($qrTeacher->result);
					if ($row1['course_id'] == 0) {
						$data3 = [
							'course_id'=>$course_id
						];
						$where = [
							'center_teacher_id'=>$teach
						];
					}else{
						$arr_teacher = explode(',',$row1['course_id']);
						$arr_teacher[] = $teach;
						$center_teacher_course_id = implode(",", $arr_teacher);
						$data3 = [
							'course_id'=>$center_teacher_course_id
						];
						$where = [
							'center_teacher_id'=>$teach
						];
					}
					update('user_center_teacher',$data3,$where);
					$data = [
						'type'=>1,
						'user_id'=>$user_id
					];
				}
			}else if ($submit == 3) {
				$course_name = getValue('course_name','str','POST','');
				$course_name_slug = ChangeToSlug($course_name);
				$qr_course_slug = new db_query("SELECT course_slug FROM courses WHERE course_slug = '$course_name_slug' AND user_id = $user_id");
				if (mysql_num_rows($qr_course_slug->result) > 0) {
					$data = [
						'type'=>0
					];
				}else{
					setcookie('course_name',$course_name,time() + 900, "/");
	
					$course_describe = getValue('course_describe','str','POST','');
					setcookie('course_describe',$course_describe,time() + 900, "/");
	
					$duoi = explode('/', $_FILES['file']['type']);
					$duoi = $duoi[(count($duoi) - 1)];
					$_FILES['file']['name'] = md5(rand()) . "." . $duoi;
					move_uploaded_file($_FILES['file']['tmp_name'], '../img/course/'.$_FILES['file']['name']);
					setcookie('new_avatar_name',$_FILES['file']['name'],time() + 900, "/");
	
					$cate_id = getValue('cate_id','int','POST','');
					setcookie('cate_id',$cate_id,time() + 900, "/");
	
					$teach = getValue('teach','int','POST','');
					setcookie('teach',$teach,time() + 900, "/");
	
					$course_benefit = getValue('course_benefit','str','POST','');
					setcookie('course_benefit',$course_benefit,time() + 900, "/");
	
					$course_match = getValue('course_match','str','POST','');
					setcookie('course_match',$course_match,time() + 900, "/");
	
					$course_request = getValue('course_request','str','POST','');
					setcookie('course_request',$course_request,time() + 900, "/");
	
					$general_describe = getValue('general_describe','str','POST','');
					setcookie('general_describe',$general_describe,time() + 900, "/");
	
					$certification = getValue('certification','int','POST','');
					setcookie('certification',$certification,time() + 900, "/");
	
					$level = getValue('level','int','POST','');
					setcookie('level_id',$level,time() + 900, "/");
	
					$tag_id = getValue('tag_id','int','POST','');
					setcookie('tag_id',$tag_id,time() + 900, "/");
					setcookie('type', 3, time() + 900, '/');
					$advantages_id = getValue('advantages_id','arr','POST','');
					if ($advantages_id == "") {
						$advantages = 0;
					}else{
						$advantages = $advantages_id;
					}
					setcookie('advantages',$advantages,time() + 900, "/");
					$data = [
						'type'=>1,
						'user_id'=>$user_id
					];
				}
			}
		}
	}
}else {
	$data = [
		'type'=> -1
	];
}
echo json_encode($data);

?>