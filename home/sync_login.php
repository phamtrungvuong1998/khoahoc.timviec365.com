<?php
//-------đồng bộ đăng nhập----------
if (isset($_COOKIE['general_login']) && $_COOKIE['general_login'] !== '') {
    $info = json_decode($_COOKIE['general_login']);
    $page_login = $info->page_login;
    if (isset($info->check_ntd) && $info->check_ntd !== '') {
        $check_ntd = $info->check_ntd;
    }
    $from = $info->from;
    $site = 0;
    if($page_login == 5){
        $site = 0;
    }else{
        foreach ($array_nguon_dk as $k=>$v){
            if($from == $v){
                $site = $k;
            }
        }
    }
    $email = $info->email;
    $email_md5 = md5($email);
    $phone = $info->phone;
    $name = $info->name;
    $alias = replaceTitle($name);
    $cit_id = $info->cit_id;
    $district_id = $info->district_id;
    $address = $info->address;
    $passw = $info->pw;
    $avatar = $info->avatar;
    $active = $info->active;
    $time = time();
    if ($page_login == 2) {
        $active = 1;
    }
//ntd
    if (!isset($check_ntd) || (isset($check_ntd) && $check_ntd == 1)) {
        $qr_check = new db_query("SELECT user_id  FROM users WHERE user_mail = '$email' && user_type = '3'");
        if (mysql_num_rows($qr_check->result) > 0) {
            $row_user = mysql_fetch_assoc($qr_check->result);
            if (isset($_COOKIE['user_type'])) {
                setcookie('user_type', '', time() - 7 * 6000, '/');
            }
            if (isset($_COOKIE['user_id'])) {
                setcookie('user_id', "", time() - 7 * 6000, '/');
            }
            if (isset($_COOKIE['PHPSESPASS'])) {
                setcookie('PHPSESPASS', "", time() - 7 * 6000, '/');
            }
            setcookie('user_type', 3, time() + 7 * 6000, '/');
            setcookie('user_id', $row_user['user_id'], time() + 7 * 6000, '/');
            setcookie('PHPSESPASS', $email_md5, time() + 7 * 6000, '/');

        } else {
            if ($avatar != '') {
//        ------luu anh--------
                $avt = explode('/', $avatar);
                $logo = end($avt);
                $path_file = "../img/avatar/";

                $temp = explode(".", $logo);
                $newfile = time() . md5($email) . '.' . end($temp);

                $target = $path_file . $newfile;
                file_put_contents($target, file_get_contents($avatar));
//----------
            } else {
                $newfile = '';
            }


            if ((($page_login == 6 || $page_login == 4 || $page_login == 3 || $page_login == 1) && $check_ntd == 1) || $page_login == 2) {
                $qr_insert = new db_query("
            INSERT INTO users(user_name,user_mail,user_phone,user_pass,user_slug,user_type,created_at,updated_at,user_active,user_avatar,site_from)
            VALUES ('$name','$email','$phone','$passw','$alias','3','$time','$time','$active','$newfile','$site')");
                $id = mysql_insert_id();

                $qr_center_basis = new db_query("INSERT INTO user_center_basis(user_id,cit_id,district_id,center_basis_address) 
                VALUES ('$id','$cit_id','$district_id','$address')");

                $token = md5(time() . $email);
                $qr_token = new db_query("INSERT INTO tokens(user_id,token) VALUES ('$id','$token')");
                $qr_center = new db_query("INSERT INTO user_center(user_id) VALUES ('$id')");
                if (isset($_COOKIE['user_type'])) {
                    setcookie('user_type', '', time() - 7 * 6000, '/');
                }
                if (isset($_COOKIE['user_id'])) {
                    setcookie('user_id', "", time() - 7 * 6000, '/');
                }
                if (isset($_COOKIE['PHPSESPASS'])) {
                    setcookie('PHPSESPASS', "", time() - 7 * 6000, '/');
                }
                setcookie('user_type', 3, time() + 7 * 6000, '/');
                setcookie('user_id', $id, time() + 7 * 6000, '/');
                setcookie('PHPSESPASS', $email_md5, time() + 7 * 6000, '/');
            }

        }
        if (isset($_COOKIE['general_login']) && (!isset($_COOKIE['user_type']) || !isset($_COOKIE['user_id']))) {
            header('Refresh: 0');
        }
    }

//ứng vien
    if (isset($check_ntd) && $check_ntd == 2) {
        $qr_check_uv = new db_query("SELECT user_id FROM users WHERE user_mail = '$email' && user_type = '1'");
        if (mysql_num_rows($qr_check_uv->result) > 0) {
            $row_uv = mysql_fetch_assoc($qr_check_uv->result);
            if (isset($_COOKIE['user_type'])) {
                setcookie('user_type', '', time() - 7 * 6000, '/');
            }
            if (isset($_COOKIE['user_id'])) {
                setcookie('user_id', "", time() - 7 * 6000, '/');
            }
            if (isset($_COOKIE['PHPSESPASS'])) {
                setcookie('PHPSESPASS', "", time() - 7 * 6000, '/');
            }
            setcookie('user_type', 1, time() + 7 * 6000, '/');
            setcookie('user_id', $row_uv['user_id'], time() + 7 * 6000, '/');
            setcookie('PHPSESPASS', $email_md5, time() + 7 * 6000, '/');
        } else {
            if (($page_login == 4 || $page_login == 1 || $page_login == 3 || $page_login == 6) && $check_ntd == 2) {
                if ($avatar != '') {
//        ------luu anh--------
                    $avt = explode('/', $avatar);
                    $logo = end($avt);
                    $path_file = "../img/avatar/";

                    $temp = explode(".", $logo);
                    $newfile = time() . md5($email) . '.' . end($temp);

                    $target = $path_file . $newfile;
                    file_put_contents($target, file_get_contents($avatar));
//----------
                } else {
                    $newfile = '';
                }
                $qr_insert_uv = new db_query("
                INSERT INTO users(user_mail,user_pass,user_phone,user_name,cit_id,district_id,user_address,created_at,updated_at,user_avatar,user_active,user_type,site_from)
                VALUES ('$email','$passw','$phone','$name','$cit_id','$district_id','$address','$time','$time','$newfile','$active','1','$site')");
                $id_use = mysql_insert_id();
                $token = md5($email . $time);
                $date = date('Y-m-d H:s:i');
                $qr_insert_token = new db_query("
                        INSERT INTO tokens(user_id,token,created_at) 
                        VALUES ('$id_use','$token','$date')");
                if (isset($_COOKIE['user_type'])) {
                    setcookie('user_type', '', time() - 7 * 6000, '/');
                }
                if (isset($_COOKIE['user_id'])) {
                    setcookie('user_id', "", time() - 7 * 6000, '/');
                }
                if (isset($_COOKIE['PHPSESPASS'])) {
                    setcookie('PHPSESPASS', "", time() - 7 * 6000, '/');
                }
                setcookie('user_type', 1, time() + 7 * 6000, '/');
                setcookie('user_id', $id_use, time() + 7 * 6000, '/');
                setcookie('PHPSESPASS', $email_md5, time() + 7 * 6000, '/');
            }
        }

        if (isset($_COOKIE['general_login']) && (!isset($_COOKIE['user_type']) || !isset($_COOKIE['user_id']))) {
            header('Refresh: 0');
        }

    }

} else {
    setcookie('user_type', '', time() - 7 * 6000, '/');
    setcookie('user_id', '', time() - 7 * 6000, '/');
    setcookie('PHPSESPASS', '', time() - 7 * 6000, '/');
}

//----------------------------------