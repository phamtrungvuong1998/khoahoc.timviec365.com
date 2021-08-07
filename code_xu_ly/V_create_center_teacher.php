<?php
require '../config/config.php';
$duoi = explode('/', $_FILES['file']['type']);
$duoi = $duoi[(count($duoi) - 1)];
$_FILES['file']['name'] = md5(rand()) . "." . $duoi;
move_uploaded_file($_FILES['file']['tmp_name'], '../img/avatar/'.$_FILES['file']['name']);
$teacher_name = getValue('teacher_name','str','POST','');
$cate_id = getValue('cate_id','arr','POST','');
$quafilication = getValue('quafilication','str','POST','');
$date_join = getValue('date_join','str','POST','');
$date_join = strtotime($date_join);

$data1 = [
	'user_id'=>$_COOKIE['user_id'],
	'cate_id'=>$cate_id,
	'teacher_name'=>$teacher_name,
	'teacher_avatar'=>$_FILES['file']['name'],
	'qualification'=>$quafilication,
	'date_join'=>$date_join,
	'created_at'=>strtotime(date("d-m-Y")),
	'updated_at'=>strtotime(date("d-m-Y"))
];

add('user_center_teacher',$data1);

$id = mysql_insert_id();
$data = [
	'type'=>1,
	'id'=>$id,
	'teacher_name'=>$teacher_name
];
echo json_encode($data);
?>