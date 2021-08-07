<?php
require_once '../config/config.php';
$today = strtotime(date("d-m-Y"));
$user_id = getValue('id', 'int', 'POST', '', '');
$user = getValue('user', 'str', 'POST', '', '');
$phone = getValue('phone', 'str', 'POST', '', '');
$center_date = getValue('center_date', 'str', 'POST', '', '');
$center_thue = getValue('center_thue', 'str', 'POST', '', '');
$l_city = getValue('l_city', 'str', 'POST', '', '');
$l_district = getValue('l_district', 'str', 'POST', '', '');
$l_address = getValue('l_address', 'str', 'POST', '', '');
$l_gioithieu = getValue('l_gioithieu', 'str', 'POST', '', '');
$l_link = getValue('l_link', 'str', 'POST', '', '');
$l_chude = getValue('l_chude', 'str', 'POST', '', '');
$l_check = getValue('l_check', 'str', 'POST', '', '');
$user_slug = ChangeToSlug($user);
// echo $phone;
if ($user_id != 0 && $user != '' && $phone != '' && $center_date != '' && $center_thue != '' && $l_city != '' && $l_district != '' && $l_address != '' && $l_gioithieu != '' && $l_link != '' && $l_chude != '' && $l_check != '') {
	$select_user = new db_query("SELECT * FROM users Where user_slug = '$user_slug' AND user_type = 3 AND user_id != '$user_id'");
	if (mysql_num_rows($select_user->result) > 0) {
		$result = [
			'result' => 1,
			'message' => "Tên trung tâm đã được sử dụng",
		];
	} else {
		$id = ['user_id' => $user_id];
		$user = [
			'user_name' => $user,
			'user_phone' => $phone,
			'user_birth' => $center_date,
			'cate_id' => $l_chude,
			'updated_at' => $today,
		];
		update('users', $user, $id);
		$user_center = [
			'advantages_id' => $l_check,
			'tax_code' => $center_thue,
			'center_intro' => $l_gioithieu,
			'link_student_community' => $l_link,
		];
		update('user_center', $user_center, $id);
		$cit = explode(',', $l_city);
		$dis = explode(',', $l_district);
		$address = explode(',', $l_address);
		update('user_center', $user_center, $id);
		$del = new db_query("DELETE FROM user_center_basis Where user_id = " . $user_id);
		for ($i = 0; $i < count($cit); $i++) {
			for ($j = 0; $j < count($dis); $j++) {
				if ($i == $j) {
					$user_basic = [
						'user_id' => $user_id,
						'cit_id' => $cit[$j],
						'district_id' => $dis[$j],
						'center_basis_address' => $address[$j]
					];
					add('user_center_basis', $user_basic);
				}
			}
		}
		$result = [
			'result' => 2,
			'message' => "Cập nhật thành công",
		];
	}
} else {
	$result = [
		'result' => 3,
		'message' => "Cập nhật thất bại",
	];
}

echo json_encode($result);
