<?php
require_once '../config/config.php';
$user_id = getValue('user_id', 'int', 'POST', '', '');
$page = getValue('page', 'int', 'POST', '', '');
$name = getValue('name', 'str', 'POST', '', '');
$email = getValue('email', 'str', 'POST', '', '');
$phone = getValue('phone', 'str', 'POST', '', '');
$city = getValue('l_city', 'str', 'POST', '', '');
$district = getValue('l_district', 'str', 'POST', '', '');
$address = getValue('l_address', 'str', 'POST', '', '');
$startTime = getValue('startTime', 'str', 'POST', '', '');
$endTime = getValue('endTime', 'str', 'POST', '', '');
$startTime = strtotime($startTime);
$endTime = strtotime($endTime);

if ($name != '0') {
	$qr_name = " AND users.user_id = '$name' ";
} else {
	$qr_name = '';
}

if ($startTime != '') {
	$qr_start = " AND created_at >= $startTime";
} else {
	$qr_start = '';
}

if ($endTime != '') {
	$qr_end = " AND created_at <= $endTime";
} else {
	$qr_end = '';
}
$data_city = '';
if ($city != 0) {
	$qr_city = " AND user_center_basis.cit_id = $city";
	$db_cit = new db_query("SELECT * FROM city WHERE cit_parent = '$city' ");
	while ($row = mysql_fetch_assoc($db_cit->result)) {
		$data_city .= '<option value="' . $row['cit_id'] . '">' . $row['cit_name'] . '</option>';
	}
} else {
	$qr_city = '';
	$data_city .= '<option value="0" selected>--Chọn quận huyện--</option>';
}
if ($district != 0) {
	$qr_district = " AND user_center_basis.district_id = $district";
} else {
	$qr_district = '';
}

if ($address != '') {
	$qr_address = " AND user_center_basis.center_basis_address LIKE '%$address%'";
} else {
	$qr_address = '';
}
$db_count = new db_query("SELECT * FROM users INNER JOIN user_center_basis ON user_center_basis.user_id = users.user_id WHERE user_type = 3" . $qr_name . $qr_start . $qr_end . $qr_city . $qr_district . $qr_address);
$row = mysql_num_rows($db_count->result);
$total_records = $row;
$current_page = isset($_POST['page']) ? $_POST['page'] : 1;
$limit = 10;
$total_page = ceil($total_records / $limit);
if ($current_page > $total_page) {
	$current_page = $total_page;
} else if ($current_page < 1) {
	$current_page = 1;
}
$start = ($current_page - 1) * $limit;
if ($start < 0) {
	$error =  'Danh sách trống';
	$data = [
		'result' => 2,
		'message' => $error
	];
} else {
	$db_query = new db_query("SELECT * FROM users INNER JOIN user_center_basis ON user_center_basis.user_id = users.user_id INNER JOIN city ON user_center_basis.cit_id = city.cit_id WHERE user_type = 3 " . $qr_name . $qr_start . $qr_end . $qr_city . $qr_district . $qr_address . " ORDER BY users.user_id DESC LIMIT $start,$limit");
	$html = '';
	$i = 1;
	while ($rowHV = mysql_fetch_array($db_query->result)) {
		if ($rowHV['user_active'] == 1) {
			$user_active = "checked";
		} else {
			$user_active = "";
		}

		if ($rowHV['user_index'] == 1) {
			$user_index = "checked";
		} else {
			$user_index = "";
		}
		$html .= '<div class="manager remove" id="manager_2">
	<div class="v_title_student">' . $i . '</div>
	<div class="v_title_student">' . $rowHV['user_id'] . '</div>
	<div class="v_title_student"><a href="' . urlDetail_center($rowHV['user_id'], $rowHV['user_slug']) . '">' . $rowHV['user_name'] . '</a>
	</div>
	<div class="v_title_student">' . $rowHV['user_mail'] . '</div>
	<div class="v_title_student">' . $rowHV['user_phone'] . '</div>';
		$city = $rowHV['district_id'];
		$db_center_basis = new db_query("SELECT * FROM city where cit_id = '$city'");
		$row_ar = mysql_fetch_assoc($db_center_basis->result);
		$html .= '<div class="v_title_student">' . $rowHV['center_basis_address'] . ' - ' . $row_ar['cit_name'] . ' - ' . $rowHV['cit_name'];
		$html .= '</div>
	<div class="v_title_student">' . date("d-m-Y", $rowHV['created_at']) . '</div>
	<div class="v_title_student">' . date("d-m-Y", $rowHV['updated_at']) . '</div>
	<div class="v_title_student"><input type="checkbox" class="v_active" id="v_active' . $rowHV['user_id'] . '" name="active" onclick="active(' . $rowHV['user_id'] . ')" ' . $user_active . '>
	</div>
	<div class="v_title_student"><input type="checkbox" class="v_index" id="v_index' . $rowHV['user_id'] . '" name="student_index" onclick="active(' . $rowHV['user_id'] . ')" ' . $user_index . '></div>
	<div class="v_title_student"><a href="admin_update_center.php?id=' . $rowHV['user_id'] . '"><img id="admin_edit' . $rowHV['user_id'] . '" src="../img/vv_edi.svg" alt="Ảnh lỗi"></a></div>
	</div>';
		$i++;
		// $page++;
	}
	$phantrang = '';
	$t1 = $current_page - 1;
	if ($current_page > 1 && $total_page > 1) {
		$phantrang .= '<a class="l_phantrang_btn" onclick="l_filter_center(' . $t1 . ')">&lt;</a>';
	}
	for ($i = 1; $i <= $total_page; $i++) {
		if ($i == $current_page) {
			$phantrang .= '<span class="l_phantrang_btn1">' . $i . '</span>';
		} else {
			$phantrang .= '<a class="l_phantrang_btn" onclick="l_filter_center(' . $i . ')">' . $i . '</a>';
		}
	}
	$t2 = $current_page + 1;
	if ($current_page < $total_page && $total_page > 1) {
		$phantrang .= '<a class="l_phantrang_btn" onclick="l_filter_center(' . $t2 . ')">&gt;</a>';
	}


	$data = [
		'result' => 1,
		'city' => $data_city,
		'html' => $html,
		'phantrang' => $phantrang,
	];
}
echo json_encode($data);
