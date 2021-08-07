<?php
require_once '../config/config.php';
$lesson = getValue('lesson','int','POST','');

$video = getValue('video','int','POST','');

$teacher = getValue('teacher','int','POST','');

$comment = getValue('comment','str','POST','');

$course_id = getValue('course_id','int','POST','');

$user_id = $_COOKIE['user_id'];

$today = strtotime(date("Y/m/d H:i:s"));

$data = [
	'user_student_id'=>$user_id,
	'course_id'=>$course_id,
	'lesson'=>$lesson,
	'video'=>$video,
	'teacher'=>$teacher,
	'comment_rate'=>$comment,
    'created_at'=>date("Y/m/d H:i:s"),
];

add('rate_course', $data);

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
$html1 = "";

if ($sumRate == 0) {
    $html1 = $html1 . '<div class="no-cmt">Hiện chưa có bình luận</div>'; 
}else{
    while ($rowComment = mysql_fetch_array($qrComment->result)) {
        $user_student_id = $rowComment['user_student_id'];

        if ($rowType['course_type'] == 1) {
            $rateAll = $rowComment['lesson'] + $rowComment['teacher'];
            $rate = $rateAll/2;
        }else{
            $rateAll = $rowComment['lesson'] + $rowComment['video'] + $rowComment['teacher'];
            $rate = $rateAll/3;
        }

        $qrHV = new db_query("SELECT user_name,user_avatar,user_id FROM users WHERE user_id = " . $rowComment['user_student_id']);
        $rowHV = mysql_fetch_array($qrHV->result);

        if ($rowHV['user_avatar'] == '0') {
         $avatar = '../img/v_avatar_default.png';
     }else{
         $avatar = "../img/avatar/" . $rowHV['user_avatar'];
     }
//Lây tổng đánh giá
     if ($rowType['course_type'] == 1) {
        $rateAllC = $rowComment['lesson'] + $rowComment['teacher'];
        $rateC = $rateAllC/2;
        $average = $average + $rateC;
        $average_rate = $average/mysql_num_rows($qrComment->result);
    }else{
        $rateAllC = $rowComment['lesson'] + $rowComment['video'] + $rowComment['teacher'];
        $rateC = $rateAllC/3;
        $average = $average + $rateC;
        $average_rate = $average/mysql_num_rows($qrComment->result);
    }

    $v_lesson = $v_lesson + $rowComment['lesson'];
    $v_video = $v_video + $rowComment['video'];
    $v_teacher = $v_teacher + $rowComment['teacher'];

    $html1 = $html1 . '<div class="cmt-student">
    <div class="std-img">
    <img src="'.$avatar.'">
    </div>
    <div class="std-content" data-set="'.$rowComment['rate_id'].'">
    <h4>'.$rowHV['user_name'].'</h4>
    <div class="stdstar">';

    for ($i = 0; $i < $rate; $i++) {
        $html1 = $html1 . '<img class=" lazyloaded" src="../img/image/star.svg" data-src="../img/image/star.svg">';
    }

    $html1 = $html1 . '<span>'.$rowComment['updated_at'].'</span>
    </div>
    <p>'.$rowComment['comment_rate'].'</p>
    <div class="answer">
    <button class="clickrep" data-set="'.$user_id.'" onclick="clickrep(this)">Phản hồi</button>';

    if ($rowHV['user_id'] == $_COOKIE['user_id']) {
        $html1 = $html1 . '<button class="del_cmt" data-set="'.$rowComment['rate_id'].'" onclick="del_cmt(this)">Xóa</button> ';
    }

    $html1 = $html1 .'</div>';

    $qrRep = new db_query("SELECT * FROM rep_rate_course WHERE rate_id = " . $rowComment['rate_id']);
    while ($rowRep = mysql_fetch_array($qrRep->result)) {
        $qrUserRep = new db_query("SELECT user_id,user_avatar,user_name FROM users WHERE user_id = " . $rowRep['user_student_id']);
        $rowUserRep = mysql_fetch_array($qrUserRep->result);
        if ($rowUserRep['user_avatar'] == '0') {
            $avatarRep = '../img/v_avatar_default.png';
        }else{
            $avatarRep = '../img/avatar/' . $rowUserRep['user_avatar'];
        }
        $html1 = $html1 . '<div class="reply-content">
        <div class="studentrep">
        <div class="std-img">
        <img src="'.$avatarRep.'">
        </div>
        <div class="std-content">
        <h4>'.$rowUserRep['user_name'].'</h4>
        <div class="stdstar">
        <span>'.$rowRep['created_at'].'</span>
        </div>
        <p>adasdqadas</p>
        <div class="answer-rep">
        <button class="delrep" data-rep="'.$rowUserRep['user_id'].'" data-set="'.$rowRep['rep_id'].'" onclick="delrep2(this)">Xóa</button>
        </div>
        </div>
        </div>
        </div>';
    }
    $html1 = $html1 . '</div>

    </div>';

    $html1 = $html1 . '<div class="reply-comment" data-set="'.$rowComment['rate_id'].'">
    <form onsubmit="return rep_Comment(this);">
    <textarea class="reply-comment-textarea"></textarea>
    <div class="divreply">
    <button class="btn_reply"><img src="../img/Spinner-1s-200px.gif" class="btn_reply_img" alt=""><span class="btn_reply_span">GỬI</span></button>
    </div>
    </form>
    </div>';
}
}


$qrrate = new db_query("SELECT Count(*) as total FROM rate_course WHERE course_id = $course_id");
$rowcount=mysql_fetch_array($qrrate->result);
$numrate = $rowcount['total'];

$qrsum = new db_query("SELECT sum(lesson),sum(video),sum(teacher),(sum(lesson)+sum(video)+sum(teacher)) FROM rate_course WHERE course_id = $course_id");

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
<span>'.round($v_sumlesson*2,1).'%</span>';

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
<span>'.round($v_sumvideo*2,1).'%</span>';

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
<span>'.round($v_sumteacher*2,1).'%</span>';

for ($i=1; $i <= 5; $i++) { 
    if ($i <= $sumteacher) {
        $rate_teacher = $rate_teacher . '<img width="20px" height="20px" class=" lazyloaded" src="../img/image/star.svg" data-src="../img/image/star.svg">';
    }else{
        $rate_teacher = $rate_teacher . '<img width="20px" height="20px" class=" lazyloaded" src="../img/image/star1.svg" data-src="../img/image/star.svg">';
    }
}



$data = [
    'html1'=>$html1,
    'countRate'=>$sumRate,
    'rate_star'=>$rate_star,
    'rate_lesson'=>$rate_lesson,
    'rate_video'=>$rate_video,
    'rate_teacher'=>$rate_teacher
];

echo json_encode($data);
?>