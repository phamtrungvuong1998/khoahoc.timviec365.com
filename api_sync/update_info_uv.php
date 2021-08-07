<?php
include_once '../config/config.php';
include_once '../api/functions.php';
$email = getValue('email', 'str', 'POST', '');
$name = getValue('name', 'str', 'POST', '');
$gender = getValue('gender', 'str', 'POST', '');
$birthday = getValue('birthday', 'str', 'POST', '');
$address = getValue('address', 'str', 'POST', '');
$phone_num = getValue('phone', 'str', 'POST', '');
$city = getValue('city_id', 'int', 'POST', 0);
$district = getValue('district_id', 'int', 'POST', 0);
$avatar = getValue('avatar', 'str', 'POST', '');
$time = time();
if ($email != '') {
    $qr_check = new db_query("SELECT user_birth,user_gender,user_name,user_address,cit_id,district_id,user_avatar,user_phone FROM users WHERE user_mail = '$email' && user_type = '1'");
    if (mysql_num_rows($qr_check->result) > 0) {
        $row = mysql_fetch_assoc($qr_check->result);
        if ($birthday == '') {
            $birthday = $row['user_birth'];
        } else {
            $birthday = date('Y-m-d', strtotime($birthday));
        }
        if ($gender == '') {
            $gt = $row['user_gender'];
        } else if ($gender == 'nam') {
            $gt = 1;
        } else {
            $gt = 2;
        }
        if ($name == '') {
            $name = $row['user_name'];
        }
        if ($address == '') {
            $address = $row['user_address'];
        }
        if ($city == 0) {
            $city = $row['cit_id'];
        }
        if ($district == 0) {
            $district = $row['district_id'];
        }
        if ($phone_num == '') {
            $phone_num = $row['user_phone'];
        }
        $vnf_regex = "/^[0]{1}[93785]{1}[0-9]{8}$/";
        if (!preg_match($vnf_regex, $phone_num)) {
            $msg = "Số điện thoại không hợp lệ.";
            $data = [
                'result' => false,
                'message' => $msg,
            ];
        } else {
            if ($avatar != '') {

//                ------luu anh--------
                $oldfilename = $row['user_avatar'];
                $avt = explode('/', $avatar);
                $logo = end($avt);
                $path_file = "../img/avatar/";

                $temp = explode(".", $logo);
                $newfile = time() . md5($email) . '.' . end($temp);
                if ($oldfilename != '') {
                    @unlink($path_file . $oldfilename);
                }

                $target = $path_file . $newfile;
//                    echo $target;die;
                file_put_contents($target, file_get_contents($avatar));
//----------

            } else {
                $newfile = $row['user_avatar'];
            }
            $qr_update = new db_query("
            UPDATE users 
            SET user_birth = '$birthday',user_gender = '$gt',user_name = '$name', user_address = '$address',
            cit_id = '$city',district_id = '$district', user_avatar = '$newfile', updated_at = '$time',user_phone = '$phone_num'
            WHERE user_mail = '$email' && user_type = '1'");
            $msg = 'Cập nhật thành công!';
            $data = [
                'result' => true,
                'message' => $msg
            ];
        }

    } else {
        $msg = 'Sai thông tin tài khoản!';
        $data = [
            'result' => false,
            'message' => $msg
        ];
    }

} else {
    $msg = "Bạn chưa đăng nhập";
    $data = [
        'result' => false,
        'message' => $msg,

    ];
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
