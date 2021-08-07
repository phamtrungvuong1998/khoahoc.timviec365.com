<?php
require_once '../includes/v_insert_TT.php';
$db_count = new db_query("SELECT course_id FROM courses Where course_type = 2 AND user_id = $user_id AND hide_course = 1");
$row1 = mysql_num_rows($db_count->result);
$total_records = $row1;
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
    <title>Danh sách khóa học online</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="../css/reset.css?v=<?=$version?>">
    <?php
    include '../includes/l_inc_head.php';
    ?>
    <link rel="stylesheet" href="../css/tt_giangday.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/v_tt-mb.css?v=<?=$version?>">
    <style>
        .l_action2{
            padding-left: 0;
            justify-content: center;
        }
        .l_content{
            white-space: nowrap;
            overflow-x: auto;
        }
        .l_curson{
            color: white;
        }
        @media(max-width: 1300px){
            .l_content{
                display: block;
            }
        }
    </style>
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

            <div class="l_chucnang">
                <div class="l_timkiem">
                    <button class="l_btn_timkiem"><img class="lazyload" src="/img/load.gif" data-src="../img/image/Search.svg" alt=""></button>
                    <input id="l_search" onchange="l_search(<? echo $user_id; ?>,<? echo $current_page ?>)" type="text" value="" class="l_input" placeholder="Nhập tìm kiếm tên môn học">
                </div>
                <div class="l_excel">
                    <a href="../code_xu_ly/l_xls_onlineGiangDay.php">
                        <button class="l_btn_excel">
                            <img src="/img/load.gif" data-src="../img/image/excel.svg" alt="" class="l_img_excel lazyload"> XUẤT EXCEL
                        </button>
                    </a>
                </div>
            </div>
            <div class="l_content">
                
                <?php
                $a = [];
                $thongbao = '';
                if ($start < 0) {
                    $thongbao = '<div class = "l_font_size">Danh sách rỗng</div>';
                } else {
                    ?>
                    <div class="l_content-title">
                    <div class="l_table-cell l_size">KHÓA HỌC</div>
                    <div class="l_table-cell l_size">MÔN HỌC</div>
                    <div class="l_table-cell l_size2">SỐ BUỔI HỌC</div>
                    <div class="l_table-cell">TÀI LIỆU</div>
                    <div class="l_table-cell">GIÁ GỐC</div>
                    <div class="l_table-cell">GIÁ KHUYẾN MÃI</div>
                    <div class="l_table-cell">NGÀY ĐĂNG</div>
                    <div class="l_table-cell">
                        <img class="lazyload" src="/img/load.gif" data-src="../img/More.svg" alt="">
                    </div>
                </div>
                    <?
                    $db_point = new db_query("SELECT * FROM courses Where user_id = '$user_id' AND course_type = 2 AND hide_course = 1 ORDER BY course_id DESC LIMIT $start , $limit");
                    while ($rowOff = mysql_fetch_array($db_point->result)) {
                        $a[] = $rowOff;
                ?>
                        <div class="l_noidungkh">
                            
                            <?php
                            $cate_id = $rowOff['cate_id'];
                            $qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
                            $rowCate = mysql_fetch_array($qrCate->result);
                            ?>
                            <div class="l_table-cell l_table-text">
                                <a href="<? echo urlDetail_courseOnline($rowOff['course_id'],$rowOff['course_slug']); ?>"><p class="p"><?php echo $rowOff['course_name']; ?></p></a>
                            </div>
                            <div class="l_table-cell">
                                <?php echo $rowCate['cate_name']; ?>
                            </div>
                            <div class="l_table-cell l_content-list"><?php 
                            if ($rowOff['time_learn'] == 0) {
                                echo 'Chưa cập nhật';
                            }else{
                                echo $rowOff['time_learn'];
                            }
                            ?></div>

                            <div class="l_table-cell"><?php
                            if ($rowOff['course_slide'] == 0) {
                                echo 'Chưa cập nhật';
                            }else{
                                echo $rowOff['course_slide'];
                            }
                            ?></div>
                            <?php
                            if ($rowOff['price_listed'] == -1) {
                                $price_listed = "Chưa cập nhật";
                            }else{
                                $price_listed = number_format($rowOff['price_listed']) . " đ";
                            }

                            if ($rowOff['price_promotional'] == -1) {
                                $price_promotional = "Chưa cập nhật";
                            }else{
                                $price_promotional = number_format($rowOff['price_promotional']) . " đ";
                            }
                            ?>
                            <div class="l_table-cell"><?php echo $price_listed; ?></div>
                            <div class="l_table-cell"><?php echo $price_promotional; ?></div>
                            <div class="l_table-cell"><?php echo date("d-m-Y", $rowOff['created_at']); ?></div>
                            <div class="l_table-cell l_curson">
                                <div onclick="l_chinhsua(<?php echo $rowOff['course_id']; ?>)">
                                    <img class="lazyload" src="/img/load.gif" data-src="../img/More.svg" alt="">
                                </div>
                                <div class="l_hienthi_chinhsua" id="l_hienthi_chinhsua<?php echo $rowOff['course_id']; ?>">
                                    <a href="/cap-nhat-khoa-hoc-online-trung-tam/id<?php echo $user_id; ?>-courseOn<?php echo $rowOff['course_id']; ?>.html">
                                        <button class="l_btn_chinhsua">
                                            <img src="/img/load.gif" data-src="../img/l_chinhsua.svg" alt="" class="l_img_chinhsua lazyload">
                                            <div class="l_chinhsuachu">
                                                Chỉnh sửa
                                            </div>
                                        </button>
                                    </a>
                                    <button class="l_xoakh" data-course="<?php echo $rowOff['course_id']; ?>" onclick="v_del_course(this)">
                                            <div class="l_chinhsuachu">
                                                Xóa khóa học
                                            </div>
                                    </button>
                                </div>
                                Vuong
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div id="thongbao" class="thongbao"><? echo $thongbao; ?></div>
            <div class="mobile">
                <center>
                    <? if (count($a) == 0) {
                        $thongbao = '<center><div class="v_content-mb l_font_size">Danh sách rỗng</div></center>';
                    } else {
                        foreach ($a as $value) {
                    ?>
                            <div class="v_content-mb">
                                <div class="flex v_content-mb-div">
                                    <p class="v_content-mb-title"><?php echo $value['course_name']; ?></p>
                                </div>

                                <div class="flex v_info-all v_content-mb-div">
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Khóa học :</span><?php echo $value['course_name']; ?></div>
                                    <?
                                    $cate_id = $value['cate_id'];
                                    $qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
                                    $rowCate = mysql_fetch_array($qrCate->result);
                                    $center_teacher_id = $value['center_teacher_id'];
                                    $qrGV = new db_query("SELECT teacher_name FROM user_center_teacher WHERE center_teacher_id = '$center_teacher_id'");
                                    $rowGV = mysql_fetch_array($qrGV->result);
                                    ?>
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học : </span><?php echo $rowCate['cate_name']; ?></div>
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số buổi học : </span> <?php echo $value['time_learn']; ?> Buổi</div>
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tài liệu : </span><?php echo $value['course_slide']; ?> file</div>
                                    <?php
                                    if ($value['price_listed'] == -1) {
                                        $price_listed = "Chưa cập nhật";
                                    }else{
                                        $price_listed = number_format($value['price_listed']) . " đ";
                                    }

                                    if ($value['price_promotional'] == -1) {
                                        $price_promotional = "Chưa cập nhật";
                                    }else{
                                        $price_promotional = number_format($value['price_promotional']) . " đ";
                                    }
                                    ?>
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Giá gốc : </span><?php echo $price_listed; ?></div>
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Giá khuyến mãi : </span><?php echo $price_promotional; ?></div>
                                </div>
                                <div class="l_action2">
                                    <button class="l_action__ghichu">
                                        <a href="/cap-nhat-khoa-hoc-online-trung-tam/id<?php echo $user_id; ?>-courseOn<?php echo $value['course_id']; ?>.html">
                                        <img src="../img/Vector_chinh_sua.svg" alt="Ảnh lỗi">
                                        <span class="l_action__ghichu--span">Chỉnh sửa </span>
                                        </a>
                                    </button>
                                    <button class="l_action__xoakh" data-course="<?php echo $value['course_id']; ?>" onclick="v_del_course(this)"><span class="l_action__xoakh--span">Xóa khóa học</span></button>
                                </div>
                            </div>
                    <?
                        }
                    }
                    ?>
                </center>
            </div>
            <div class="l_phantrang">
                <?
                if ($current_page > 1 && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-khoa-hoc-online-giang-day/id' . $user_id . '&page' . ($current_page - 1) . '.html">&lt;</a>';
                }

                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="l_phantrang_btn1">' . $i . '</span>';
                    } else {
                        echo '<a class="l_phantrang_btn" href="/trung-tam-khoa-hoc-online-giang-day/id' . $user_id . '&page' . $i . '.html">' . $i . '</a>';
                    }
                }
                if ($current_page < $total_page && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-khoa-hoc-online-giang-day/id' . $user_id . '&page' . ($current_page + 1) . '.html">&gt;</a>';
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
    function l_search(id, p) {
        // console.log(p);
        var s = $('#l_search').val();
        if (s == '') {
            if (p == 0) {
                p = 1;
                window.location.href = '/trung-tam-khoa-hoc-online-giang-day/id' + id + '&page' + p + '.html';
                return false;
            } else {
                window.location.href = '/trung-tam-khoa-hoc-online-giang-day/id' + id + '&page' + p + '.html';
                return false;
            }
        }
        $.get("../ajax/l_ajax_search_onlineGD.php", {
                search: s,
                p: p
            },
            function(data) {
                var arr = data.split("tachchuoi");
                if (arr.length == 1) {
                    $('#thongbao').html('');
                    $('.l_noidungkh').remove();
                    $('.l_excel').html('');
                    $('.v_content-mb').remove();
                    $('.l_phantrang').html('');
                    $('#thongbao').append(arr[0]);
                } else {
                    $('#thongbao').html('');
                    $('.l_noidungkh').remove();
                    $('.l_excel').html('');
                    $('.v_content-mb').remove();
                    $('.l_phantrang').html('');
                    $('.l_excel').html(arr[0]);
                    $('.l_content').append(arr[1]);
                    $('.mobile').append(arr[2]);
                    $('.l_phantrang').html(arr[3]);
                }
                // console$.log(arr.length);
            }
        );
    }

    function v_del_course(e) {
        console.log($(e)[0].dataset.course);

        var n = confirm("Bạn có muốn xóa khóa học này không");
        if (n == true) {
            $.ajax({
                url: '../ajax/v_hide_course.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    course_id: $(e)[0].dataset.course,
                    course_type: 2
                },
                success: function (data) {
                    $(".l_content").remove();
                    $(".mobile").remove();
                    $(".l_phantrang").remove();
                    if (data.result == 0) {
                        $(".l_right").append(data.html);
                    }else if (data.result == 1) {
                        $(".l_right").append(data.htmlPC);
                        $(".l_right").append(data.htmlMB);
                        $(".l_right").append(data.html_phantrang);
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại");
                }
            });
        }
    }
</script>

</html>