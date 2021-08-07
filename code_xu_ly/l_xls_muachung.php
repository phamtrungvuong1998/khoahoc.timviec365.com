<meta charset="UTF-8">
<?

include "../config/config.php";
$search = getValue('search', 'str', 'GET', '', '');
$user_id = $_COOKIE['user_id'];
if ($search == '') {
    $db_danhgia = new db_query("SELECT * FROM order_common INNER JOIN courses ON courses.course_id = order_common.course_id WHERE courses.user_id = '$user_id'");
    $html = '';
    $html .= '<table border="1" cellspacing="1">
        <tr>
            <th>STT</th>
            <th>MÃ ĐƠN HÀNG</th>
            <th>KHÓA HỌC</th>
            <th>HỌC PHÍ</th>
            <th>TỔNG TIỀN</th>
            <th>HỌC VIÊN ĐĂNG KÝ</th>
            <th>TRẠNG THÁI</th>
        </tr>';
    $i = 1;
    while ($row = mysql_fetch_assoc($db_danhgia->result)) {
        $html .= '<tr>
        <td><center>' . $i . '</center></td>
        <td><center>' . $row['common_id'] . '</center></td>
        <td><center>' . $row['course_name'] . '</center></td>';
        $price = $row['price_listed'] - $row['price_promotional'];
        $num = $row['quantity_std'];
        $a = round($price / $num, 0);
        $html .= '<td><center>' . format_number($a) . ' đ</center></td>';
        $html .= '<td><center>' . format_number($price) . ' đ</center></td>';
        $html .= '<td><center>' . $row['numbers'] . '|' . $row['quantity_std'] . '</center></td>';
        if ($row['order_status'] == 0) {
            $html .= '<td><center>Đang chờ</center></td>';
        } else {
            $html .= '<td><center>Mở lớp</center></td>';
        }
        $html .= '</tr>';
        $i++;
    }
    $html .= '</table>';
    echo $html;
} else {
    $db_point = new db_query("SELECT * FROM order_common INNER JOIN courses ON courses.course_id = order_common.course_id WHERE courses.user_id = '$user_id' AND courses.course_name LIKE '%$search%'");
    $html = '';
    $html .= '<table border="1" cellspacing="1">
        <tr>
        <th>STT</th>
        <th>MÃ ĐƠN HÀNG</th>
        <th>KHÓA HỌC</th>
        <th>HỌC PHÍ</th>
        <th>TỔNG TIỀN</th>
        <th>HỌC VIÊN ĐĂNG KÝ</th>
        <th>TRẠNG THÁI</th>
    </tr>';
    $i = 1;
    while ($row = mysql_fetch_assoc($db_point->result)) {
        $html .= '<tr>
        <td><center>' . $i . '</center></td>
        <td><center>' . $row['common_id'] . '</center></td>
        <td><center>' . $row['course_name'] . '</center></td>';
        $price = $row['price_listed'] - $row['price_promotional'];
        $num = $row['quantity_std'];
        $a = round($price / $num, 0);
        $html .= '<td><center>' . format_number($a) . ' đ</center></td>';
        $html .= '<td><center>' . format_number($price) . ' đ</center></td>';
        $html .= '<td><center>' . $row['numbers'] . '|' . $row['quantity_std'] . '</center></td>';
        if ($row['order_status'] == 0) {
            $html .= '<td><center>Đang chờ</center></td>';
        } else {
            $html .= '<td><center>Mở lớp</center></td>';
        }
        $html .= '</tr>';
        $html .= '</tr>';
        $i++;
    }
    $html .= '</table>';
    echo $html;
}
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=khoahocmuachung.xls");
