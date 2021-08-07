<?php
require_once '../config/config.php';

$course_id = getValue('course_id','int','POST','');
$course_name = getValue('course_name','str','POST','');

$course_name_slug = ChangeToSlug($course_name);
$qr_slug = new db_query("SELECT course_slug FROM courses WHERE course_id != $course_id AND course_slug = '$course_name_slug'");

if (mysql_num_rows($qr_slug->result) > 0) {
    $data = [
        'type'=>0
    ];
}else{
    $submit = getValue('submit','int','POST','');
    $dataId = [
        'course_id'=>$course_id
    ];
    if ($submit == 1) {
        $cate_id = getValue('cate_id','int','POST','');
        $tag_id = getValue('tag_id','int','POST','');
        if (isset($_FILES['file'])) {
            $qr_file = new db_query("SELECT course_avatar FROM courses WHERE course_id = $course_id");
            $row_file = mysql_fetch_array($qr_file->result);
            unlink("../img/course/" . $row_file['course_avatar']);
            $duoi = explode('/', $_FILES['file']['type']);
            $duoi = $duoi[(count($duoi) - 1)];
            $_FILES['file']['name'] = md5(rand()) . "." . $duoi;
            move_uploaded_file($_FILES['file']['tmp_name'], '../img/course/'.$_FILES['file']['name']);
            $data_file = [
                'course_avatar'=>$_FILES['file']['name']
            ];

            update('courses',$data_file,$dataId);
        }

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
            'cate_id'=>$cate_id,
            'tag_id'=>$tag_id,
            'level_id'=>$level_id,
            'course_describe'=>$course_describe,
            'course_name'=>$course_name,
            'course_learn'=>$course_learn,
            'course_object'=>$course_object,
            'time_learn'=>$time_learn,
            'course_slide'=>$course_slide,
            'price_listed'=>$price_listed,
            'price_promotional'=>$price_promotional,
            'quantity_std'=>$quantity_std,
            'price_discount'=>$price_discount,
            'month_study'=>$month_study,
            'updated_at'=>time()
        ];

        update('courses',$data1,$dataId);

        $data2 = [
            'cit_id'=>$cit_id,
            'district_id'=>$district_id,
            'course_address'=>$course_address
        ];

        update('course_basis',$data2,$dataId);

        $data = [
            'type'=>1,
            'user_id'=>$_COOKIE['user_id']
        ];
    }else if ($submit == 2) {
        $cate_id = getValue('cate_id','int','POST','');
        $tag_id = getValue('tag_id','int','POST','');

        if (isset($_FILES['file'])) {
            $qr_file = new db_query("SELECT course_avatar FROM courses WHERE course_id = $course_id");
            $row_file = mysql_fetch_array($qr_file->result);
            unlink("../img/course/" . $row_file['course_avatar']);
            $duoi = explode('/', $_FILES['file']['type']);
            $duoi = $duoi[(count($duoi) - 1)];
            $_FILES['file']['name'] = md5(rand()) . "." . $duoi;
            move_uploaded_file($_FILES['file']['tmp_name'], '../img/course/'.$_FILES['file']['name']);
            $data_file = [
                'course_avatar'=>$_FILES['file']['name']
            ];

            update('courses',$data_file,$dataId);
        }

        $course_describe = getValue('course_describe','str','POST','');
        $course_benefit = getValue('course_benefit','str','POST','');
        $course_match = getValue('course_match','str','POST','');
        $course_request = getValue('course_request','str','POST','');
        $general_describe = getValue('general_describe','str','POST','');
        $level_id = getValue('level_id','int','POST','');

        $data1 = [
            'course_name'=>$course_name,
            'cate_id'=>$cate_id,
            'tag_id'=>$tag_id,
            'course_describe'=>$course_describe,
            'course_benefit'=>$course_benefit,
            'course_match'=>$course_match,
            'course_request'=>$course_request,
            'general_describe'=>$general_describe,
            'level_id'=>$level_id
        ];

        update('courses',$data1,$dataId);

        $data = [
            'type'=>1,
            'user_id'=>$_COOKIE['user_id']
        ];
    }else if ($submit == 3) {
        setcookie('course_name',$course_name,time() + 900,'/');

        $cate_id = getValue('cate_id','int','POST','');
        setcookie('cate_id',$cate_id,time() + 900,'/');

        $tag_id = getValue('tag_id','int','POST','');
        setcookie('tag_id',$tag_id,time() + 900,'/');

        if (isset($_FILES['file'])) {
            $qr_file = new db_query("SELECT course_avatar FROM courses WHERE course_id = $course_id");
            $row_file = mysql_fetch_array($qr_file->result);
            unlink("../img/course/" . $row_file['course_avatar']);
            $duoi = explode('/', $_FILES['file']['type']);
            $duoi = $duoi[(count($duoi) - 1)];
            $_FILES['file']['name'] = md5(rand()) . "." . $duoi;
            move_uploaded_file($_FILES['file']['tmp_name'], '../img/course/'.$_FILES['file']['name']);
            $data_file = [
                'course_avatar'=>$_FILES['file']['name']
            ];

            update('courses',$data_file,$dataId);
        }

        $course_describe = getValue('course_describe','str','POST','');
        setcookie('course_describe',$course_describe,time() + 900,'/');

        setcookie('type',2,time() + 900,'/');

        $course_benefit = getValue('course_benefit','str','POST','');
        setcookie('course_benefit',$course_benefit,time() + 900,'/');

        $course_match = getValue('course_match','str','POST','');
        setcookie('course_match',$course_match,time() + 900,'/');

        $course_request = getValue('course_request','int','POST','');
        setcookie('course_request',$course_request,time() + 900,'/');

        $general_describe = getValue('general_describe','int','POST','');
        setcookie('general_describe',$general_describe,time() + 900,'/');

        $level_id = getValue('level_id','int','POST','');
        setcookie('level_id',$level_id,time() + 900,'/');

        $data = [
            'type'=>1,
            'user_id'=>$_COOKIE['user_id'],
            'course_id'=>$course_id
        ];
    }
}

echo json_encode($data);

?>