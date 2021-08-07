<meta charset="UTF-8">
<?php
require_once '../config/config.php';
$type = getValue('type','int','GET','');
$user_id = getValue('user_id','int','GET','');
$page = getValue('page','int','GET','');
$name = getValue('name','str','GET','');
$email = getValue('email','str','GET','');
$phone = getValue('phone','str','GET','');
$startTime = getValue('startTime','str','GET','');
$endTime = getValue('endTime','str','GET','');

$startTime = strtotime($startTime);
$endTime = strtotime($endTime);

if ($user_id != 0) {
	$qr_id = " AND user_id = '$user_id' ";
}else{
	$qr_id = '';
}

if ($name != '') {
	$qr_name = " AND user_name = '$name' ";
}else{
	$qr_name = '';
}

if ($email != '') {
	$qr_email = " AND user_mail = '$email' ";
}else{
	$qr_email = '';
}
if ($phone != '') {
	$qr_phone = " AND user_phone = '$phone' ";
}else{
	$qr_phone = '';
}

if ($startTime != '') {
	$qr_start = " AND created_at >= $startTime";
}else{
	$qr_start = '';
}

if ($endTime != '') {
	$qr_end = " AND created_at <= $endTime";
}else{
	$qr_end = '';
}

if ($page == 1) {
	$page = 0;
}else{
	$page = ($page-1)*30;
}

$query = "SELECT * FROM users WHERE user_type = $type" . $qr_id . $qr_name . $qr_email . $qr_phone . $qr_start . $qr_end ." ORDER BY user_id DESC LIMIT ". $page .", 30";
$qr = new db_query($query);
$html = '';
$page = $page+1;
$html .= '<table border="1" cellspacing="1">
<tr>
<th>STT</th>
<th>HỌ TÊN</th>
<th>EMAIL</th>
<th>SỐ ĐIỆN THOẠI</th>
<th>ĐỊA CHỈ</th>
<th>NGÀY ĐĂNG KÍ</th>
</tr>';
$i = 1;
while($row = mysql_fetch_array($qr->result)){
	if ($row['cit_id'] != 0) {
		$qrCity = new db_query("SELECT cit_name FROM city WHERE cit_id = " . $row['cit_id']);
		$rowCity = mysql_fetch_array($qrCity->result);
		if ($row['district_id'] != 0) {
			$qrDistrict = new db_query("SELECT cit_name FROM city WHERE cit_parent = " . $row['cit_id']);
		$rowDistrict = mysql_fetch_array($qrDistrict->result);
		$address = $row['user_address'] ."-". $rowDistrict['cit_name'] . "-" . $rowCity['cit_name'];
		}else{
			$address = $row['user_address'] . "-" . $rowCity['cit_name'];
		}
	}else{
		$address = $row['user_address'];
	}
	$html .= '
	<tr>
	<td><center>' . $i . '</center></td>
	<td><center>' . $row['user_name'] . '</center></td>
	<td><center>' . $row['user_mail'] . '</center></td>
	<td><center>' . $row['user_phone'] . '</center></td>
	<td><center>' . $address . '</center></td>
	<td><center>' . date("d-m-Y",$row['created_at']) . '</center></td>
	</tr>
	';
     $i++;
}

echo $html;

header("Content-Type:application/xls");
if ($type == 1) {
	header("Content-Disposition: attachment; filename=Hoc-Vien.xls");
}else if($type == 2){
	header("Content-Disposition: attachment; filename=Giang-Vien.xls");
}

?>