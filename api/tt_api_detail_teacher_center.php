<?
include '../config/config.php';
include 'functions.php';
$token = getValue('token', 'str', 'GET', '', '');
$teacher_id = getValue('teacher_id', 'int', 'GET', '', '');

use Firebase\JWT\JWT;

if ($token != '') {
    $token = JWT::decode($token, $key, ['HS256']);
    if (isset($token->user_id) && $token->user_type == 3) {
        $id = $token->user_id;
        if ($teacher_id != 0) {
            $db_teacher = new db_query("SELECT cate_id,center_teacher_id,teacher_name,teacher_avatar FROM user_center_teacher WHERE user_id = '$id' AND center_teacher_id = '$teacher_id'");
            $teacher = [];
            while ($row_teacher = mysql_fetch_assoc($db_teacher->result)) {
                $id_teacher = $row_teacher['center_teacher_id'];
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
                    $star = $total;
                } else if ($total >= 1 && $total < 2) {
                    $star = $total;
                } else if ($total >= 2 && $total < 3) {
                    $star = $total;
                } else if ($total >= 3 && $total < 4) {
                    $star = $total;
                } else if ($total >= 4 && $total < 5) {
                    $star = $total;
                } else if ($total == 5) {
                    $star = $total;
                }
                $db_course = new db_query("SELECT course_id,course_name,course_avatar FROM courses WHERE center_teacher_id = '$id_teacher'");
                $num_course = 0;
                $arr = [];
                while ($row = mysql_fetch_assoc($db_course->result)) {
                    $num_course++;
                    $arr[$row['course_id']] = $row;
                }
                $teacher[$id_teacher]['index'] = $row_teacher;
                $teacher[$id_teacher]['star'] = $star;
                $teacher[$id_teacher]['num_course'] = $num_course;
                $teacher[$id_teacher]['course_teacher'] = $arr;
            }
            success('', $teacher);
        }else {
            set_error('404', 'Không có thông tin giảng viên');
        }
    } else {
        set_error('404', 'Phải đăng nhập tài khoản của trung tâm');
    }
} else {
    set_error('404', 'Phải đăng nhập trước');
}
