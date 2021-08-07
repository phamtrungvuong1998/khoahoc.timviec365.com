<?
use Firebase\JWT\JWT;

include '../config/config.php';
include 'functions.php';

$student_id = getValue('student_id', 'int', 'POST', 0, 0);
$token = getValue('token', 'str', 'POST', '', '');

if ($token != '') {
    $token = JWT::decode($token, $key, ['HS256']);
    $user_id = $token->user_id;
    $cook_id = [
        'user_id'=>$user_id,
    ];
    if ($student_id != 0) {
        $data = [
            'user_student_id' => $student_id,
            'center_teacher_id' => $user_id,
            'point_minus' => 1,
            'type_point' => 1
        ];
        add('history_point', $data);
        $db_point = new db_query("SELECT * FROM points where user_id = '$user_id'");
        $row = mysql_fetch_assoc($db_point->result);
        $total = $row['point'];
        $total_add = $row['point_add_total'];
        if ($total > 0) {
            $total2 = $total - 1;
            $total3 = $row['point_minus_total'] + 1;
            $data2 = [
                'point' => $total2,
                'point_minus_total' => $total3
            ];
            update('points', $data2, $cook_id);
        } else if ($total == 0 && $total_add > 0) {
            $total_add1 = $total_add - 1;
            $total_add2 = $row['point_minus_total'] + 1;
            $data3 = [
                'point_add_total' => $total_add1,
                'point_minus_total' => $total_add2
            ];
            update('points', $data3, $cook_id);
        }
        $select = new db_query("SELECT * FROM users where user_id = '$student_id'");
        $rowid = mysql_fetch_assoc($select->result);
        $list_point[] = $rowid['user_mail'];
        // echo 'nhanh';
        $list_point[] = $rowid['user_phone'];

        success('Mua từ điểm thành công ', $list_point);
    } else {
        set_error('404', 'Bạn không đủ điểm để xem thông tin học viên');
    }
}else {
    set_error('404', 'Bạn phải đăng nhập trước');
}
