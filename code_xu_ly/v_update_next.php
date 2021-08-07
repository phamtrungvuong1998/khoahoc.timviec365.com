<?php
require_once '../config/config.php';
$course_id = getValue('course_id','int','POST','');
$v_n = getValue('v_n','int','POST','');
if ($v_n == 0) {
	$accept = 0;
}else{
	$accept = 1;
}
$season_name = getValue('season_name','arr','POST','');
$episode_name = getValue('episode_name','arr','POST','');
$season_nameUpdate = getValue('season_nameUpdate','arr','POST','');
$episode_nameUpdate = getValue('episode_nameUpdate','arr','POST','');
$today = time();
$time_learn = getValue('time_learn','int','POST','');
$course_slide = getValue('course_slide','int','POST','');
$price_promotional = getValue('price_promotional','int','POST','');
$price_listed = getValue('price_listed','int','POST','');
$price_discount = getValue('price_discount','int','POST','');
$quantity_std = getValue('quantity_std','int','POST','');
$month_study = getValue('month_study','str','POST','');
$course_describe = $_COOKIE['course_describe'];
$level_id = $_COOKIE['level_id'];
if (!isset($_COOKIE['type'])) {
	$type = 2;
}else{
	$type = $_COOKIE['type'];
}

$course_benefit =  $_COOKIE['course_benefit'];
$general_describe =  $_COOKIE['general_describe'];
$course_name =  $_COOKIE['course_name'];
$course_match =  $_COOKIE['course_match'];
$course_request =  $_COOKIE['course_request'];
$tag_id =  $_COOKIE['tag_id'];
$cate_id = $_COOKIE['cate_id'];
$user_id = $_COOKIE['user_id'];
if(isset($_COOKIE['certification'])){
    $certification = $_COOKIE['certification'];
}else{
    $certification = 0;
}
if(isset($_COOKIE['advantages_id'])){
    $advantages = $_COOKIE['advantages_id'];
}else{
    $advantages = 0;
}
if(isset($_COOKIE['center_teacher_id'])){
    $teach = $_COOKIE['center_teacher_id'];
}else{
    $teach = 0;
}
$dataCourse = [
	'cate_id'=>$cate_id,
    'level_id'=>$level_id,
    'course_name'=>$course_name,
    'course_describe'=>$course_describe,
    'tag_id'=>$tag_id,
    'course_benefit'=>$course_benefit,
	'course_match'=>$course_match,
    'general_describe'=>$general_describe,
    'course_request'=>$course_request,
	'advantages_id'=>$advantages,
    'time_learn'=>$time_learn,
    'course_slide'=>$course_slide,
	'center_teacher_id'=>$teach,
    'teacher_center'=>$type,
    'updated_at'=>$today,
    'accept'=>$accept,
	'price_promotional'=>$price_promotional,
	'price_listed'=>$price_listed,
	'price_discount'=>$price_discount,
	'quantity_std'=>$quantity_std,
	'month_study'=>$month_study,
];


$dataCourseId = [
	'course_id'=>$course_id
];

update('courses',$dataCourse,$dataCourseId);
$arr_season_name = [];
for ($i = 0; $i < count($season_name); $i++) {
	if (isset($season_name[$i])) {
		$qr = new db_query("SELECT lesson_id FROM course_lesson WHERE course_id = $course_id AND lesson_parent = 0 ORDER BY lesson_id ASC LIMIT ".$i.",1");
		$row = mysql_fetch_array($qr->result);
		$arr_season_name[$i] = $row['lesson_id']; 
		$data_season_name = [
			'lesson_name'=>$season_name[$i]
		];

		$data_season_name_id = [
			'lesson_id'=>$row['lesson_id']
		];

		update('course_lesson',$data_season_name,$data_season_name_id);
	}
}

$target_dir_video = "../document/video/";
$target_dir_document = "../document/tailieu/";
//Cập nhật phần học đã có
for ($i = 0; $i < count($arr_season_name); $i++) {
	$lesson_parent = $arr_season_name[$i];
	for ($j = 0; $j < count($episode_name[$i]); $j++) {
		$qr = new db_query("SELECT lesson_id,video,document FROM course_lesson WHERE lesson_parent = $lesson_parent ORDER BY lesson_id ASC LIMIT $j,1");
		$row = mysql_fetch_array($qr->result);

		if (mysql_num_rows($qr->result) == 0) {
			$data = [
				'course_id'=>$course_id,
				'lesson_parent'=>$lesson_parent,
				'lesson_name'=> $episode_name[$i][$j],
				'video'=>$_FILES['video']['name'][$i][$j],
				'document'=>$_FILES['document']['name'][$i][$j]
			];

			add('course_lesson',$data);
		}else{
			$data = [
				'lesson_name'=> $episode_name[$i][$j],	
			];
			if (isset($_FILES['video']['name'][$i][$j])) {
				$target_file_video = 'Course' . $course_id . $_FILES['video']['name'][$i][$j];
				move_uploaded_file($_FILES['video']['tmp_name'][$i][$j], $target_file_video);
				unlink('../document/video/'.$row['video']);
				$data['video'] = $_FILES['video']['name'][$i][$j];
			}

			if (isset($_FILES['document']['name'][$i][$j])) {
				$data['document'] = $_FILES['document']['name'][$i][$j];
				$target_file_document = 'Course' . $course_id . $_FILES['document']['name'][$i][$j];
				move_uploaded_file($_FILES['document']['tmp_name'][$i][$j], $target_file_document);
				unlink('../document/video/'.$row['document']);
			}

			$dataId = [
				'lesson_id'=>$row['lesson_id']
			];
			update('course_lesson',$data,$dataId);
		}
	}
}
//Thêm phần học mới
if ($season_nameUpdate != "") {
	for ($i = 0; $i < count($season_nameUpdate); $i++) {
		$data = [
			'course_id'=>$course_id,
			'lesson_name'=>$season_nameUpdate[$i]
		];

		add('course_lesson',$data);
		$lesson_parent = mysql_insert_id();
		for ($j = 0; $j < count($episode_nameUpdate); $j++) {
			$data1 = [
				'course_id'=>$course_id,
				'lesson_name'=>$episode_nameUpdate[$i][$j],
				'video'=>$_FILES['videoUpdate']['name'][$i][$j],
				'document'=>$_FILES['documentUpdate']['name'][$i][$j],
				'lesson_parent'=>$lesson_parent
			];
			add('course_lesson',$data1);
			$target_file_video = 'Course' . $course_id . $_FILES['videoUpdate']['name'][$i][$j];
			$target_file_document = 'Course' . $course_id . $_FILES['documentUpdate']['name'][$i][$j];
			move_uploaded_file($_FILES['videoUpdate']['tmp_name'][$i][$j], $target_dir_video . $target_file_video);
			move_uploaded_file($_FILES['documentUpdate']['tmp_name'][$i][$j], $target_dir_document . $target_file_document);
		}
	}
}


setcookie('level_id',$level_id,time() - 900, "/");
setcookie('course_describe', $course_describe, time() - 900, '/');
setcookie('course_name', $course_name, time() - 900, '/');
setcookie('course_match', $course_match, time() - 900, '/');
setcookie('course_benefit', $course_benefit, time() - 900, '/');
setcookie('general_describe', $general_describe, time() - 900, '/');
setcookie('course_request', $course_request, time() - 900, '/');
setcookie('cate_id', $cate_id, time() - 900, '/');
setcookie('tag_id', $tag_id, time() - 900, '/');
setcookie('type', $type, time() - 900, '/');
if(isset($_COOKIE['certification'])){
    setcookie('certification', $certification, time() - 900, '/');
}
if(isset($_COOKIE['advantages_id'])){
    setcookie('advantages_id', $advantages, time() - 900, '/');
}
if(isset($_COOKIE['center_teacher_id'])){
    setcookie('center_teacher_id', $teach, time() - 900, '/');
}

$data6 = [
	'type'=>$type
];

echo json_encode($data6);
?>