<?php
require_once '../config/config.php';
$rate_id = getValue('rate_id','int','POST','');
$course_id = getValue('course_id','int','POST','');

$user_id = $_COOKIE['user_id'];

$qrDel = new db_query("DELETE FROM rate_course WHERE rate_id = $rate_id");
$qrDelRep = new db_query("DELETE FROM rep_rate_course WHERE rate_id = $rate_id");

$v_lesson = 0;
$v_video = 0;
$v_teacher = 0;
$average = 0;

$qrComment =  new db_query("SELECT * FROM rate_course WHERE course_id = $course_id ORDER BY rate_id DESC");
//Lấy tổng số lượt đánh giá
$sumRate = mysql_num_rows($qrComment->result);

$qrType = new db_query("SELECT course_type FROM courses WHERE course_id = $course_id");
$rowType = mysql_fetch_array($qrType->result);

//In ra đánh giá của học viên

$qrrate = new db_query("SELECT Count(*) as total FROM rate_course WHERE course_id = $course_id");
$rowcount=mysql_fetch_array($qrrate->result);
$numrate = $rowcount['total'];

$qrsum = new db_query("SELECT sum(lesson),sum(video),sum(teacher),(sum(lesson)+sum(video)+sum(teacher)) FROM rate_course WHERE course_id = $course_id");

if ($numrate == 0) {
    $numrate = 1;
}
$rowsum = mysql_fetch_array($qrsum->result);
$sumlesson =  $rowsum['sum(lesson)']/$numrate;
$sumteacher =  $rowsum['sum(teacher)']/$numrate;
$sumvideo =  $rowsum['sum(video)']/$numrate;
$total_rate = ($rowsum['(sum(lesson)+sum(video)+sum(teacher))']/3)/$numrate;


//Lấy tổng số đánh giá khóa học
$rate_star = '';
for ($i=1; $i <= 5; $i++) { 
    if ($i <= $total_rate) {
        $rate_star = $rate_star . '<img width="20px" height="20px" class=" lazyloaded" src="../img/image/star.svg" data-src="../img/image/star1.svg">';
    }else{
        $rate_star = $rate_star . '<img width="20px" height="20px" class=" lazyloaded" src="../img/image/star1.svg" data-src="../img/image/star1.svg">';
    }
}


//Lấy đánh giá chi tiết bài giảng, video, giảng viên

//Lesson
$rate_lesson = '';
$v_sumlesson = $sumlesson*10;
$rate_lesson = $rate_lesson . '<div class="middle"><div class="bar-container"><div class="bar-rate" style="width: '.(round($v_sumlesson,1) * 2).'%;"></div></div></div>
<span>'.($v_sumlesson*2).'%</span>';

for ($i=1; $i <= 5; $i++) { 
    if ($i <= $sumlesson) {
        $rate_lesson = $rate_lesson . '<img width="20px" height="20px" class=" lazyloaded" src="../img/image/star.svg" data-src="../img/image/star.svg">';
    }else{
        $rate_lesson = $rate_lesson . '<img width="20px" height="20px" class=" lazyloaded" src="../img/image/star1.svg" data-src="../img/image/star.svg">';
    }
}

//video
$rate_video = '';
$v_sumvideo = $sumvideo*10;
$rate_video = $rate_video . '<div class="middle"><div class="bar-container"><div class="bar-rate" style="width: '.(round($v_sumvideo,1) * 2).'%;"></div></div></div>
<span>'.($v_sumvideo*2).'%</span>';

for ($i=1; $i <= 5; $i++) { 
    if ($i <= $sumvideo) {
        $rate_video = $rate_video . '<img width="20px" height="20px" class=" lazyloaded" src="../img/image/star.svg" data-src="../img/image/star.svg">';
    }else{
        $rate_video = $rate_video . '<img width="20px" height="20px" class=" lazyloaded" src="../img/image/star1.svg" data-src="../img/image/star.svg">';
    }
}

//Teacher
$rate_teacher = '';
$v_sumteacher = $sumteacher*10;
$rate_teacher = $rate_teacher . '<div class="middle"><div class="bar-container"><div class="bar-rate" style="width: '.(round($v_sumteacher,1) * 2).'%;"></div></div></div>
<span>'.($v_sumteacher*2).'%</span>';

for ($i=1; $i <= 5; $i++) { 
    if ($i <= $sumteacher) {
        $rate_teacher = $rate_teacher . '<img width="20px" height="20px" class=" lazyloaded" src="../img/image/star.svg" data-src="../img/image/star.svg">';
    }else{
        $rate_teacher = $rate_teacher . '<img width="20px" height="20px" class=" lazyloaded" src="../img/image/star1.svg" data-src="../img/image/star.svg">';
    }
}



$data = [
    'type'=>1,
    'countRate'=>$sumRate,
    'rate_star'=>$rate_star,
    'rate_lesson'=>$rate_lesson,
    'rate_video'=>$rate_video,
    'rate_teacher'=>$rate_teacher
];

echo json_encode($data);
?>