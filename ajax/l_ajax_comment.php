<?php
include '../config/config.php';
$user_id = $_COOKIE['user_id'];
$id = getValue('id','str','POST','','');
$student = getValue('student','str','POST','','');
$course = getValue('course','str','POST','','');
$value = getValue('value','str','POST','','');
if($id != ''&&$student!=''&& $course!=''&& $value!=''){
    $data = [
        'user_student_id'=> $user_id,
        'course_id'=> $course,
        'rate_id'=> $id,
        'comment_rep'=>$value
    ];
    add('rep_rate_course',$data);
    $message = [
        'result'=>true,
        'message'=> 'Đã trả lời',
    ];
}
else{
    $message = [
        'result'=>false,
        'message'=> 'Lỗi',
    ];
}

echo json_encode($message);