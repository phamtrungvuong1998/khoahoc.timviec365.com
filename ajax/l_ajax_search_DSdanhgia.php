<?
include '../config/config.php';
$search = getValue('search', 'str', 'GET', '', '');
$user_id = $_COOKIE['user_id'];
// var_dump($_GET) ;
// ech
if ($search != '') {
    $db_count = new db_query("SELECT count(courses.course_id)as total FROM rate_course INNER JOIN courses ON rate_course.course_id =  courses.course_id WHERE courses.user_id = '$user_id' AND courses.course_name LIKE '%$search%'");
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
        <a href="../code_xu_ly/l_xls_dsdanhgia.php?search=' . $search . '">
            <button class="l_btn_excel">
                <img src="../img/l_excel.svg" alt="loading..." class="l_img_excel"> XUẤT EXCEL
            </button>
        </a>
    </div>';
        $db_danhgia = new db_query("SELECT * FROM rate_course INNER JOIN courses ON rate_course.course_id =  courses.course_id WHERE courses.user_id = '$user_id' AND courses.course_name LIKE '%$search%' ORDER BY rate_id DESC LIMIT $start,$limit");
        $html = '';
        while ($row = mysql_fetch_assoc($db_danhgia->result)) {
            $arr[] = $row;
            $html .= '<div class="l_noidungkh">
        <div class="l_table-cell l_madonhang">' . $row['course_id'] . '</div>
        <div class="l_table-cell l_content-list">' . $row['course_name'] . '</div>
        <div class="l_table-cell">';
            if ($row['course_type'] == 1) {
                $total = ($row['lesson'] + $row['teacher']) / 2;
                $a = round($total, 1);
                if ($a >= 1 && $a < 2) {
                    $html .= '<div>' . $row['comment_rate'] . '</div>';
                    $html .= '<div><img src="../img/image/star.svg" alt="loading..."></div>';
                } else if ($a >= 2 && $a < 3) {
                    $html .= '<div>' . $row['comment_rate'] . '</div>';
                    $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
                } else if ($a >= 3 && $a < 4) {
                    $html .= '<div>' . $row['comment_rate'] . '</div>';
                    $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
                } else if ($a >= 4 && $a < 5) {
                    $html .= '<div>' . $row['comment_rate'] . '</div>';
                    $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
                } else if ($a == 5) {
                    $html .= '<div>' . $row['comment_rate'] . '</div>';
                    $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
                }
            } else {
                $total = ($row['lesson'] + $row['teacher'] + $row['video']) / 3;
                $a = round($total, 1);
                if ($a >= 1 && $a < 2) {
                    $html .= '<div>' . $row['comment_rate'] . '</div>';
                    $html .= '<div><img src="../img/image/star.svg" alt="loading..."></div>';
                } else if ($a >= 2 && $a < 3) {
                    $html .= '<div>' . $row['comment_rate'] . '</div>';
                    $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
                } else if ($a >= 3 && $a < 4) {
                    $html .= '<div>' . $row['comment_rate'] . '</div>';
                    $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
                } else if ($a >= 4 && $a < 5) {
                    $html .= '<div>' . $row['comment_rate'] . '</div>';
                    $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
                } else if ($a == 5) {
                    $html .= '<div>' . $row['comment_rate'] . '</div>';
                    $html .= '<div><img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading...">';
                    $html .= '<img src="../img/image/star.svg" alt="loading..."></div>';
                }
            }
            $html .= '
        </div>
        <div class="l_table-cell l_table">
            <div class="l_phanhoi" id="l_phanhoi' . $row['rate_id'] . '></div>
            <button class="l_btndanhgia" onclick="l_btndanhgia(' . $row['rate_id'] . ')">
                <img src="../img/image/bx_bx-edit-alt.svg" alt="loading..."> Trả lời đánh giá
            </button>
            <div class="l_hienthidanhgia" id="l_hienthidanhgia' . $row['rate_id'] . '">
                <form action="" method="">
                    <div>
                        <textarea name="" id="gui' . $row['rate_id'] . '" cols="30" rows="10" class="l_textarea"></textarea>
                    </div>
                    <div>
                        <button type="button" onclick="l_gui(' . $row['rate_id'] . ',' . $row['user_student_id'] . ',' .  $row['course_id'] . ')" class="l_gui">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
        </div>';
        }
        $mobile = '';
        foreach ($arr as $value) {
            $mobile .= '<l_center>
            <div class="v_content-mb">
                <div class="flex v_content-mb-div">
                    <p class="v_content-mb-title">Khóa học: ' . $value['course_name'] . '</p>
                </div>

                <div class="flex v_info-all v_content-mb-div">
                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã khóa học :</span>' . $value['rate_id'] . '</div>
                </div>
                <center class="v_danh-gia-center">
                    <div class="v_danh-gia">
                        <p class="v_danh-gia-title">Đánh giá:</p>';
            if ($value['course_type'] == 1) {
                $total = ($value['lesson'] + $value['teacher']) / 2;
                $a = round($total, 1);
                if ($a >= 1 && $a < 2) {
                    $mobile .= '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                } else if ($a >= 2 && $a < 3) {
                    $mobile .= '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                } else if ($a >= 3 && $a < 4) {
                    $mobile .= '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                } else if ($a >= 4 && $a < 5) {
                    $mobile .= '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                } else if ($a == 5) {
                    $mobile .= '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                }
            } else {
                $total = ($value['lesson'] + $value['teacher'] + $value['video']) / 3;
                $a = round($total, 1);
                if ($a >= 1 && $a < 2) {
                    $mobile .= '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                } else if ($a >= 2 && $a < 3) {
                    $mobile .= '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                } else if ($a >= 3 && $a < 4) {
                    $mobile .= '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                } else if ($a >= 4 && $a < 5) {
                    $mobile .= '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                } else if ($a == 5) {
                    $mobile .= '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                    $mobile .= '<p><img class="v_danh-gia-star" src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                }
            }
            $mobile .= '</div>
                </center>
                <div class="flex v_mb-ghichu-all v_content-mb-div">
                    <div class="v_mb-edit-div">
                        <!-- <button class="v_mb-edit"><img style="padding-right: 8px;" src="../img/tra-loi-danh-gia-mb.svg" alt="Ảnh lỗi">Trả lời đánh giá</button> -->
                        <div class="l_phanhoi" id="l_phanhoi1' . $value['rate_id'] . '"></div>
                        <button class="l_btndanhgia" onclick="l_btndanhgia1(' . $value['rate_id'] . ')">
                            <img src="../img/tra-loi-danh-gia-mb.svg" alt="loading..."> Trả lời đánh giá
                        </button>
                        <div class="l_hienthidanhgia" id="l_hienthidanhgia1' . $value['rate_id'] . '">
                            <form action="" method="">
                                <div>
                                    <textarea name="" id="gui1' . $value['rate_id'] . '" cols="30" rows="10" class="l_textarea"></textarea>
                                </div>
                                <div>
                                    <button type="button" onclick="l_gui1(' . $value['rate_id'] . ',' . $value['user_student_id'] . ',' . $value['course_id'] . ')" class="l_gui">Gửi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </l_center>';
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
        // echo $phantrang;
        //var_dump($arr);
    }
} else {
    $error =  'rỗng';
    $data = [
        'result' => 3,
        'message' => $error
    ];
}

echo json_encode($data);
