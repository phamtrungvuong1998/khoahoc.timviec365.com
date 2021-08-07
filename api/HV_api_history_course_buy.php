<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$qr = new db_query("SELECT * FROM orders INNER JOIN courses ON orders.course_id = courses.course_id WHERE orders.user_student_id = $user_id");
$data['history_course_buy'] = [];
while($row = mysql_fetch_array($qr->result)){
    $data['history_course_buy'][$row['course_id']]['course_id'] = $row['course_id'];
    $data['history_course_buy'][$row['course_id']]['course_name'] = $row['course_name'];
}
success('',$data);
?>