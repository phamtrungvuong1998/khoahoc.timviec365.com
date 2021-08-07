<?
include_once '../config/config.php';
// var_dump($_POST);
$code = getValue('ma', 'str', 'POST', '', '');
$teacher_name = getValue('teacher_name', 'str', 'POST', '', '');
$fromdate = getValue('fromdate', 'str', 'POST', '', '');
$enddate = getValue('enddate', 'str', 'POST', '', '');
$type = getValue('type', 'str', 'POST', '', '');

$fromdate = strtotime($fromdate);
$enddate = strtotime($enddate);
// echo $fromdate;
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
// echo $get_code;
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
    $db_trans = new db_query("SELECT * FROM user_center_teacher WHERE 1=1 " . $get_code . $get_transname . $get_fromdate . $get_enddate . " ORDER BY center_teacher_id DESC LIMIT $start,$limit");
    $html = '';
    $i = 1;
    while ($row = mysql_fetch_assoc($db_trans->result)) {
        $html .= '<div class="l_noidungkh" id="l_noidungkh">
        <div class="l_table-cell l_stt">' . $i . '</div>
        <div class="l_table-cell ">' . $row['user_id'] . '</div>
        <div class="l_table-cell ">' . $row['teacher_name'] . '</div>
        <div class="l_table-cell ">';
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
        $html .= '</div>
        <div class="l_table-cell ">' . $row['qualification'] . '</div>
        <div class="l_table-cell ">' . date('d-m-Y', $row['date_join']) . '</div>
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
        'html' => $html,
        'phantrang' => $phantrang,
    ];
    // echo $html;
}

echo json_encode($data);