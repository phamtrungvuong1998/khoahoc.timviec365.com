<?php
include_once '../config/config.php';
include_once '../api/functions.php';
$email = getValue('email', 'str', 'POST', '');
$password = getValue('password', 'str', 'POST', '');
$new_password = getValue('new_password', 'str', 'POST', '');
$password_md5 = md5($password);
$new_password_md5 = md5($new_password);
$time = time();
if ($email != '' && $password != '' && $new_password != '') {
    $qr_check = new db_query("SELECT count(*) as dem FROM users WHERE user_mail = '$email' && user_pass = '$password_md5' && user_type = '1'");
    $row_check = mysql_fetch_assoc($qr_check->result);
    if ($row_check['dem'] > 0) {
        if(strlen($new_password) >= 6){
            $qr_update = new db_query("UPDATE users SET user_pass = '$new_password_md5', updated_at ='$time' WHERE user_mail = '$email' && user_type = '1'");
            $msg = "Đổi mật khẩu thành công!";
            $data = [
                'result' => true,
                'message' => $msg,
            ];
        }else{
            $msg = "Độ dài mật khẩu lớn hơn hoặc bằng 6 ký tự!";
            $data = [
                'result' => false,
                'message' => $msg,
            ];
        }


    }else{
        $msg = "Tài khoản hoặc mật khẩu không đúng!";
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
