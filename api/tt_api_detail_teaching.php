<?php
include_once 'api_info.php';
if ($user_type != 2 || $user_type != 3) {
    set_error('404','Bạn phải đăng nhập tài khoản trung tâm hoặc giảng viên');
    die();
}
$course_id = getValue('course_id','int','POST','');
if ($course_id != 0) {
    $course_on = [];
    $db_course = new db_query("SELECT courses.course_id,course_name,cate_name,teacher_name,time_learn,course_slide,courses.created_at,price_listed FROM courses INNER JOIN user_center_teacher ON courses.center_teacher_id = user_center_teacher.center_teacher_id INNER JOIN categories ON courses.cate_id=categories.cate_id WHERE courses.course_id = '$course_id'");
    $row = mysql_fetch_assoc($db_course->result);
    $course_on[$row['course_id']] = $row;
    success('',$course_on);
}else {
    set_error('404','Không có thông tin giảng viên');
}

?>