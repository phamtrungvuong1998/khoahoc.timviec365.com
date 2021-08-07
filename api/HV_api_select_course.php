<?php
require_once 'api_info.php';
$tag_id = getValue('tag_id','int','GET','');
$qrCourse = new db_query("SELECT course_id,course_name,user_name,price_promotional FROM courses INNER JOIN users ON courses.user_id = users.user_id WHERE courses.tag_id = $tag_id");
$dataCourse = [];
//Danh sách khóa học
while ($row = mysql_fetch_array($qrCourse->result)) {
    $dataCourse[$row['course_id']] = [
    	'course_name'=>$row['course_name'],
    	'username'=>$row['user_name'],
    	'price_promotional'=>$row['price_promotional']
    ];
}

$data = [
	'user'=>$dataUser,
	'course'=>$dataCourse
];

success('',$data);
?>