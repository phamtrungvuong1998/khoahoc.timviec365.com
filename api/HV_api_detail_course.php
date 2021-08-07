<?php
// require_once 'api_info.php';
require_once '../config/config.php';
include_once 'functions.php';
use Firebase\JWT\JWT;
$course_id = getValue('course_id','int','POST','');
$qr = new db_query("SELECT *,courses.cate_id FROM courses INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE course_id = $course_id");

$row = mysql_fetch_array($qr->result);


$qrCourse_epison = new db_query("SELECT * FROM course_lesson WHERE course_id = $course_id AND lesson_parent != 0");

$qrCourse_seasion = new db_query("SELECT * FROM course_lesson WHERE course_id = $course_id AND lesson_parent = 0");

$data_seasion = [];
$data_lesson = [];
$i = 1;
while($row_seasion = mysql_fetch_array($qrCourse_seasion->result)){
    $data_seasion[$i]['lesson_name'] = $row_seasion['lesson_name'];
    $data_lesson[$row_seasion['lesson_id']] = $row_seasion['lesson_name'];
    $i++;
}
$j = 1;
$data_lesson2 = [];
foreach ($data_lesson as $key => $value) {
    $qr_epison = new db_query("SELECT * FROM course_lesson WHERE lesson_parent = $key");
    while($row_epison = mysql_fetch_array($qr_epison->result)){
        $data_lesson2[$key] = [
            'seasion_name'=>$value
        ];
        $data_lesson2[$key]['epison' . $j] = [
            'epison'=>$row_epison['lesson_name'],
            'video'=>$row_epison['video'],
            'document'=>$row_epison['document']
        ];
    }
    $j++;
}

$qrOrder = new db_query("SELECT order_id FROM orders WHERE course_id = $course_id");
$qrCommon = new db_query("SELECT order_student_id FROM order_student_common WHERE course_id = $course_id");

$data['detail_course'] = [];

//Khóa học liên quan
$dataCare = [];
$k = 1;
$qrCare = new db_query("SELECT * FROM courses WHERE course_id != $course_id AND cate_id = " . $row['cate_id']);

while($rowCare = mysql_fetch_array($qrCare->result)){
    $dataCare[$k]['course_id'] = $rowCare['course_id']; 
    $dataCare[$k]['course_name'] = $rowCare['course_name']; 
    $dataCare[$k]['price_listed'] = $rowCare['price_listed'];
    $dataCare[$k]['price_promotional'] = $rowCare['price_promotional']; 
    $k++;
}

//Người dạy
$dataTeach = [];
if ($row['user_type'] == 2) {
    $qrExp = new db_query("SELECT * FROM user_teach_experience WHERE user_id = " . $row['user_id']);
    $rowExp = mysql_fetch_array($qrExp->result);
    $dataTeach = [
        'info'=>$rowExp['current_position'] . ' ' . $rowExp['current_company'],
        'expWord'=>$rowExp['exp_work'],
        'exp_teach'=>$rowExp['exp_teach']
    ];
}else if ($row['user_type'] == 3){
    $qrExp = new db_query("SELECT * FROM user_center_teacher WHERE center_teacher_id = " . $row['center_teacher_id']);
    $rowExp = mysql_fetch_array($qrExp->result);
    $dataTeach = [
        'info'=>$rowExp['qualification']
    ];
}
//Đánh giá từ học viên
$dataRate = [];
$qrRate = new db_query("SELECT * FROM rate_course INNER JOIN users ON rate_course.user_student_id = users.user_id WHERE course_id = $course_id ORDER BY rate_id DESC");
$video = 0;
$lesson = 0;
$teacher = 0;
$total_rate = 0;
$t = 1;
$data_detail_rate = [];
if ($row['course_type'] == 1) {
    while($rowRate = mysql_fetch_array($qrRate->result)){
        $lesson = $lesson + $rowRate['lesson'];
        $teacher = $teacher + $rowRate['teacher'];
        $total_rate = $total_rate + ($lesson + $teacher)/2;
        $data_detail_rate[$t]['user_student_name'] = $rowRate['user_name'];//Tên học viên
        $data_detail_rate[$t]['user_student_avatar'] = $rowRate['user_avatar'];//avatar
        $data_detail_rate[$t]['user_student_rate'] = ($lesson + $teacher)/2;//Tổng đánh giá
        $data_detail_rate[$t]['user_student_comment'] = $rowRate['comment_rate'];//Nội dung commmet
        $data_detail_rate[$t]['day_comment'] = $rowRate['updated_at'];//Thời gian commet
        $t++;
    }
    $lesson = $lesson/mysql_num_rows($qrRate->result);
    $teacher = $teacher/mysql_num_rows($qrRate->result);
    $total_rate = $total_rate/mysql_num_rows($qrRate->result);
    $dataRate = [
        'rate'=>[
            'lesson'=>round($lesson,1),
            'teacher'=>round($teacher,1),
            'total_rate'=>$total_rate
        ],
        'rate_detail'=>$data_detail_rate
    ];
}else{
    while($rowRate = mysql_fetch_array($qrRate->result)){
        $video = $video + $rowRate['video'];
        $lesson = $lesson + $rowRate['lesson'];
        $teacher = $teacher + $rowRate['teacher'];
        $total_rate = $total_rate + ($video + $lesson + $teacher)/3;
        $data_detail_rate[$t]['user_student_name'] = $rowRate['user_name'];//Tên học viên
        $data_detail_rate[$t]['user_student_avatar'] = $rowRate['user_avatar'];//avatar
        $data_detail_rate[$t]['user_student_rate'] = ($lesson + $teacher + $video)/3;//Tổng đánh giá
        $data_detail_rate[$t]['user_student_comment'] = $rowRate['comment_rate'];//Nội dung commmet
        $data_detail_rate[$t]['day_comment'] = $rowRate['updated_at'];//Thời gian commet
        $t++;
    }
    $video = $video/mysql_num_rows($qrRate->result);
    $lesson = $lesson/mysql_num_rows($qrRate->result);
    $teacher = $teacher/mysql_num_rows($qrRate->result);
    $total_rate = $total_rate/mysql_num_rows($qrRate->result);
    $dataRate = [
        'rate'=>[
            'video'=>round($video,1),
            'lesson'=>round($lesson,1),
            'teacher'=>round($teacher,1),
            'total_rate'=>$total_rate
        ],
        'rate_detail'=>$data_detail_rate
    ];
}


$data['detail_course']['price_listed'] = $row['price_listed'];//Giá gốc
$data['detail_course']['price_promotional'] = $row['price_promotional'];//Giá khuyến mại
$data['detail_course']['course_avatar'] = $row['course_avatar'];//Ảnh khóa học
$data['detail_course']['course_name'] = $row['course_name'];//Tên khóa học
$data['detail_course']['course_signup'] = mysql_num_rows($qrOrder->result) + mysql_num_rows($qrCommon->result);//Số người đăng kí
$data['detail_course']['count_course_lesson'] = mysql_num_rows($qrCourse_epison->result);//Số bài học
$data['detail_course']['time_learn'] = $row['time_learn'];//Số buổi học
$data['detail_course']['categories'] = $row['cate_name'];//Môn học
$data['detail_course']['count_document'] = mysql_num_rows($qrCourse_epison->result);//Số tài liệu
$data['detail_course']['created_at'] = date("d-m-Y", $row['created_at']);//Ngày tạo
$data['detail_course']['content'] = [
    'course_learn'=>$row['course_learn'],//Bạn sẽ học những gì
    'course_object'=>$row['course_object'],//Đối tượng học viên
    'course_describe'=>$row['course_describe'],//Giới thiệu khóa học
    'content_course'=>$data_seasion,//Nội dung khóa học
    'course_request'=>$row['course_request'],//Yêu cầu khóa học
];
$data['detail_course']['teach'] = $dataTeach; //Người dạy

$data['detail_course']['learn'] = $data_lesson2;//Bài học

$data['detail_course']['course_care'] = $dataCare; //Khóa học liên quan

$data['detail_course']['rate_course'] = $dataRate; //Đánh giá từ học viên


success('',$data);

?>