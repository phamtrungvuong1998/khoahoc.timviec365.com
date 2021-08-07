<?
include_once '../config/config.php';
include_once 'functions.php';
use Firebase\JWT\JWT;

$today = strtotime(date("d-m-Y"));
$l_sotien = getValue('l_sotien', 'int', 'POST', '', '');
$l_ten = getValue('l_ten', 'str', 'POST', '', '');
$l_stk = getValue('l_stk', 'int', 'POST', '', '');
$l_bank = getValue('l_bank', 'int', 'POST', '', '');
$l_chinhanh = getValue('l_chinhanh', 'str', 'POST', '', '');
$l_noidung = getValue('l_noidung', 'str', 'POST', '', '');

$token = getValue('token', 'str', 'POST', '', '');
if ($token != '') {
    $token = JWT::decode($token, $key, ['HS256']);
    $user_id = $token->user_id;
    // echo $user_id;
    $id = [
        'user_id' => $user_id,
    ];
    if ($l_sotien != 0 && $l_ten != '' && $l_stk != 0 && $l_bank != 0 && $l_chinhanh != '' && $l_noidung != '') {
        $db_user = new db_query("SELECT user_money FROM users WHERE user_id = '$user_id'");
        $row_user = mysql_fetch_assoc($db_user->result);
        if ($l_sotien < $row_user['user_money']) {
            $total = $row_user['user_money'] - $l_sotien;
            $pm = 0;
            $a = date_create();
            $b = date_timestamp_get($a);
            $ma = rand(10000, 99999);
            $data = [
                'user_id' => $user_id,
                'transaction_code' => $ma,
                'bank_id' => $l_bank,
                'bank_branch' => $l_chinhanh,
                'acc_number' => $l_stk,
                'transaction_name' => $l_ten,
                'withdrawal_amount' => $l_sotien,
                'transaction_content' => $l_noidung,
                'total_money' => $total,
                'transaction_date' => $b,
                'plus_minus' => $pm,
                'created_at' => $today,
                'updated_at' => $today,
            ];
            add('user_transaction', $data);
            $data2 = [
                'user_money' => $total,
            ];
            update('users', $data2, $id);
            $arr = [
                'result'=>true,
            ];
            success('Thực hiện lệnh rút tiền thành công',$arr);
        } else {
            set_error('404','Số tiền rút không được lớn hơn số dư trong tài khoản');
        }
    } else {
        set_error('404','Bạn phải điền đầy đủ thông tin');
    }
}else {
    set_error('404','Bạn phải đăng nhập trước');
}
