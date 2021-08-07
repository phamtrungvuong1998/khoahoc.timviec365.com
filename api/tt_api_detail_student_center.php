<?
include '../config/config.php';
include 'functions.php';
$token = getValue('token', 'str', 'POST', '', '');
$student_id = getValue('student_id', 'int', 'POST', '', '');

use Firebase\JWT\JWT;

if ($token != '') {
    $token = JWT::decode($token, $key, ['HS256']);
    if (isset($token->user_id) && $token->user_type == 3) {
        $id = $token->user_id;
        if ($student_id != 0) {
            $db_student = new db_query("SELECT users.user_id,user_name,user_avatar,user_birth,cit_id,district_id,user_address,cate_id,user_phone, user_mail FROM save_student JOIN users ON save_student.user_student_id = users.user_id WHERE save_student.user_student_id = '$student_id'");
            $student = [];
            $total = 0;
            while ($row = mysql_fetch_assoc($db_student->result)) {
                $student_id = $row['user_id'];
                $db_count = new db_query("SELECT user_student_id,certification_complete FROM orders Where user_student_id = '$student_id'");
                $count_order = 0;
                $certification_complete = 0;
                while ($value = mysql_fetch_assoc($db_count->result)) {
                    if ($value['certification_complete'] > 0) {
                        $certification_complete++;
                    }
                    $count_order++;
                }
                // $count_order = mysql_num_rows($db_count->result);
                $db_count_course = new db_query("SELECT user_student_id FROM order_student_common Where user_student_id = '$student_id'");
                $count_common = mysql_num_rows($db_count_course->result);
                $total = $count_order + $count_common;
                $a = $row['user_id'];
                $student[$a] = $row;
                $student[$row['user_id']]['da_mua'] = $total;
                $student[$row['user_id']]['chung_chi'] = $certification_complete;
            }
            success('', $student);
        }else {
            set_error('404', 'Không có thông tin học viên');
        }
    } else {
        set_error('404', 'Phải đăng nhập tài khoản của trung tâm');
    }
} else {
    set_error('404', 'Phải đăng nhập trước');
}
