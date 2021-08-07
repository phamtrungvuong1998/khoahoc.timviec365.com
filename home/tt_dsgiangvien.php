<?
include '../includes/v_insert_TT.php';

$db_count = new db_query("SELECT count(center_teacher_id) as total FROM user_center_teacher WHERE user_id = " . $user_id);
$row1 = mysql_fetch_assoc($db_count->result);
$total_records = $row1['total'];
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 6;
$total_page = ceil($total_records / $limit);
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}
$start = ($current_page - 1) * $limit;
// while($row = mysql_fetch_assoc($center_teacher->result)){
//     echo "<pre>";
//     print_r($row);
//     echo "</pre>";
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <title>Danh sách giảng viên</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <?php
    include '../includes/l_inc_head.php';
    ?>
    <link rel="stylesheet" href="../css/tt_dsgiangvien.css?v=<?=$version?>">
    <!-- <style>
    .alert-success {
        position: fixed;
        width: 20%;
        top: 20px;
        right: 1%;
        z-index: 1;
        background: #dff0d8;
        color: #3c763d;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }
    </style> -->
</head>

<body>
    <div class="l_container">
        <!-- sidebar -->
        <?php
        include '../includes/l_inc_sidebar.php';
        ?>
        <!-- end: sidebar -->
        <div class="l_right">
            <!-- header -->
            <?php
            include '../includes/l_inc_header.php';
            ?>
            <!-- end header -->

            <!-- content -->
            <div class="l_dsGiangVien">
                <div class="l_gachngang"></div>
                DANH SÁCH GIẢNG VIÊN CỦA TRUNG TÂM
            </div>
            <div class="l_button2">
                <a href="/trung-tam-them-giang-vien/id<? echo $user_id ?>.html">
                    <button class="l_btn_themgiangvien">
                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/plus.svg" alt="">
                        THÊM GIẢNG VIÊN
                    </button>
                </a>
            </div>
            <div id="alert"></div>
            <div class="l_content">
                <?
                if ($start < 0) {
                    echo '<div class = "l_font_size">Danh sách rỗng</div>';
                } else {
                    $center_teacher = new db_query("SELECT * FROM user_center_teacher WHERE user_center_teacher.user_id = $user_id ORDER BY user_center_teacher.center_teacher_id DESC LIMIT $start , $limit");
                    while ($row = mysql_fetch_assoc($center_teacher->result)) {
                        $a = explode(',', $row['cate_id']);
                ?>
                <div class="l_content_item" id="l_content_item<? echo $row['center_teacher_id'] ?>">
                    <div class="l_item_img">
                        <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="l_img lazyload"
                            src="/img/load.gif" data-src="<? echo '../img/avatar/' . $row['teacher_avatar']; ?>"
                            alt="avatar">
                    </div>
                    <div class="l_item_name">
                        <? echo $row['teacher_name'] ?>
                    </div>
                    <div class="l_monhoc">
                        <div class="l_monhoc_img">
                            <img class="lazyload" src="/img/load.gif" data-src="../img/l_mon-hoc-giang-day.svg"
                                alt="icon">
                        </div>
                        <div class="l_tenmonhoc l_thugon ">
                            Môn học giảng dạy :
                            <?
                                    $i = 1;
                                    foreach ($a as $value) {
                                        $db_cate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$value' ");
                                        while ($cate = mysql_fetch_assoc($db_cate->result)) {
                                            echo $cate['cate_name'];
                                            if ($i == count($a)) {
                                                echo '';
                                            } else if ($i == count($a) - 1) {
                                                echo ', ';
                                            } else if ($i != count($a) + 1) {
                                                echo ', ';
                                            }
                                            $i++;
                                        }
                                    }
                                    ?>
                        </div>
                    </div>
                    <div class="l_monhoc">
                        <div class="l_monhoc_img">
                            <img class="lazyload" src="/img/load.gif" data-src="../img/l_lich-giang-day.svg" alt="icon">
                        </div>
                        <div class="l_tenmonhoc">
                            <? echo date('d-m-Y', $row['date_join']);
                                    ?>
                        </div>
                    </div>
                    <div class="l_monhoc">
                        <div class="l_monhoc_img">
                            <img class="lazyload" src="/img/load.gif" data-src="../img/l_bang-cap.svg" alt="icon">
                        </div>
                        <div class="l_tenmonhoc">
                            <? echo $row['qualification'] ?>
                        </div>
                    </div>
                    <div class="l_monhoc">
                        <div class="l_danhgia">
                            <?
                                    $id = $row['center_teacher_id'];
                                    // echo $id;
                                    $db_star = new db_query("SELECT * FROM rate_course INNER JOIN courses ON rate_course.course_id = courses.course_id WHERE courses.center_teacher_id = '$id'");

                                    $dem = (int) 0;
                                    $tong = (int) 0;
                                    while ($row_rate = mysql_fetch_assoc($db_star->result)) {
                                        $b = $row_rate['teacher'];
                                        $tong += $b;
                                        $dem++;
                                    }
                                    $total = 0;
                                    if ($dem > 1) {
                                        $a = (int) $tong / $dem;
                                        $total = round($a, 1);
                                    } else {
                                        $total = round($tong, 1);
                                    }
                                    // echo $total;
                                    if ($total >= 0 && $total < 1) {
                                        echo '<div class="l_star">Chưa có đánh giá</div>';
                                        echo '<div class="l_star l_margin">0 (0)</div>';
                                    } else if ($total >= 1 && $total < 2) {
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star l_margin">' . $total . ' (' . $dem . ')</div>';
                                    } else if ($total >= 2 && $total < 3) {
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star l_margin">' . $total . ' (' . $dem . ')</div>';
                                    } else if ($total >= 3 && $total < 4) {
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star l_margin">' . $total . ' (' . $dem . ')</div>';
                                    } else if ($total >= 4 && $total < 5) {
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star l_margin">' . $total . ' (' . $dem . ')</div>';
                                    } else if ($total == 5) {
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                        echo '<div class="l_star l_margin">' . $total . ' (' . $dem . ')</div>';
                                    }
                                    //echo $dem;

                                    ?>
                            <!-- <p>5.0 </p>
                                    <p> (353)</p> -->
                        </div>
                    </div>
                    <div class="l_sukien">
                        <div class="l_xemthem">
                            <a class="l_xemthem_a"
                                href="/trung-tam-cap-nhat-giang-vien-GV<? echo $row['center_teacher_id'] ?>/id<? echo $row['user_id'] ?>.html">CHỈNH
                                SỬA</a>
                        </div>
                        <div class="l_btn_item">
                            <button onclick="l_index_popup(<? echo $row['center_teacher_id'] ?>)"
                                class="l_btnXoa">XÓA</button>
                        </div>
                    </div>
                    <!-- Modal content -->
                    <div id="l_myModal<? echo $row['center_teacher_id'] ?>" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span onclick="l_close_popup(<? echo $row['center_teacher_id'] ?>);"
                                    class="close">&times;</span>
                                <h2>Thông báo</h2>
                            </div>
                            <div class="modal-body">
                                <p>Bạn có muốn xóa giảng viên khỏi trung tâm không ?</p>
                            </div>
                            <div class="modal-footer">
                                <div class="l_text_popup">
                                    <button
                                        onclick="l_delete(<? echo $row['center_teacher_id'] ?>,<? echo $total_records; ?>,<? echo $limit; ?>,<? echo $current_page; ?>)"
                                        class="l_btn_popup">Đồng ý</button>
                                    <button onclick="l_close_popup(<? echo $row['center_teacher_id'] ?>);" id="l_cancel"
                                        class="l_btn_popup l_color">Quay lại</button>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?
                    }
                }
                ?>
            </div>
            <div class="l_phantrang">
                <?
                if ($current_page > 1 && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-danh-sach-giang-vien/id' . $user_id . '&page' . ($current_page - 1) . '.html">&lt;</a>';
                }

                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="l_phantrang_btn1">' . $i . '</span>';
                    } else {
                        echo '<a class="l_phantrang_btn" href="/trung-tam-danh-sach-giang-vien/id' . $user_id . '&page' . $i . '.html">' . $i . '</a>';
                    }
                }
                if ($current_page < $total_page && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-danh-sach-giang-vien/id' . $user_id . '&page' . ($current_page + 1) . '.html">&gt;</a>';
                }
                ?>
            </div>
            <!-- end content -->
        </div>
    </div>
    <!-- FOOTER -->
    <?php
    include '../includes/h_inc_footer.php';
    ?>
    <!-- END: FOOTER -->
</body>
<script src="../js/l_trungtam.js?v=<?=$version?>"></script>
<script>
function l_delete(a, nums, limit, page) {
    // var kq = confirm('Bạn có muốn xóa giảng viên khỏi trung tâm không ?');
    // if (kq == true) {
    var data = new FormData();
    data.append('id', a);
    data.append('nums', nums);
    data.append('limit', limit);
    data.append('page', page);
    $.ajax({
        url: "../ajax/l_ajax_xoagiangvien.php",
        type: "post",
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.result == true) {
                //alert(response.message);
                //$('#l_content_item'+a).remove();
                window.location.href = '/trung-tam-danh-sach-giang-vien/id<? echo $user_id ?>&page' +
                    response.pagenew + '.html';
                // $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                // setTimeout(function() {
                //     $(".alert-success").fadeOut(1000, function() {
                //         $(".alert-success").remove();
                //     });
                // }, 3500);
            } else {
                alert(response.message)
            }
        },
    });
    // }
}

function l_index_popup(a) {
    document.getElementById("l_myModal" + a).style.display = "block";
}

function l_close_popup(a) {
    document.getElementById("l_myModal" + a).style.display = "none";
}
// window.onclick = function(event) {
//     if (event.target == document.getElementById("l_myModal")) {
//         document.getElementById("l_myModal").style.display = "none";
//     }
// }
</script>

</html>