<?
include_once 'api_info.php';

if ($user_type !2 || $user_type != 3) {
	set_error('404','Bạn phải đăng nhập tài khoản giảng viên hoặc trung tâm');
	die();
}
$db_course = new db_query("SELECT order_id,courses.course_id,course_name,teacher_name,course_avatar FROM `orders` INNER JOIN users ON orders.user_student_id = users.user_id INNER JOIN courses ON orders.course_id = courses.course_id INNER JOIN user_center_teacher ON courses.center_teacher_id = user_center_teacher.center_teacher_id WHERE orders.course_type = 1 AND courses.user_id = '$user_id' ORDER BY order_id DESC");
$offline = [];
while ($row=mysql_fetch_assoc($db_course->result)) {
    $offline[] = $row;
}
success('',$offline);
?>