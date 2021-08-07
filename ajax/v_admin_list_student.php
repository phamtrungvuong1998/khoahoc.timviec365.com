<?php
require_once '../config/config.php';
$user_id = getValue('user_id','int','POST','');
$page = getValue('page','int','POST','');
$name = getValue('name','str','POST','');
$email = getValue('email','str','POST','');
$phone = getValue('phone','str','POST','');
$startTime = getValue('startTime','str','POST','');
$endTime = getValue('endTime','str','POST','');
$adm_type = getValue('adm_type','int','POST','');
$module = getValue('module','int','POST','');
$adm_id = getValue('adm_id','int','POST','');

$startTime = strtotime($startTime);
$endTime = strtotime($endTime);

if ($user_id != 0) {
	$qr_id = " AND user_id = '$user_id' ";
}else{
	$qr_id = '';
}

if ($name != '0') {
	$qr_name = " AND user_name = '$name' ";
}else{
	$qr_name = '';
}

if ($email != '0') {
	$qr_email = " AND user_mail = '$email' ";
}else{
	$qr_email = '';
}
if ($phone != '0') {
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

$query = "SELECT * FROM users INNER JOIN city ON users.cit_id = city.cit_id WHERE user_type = 1" . $qr_id . $qr_name . $qr_email . $qr_phone . $qr_start . $qr_end ." ORDER BY user_id DESC LIMIT ". $page .", 30";
$qr = new db_query($query);
$qr_count = new db_query("SELECT * FROM users WHERE user_type = 1" . $qr_id . $qr_name . $qr_email . $qr_phone . $qr_start . $qr_end ." ORDER BY user_id DESC");
$count = ceil(mysql_num_rows($qr_count->result)/30);
$html = '';
$page = $page+1;
while($rowHV = mysql_fetch_array($qr->result)){
	if ($rowHV['user_active'] == 1) {
		$user_active = "checked";
	}else{
		$user_active = "";
	}

	if ($rowHV['user_index'] == 1) {
		$user_index = "checked";
	}else{
		$user_index = "";
	}
	$showedit = "";
	if ($adm_type == 0) {
		$check = new db_query("SELECT * FROM admin_permission WHERE adm_id = $adm_id AND module_id = $module AND permis_update = 1");
		if (mysql_num_rows($check->result) > 0) {
			$showedit .= '
				<div class="v_title_student"><input type="checkbox" class="v_active" id="v_active'.$rowHV['user_id'].'" name="active" onclick="active('.$rowHV['user_id'].')" '.$user_active.' readOnly></div>
				<div class="v_title_student"><input type="checkbox" class="v_index" id="v_index'.$rowHV['user_id'].'" name="student_index" onclick="active('.$rowHV['user_id'].')" '.$user_index.'></div>
				<div class="v_title_student"><img id="admin_edit'.$rowHV['user_id'].'" src="../img/vv_edi.svg" onclick="v_student_edit('.$rowHV['user_id'].')" alt="Ảnh lỗi"></div>
			';
		}
	}else{
		$showedit .= '
				<div class="v_title_student"><input type="checkbox" class="v_active" id="v_active'.$rowHV['user_id'].'" name="active" onclick="active('.$rowHV['user_id'].')" '.$user_active.' readOnly></div>
				<div class="v_title_student"><input type="checkbox" class="v_index" id="v_index'.$rowHV['user_id'].'" name="student_index" onclick="active('.$rowHV['user_id'].')" '.$user_index.'></div>
				<div class="v_title_student"><img id="admin_edit'.$rowHV['user_id'].'" src="../img/vv_edi.svg" onclick="v_student_edit('.$rowHV['user_id'].')" alt="Ảnh lỗi"></div>
			';
	}

	if ($rowHV['cit_id'] == 0) {
		$city = "Chưa cập nhật";
		$district = "Chưa cập nhật";
	}else{
		$city = $rowHV['cit_name'];
		$db_district = new db_query("SELECT cit_name FROM city WHERE cit_parent = " . $rowHV['cit_id']);
		$row_district = mysql_fetch_array($db_district->result);
		$district = $row_district['cit_name'];
	}
	$html .='<div class="manager" id="manager'.$rowHV['user_id'].'">
		<div class="v_title_student">'.$page.'</div>
		<div class="v_title_student">'.$rowHV['user_id'].'</div>
	<div class="v_title_student"><a
		href="'.urlDetail_student($rowHV['user_id'],$rowHV['user_slug']).'">'.$rowHV['user_name'].'</a>
	</div>
	<div class="v_title_student">'.$rowHV['user_mail'].'</div>
	<div class="v_title_student">'.$rowHV['user_phone'].'</div>
	<div class="v_title_student">'.$rowHV['user_address'].'</div>
	<div class="v_title_student">'.$city.'</div>
	<div class="v_title_student">'.$district.'</div>
	<div class="v_title_student">'.date("d-m-Y",$rowHV['created_at']).'</div>
	<div class="v_title_student">'.date("d-m-Y",$rowHV['updated_at']).'</div>
		'.$showedit.'
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