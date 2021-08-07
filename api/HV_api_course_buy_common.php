<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$qr = new db_query("SELECT courses.course_id, users.user_id, course_avatar, course_name, user_name,order_student_common.common_status FROM courses INNER JOIN order_student_common ON courses.course_id = order_student_common.course_id INNER JOIN users ON courses.user_id = users.user_id WHERE order_student_common.user_student_id = $user_id");
$data['course_buy_common'] = [];
while ($row = mysql_fetch_array($qr->result)) {
    $data['course_buy_common'][$row['course_id']]['course_avatar'] = $row['course_avatar'];
    $data['course_buy_common'][$row['course_id']]['course_name'] = $row['course_name'];
    $data['course_buy_common'][$row['course_id']]['teacher_name'] = $row['user_name'];
    $data['course_buy_common'][$row['course_id']]['common_status'] = $row['common_status'];
}

success('',$data);

?>