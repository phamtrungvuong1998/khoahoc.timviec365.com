<meta charset="UTF-8">
<?
require_once '../config/config.php';
$user_id = getValue('id', 'int', 'GET', '', '');
$startTime = getValue('startTime', 'str', 'GET', '', '');
$endTime = getValue('endTime', 'str', 'GET', '', '');
$city = getValue('city', 'int', 'GET', '', '');
$district = getValue('district', 'int', 'GET', '', '');
$address = getValue('address', 'str', 'GET', '', '');
$startTime = strtotime($startTime);
$endTime = strtotime($endTime);

// echo $user_id.$address;

// $qr = new db_query("SELECT users.user_id,users.user_name,users.user_mail,users.user_phone FROM users INNER JOIN user_center_basis ON users.user_id = user_center_basis.user_id INNER JOIN city ON user_center_basis.cit_id = city.cit_id WHERE user_type = 3");
if ($user_id == 0 && $startTime == '' && $endTime == '' && $city == 0 && $district == 0) {
    // echo '1231231';
    $qr = new db_query("SELECT * FROM users WHERE user_type = 3 ORDER BY user_id DESC");
    $html = '';
    $html .= '<table border="1" cellspacing="1">
        <tr>
            <th>STT</th>
            <th>MÃ TRUNG TÂM</th>
            <th>TÊN TRUNG TÂM</th>
            <th>EMAIL</th>
            <th>SỐ ĐIỆN THOẠI</th>
            <th>ĐỊA CHỈ</th>
            <th>NGÀY ĐĂNG KÝ</th>
            <th>NGÀY CẬP NHẬT</th>
            <th>ACTIVE</th>
        </tr>';
    $i = 1;
    while ($row = mysql_fetch_assoc($qr->result)) {
        if ($row['user_active'] == 1) {
            $user_active = "Đã xác nhận";
        } else {
            $user_active = "Chưa xác nhận";
        }
        $html .= '<tr>
        <td><center>' . $i . '</center></td>
        <td><center>' . $row['user_id'] . '</center></td>
        <td><center>' . $row['user_name'] . '</center></td>
        <td><center>' . $row['user_mail'] . '</center></td>
        <td><center>' . $row['user_phone'] . '</center></td>';
        $city = $row['user_id'];
        $j = 1;
        $html_city = '';
        $db_center_basis = new db_query("SELECT * FROM user_center_basis INNER JOIN city ON user_center_basis.cit_id = city.cit_id where user_id = '$city'");
        while ($row_ar = mysql_fetch_assoc($db_center_basis->result)) {
            $district = $row_ar['district_id'];
            $db_district = new db_query("SELECT cit_name FROM city where cit_id = '$district'");
            $row_dis = mysql_fetch_assoc($db_district->result);

            $html_city .= '<div class="">Cơ Sở   ' . $j . ': ' . $row_ar['center_basis_address'] . ' - ' . $row_dis['cit_name'] . ' - ' . $row_ar['cit_name'] . '</div>';
            $j++;
        }

        $html .= '<td><center>' . $html_city . '</center></td>
        <td><center>' . date("d-m-Y", $row['created_at']) . '</center></td>
        <td><center>' . date("d-m-Y", $row['updated_at']) . '</center></td>
        <td><center>' . $user_active . '</center></td>';
        $i++;
    }
    echo $html;
} else {
    if ($user_id != 0) {
        $qr_id = " AND users.user_id = '$user_id' ";
    } else {
        $qr_id = '';
    }

    if ($city != 0) {
        $qr_city = " AND user_center_basis.cit_id = $city";
    } else {
        $qr_city = '';
    }

    if ($district != 0) {
        $qr_district = " AND user_center_basis.district_id = $district";
    } else {
        $qr_district = '';
    }

    if ($address != '') {
        $qr_address = " AND user_center_basis.center_basis_address LIKE '%$address%'";
    } else {
        $qr_address = '';
    }
    if ($startTime != '') {
        $qr_start = " AND created_at >= $startTime";
    } else {
        $qr_start = '';
    }

    if ($endTime != '') {
        $qr_end = " AND created_at <= $endTime";
    } else {
        $qr_end = '';
    }
    $db_search = new db_query("SELECT * FROM users INNER JOIN user_center_basis ON user_center_basis.user_id = users.user_id INNER JOIN city ON user_center_basis.cit_id = city.cit_id WHERE user_type = 3" . $qr_id . $qr_start . $qr_end . $qr_city . $qr_district . $qr_address);
    // var_dump($db_search);
    $html = '';
    $html .= '<table border="1" cellspacing="1">
        <tr>
            <th>STT</th>
            <th>MÃ TRUNG TÂM</th>
            <th>TÊN TRUNG TÂM</th>
            <th>EMAIL</th>
            <th>SỐ ĐIỆN THOẠI</th>
            <th>ĐỊA CHỈ</th>
            <th>NGÀY ĐĂNG KÝ</th>
            <th>NGÀY CẬP NHẬT</th>
            <th>ACTIVE</th>
        </tr>';
    $i = 1;
    $a = [];
    while ($row = mysql_fetch_assoc($db_search->result)) {
        $a[] = $row;
        if ($row['user_active'] == 1) {
            $user_active = "Đã xác nhận";
        } else {
            $user_active = "Chưa xác nhận";
        }
        $html .= '<tr>
        <td><center>' . $i . '</center></td>
        <td><center>' . $row['user_id'] . '</center></td>
        <td><center>' . $row['user_name'] . '</center></td>
        <td><center>' . $row['user_mail'] . '</center></td>
        <td><center>' . $row['user_phone'] . '</center></td>';
        $district_id = $row['district_id'];
        $db_district = new db_query("SELECT cit_name FROM city where cit_id = '$district_id'");
        $row_dis = mysql_fetch_assoc($db_district->result);
        $html .= '<td><center>' . $row['center_basis_address'] . ' - ' . $row_dis['cit_name'] . ' - ' . $row['cit_name'] . '</center></td>
        <td><center>' . date("d-m-Y", $row['created_at']) . '</center></td>
        <td><center>' . date("d-m-Y", $row['updated_at']) . '</center></td>
        <td><center>' . $user_active . '</center></td>';
    }
    echo $html;
}

("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=DanhSachTrungTam.xls");
