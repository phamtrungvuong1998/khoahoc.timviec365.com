<?
include '../config/config.php';
include 'functions.php';
$token = getValue('token', 'str', 'GET', '', '');

use Firebase\JWT\JWT;

if ($token != '') {
    $token = JWT::decode($token, $key, ['HS256']);
    if (isset($token->id) && $token->user_type == 3) {
        $id = $token->id;
        $db_teacher = new db_query("SELECT cate_id,center_teacher_id,teacher_name,teacher_avatar,date_join FROM user_center_teacher WHERE user_id = '$id'");
        $teacher = [];
        while ($row = mysql_fetch_assoc($db_teacher->result)) {
            $id_teacher = $row['center_teacher_id'];
            $db_star = new db_query("SELECT teacher FROM rate_course INNER JOIN courses ON rate_course.course_id = courses.course_id WHERE courses.center_teacher_id = '$id_teacher'");
            $dem = (int) 0;
            $tong = (int) 0;
            while ($row_rate = mysql_fetch_assoc($db_star->result)) {
                $b = $row_rate['teacher'];
                $tong += $b;
                $dem++;
            }
            $total = 0;
            if ($dem > 1) {
                $a = (int) $tong / $dem;
                $total = round($a, 1);
            } else {
                $total = round($tong, 1);
            }

            if ($total >= 0 && $total < 1) {
                $start= $total;
            } else if ($total >= 1 && $total < 2) {
                $start= $total;
            } else if ($total >= 2 && $total < 3) {
                $start= $total;
            } else if ($total >= 3 && $total < 4) {
                $start= $total;
            } else if ($total >= 4 && $total < 5) {
                $start= $total;
            } else if ($total == 5) {
                $start= $total;
            }
            $teacher[$row['center_teacher_id']] = $row;
            $teacher[$row['center_teacher_id']]['start'] = $start;
        }
        success('', $teacher);
    } else {
        set_error('404', 'Phải đăng nhập tài khoản của trung tâm');
    }
} else {
    set_error('404', 'Phải đăng nhập trước');
}
