<meta charset="UTF-8">
<?php
require_once '../config/config.php';
$record_per_page = 20;
$user_id = getValue('user_id','str','GET','');
$wallet = getValue('wallet','str','GET','');
$page = '';
if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1)*$record_per_page;

if($wallet == 'trans' && $user_id != 1){
	$where = "users.user_id = $user_id";
}elseif($wallet == 'transtatus'){
	$where = "status = $user_id";
}elseif($wallet == 'transname'){
	$where = "users.user_id = $user_id";
}elseif($wallet == 'walletbuy'){
	$fromdate = strtotime(date($user_id));
	$todate = getValue('todate','str','GET','');
	if($todate != ""){
		$todates = $fromdate = strtotime(date($todate));
		$and = "AND user_transaction.created_at <= '$todates'";
	}else{
		$and = "";
	}
	$where = "user_transaction.created_at >= '$fromdate' $and";
}else{
    $where = 1;
}
$query = new db_query("SELECT * FROM user_transaction JOIN users ON users.user_id = user_transaction.user_id JOIN bank ON bank.bank_id = user_transaction.bank_id WHERE user_type = 1 AND $where  ORDER BY transaction_id DESC LIMIT $start_from, $record_per_page");

$html = '';
$html .= 
'<table bwallet="1" cellspacing="1">
<tr>
<th>Tên học viên</th>
<th>Tên người chuyển</th>
<th>Số tiền</th>
<th>Ngân hàng chuyển</th>
<th>Ngân hàng nạp</th>
<th>Số tài khoản</th>
<th>Thời gian chuyển</th>
<th>Nội dung</th>
<th>Trạng thái</th>
</tr>';
while($rowHV = mysql_fetch_array($query->result)){
	if ($rowHV['status'] == 1) {
		$status = 'Thành công';
	}elseif($rowHV['user_type'] == 2){
		$status = 'Thất bại';
	}else{
		$status = 'Đang chờ';
	}
	$html .= '
	<tr>
	<td>'.$rowHV['user_name'].'</td>
	<td>'.$rowHV['transaction_name'].'</td>
	<td>'.number_format($rowHV['total_money']).'</td>
	<td>'.$rowHV['bank_name'].'</td>
	<td>'.$rowHV['bank_name'].'</td>
	<td>'.$rowHV['acc_number'].'</td>
	<td>'.$rowHV['transaction_date'].'</td>
	<td style="overflow: hidden; text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 4;-webkit-box-orient: vertical;">'.$rowHV['transaction_content'].'</td>
	<td>'.$status .'</td>
	</tr>
	';
}
$html .= '</table>';
echo $html;

header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Vi-tien.xls");

?>