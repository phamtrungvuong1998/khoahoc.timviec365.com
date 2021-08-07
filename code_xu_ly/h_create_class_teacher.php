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
            'type'=>-1
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
        $course_name = getValue('course_name','str','POST','');
        $course_name_slug = ChangeToSlug($course_name);
        $qr_course_slug = new db_query("SELECT course_slug FROM courses WHERE course_slug = '$course_name_slug' AND user_id = $user_id");
        if (mysql_num_rows($qr_course_slug->result) > 0) {
            $data = [
                'type'=>0
            ];
        }else{
            $submit = getValue('submit','int','POST','');
            if ($submit == 1) {
                $cate_id = getValue('cate_id','int','POST','');
                $tag_id = getValue('tag_id','int','POST','');
                $duoi = explode('/', $_FILES['file']['type']);
                $duoi = $duoi[(count($duoi) - 1)];
                $_FILES['file']['name'] = md5(rand()) . "." . $duoi;
                move_uploaded_file($_FILES['file']['tmp_name'], '../img/course/'.$_FILES['file']['name']);
                $course_describe = getValue('course_describe','str','POST','');
                $course_learn = getValue('course_learn','str','POST','');
                $course_object = getValue('course_object','str','POST','');
                $time_learn = getValue('time_learn','int','POST','');
                $course_slide = getValue('course_slide','int','POST','');
                $price_listed = getValue('price_listed','int','POST','-1');
                $price_promotional = getValue('price_promotional','int','POST','-1');
                $quantity_std = getValue('quantity_std','int','POST','');
                $price_discount = getValue('price_discount','int','POST','');
                $level_id = getValue('level_id','int','POST','');
                $month_study = getValue('month_study','int','POST','');
                $cit_id = getValue('cit_id','int','POST','');
                $district_id = getValue('district_id','int','POST','');
                $course_address = getValue('course_address','str','POST','');

                $data1 = [
                    'user_id'=>$user_id,
                    'cate_id'=>$cate_id,
                    'tag_id'=>$tag_id,
                    'level_id'=>$level_id,
                    'course_describe'=>$course_describe,
                    'course_name'=>$course_name,
                    'course_avatar'=>$_FILES['file']['name'],
                    'course_learn'=>$course_learn,
                    'course_object'=>$course_object,
                    'time_learn'=>$time_learn,
                    'course_slide'=>$course_slide,
                    'price_listed'=>$price_listed,
                    'price_promotional'=>$price_promotional,
                    'quantity_std'=>$quantity_std,
                    'price_discount'=>$price_discount,
                    'teacher_center'=>2,
                    'course_type'=>1,
                    'month_study'=>$month_study,
                    'course_slug'=>$course_name_slug,
                    'created_at'=>time(),
                    'updated_at'=>time()
                ];

                add('courses',$data1);
                $course_id = mysql_insert_id();

                $data = [
                    'type'=>1,
                    'user_id'=>$user_id
                ];

                $data1 = [
                    'course_id'=>$course_id,
                    'cit_id'=>$cit_id,
                    'district_id'=>$district_id,
                    'course_address'=>$course_address
                ];

                add('course_basis',$data1);

            }else if ($submit == 2) {
                $cate_id = getValue('cate_id','int','POST','');
                $tag_id = getValue('tag_id','int','POST','');
                $duoi = explode('/', $_FILES['file']['type']);
                $duoi = $duoi[(count($duoi) - 1)];
                $_FILES['file']['name'] = md5(rand()) . "." . $duoi;
                move_uploaded_file($_FILES['file']['tmp_name'], '../img/course/'.$_FILES['file']['name']);

                $course_describe = getValue('course_describe','str','POST','');
                $course_benefit = getValue('course_benefit','str','POST','');
                $course_match = getValue('course_match','str','POST','');
                $course_request = getValue('course_request','str','POST','');
                $general_describe = getValue('general_describe','str','POST','');
                $level_id = getValue('level_id','int','POST','');

                $data1 = [
                    'user_id'=>$_COOKIE['user_id'],
                    'cate_id'=>$cate_id,
                    'tag_id'=>$tag_id,
                    'course_name'=>$course_name,
                    'course_avatar'=>$_FILES['file']['name'],
                    'course_describe'=>$course_describe,
                    'course_benefit'=>$course_benefit,
                    'course_match'=>$course_match,
                    'course_request'=>$course_request,
                    'general_describe'=>$general_describe,
                    'course_type'=>2,
                    'teacher_center'=>2,
                    'course_slug'=>$course_name_slug,
                    'accept'=>0,
                    'level_id'=>$level_id,
                    'created_at'=>time(),
                    'updated_at'=>time()
                ];

                add('courses',$data1);

                $data = [
                    'type'=>1,
                    'user_id'=>$user_id
                ];
            }else if ($submit == 3) {
                $data = [
                    'type'=>1,
                    'user_id'=>$_COOKIE['user_id']
                ];
                setcookie('course_name',$course_name,time() + 900,'/');
                setcookie('course_slug',$course_name_slug,time() + 900,'/');
                $cate_id = getValue('cate_id','int','POST','');
                setcookie('cate_id',$cate_id,time() + 900,'/');

                $tag_id = getValue('tag_id','int','POST','');
                setcookie('tag_id',$tag_id,time() + 900,'/');
                setcookie('teacher_center',2,time() + 900,'/');
                $duoi = explode('/', $_FILES['file']['type']);
                $duoi = $duoi[(count($duoi) - 1)];
                $_FILES['file']['name'] = md5(rand()) . "." . $duoi;
                move_uploaded_file($_FILES['file']['tmp_name'], '../img/course/'.$_FILES['file']['name']);
                setcookie('new_avatar_name',$_FILES['file']['name'], time() + 900,'/');
                setcookie('type',2, time() + 900,'/');
                $course_describe = getValue('course_describe','str','POST','');
                setcookie('course_describe',$course_describe,time() + 900,'/');

                $course_benefit = getValue('course_benefit','str','POST','');
                setcookie('course_benefit',$course_benefit,time() + 900,'/');

                $course_match = getValue('course_match','str','POST','');
                setcookie('course_match',$course_match,time() + 900,'/');

                $course_request = getValue('course_request','str','POST','');
                setcookie('course_request',$course_request,time() + 900,'/');

                $general_describe = getValue('general_describe','str','POST','');
                setcookie('general_describe',$general_describe,time() + 900,'/');

                $level_id = getValue('level_id','int','POST','');
                setcookie('level_id',$level_id,time() + 900,'/');
            }
        }
    }
}else{
    $data = [
        'type'=> -2
    ];
}

echo json_encode($data);

?>