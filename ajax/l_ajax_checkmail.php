<?
include '../config/config.php';
$today = strtotime(date("d-m-Y"));
$user_name = getValue('user', 'str', 'POST', '', '');
$user_mail = getValue('email', 'str', 'POST', '', '');
$user_phone = getValue('phone', 'str', 'POST', '', '');
$user_pass = getValue('pass', 'str', 'POST', '', '');
$user_city = getValue('city', 'str', 'POST', '', '');
$user_dis = getValue('district', 'str', 'POST', '', '');
$user_address = getValue('address', 'str', 'POST', '', '');
$user_slug = ChangeToSlug($user_name);
$token = md5(time() . $user_mail);
// setcookie('time_success', $token, time() + 900, '/');
// $title = "Email xác thực tài khoản";
// $mail = getValue('mail', 'str', 'POST', '', '');
// echo $user_slug;
if ($user_name != '' && $user_mail != '' && $user_phone != '' && $user_pass != '' && $user_city != '' && $user_dis != '' && $user_address != '') {
    $db_slug = new db_query("SELECT user_slug FROM users WHERE user_slug = '$user_slug' AND user_type = 3");
    $arr_slug = [];
    $arr_mail = [];
    while ($row = mysql_fetch_assoc($db_slug->result)) {
        $arr_slug[] = $row['user_slug'];
    }
    // var_dump($arr_slug);
    if (count($arr_slug) > 0) {
        $data = [
            'result' => 1,
            'message' => 'Tên trung tâm đã được sử dụng',
        ];
    } else {
        $db_mail = new db_query("SELECT user_mail FROM users WHERE user_mail = '$user_mail' AND user_type = 3");
        while ($row = mysql_fetch_assoc($db_mail->result)) {
            $arr_mail[] = $row['user_mail'];
        }
        // var_dump($arr_mail);
        if (count($arr_mail) > 0) {
            $data = [
                'result' => 2,
                'message' => 'mail đã được sử dụng',
            ];
        } else {
            $data1 = [
                'user_name' => $user_name,
                'user_mail' => $user_mail,
                'user_phone' => $user_phone,
                'user_pass' => md5($user_pass),
                'user_money'=>0,
                'user_slug' => ChangeToSlug($user_name),
                'user_type' => 3,
                'created_at' => $today,
                'updated_at' => $today
            ];
            add('users', $data1);
            $id = mysql_insert_id();
            $city = [
                'user_id' => $id,
                'cit_id' => $user_city,
                'district_id' => $user_dis,
                'center_basis_address' => $user_address,
            ];
            add('user_center_basis', $city);

            $title = 'Xác thực tài khoản trung tâm';
            $user_type = "trung tâm";
            $user_search = "đăng tin miễn phí và tìm hồ sơ ứng viên";
            $link = $domain.'/xac-thuc-thanh-cong/id' . $id . '-' . time() . '-' . $token . '.html';
            $body = file_get_contents('../EmailTemplate/01_EmailXacThucTaiKhoanTrungTam.htm');
            $body = str_replace('<%name_company%>', $user_name, $body);
            $body = str_replace('<%user_type%>', $user_type, $body);
            $body = str_replace('<%user_search%>', $user_search, $body);
            $body = str_replace('<%link%>', $link, $body);
            SendMailAmazon($title, $user_name, $user_mail, $body);
            setcookie('user_id',$id,time() + 3600*6,'/');
            setcookie('user_type',3,time() + 3600*6,'/');
            setcookie('user_active',0,time() + 3600*6,'/');
            //     --------set cookie UV chung---------
            $arr_cookie['page_login'] = 5;
            $arr_cookie['check_ntd'] = 1;
            $arr_cookie['from'] = 'khoahoc.timviec365.com';
            $arr_cookie['email'] = $user_mail;
            $arr_cookie['phone'] = $user_phone;
            $arr_cookie['name'] = $user_name;
            $arr_cookie['cit_id'] = $user_city;
            $arr_cookie['district_id'] = $user_dis;
            $arr_cookie['address'] = $user_address;
            $arr_cookie['pw'] = md5($user_pass);
            $arr_cookie['avatar'] = '';
            $arr_cookie['active'] = 0;
            $token_cookie = json_encode($arr_cookie);
            setcookie('general_login', $token_cookie, time() + 7*6000,'/','.timviec365.com');
//     --------------------
            $data2 = [
                'user_id' => $id,
                'token' => $token
            ];
            add('tokens', $data2);
            //SendMailAmazon($title, $user_name, $user_mail, $body);
            $user_center = [
                'user_id' => $id
            ];
            add('user_center', $user_center);
            //header("Location:/xac-thuc-tai-khoan/id$id-$token.html");
            $data = [
                'result' => 3,
                'id' => $id,
                'time' => time(),
                'token' => $token,
                'message' => 'Hoàn tất đăng ký',
            ];
            // setcookie('user_id', $id, time() + 3600 * 6, '/');
            // setcookie('user_type', 3, time() + 3600 * 6, '/');
        }
    }
} else {
    $data = [
        'result' => 4,
        'message' => 'Tạo trung tâm thất bại',
    ];
}
echo json_encode($data);
