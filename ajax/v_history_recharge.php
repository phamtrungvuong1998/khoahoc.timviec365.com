<?php
require '../config/config.php';

$number = getValue('number','int','GET','');

$start = ($number - 1) * 10;

$user_id = $_COOKIE['user_id'];

$qr = new db_query("SELECT * FROM rechange_notice INNER JOIN form_recharge ON rechange_notice.recharge_form_id = form_recharge.form_recharge_id INNER JOIN bank ON bank.bank_id = rechange_notice.bank_id WHERE user_id = '$user_id' ORDER BY recharge_id DESC LIMIT 0,10");

$start = $start + 1;
$html = '';
while ($row = mysql_fetch_array($qr->result)) {
    if ($row['status_recharge'] == 0) {
        $status = "Đang chờ";
    }else if ($row['status_recharge'] == 1) {
        $status = "Thất bại";
    }else{
        $status = "Thành công";
    }
	$html = $html . '<div class="v_noidungkh">
    <div class="v_table-cell v_stt">'.$start.'</div>
    <div class="v_table-cell v_content-list v_monhoc">'.date("d-m-Y",$row['time_recharge']).'</div>
    <div class="v_table-cell v_content-list">'.$row['form_recharge_name'].'</div>
    <div class="v_table-cell v_content-list">'.number_format($row['amount']) . " đ".'</div>
    <div class="v_table-cell v_content-list">'.$status.'</div>
    <div class="v_table-cell v_content-list v_bacham">
    <button class="v_btn-bacham" onclick="v_bacham('.$row['recharge_id'].')"><img
    src="../img/More.svg" alt="Ảnh lỗi"></button>
    <div class="v_popup" id="v_popup-'.$row['recharge_id'].'">
    </div>
    </div>
    </div>
    <div class="v_content-mb">
    <div class="flex v_content-mb-div">
    <p class="v_content-mb-stt">'.$start.'</p>
    </div>

    <p class="v_tengiangvien">'.date("d-m-Y h-i-s",$row['time_recharge']).'</p>

    <div class="flex v_info-all v_content-mb-div">
    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Loại giao dịch : </span>'.$row['form_recharge_name'].'</div>
    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số tiền : </span>'.number_format($row['amount']) . " đ".'
    </div>
    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Trạng thái : </span> '.$status.'</div>
    </div>

    <div class="flex v_mb-ghichu-all v_content-mb-div">
    <div class="flex v_ghichu-mb">
    <p class="v_ghichu-mb-p"><img src="../img/V_ghi-chu.svg" alt="Ảnh lỗi"></p>
    </div>
    </div>
    </div>';
    $start++;
}

$data = [
    'html'=>$html
];

echo json_encode($data);
?>