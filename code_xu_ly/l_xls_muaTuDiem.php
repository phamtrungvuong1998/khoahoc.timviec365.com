<meta charset="UTF-8">
<?

include "../config/config.php";
$search = getValue('search', 'str', 'GET', '', '');
$user_id = $_COOKIE['user_id'];
if ($search == '') {
    $db_point = new db_query("SELECT * FROM history_point INNER JOIN users ON user_student_id=users.user_id INNER JOIN city ON users.cit_id=city.cit_id Where center_teacher_id = '$user_id'");
    $html = '';
    $html .= '<table border="1" cellspacing="1">
        <tr>
            <th>STT</th>
            <th>HỌ TÊN</th>
            <th>EMAIL</th>
            <th>SỐ ĐIỆN THOẠI</th>
            <th>MÔN HỌC QUAN TÂM</th>
            <th>ĐỊA CHỈ</th>
        </tr>';
    $i = 1;
    while ($row = mysql_fetch_assoc($db_point->result)) {
        //print_r($row);
        $html .= '
    <tr>
        <td><center>' . $i . '</center></td>
        <td><center>' . $row['user_name'] . '</center></td>
        <td><center>' . $row['user_mail'] . '</center></td>
        <td><center>' . $row['user_phone'] . '</center></td>';
        $cat = explode(',', $row['cate_id']);
        $j = '';
        $b = 0;
        $html .= '<td><center>';
        foreach ($cat as $value) {
            $db_cate = new db_query("SELECT cate_name FROM categories WHERE cate_id =" . $value);
            $a = mysql_fetch_assoc($db_cate->result);
            //echo $a['cate_name'];
            if ($b == count($cat) - 1) {
                $html .= $j . $a['cate_name'];
            } else {
                $html .= $j . $a['cate_name'] . ', ';
            }
            $b++;
        }
        $html .= '</center></td>';

        $db_city = new db_query("SELECT cit_name FROM city where cit_id =" . $row['district_id']);
        $city = mysql_fetch_assoc($db_city->result);
        $html .= '<td><center>' . $city = $city['cit_name'] . ' - ' . $row['cit_name'] . '</center></td>
    </tr>
    ';
        $i++;
    }

    $html .= '</table>';
    echo $html;
} else {
    $db_point = new db_query("SELECT * FROM history_point INNER JOIN users ON user_student_id=users.user_id INNER JOIN city ON users.cit_id=city.cit_id Where center_teacher_id = '$user_id' AND user_name LIKE '%$search%'");
    $html = '';
    $html .= '<table border="1" cellspacing="1">
            <tr>
                <th>STT</th>
                <th>HỌ TÊN</th>
                <th>EMAIL</th>
                <th>SỐ ĐIỆN THOẠI</th>
                <th>MÔN HỌC QUAN TÂM</th>
                <th>ĐỊA CHỈ</th>
            </tr>';
    $i = 1;
    while ($row = mysql_fetch_assoc($db_point->result)) {
        //print_r($row);
        $html .= '
        <tr>
            <td><center>' . $i . '</center></td>
            <td><center>' . $row['user_name'] . '</center></td>
            <td><center>' . $row['user_mail'] . '</center></td>
            <td><center>' . $row['user_phone'] . '</center></td>';
        $cat = explode(',', $row['cate_id']);
        $j = '';
        $c = 0;
        $html .= '<td><center>';
        foreach ($cat as $value) {
            $db_cate = new db_query("SELECT cate_name FROM categories WHERE cate_id =" . $value);
            $a = mysql_fetch_assoc($db_cate->result);
            //echo $a['cate_name'];
            if ($c == count($cat) - 1) {
                $html .= $j . $a['cate_name'];
            } else {
                $html .= $j . $a['cate_name'] . ', ';
            }
            $c++;
        }
        $html .= '</center></td>';

        $db_city = new db_query("SELECT cit_name FROM city where cit_id =" . $row['district_id']);
        $city = mysql_fetch_assoc($db_city->result);
        $html .= '<td><center>' . $city = $city['cit_name'] . ' - ' . $row['cit_name'] . '</center></td>
        </tr>
        ';
        $i++;
    }

    $html .= '</table>';
    echo $html;
}
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=hvMuaTuDiem.xls");
