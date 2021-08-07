<meta charset="UTF-8">
<?php
require_once '../config/config.php';
$record_per_page = 20;
$user_id = getValue('user_id','str','GET','');
$order = getValue('order','str','GET','');
$page = '';
if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1)*$record_per_page;

if($order == 'order' && $user_id != 1){
	$where = "orders.user_student_id = $user_id";
}elseif($order == 'ordertnamemail'){
	$where = "orders.user_student_id = $user_id";
}elseif($order == 'order_id'){
	$where = "order_id = $user_id";
}elseif($order == 'orderbuy'){
	$fromdate = strtotime(date($user_id));
	$todate = getValue('todate','str','GET','');
	if($todate != ""){
		$todates = $fromdate = strtotime(date($todate));
		$and = "AND orders.day_buy <= '$todates'";
	}else{
		$and = "";
	}
	$where = "orders.day_buy >= '$fromdate' $and";
}else{
	$where = 1;
}
$query = new db_query("SELECT * FROM orders JOIN courses ON courses.course_id = orders.course_id JOIN users ON users.user_id = orders.user_student_id WHERE $where ORDER BY order_status ASC LIMIT $start_from, $record_per_page");

$html = '';
$html .= 
'<table border="1" cellspacing="1">
<tr>
	<th>Mã đơn</th>
	<th>Tên</th>
	<th>Email</th>
	<th>Số điện thoại</th>
	<th>Địa chỉ</th>
	<th>Khóa học</th>
	<th>Tổng tiền</th>
	<th>Ngày mua</th>
</tr>';
while($rowHV = mysql_fetch_array($query->result)){
	$html .= '
	<tr>
		<td>'.$rowHV['order_id'].'</td>
		<td>'. $rowHV['user_name'].'</td>
		<td>'. $rowHV['user_mail'].'</td>
		<td>'. $rowHV['user_phone'].'</td>
		<td>'. $rowHV['user_address'].'</td>
		<td>'. $rowHV['course_name'].'</td>
		<td>'. number_format($rowHV['total_prices']).' đ</td>
		<td>'. date("d-m-Y", $rowHV['day_buy']) .'</td>
	</tr>
	';
}
$html .= '</table>';
echo $html;

header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Don-hang.xls");

?>