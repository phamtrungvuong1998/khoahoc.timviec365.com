<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$course_id = getValue('course_id','int','POST','');
$qr = new db_query("SELECT course_name,courses.course_id,cate_name,orders.order_id,	total_prices,day_buy FROM courses INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN orders ON courses.course_id = orders.course_id WHERE courses.course_id = $course_id AND orders.user_student_id = $user_id");
$data['detail_history_course_buy'] = [];
while($row = mysql_fetch_array($qr->result)){
    $data['detail_history_course_buy']['course_id'] = $row['course_id'];
    $data['detail_history_course_buy']['course_name'] = $row['course_name'];
    $data['detail_history_course_buy']['cate_name'] = $row['cate_name'];
    $data['detail_history_course_buy']['order_id'] = $row['order_id'];
    $data['detail_history_course_buy']['total_prices'] = $row['total_prices'];
    $data['detail_history_course_buy']['day_buy'] = date("d-m-Y",$row['day_buy']);
    $data['detail_history_course_buy']['status'] = 'Thành công';
}
success('',$data);
?>