<?php
include_once '../config/config.php';
include_once '../api/functions.php';
$site = getValue('site_from', 'int', 'POST', 0);
$email = getValue('email', 'str', 'POST', '');
$password = getValue('password', 'str', 'POST', '');
if ($site == 1) {
    $password_md5 = $password;
}else{
    $password_md5 = md5($password);
}
$name = getValue('name', 'str', 'POST', '');
$alias = replaceTitle($name);
$phone_num = getValue('phone', 'str', 'POST', '');
$birthday = getValue('birthday', 'str', 'POST', '');
if ($birthday != '') {
    $birthday = date('Y-m-d', strtotime($birthday));
}
$gender = getValue('gender', 'str', 'POST', '');
if($gender == 'nam'){
    $gt = 1;
}else if($gender == 'nu'){
    $gt = 2;
}else{
    $gt = 0;
}
$city = getValue('city_id', 'int', 'POST', 0);
$district = getValue('district_id', 'int', 'POST', 0);
$address = getValue('address', 'str', 'POST', '');
$avatar = getValue('avatar', 'str', 'POST', '');
$time = time();

if ($email != '' && $password != '' && $name != '' && $phone_num != '') {
    $qr_check = new db_query("SELECT COUNT(*) AS dem FROM users WHERE user_mail = '$email' && user_type = '1'");
    $row = mysql_fetch_assoc($qr_check->result);
    if ($row['dem'] > 0) {
        $data = [
            'result' => false,
            'message' => 'Email đã tồn tại!',
        ];
    } else {
        if (strlen($password) < 6) {
            $msg = "Độ dài mật khẩu lớn hơn hoặc bằng 6 ký tự!";
            $data = [
                'result' => false,
                'message' => $msg,

            ];
        } else {
            $vnf_regex = "/^[0]{1}[93785]{1}[0-9]{8}$/";
            if (!preg_match($vnf_regex, $phone_num)) {
                $msg = "Số điện thoại không hợp lệ.";
                $data = [
                    'result' => false,
                    'message' => $msg,
                ];
            } else {
                //                ------luu anh--------
                if ($avatar != '') {
                    $avt = explode('/', $avatar);
                    $logo = end($avt);
                    $path_file = "../img/avatar/";

                    $temp = explode(".", $logo);
                    $newfile = time() . md5($email) . '.' . end($temp);

                    $target = $path_file. $newfile;
//                    echo $target;die;
                    file_put_contents($target, file_get_contents($avatar));
//----------
                } else {
                    $newfile = '';
                }

                $qr_insert = new db_query("
                        INSERT INTO users(user_mail,user_pass,user_name,user_slug,user_phone,user_birth,cit_id,
                        district_id,user_address,user_type,user_active,user_money,created_at,updated_at,user_avatar,user_gender,site_from) 
                        VALUES ('$email','$password_md5','$name','$alias','$phone_num','$birthday','$city',
                        '$district','$address','1','0','0','$time','$time','$newfile','$gt','$site')");

                $id = mysql_insert_id();
                $token = md5($email . $time);
                $date = date('Y-m-d H:s:i');
                $qr_insert_token = new db_query("
                        INSERT INTO tokens(user_id,token,created_at) 
                        VALUES ('$id','$token','$date')");
                $msg = 'Đăng ký thành công, hãy xác nhận email của bạn để hoàn tất đăng ký!';
                $data = [
                    'result' => true,
                    'message' => $msg,
                ];
            }
        }
    }
} else {
    $msg = "Cần nhập đầy đủ thông tin nhé!";
    $data = [
        'result' => false,
        'message' => $msg,

    ];
}
echo json_encode($data,JSON_UNESCAPED_UNICODE);
