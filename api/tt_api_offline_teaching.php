<?
include_once 'api_info.php';
if ($user_type != 2 || $user_type != 3) {
	set_error('404','Bạn phải đăng nhập tài khoản trung tâm hoặc giảng viên');
	die();
}

$db_online = new db_query("SELECT courses.course_id,course_name,teacher_name,course_avatar FROM courses INNER JOIN user_center_teacher ON courses.center_teacher_id = user_center_teacher.center_teacher_id WHERE courses.user_id = '$user_id' AND course_type = 1 AND courses.hide_course = 1 AND courses.accept = 1");
$online = [];
while ($row = mysql_fetch_assoc($db_online->result)) {
    $online[$row['course_id']] = $row;
}
success('',$online);
?>