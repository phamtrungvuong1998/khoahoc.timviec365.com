<?php
require_once '../config/config.php';
$active = getValue('active','int','GET','');
$user_id = getValue('user_id','int','GET','');
$dataId = [
	'adm_id'=>$user_id
];
if ($active == 1) {
	$data = [
		'adm_active'=>$active,
	];
}else if ($active == 0) {
	$data = [
		'adm_active'=>$active,
	];
}
update('admin',$data,$dataId);
?>