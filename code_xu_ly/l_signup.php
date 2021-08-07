<?php
require_once '../config/config.php';
if (isset($_POST['btn'])) {
    $today = strtotime(date("d-m-Y"));
    $user_name = getValue('l_user', 'str', 'POST', '');
    $user_mail = getValue('l_email', 'str', 'POST', '');
    $user_phone = getValue('l_phone', 'str', 'POST', '');
    $user_pass = getValue('l_pass', 'str', 'POST', '');
    $user_city = getValue('l_city', 'str', 'POST', '');
    $user_dis = getValue('l_district', 'str', 'POST', '');
    $user_address = getValue('l_address', 'str', 'POST', '');
    $token = md5(time() . $user_mail);
    $title = "Email xác thực tài khoản";
    //Kiểm tra Email
    $queryMail = new db_query("SELECT `user_mail` FROM `users` WHERE `user_mail` = '$user_mail'");
    $rowEmail = mysql_fetch_array($queryMail->result);
    if ($rowEmail > 0) {
        $error = "<p class='l_text_color'>Email đã được sử dụng</p>";
    } else {
        $data = [
            'cit_id' => $user_city,
            'district_id' => $user_dis,
            'user_name' => $user_name,
            'user_mail' => $user_mail,
            'user_phone' => $user_phone,
            'user_pass' => md5($user_pass),
            'user_address' => $user_address,
            'user_slug' => ChangeToSlug($user_name),
            'user_type' => 3,
            'created_at' => $today,
            'updated_at' => $today
        ];
        add('users', $data);
        $id = mysql_insert_id();
        $body = '<a href="/xac-thuc-thanh-cong/id' . $id . '-' . $token . '.html">Nhấn vào đây để xác thực</a>';
        $data2 = [
            'user_id' => $id,
            'token' => $token
        ];
        add('tokens', $data2);
        SendMailAmazon($title, $user_name, $user_mail, $body);
        header("Location:/xac-thuc-tai-khoan/id$id-$token.html");
        $user_center = [
            'user_id' => $id
        ];
        add('user_center', $user_center);
    }
}