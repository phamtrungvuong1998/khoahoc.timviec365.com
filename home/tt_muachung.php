<?php
include '../includes/v_insert_TT.php';
$db_count = new db_query("SELECT COUNT(*) FROM order_common JOIN courses ON courses.course_id = order_common.course_id  WHERE courses.user_id = $user_id");
$row1 = mysql_fetch_assoc($db_count->result);
$total_records = $row1['COUNT(*)'];
// echo $total_records;
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
    <title>Khóa học mua chung chờ</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <?php
    include '../includes/l_inc_head.php';
    ?>
    <link rel="stylesheet" href="../css/tt_muachung.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/v_tt-mb.css?v=<?=$version?>">
    <style>
        .l_center{
            text-align: left;
        }
        .l_madonhang{
            width: auto;
        }
        .l_center{
            cursor: pointer;
            position: relative;
        }
        .l_center:hover .v_info_hv{
            display: block;
        }
        .v_info_hv{
            display: none;
            right: 3px;
            position: absolute;
            background: white;
            box-shadow: 0px 4px 5px rgb(0 0 0 / 14%), 0px 1px 10px rgb(0 0 0 / 12%), 0px 2px 4px rgb(0 0 0 / 20%);
            z-index: 2;
            width: 200px;
        }
        .v_info_hv a{
            display: block;
            text-align: center;
        }
        @media(max-width: 1300px){
            .l_size{
                width: auto;
            }
            .l_content{
                width: 95%;
                margin: 2.5% auto;
            }
        }
        @media(max-width: 767px){
            .v_content-mb-thongtin{
                position: relative;
            }
            .v_info_hv{
                right: auto;
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
                <!-- <div>
                    <button class="l_btn_boloc">
                        <img src="../img/l_bo-loc.svg" alt="loading..."> Bộ lọc
                    </button>
                </div> -->
                <div class="l_timkiem">
                    <button href="" class="l_btn_timkiem"><img class="lazyload" src="/img/load.gif" data-src="../img/l_search.svg" alt="loading..."></button>
                    <input onchange="l_timkiem(<? echo $user_id; ?>, <? echo $current_page; ?>);" id="l_timkiem" type="text" value="" class="l_input" placeholder="Nhập tìm kiếm tên môn học">
                </div>
                <div class="l_excel">
                    <a href="../code_xu_ly/l_xls_muachung.php">
                        <button class="l_btn_excel">
                            <img src="/img/load.gif" data-src="../img/l_excel.svg" alt="loading..." class="l_img_excel lazyload"> XUẤT EXCEL
                        </button>
                    </a>
                </div>
            </div>

            <div class="l_content">
                <?
                $arr = [];
                $thongbao = '';
                if ($start < 0) {
                    $thongbao = '<div class = "l_font_size">Danh sách rỗng</div>';
                } else {
                    ?>
                    <div class="l_content-title">
                        <div class="l_table-cell">MÃ ĐƠN HÀNG</div>
                        <div class="l_table-cell l_size1">KHÓA HỌC</div>
                        <div class="l_table-cell">HỌC PHÍ</div>
                        <div class="l_table-cell l_center">ĐẶT CỌC</div>
                        <div class="l_table-cell l_size">HỌC VIÊN ĐĂNG KÝ</div>
                    </div>
                    <?
                    $db_common = new db_query("SELECT * FROM order_common INNER JOIN courses ON courses.course_id = order_common.course_id WHERE courses.user_id = '$user_id' ORDER BY common_id DESC LIMIT $start,$limit");
                    while ($row = mysql_fetch_assoc($db_common->result)) {
                        $common_id = $row['common_id'];
                        $arr[] = $row;
                ?>
                        <div class="l_noidungkh">
                            <div class="l_table-cell l_madonhang">
                                <? echo $row['common_id']; ?>
                            </div>
                            <?
                            if ($row['course_type'] == 1) {
                                ?>
                                <div class="l_table-cell"><a href="<? echo urlDetail_courseOffline($row['course_id'],$row['course_slug']); ?>"><p class="p"><? echo $row['course_name'] ?></p></a></div>
                                <?
                            }else {
                                ?>
                                <div class="l_table-cell"><a href="<? echo urlDetail_courseOnline($row['course_id'],$row['course_slug']); ?>"><p class="p"><? echo $row['course_name'] ?></p></a></div>
                                
                                <?
                            }
                            
                            ?>
                            <div class="l_table-cell">
                                <?
                                if ($row['price_promotional'] == -1) {
                                    echo number_format($row['price_listed']) . " đ";
                                }else{
                                    echo number_format($row['price_promotional']) . " đ";
                                }
                                ?>
                            </div>
                            <div class="l_table-cell l_center"><? echo number_format($row['price_discount']) . ' đ'; ?></div>

                            <div class="l_table-cell l_center">
                                <? echo $row['numbers'] . '/' . $row['quantity_std'] ?>
                                <div class="v_info_hv">
                                    <?php
                                    $qr2 = new db_query("SELECT * FROM order_student_common INNER JOIN users ON order_student_common.user_student_id = users.user_id WHERE common_id = $common_id");
                                    while($row2 = mysql_fetch_array($qr2->result)){ 
                                    ?>
                                    <a href="<?php echo urlDetail_student($row2['user_id'],$row2['user_slug']); ?>"><?php echo $row2['user_name']; ?></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                <?
                    }
                }
                ?>
            </div>
            <div class="thongbao"><? echo $thongbao; ?></div>
            <div class="mobile">
                <?php
                foreach ($arr as $value) { ?>
                    <center>
                        <div class="v_content-mb">
                            <div class="flex v_content-mb-div">
                                <p class="v_content-mb-title"><? echo $value['course_name']; ?></p>
                            </div>

                            <div class="flex v_info-all v_content-mb-div">
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã đơn hàng: </span><? echo $value['common_id']; ?></div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Học phí: </span>
                                    <?php
                                    if ($row['price_promotional'] == -1) {
                                        echo number_format($value['price_listed']) . " đ";
                                    }else{
                                        echo number_format($value['price_promotional']) . " đ";
                                    }
                                    ?>
                                </div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Đặt cọc: </span><? echo format_number($value['price_discount']); ?> đ</div>
                                <div class="v_content-mb-thongtin" onclick="v_hv_common1(this)">
                                    <span class="v_content-mb-span">Học viên chờ :</span>
                                    <? echo $value['numbers'] . '/' . $value['quantity_std'] ?>
                                    <div class="v_info_hv">
                                    <?php 
                                    $qr2 = new db_query("SELECT * FROM order_student_common INNER JOIN users ON order_student_common.user_student_id = users.user_id WHERE common_id = " . $value['common_id']);
                                    while($row2 = mysql_fetch_array($qr2->result)){ 
                                    ?>
                                    <a href="<?php echo urlDetail_student($row2['user_id'],$row2['user_slug']); ?>"><?php echo $row2['user_name']; ?></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </center>
                <?php } ?>
            </div>
            <div class="l_phantrang">
                <?
                if ($current_page > 1 && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-khoa-hoc-mua-chung/id' . $user_id . '&page' . ($current_page - 1) . '.html">&lt;</a>';
                }

                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="l_phantrang_btn1">' . $i . '</span>';
                    } else {
                        echo '<a class="l_phantrang_btn" href="/trung-tam-khoa-hoc-mua-chung/id' . $user_id . '&page' . $i . '.html">' . $i . '</a>';
                    }
                }
                if ($current_page < $total_page && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-khoa-hoc-mua-chung/id' . $user_id . '&page' . ($current_page + 1) . '.html">&gt;</a>';
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
    function v_hv_common1(e) {
        $(e).find('.v_info_hv').toggle();
    }
    function l_timkiem(id, p) {
        var s = $('#l_timkiem').val();
        if (s == '') {
            if (p == 0) {
                p = 1;
                window.location.href = '/trung-tam-khoa-hoc-mua-chung/id' + id + '&page' + p + '.html';
                return false;
            } else {
                window.location.href = '/trung-tam-khoa-hoc-mua-chung/id' + id + '&page' + p + '.html';
                return false;
            }
        }
        $.ajax({
            url: '../ajax/l_ajax_search_muachung.php',
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
                    console.log(response.excel);
                } else {
                    $('.thongbao').html('');
                    $('.l_excel').html('');
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