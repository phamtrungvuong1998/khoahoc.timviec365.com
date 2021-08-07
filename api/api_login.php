<?php
include_once '../config/config.php';
include_once 'functions.php';
use Firebase\JWT\JWT;
$email = getValue('email','str','POST','');
$pass = getValue('pass','str','POST','');
$user_type = getValue('user_type','int','POST','');
if($email != '' && $pass != ''){
	$pass = md5($pass);
    $db_user = new db_query("SELECT * FROM users WHERE user_mail = '$email' AND user_pass = '$pass' AND user_type = $user_type");
    $user=mysql_fetch_assoc($db_user->result);
    if (mysql_num_rows($db_user->result) > 0) {
        if ($user['user_active'] == 0) {
            set_error('404','Tài khoản chưa được kích hoạt');
        }else{
            $arr_token['user_id'] = $user['user_id'];
            $arr_token['user_type'] = $user['user_type'];

            $token = JWT::encode($arr_token,$key);
            $data = [
                'token' => $token,
            ];
            success('Đăng nhập thành công',$data);
        }
    }else{
        set_error('404','Tài khoản hoặc mật khẩu không chính xác');
    }
}else{
    set_error('404','Không được để trống');
}
?>