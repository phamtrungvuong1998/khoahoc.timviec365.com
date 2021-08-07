<?php
require_once '../config/config.php';
$point_id = $_COOKIE['point_id'];
$point_add = getValue('point_add_total','str','POST','');
$sql_point = new db_query("SELECT point_add_total,user_id FROM points WHERE point_id =  $point_id");
$row_point = mysql_fetch_array($sql_point->result);
$point_total = $row_point['point_add_total'] + $point_add;
$dataId = [
	'point_id'=> $point_id
];

$data = [
	'point_add_total'=>$point_total,
];

update('points',$data,$dataId);

$center_teacher_id = $row_point['user_id'];
$data2 = [
	'center_teacher_id'=>$center_teacher_id,
	'point_add'=>$point_add
];
add('history_point',$data2);

header("Location: /Admin/admin_list_point.php");
?>