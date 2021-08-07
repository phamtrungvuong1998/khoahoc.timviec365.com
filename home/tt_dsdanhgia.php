<?php
include '../includes/v_insert_TT.php';

$db_count = new db_query("SELECT count(courses.course_id)as total FROM rate_course INNER JOIN courses ON rate_course.course_id =  courses.course_id WHERE courses.user_id = '$user_id'");
$row1 = mysql_fetch_assoc($db_count->result);
$total_records = $row1['total'];
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$total_page = ceil($total_records / $limit);
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}
$start = ($current_page - 1) * $limit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <title>Danh sách đánh giá</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <?php
    include '../includes/l_inc_head.php';
    ?>
    <link rel="stylesheet" href="../css/v_tt-mb.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/tt_dsdanhgia.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/v_tt-mb.css?v=<?=$version?>">
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

            <div>

                <div class="l_chucnang">
                    <!-- <div>
                    <button class="l_btn_boloc">
                        <img src="../img/l_bo-loc.svg" alt="loading..."> Bộ lọc
                    </button>
                </div> -->
                    <div class="l_timkiem">
                        <button href="" class="l_btn_timkiem"><img class="lazyload" src="/img/load.gif" data-src="../img/l_search.svg" alt="loading..."></button>
                        <input id="l_timkiem" onchange="l_timkiem(<? echo $user_id; ?>, <? echo $current_page; ?>);" type="text" value="" class="l_input" placeholder="Nhập tìm kiếm tên môn học">
                    </div>
                    <div class="l_excel">
                        <a href="../code_xu_ly/l_xls_dsdanhgia.php">
                            <button class="l_btn_excel">
                                <img class="lazyload" src="/img/load.gif" data-src="../img/l_excel.svg" alt="loading..." class="l_img_excel"> XUẤT EXCEL
                            </button>
                        </a>
                    </div>
                </div>
                <div class="l_content">
                    <?php
                    $arr = [];
                    $thongbao = '';
                    if ($start < 0) {
                        $thongbao = '<div class = "l_font_size">Danh sách rỗng</div>';
                    } else {
                        ?>
                        <div class="l_content-title">
                            <div class="l_table-cell">MÃ KHÓA HỌC</div>
                            <div class="l_table-cell l_width">KHÓA HỌC</div>
                            <div class="l_table-cell">ĐÁNH GIÁ</div>
                            <div class="l_table-cell">PHẢN HỒI</div>
                        </div>
                        <?
                        $db_danhgia = new db_query("SELECT * FROM rate_course INNER JOIN courses ON rate_course.course_id =  courses.course_id WHERE courses.user_id = '$user_id' ORDER BY rate_id DESC LIMIT $start,$limit");
                        while ($row = mysql_fetch_assoc($db_danhgia->result)) {
                            // $db_rep = new db_query("SELECT ");
                            $arr[] = $row;
                            $rate_id = $row['rate_id'];
                    ?>
                            <div class="l_noidungkh">
                                <div class="l_table-cell l_madonhang"><? echo $row['course_id']; ?></div>
                                <?
                                if ($row['course_type'] == 1) {
                                ?>
                                    <div class="l_table-cell l_content-list"><a href="<? echo urlDetail_courseOffline($row['course_id'], $row['course_slug']); ?>">
                                            <p class="p"><? echo $row['course_name']; ?></p>
                                        </a></div>

                                <?
                                } else {
                                ?>
                                    <div class="l_table-cell l_content-list"><a href="<? echo urlDetail_courseOnline($row['course_id'], $row['course_slug']); ?>">
                                            <p class="p"><? echo $row['course_name']; ?></p>
                                        </a></div>

                                <?
                                }
                                ?>
                                <div class="l_table-cell">
                                    <?
                                    if ($row['course_type'] == 1) {
                                        $total = ($row['lesson'] + $row['teacher']) / 2;
                                        $a = round($total, 1);
                                        if ($a >= 1 && $a < 2) {
                                            echo '<div>' . $row['comment_rate'] . '</div>';
                                            echo '<div><img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading..."></div>';
                                        } else if ($a >= 2 && $a < 3) {
                                            echo '<div>' . $row['comment_rate'] . '</div>';
                                            echo '<div><img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading..."></div>';
                                        } else if ($a >= 3 && $a < 4) {
                                            echo '<div>' . $row['comment_rate'] . '</div>';
                                            echo '<div><img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading..."></div>';
                                        } else if ($a >= 4 && $a < 5) {
                                            echo '<div>' . $row['comment_rate'] . '</div>';
                                            echo '<div><img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading..."></div>';
                                        } else if ($a == 5) {
                                            echo '<div>' . $row['comment_rate'] . '</div>';
                                            echo '<div><img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading..."></div>';
                                        }
                                    } else {
                                        $total = ($row['lesson'] + $row['teacher'] + $row['video']) / 3;
                                        $a = round($total, 1);
                                        if ($a >= 1 && $a < 2) {
                                            echo '<div>' . $row['comment_rate'] . '</div>';
                                            echo '<div><img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading..."></div>';
                                        } else if ($a >= 2 && $a < 3) {
                                            echo '<div>' . $row['comment_rate'] . '</div>';
                                            echo '<div><img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading..."></div>';
                                        } else if ($a >= 3 && $a < 4) {
                                            echo '<div>' . $row['comment_rate'] . '</div>';
                                            echo '<div><img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading..."></div>';
                                        } else if ($a >= 4 && $a < 5) {
                                            echo '<div>' . $row['comment_rate'] . '</div>';
                                            echo '<div><img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading..."></div>';
                                        } else if ($a == 5) {
                                            echo '<div>' . $row['comment_rate'] . '</div>';
                                            echo '<div><img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading...">';
                                            echo '<img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="loading..."></div>';
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="l_table-cell l_table">
                                    <div class="l_phanhoi" id="l_phanhoi<?php echo $row['rate_id']; ?>"></div>
                                    <?php
                                    $qrRep = new db_query("SELECT * FROM rep_rate_course WHERE rate_id = $rate_id AND user_student_id = " . $_COOKIE['user_id']);
                                    if (mysql_num_rows($qrRep->result) == 0) {
                                    ?>
                                    <button class="l_btndanhgia l_btndanhgia<?php echo $row['rate_id'] ?>" onclick="l_btndanhgia(<?php echo $row['rate_id']; ?>)">
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/bx_bx-edit-alt.svg" alt="loading..."> Trả lời đánh giá
                                    </button>
                                    <div class="l_hienthidanhgia v_danhgia<?php echo $row['rate_id']; ?>" id="l_hienthidanhgia<?php echo $row['rate_id']; ?>">
                                        <form action="" method="">
                                            <div>
                                                <textarea name="" id="gui<?php echo $row['rate_id']; ?>" cols="30" rows="10" class="l_textarea"></textarea>
                                            </div>
                                            <div>
                                                <button type="button" onclick="l_gui(<? echo $row['rate_id']; ?>,<? echo $row['user_student_id']; ?>,<? echo $row['course_id']; ?>)" class="l_gui">Gửi</button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php
                                    }else{
                                    ?>
                                    <button class="l_btndanhgia">
                                        Đã trả lời đánh giá
                                    </button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                    <?
                        }
                    }
                    ?>
                </div>
                <div class="thongbao"> <? echo $thongbao; ?></div>
                <div class="mobile">
                    <?php
                    $j = 1;
                    foreach ($arr as $value) { ?>
                        <div class="l_center">
                            <div class="v_content-mb">
                                <div class="flex v_content-mb-div">
                                    <p class="v_content-mb-title">Khóa học: <? echo $value['course_name']; ?></p>
                                </div>

                                <div class="flex v_info-all v_content-mb-div">
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã khóa học :</span><? echo $value['rate_id'] ?></div>
                                </div>
                                <center class="v_danh-gia-center">
                                    <div class="v_danh-gia">
                                        <p class="v_danh-gia-title">Đánh giá:</p>
                                        <?
                                        if ($value['course_type'] == 1) {
                                            $total = ($value['lesson'] + $value['teacher']) / 2;
                                            $a = round($total, 1);
                                            if ($a >= 1 && $a < 2) {
                                                echo '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                            } else if ($a >= 2 && $a < 3) {
                                                echo '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                            } else if ($a >= 3 && $a < 4) {
                                                echo '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                            } else if ($a >= 4 && $a < 5) {
                                                echo '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                            } else if ($a == 5) {
                                                echo '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                            }
                                        } else {
                                            $total = ($value['lesson'] + $value['teacher'] + $value['video']) / 3;
                                            $a = round($total, 1);
                                            if ($a >= 1 && $a < 2) {
                                                echo '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                            } else if ($a >= 2 && $a < 3) {
                                                echo '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                            } else if ($a >= 3 && $a < 4) {
                                                echo '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                            } else if ($a >= 4 && $a < 5) {
                                                echo '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                            } else if ($a == 5) {
                                                echo '<p class="v_danh-gia-content">' . $value['comment_rate'] . '</p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                                echo '<p><img class="v_danh-gia-star" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg" alt="Ảnh lỗi"></p>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </center>
                                <div class="flex v_mb-ghichu-all v_content-mb-div">
                                    <div class="v_mb-edit-div">
                                        <!-- <button class="v_mb-edit"><img style="padding-right: 8px;" src="../img/tra-loi-danh-gia-mb.svg" alt="Ảnh lỗi">Trả lời đánh giá</button> -->
                                        <div class="l_phanhoi" id="l_phanhoi1<?php echo $value['rate_id']; ?>"></div>
                                        <?php
                                        $qrRep = new db_query("SELECT * FROM rep_rate_course WHERE rate_id = $rate_id AND user_student_id = " . $_COOKIE['user_id']);
                                        if (mysql_num_rows($qrRep->result) == 0) {
                                            ?>
                                        <button class="l_btndanhgia l_btndanhgia<?php echo $value['rate_id']; ?>" onclick="l_btndanhgia1(<?php echo $value['rate_id']; ?>)">
                                            <img class="lazyload" src="/img/load.gif" data-src="../img/tra-loi-danh-gia-mb.svg" alt="loading..."> Trả lời đánh giá
                                        </button>
                                        <div class="l_hienthidanhgia v_danhgia<?php echo $value['rate_id']; ?>" id="l_hienthidanhgia1<?php echo $value['rate_id']; ?>">
                                            <form action="" method="">
                                                <div>
                                                    <textarea name="" id="gui1<?php echo $value['rate_id']; ?>" cols="30" rows="10" class="l_textarea"></textarea>
                                                </div>
                                                <div>
                                                    <button type="button" onclick="l_gui1(<? echo $value['rate_id']; ?>,<? echo $value['user_student_id']; ?>,<? echo $value['course_id']; ?>)" class="l_gui">Gửi</button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php
                                        }else{
                                        ?>
                                        <button class="l_btndanhgia l_btndanhgia<?php echo $value['rate_id']; ?>">
                                            Đã trả lời đánh giá
                                        </button>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        $j++;
                    }
                    ?>
                </div>
                <div class="l_phantrang">
                    <?
                    if ($current_page > 1 && $total_page > 1) {
                        echo '<a class="l_phantrang_btn" href="/trung-tam-danh-sach-danh-gia/id' . $user_id . '&page' . ($current_page - 1) . '.html">&lt;</a>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i == $current_page) {
                            echo '<span class="l_phantrang_btn1">' . $i . '</span>';
                        } else {
                            echo '<a class="l_phantrang_btn" href="/trung-tam-danh-sach-danh-gia/id' . $user_id . '&page' . $i . '.html">' . $i . '</a>';
                        }
                    }
                    if ($current_page < $total_page && $total_page > 1) {
                        echo '<a class="l_phantrang_btn" href="/trung-tam-danh-sach-danh-gia/id' . $user_id . '&page' . ($current_page + 1) . '.html">&gt;</a>';
                    }
                    ?>
                </div>
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
    function l_gui(a, student, course) {
        var value = $('#gui' + a).val();
        console.log(value);
        var data = new FormData();
        data.append('id', a);
        data.append('student', student);
        data.append('course', course);
        data.append('value', value);
        $.ajax({
            url: "../ajax/l_ajax_comment.php",
            type: "post",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.result == true) {
                    // $('#l_phanhoi' + a).append(response.message);
                    document.getElementById('l_hienthidanhgia' + a).style.display = 'none';
                    $(".v_danhgia" + a).remove();
                    $(".l_btndanhgia" + a).text("Đã trả lời đánh giá");
                    //console.log(response.message)
                    //alert(response.message);
                    // window.location.href = 'tt_dsgiangvien.php?page=' + response.pagenew;
                } else {
                    $('#l_phanhoi' + a).append(response.message);
                    document.getElementById('l_hienthidanhgia' + a).style.display = 'none';
                }
            },
        });
    }

    function l_gui1(a, student, course) {
        var value = $('#gui1' + a).val();
        console.log(value);
        var data = new FormData();
        data.append('id', a);
        data.append('student', student);
        data.append('course', course);
        data.append('value', value);
        $.ajax({
            url: "../ajax/l_ajax_comment.php",
            type: "post",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.result == true) {
                    $(".v_danhgia" + a).remove();
                    $(".l_btndanhgia" + a).text("Đã trả lời đánh giá");
                    document.getElementById('l_hienthidanhgia1' + a).style.display = 'none';
                } else {
                    $('#l_phanhoi1' + a).append(response.message);
                    document.getElementById('l_hienthidanhgia1' + a).style.display = 'none';
                }
            },
        });
    }

    function l_timkiem(id, p) {
        var s = $('#l_timkiem').val();
        if (s == '') {
            if (p == 0) {
                p = 1;
                window.location.href = '/trung-tam-danh-sach-danh-gia/id' + id + '&page' + p + '.html';
                return false;
            } else {
                window.location.href = '/trung-tam-danh-sach-danh-gia/id' + id + '&page' + p + '.html';
                return false;
            }
        }
        $.ajax({
            url: '../ajax/l_ajax_search_DSdanhgia.php',
            type: 'GET',
            dataType: 'json',
            data: {
                search: s,
                page: p
            },
            success: function(response) {
                if (response.result == 2) {
                    $('.thongbao').html('');
                    $('.l_noidungkh').remove();
                    $('.mobile').html('');
                    $('.l_phantrang').html('');
                    $('.l_excel').html('');

                    $('.l_content').append(response.pc);
                    $('.mobile').append(response.mobile);
                    $('.l_phantrang').html(response.phantrang);
                    $('.l_excel').html(response.excel);
                    // console.log(response.excel);
                } else {
                    $('.thongbao').html('');
                    $('.l_noidungkh').remove();
                    $('.mobile').html('');
                    $('.l_phantrang').html('');
                    $('.thongbao').html(response.message);
                }
            },
        });
    }
</script>

</html>