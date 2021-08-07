<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$qr = new db_query("SELECT courses.course_id, course_name, course_avatar, user_name FROM orders INNER JOIN courses ON courses.course_id = orders.course_id INNER JOIN users ON courses.user_id = users.user_id WHERE orders.user_student_id = $user_id");
$data['course_bought'] = [];
while ($row = mysql_fetch_array($qr->result)) {
    $data['course_bought'][$row['course_id']]['course_name'] = $row['course_name'];
    $data['course_bought'][$row['course_id']]['course_avatar'] = $row['course_avatar'];
    $data['course_bought'][$row['course_id']]['user_name'] = $row['user_name'];
}

success('',$data);
?>