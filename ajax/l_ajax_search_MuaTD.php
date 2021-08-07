<?
include '../config/config.php';
$search = getValue('search', 'str', 'GET', '', '');
$user_id = $_COOKIE['user_id'];

if ($search != '') {
    $db_count = new db_query("SELECT count(history_point_id) as total FROM history_point INNER JOIN users ON user_student_id=users.user_id Where center_teacher_id = '$user_id' AND user_name LIKE '%$search%'");
    $row = mysql_fetch_assoc($db_count->result);
    $total_records = $row['total'];
    if ($total_records <= 0) {
        $error =  'Không có tên khóa học nào có tên: ' . $search;
        $data = [
            'result' => 1,
            'message' => $error
        ];
    } else {
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 10;
        $total_page = ceil($total_records / $limit);
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($current_page < 1) {
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $db_point = new db_query("SELECT * FROM history_point INNER JOIN users ON user_student_id=users.user_id INNER JOIN city ON users.cit_id=city.cit_id Where center_teacher_id = '$user_id' AND user_name LIKE '%$search%' ORDER BY history_point_id DESC LIMIT $start,$limit");
        $html = '';
        $arr = [];
        $buton = '<div class="l_excel"><a href="../code_xu_ly/l_xls_muaTuDiem.php?search=' . $search . '"><button class="l_btn_excel">
        <img src="../img/l_excel.svg" alt="loading..." class="l_img_excel"> XUẤT EXCEL</button></a></div>';
        //echo 'tachchuoi';
        while ($row = mysql_fetch_assoc($db_point->result)) {
            $arr[] = $row;
            $html .= '<div class="l_noidungkh">
        <div class="l_table-cell">
            <div class="l_tenhocvien">
                ' . $row['user_name'] . '
            </div>
            <div class="l_lienhehocvien">
                ' . $row['user_mail'] . '
            </div>
            <div class="l_lienhehocvien">
                ' . $row['user_phone'] . '
            </div>
        </div>
        <div class="l_table-cell ">';
            $cat = explode(',', $row['cate_id']);
            $j = '';
            $i = 0;
            foreach ($cat as $value) {
                $db_cate = new db_query("SELECT cate_name FROM categories WHERE cate_id =" . $value);
                $a = mysql_fetch_assoc($db_cate->result);
                //echo $a['cate_name'];
                if ($i == count($cat) - 1) {
                    $html .= $j . $a['cate_name'];
                } else {
                    $html .= $j . $a['cate_name'] . ', ';
                }
                $i++;
            }
            $html .= '
        </div>
        <div class="l_table-cell l_content-list">';
            $db_city = new db_query("SELECT cit_name FROM city where cit_id =" . $row['district_id']);
            $city = mysql_fetch_assoc($db_city->result);
            $html .= $city['cit_name'];
            $html .= ' - ' . $row['cit_name'];
            $html .= '</div><div class="l_table-cell"><a href="' . urlDetail_student($row['user_id'], $row['user_slug']) . '" class="l_xemthem">Xem thêm</a>
        </div></div>';
        }
        //echo $html;
        //echo 'tachchuoi';
        $mobile = '';
        foreach ($arr as $value) {
            $mobile .= '<center>
            <div class="v_content-mb">
            <!-- <div class="flex v_content-mb-div">
            <p class="v_content-mb-title">Học SASS và cắt web từ file thiết kế Photoshop theo kiểu SASS...</p>
            </div> -->
            <div class="flex v_info-all v_content-mb-div">
                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tên học viên: </span>' . $value['user_name'] . '</div>
                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mail: </span>' . $value['user_mail'] . '</div>
                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số điện thoại: </span>' . $value['user_phone'] . '</div>
                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học quan tâm: </span>
                    ';
            $cat = explode(',', $value['cate_id']);
            $j = '';
            $i = 0;
            foreach ($cat as $b) {
                $db_cate = new db_query("SELECT cate_name FROM categories WHERE cate_id =" . $b);
                $a = mysql_fetch_assoc($db_cate->result);
                //echo $a['cate_name'];
                if ($i == count($cat) - 1) {
                    $mobile .= $j . $a['cate_name'];
                } else {
                    $mobile .= $j . $a['cate_name'] . ', ';
                }
                $i++;
            }
            $mobile .= '</div>
                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Địa chỉ: </span>';
            $db_city = new db_query("SELECT cit_name FROM city where cit_id =" . $value['district_id']);
            $city = mysql_fetch_assoc($db_city->result);
            $mobile .= $city['cit_name'];
            $mobile .= ' - ' . $value['cit_name'];
            $mobile .= '</div>
                <div class="v_content-mb-thongtin"><a href="' . urlDetail_student($row['user_id'], $row['user_slug']) . '"><span class="v_content-mb-span">Xem thêm</span></a></div>
            </div>
            </div></center>';
        }
        // echo $mobile;
        // echo 'tachchuoi';
        $phantrang = '';
        $t1 = $current_page - 1;
        if ($current_page > 1 && $total_page > 1) {
            $phantrang .= '<a class="l_phantrang_btn" onclick="l_search(' . $user_id . ',' . $t1 . ')">&lt;</a>';
        }
        for ($i = 1; $i <= $total_page; $i++) {
            if ($i == $current_page) {
                $phantrang .= '<span class="l_phantrang_btn1">' . $i . '</span>';
            } else {
                $phantrang .= '<a class="l_phantrang_btn" onclick="l_search(' . $user_id . ','  . $i . ')">' . $i . '</a>';
            }
        }
        $t2 = $current_page + 1;
        if ($current_page < $total_page && $total_page > 1) {
            $phantrang .= '<a class="l_phantrang_btn" onclick="l_search(' . $user_id . ','  . $t2 . ')">&gt;</a>';
        }
        $data = [
            'result' => 2,
            'pc' => $html,
            'mobile' => $mobile,
            'phantrang' => $phantrang,
            'excel' => $buton,
        ];
    }
} else {
    $error =  'rỗng';
    $data = [
        'result' => 3,
        'message' => $error
    ];
}
echo json_encode($data);
