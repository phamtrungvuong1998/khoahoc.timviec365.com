<?php
require_once '../code_xu_ly/h_manager_GV.php';
$qrCount = new db_query("SELECT COUNT(*) FROM  discount_code WHERE user_id = $cookie_id");

$rowCount = mysql_fetch_array($qrCount->result);
$pa = $rowCount[0]/10;

$p = getValue('p','str','GET','');

$number_page = 10;

if (!isset($_GET['p']) || $p == 1) {
    $start = 0;
    $end = 10;
}else{
    $start = $number_page * ($p - 1);
    $end = $number_page  * $p;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <?php require_once '../includes/v_inc_GV_css.php'; ?>
    <script src="../js//v-main.js?v=<?=$version?>"></script>
    <style type="text/css">
    #v_ma-giam-gia {
        color: #1B6AAB;
    }

    #v_sidebar-tb-4 {
        display: block;
    }

    #v_ql-ma-gg {
        color: #1B6AAB;
    }
    #v_gv_magiamgia3 button{
        color: #1B6AAB;
    }
    #v_sidebar_tb-4{
        display: block;
    }
    #v_sidebar_tb-4 li:nth-child(2) a{
        color: #1B6AAB;
    }
    .v_popup {
        width: 160px;
        height: 52px;
        padding-bottom: 50px;
    }

    .v_btn-buy {
        background: rgba(24, 93, 160, 1);
        color: white;
        padding: 10px;
    }
    .v_popup{
        height: 56px !important;
    }
    .v_status {
        color: #FA1414;
    }
    @media(max-width: 1300px){
        #content{
            display: table;
        }
    }
    </style>
    <title>Page quản lý mã giảm giá</title>
</head>

<body>
    <div id="v_wrapper" class="flex">
        <!-- Begin: sidebar -->
        <?php require_once("../includes/inc_GV_sidebar.php"); ?>
        <!-- End: sidebar -->

        <!-- Begin: main -->
        <div id="main">
            <!-- Begin: header -->
            <?php require_once '../includes/inc_GV_manager_header.php'; ?>
            <!-- End: header -->

            <!-- Begin: content -->
            <div id="content-box" class="flex">
                <?php 
                $actions = "magiamgia";
                require_once '../includes/v_inc_GV_bo-loc.php'; ?>
                <div id="content">
                    <div id="v_content-title">
                        <div class="v_content-title-div">MÃ GIẢM GIÁ</div>
                        <div class="v_content-title-div">SỐ LƯỢNG</div>
                        <div class="v_content-title-div">SỐ TIỀN GIẢM GIÁ</div>
                        <div class="v_content-title-div">THỜI GIAN SỬ DỤNG</div>
                        <div class="v_content-title-div">TRẠNG THÁI</div>
                        <div class="v_content-title-div v_bacham"><img class="lazyload" src="/img/load.gif"
                                data-src="../img/More.png" alt="Ảnh lỗi"></div>
                    </div>

                    <div id="filter">
                        <?php 
                        $db = new db_query("SELECT * FROM discount_code WHERE user_id = $cookie_id ORDER BY code_id DESC LIMIT $start,$end");
                        while ($row = mysql_fetch_array($db->result)) {
                    ?>
                        <div class="v_noidungkh" id="v_noidungkh">
                            <div class="v_content-list v_monhoc v_trungtam"><?=$row['code_name']?></div>
                            <div class="v_content-list"><?=$row['quantity']?></div>
                            <div class="v_content-list"><?=number_format($row['discount_money'])?> đ</div>
                            <?php 
                            $timeStart1 = strtotime($row['date_start']);
                            $timeStart = date("d/m/Y",$timeStart1);
                            $timeEnd1 = strtotime($row['date_end']);
                            $timeEnd = date("d/m/Y",$timeEnd1);
                            ?>
                            <div class="v_content-list"><?=$timeStart?> - <?=$timeEnd?></div>
                            <div class="v_content-list v_status">
                            <?php
                            if ($timeStart1 > strtotime(date("d-m-Y"))) {
                                echo "Chưa đến thời gian";
                            }else if ($timeEnd1 < strtotime(date("d-m-Y"))) {
                                echo "Hết hạn";
                            }else{
                                echo "Còn hạn";
                            }
                            ?>
                            </div>
                            <div class="v_content-list v_bacham">
                                <button class="v_btn-bacham" onclick="v_bacham(<?=$row['code_id']?>)"><img
                                        class="lazyload" src="/img/load.gif" data-src="../img/More.svg"
                                        alt="Ảnh lỗi"></button>
                                <div class="v_popup" id="v_popup-<?=$row['code_id']?>">
                                    <center><a
                                            href="/giang-vien-cap-nhat-ma-giam-gia/id<?=$cookie_id?>-code<?=$row['code_id']?>.html"
                                            class="v_btn-buy"><img class="lazyload" src="/img/load.gif"
                                                data-src="../img/chinh-sua.svg" alt="Ảnh l">CHỈNH
                                            SỬA</a></center>
                                </div>
                            </div>
                        </div>
                        <?php
                        } 
                    ?>
                    </div>
                </div>

                <div id="filter2">
                <?php 
                    $db = new db_query("SELECT * FROM discount_code WHERE user_id = $cookie_id ORDER BY code_id DESC LIMIT $start,$end");
                        while ($row = mysql_fetch_array($db->result)) {
                            ?>
                    <div class="v_content-mb">
                        <div class="flex v_content-mb-div">
                            <p class="v_content-mb-title"><?=$row['code_name']?></p>
                        </div>

                        <div class="flex v_info-all v_content-mb-div">
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã giảm giá :</span>
                                <?=$row['code_id']?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số lượng
                                </span><?=$row['quantity']?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số tiền giảm giá :</span>
                                <?=number_format($row['discount_money'])?> đ</div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Thời gian sử dụng : </span><?php
                            $timeStart1 = strtotime($row['date_start']);
                            $timeStart = date("d/m/Y",$timeStart1);
                            $timeEnd1 = strtotime($row['date_end']);
                            $timeEnd = date("d/m/Y",$timeEnd1);
                            echo $timeStart . "-" . $timeEnd;
                            ?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Trạng thái :</span>
                                <?php
                                if ($timeStart1 > strtotime(date("d-m-Y"))) {
                                    echo "Chưa đến thời gian";
                                }else if ($timeEnd1 < strtotime(date("d-m-Y"))) {
                                    echo "Hết hạn";
                                }else{
                                    echo "Còn hạn";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    } 
                ?>
                </div>
                
                <div id="v_chuyentrang">
                    <a class="v_chuyen-trang-div" href="<?php if($p == 1){
                            echo '/giang-vien-quan-li-ma-giam-gia/id' . $_COOKIE['user_id'] . '-p1.html';
                        }else{
                            echo '/giang-vien-quan-li-ma-giam-gia/id' . $_COOKIE['user_id'] . '-p' . ($p-1).'.html';
                        } ?>">&lt;</a>
                    <?php for ($i = 0; $i  < $pa ; $i++) { ?>
                    <a href="/giang-vien-quan-li-ma-giam-gia/id<?php echo $_COOKIE['user_id']; ?>-p<?php echo $i  + 1; ?>.html"
                        class="v_chuyen-trang-div <?php if($p == $i+1){
                            echo "p_active";
                        } ?>" class="v_tranght"><?php echo $i + 1; ?></a>
                    <?php } ?>
                    <a href="<?php if($p == $i){
                            echo '/giang-vien-quan-li-ma-giam-gia/id' . $_COOKIE['user_id'] . '-p'. ($i) .'.html';
                        }else{
                            echo '/giang-vien-quan-li-ma-giam-gia/id' . $_COOKIE['user_id'] . '-p' . ($p+1).'.html';
                        } ?>" class="v_chuyen-trang-div">&gt;</a>
                </div>
            </div>
            <!-- End: content -->

        </div>
        <!-- End: main -->
    </div>

    <!-- Begin: foooter -->
    <?php require_once("../includes/h_inc_footer.php"); ?>
    <!-- End: footer -->
    <script src="../js/bootstrap.min.js?v=<?=$version?>"></script>
    <script src="../js/v-main.js?v=<?=$version?>"></script>
    <script>
    $(document).ready(function() {
        $("#keywords").keyup(function() {
            var cookie_id = <?=$cookie_id?>;
            var search = $(this).val();
            var type = "qlmagiamgia";
            $.ajax({
                url: "../ajax/h_ajax_filter.php",
                method: "POST",
                data: {
                    cookie_id: cookie_id,
                    search: search,
                    type: type
                },
                dataType: "text",
                success: function(data) {
                    $("#filter").html(data);
                }
            });

            var type2 = "qlmagiamgia";
            $.ajax({
                url: "../ajax/h_ajax_filter.php",
                method: "POST",
                data: {
                    cookie_id: cookie_id,
                    search: search,
                    type2: type2
                },
                dataType: "text",
                success: function(data) {
                    $("#filter2").html(data);
                }
            });
        });
    });
    </script>
</body>

</html>