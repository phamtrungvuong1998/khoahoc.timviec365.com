<?
include '../config/config.php';
$search = getValue('search', 'str', 'GET', '', '');
$user_id = $_COOKIE['user_id'];
// var_dump($_GET);
if ($search != '') {
    $db_count = new db_query("SELECT COUNT(course_id) as total FROM courses Where course_type=2 AND user_id ='$user_id' AND course_name LIKE '%$search%'");
    $row = mysql_fetch_assoc($db_count->result);
    $total_records = $row['total'];
    if ($total_records <= 0) {
        echo 'Không có học viên nào có tên: ' . $search;
    } else {
        $current_page = isset($_GET['p']) ? $_GET['p'] : 1;
        $limit = 10;
        $total_page = ceil($total_records / $limit);
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($current_page < 1) {
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $db_point = new db_query("SELECT * FROM courses Where course_type=2 AND user_id ='$user_id' AND course_name LIKE '%$search%' ORDER BY course_id DESC LIMIT $start,$limit");
        $html = '';
        $arr = [];
        echo '<div class="l_excel"><a href="../code_xu_ly/l_xls_onlineGiangDay.php?search=' . $search . '"><button class="l_btn_excel">
        <img src="../img/l_excel.svg" alt="loading..." class="l_img_excel"> XUẤT EXCEL</button></a></div>';
        echo 'tachchuoi';
        while ($row = mysql_fetch_assoc($db_point->result)) {
            $arr[] = $row;
            $html .= '<div class="l_noidungkh">
                        <div class="l_table-cell l_table-text">
                            <p>' . $row['course_name'] . '</p>
                        </div>';
            $cate_id = $row['cate_id'];
            $qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
            $rowCate = mysql_fetch_array($qrCate->result);
            $html .= '<div class="l_table-cell">' . $rowCate['cate_name'] . '</div>';
            $center_teacher_id = $row['center_teacher_id'];
            $qrGV = new db_query("SELECT teacher_name FROM user_center_teacher WHERE center_teacher_id = '$center_teacher_id'");
            $rowGV = mysql_fetch_array($qrGV->result);
            $html .= '<div class="l_table-cell l_madonhang">' . $rowGV['teacher_name'] . '</div>
                        <div class="l_table-cell l_content-list">' . $row['time_learn'] . ' buổi</div>
                        <div class="l_table-cell">' . $row['course_slide'] . ' file</div>';
            $price = $row['price_listed'] - $row['price_promotional'];
            $html .= '<div class="l_table-cell">' . format_number($price) . ' đ</div>
                        <div class="l_table-cell">' . date("d-m-Y", $row['created_at']) . '</div>
                        <div class="l_table-cell l_curson">
                            <div onclick="l_chinhsua(' . $row['course_id'] . ')">
                                <img src="../img/More.svg" alt="">
                            </div>
                            <div class="l_hienthi_chinhsua" id="l_hienthi_chinhsua' . $row['course_id'] . '">
                                <a href="/cap-nhat-khoa-hoc-offline-trung-tam/id' . $user_id . '-courseOf' . $row['course_id'] . '.html">
                                    <button class="l_btn_chinhsua">
                                        <img src="../img/l_chinhsua.svg" alt="" class="l_img_chinhsua">
                                        <div class="l_chinhsuachu">
                                            Chỉnh sửa
                                        </div>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>';
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
                        <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Khóa học :</span>' . $value['course_name'] . '</div>';
            $cate_id = $value['cate_id'];
            $qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
            $rowCate = mysql_fetch_array($qrCate->result);
            $center_teacher_id = $value['center_teacher_id'];
            $qrGV = new db_query("SELECT teacher_name FROM user_center_teacher WHERE center_teacher_id = '$center_teacher_id'");
            $rowGV = mysql_fetch_array($qrGV->result);
            $mobile .= '
                        <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học: </span>' . $rowCate['cate_name'] . '</div>
                        <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tên giảng viên :</span>' . $rowGV['teacher_name'] . '</div>
                        <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số buổi học :</span>' . $value['time_learn'] . ' Buổi</div>
                        <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tài liệu :</span>' . $value['course_slide'] . ' file</div>
                        <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Học phí :</span>' . format_number($price) . ' đ</div>
                        <div class="v_content-mb-thongtin">
                            <span class="v_content-mb-span">Ngày đăng: </span>' . date("d-m-Y", $value['created_at']) . '</div>
                    </div>
                </div></center>';
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
    echo 'Không có học viên nào có tên: ' . $search;
}
