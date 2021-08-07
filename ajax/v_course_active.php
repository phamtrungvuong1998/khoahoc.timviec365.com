<?php
require_once '../config/config.php';

$course_id = getValue('course_id','int','GET','');
$course_index = getValue('index','int','GET','');

$dataId = [
	'course_id'=>$course_id
];

$data = [
	'course_index'=>$course_index
];


update('courses',$data,$dataId);

$data1 = [
	'result'=>1
];

echo json_encode($data1);
?>