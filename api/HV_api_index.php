<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';

// Đăng kí nhiều nhất tuần

$timeStart = strtotime("previous Monday");
$timeEnd = strtotime("previous Monday") + 518400;
$qr = new db_query("SELECT *,courses.course_id FROM courses LEFT JOIN rate_course ON rate_course.course_id = courses.course_id INNER JOIN orders ON orders.course_id = courses.course_id INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN users ON users.user_id = courses.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE orders.day_buy > $timeStart AND orders.day_buy < $timeEnd GROUP BY orders.course_id ORDER BY COUNT(orders.course_id) DESC");
$dataCourse = [];
while ($row = mysql_fetch_array($qr->result)) {
	$dataCourse[$row['course_id']]['course_id'] = $row['course_id'];
	$dataCourse[$row['course_id']]['course_avatar'] = $row['course_avatar'];
	$dataCourse[$row['course_id']]['save_id'] = $row['save_id'];
	$dataCourse[$row['course_id']]['user_avatar'] = $row['user_avatar'];
	$dataCourse[$row['course_id']]['course_name'] = $row['course_name'];
	$dataCourse[$row['course_id']]['user_name'] = $row['user_name'];
	$dataCourse[$row['course_id']]['price_promotional'] = $row['price_promotional'];
	$dataCourse[$row['course_id']]['price_listed'] = $row['price_listed'];
}

$data['dataCourse'] = $dataCourse;

//Có thể bạn sẽ thích
$qrCate = new db_query("SELECT cate_id FROM users WHERE user_id = " . $user_id);
$row = mysql_fetch_array($qrCate->result);
$arr_cate_id = explode(",", $row['cate_id']);

if (count($arr_cate_id) == 0) {
	$strCate = '(0)';
}else if (count($arr_cate_id) == 1) {
	$strCate = '(' . $arr_cate_id[0] . ')';
}else{
	for ($i = 0; $i < count($arr_cate_id); $i++) {
		if ($i == 0) {
			$strCate = '(' . $arr_cate_id[$i] . ',';
		}else if ($i > 0 && $i < count($arr_cate_id) - 1) {
			$strCate = $strCate . $arr_cate_id[$i] . ',';
		}else if ($i == count($arr_cate_id) - 1){
			$strCate = $strCate . $arr_cate_id[$i] . ')';
		}
	}
}


$qr = new db_query("SELECT *,courses.course_id FROM courses LEFT JOIN save_course ON courses.course_id = save_course.course_id INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN users ON users.user_id = courses.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.cate_id IN $strCate ORDER BY courses.course_id DESC");

$dataLike = [];
while ($row = mysql_fetch_array($qr->result)) {
     $dataLike[$row['course_id']]['course_id'] = $row['course_id'];
     $dataLike[$row['course_id']]['course_avatar'] = $row['course_avatar'];
     $dataLike[$row['course_id']]['save_id'] = $row['save_id'];
     $dataLike[$row['course_id']]['user_avatar'] = $row['user_avatar'];
     $dataLike[$row['course_id']]['course_name'] = $row['course_name'];
     $dataLike[$row['course_id']]['user_name'] = $row['user_name'];
     $dataLike[$row['course_id']]['price_promotional'] = $row['price_promotional'];
     $dataLike[$row['course_id']]['price_listed'] = $row['price_listed'];
}

$data['dataLike'] = $dataLike;

//Top khóa học offline
$qr = new db_query("SELECT *,courses.course_id FROM courses LEFT JOIN save_course ON courses.course_id = save_course.course_id INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN users ON users.user_id = courses.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_type = 1 ORDER BY courses.course_id DESC");
$dataOff = [];
while ($row = mysql_fetch_array($qr->result)) {
     $dataOff[$row['course_id']]['course_id'] = $row['course_id'];
     $dataOff[$row['course_id']]['course_avatar'] = $row['course_avatar'];
     $dataOff[$row['course_id']]['save_id'] = $row['save_id'];
     $dataOff[$row['course_id']]['user_avatar'] = $row['user_avatar'];
     $dataOff[$row['course_id']]['course_name'] = $row['course_name'];
     $dataOff[$row['course_id']]['user_name'] = $row['user_name'];
     $dataOff[$row['course_id']]['price_promotional'] = $row['price_promotional'];
     $dataOff[$row['course_id']]['price_listed'] = $row['price_listed'];
}

$data['dataOff'] = $dataOff;

//Top khóa học online
$qr = new db_query("SELECT *,courses.course_id FROM courses LEFT JOIN save_course ON courses.course_id = save_course.course_id INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN users ON users.user_id = courses.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_type = 2 ORDER BY courses.course_id DESC");
$dataOn = [];
while ($row = mysql_fetch_array($qr->result)) {
     $dataOn[$row['course_id']]['course_id'] = $row['course_id'];
     $dataOn[$row['course_id']]['course_avatar'] = $row['course_avatar'];
     $dataOn[$row['course_id']]['save_id'] = $row['save_id'];
     $dataOn[$row['course_id']]['user_avatar'] = $row['user_avatar'];
     $dataOn[$row['course_id']]['course_name'] = $row['course_name'];
     $dataOn[$row['course_id']]['user_name'] = $row['user_name'];
     $dataOn[$row['course_id']]['price_promotional'] = $row['price_promotional'];
     $dataOn[$row['course_id']]['price_listed'] = $row['price_listed'];
}

$data['dataOn'] = $dataOn;

success('',$data);
?>