<?php
require_once '../config/config.php';

	$course_name = getValue('course_name','str','POST','');
	$course_benefit = getValue('course_benefit','str','POST','');
	$course_match = getValue('course_match','str','POST','');
	$general_describe = getValue('general_describe','int','POST','');
	$time_learn = getValue('time_learn','int','POST','');
	$price_listed = getValue('price_listed','str','POST','');
	$cate_id = getValue('cate_id','int','POST','');
	$tag_id = getValue('tag_id','int','POST','');
	$course_request = getValue('course_request','str','POST','');
	$month_study = getValue('month_study','str','POST','');
	$price_promotional = getValue('price_promotional','str','POST','');
	$price_discount = getValue('price_discount','int','POST','');
	$level_id = getValue('level_id','int','POST','');
	$quantity_std = getValue('quantity_std','str','POST','');
	$course_id = getValue('course_id','int','POST','');
	$today = strtotime(date("d-m-Y"));

	$dataId = [
		'course_id'=>$course_id
	];

	$data = [
		'course_name'=>$course_name,
		'course_benefit'=>$course_benefit,
		'course_match'=>$course_match,
		'tag_id'=>$tag_id,
		'course_request'=>$course_request,
		'general_describe'=>$general_describe,
		'time_learn'=>$time_learn,
		'price_listed'=>$price_listed,
		'cate_id'=>$cate_id,
		'quantity_std'=>$quantity_std,
		'level_id'=>$level_id,
		'month_study'=>$month_study,
		'price_discount'=>$price_discount,
		'updated_at'=>$today
	];

	update('courses',$data,$dataId);

	header("Location: /Admin/admin_list_online.php");
?>