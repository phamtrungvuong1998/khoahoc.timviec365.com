<?php
require_once '../config/config.php';
$course_id = getValue('course_id','int','POST','');
$course_describe = getValue('course_describe','str','POST','');
$course_learn = getValue('course_learn','str','POST','');
$course_object = getValue('course_object','str','POST','');
$course_request = getValue('course_request','str','POST','');
$center_teacher_id = getValue('center_teacher_id','int','POST','');
$time_learn = getValue('time_learn','int','POST','');
$course_slide = getValue('course_slide','int','POST','');
$price_listed = getValue('price_listed','int','POST','');
$price_promotional = getValue('price_promotional','int','POST','');
$quantity_std = getValue('quantity_std','int','POST','');
$price_discount = getValue('price_discount','int','POST','');
$certification = getValue('certification','int','POST','');
$course_level = getValue('course_level','int','POST','');
$month_study = getValue('month_study','int','POST','');

$dataId = [
	'course_id'=>$course_id
];

$data = [
	'course_describe'=>$course_describe,
	'course_learn'=>$course_learn,
	'course_object'=>$course_object,
	'course_request'=>$course_request,
	'center_teacher_id'=>$center_teacher_id,
	'time_learn'=>$time_learn,
	'course_slide'=>$course_slide,
	'price_listed'=>$price_listed,
	'price_promotional'=>$price_promotional,
	'quantity_std'=>$quantity_std,
	'price_discount'=>$price_discount,
	'certification'=>$certification,
	'level_id'=>$course_level,
	'month_study'=>$month_study,
	'updated_at'=>strtotime(date("d-m-Y"))
];

update('courses',$data,$dataId);

echo json_encode("vuong");
?>