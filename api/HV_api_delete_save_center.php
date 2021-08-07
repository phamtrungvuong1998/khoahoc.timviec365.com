<?php
include_once '../config/config.php';
include_once 'functions.php';
use Firebase\JWT\JWT;
$token = getValue('token','str','GET','');

$center_id = getValue('center_id','int','GET','');
$token_decode = JWT::decode($token,$key,['HS256']);
$qr = new db_query("DELETE FROM save_center WHERE user_student_id = $user_id AND center_id = $center_id");

$data1 = [
	'result'=>1
];

success('Xóa thành công',$data1);
?>