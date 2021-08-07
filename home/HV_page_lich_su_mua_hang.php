<?php 
require_once '../includes/v_inc_insert_HV.php';
$qrOrderCount = new db_query("SELECT order_id FROM orders WHERE user_student_id = '$user_id' AND course_type = 2");
$rowCount = mysql_num_rows($qrOrderCount->result);
$pa = $rowCount/10;
$qr = new db_query("SELECT * FROM orders INNER JOIN courses ON orders.course_id = courses.course_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE orders.user_student_id = '$user_id' AND courses.course_type = 2 ORDER BY order_id DESC LIMIT 0,10");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <?php
    require_once '../includes/v_inc_HV_css.php';
    require_once '../includes/v_inc_DS_css.php';
    ?>
    <style type="text/css">
        #v_sidebar-2 {
            display: block;
        }

        #v_vi-kh {
            color: #1B6AAB;
        }

        #v_ls-mua-kh {
            color: #1B6AAB;
        }
        .v_sidebar-menu:nth-child(3) button{
            color: #1B6AAB;
        }
        #v_sidebar-tb-3{
            display: block;
        }
        #v_sidebar-tb-3 li:nth-child(2) a{
            color: #1B6AAB;
        }
        .v_monhoc p{
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 1;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            white-space: normal;
            font-size: 14px;
            color: rgba(0, 0, 0, 0.54);
            width: 150px;
        }

        .p_active{
            background: #1B6AAB;
            color: white;
        }
        .v_pc_hocphi{
            width: 13%;
        }
        @media(max-width: 1300px){
            #content{
                display: table;
            }
        }
    </style>
    <title>Lịch sử mua khóa học</title>
</head>

<body>
    <div id="v_wrapper" class="flex">
        <!-- Begin: sidebar -->
        <?php require_once("../includes/inc_sidebar.php"); ?>
        <!-- End: sidebar -->

        <!-- Begin: main -->
        <div id="main">
            <!-- Begin: header -->
            <?php require_once '../includes/inc_manager_header.php'; ?>
            <!-- End: header -->

            <!-- Begin: content -->
            <div id="content-box" class="flex">
                <div id="content">
                    <div id="v_content-title">
                        <div class="v_table-cell v_content-title-div">STT</div>
                        <div class="v_table-cell v_content-title-div">Khóa học</div>
                        <div class="v_table-cell v_content-title-div">Môn học</div>
                        <div class="v_table-cell v_content-title-div">mã đơn hàng</div>
                        <div class="v_table-cell v_content-title-div">Học phí</div>
                        <div class="v_table-cell v_content-title-div">thời gian</div>
                        <div class="v_table-cell v_content-title-div v_bacham"><img src="../img/More.png" alt="Ảnh lỗi">
                        </div>
                    </div>

                    <?php
                    if (mysql_num_rows($qr->result) == 0) {
                        echo '<div class="emptys">Chưa có dữ liệu</div>';
                    }else{
                        $i = 1;
                        while ($row = mysql_fetch_array($qr->result)) {
                            if ($row['price_promotional'] == -1) {
                                $price = number_format($row['price_listed']);
                            }else{
                                $price = number_format($row['price_promotional']);
                            } 
                            ?>
                            <div class="v_noidungkh">
                                <div class="v_table-cell v_stt"><?php echo $i; ?></div>
                                <div class="v_table-cell v_content-list v_monhoc"><p><?php echo $row['course_name']; ?></p></div>
                                <div class="v_table-cell v_content-list"><?php echo $row['cate_name']; ?></div>
                                <div class="v_table-cell v_content-list"><?php echo $row['order_id']; ?></div>
                                <div class="v_table-cell v_content-list v_pc_hocphi"><?php echo $price . " đ"; ?></div>
                                <div class="v_table-cell v_content-list"><?php echo date("d/m/Y", $row['day_buy']); ?></div>
                                <div class="v_table-cell v_content-list v_bacham">
                                    <button class="v_btn-bacham" onclick="v_popup(this)"><img src="../img/More.svg" alt="Ảnh lỗi"></button>
                                    <?php 
                                    if ($row['course_type'] == 1) {
                                        $srcCourse = urlDetail_courseOffline($row['course_id'], $row['course_slug']);
                                    }else{
                                        $srcCourse = urlDetail_courseOnline($row['course_id'], $row['course_slug']);
                                    }
                                    ?>
                                    <div class="v_popup" id="v_popup-<?php echo $row['order_id']; ?>">
                                        <center><a href="<?php echo $srcCourse; ?>"><button class="v_btn-del">XEM THÊM</button></a></center>
                                    </div>
                                </div>
                            </div>
                            <div class="v_content-mb">
                                <div class="flex v_content-mb-div">
                                    <p class="v_content-mb-stt"><?php echo $i . "."; ?></p>
                                    <p class="v_content-mb-title"><?php echo $row['course_name']; ?>
                                </p>
                            </div>
                            <div class="flex v_info-all v_content-mb-div">

                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã đơn hàng :</span> <?php echo $row['order_id']; ?>
                            </div>

                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Học phí :</span> <?php echo $price . " đ"; ?>
                        </div>
                        <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học
                        : </span><?php echo $row['cate_name']; ?></div>
                        <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Thời gian
                        : </span><?php echo date("d/m/Y", $row['day_buy']); ?></div>
                    </div>

                    <div class="flex v_mb-ghichu-all v_content-mb-div">
<!--                     <div class="flex v_ghichu-mb">
                        <p class="v_ghichu-mb-p"><img src="../img/V_ghi-chu.svg" alt="Ảnh lỗi"></p>
                        <p class="v_ghichu-mb-p v_gc"><a href="">Ghi chú</a></p>
                    </div> -->
                    <?php 
                    if ($row['course_type'] == 1) {
                        $srcCourse = urlDetail_courseOffline($row['course_id'], $row['course_slug']);
                    }else{
                        $srcCourse = urlDetail_courseOnline($row['course_id'], $row['course_slug']);
                    }
                    ?>
                    <div class="v_ghichu-mb v_xemthem"><span><a href="<?php echo $srcCourse; ?>">Xem thêm</a></span></div>
                </div>
            </div>
            <?php
            $i++;
        } 
    }
    ?>
</div>

<div id="v_chuyentrang">
    <a class="v_chuyen-trang-div" onclick="v_chuyentrang('previous')">&lt;</a>
    <?php for ($i = 1; $i  <= ceil($pa) ; $i++) { ?>
        <a class="v_chuyen-trang-div v_phantrang" id="v_pa_<?php echo $i; ?>" onclick="v_chuyentrang(<?php echo $i; ?>)"><?php echo $i ?></a>
    <?php } ?>
    <a class="v_chuyen-trang-div" onclick="v_chuyentrang('next')">&gt;</a>
</div>

</div>
<!-- End: content -->

</div>
<!-- End: main -->
</div>

<!-- Begin: foooter -->
<?php require_once("../includes/h_inc_footer.php"); ?>
<!-- End: footer -->
</body>
<script src="../js//v-main.js?v=<?=$version?>"></script>
<script type="text/javascript">
    $('#v_pa_1').css({
        "color": "white",
        "background": "#1B6AAB"
    });
    
    if ($('#content').children(".v_noidungkh").length == 0) {
        $('#v_chuyentrang').remove();
        $('#v_content-title').remove();
    }

    function v_chuyentrang(number) {
        var sum = $("#v_chuyentrang").children('.v_phantrang').length;
        if (number == 'previous') {
            if ($('#v_pa_1').css("color") != "rgb(255, 255, 255)") {
                for (var i = 1; i <= $("#v_chuyentrang").children('.v_phantrang').length; i++) {
                    if ($('#v_pa_' + i).css("color") == "rgb(255, 255, 255)") {
                        number = i - 1;
                        break;
                    }
                }
            }else{
                number = 1;
            }
        }else if (number == 'next') {
            if ($('#v_pa_' + sum).css("color") != "rgb(255, 255, 255)") {
                for (var i = 1; i <= $("#v_chuyentrang").children('.v_phantrang').length; i++) {
                    console.log($('#v_pa_' + i).css("color"));
                    if ($('#v_pa_' + i).css("color") == "rgb(255, 255, 255)") {
                        number = i + 1;
                        break;
                    }
                }
            }else{
                number = sum;
            }
        }

        for (var i = 1; i <= $("#v_chuyentrang").children('.v_phantrang').length; i++) {
            $('#v_pa_' + i).css({
                "color": "black",
                "background": "#F4F2FF"
            });
        }

        $.ajax({
            url: '../ajax/v_history_buy.php',
            type: 'GET',
            dataType: 'json',
            data: {number: number},
            success: function (data) {
                console.log(data.html);
                $('#v_pa_' + number).css({
                    "color": "white",
                    "background": "#1B6AAB"
                });

                $('.v_noidungkh').remove();
                $('.v_content-mb').remove();
                $('#content').append(data.html);
            }
        });
    }
</script>

</html>