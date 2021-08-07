<?
include '../config/config.php';
$search = getValue('search', 'str', 'GET', '', '');
$user_id = $_COOKIE['user_id'];
// var_dump($_GET);
if ($search != '') {
    $db_count = new db_query("SELECT count(order_id) as total FROM `orders` INNER JOIN users ON orders.user_student_id = users.user_id INNER JOIN courses ON orders.course_id = courses.course_id WHERE orders.course_type = 1 AND courses.user_id = '$user_id' AND (orders.order_id LIKE '%$search%' OR courses.course_name LIKE '%$search%')");
    $row = mysql_fetch_assoc($db_count->result);
    $total_records = $row['total'];
    if ($total_records <= 0) {
        echo 'Không có mã đơn hàng hoặc tên khóa học nào có tên: ' . $search;
    } else {
        // echo $total_records;
        // die();
        $current_page = isset($_GET['p']) ? $_GET['p'] : 1;
        $limit = 10;
        $total_page = ceil($total_records / $limit);
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($current_page < 1) {
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $db_point = new db_query("SELECT * FROM `orders` INNER JOIN users ON orders.user_student_id = users.user_id INNER JOIN courses ON orders.course_id = courses.course_id WHERE orders.course_type = 1 AND courses.user_id = '$user_id' AND (orders.order_id LIKE '%$search%' OR courses.course_name LIKE '%$search%') ORDER BY order_id DESC LIMIT $start,$limit");
        $html = '';
        $arr = [];
        echo '<div class="l_excel"><a href="../code_xu_ly/l_xls_offlinedaban.php?search=' . $search . '"><button class="l_btn_excel">
        <img src="../img/l_excel.svg" alt="loading..." class="l_img_excel"> XUẤT EXCEL</button></a></div>';
        echo 'tachchuoi';
        while ($row = mysql_fetch_assoc($db_point->result)) {
            $arr[] = $row;
            $html .= '
            <div class="l_noidungkh">
                        <div class="l_table-cell l_table-text">
                           ' . $row['order_id'] . '
                        </div>
                        <div class="l_table-cell">
                            ' . $row['course_name'] . '
                        </div>
                        <div class="l_table-cell l_madonhang">
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
                        </div>
                        <div class="l_table-cell l_content-list">' . date('d-m-Y', $row['day_buy']) . '</div>
                        <div class="l_table-cell">' . format_number($row['total_prices']) . ' đ</div>';
            $od = $row['order_status'];
            if ($od == 0) {
                $html .= '<div class="l_table-cell l_dangcho">Đang chờ</div>';
            } else if ($od == 1) {
                $html .= '<div class="l_table-cell l_thanhcong">Thành công</div>';
            } else {
                $html .= '<div class="l_table-cell l_huy">Hủy đơn hàng</div>';
            }
            $html .= '</div>';
        }
        echo $html;
        echo 'tachchuoi';
        $mobile = '';
        foreach ($arr as $value) {
            $mobile .= '<center>
            <div class="v_content-mb">
                <div class="flex v_content-mb-div">
                    <p class="v_content-mb-title">' . $value['course_name'] . '</p>
                </div>

                <div class="flex v_info-all v_content-mb-div">
                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã đơn hàng: </span>' . $value['order_id'] . '</div>
                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tên học viên: </span>' . $value['user_name'] . '</div>
                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Email: </span>' . $value['user_mail'] . '</div>
                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số điện thoại: </span>' . $value['user_phone'] . '</div>
                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ngày giao dịch: </span>' . date('d-m-Y', $value['day_buy']) . '</div>
                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Học phí: </span>' . format_number($value['total_prices']) . ' đ</div>
                    <div class="v_content-mb-thongtin">
                        <span class="v_content-mb-span">Trạng thái: </span>';
            $od = $value['order_status'];
            if ($od == 0) {
                $mobile .= '<span class=" v_content-mb-thongtin l_dangcho">Đang chờ</span>';
            } else if ($od == 1) {
                $mobile .= '<span class="v_content-mb-thongtin l_thanhcong">Thành công</span>';
            } else {
                $mobile .= '<span class="v_content-mb-thongtin l_huy">Hủy đơn hàng</span>';
            }
            $mobile .= '
                    </div>
                </div>
            </div>
        </center>';
        }
        echo $mobile;
        echo 'tachchuoi';
        $t1 = $current_page - 1;
        if ($current_page > 1 && $total_page > 1) {
            echo '<a class="l_phantrang_btn" onclick="l_search(' . $user_id . ',' . $t1 . ')">&lt;</a>';
        }
        for ($i = 1; $i <= $total_page; $i++) {
            if ($i == $current_page) {
                echo '<span class="l_phantrang_btn1">' . $i . '</span>';
            } else {
                echo '<a class="l_phantrang_btn" onclick="l_search(' . $user_id . ',' . $i . ')">' . $i . '</a>';
            }
        }
        $t2 = $current_page + 1;
        if ($current_page < $total_page && $total_page > 1) {
            echo '<a class="l_phantrang_btn" onclick="l_search(' . $user_id . ',' . $t2 . ')">&gt;</a>';
        }
    }
} else {
    echo 'Không có mã đơn hàng hoặc tên khóa học nào có tên: ' . $search;
}

// $arr = [$html,$mobile,phantring];

// echo json_encode($arr);