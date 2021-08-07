<?php
include_once '../config/config.php';
include_once 'functions.php';
use Firebase\JWT\JWT;
$token = getValue('token','str','GET','');

$teacher_id = getValue('teacher_id','int','GET','');
$token_decode = JWT::decode($token,$key,['HS256']);
$qr = new db_query("DELETE FROM save_teacher WHERE user_student_id = $user_id AND teacher_id = $teacher_id");

$data1 = [
	'result'=>1
];

success('Xóa thành công',$data1);
?>