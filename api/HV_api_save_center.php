<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$page = getValue('page','int','POST','');
$qr = new db_query("SELECT * FROM users INNER JOIN rate_center ON users.user_id = rate_center.center_id INNER JOIN save_center ON save_center.center_id = users.user_id WHERE save_center.user_student_id = $user_id");
$data['save_center'] = [];
while ($row = mysql_fetch_array($qr->result)) {
    $arr_cate = explode(",", $row['cate_id']);
    $cate_name = "";
    for ($i = 0; $i < count($arr_cate); $i++) {
    	$qrCate = new db_query("SELECT cate_id, cate_name FROM categories WHERE cate_id = " . $arr_cate[$i]);
    	$rowCate = mysql_fetch_array($qrCate->result);
    	if ($i == count($arr_cate) - 1) {
    		$cate_name = $cate_name . $rowCate['cate_name'];
    	}else{
    		$cate_name = $cate_name . $rowCate['cate_name'] . ",";
    	}
    }

    $rate = ($row['teacher'] + $row['place_class'] + $row['infrastructure'] + $row['student_number'] + $row['enviroment'] + $row['student_care'] + $row['practice'] + $row['pround_price'] + $row['self_improvement'] + $row['ready_introduct'])/10;

    $data['save_center'][$row['user_id']]['center_avatar'] = $row['user_avatar'];
    $data['save_center'][$row['user_id']]['center_name'] = $row['user_name'];
    $data['save_center'][$row['user_id']]['categories'] = $cate_name;
    $data['save_center'][$row['user_id']]['rate_center'] = $rate;
}

success('',$data);
?>