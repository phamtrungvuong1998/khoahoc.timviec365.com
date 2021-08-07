<meta charset="UTF-8">
<?

include "../config/config.php";
$search = getValue('search', 'str', 'GET', '', '');
// echo $search;
$user_id = $_COOKIE['user_id'];
if ($search == '') {
    $db_course = new db_query("SELECT * FROM `orders` INNER JOIN users ON orders.user_student_id = users.user_id INNER JOIN courses ON orders.course_id = courses.course_id WHERE orders.course_type = 1 AND courses.user_id = '$user_id'");
    $html = '';
    $html .= '<table border="1" cellspacing="1">
        <tr>
            <th>STT</th>
            <th>MÃ ĐƠN HÀNG</th>
            <th>MÔN HỌC </th>
            <th>TÊN HỌC VIÊN </th>
            <th>NGÀY GIAO DỊCH</th>
            <th>HỌC PHÍ</th>
            <th>TRẠNG THÁI</th>
        </tr>';
    $i = 1;
    while ($row = mysql_fetch_assoc($db_course->result)) {
        //print_r($row);
        $html .= '<tr>
        <td><center>' . $i . '</center></td>
        <td><center>' . $row['order_id'] . '</center></td>';
        $html .= '<td><center>' . $row['course_name'] . '</center></td>';
        $html .= '<td><center>' . $row['user_name'] . '</center></td>';
        $html .= '<td><center>' . date("d-m-Y", $row['day_buy']) . '</center></td>';
        $html .= '<td><center>' . format_number($row['total_prices']) . ' đ</center></td>';
        $od = $row['order_status'];
        if($od == 0 ){
            $html .= '<td><center>Đang chờ</center></td>';
        }else if($od == 1){
            $html .= '<td><center>Thành công</center></td>';
        }else{
            $html .= '<td><center>Hủy đơn hàng</center></td>';
        }
        $html .= '</tr>';
        $i++;
    }
    $html .= '</table>';
    echo $html;
} else {
    $db_course = new db_query("SELECT * FROM `orders` INNER JOIN users ON orders.user_student_id = users.user_id INNER JOIN courses ON orders.course_id = courses.course_id WHERE orders.course_type = 1 AND courses.user_id = '$user_id' AND (orders.order_id LIKE '%$search%' OR courses.course_name LIKE '%$search%')");
    $html = '';
    $html .= '<table border="1" cellspacing="1">
        <tr>
            <th>STT</th>
            <th>MÃ ĐƠN HÀNG</th>
            <th>MÔN HỌC </th>
            <th>TÊN HỌC VIÊN </th>
            <th>NGÀY GIAO DỊCH</th>
            <th>HỌC PHÍ</th>
            <th>TRẠNG THÁI</th>
        </tr>';
    $i = 1;
    while ($row = mysql_fetch_assoc($db_course->result)) {
        //print_r($row);
        $html .= '<tr>
        <td><center>' . $i . '</center></td>
        <td><center>' . $row['order_id'] . '</center></td>';
        $html .= '<td><center>' . $row['course_name'] . '</center></td>';
        $html .= '<td><center>' . $row['user_name'] . '</center></td>';
        $html .= '<td><center>' . date("d-m-Y", $row['day_buy']) . '</center></td>';
        $html .= '<td><center>' . format_number($row['total_prices']) . ' đ</center></td>';
        $od = $row['order_status'];
        if($od == 0 ){
            $html .= '<td><center>Đang chờ</center></td>';
        }else if($od == 1){
            $html .= '<td><center>Thành công</center></td>';
        }else{
            $html .= '<td><center>Hủy đơn hàng</center></td>';
        }
        $html .= '</tr>';
        $i++;
    }
    $html .= '</table>';
    echo $html;
}
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=offline-daban.xls");
