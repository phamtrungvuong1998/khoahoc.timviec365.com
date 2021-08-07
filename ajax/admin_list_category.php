<?php
require_once '../config/config.php';
$cate_id = getValue('name', 'int', 'POST', '', '');
// $page = getValue('page', 'int', 'POST', '', '');
// $name = getValue('name', 'str', 'POST', '', '');
// $email = getValue('email', 'str', 'POST', '', '');
// $phone = getValue('phone', 'str', 'POST', '', '');
// $city = getValue('l_city', 'str', 'POST', '', '');
// $district = getValue('l_district', 'str', 'POST', '', '');
// $address = getValue('l_address', 'str', 'POST', '', '');
// $startTime = getValue('startTime', 'str', 'POST', '', '');
// $endTime = getValue('endTime', 'str', 'POST', '', '');
// $startTime = strtotime($startTime);
// $endTime = strtotime($endTime);
// echo $user_id;
if ($cate_id != '0') {
    $qr_name = " AND cate_id = '$cate_id' ";
} else {
    $qr_name = '';
}
$db_count = new db_query("SELECT * FROM categories WHERE 1=1 " . $qr_name);
// var_dump($db_count) ;
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
    $db_query = new db_query("SELECT * FROM categories WHERE 1=1 " . $qr_name . " ORDER BY cate_id DESC LIMIT $start,$limit");
    $html = '';
    $i = 1;
    while ($rowHV = mysql_fetch_array($db_query->result)) {
        $html .= '<div class="manager remove" id="manager_2">
        <div class="v_title_student">'. $i.'</div>
        <div class="v_title_student">'. $rowHV['cate_id'].'</div>
        <div class="v_title_student">'. $rowHV['cate_name'].'</div>
        <div class="v_title_student">'. $rowHV['cate_icon'].'</div>
        <div class="v_title_student"><a href="admin_update_center.php?id='. $rowHV['cate_id'].'"><img id="admin_edit'. $rowHV['cate_id'].'" src="../img/vv_edi.svg" alt="Ảnh lỗi"></a></div>
    </div>
        ';
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
        'html' => $html,
        'phantrang' => $phantrang,
    ];
}
echo json_encode($data);
