<?
include_once 'api_info.php';
$db_discount = new db_query("SELECT code_id,code_name,date_start,date_end FROM discount_code WHERE user_id = '$user_id' ORDER BY code_id DESC");
$list_discount = [];
while ($row = mysql_fetch_assoc($db_discount->result)) {
    $list_discount[$row['code_id']] = $row;
    $date = date('Y-m-d');
    if ($row['date_start'] > $date) {
        $arr = 'Chưa sử dụng';
    }else if ($row['date_end'] >= $date && $date >= $row['date_start']) {
        $arr = 'Đang sử dụng';
    } else {
       $arr= 'Hết hạn';
    }
    $list_discount[$row['code_id']]['status'] = $arr;
}

success('',$list_discount);
?>