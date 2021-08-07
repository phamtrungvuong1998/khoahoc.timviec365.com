<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$qr = new db_query("SELECT * FROM rechange_notice WHERE user_id = $user_id");
$data['history_withdral'] = [];
while($row = mysql_fetch_array($qr->result)){
    $data['history_withdral'][$row['recharge_id']]['time_recharge'] = date("d-m-Y",$row['time_recharge']);
    $data['history_withdral'][$row['recharge_id']]['amount'] = $row['amount'];
}
success('',$data);
?>