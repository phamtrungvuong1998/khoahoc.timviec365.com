<?
include '../config/config.php';

$value = getValue('value','str','POST','','');
$id = getValue('id','int','POST','','');
$today = strtotime(date("d-m-Y"));
// print_r($_POST);
// die();
if($value != '' && $id != '' ){
    $id = [
        'order_id' => $id,
    ];
    $data = [
        'order_status' => $value,
        'day_buy' => $today,
    ];
    update('orders', $data , $id);
    $result = [
        'result' => true,
    ];
}
echo json_encode($result);
?>