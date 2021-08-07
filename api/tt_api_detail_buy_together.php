<?
include_once 'api_info.php';
if ($user_type != 2 || $user_type != 3) {
    set_error('404','Bạn phải đăng nhập tài khoản trung tâm hoặc giảng viên');
    die();
}
$course_id = getValue('common_id', 'str', 'POST', '', '');
if ($common_id != 0) {
    $db_common = new db_query("SELECT common_id,course_name,teacher_name,price_listed,price_promotional,quantity_std,numbers FROM order_common INNER JOIN courses ON courses.course_id = order_common.course_id INNER JOIN user_center_teacher ON user_center_teacher.center_teacher_id = courses.center_teacher_id WHERE common_id = '$common_id' ORDER BY common_id DESC");
    $list = [];
    while ($row = mysql_fetch_assoc($db_common->result)) {
        $list[$row['common_id']] = $row;
        $price = $row['price_listed'] - $row['price_promotional'];
        $num = $row['quantity_std'];
        $number = $row['numbers'];
        $a = 0;
        if ($num == 0) {
            $a = round($price, 0);
            echo format_number($a) . ' đ';
        } else {
            $a = round($price / $num, 0);
            echo format_number($a) . ' đ';
        };
        $list[$row['common_id']]['total_price'] = $price;
        // $price_total = $row['price_listed'] - $row['price_promotional'];
    }
    success('', $list);
} else {
    set_error('404', 'Không có thông tin khóa học mua chung');
}
