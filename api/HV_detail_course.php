<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';


$course_id = getValue('course_id','int','POST','');

$qrCourse = new db_query("SELECT *,COUNT(orders.order_id),courses.created_at,users.user_id,courses.cate_id FROM courses INNER JOIN orders ON orders.course_id = courses.course_id INNER JOIN users ON courses.user_id = users.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_id = $course_id");

$row = mysql_fetch_array($qrCourse->result);

$qrContent = new db_query("SELECT * FROM course_lesson WHERE course_id = $course_id");

$index = 1;
$dataContent = [];
$dataCourse = [];
$dataDocument = [];
$dataVideo = [];
$b = 0;
while ($rowContent = mysql_fetch_array($qrContent->result)) {
	if ($rowContent['lesson_parent'] == 0) {
		$dataContent[$rowContent['lesson_id']] = $rowContent['lesson_name'];
	}else{
		$dataDocument[$rowContent['lesson_id']] = $rowContent['document']; 
		$dataVideo[$rowContent['lesson_id']] = $rowContent['video']; 
		$b++;
	}
}

$qrTeach = new db_query("SELECT course_id FROM courses WHERE user_id = " . $row['user_id']);//Số lượng khóa học giảng dạy
die();
if ($row['user_type'] == 2) {
	//Thông tin giảng viên
	$qrInfo = new db_query("SELECT * FROM user_teach_experience WHERE user_id = " . $row['user_id']);
	$rowInfo = mysql_fetch_array($qrInfo->result);
	$info = $rowInfo['current_position'] . " " . $rowInfo['current_company'];
	//Đánh giá giảng viên
	$qrRate = new db_query("SELECT teacher FROM courses INNER JOIN rate_course ON courses.course_id = rate_course.course_id WHERE user_id = " . $row['user_id']);
	$total_rate = 0;
	while($rowRate = mysql_fetch_array($qrRate->result)){
		$total_rate = $total_rate + $rowRate['teacher'];
	}
	$rate = $total_rate/mysql_num_rows($qrRate->result);
}else{
	//Thông tin trung tâm 
	$qrInfo = new db_query("SELECT * FROM user_center WHERE user_id = " . $row['user_id']);
	$rowInfo = mysql_fetch_array($qrInfo->result);
	$info = $rowInfo['center_intro'];
	//Đánh giá trung tâm
	$qrRate = new db_query("SELECT * FROM rate_center WHERE center_id = " . $row['user_id']);
	$rowRate = mysql_fetch_array($qrRate->result);
	$rate = $rowRate['teacher'] + $rowRate['place_class'] + $rowRate['infrastructure'] + $rowRate['student_number'] + $rowRate['enviroment'] + $rowRate['student_care'] + $rowRate['practice'] + $rowRate['pround_price'] + $rowRate['self_improvement'] + $rowRate['ready_introduct'];
	$rate = $rate/10;
}

//Đánh giá khóa học
$rate_course = 0;
$qr = new db_query("SELECT * FROM rate_course WHERE course_id = $course_id");
while ($row3 = mysql_fetch_array($qr->result)) {
	if ($row['course_type'] == 2) {
		$rate_course = $row3['lesson'] + $row3['video'] + $row3['teacher'];
	}else{
		$rate_course = $row3['lesson'] + $row3['teacher'];
	}
}

if (mysql_num_rows($qr->result) == 0) {
	$rate_course = 0;
}else{
	$rate_course = $rate_course/mysql_num_rows($qr->result);
}
//Khóa học liên quan
$qr = new db_query("SELECT course_id,course_name,price_listed,price_promotional FROM courses WHERE cate_id = " . $row['cate_id']);
while ($rowRelate = mysql_fetch_array($qr->result)) {
    $dataRelate[$rowRelate['course_id']] = [
    	'course_name'=>$rowRelate['course_name'],
    	'price_listed'=>$rowRelate['price_listed'],
    	'price_promotional'=>$rowRelate['price_promotional'],
    ];
}
$data_detail_course =[
	'user'=>$dataUser,
	'course_name'=>$row['course_name'], //Tên khóa học
	'count_student_singup'=>$row['COUNT(orders.order_id)'], //Số người đăng kí
	'time_learn'=>$row['time_learn'], //Số giờ học
	'count_lesson'=>$b, //Số bài học
	'cate_name'=>$row['cate_name'], //Tên môn học
	'course_slide'=>$row['course_slide'], //Số lượng tài liệu
	'created_at'=>$row['created_at'], // Thời gian tạo
	//Nội dung
	'content'=>[
		'course_benefit'=>$row['course_benefit'], //Bạn sẽ học được gì
		'course_object'=>$row['course_object'], //Đối tượng học viên	
		'course_describe'=>$row['course_describe'],// Giới thiệu khóa học
		'course_request'=>$row['course_request'],// Yêu cầu khóa học
		'content_learn'=>$dataContent,//Nội dung khóa học
	],
	//Thông tin giảng viên
	'info'=>[
		'user_name'=>$row['user_name'],//Tên giảng viên
		'user_avatar'=>$row['user_avatar'],//Avatar giảng viên
		'course_count'=>mysql_num_rows($qrTeach->result),//Số lượng khóa học giảng dạy
		'rate'=>round($rate, 1),//Số sao đánh giá
		'user_info'=>$info,//Thông tin giảng viên hoặc trung tâm
	],
	//Bài học
	'video'=>$dataVideo,
	//Bình luận
	'comment'=>[
		'rate'=>round($rate_course,1),//Số sao đánh giá khóa học

	],
	//Liên quan
	'relate'=>$dataRelate,
	//Tài liệu
	'document'=>$dataDocument
	
];

$data['detail_course'] = $data_detail_course;
success('',$data);
?>