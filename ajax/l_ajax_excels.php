
<?
include '../config/config.php';
$user_id = $_COOKIE['user_id'];
$db_trans = new db_query("SELECT transaction_id,created_at,transaction_code,transaction_content,transaction_date,withdrawal_amount,total_money,plus_minus FROM user_center_transaction WHERE user_id = '$user_id' ORDER BY transaction_id DESC");
$html = '';
$html .= '
<table>
        <tr>
            <th>STT</th>
            <th>MÃ GIAO DỊCH</th>
            <th>NỘI DUNG CHUYỂN TIỀN</th>
            <th>NGÀY GIAO DỊCH</th>
            <th>SỐ TIỀN GIAO DỊCH</th>
            <th>SỐ DƯ</th>
        </tr>
';
$i = 1;
while ($row = mysql_fetch_assoc($db_trans->result)) {

    $html .= '
    
    <tr>
        <td><center>' . $i . '</center></td>
        <td><center>' . $row['transaction_code'] . '</center></td>
        <td><center>' . $row['transaction_content'] . '</center></td>';
    $date = date_create();
    $a = $row['transaction_date'];
    date_timestamp_set($date, $a);
    $html .= '
        <td><center>' . date_format($date, "d-m-Y H:i:s") . '</center></td>';
       
        if ($row['plus_minus'] == 0) {
            $html .= "<td><center>-" . format_number($row['withdrawal_amount']) . " ₫</center></td>";
        } else {
            $html .= "<td><center>+" . format_number($row['withdrawal_amount']) . " ₫</center></td>";
        }
    $html .= '
        <td><center>' . $row['total_money'] . '</center></td>
    </tr>
    ';
    $i++;
}

$html .= '</table>';
echo $html;
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=LichSuGiaoDich.xls");
