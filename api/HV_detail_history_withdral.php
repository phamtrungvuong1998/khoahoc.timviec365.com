<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$recharge_id = getValue('recharge_id','int','POST','');
$qr = new db_query("SELECT time_recharge,form_recharge_name,amount,status_recharge FROM rechange_notice INNER JOIN form_recharge ON form_recharge.form_recharge_id = rechange_notice.recharge_form_id WHERE recharge_id = $recharge_id");
$data['detail_history_withdral'] = [];
while($row = mysql_fetch_array($qr->result)){
    $data['detail_history_withdral']['time_recharge'] = date("d-m-Y",$row['time_recharge']);
    $data['detail_history_withdral']['form_recharge_name'] = $row['form_recharge_name'];
    $data['detail_history_withdral']['amount'] = $row['amount'];
    if ($row['status_recharge'] == 0) {
        $status_recharge = 'Đang chờ';
    }else if ($row['status_recharge'] == 1) {
        $status_recharge = 'Thất bại';
    }else if ($row['status_recharge'] == 2) {
        $status_recharge = 'Thành công';
    }
    $data['detail_history_withdral']['status_recharge'] = $status_recharge;
}
success('',$data);
?>