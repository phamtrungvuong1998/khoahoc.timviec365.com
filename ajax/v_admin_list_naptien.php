<?php
require_once '../config/config.php';
$user_id = getValue('user_id','int','GET','');
$bank = getValue('bank','int','GET','');
$form_recharge = getValue('form_recharge','int','GET','');
$status = getValue('status','int','GET','');
$page = getValue('page','int','GET','');

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

if ($page == 1) {
	$page = 0;
}else{
	$page = ($page-1)*30;
}

$query = "SELECT * FROM rechange_notice INNER JOIN users ON rechange_notice.user_id = users.user_id INNER JOIN bank ON rechange_notice.bank_id = bank.bank_id INNER JOIN form_recharge ON form_recharge.form_recharge_id = rechange_notice.recharge_form_id WHERE users.user_type = 1 " .$qr_id.$qrbank.$qrform_recharge.$qrstatus. "ORDER BY rechange_notice.recharge_id ASC LIMIT 0,30";
$qr = new db_query($query);
$qr_count = new db_query("SELECT * FROM rechange_notice INNER JOIN users ON rechange_notice.user_id = users.user_id INNER JOIN bank ON rechange_notice.bank_id = bank.bank_id INNER JOIN form_recharge ON form_recharge.form_recharge_id = rechange_notice.recharge_form_id WHERE users.user_type = 1 " .$qr_id.$qrbank.$qrform_recharge.$qrstatus. "ORDER BY rechange_notice.recharge_id ASC");
$count = ceil(mysql_num_rows($qr_count->result)/30);
$html = '';
$page = $page+1;
while($rowHV = mysql_fetch_array($qr->result)){
	if ($rowHV['status_recharge'] == 0) {
		$status = "Đang chờ";
		$success = "";
		$danger = "";
	}else if ($rowHV['status_recharge'] == 1){
		$status = "Thất bại";
		$success = "disabled";
		$danger = "disabled checked";
	}else{
		$status = "Thành công";
		$success = "disabled checked";
		$danger = "disabled";
	}
	$qr_bank = new db_query("SELECT bank_name FROM bank WHERE bank_id = " . $rowHV['bank_recharge']);
	$row_bank = mysql_fetch_array($qr_bank->result);
	$html = $html . '<div class="manager" id="manager'.$rowHV['recharge_id'].'">
	<div class="v_title_student">'.$page.'</div>
	<div class="v_title_student">'.$rowHV['user_id'].'</div>
	<div class="v_title_student">'.$rowHV['user_name'].'
	</div>
	<div class="v_title_student">'.$rowHV['amount'].'</div>
	<div class="v_title_student">'.$rowHV['bank_name'].'</div>
	<div class="v_title_student">'.$rowHV['form_recharge_name'].'</div>
	<div class="v_title_student">'.$row_bank['bank_name'].'</div>
	<div class="v_title_student">'.$rowHV['recharge_name'].'</div>
	<div class="v_title_student">'.$rowHV['bank_account'].'</div>
	<div class="v_title_student">'.date("d-m-Y",$rowHV['time_recharge']).'</div>
	<div class="v_title_student">'.$rowHV['content_recharge'].'</div>
	<div class="v_title_student">'.$status.'</div>
	<div class="v_title_student"><input type="checkbox" id="success'.$rowHV['recharge_id'].'" '.$success.' onclick="v_success('.$rowHV['recharge_id'].',2)"></div>
	<div class="v_title_student" id="delete'.$rowHV['recharge_id'].'"><input id="danger'.$rowHV['recharge_id'].'" type="checkbox" '.$danger.' onclick="v_success('.$rowHV['recharge_id'].',1)"></div>
	</div>
	</div>';
	$page++;
}

$v_paging = '<ul id="v_ul_paginition">
<li id="v_previous" onclick="v_paging(\'previous\')"><</li>';

for ($i = 1; $i <= $count; $i++) {
	$v_paging = $v_paging . '<li id="v_pa'.$i.'" class="v_pa" onclick="v_paging('.$i.')">'.$i.'</li>';               	
}                         
$v_paging = $v_paging.'<li id="v_next" onclick="v_paging(\'next\')">></li>
</ul>';



$data = [
	'html'=>$html,
	'v_paging'=>$v_paging
];

echo json_encode($data);
?>