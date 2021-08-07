<?php

use Firebase\JWT\JWT;

require_once '../config/config.php';
include 'functions.php';
// print_r($_POST['l_city']);
// die();
$token = getValue('token', 'str', 'POST', '', '');
if ($token != '') {
    $token = JWT::decode($token, $key, ['HS256']);
    $id = $token->user_id;
    // echo $id;
    // die();
    $upload_location = "../img/uploads/";
    $upload_avatar = "../img/avatar/";
    // echo "<pre>";
    // print_r($_FILES['files']);
    // echo "</pre>";
    // echo $domain;
    // die();
    $user_1 = [
        'user_id' => $id,
    ];
    $today = strtotime(date("d-m-Y"));
    $l_name = getValue('l_name', 'str', 'POST', '', ''); //
    $l_phone = getValue('l_phone', 'str', 'POST', '', ''); //
    $l_time = getValue('l_time', 'str', 'POST', '', ''); //
    $l_chude = getValue('l_chude', 'str', 'POST', '', ''); //

    $l_check = getValue('l_check', 'str', 'POST', '', '');
    $l_thue = getValue('l_thue', 'str', 'POST', '', ''); //
    $l_introduce = getValue('l_introduce', 'str', 'POST', '', ''); //
    $l_link = getValue('l_link', 'str', 'POST', '', ''); //
    $l_tienich = getValue('l_tienich', 'str', 'POST', '', ''); //

    $l_city = getValue('l_city', 'str', 'POST', '', ''); //
    // var_dump($l_city);
    $l_district = getValue('l_district', 'arr', 'POST', '', ''); //
    $l_address = getValue('l_address', 'arr', 'POST', '', ''); //

    $l_img = getValue('files', 'arr', 'POST', '', '');
    $allowed_image_extension = array(
        "jpeg", "JPEG", "png", "PNG", "jpg", "JPG"
    );

    if ($l_name != "" && $l_phone != "" && $l_time != "" && $l_chude != "" && $l_check != "" && $l_thue != "" && $l_introduce != "" && $l_link != "" && $l_tienich != "" && $l_city != "" && $l_district != "" && $l_address != "") {
        $select_user = new db_query("SELECT * FROM users Where user_name = '$l_name' AND user_type = 3 AND user_id != '$id'");
        if (mysql_num_rows($select_user->result) > 0) {
            set_error('404','Tên trung tâm đã tồn tại');
            // echo "@#$%^&*(";
        } else {
            // die();
            // print_r($user);
            // die();
            $cit = explode(',', $l_city);
            $dis = explode(',', $l_district);
            $address = explode(',', $l_address);
            $file_avatar = '';
           
            // avatar
            if (isset($_FILES['file'])) {
                // die();
                $del_img = new db_query("SELECT user_avatar FROM users WHERE user_id =" . $id);
                $row_img = mysql_fetch_assoc($del_img->result);
                $img = $upload_avatar . $row_img['user_avatar'];
                if (is_writable($img)) {
                    unlink($img);
                }

                $avatar = $_FILES['file']['name'];
                $ext_img = strtolower(pathinfo($avatar, PATHINFO_EXTENSION));
                $_FILES['file']['name'] = md5(rand()) . '.' . $ext_img;
                $file_avatar = $_FILES['file']['name'];
                $path_avatar = $upload_avatar . $file_avatar;
                // echo $file_avatar;
                // die();
                if (in_array($ext_img, $allowed_image_extension)) {
                    move_uploaded_file($_FILES['file']['tmp_name'], $path_avatar);
                    $user = [
                        'user_name' => $l_name,
                        'user_phone' => $l_phone,
                        'user_birth' => $l_time,
                        'cate_id' => $l_chude,
                        'user_avatar' => $file_avatar,
                        'updated_at' => $today,
                    ];
                    update('users', $user, $user_1);
                } else {
                    set_error('404','Vui lòng chọn đúng định dạng ảnh');
                }
            } else {
                $user = [
                    'user_name' => $l_name,
                    'user_phone' => $l_phone,
                    'user_birth' => $l_time,
                    'cate_id' => $l_chude,
                    'updated_at' => $today,
                ];
                // echo "12345678";
                // die();
                update('users', $user, $user_1);
            }
            // die();
            $user_center = [
                'advantages_id' => $l_check,
                'tax_code' => $l_thue,
                'center_intro' => $l_introduce,
                'link_student_community' => $l_link,
                'central_advant' => $l_tienich
            ];
            // print_r($user);
            update('user_center', $user_center, $user_1);
            // die();
            $del = new db_query("DELETE FROM user_center_basis Where user_id = '$id'");
            for ($i = 0; $i < count($cit); $i++) {
                $user_basic = [
                    'user_id' => $id,
                    'cit_id' => $cit[$i],
                    'district_id' => $dis[$i],
                    'center_basis_address' => $address[$i]
                ];
                add('user_center_basis', $user_basic);
            }
            //album img
            if ($l_img != '') {
                $a = count($l_img);
                $i = 0;
                $delfile = new db_query("SELECT * FROM user_center_img WHERE user_id =" . $id);
                $arr = [];
                while ($rowimg = mysql_fetch_assoc($delfile->result)) {
                    $arr[] =  $rowimg['center_img'];
                }
                if (count($arr) > 0) {
                    $new = array_diff($arr, $l_img);
                }
                foreach ($new as $value) {
                    $del = $upload_location . $value;
                    if (is_writable($del)) {
                        unlink($del);
                    }
                    $delimg = new db_query("DELETE FROM user_center_img Where user_id = '$id' AND center_img = '$value'");
                }
            }

            if (isset($_FILES['files'])) {
                $countfiles = count($_FILES['files']['name']);
                if ($countfiles == 6) {
                    $delfile = new db_query("SELECT * FROM user_center_img WHERE user_id =" . $id);
                    while ($rowimg = mysql_fetch_assoc($delfile->result)) {
                        $bool_img = $upload_location . $rowimg['center_img'];
                        if (is_writable($bool_img)) {
                            unlink($bool_img);
                        }
                    }
                    $delimg = new db_query("DELETE FROM user_center_img Where user_id = " . $id);
                }
                $files_arr = array();
                for ($index = 0; $index < $countfiles; $index++) {
                    if (isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != '') {
                        $filename = $_FILES['files']['name'][$index];
                        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        $valid_ext = array("png", "jpeg", "jpg");
                        $_FILES['files']['name'][$index] = md5(rand()) . '.' . $ext;
                        $filenew = $_FILES['files']['name'][$index];
                        $path = $upload_location . $filenew;
                        move_uploaded_file($_FILES['files']['tmp_name'][$index], $path);
                        // if (move_uploaded_file($_FILES['files']['tmp_name'][$index], $path)) {
                        //     $files_arr[] = $path;
                        // }
                        $add = [
                            'user_id' => $_COOKIE['user_id'],
                            'center_img' => $filenew
                        ];
                        add('user_center_img', $add);
                    }
                }
            }
            $data = [
                'result' => true,
            ];
            success('Cập nhật thông tin trung tâm thành công',$data);
        }
    } else {
        set_error('404','Bạn phải điền đầy đủ thông tin');
    }
}else {
    set_error('404','Bạn phải đăng nhập trước');
}
