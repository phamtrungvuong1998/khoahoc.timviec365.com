<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$order_id = getValue('order_id','int','POST','');
$code = getValue('code','str','POST','');
$data['detail_order'] = [];
$qr = new db_query("SELECT * FROM carts INNER JOIN courses ON carts.course_id = courses.course_id WHERE order_id = $order_id");

$row = mysql_fetch_array($qr->result);

$data['detail_order']['course_avatar'] = $row['course_avatar'];
$data['detail_order']['course_name'] = $row['course_name'];
$data['detail_order']['price_promotional'] = $row['price_promotional'];
if ($code == "") {
    $data['detail_order']['discount'] = 0;
}else{
    $qrCode = new db_query("SELECT * FROM discount_code WHERE center_id = " . $row['user_id'] . " AND code_name = '$code'");
    if (mysql_num_rows($qrCode->result) == 0) {
        $data['detail_order']['discount'] = 0;
    }else if (mysql_num_rows($qrCode->result) > 0){
        $rowCode = mysql_fetch_array($qrCode->result);
        if (date("Y-m-d") < $rowCode['date_start'] || date("Y-m-d") > $rowCode['date_end']) {
            $data['detail_order']['discount'] = 0;
        }else if($rowCode['course_value'] > $row['price_promotional']){
            $data['detail_order']['discount'] = 0;
        }else{
            $data['detail_order']['discount'] = $rowCode['discount_money'];
        }
    }
}
$data['detail_order']['total_prices'] = $row['price_promotional'] - $data['detail_order']['discount'] ;

$data['detail_order']['payment_methods'] = "Ví khóa học 365";

success('',$data);
?>