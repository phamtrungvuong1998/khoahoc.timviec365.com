<?
include_once 'api_info.php';
if ($user_type != 2 || $user_type != 3) {
    set_error('404','Bạn phải đăng nhập tài khoản trung tâm hoặc giảng viên');
    die();
}
$db_common = new db_query("SELECT common_id,course_name,teacher_name,course_avatar FROM order_common INNER JOIN courses ON courses.course_id = order_common.course_id INNER JOIN user_center_teacher ON user_center_teacher.center_teacher_id = courses.center_teacher_id WHERE courses.user_id = '$user_id' ORDER BY common_id DESC");
$list = [];
while ($row = mysql_fetch_assoc($db_common->result)) {
    $list[$row['common_id']] = $row;
}
success('',$list);
?>