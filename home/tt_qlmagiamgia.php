<?
include '../includes/v_insert_TT.php';
$id = $_COOKIE['user_id'];

$db_count = new db_query("SELECT count(code_id) as total FROM discount_code WHERE user_id = '$id'");
// die();
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
    <title>Quản lý mã giảm giá</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <?php
    include '../includes/l_inc_head.php';
    ?>
    <link rel="stylesheet" href="../css/tt_qlmagiamgia.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/v_tt-mb.css?v=<?=$version?>">
    <style>
        .l_header {
            margin-bottom: 37px;
        }
        .v_chinhsua{
            height: 35px;
            display: block;
            background: #1B6AAB;
            border-radius: 16px;
            color: white;
            padding-top: 4px;
            width: 100px;
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
            <div class="l_qlmgg">
                <div class="l_hr"></div>
                DANH SÁCH MÃ GIẢM GIÁ
            </div>
            <div class="l_content">
                <div class="l_none l_content">
                    <?
                    $a = [];
                    $thongbao = '';
                    if ($start < 0) {
                        $thongbao = '<div class = "l_font_size">Danh sách rỗng</div>';
                    } else {
                        ?>
                        <div class="l_content-title">
                            <div class="l_table-cell">MÃ GIẢM GIÁ</div>
                            <div class="l_table-cell l_size1">SỐ LƯỢNG</div>
                            <div class="l_table-cell">SỐ TIỀN GIẢM GIÁ</div>
                            <div class="l_table-cell l_center">THỜI GIAN SỬ DỤNG</div>
                            <div class="l_table-cell">TRANG THÁI</div>
                            <div class="l_table-celll l_trangthai"><img class="lazyload" src="/img/load.gif" data-src="../img/image/More.svg" alt="loading..."></div>
                        </div>
                        <?
                        $db_discount = new db_query("SELECT * FROM discount_code WHERE user_id = $id ORDER BY code_id DESC LIMIT $start , $limit");
                        while ($discount = mysql_fetch_assoc($db_discount->result)) {
                            $a[] = $discount;
                    ?>
                            <div class="l_noidungkh">
                                <div class="l_table-cell l_ma">
                                    <? echo $discount['code_name']; ?>
                                </div>
                                <div class="l_table-cell"><? echo $discount['quantity']; ?>
                                </div>
                                <div class="l_table-cell">
                                    <? echo format_number($discount['discount_money']) . " ₫"; ?>
                                </div>
                                <div class="l_table-cell "><? echo $discount['date_start']; ?> / <? echo $discount['date_end']; ?></div>

                                <div class="l_table-cell ">
                                    <?
                                    $date = date('Y-m-d');
                                    if ($discount['date_start'] > $date) {
                                        echo "<p class= 'l_csd'>Chưa sử dụng</p>";
                                    }else if ($discount['date_end'] >= $date && $date >= $discount['date_start']) {
                                        echo "<p class= 'l_sd'>Sử dụng</p>";
                                    } else {
                                        echo "<p class= 'l_han'>Hết hạn</p>";
                                    }
                                    ?>
                                </div>
                                <div class="l_table-celll l_trangthai">
                                    <div onclick="l_chinhsua(<?php echo $discount['code_id']; ?>)">
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/More.svg" alt="">
                                    </div>
                                    <div class="l_hienthi_chinhsua" id="l_hienthi_chinhsua<?php echo $discount['code_id']; ?>">
                                        <a href="/trung-tam-cap-nhat-ma-giam-gia<? echo $discount['code_id']; ?>/id<? echo $user_id; ?>.html">
                                            <button class="l_btn_chinhsua">
                                                <img src="/img/load.gif" data-src="../img/l_chinhsua.svg" alt="" class="l_img_chinhsua lazyload">
                                                <div class="l_chinhsuachu">
                                                    Chỉnh sửa
                                                </div>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    <?
                        }
                    }
                    ?>
                </div>

            </div>
            <div id="thongbao"><? echo $thongbao; ?></div>
            <?php foreach ($a as $value) { ?>
                <center id="content-mb-center">
                    <div class="v_content-mb">
                        <!-- <div class="flex v_content-mb-div">
                                <p class="v_content-mb-title">Học SASS và cắt web từ file thiết kế Photoshop theo kiểu SASS...</p>
                            </div> -->

                        <div class="flex v_info-all v_content-mb-div">
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã giảm giá : </span><? echo $value['code_name']; ?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số lượng : </span><? echo $value['quantity']; ?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số tiền giảm : </span><? echo format_number($value['discount_money']) . " ₫"; ?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Thời gian sử dụng : </span><? echo $value['date_start']; ?> - <? echo $value['date_end']; ?></div>
                            <div class="v_content-mb-thongtin">
                                <span class="v_content-mb-span">Trạng thái :</span> <span class="l_hethan">
                                    <?
                                    if ($value['code_status'] == 0) {
                                        echo "<span class= 'l_sudung'>Sử dụng</span>";
                                    } else {
                                        echo "<span class= 'l_hethan'>Hết hạn</span>";
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                        <a class="v_chinhsua" href="/trung-tam-cap-nhat-ma-giam-gia<? echo $value['code_id']; ?>/id<? echo $user_id; ?>.html">Chỉnh sửa</a>
                    </div>
                </center>
            <?php } ?>
            <div class="l_phantrang">
                <?
                if ($current_page > 1 && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-quan-li-ma-giam-gia/id' . $user_id . '&page' . ($current_page - 1) . '.html">&lt;</a>';
                }
                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="l_phantrang_btn1">' . $i . '</span>';
                    } else {
                        echo '<a class="l_phantrang_btn" href="/trung-tam-quan-li-ma-giam-gia/id' . $user_id . '&page' . $i . '.html">' . $i . '</a>';
                    }
                }
                if ($current_page < $total_page && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-quan-li-ma-giam-gia/id' . $user_id . '&page' . ($current_page + 1) . '.html">&gt;</a>';
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

</html>