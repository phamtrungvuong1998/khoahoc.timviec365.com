<?
include '../config/config.php';
$search = getValue('search', 'str', 'GET', '', '');
$user_id = $_COOKIE['user_id'];
// ech
if ($search != '') {
    $db_count = new db_query("SELECT count(common_id)as total FROM order_common INNER JOIN courses ON courses.course_id = order_common.course_id WHERE courses.user_id = '$user_id' AND courses.course_name LIKE '%$search%'");
    $row1 = mysql_fetch_assoc($db_count->result);
    $total_records = $row1['total'];
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
        $excel = '<div class="l_excel">
        <a href="../code_xu_ly/l_xls_muachung.php?search=' . $search . '">
            <button class="l_btn_excel">
                <img src="../img/l_excel.svg" alt="loading..." class="l_img_excel"> XUẤT EXCEL
            </button>
        </a>
    </div>';
        $db_danhgia = new db_query("SELECT * FROM order_common INNER JOIN courses ON courses.course_id = order_common.course_id WHERE courses.user_id = '$user_id' AND courses.course_name LIKE '%$search%' ORDER BY common_id DESC LIMIT $start,$limit");
        $html = '';
        while ($row = mysql_fetch_assoc($db_danhgia->result)) {
            $arr[] = $row;
            $html .= '<div class="l_noidungkh">
            <div class="l_table-cell l_madonhang">' . $row['common_id'] . '</div>
            <div class="l_table-cell"> ' . $row['course_name'] . '</div>
            <div class="l_table-cell">';
            $price = $row['price_listed'] - $row['price_promotional'];
            $num = $row['quantity_std'];
            $a = round($price / $num, 0);
            $html .= format_number($a) . ' đ';
            $html .= '</div>
            <div class="l_table-cell l_center">' . format_number($price) . ' đ</div>

            <div class="l_table-cell l_center">' . $row['numbers'] . '/' . $row['quantity_std'] . '</div>';
            if ($row['order_status'] == 0) {
                $html .= '<div class="l_table-celll l_trangthai l_center">Đang chờ</div>';
            } else {
                $html .= '<div class="l_table-celll l_molop l_center">Mở lớp</div>';
            }
            $html .= '</div>';
        }
        $mobile = '';
        foreach ($arr as $value) {
            $mobile .= '<center>
            <div class="v_content-mb">
                <div class="flex v_content-mb-div">
                    <p class="v_content-mb-title">' . $value['course_name'] . '</p>
                </div>

                <div class="flex v_info-all v_content-mb-div">
                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã đơn hàng: </span>' . $value['common_id'] . '</div>
                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Học phí: </span>';
                        $price = $value['price_listed'] - $value['price_promotional'];
                        $num = $value['quantity_std'];
                        $a = round($price / $num, 0);
                        $mobile .= format_number($a) . ' đ
                    </div>
                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tổng tiền: </span>' . format_number($price) . ' đ</div>
                    <div class="v_content-mb-thongtin">
                        <span class="v_content-mb-span">Học viên chờ :</span>' . $value['numbers'] . '/' . $value['quantity_std'] . '</div>
                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Trạng thái: </span>';
            if ($value['order_status'] == 0) {
                $mobile .= '<span class="v_content-mb-span l_trangthai"> Đang chờ</span>';
            } else {
                $mobile .= '<span class="v_content-mb-span">Mở lớp</span>';
            }
            $mobile .= '</div>
                </div>
            </div>
        </center>';
        }
        $phantrang = '';
        $t1 = $current_page - 1;
        if ($current_page > 1 && $total_page > 1) {
            $phantrang .= '<a class="l_phantrang_btn" onclick="l_timkiem(' . $user_id . ',' . $t1 . ')">&lt;</a>';
        }
        for ($i = 1; $i <= $total_page; $i++) {
            if ($i == $current_page) {
                $phantrang .= '<span class="l_phantrang_btn1">' . $i . '</span>';
            } else {
                $phantrang .= '<a class="l_phantrang_btn" onclick="l_timkiem(' . $user_id . ',' . $i . ')">' . $i . '</a>';
            }
        }
        $t2 = $current_page + 1;
        if ($current_page < $total_page && $total_page > 1) {
            $phantrang .= '<a class="l_phantrang_btn" onclick="l_timkiem(' . $user_id . ',' . $t2 . ')">&gt;</a>';
        }
        $data = [
            'result' => 2,
            'pc' => $html,
            'mobile' => $mobile,
            'phantrang' => $phantrang,
            'excel' => $excel,
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
