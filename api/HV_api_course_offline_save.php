<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$qr = new db_query("SELECT courses.course_id, users.user_id, course_avatar, course_name, user_name FROM courses INNER JOIN save_course ON courses.course_id = save_course.course_id INNER JOIN users ON courses.user_id = users.user_id WHERE save_course.user_student_id = $user_id AND courses.course_type = 1");
$data['save_course_offline'] = [];
while ($row = mysql_fetch_array($qr->result)) {
    $data['save_course_offline'][$row['course_id']]['course_avatar'] = $row['course_avatar'];
    $data['save_course_offline'][$row['course_id']]['course_name'] = $row['course_name'];
    $data['save_course_offline'][$row['course_id']]['teacher_name'] = $row['user_name'];
}

success('',$data);
?>