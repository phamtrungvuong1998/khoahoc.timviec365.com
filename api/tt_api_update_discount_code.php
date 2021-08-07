<?
require_once '../config/config.php';
include 'functions.php';
$today = strtotime(date("d-m-Y"));
$l_code_id = getValue('l_code_id', 'int', 'POST', '', '');
$l_code_name = getValue('l_code_name', 'str', 'POST', '', '');
$l_date_start = getValue('l_date_start', 'str', 'POST', '', '');
$l_date_end = getValue('l_date_end', 'str', 'POST', '', '');
$l_discount_money = getValue('l_discount_money', 'str', 'POST', '', '');
$l_course = getValue('l_course', 'str', 'POST', '', '');
$l_quantity = getValue('l_quantity', 'str', 'POST', '', '');
$l_show = getValue('l_show', 'str', 'POST', '', '');
// $cook_id = $_COOKIE['user_id'];
if ($l_code_id != '' && $l_code_name != '' && $l_date_start != '' && $l_date_end != '' && $l_discount_money != '' && $l_course != '' && $l_quantity != '' && $l_show != '') {
    $id = [
        'code_id' => $l_code_id
    ];
    $data = [
        'date_start' => $l_date_start,
        'date_end' => $l_date_end,
        'discount_money' => $l_discount_money,
        'course_value' => $l_course,
        'quantity' => $l_quantity,
        'show_code' => $l_show,
        'updated_at' => $today
    ];
    update('discount_code', $data, $id);
    $data_json = [
        'result' => true,
    ];
    success('Cập nhật mã giảm giá thành công',$data_json);
} else {
    set_error('404','Cập nhật mã giảm giá thất bại');
}
// echo json_encode($data_json);
