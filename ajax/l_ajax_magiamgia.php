<?
include '../config/config.php';
$today = strtotime(date("d-m-Y"));
$l_code_name = getValue('l_code_name', 'str', 'POST', '', '');
$l_date_start = getValue('l_date_start', 'str', 'POST', '', '');
$l_date_end = getValue('l_date_end', 'str', 'POST', '', '');
$l_discount_money = getValue('l_discount_money', 'str', 'POST', '', '');
$l_course = getValue('l_course', 'str', 'POST', '', '');
$l_quantity = getValue('l_quantity', 'str', 'POST', '', '');
$l_show = getValue('l_show', 'str', 'POST', '', '');
$id = $_COOKIE['user_id'];
if ($l_code_name != '' && $l_date_start != '' && $l_date_end != '' && $l_discount_money != '' && $l_course != '' && $l_quantity != '' && $l_show != '') {
    $db_discode = new db_query("SELECT code_name FROM discount_code WHERE code_name = '$l_code_name' AND user_id='$id'");
    $row = mysql_fetch_assoc($db_discode->result);
    if ($row > 0) {
        $result = [
            'result' => 1,
            'message' => 'Mã đã tồn tại',
        ];
    } else {
        $data = [
            'user_id' => $id,
            'code_name' => $l_code_name,
            'date_start' => $l_date_start,
            'date_end' => $l_date_end,
            'discount_money' => $l_discount_money,
            'course_value' => $l_course,
            'quantity' => $l_quantity,
            'show_code' => $l_show,
            'created_at' => $today,
            'updated_at' => $today
        ];
        add('discount_code', $data);
        $result = [
            'result' => 2,
            'message' => 'Tạo mã giảm giá thành công',
        ];
    }
}else{
    $result = [
        'result' => 3,
        'message' => 'Không được để trống',
    ];
}

echo json_encode($result);
