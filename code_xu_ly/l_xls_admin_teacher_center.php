<meta charset="UTF-8">
<?
require_once '../config/config.php';
$code = getValue('id', 'str', 'GET', '', '');
$teacher_name = getValue('name', 'str', 'GET', '', '');
$fromdate = getValue('fromdate', 'str', 'GET', '', '');
$enddate = getValue('todate', 'str', 'GET', '', '');
$type = getValue('type', 'str', 'GET', '', '');
$fromdate = strtotime($fromdate);
$enddate = strtotime($enddate);

// var_dump($_GET);
// echo $user_id.$address;

// $qr = new db_query("SELECT users.user_id,users.user_name,users.user_mail,users.user_phone FROM users INNER JOIN user_center_basis ON users.user_id = user_center_basis.user_id INNER JOIN city ON user_center_basis.cit_id = city.cit_id WHERE user_type = 3");
if ($code == 0 && $teacher_name == '' && $fromdate == '' && $enddate == 0) {
    // echo '1231231';
    $qr = new db_query("SELECT * FROM user_center_teacher ORDER BY center_teacher_id DESC");
    $html = '';
    $html .= '<table border="1" cellspacing="1">
        <tr>
            <th>STT</th>
            <th>MÃ TRUNG TÂM</th>
            <th>TÊN GIẢNG VIÊN</th>
            <th>MÔN HỌC GIẢNG DẠY</th>
            <th>TRÌNH ĐỘ CHUYÊN MÔN</th>
            <th>NGÀY THAM GIA</th>
        </tr>';
    $i = 1;
    while ($row = mysql_fetch_assoc($qr->result)) {
        $html .= '<tr>
        <td><center>' . $i . '</center></td>
        <td><center>' . $row['user_id'] . '</center></td>
        <td><center>' . $row['teacher_name'] . '</center></td>
        <td><center>';
        $a = explode(',', $row['cate_id']);
        $b = 1;
        $j = '';
        foreach ($a as $value) {
            $db_teacher = new db_query("SELECT * FROM categories WHERE cate_id = $value ");
            $cate = mysql_fetch_assoc($db_teacher->result);
            $html .= $cate['cate_name'];
            if ($b == count($a)) {
                $html .= '';
            } else if ($b == count($a) - 1) {
                $html .= ', ';
            } else if ($b != count($a) + 1) {
                $html .= ', ';
            }
            $b++;
        }
        $html .= '</center></td>
        <td><center>' .  $row['qualification'] . '</center></td>
        <td><center>' . date('d-m-Y', $row['date_join']) . '</center></td>';
    }
    echo $html;
} else {
    $get_code = '';
    if ($code != '') {
        $get_code = " AND user_id = '$code'";
    } else {
        $get_code = "";
    }
    $get_transname = '';
    if ($teacher_name != '') {
        $get_transname = " AND teacher_name = '$teacher_name'";
    } else {
        $get_transname = "";
    }
    $get_fromdate = '';
    if ($fromdate != '') {
        $get_fromdate = " AND date_join >= '$fromdate'";
    } else {
        $get_fromdate = "";
    }
    $get_enddate = '';
    if ($enddate != '') {
        $get_enddate = " AND date_join <= '$enddate'";
    } else {
        $get_enddate = "";
    }
    $db_count = new db_query("SELECT * FROM user_center_teacher WHERE 1=1 " . $get_code . $get_transname . $get_fromdate . $get_enddate);
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
        $qr = new db_query("SELECT * FROM user_center_teacher WHERE 1=1 " . $get_code . $get_transname . $get_fromdate . $get_enddate . " ORDER BY center_teacher_id DESC LIMIT $start,$limit");
        $html = '';
        $i = 1;
        $html .= '<table border="1" cellspacing="1">
        <tr>
            <th>STT</th>
            <th>MÃ TRUNG TÂM</th>
            <th>TÊN GIẢNG VIÊN</th>
            <th>MÔN HỌC GIẢNG DẠY</th>
            <th>TRÌNH ĐỘ CHUYÊN MÔN</th>
            <th>NGÀY THAM GIA</th>
        </tr>';
        $i = 1;
        while ($row = mysql_fetch_assoc($qr->result)) {
            $html .= '<tr>
            <td><center>' . $i . '</center></td>
            <td><center>' . $row['user_id'] . '</center></td>
            <td><center>' . $row['teacher_name'] . '</center></td>
            <td><center>';
            $a = explode(',', $row['cate_id']);
            $b = 1;
            $j = '';
            foreach ($a as $value) {
                $db_teacher = new db_query("SELECT * FROM categories WHERE cate_id = $value ");
                $cate = mysql_fetch_assoc($db_teacher->result);
                $html .= $cate['cate_name'];
                if ($b == count($a)) {
                    $html .= '';
                } else if ($b == count($a) - 1) {
                    $html .= ', ';
                } else if ($b != count($a) + 1) {
                    $html .= ', ';
                }
                $b++;
            }
            $html .= '</center></td>
            <td><center>' .  $row['qualification'] . '</center></td>
            <td><center>' . date('d-m-Y', $row['date_join']) . '</center></td>';
        }
        echo $html;
    }
}

("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=DanhSachGiangVien.xls");
