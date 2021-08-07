<?php
require_once '../code_xu_ly/h_manager_GV.php';
$qrCount = new db_query("SELECT COUNT(*) FROM  orders JOIN users ON users.user_id = orders.user_student_id JOIN courses ON courses.course_id = orders.course_id WHERE courses.user_id = $cookie_id AND orders.course_type = 2");

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
    #v_ql-kh {
        color: #1B6AAB;
    }

    #v_sidebar-tb-2 {
        display: block;
    }

    #v_kh-da-ban {
        color: #1B6AAB;
    }
    .v_sidebar-menu:nth-child(3) button{
        color: #1B6AAB;
    }
    #v_sidebar_tb-2{
        display: block;
    }
    #v_sidebar_tb-2 li:nth-child(3) a{
        color: #1B6AAB;
    }
    .v_popup {
        width: 160px;
        height: 52px;
        padding-bottom: 50px;
    }

    .v_btn-buy {
        width: 139px;
        height: 36px;
    }

    .v_name-hv {
        font-size: 14px;
        color: #000000B2;
    }

    .v_contact-hv {
        font-size: 14px;
        color: #1B6AAB;
    }
    .v_maDH{
        width: 10%;
    }
    .v_kh1{
        width: 20%;
    }
    </style>
    <title>Khóa học online đã bán</title>
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
                if ($rowCount[0] == 0) {
                    echo '<div class="emptys">Chưa có dữ liệu</div>';
                }else{
                $actions = 'khdaban';
                require_once '../includes/v_inc_GV_bo-loc.php'; ?>

                <div id="content">
                    <div>
                        <div id="v_content-title">
                            <div class="v_content-title-div">MÃ ĐƠN HÀNG</div>
                            <div class="v_content-title-div">KHÓA HỌC</div>
                            <div class="v_content-title-div">TÊN HỌC VIÊN</div>
                            <div class="v_content-title-div">NGÀY GIAO DỊCH</div>
                            <div class="v_content-title-div">GIÁ GỐC</div>
                            <div class="v_content-title-div">GIÁ KHUYẾN MẠI</div>
                        </div>
                        <div id="filter">
                            <?
                            $qr1 = new db_query("SELECT *,users.user_id,users.user_slug FROM orders JOIN users ON users.user_id = orders.user_student_id JOIN courses ON courses.course_id = orders.course_id WHERE courses.user_id = $cookie_id AND orders.course_type = 2 LIMIT $start,$end");
                            if (mysql_num_rows($qr1->result)==0) {
                                    echo '<div >Chưa có dữ liệu</div>';
                                }else{
                                    while ($row1 = mysql_fetch_array($qr1->result)) {
                                        ?>
                            <div class="v_noidungkh" id="v_noidungkh-">
                                <div class="v_content-list v_maDH"><?=$row1['order_id']?></div>
                                <div class="v_content-list v_kh1"><a href="<?php echo urlDetail_courseOnline($row1['course_id'],$row1['course_slug']); ?>" class="v_kh"><?=$row1['course_name']?></a></div>
                                <div class="v_content-list v_trungtam">
                                    <a class="v_name-hv" href="<?php echo urlDetail_student($row1['user_id'],$row1['user_slug']); ?>"><?=$row1['user_name']?></a>
                                </div>
                                <div class="v_content-list"><?=date("d-m-Y", $row1['day_buy'])?></div>
                                <div class="v_content-list">
                                    <?php
                                    if ($row1['price_listed'] == -1) {
                                        echo "Chưa cập nhật";
                                    }else {
                                        echo number_format($row1['price_listed']) . " đ";
                                    }
                                    ?>
                                </div>
                                <div class="v_content-list"><?php
                                if ($row1['price_promotional'] == -1) {
                                    echo "Chưa cập nhật";
                                }else{
                                    echo number_format($row1['price_promotional']) . " đ";
                                }
                                ?></div>
                            </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div id="filter2">
                    <?php 
                            $qr2 = new db_query("SELECT * FROM orders JOIN users ON users.user_id = orders.user_student_id JOIN courses ON courses.course_id = orders.course_id 
                                JOIN categories ON categories.cate_id = courses.cate_id WHERE courses.user_id = $cookie_id AND orders.course_type = 2 LIMIT $start,$end");
                            while($row2 = mysql_fetch_array($qr2->result)){ 
                                ?>
                    <div class="v_content-mb">
                        <div class="flex v_content-mb-div">
                            <p class="v_content-mb-title"><?=$row2['course_name']?>
                            </p>
                        </div>

                        <div class="flex v_info-all v_content-mb-div">
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã đơn hàng :</span>
                                <?=$row2['order_id']?>
                            </div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học :</span>
                                <?=$row2['cate_name']?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tên học viên :</span>
                                <?=$row2['user_name']?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ngày giao dịch : </span><?=date("d-m-Y", $row2['day_buy'])?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Giá gốc :</span>
                            	<?php
                            	if ($row2['price_listed'] == -1) {
                            		echo "Chưa cập nhật";
                            	}else{
                            		echo number_format($row2['price_listed']) . " đ";
                            	}
                            	?>
                            </div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Giá khuyến mại :</span>
                            	<?php
                            	if ($row2['price_promotional'] == -1) {
                            		echo "Chưa cập nhật";
                            	}else{
                            		echo number_format($row2['price_promotional']) . " đ";
                            	}
                            	?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div id="v_chuyentrang">
                    <a class="v_chuyen-trang-div" href="<?php if($p == 1){
                        echo '/giang-vien-khoa-hoc-online-da-ban/id' . $_COOKIE['user_id'] . '-p1.html';
                        }else{
                            echo '/giang-vien-khoa-hoc-online-da-ban/id' . $_COOKIE['user_id'] . '-p' . ($p-1).'.html';
                        } ?>">&lt;</a>
                    <?php for ($i = 0; $i  < $pa ; $i++) { ?>
                    <a href="/giang-vien-khoa-hoc-online-da-ban/id<?php echo $_COOKIE['user_id']; ?>-p<?php echo $i  + 1; ?>.html"
                        class="v_chuyen-trang-div <?php if($p == $i+1){
                                    echo "p_active";
                                } ?>" class="v_tranght"><?php echo $i + 1; ?></a>
                    <?php } ?>
                    <a href="<?php if($p == $i){
                                echo '/giang-vien-khoa-hoc-online-da-ban/id' . $_COOKIE['user_id'] . '-p'. ($i) .'.html';
                                }else{
                                    echo '/giang-vien-khoa-hoc-online-da-ban/id' . $_COOKIE['user_id'] . '-p' . ($p+1).'.html';
                                } ?>" class="v_chuyen-trang-div">&gt;</a>
                </div>
                <?php
                }
                ?>
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
            var type = "khdaban";
            $.ajax({
                url: "../ajax/h_ajax_filter.php",
                method: "POST",
                data: {
                    cookie_id: cookie_id,
                    search: search,
                    type: type,
                    course_type: 2
                },
                dataType: "text",
                success: function(data) {
                    if (data == "Không tìm thấy bản ghi") {
                        $("#v_content-title").css({
                            display: 'table',
                            width: '100%'
                        });
                    }else{
                        $("#v_content-title").css({
                            display: 'table-row',
                            width: '100%'
                        });
                    }
                    $("#filter").html(data);
                }
            });

            var type2 = "khdaban";
            $.ajax({
                url: "../ajax/h_ajax_filter.php",
                method: "POST",
                data: {
                    cookie_id: cookie_id,
                    search: search,
                    type2: type2,
                    course_type: 2
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