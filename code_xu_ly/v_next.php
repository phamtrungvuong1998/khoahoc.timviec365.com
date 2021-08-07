<?php
require_once '../config/config.php';
$season_name = getValue('season_name','arr','POST','');
$episode_name = getValue('episode_name','arr','POST','');

$today = strtotime(date("d-m-Y"));
$time_learn = getValue('time_learn', 'int', 'POST', '0');
$course_slide = getValue('course_slide', 'int', 'POST', '0');
$price_promotional = getValue('price_promotional','int','POST','-1');
$price_listed = getValue('price_listed','int','POST','-1');
$price_discount = getValue('price_discount','int','POST','0');
$quantity_std = getValue('quantity_std','int','POST','0');
$month_study = getValue('month_study','str','POST','');


$course_describe = $_COOKIE['course_describe'];
$level_id = $_COOKIE['level_id'];
$type = $_COOKIE['type'];
if (isset($_COOKIE['new_avatar_name'])) {
    $new_avatar_name =  $_COOKIE['new_avatar_name']; 
}
$course_benefit =  $_COOKIE['course_benefit'];
$general_describe =  $_COOKIE['general_describe'];
$course_name =  $_COOKIE['course_name'];
$course_match =  $_COOKIE['course_match'];
$course_request =  $_COOKIE['course_request'];
$tag_id =  $_COOKIE['tag_id'];
$cate_id = $_COOKIE['cate_id'];
$user_id = $_COOKIE['user_id'];
$course_slug = ChangeToSlug($course_name);
if(isset($_COOKIE['certification'])){
    $certification = $_COOKIE['certification'];
}else{
    $certification = 0;
}
if(isset($_COOKIE['advantages_id'])){
    $advantages = $_COOKIE['advantages_id'];
}else{
    $advantages = 0;
}
if(isset($_COOKIE['teach'])){
    $teach = $_COOKIE['teach'];
}else{
    $teach = 0;
}
    $data = [
        'user_id'=>$user_id,
        'cate_id'=>$cate_id,
        'level_id'=>$level_id,
        'course_name'=>$course_name,
        'course_describe'=>$course_describe,
        'course_avatar'=>$new_avatar_name,
        'tag_id'=>$tag_id,
        'course_benefit'=>$course_benefit,
        'course_slug'=> $course_slug,
        'course_match'=>$course_match,
        'general_describe'=>$general_describe,
        'course_request'=>$course_request,
        'price_listed'=>$price_listed,
        'price_promotional'=>$price_promotional,
        'price_discount'=>$price_discount,
        'quantity_std'=>$quantity_std,
        'course_type'=>2,
        'certification'=>$certification,
        'advantages_id'=>$advantages,
        'time_learn'=>$time_learn,
        'course_slide'=>$course_slide,
        'month_study'=>$month_study,
        'center_teacher_id'=>$teach,
        'course_status'=>1,
        'accept'=>0,
        'course_type'=>2,
        'course_avatar'=> $new_avatar_name,
        'teacher_center'=>$type,
        'created_at'=>$today,
        'updated_at'=>$today
    ];
    add('courses', $data);
    $course_id = mysql_insert_id();

    for ($i = 0; $i < count($season_name); $i++) {
        $data_season_name = [
            'course_id'=>$course_id,
            'lesson_name'=>$season_name[$i]
        ];

        add('course_lesson', $data_season_name);
        $lesson_id = mysql_insert_id();
        $arr_episode_name = explode(",", $episode_name[$i]);
        for ($j = 0; $j < count($arr_episode_name); $j++) {
            $video = "Course" . $course_id . $_FILES["video"]['name'][0];
            $video_tmp = $_FILES["video"]['tmp_name'][0];

            $target_dir_video = "../document/video/";
            $target_file_video = $target_dir_video . basename($video);
        
            $document = "Course" . $course_id . $_FILES["document"]['name'][0];
            $document_tmp = $_FILES["document"]['tmp_name'][0];

            $target_dir_document = "../document/tailieu/";
            $target_file_document = $target_dir_document . basename($document);

            move_uploaded_file($video_tmp, $target_file_video);
            move_uploaded_file($document_tmp, $target_file_document);

            $data_episode_name = [
                'course_id'=>$course_id,
                'document'=>$document,
                'video'=>$video,
                'lesson_name'=>$arr_episode_name[$j],
                'lesson_parent'=>$lesson_id
            ];
            add('course_lesson', $data_episode_name);
            array_splice($_FILES['video']['name'], 0, 1);
            array_splice($_FILES['video']['type'], 0, 1);
            array_splice($_FILES['video']['tmp_name'], 0, 1);
            array_splice($_FILES['video']['error'], 0, 1);
            array_splice($_FILES['video']['size'], 0, 1);

            array_splice($_FILES['document']['name'], 0, 1);
            array_splice($_FILES['document']['type'], 0, 1);
            array_splice($_FILES['document']['tmp_name'], 0, 1);
            array_splice($_FILES['document']['error'], 0, 1);
            array_splice($_FILES['document']['size'], 0, 1);
            
        }
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
    $sql = new db_query("SELECT 24_course FROM users WHERE user_id = $user_id");
    $row = mysql_fetch_array($sql->result);
    $post24 = $row['24_course'];
    $whereus = [
        'user_id'=>$user_id
    ];
    if ($post24 == 0) {
        $update1 = [
            '24_course'=>1
        ];
        update('users', $update1, $whereus);
    } else {
        $post24add = $post24+1;
        $update1 = [
            '24_course'=>$post24add
        ];
        update('users', $update1, $whereus);
    }

    setcookie('level_id',$level_id,time() - 900, "/");
    setcookie('course_describe', $course_describe, time() - 900, '/');
    setcookie('course_name', $course_name, time() - 900, '/');
    setcookie('course_match', $course_match, time() - 900, '/');
    setcookie('course_benefit', $course_benefit, time() - 900, '/');
    setcookie('general_describe', $general_describe, time() - 900, '/');
    setcookie('course_request', $course_request, time() - 900, '/');
    setcookie('cate_id', $cate_id, time() - 900, '/');
    setcookie('tag_id', $tag_id, time() - 900, '/');
    setcookie('new_avatar_name', $new_avatar_name, time() - 900, '/');
    setcookie('type', $type, time() - 900, '/');
    if(isset($_COOKIE['certification'])){
        setcookie('certification', $certification, time() - 900, '/');
    }
    if(isset($_COOKIE['advantages_id'])){
        setcookie('advantages_id', $advantages, time() - 900, '/');
    }
    if(isset($_COOKIE['teach'])){
        setcookie('teach', $teach, time() - 900, '/');
    }

    $dataa = [
        'type'=>$type
    ];
    echo json_encode($dataa);
?>