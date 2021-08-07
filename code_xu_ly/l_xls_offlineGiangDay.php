<meta charset="UTF-8">
<?

include "../config/config.php";
$search = getValue('search', 'str', 'GET', '', '');
// echo $search;
// die();
$user_id = $_COOKIE['user_id'];
if ($search == '') {
    $db_course = new db_query("SELECT * FROM courses Where user_id = '$user_id' AND course_type = 1");
    $html = '';
    $html .= '<table border="1" cellspacing="1">
        <tr>
            <th>STT</th>
            <th>KHÓA HỌC</th>
            <th>MÔN HỌC</th>
            <th>TÊN GIẢNG VIÊN</th>
            <th>SỐ BUỔI HỌC</th>
            <th>TÀI LIỆU</th>
            <th>GIÁ GỐC</th>
            <th>GIÁ KHUYẾN MẠI</th>
            <th>NGÀY ĐĂNG</th>
        </tr>';
    $i = 1;
    while ($row = mysql_fetch_assoc($db_course->result)) {
        if ($row['price_promotional'] == -1) {
            $price_promotional = "Chưa cập nhật";
        }else{
            $price_promotional = number_format($row['price_promotional']) . " đ";
        }
        //print_r($row);
        $html .= '<tr>
        <td><center>' . $i . '</center></td>
        <td><center>' . $row['course_name'] . '</center></td>';
        $cate_id = $row['cate_id'];
        $qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
        $rowCate = mysql_fetch_array($qrCate->result);
        $html .= '<td><center>' . $rowCate['cate_name'] . '</center></td>';
        $center_teacher_id = $row['center_teacher_id'];
        $qrGV = new db_query("SELECT teacher_name FROM user_center_teacher WHERE center_teacher_id = '$center_teacher_id'");
        $rowGV = mysql_fetch_array($qrGV->result);
        $html .= '<td><center>' . $rowGV['teacher_name'] . '</center></td>';
        $html .= '<td><center>' . $row['time_learn'] . ' buổi</center></td>';
        $html .= '<td><center>' . $row['course_slide'] . ' file</center></td>';
        $html .= '<td><center>' . format_number($row['price_listed']) . ' đ</center></td>';
        $html .= '<td><center>' . $price_promotional . '</center></td>';
        $html .= '<td><center>' . date("d-m-Y", $row['created_at']) . '</center></td>
    </tr>
    ';
        $i++;
    }

    $html .= '</table>';
    echo $html;
} else {
    $db_course = new db_query("SELECT * FROM courses Where user_id = '$user_id' AND course_type = 1 AND course_name LIKE '%$search%'");
    $html = '';
    $html .= '<table border="1" cellspacing="1">
            <tr>
            <th>STT</th>
            <th>KHÓA HỌC</th>
            <th>MÔN HỌC</th>
            <th>TÊN GIẢNG VIÊN</th>
            <th>SỐ BUỔI HỌC</th>
            <th>TÀI LIỆU</th>
            <th>GIÁ GỐC</th>
            <th>GIÁ KHUYẾN MẠI</th>
            <th>NGÀY ĐĂNG</th>
            </tr>';
    $i = 1;
    while ($row = mysql_fetch_assoc($db_course->result)) {
        if ($row['price_promotional'] == -1) {
            $price_promotional = "Chưa cập nhật";
        }else{
            $price_promotional = number_format($row['price_promotional']) . " đ";
        }
        //print_r($row);
        $html .= '<tr>
                <td><center>' . $i . '</center></td>
                <td><center>' . $row['course_name'] . '</center></td>';
        $cate_id = $row['cate_id'];
        $qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
        $rowCate = mysql_fetch_array($qrCate->result);
        $html .= '<td><center>' . $rowCate['cate_name'] . '</center></td>';
        $center_teacher_id = $row['center_teacher_id'];
        $qrGV = new db_query("SELECT teacher_name FROM user_center_teacher WHERE center_teacher_id = '$center_teacher_id'");
        $rowGV = mysql_fetch_array($qrGV->result);
        $html .= '<td><center>' . $rowGV['teacher_name'] . '</center></td>';
        $html .= '<td><center>' . $row['time_learn'] . ' buổi</center></td>';
        $html .= '<td><center>' . $row['course_slide'] . ' file</center></td>';
        $price = $row['price_listed'] - $row['price_promotional'];
        $html .= '<td><center>' . format_number($row['price_listed']) . ' đ</center></td>';
        $html .= '<td><center>' . $price_promotional . '</center></td>';
        $html .= '<td><center>' . date("d-m-Y", $row['created_at']) . '</center></td>
            </tr>
            ';
        $i++;
    }
    $html .= '</table>';
    echo $html;
}
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=offline-giangday.xls");
