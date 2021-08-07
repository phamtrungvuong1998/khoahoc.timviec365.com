<?
include_once 'api_info.php';

if ($user_type != 2 || $user_type != 3) {
    set_error('404','Bạn phải đăng nhập tài khoản trung tâm hoặc giảng viên');
    die();
}
$db_list = new db_query("SELECT rate_id,comment_rate,course_type,lesson,teacher,video FROM rate_course INNER JOIN courses ON rate_course.course_id =  courses.course_id WHERE courses.user_id = '$user_id' ORDER BY rate_id DESC");
$list = [];
while ($row = mysql_fetch_assoc($db_list->result)) {
    $b = '';
    $star = 0;
    if ($row['course_type'] == 1) {
        $total = ($row['lesson'] + $row['teacher']) / 2;
        $a = round($total, 1);
        if ($a >= 1 && $a < 2) {
            $star = 1;
        } else if ($a >= 2 && $a < 3) {
            $star = 2;
        } else if ($a >= 3 && $a < 4) {
            $star = 3;
        } else if ($a >= 4 && $a < 5) {
            $star = 4;
        } else if ($a == 5) {
            $star = 5;
        }
    } else {
        $total = ($row['lesson'] + $row['teacher'] + $row['video']) / 3;
        $a = round($total, 1);
        if ($a >= 1 && $a < 2) {
            $star = 1;
        } else if ($a >= 2 && $a < 3) {
            $star = 2;
        } else if ($a >= 3 && $a < 4) {
            $star = 3;
        } else if ($a >= 4 && $a < 5) {
            $star = 4;
        } else if ($a == 5) {
            $star = 5;
        }
    }
    $list[$row['rate_id']] = $row;
    $list[$row['rate_id']]['star'] = $star;
}
success('',$list);

?>