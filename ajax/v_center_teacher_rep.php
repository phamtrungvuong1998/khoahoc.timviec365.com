<?php
require_once '../config/config.php';
$rate_id = getValue('rate_id','int','POST','');
$course_id = getValue('course_id','int','POST','');
// echo $course_id;
$comment_rep = getValue('comment_rep','str','POST','');
$user_student_id = $_COOKIE['user_id'];

$data = [
	'rate_id'=> $rate_id,
	'course_id'=> $course_id,
	'user_student_id' => $user_student_id,
	'comment_rep'=> $comment_rep,
];
add('rep_rate_course',$data);

$data1 = [
	'type'=>1
];
echo json_encode($data1);
?>