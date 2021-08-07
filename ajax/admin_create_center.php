<?

require_once('../config/config.php');
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
if ($user_name != '' && $user_mail != '' && $user_phone != '' && $user_pass != '' && $user_city != '' && $user_dis != '' && $user_address != '') {
    $db_slug = new db_query("SELECT user_slug FROM users WHERE user_slug = '$user_slug'");
    $arr_slug = [];
    while ($row = mysql_fetch_assoc($db_slug->result)) {
        $arr_slug[] = $row['user_slug'];
    }
    if (count($arr_slug) > 0) {
        $data = [
            'result' => 1,
            'message' => 'Tên trung tâm đã được sử dụng',
        ];
    } else {
            $data1 = [
                'user_name' => $user_name,
                'user_mail' => $user_mail,
                'user_phone' => $user_phone,
                'user_pass' => md5($user_pass),
                'user_slug' => ChangeToSlug($user_name),
                'user_active' => 1,
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
            $data2 = [
                'user_id' => $id,
                'token' => $token
            ];
            add('tokens', $data2);
            $user_center = [
                'user_id' => $id
            ];
            add('user_center', $user_center);
            $data = [
                'result' => 2,
                'id' => $id,
                'token' => $token,
                'message' => 'Hoàn tất đăng ký',
            ];
    }
} else {
    $data = [
        'result' => 3,
        'message' => 'Tạo trung tâm thất bại',
    ];
}
echo json_encode($data);
