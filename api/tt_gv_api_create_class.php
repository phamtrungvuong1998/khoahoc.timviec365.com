<?php
require_once "api_info.php";
$qr24 = new db_query("SELECT created_at FROM courses WHERE user_id = $user_id AND course_id = (SELECT MAX(course_id) FROM courses WHERE user_id = $user_id)");
$row24 = mysql_fetch_array($qr24->result);
$course_name = getValue('course_name','str','POST','');
$cate_id = getValue('cate_id','int','POST','');
$tag_id = getValue('tag_id','int','POST','');
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

if (time() > $row24['created_at'] + 1200) {
    $qr = new db_query("SELECT 24_course FROM users WHERE user_id = $user_id");
    $row = mysql_fetch_array($qr->result);
    if ($row['24_course'] == 24) {
        set_error('404','Tạo quá số lượng tin đăng trong 1 ngày'); // 1 ngày chỉ được tạo 24 tin
    }else{
        $data_time_out = [
            '24_course'=>$row['24_course'] + 1,
            'updated_at'=>strtotime(date("d-m-Y"))
        ];

        $dataIdUser = [
            'user_id'=>$user_id
        ];
        update('users',$data_time_out,$dataIdUser);
        $course_type = getValue('course_type','int','POST','');
        if($course_type == 1){
            $course_name = getValue('course_name','str','POST','');
            $course_name_slug = ChangeToSlug($course_name);
            $qr_course_slug = new db_query("SELECT course_slug FROM courses WHERE course_slug = '$course_name_slug' AND user_id = $user_id");
            if (mysql_num_rows($qr_course_slug->result) > 0) {
                set_error('404','Tên khóa học đã tồn tại');
            }else{
                $duoi = explode('/', $_FILES['file']['type']);
                $duoi = $duoi[(count($duoi) - 1)];

                $_FILES['file']['name'] = md5(rand()) . '.' . $duoi;

                $course_describe = getValue('course_describe','str','POST',''); //Mô tả khóa học
                $course_learn = getValue('course_learn','str','POST',''); //Bạn sẽ học những gì
                $center_teacher_id = getValue('center_teacher_id','int','POST',''); //Giảng viên giảng dạy
                $time_learn = getValue('time_learn','int','POST',''); //Số buổi học
                $course_slide = getValue('course_slide','int','POST',''); //Số tài liệu học
                $price_listed = getValue('price_listed','int','POST',''); //Giá gốc
                $price_promotional = getValue('price_promotional','int','POST',''); //Giá khuyến mại

                $quantity_std = getValue('quantity_std','int','POST',''); //Số lượng học viên
                $price_discount = getValue('price_discount','int','POST',''); //Giá khóa học mua chung
                $certification = getValue('certification','int','POST',''); //chứng chỉ
                $level = getValue('level','int','POST',''); //Trình độ
                $month_study = getValue('month_study','int','POST',''); //Thời gian học

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
                $course_id = mysql_insert_id();
                for ($i = 0; $i < count($arr_city); $i++) {
                    $data2 = [
                        'course_id'=>$course_id,
                        'cit_id'=>$arr_city[$i],
                        'district_id'=>$arr_district[$i],
                        'address_name'=>$arr_address[$i],
                        'course_address'=>$arr_basis[$i],
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
                    'result'=>1
                ]; 
                success('Tạo khóa học offline thành công',$data);
            }
        }else if ($course_type == 2) {
            $course_name = getValue('course_name','str','POST','');
			$course_name_slug = ChangeToSlug($course_name);
			$qr_course_slug = new db_query("SELECT course_id FROM courses WHERE course_slug = '$course_name_slug' AND user_id = $user_id");
			if (mysql_num_rows($qr_course_slug->result) > 0) {
				set_error('404','Tên khóa học đã tồn tại');
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
                $course_id = mysql_insert_id();
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
                $data_course_id = [
                    'course_id'=>$course_id
                ];
                $token_course_id = JWT::encode($data_course_id,$key);
                $data = [
                    'result'=>1,
                    'token_course_id'=>$token_course_id

                ];
				success('Tới bước 2',$data);
            }
        }
    }
}else{
    set_error('404','Tạo khóa học sau 20 phút nữa');
}
?>