<?php
require_once '../config/config.php';

$course_id = getValue('course_id','int','POST','');

$rate_id = getValue('rate_id','int','POST','');

$rep_comment = getValue('rep_comment','str','POST','');

$user_id = $_COOKIE['user_id'];


$data = [
	'user_student_id'=>$user_id,
	'course_id'=>$course_id,
	'rate_id'=>$rate_id,
	'comment_rep'=>$rep_comment
];

add('rep_rate_course', $data);

$rep_id = mysql_insert_id();

$html = "";
$qrRep = new db_query("SELECT * FROM rep_rate_course WHERE rep_id = $rep_id");
$rowRep = mysql_fetch_array($qrRep->result);
$user_id = $rowRep['user_student_id'];
$qrUserRep =  new db_query("SELECT user_name,user_avatar FROM users WHERE user_id = $user_id");
$rowUserRep = mysql_fetch_array($qrUserRep->result);

if ($rowUserRep['user_avatar'] == '0') {
  $srcAvatar = '../img/v_avatar_default.png';
}else{
  $srcAvatar = '../img/avatar/' . $rowUserRep['user_avatar'];
}

$html = $html . '<div class="reply-content">
<div class="studentrep">
<div class="std-img">
<img src="'.$srcAvatar.'">
</div>
<div class="std-content">
<h4>'.$rowUserRep['user_name'].'</h4>
<div class="stdstar">
<span>'.$rowRep['created_at'].'</span>
</div>
<p>'.$rowRep['comment_rep'].'</p>
<div class="answer-rep">
<button class="delrep" data-rep="'.$user_id.'" data-set="'.$rep_id.'" onclick="delrep2(this)">Xóa</button>
</div>
</div>
</div>
</div>';

$data = [
    'html'=>$html
];

echo json_encode($data);
?>