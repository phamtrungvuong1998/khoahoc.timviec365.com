<?php
include "../config/config.php";
$today = strtotime(date("d-m-Y"));
$l_sotien = getValue('l_sotien', 'int', 'POST', '', '');
$l_ten = getValue('l_ten', 'str', 'POST', '', '');
$l_stk = getValue('l_stk', 'int', 'POST', '', '');
$l_select = getValue('l_select', 'int', 'POST', '', '');
$l_chinhanh = getValue('l_chinhanh', 'str', 'POST', '', '');
$l_noidung = getValue('l_noidung', 'str', 'POST', '', '');

$user_id = $_COOKIE['user_id'];
$id = [
    'user_id'=> $user_id,
];
if ($l_sotien != 0 && $l_ten != '' && $l_stk != 0 && $l_select != 0 && $l_chinhanh != '' && $l_noidung != '') {
    $db_user = new db_query("SELECT user_money FROM users WHERE user_id = '$user_id'");
    $row_user = mysql_fetch_assoc($db_user->result);
    if ($l_sotien < $row_user['user_money']) {
        $total = $row_user['user_money'] - $l_sotien;
        $pm = 0;
        //$a = date_create();
        // $b = time();
        $ma = rand(10000, 99999);
        $data = [
            'user_id' => $user_id,
            'transaction_code' => $ma,
            'bank_id' => $l_select,
            'bank_branch' => $l_chinhanh,
            'acc_number' => $l_stk,
            'transaction_name' => $l_ten,
            'withdrawal_amount' => $l_sotien,
            'transaction_content' => $l_noidung,
            'total_money' => $total,
            'plus_minus' => $pm,
            'created_at' => $today,
            'updated_at' => $today,
        ];
        add('user_transaction', $data);
        $thongbao = [
            'result' => 0,
            'message' => 'Thông báo rút tiền đã được gửi. Vui lòng chờ phản hồi',
            'total'=>$total
        ];
    } else {
        $thongbao = [
            'result' => 1,
            'message' => 'số tiền rút không được lớn hơn số tiền trong tài khoản',
        ];
    }
} else {
    $thongbao = [
        'result' => false,
        'message' => 'Không nhận được tham số',
    ];
}

echo json_encode($thongbao);
