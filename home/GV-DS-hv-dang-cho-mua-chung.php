<?php
require_once '../code_xu_ly/h_manager_GV.php';
$qrCount = new db_query("SELECT COUNT(*) FROM order_common JOIN courses ON courses.course_id = order_common.course_id  WHERE courses.user_id = $cookie_id");

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
    <link rel="stylesheet" href="../css/dskhoahocdamuaonline.css?v=<?=$version?>">
    <script src="../../js//v-main.js?v=<?=$version?>"></script>
    <style>
        #v_ql-kh {
            color: #1B6AAB;
        }
        .v_trungtam:hover .v_hv-dk{
            display: block;
        }
        #v_sidebar-tb-2 {
            display: block;
        }

        #v_hv-cho-mua-chung {
            color: #1B6AAB;
        }
        .v_sidebar-menu:nth-child(3) button{
            color: #1B6AAB;
        }
        #v_sidebar_tb-2{
            display: block;
        }
        #v_sidebar_tb-2 li:nth-child(6) a{
            color: #1B6AAB;
        }
        .v_monhoc {
            font-weight: 700;
            font-size: 14px;
            color: rgba(0, 0, 0, 0.87);
        }

        .v_trungtam {
            cursor: pointer;
            position: relative;
        }

        .v_trungtam-1 {
            display: none;
        }

        .v_hv-dk {
            position: absolute;
            z-index: 2;
            background: white;
            box-shadow: 0px 4px 5px rgba(0, 0, 0, 0.14), 0px 1px 10px rgba(0, 0, 0, 0.12), 0px 2px 4px rgba(0, 0, 0, 0.2);
            text-align: left;
            padding-left: 8px;
            padding-right: 8px;
            border-radius: 4px;
        }
        .v_content-list a{
            font-size: 14px;
            color: rgba(0, 0, 0, 0.54);
        }
        .v_hv_common{
            position: relative;
        }
        .v_info_hv{
            display: none;
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

        @media (max-width: 1365px) {
            .v_trungtam-1 {
                position: relative;
                display: block;
                background-color: white;
            }
            #content {
                display: table;
            }
            .v_email {
                text-align: left;
                color: #1B6AAB;
            }
            .v_hv-dk{
                right: 24px;
            }
            .v_name {
                font-weight: 500;
                color: #000000CC;
            }

            .v_hv-dk li {
                padding-top: 17px;
            }

            hr {
                margin: 0;
            }
        }
    </style>
    <title>Khóa học mua chung chờ</title>
</head>

<body>
    <div id="v_wrapper" class="flex">
        <!-- Begin: sidebar -->
        <?php require_once '../includes/inc_GV_sidebar.php'; ?>
        <!-- End: sidebar -->

        <!-- Begin: main -->
        <div id="main">
            <!-- Begin: header -->
            <?php require_once '../includes/inc_GV_manager_header.php'; ?>
            <!-- End: header -->

            <!-- Begin: content -->
            <div id="content-box" class="flex">
                <?php 
                $actions = 'muachungcho';
                require_once '../includes/v_inc_GV_bo-loc.php'; ?>
                <div id="content">
                    <div id="v_content-title">
                        <div class="v_content-title-div">MÃ ĐƠN HÀNG</div>
                        <div class="v_content-title-div">KHÓA HỌC</div>
                        <div class="v_content-title-div">HỌC PHÍ</div>
                        <div class="v_content-title-div">TỔNG TIỀN</div>
                        <div class="v_content-title-div">HỌC VIÊN ĐĂNG KÝ</div>
                    </div>

                    <div id="filter">
                        <?php 
                        $qr1 = new db_query("SELECT * FROM order_common JOIN courses ON courses.course_id = order_common.course_id WHERE courses.user_id = $cookie_id ORDER BY common_id DESC LIMIT $start,$end");
                        while($row1 = mysql_fetch_array($qr1->result)){
                            $common_id = $row1['common_id'];
                            if ($row1['price_promotional'] == -1) {
                                $price = $row1['price_listed'];
                            }else{
                                $price = $row1['price_promotional'];
                            }
                            ?>
                        <div class="v_noidungkh" id="v_noidungkh-<?=$common_id ?>">
                            <div class="v_content-list v_monhoc"><?=$common_id ?></div>
                            <div class="v_content-list"><a href="<?php echo urlDetail_courseOnline($row1['course_id'],$row1['course_slug']); ?>"><?=$row1['course_name'] ?></a></div>
                            <div class="v_content-list"><?=number_format($row1['price_discount']) ?> đ</div>
                            <div class="v_content-list"><?=number_format($price) ?> đ</div>
                            <div class="v_content-list v_trungtam">
                                <?=$row1['numbers'] ?>/<?=$row1['quantity_std'] ?>
                                <ul class="v_none v_hv-dk">
                                    <?php 
                                        $qr2 = new db_query("SELECT * FROM order_student_common INNER JOIN users ON order_student_common.user_student_id = users.user_id WHERE common_id = $common_id");
                                        while($row2 = mysql_fetch_array($qr2->result)){ 
                                            ?>
                                    <li>
                                        <a href="<?php echo urlDetail_student($row2['user_id'],$row2['user_slug']); ?>" class="v_name"><?=$row2['user_name']?></a>
                                    </li>
                                <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div id="filter2">
                    <?php 
                    $qr3 = new db_query("SELECT * FROM order_common JOIN courses ON courses.course_id = order_common.course_id WHERE courses.user_id = $cookie_id ORDER BY common_id DESC LIMIT $start,$end");
                    while($row3 = mysql_fetch_array($qr3->result)){
                        $common_id = $row3['common_id'];
                        if ($row3['price_promotional'] == -1) {
                            $price = $row3['price_listed'];
                        }else{
                            $price = $row3['price_promotional'];
                        }
                        ?>
                    <div class="v_content-mb">
                        <div class="flex v_content-mb-div">
                            <p class="v_content-mb-title"><?=$row3['course_name'] ?></p>
                        </div>

                        <div class="flex v_info-all v_content-mb-div">
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã đơn hàng
                                    :</span><?=$row3['common_id'] ?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Học phí:
                                </span><?=number_format($row3['price_discount']) ?> đ
                            </div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tổng tiền
                                    :</span><?=number_format($price) ?> đ
                            </div>
                            <div class="v_content-mb-thongtin v_hv_common" onclick="v_hv_common1(this)">
                                <span class="v_content-mb-span">Học viên chờ :</span>
                                <?php
                                for ($i = 0; $i < $row3['numbers']; $i++) {
                                    echo '<img src="../../img/hoc-vien-cho.svg" alt="Ảnh lỗi">';
                                }
                                ?>
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
                    </div>
                    <?php } ?>
                    <!-- End: content -->
                </div>

                <div id="v_chuyentrang">
                    <a class="v_chuyen-trang-div" href="<?php if($p == 1){
                echo '/danh-sach-hoc-vien-dang-cho-mua-chung/id' . $_COOKIE['user_id'] . '-p1.html';
                }else{
                    echo '/danh-sach-hoc-vien-dang-cho-mua-chung/id' . $_COOKIE['user_id'] . '-p' . ($p-1).'.html';
                } ?>">&lt;</a>
                    <?php for ($i = 0; $i  < $pa ; $i++) { ?>
                    <a href="/danh-sach-hoc-vien-dang-cho-mua-chung/id<?php echo $_COOKIE['user_id']; ?>-p<?php echo $i  + 1; ?>.html"
                        class="v_chuyen-trang-div <?php if($p == $i+1){
                            echo "p_active";
                        } ?>" class="v_tranght"><?php echo $i + 1; ?></a>
                    <?php } ?>
                    <a href="<?php if($p == $i){
                        echo '/danh-sach-hoc-vien-dang-cho-mua-chung/id' . $_COOKIE['user_id'] . '-p'. ($i) .'.html';
                        }else{
                            echo '/danh-sach-hoc-vien-dang-cho-mua-chung/id' . $_COOKIE['user_id'] . '-p' . ($p+1).'.html';
                        } ?>" class="v_chuyen-trang-div">&gt;</a>
                </div>
            </div>
            <!-- End: main -->
        </div>
    </div>

    <!-- Begin: foooter -->
    <?php require_once("../includes/h_inc_footer.php"); ?>
    <!-- End: footer -->
    <script src="../js/bootstrap.min.js?v=<?=$version?>"></script>
    <script src="../js/v-main.js?v=<?=$version?>"></script>
    <script>
    function v_hv_common1(e) {
        $(e).find('.v_info_hv').toggle();
    }
    $(document).ready(function() {
        $("#keywords").keyup(function() {
            var cookie_id = <?=$cookie_id?>;
            var search = $(this).val();
            var type = "khmuachung";
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

            var type2 = "khmuachung";
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