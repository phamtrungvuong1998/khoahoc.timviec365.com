<?
include_once '../config/config.php';
$code = getValue('ma', 'str', 'POST', '', '');
$transname = getValue('transname', 'str', 'POST', '', '');
$fromdate = getValue('fromdate', 'str', 'POST', '', '');
$enddate = getValue('enddate', 'str', 'POST', '', '');
$type = getValue('type','str','POST','','');

$fromdate = strtotime($fromdate);
$enddate = strtotime($enddate);
// echo $fromdate;
$get_code = '';
if ($code != '') {
    $get_code = " AND transaction_code = '$code'";
} else {
    $get_code = "";
}
$get_transname = '';
if ($transname != '') {
    $get_transname = " AND transaction_name = '$transname'";
} else {
    $get_transname = "";
}
$get_fromdate = '';
if ($fromdate != '') {
    $get_fromdate = " AND transaction_date >= '$fromdate'";
} else {
    $get_fromdate = "";
}
$get_enddate = '';
if ($enddate != '') {
    $get_enddate = " AND transaction_date <= '$enddate'";
} else {
    $get_enddate = "";
}
$user_type="";
if ($type == 2) {
    $user_type= " AND user_type = '$type'";
}else if($type == 3){
    $user_type= " AND user_type = '$type'";
}else{
    $user_type = "";
}
// echo $get_code;
$db_count = new db_query("SELECT * FROM user_transaction INNER JOIN users ON user_transaction.user_id = users.user_id WHERE  1=1" . $user_type . $get_code . $get_transname . $get_fromdate . $get_enddate);
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
        'result' => false,
        'message' => $error
    ];
} else {
    $db_trans = new db_query("SELECT * FROM user_transaction INNER JOIN users ON user_transaction.user_id = users.user_id WHERE 1=1 ". $user_type . $get_code . $get_transname . $get_fromdate . $get_enddate ." ORDER BY transaction_id DESC LIMIT $start,$limit");
    $html = '';
    $i=1;
    while ($row = mysql_fetch_assoc($db_trans->result)) {
        $html .= '<div class="l_noidungkh" id="l_noidungkh">
        <div class="l_table-cell l_stt">' . $i . '</div>';
        $html .= '<div class="l_table-cell ">' . $row['transaction_code'] . '</div>';
        $html .= '<div class="l_table-cell ">' . $row['transaction_name'] . '</div>';
        $html .= '<div class="l_table-cell l_content-list">' . $row['transaction_content'] . '</div>
        <div class="l_table-cell">
            <div>';
        $date = date_create();
        $a = $row['transaction_date'];
        date_timestamp_set($date, $a);
        $html .= date_format($date, "d-m-Y") . ' - ' . date_format($date, "H:i:s");
        $html .= '</div>
        </div>
        <div class="l_table-cell">';
        if ($row['plus_minus'] == 0) {
            $html .= "-" . format_number($row['withdrawal_amount']) . " ₫";
        } else {
            $html .= "+" . format_number($row['withdrawal_amount']) . " ₫";
        }
        $html .= '</div>
        <div class="l_table-cell l_sodu">' . format_number($row['total_money']) . ' đ</div>
        <div class="l_table-cell " id="status' . $row['transaction_id'] . '">';
        if ($row['status'] == 0) {
            $html .= "Đang chờ";
        } else if ($row['status'] == 1) {
            $html .= 'Thành công';
        } else {
            $html .= 'Thất bại';
        }
        $html .= '</div>
        <div class="l_table-cell">
            <input class="l_thanhcong" type="checkbox" id="tc' . $row['transaction_id'] . '" value="1" onchange="l_trangthai(' . $row['transaction_id'] . ',1)">
            <label for="tc' . $row['transaction_id'] . '">Thành công</label>
        </div>
        <div class="l_table-cell">
            <input class="l_thatbai" type="checkbox" id="tb' . $row['transaction_id'] . '" value="2" onchange="l_trangthai(' . $row['transaction_id'] . ',2)">
            <label for="tb' . $row['transaction_id'] . '">Thất bại</label>
        </div>
    </div>';
    $i++;
    }
    $phantrang = '';
	$t1 = $current_page - 1;
	if ($current_page > 1 && $total_page > 1) {
		$phantrang .= '<a class="l_phantrang_btn" onclick="l_search(' . $t1 . ')">&lt;</a>';
	}
	for ($i = 1; $i <= $total_page; $i++) {
		if ($i == $current_page) {
			$phantrang .= '<span class="l_phantrang_btn1">' . $i . '</span>';
		} else {
			$phantrang .= '<a class="l_phantrang_btn" onclick="l_search(' . $i . ')">' . $i . '</a>';
		}
	}
	$t2 = $current_page + 1;
	if ($current_page < $total_page && $total_page > 1) {
		$phantrang .= '<a class="l_phantrang_btn" onclick="l_search(' . $t2 . ')">&gt;</a>';
	}
    $data = [
        'result' => true,
        'html'=>$html,
        'phantrang' => $phantrang,
    ];
}
echo json_encode($data);