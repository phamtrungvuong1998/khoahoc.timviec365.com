<meta charset="UTF-8">
<?php
require_once '../config/config.php';
$user_id = getValue('user_id','int','GET','');
$bank = getValue('bank','int','GET','');
$form_recharge = getValue('form_recharge','int','GET','');
$status = getValue('status','int','GET','');
if ($user_id != 0) {
	$qr_id = " AND rechange_notice.user_id = '$user_id' ";
}else{
	$qr_id = '';
}

if ($bank != 0) {
	$qrbank = " AND rechange_notice.bank_id = '$bank' ";
}else{
	$qrbank = '';
}

if ($form_recharge != 0) {
	$qrform_recharge = " AND rechange_notice.recharge_form_id = '$form_recharge' ";
}else{
	$qrform_recharge = '';
}

if ($status != 3) {
	$qrstatus = " AND rechange_notice.status_recharge = '$status' ";
}else{
	$qrstatus = '';
}

$query = "SELECT * FROM rechange_notice INNER JOIN users ON rechange_notice.user_id = users.user_id INNER JOIN bank ON rechange_notice.bank_id = bank.bank_id INNER JOIN form_recharge ON form_recharge.form_recharge_id = rechange_notice.recharge_form_id WHERE users.user_type = 1 " .$qr_id.$qrbank.$qrform_recharge.$qrstatus. "ORDER BY rechange_notice.recharge_id ASC";
$qr = new db_query($query);
$html = '';
$html .= '<table border="1" cellspacing="1">
<tr>
<th>STT</th>
<th>ID HỌC VIÊN</th>
<th>TÊN HỌC VIÊN</th>
<th>SỐ TIỀN NẠP</th>
<th>NGÂN HÀNG</th>
<th>HÌNH THỨC CHUYỂN TIỀN</th>
<th>NGÂN HÀNG CHUYỂN TIỀN</th>
<th>TÊN NGƯỜI CHUYỂN TIỀN</th>
<th>SÔ TÀI KHOẢN CHUYỂN TIỀN</th>
<th>THỜI GIAN CHUYỂN TIỀN</th>
<th>NỘI DUNG CHUYỂN TIỀN</th>
<th>TRẠNG THÁI</th>
</tr>';

$i = 1;
while($row = mysql_fetch_array($qr->result)){
	if ($row['status_recharge'] == 0) {
		$status = "Đang chờ";
	}else if ($row['status_recharge'] == 1){
		$status = "Thất bại";
	}else{
		$status = "Thành công";
	}
	$qr_bank = new db_query("SELECT bank_name FROM bank WHERE bank_id = " . $row['bank_recharge']);
	$row_bank = mysql_fetch_array($qr_bank->result);
	$html .= '
	<tr>
	<td><center>' . $i . '</center></td>
	<td><center>' . $row['user_id'] . '</center></td>
	<td><center>' . $row['user_name'] . '</center></td>
	<td><center>' . $row['amount'] . '</center></td>
	<td><center>' . $row['bank_name'] . '</center></td>
	<td><center>' . $row['form_recharge_name'] . '</center></td>
	<td><center>' . $row_bank['bank_name'] . '</center></td>
	<td><center>' . $row['recharge_name'] . '</center></td>
	<td><center>' . $row['bank_account'] . '</center></td>
	<td><center>' . date("d-m-Y",$row['time_recharge']) . '</center></td>
	<td><center>' . $row['content_recharge'] . '</center></td>
	<td><center>' . $status . '</center></td>
	</tr>
	';
     $i++;
}

echo $html;
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Danh-sach-nap-tien-hoc-vien.xls");
?>