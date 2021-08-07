<?
include_once '../config/config.php';
include_once 'functions.php';
use Firebase\JWT\JWT;
$uplaoad = '../img/avatar/';
$today = strtotime(date("d-m-Y"));
$user_name = getValue('name', 'str', 'POST', '', '');
$user_mail = getValue('email', 'str', 'POST', '', '');
$cate_id = getValue('cate_id', 'str', 'POST', '', '');
$user_pass = getValue('pass', 'str', 'POST', '', '');
$user_city = getValue('city', 'str', 'POST', '', '');
$user_dis = getValue('district', 'str', 'POST', '', '');
$user_address = getValue('address', 'str', 'POST', '', '');
$user_avatar = getValue('avatar', 'str', 'POST', '', '');

if ($user_name != '' && $user_mail != '' && $cate_id != '' && $user_pass != '' && $user_city != '' && $user_dis != '' && $user_address != '') {
    $user_slug = ChangeToSlug($user_name);
    $token = md5(time() . $user_mail);
    $db_slug = new db_query("SELECT user_slug FROM users WHERE user_slug = '$user_slug' AND user_type = 3");
    $db_mail = new db_query("SELECT user_mail FROM users WHERE user_mail = '$user_mail' AND user_type = 3");
    // echo mysql_num_rows($db_slug->result);
    // die();
    if (mysql_num_rows($db_slug->result) > 0) {
        // die();
        set_error('404', 'Tên trung tâm đã tồn tại');
    } else if (mysql_num_rows($db_mail->result) > 0) {
        set_error('404', 'Email tồn tại');
    } else {
        if (isset($_FILES['file'])) {
            $avatar = $_FILES['file']['name'];
            $ext_img = strtolower(pathinfo($avatar, PATHINFO_EXTENSION));
            $_FILES['file']['name'] = md5(rand()) . '.' . $ext_img;
            $file_avatar = $_FILES['file']['name'];
            $path_avatar = $upload_avatar . $file_avatar;
            if (in_array($ext_img, $allowed_image_extension)) {
                move_uploaded_file($_FILES['file']['tmp_name'], $path_avatar);
                $data1 = [
                    'user_name' => $user_name,
                    'user_mail' => $user_mail,
                    'cate_id' => $cate_id,
                    'user_pass' => md5($user_pass),
                    'user_slug' => ChangeToSlug($user_name),
                    'user_avatar' => $file_avatar,
                    'user_type' => 3,
                    'created_at' => $today,
                    'updated_at' => $today
                ];
                add('users', $data1);
            }
        } else {
            $data1 = [
                'user_name' => $user_name,
                'user_mail' => $user_mail,
                'cate_id' => $cate_id,
                'user_pass' => md5($user_pass),
                'user_slug' => ChangeToSlug($user_name),
                'user_type' => 3,
                'created_at' => $today,
                'updated_at' => $today
            ];
            add('users', $data1);
        }
        $id = mysql_insert_id();
        $city = [
            'user_id' => $id,
            'cit_id' => $user_city,
            'district_id' => $user_dis,
            'center_basis_address' => $user_address,
        ];
        add('user_center_basis', $city);

        $data2 = [
            'user_id' => $id,
            'token' => $token
        ];
        add('tokens', $data2);

        $user_center = [
            'user_id' => $id
        ];
        add('user_center', $user_center);

        $otp = rand(100000, 999999);
        $data_otp = [
            'otp' => $otp,
            'user_id' => $id,
            'time' =>time(),
         ];
        $token = JWT::encode($data_otp,$key);
        success('Đăng Ký thành công', $token);
    }
} else {
    set_error('404', 'Bạn phải điền đầy đủ thông tin!');
}
