<?php
require_once '../config/config.php';
$usermail = getValue('usermail','str','POST','');
$userpass = getValue('userpass','str','POST','');
$type = getValue('type','int','POST','');
$md5_user_pass = md5($userpass);

if($usermail != '' && $userpass != '' && $type != ''){
    if($type == 1){
        $db_qr = new db_query("SELECT user_id,user_mail,user_pass,user_active,user_name,user_phone,cit_id,district_id,user_address,user_avatar FROM users WHERE user_type = 1 AND  user_mail = '$usermail' AND user_pass = '$md5_user_pass'");
        if(mysql_num_rows($db_qr->result) > 0){
            $row = mysql_fetch_assoc($db_qr->result);
            if ($row['user_active'] == 0) {
                $db_token = new db_query("SELECT token FROM tokens WHERE user_id = " . $row['user_id']);
                $token = mysql_fetch_array($db_token->result);
                $title = 'Xác thực tài khoản học viên';
                $user_type = "học viên";
                $user_search = "tìm kiếm trung tâm";
                $link = $domain.'/xac-thuc-thanh-cong/id' . $row['user_id'] . '-' . time() . '-' . $token['token'] . '.html';
                $body = file_get_contents('../EmailTemplate/01_EmailXacThucTaiKhoanTrungTam.htm');
                $body = str_replace('<%name_company%>', $row['user_name'], $body);
                $body = str_replace('<%user_type%>', $user_type, $body);
                $body = str_replace('<%user_search%>', $user_search, $body);
                $body = str_replace('<%link%>', $link, $body);
                $email = $row['user_mail'];
                SendMailAmazon($title, $row['user_name'], $email, $body);
                setcookie('user_id', $row['user_id'], time() + 3600 * 6, '/');
                setcookie('user_type', $row['user_type'], time() + 3600 * 6, '/');
                $data = [
                    'result'=>0
                ];
            }else{
                setcookie('user_id', $row['user_id'], time() + 3600 * 6, '/');
                setcookie('user_type', $type, time() + 3600 * 6, '/');
                $data = [
                    'result' => 1,
                ];
            }
            //     --------set cookie UV chung---------
            if($row['user_avatar'] != '' && $row['user_avatar'] != 0){
                $avt = "https://khoahoc.timviec365.com/img/avatar/".$row['user_avatar'];
            }else{
                $avt = '';
            }
            $arr_cookie['page_login'] = 5;
            $arr_cookie['check_ntd'] = 2;
            $arr_cookie['from'] = 'khoahoc.timviec365.com';
            $arr_cookie['email'] = $row['user_mail'];
            $arr_cookie['phone'] = $row['user_phone'];
            $arr_cookie['name'] = $row['user_name'];
            $arr_cookie['cit_id'] = $row['cit_id'];
            $arr_cookie['district_id'] = $row['district_id'];
            $arr_cookie['address'] = $row['user_address'];
            $arr_cookie['pw'] = $row['user_pass'];
            $arr_cookie['avatar'] = $avt;
            $arr_cookie['active'] = $row['user_active'];
            $token_cookie = json_encode($arr_cookie);
            setcookie('general_login', $token_cookie, time() + 7*6000,'/','.timviec365.com');
//     --------------------
        }else{
            $data = [
                'result' => 2,
                'msg' => 'Tài khoản hoặc Mật khẩu không chính xác !!!'
            ];
        }
    }elseif($type == 2 || $type == 3){
        $db_qr = new db_query("SELECT user_id,user_mail,user_pass,user_active,user_type,user_name,user_phone,cit_id,district_id,user_address,user_avatar FROM users WHERE user_type = $type AND  user_mail = '$usermail' AND user_pass = '$md5_user_pass'");
        if(mysql_num_rows($db_qr->result) > 0){
            $row = mysql_fetch_assoc($db_qr->result);
            if ($row['user_active'] == 0) {
                $db_token = new db_query("SELECT token FROM tokens WHERE user_id = " . $row['user_id']);
                $token = mysql_fetch_array($db_token->result);
                if ($row['user_type'] == 2) {
                    $title = 'Xác thực tài khoản giảng viên';
                    $user_type = "giảng viên";
                    $user_search = "tìm kiếm học viên";
                }else if($row['user_type'] == 3){
                    $title = 'Xác thực tài khoản trung tâm';
                    $user_type = "trung tâm";
                    $user_search = "đăng tin miễn phí và tìm hồ sơ ứng viên";
                }
                $link = $domain.'/xac-thuc-thanh-cong/id' . $row['user_id'] . '-' . time() . '-' . $token['token'] . '.html';
                $body = file_get_contents('../EmailTemplate/01_EmailXacThucTaiKhoanTrungTam.htm');
                $body = str_replace('<%name_company%>', $row['user_name'], $body);
                $body = str_replace('<%user_type%>', $user_type, $body);
                $body = str_replace('<%user_search%>', $user_search, $body);
                $body = str_replace('<%link%>', $link, $body);
                $email = $row['user_mail'];
                SendMailAmazon($title, $row['user_name'], $email, $body);
                setcookie('user_id', $row['user_id'], time() + 3600 * 6, '/');
                setcookie('user_type', $row['user_type'], time() + 3600 * 6, '/');
                $data = [
                    'result'=>0
                ];
            }else{
                $today = strtotime(date("d-m-Y"));
                $id = $row['user_id'];
                $db_point = new db_query("SELECT * FROM points Where user_id = '$id'");
                $point = mysql_fetch_assoc($db_point->result);
                $reset = $point['reset_day'];
                if ($point > 0) {
                    if ($reset < $today) {
                        $cook_id = [
                            'user_id' => $row['user_id']
                        ];
                        $point = [
                            'point' => 10,
                            'reset_day' => $today
                        ];
                        update('points', $point, $cook_id);

                        $course24 = [
                            '24_course'=>0
                        ];
                        update('users', $course24, $cook_id);
                    }
                } else {
                    $point2 = [
                        'user_id'=> $id,
                        'point'=> 10,
                        'reset_day' => $today
                    ];
                    add('points',$point2);
                }
                setcookie('user_id', $row['user_id'], time() + 3600 * 6, '/');
                setcookie('user_type', $row['user_type'], time() + 3600 * 6, '/');
                $data = [
                    'result' => 1,
                ];
            }
            //     --------set cookie UV chung---------
            if($row['user_avatar'] != ''){
                $avt = "https://khoahoc.timviec365.com/img/avatar/".$row['user_avatar'];
            }else{
                $avt = '';
            }
            if($type == 3){
                $check_ntd = 1;
            }elseif($type == 2){
                $check_ntd = 3;
            }
            $arr_cookie['page_login'] = 5;
            $arr_cookie['check_ntd'] = $check_ntd;
            $arr_cookie['from'] = 'khoahoc.timviec365.com';
            $arr_cookie['email'] = $row['user_mail'];
            $arr_cookie['phone'] = $row['user_phone'];
            $arr_cookie['name'] = $row['user_name'];
            $arr_cookie['cit_id'] = $row['cit_id'];
            $arr_cookie['district_id'] = $row['district_id'];
            $arr_cookie['address'] = $row['user_address'];
            $arr_cookie['pw'] = $row['user_pass'];
            $arr_cookie['avatar'] = $avt;
            $arr_cookie['active'] = $row['user_active'];
            $token_cookie = json_encode($arr_cookie);
            setcookie('general_login', $token_cookie, time() + 7*6000,'/','.timviec365.com');
//     --------------------
        }else{
            $data = [
                'result' => 2,
                'msg' => 'Tài khoản hoặc Mật khẩu không chính xác !!!'
            ];
        }
    }

    echo json_encode($data);
}
?>