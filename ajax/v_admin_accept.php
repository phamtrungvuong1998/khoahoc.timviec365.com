<?php
require_once '../config/config.php';

$course_id = getValue('course_id','int','GET','');
$accept = getValue('accept','int','GET','');

$data = [
	'accept'=>$accept
];

$dataId = [
	'course_id'=>$course_id
];

$qr = new db_query("SELECT * FROM courses INNER JOIN users ON courses.user_id = users.user_id WHERE course_id = $course_id");
$row = mysql_fetch_array($qr->result);
$title = "Kiểm duyệt khóa học";
if ($accept == 1) {
	$body = "Khóa học " . $row['course_name'] . "đã được kiểm duyệt thành công";
	SendMailAmazon($title, $row['user_name'], $row['user_mail'], $body);
}else if ($accept == 0){
	$body = "Khóa học " . $row['course_name'] . "của bạn đã bị xóa do vi phạm điều khoản";
	SendMailAmazon($title, $row['user_name'], $row['user_mail'], $body);
}

update('courses',$data,$dataId);
?>