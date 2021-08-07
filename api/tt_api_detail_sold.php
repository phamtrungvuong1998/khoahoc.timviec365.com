<?php
include_once 'api_info.php';
$order_id = getValue('order_id','int','POST','','');
if ($user_type != 2 || $user_type != 3) {
    set_error('404','Bạn phải đăng nhập tài khoản trung tâm hoặc giảng viên');
    die();
}
if ($order_id != 0) {
    $db_course = new db_query("SELECT order_id,user_name,user_mail,user_phone,day_buy,total_prices,order_status,courses.course_id,course_name FROM `orders` INNER JOIN users ON orders.user_student_id = users.user_id INNER JOIN courses ON orders.course_id = courses.course_id INNER JOIN user_center_teacher ON courses.center_teacher_id = user_center_teacher.center_teacher_id WHERE orders.order_id = '$order_id' AND courses.user_id = '$user_id' ORDER BY order_id DESC");
    $sold = [];
    while ($row=mysql_fetch_assoc($db_course->result)) {
        $sold[] = $row;
    }
    success('',$sold);
}else {
    set_error('404','Không có khóa học');
}
?>