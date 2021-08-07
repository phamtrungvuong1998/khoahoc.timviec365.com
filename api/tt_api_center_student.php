<?
include '../config/config.php';
include 'functions.php';
$token = getValue('token','str','GET','','');
use Firebase\JWT\JWT;
if ($token != '') {
    $token = JWT::decode($token, $key, ['HS256']);
    if (isset($token->user_id) && ($token->user_type == 3 || $token->user_type == 2)) {
       $id =$token->user_id;
       $db_student = new db_query("SELECT users.user_id,user_name,user_avatar,user_birth,cit_id,district_id,user_address,cate_id FROM save_student JOIN users ON save_student.user_student_id = users.user_id WHERE save_student.user_teacher_id = '$id' order by save_id DESC");
        $student = [];
        $total = 0;
        while ($row = mysql_fetch_assoc($db_student->result)) {
            $student_id = $row['user_id'];
            $db_count = new db_query("SELECT user_student_id,certification_complete FROM orders Where user_student_id = '$student_id'");
            $a = $row['user_id'];
            $student[$a] = $row;
        }
       success('',$student);
    }else {
        set_error('404','Phải đăng nhập tài khoản của trung tâm hoặc giảng viên');
    }
}else {
    set_error('404','Phải đăng nhập trước');
}
?>