<?php
include_once '../config/config.php';
include_once '../api/functions.php';
$email = getValue('email', 'str', 'POST', '');

if ($email != '') {
    $qr_check = new db_query("SELECT user_mail, user_active FROM users WHERE user_mail = '$email' && user_type = '1'");
    if (mysql_num_rows($qr_check->result) > 0) {
        $row_check = mysql_fetch_assoc($qr_check->result);
        if($row_check['user_active'] == 0){
            $qr_update = new db_query("UPDATE users SET user_active = '1' WHERE user_mail = '$email' && user_type = '1'");
            $msg = "Kích hoạt tài khoản thành công!";
            $data = [
                'result' => true,
                'message' => $msg,
            ];
        }else{
            $msg = "Tài khoản này đã kích hoạt rồi";
            $data = [
                'result' => false,
                'message' => $msg,
            ];
        }
    }else{
        $msg = "Tài khoản này hiện chưa được đăng ký trên hệ thống!";
        $data = [
            'result' => false,
            'message' => $msg,
        ];
    }

}else{
    $msg = "Cần nhập đầy đủ thông tin nhé!";
    $data = [
        'result' => false,
        'message' => $msg,

    ];
}
echo json_encode($data,JSON_UNESCAPED_UNICODE);
