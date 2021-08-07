<meta charset="UTF-8">
<?
require_once '../config/config.php';
$code = getValue('id', 'int', 'GET', '', '');
$name = getValue('name', 'int', 'GET', '', '');
$startdate = getValue('startdate', 'str', 'GET', '', '');
$enddate = getValue('enddate', 'str', 'GET', '', '');
$gv_tt = getValue('gv_tt', 'int', 'GET', '', '');
$startdate = strtotime($startdate);
$enddate = strtotime($enddate);

// echo $user_id.$address;

// $qr = new db_query("SELECT users.user_id,users.user_name,users.user_mail,users.user_phone FROM users INNER JOIN user_center_basis ON users.user_id = user_center_basis.user_id INNER JOIN city ON user_center_basis.cit_id = city.cit_id WHERE user_type = 3");
if ($code == 0 && $name == '' && $startdate == '' && $enddate == 0 && $gv_tt == 0) {
    // echo '1231231';
    $qr = new db_query("SELECT * FROM user_transaction INNER JOIN users ON user_transaction.user_id = users.user_id WHERE user_type = 3 OR user_type = 2 ORDER BY transaction_id DESC");
    $html = '';
    $html .= '<table border="1" cellspacing="1">
        <tr>
            <th>STT</th>
            <th>MÃ GIAO DỊCH</th>
            <th>TÊN CHỦ TÀI KHOẢN</th>
            <th>NỘI DUNG CHUYỂN TIỀN</th>
            <th>NGÀY GIAO DỊCH</th>
            <th>SỐ TIỀN GIAO DỊCH</th>
            <th>SỐ DƯ</th>
            <th>TRẠNG THÁI</th>
        </tr>';
    $i = 1;
    while ($row = mysql_fetch_assoc($qr->result)) {
        if ($row['status'] == 1) {
            $user_status = "Thành công";
        } else if ($row['status'] == 2) {
            $user_status = "Thất bại";
        } else {
            $user_status = "Đang chờ";
        }
        $html .= '<tr>
        <td><center>' . $i . '</center></td>
        <td><center>' . $row['transaction_code'] . '</center></td>
        <td><center>' . $row['transaction_name'] . '</center></td>
        <td><center>' . $row['transaction_content'] . '</center></td>
        <td><center>';
        $date = date_create();
        $a = $row['transaction_date'];
        date_timestamp_set($date, $a);
        $html .= date_format($date, "d-m-Y") . ' - ' . date_format($date, "H:i:s") . '</center></td>';;
        $html .= '<td><center>';
        if ($row['plus_minus'] == 0) {
            $html .= "-" . format_number($row['withdrawal_amount']) . " ₫";
        } else {
            $html .= "+" . format_number($row['withdrawal_amount']) . " ₫";
        }
        $html .= '</center></td>
        <td><center>' . date("d-m-Y", $row['updated_at']) . '</center></td>
        <td><center>' . $user_status . '</center></td>';
    }
    echo $html;
} else {
    if ($code != '') {
        $get_code = " AND transaction_code = '$code'";
    } else {
        $get_code = "";
    }
    $get_transname = '';
    if ($name != '') {
        $get_transname = " AND transaction_name = '$name'";
    } else {
        $get_transname = "";
    }
    $get_fromdate = '';
    if ($startdate != '') {
        $get_fromdate = " AND transaction_date >= '$startdate'";
    } else {
        $get_fromdate = "";
    }
    $get_enddate = '';
    if ($enddate != '') {
        $get_enddate = " AND transaction_date <= '$enddate'";
    } else {
        $get_enddate = "";
    }
    $user_type = "";
    if ($gv_tt == 2) {
        $user_type = " AND user_type = '$gv_tt'";
    } else if ($gv_tt == 3) {
        $user_type = " AND user_type = '$gv_tt'";
    } else {
        $user_type = "";
    }
    $db_trans = new db_query("SELECT * FROM user_transaction INNER JOIN users ON user_transaction.user_id = users.user_id WHERE 1=1 " . $user_type . $get_code . $get_transname . $get_fromdate . $get_enddate . " ORDER BY transaction_id DESC");
    // var_dump($db_search);
    $html = '';
    $html .= '<table border="1" cellspacing="1">
        <tr>
        <th>STT</th>
        <th>MÃ GIAO DỊCH</th>
        <th>TÊN CHỦ TÀI KHOẢN</th>
        <th>NỘI DUNG CHUYỂN TIỀN</th>
        <th>NGÀY GIAO DỊCH</th>
        <th>SỐ TIỀN GIAO DỊCH</th>
        <th>SỐ DƯ</th>
        <th>TRẠNG THÁI</th>
        </tr>';
    $i = 1;
    while ($row = mysql_fetch_assoc($db_trans->result)) {
        if ($row['status'] == 1) {
            $user_status = "Thành công";
        } else if ($row['status'] == 2) {
            $user_status = "Thất bại";
        } else {
            $user_status = "Đang chờ";
        }
        $html .= '<tr>
        <td><center>' . $i . '</center></td>
        <td><center>' . $row['transaction_code'] . '</center></td>
        <td><center>' . $row['transaction_name'] . '</center></td>
        <td><center>' . $row['transaction_content'] . '</center></td>
        <td><center>';
        $date = date_create();
        $a = $row['transaction_date'];
        date_timestamp_set($date, $a);
        $html .= date_format($date, "d-m-Y") . ' - ' . date_format($date, "H:i:s") . '</center></td>';;
        $html .= '<td><center>';
        if ($row['plus_minus'] == 0) {
            $html .= "-" . format_number($row['withdrawal_amount']) . " ₫";
        } else {
            $html .= "+" . format_number($row['withdrawal_amount']) . " ₫";
        }
        $html .= '</center></td>
        <td><center>' . date("d-m-Y", $row['updated_at']) . '</center></td>
        <td><center>' . $user_status . '</center></td>';
        $i++;
    }
    echo $html;
}

("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=LichSuGiaoDich.xls");
