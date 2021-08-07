<meta charset="UTF-8">
<?

include "../config/config.php";
$search = getValue('search', 'str', 'GET', '', '');
$user_id = $_COOKIE['user_id'];
if ($search == '') {
    $db_danhgia = new db_query("SELECT * FROM rate_course INNER JOIN courses ON rate_course.course_id =  courses.course_id WHERE courses.user_id = '$user_id'");
    $html = '';
    $html .= '<table border="1" cellspacing="1">
        <tr>
            <th>STT</th>
            <th>MÃ KHÓA HỌC</th>
            <th>KHÓA HỌC</th>
            <th>ĐÁNH GIÁ</th>
        </tr>';
    $i = 1;
    while ($row = mysql_fetch_assoc($db_danhgia->result)) {
        //print_r($row);
        $html .= '<tr>
        <td><center>' . $i . '</center></td>
        <td><center>' . $row['course_id'] . '</center></td>
        <td><center>' . $row['course_name'] . '</center></td>';
        if ($row['course_type'] == 1) {
            $total = ($row['lesson'] + $row['teacher']) / 2;
            $a = round($total, 1);
            if ($a >= 1 && $a < 2) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 1/5*</center></td>';
                //$html .= '<div><img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a >= 2 && $a < 3) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 2/5*</center></td>';
                //$html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                //$html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a >= 3 && $a < 4) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 3/5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a >= 4 && $a < 5) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 4/5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a == 5) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            }
        } else {
            $total = ($row['lesson'] + $row['teacher'] + $row['video']) / 3;
            $a = round($total, 1);
            if ($a >= 1 && $a < 2) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 1/5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a >= 2 && $a < 3) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 2/5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a >= 3 && $a < 4) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 3/5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a >= 4 && $a < 5) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 4/5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a == 5) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            }
        }
        $html .= '</tr>';
        $i++;
    }

    $html .= '</table>';
    echo $html;
} else {
    $db_point = new db_query("SELECT * FROM rate_course INNER JOIN courses ON rate_course.course_id =  courses.course_id WHERE courses.user_id = '$user_id' AND courses.course_name LIKE '%$search%'");
    $html = '';
    $html .= '<table border="1" cellspacing="1">
        <tr>
            <th>STT</th>
            <th>MÃ KHÓA HỌC</th>
            <th>KHÓA HỌC</th>
            <th>ĐÁNH GIÁ</th>
        </tr>';
    $i = 1;
    while ($row = mysql_fetch_assoc($db_point->result)) {
        //print_r($row);
        $html .= '<tr>
        <td><center>' . $i . '</center></td>
        <td><center>' . $row['course_id'] . '</center></td>
        <td><center>' . $row['course_name'] . '</center></td>';
        if ($row['course_type'] == 1) {
            $total = ($row['lesson'] + $row['teacher']) / 2;
            $a = round($total, 1);
            if ($a >= 1 && $a < 2) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 1/5*</center></td>';
                //$html .= '<div><img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a >= 2 && $a < 3) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 2/5*</center></td>';
                //$html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                //$html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a >= 3 && $a < 4) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 3/5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a >= 4 && $a < 5) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 4/5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a == 5) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            }
        } else {
            $total = ($row['lesson'] + $row['teacher'] + $row['video']) / 3;
            $a = round($total, 1);
            if ($a >= 1 && $a < 2) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 1/5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a >= 2 && $a < 3) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 2/5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a >= 3 && $a < 4) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 3/5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a >= 4 && $a < 5) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 4/5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            } else if ($a == 5) {
                $html .= '<td><center>' . $row['comment_rate'] . ' - 5*</center></td>';
                // $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading...">';
                // $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
            }
        }
        $html .= '</tr>';
        $i++;
    }

    $html .= '</table>';
    echo $html;
}
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=dsdanhgia.xls");
