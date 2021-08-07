<?php
require_once '../config/config.php';
$active = getValue('active','int','GET','');
$user_id = getValue('user_id','int','GET','');
$index = getValue('index','int','GET','');
$dataId = [
	'user_id'=>$user_id
];
if ($active == 1) {
	$data = [
		'user_active'=>$active,
		'user_index'=>$index
	];
}else if ($active == 0) {
	$data = [
		'user_active'=>$active,
		'user_index'=>$index
	];
}

update('users',$data,$dataId);

$data1 = [
	'result'=>1
];

echo json_encode($data1);
?>