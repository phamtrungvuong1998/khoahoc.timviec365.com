<?php
include '../config/config.php';
$pass = getValue('pass', 'str', 'POST', '', '');
$passnew = getValue('passnew', 'str', 'POST', '', '');
$user_id = $_COOKIE['user_id'];

if ($pass != '' && $passnew != '') {
    $id = [
        'user_id' => $user_id
    ];
    $a = md5($pass);
    $db_pass = new db_query("SELECT user_pass FROM users WHERE user_id ='$user_id'AND user_pass = '$a'");
    $result = mysql_fetch_assoc($db_pass->result);
    if ($result > 0) {
        $new = md5($passnew);
        $update = [
            'user_pass' => $new,
        ];
        update('users',$update,$id);
        $data = [
            'result' => 1,
            'message' => 'Cập nhật mật khẩu thành công',
        ];
    } else {
        $data = [
            'result' => 2,
            'message' => 'Mật khẩu không chính xác',
        ];
    }
} else {
    $data = [
        'result' => 3,
        'message' => 'Cập nhật mật khẩu thất bại',
    ];
}
echo json_encode($data);
