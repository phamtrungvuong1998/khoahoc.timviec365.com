<?php
require_once "api_info.php";
$token_course_id = getValue('token_course_id','str','GET','');
$token_decode = JWT::decode($token_course_id,$key,['HS256']);
$course_id = $token_decode->course_id;
$season_name = getValue('season_name','arr','POST','');
$episode_name = getValue('episode_name','arr','POST','');

$today = time();
$time_learn = getValue('time_learn', 'int', 'POST', '0');
$course_slide = getValue('course_slide', 'int', 'POST', '0');
$price_promotional = getValue('price_promotional','int','POST','0');
$price_listed = getValue('price_listed','int','POST','0');
$price_discount = getValue('price_discount','int','POST','0');
$quantity_std = getValue('quantity_std','int','POST','0');
$month_study = getValue('month_study','str','POST','');

$dataId = [
    'course_id'=>$course_id
];
$data = [
    'price_listed'=>$price_listed,
    'price_promotional'=>$price_promotional,
    'price_discount'=>$price_discount,
    'quantity_std'=>$quantity_std,
    'month_study'=>$month_study,
    'updated_at'=>$today
];
update('courses',$data,$dataId);


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

$data2 = [
    'result'=>1
];
success('Tạo khóa học online thành công',$data2);
?>