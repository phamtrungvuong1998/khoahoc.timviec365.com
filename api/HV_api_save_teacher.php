<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$qr = new db_query("SELECT * FROM users INNER JOIN save_teacher ON save_teacher.teacher_id = users.user_id WHERE save_teacher.user_student_id = $user_id");

$data['save_teacher'] = [];
while ($row = mysql_fetch_array($qr->result)) {
    $arr_cate = explode(",", $row['cate_id']);
    $cate_name = "";
    for ($i = 0; $i < count($arr_cate); $i++) {
    	$qrCate = new db_query("SELECT cate_id, cate_name FROM categories WHERE cate_id = " . $arr_cate[$i]);
    	$rowCate = mysql_fetch_array($qrCate->result);
    	if ($i == count($arr_cate) - 1) {
    		$cate_name = $cate_name . $rowCate['cate_name'];
    	}else{
    		$cate_name = $cate_name . $rowCate['cate_name'] . ",";
    	}
    }

    $qrRate = new db_query("SELECT teacher FROM courses INNER JOIN rate_course ON courses.course_id = rate_course.course_id WHERE courses.user_id = " . $row['user_id']);
    $rate = 0;

    while ($rowRate = mysql_fetch_array($qrRate->result)) {
        $rate = $rate + $rowRate['teacher'];
    }

    $rate = round($rate/mysql_num_rows($qrRate->result),1);

    $data['save_teacher'][$row['user_id']]['teacher_avatar'] = $row['user_avatar'];
    $data['save_teacher'][$row['user_id']]['teacher_name'] = $row['user_name'];
    $data['save_teacher'][$row['user_id']]['categories'] = $cate_name;
    $data['save_teacher'][$row['user_id']]['rate_center'] = $rate;
}

success('',$data);
?>