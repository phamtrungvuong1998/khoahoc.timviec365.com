<?php 
require_once '../includes/v_inc_insert_HV.php';
$qrCount = new db_query("SELECT order_id FROM orders WHERE user_student_id = '$user_id' AND course_type = 1");

$rowCount = mysql_num_rows($qrCount->result);
$pa = $rowCount/10;

$qr = new db_query("SELECT * FROM orders INNER JOIN courses ON orders.course_id = courses.course_id INNER JOIN users ON courses.user_id = users.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_type = 1 AND orders.user_student_id = '$user_id' ORDER BY order_id DESC LIMIT 0,10");
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
    <link rel="stylesheet" href="../css/V_CSS/dskhoahocdamuaonline.css?v=<?=$version?>">
    <style type="text/css">
        #v_sidebar-1 {
            display: block;
        }

        #v_QL-khoa-hoc {
            color: #1B6AAB;
        }

        #v_kh-offline {
            color: #1B6AAB;
        }
        .v_sidebar-menu:nth-child(2) button{
            color: #1B6AAB;
        }
        #v_sidebar-tb-2{
            display: block;
        }
        #v_sidebar-tb-2 li:nth-child(2) a{
            color: #1B6AAB;
        }
        .v_monhoc a{
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 1;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            color: rgba(0, 0, 0, 0.54);
            line-height: 19px;
        }

        .p_active{
            background: #1B6AAB;
            color: white;
        }
        .v_btn-del{
            width: 120px;
        }
        .v_popup{
            width: 140px;
            height: 70px !important;
        }
        .v_ghichu-mb{
            width: 35%;
        }
    </style>
    <title>Danh s??ch kh??a h???c offline ???? ?????t ch???</title>
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
                        <div class="v_content-title-div v_table-cell">STT</div>
                        <div class="v_content-title-div v_table-cell">Kh??a h???c</div>
                        <div class="v_content-title-div v_table-cell">M??n h???c</div>
                        <div class="v_content-title-div v_table-cell">Gi???ng vi??n</div>
                        <div class="v_content-title-div v_table-cell">H???c ph??</div>
                        <div class="v_content-title-div v_table-cell v_ngaydk">ng??y ????ng k??</div>
                        <div class="v_content-title-div v_table-cell v_bacham"><img src="../img/More.svg" alt="???nh l???i">
                        </div>
                    </div>

                    <?php
                    $i = 1;
                    if (mysql_num_rows($qr->result) == 0) {
                        echo '<div class="emptys">Ch??a c?? d??? li???u</div>';
                    }else{
                       while ($row = mysql_fetch_array($qr->result)) { 
                        ?>
                        <div class="v_noidungkh">
                            <div class="v_table-cell v_stt"><?php echo $i; ?></div>
                            <div class="v_table-cell v_content-list v_monhoc"><a href="<?php echo urlDetail_courseOffline($row['course_id'],$row['course_slug']); ?>"><?php echo $row['course_name']; ?></a></div>
                            <div class="v_table-cell v_content-list"><?php echo $row['cate_name']; ?></div>
                            <?php
                            if ($row['user_type'] == 2) {
                                $linkT = urlDetail_teacher($row['user_id'],$row['user_slug']);
                            }else if($row['user_type'] == 3){
                                $linkT = urlDetail_center($row['user_id'],$row['user_slug']);
                            }
                            ?>
                            <div class="v_table-cell v_content-list v_teacher_center"><a href="<?php echo $linkT; ?>"><?php echo $row['user_name']; ?></a></div>
                            <?php
                            if ($row['price_promotional'] == -1) {
                                $price = $row['price_listed'];
                            }else{
                                $price = $row['price_promotional'];
                            }
                            ?>
                            <div class="v_table-cell v_content-list"><?php echo number_format($price) . " ??"; ?></div>
                            <div class="v_table-cell v_content-list v_ngaydk"><?php echo date("d-m-Y", $row['created_at']); ?></div>
                            <div class="v_table-cell v_content-list v_bacham">
                                <button class="v_btn-bacham" onclick="v_popup(this)"><img
                                    src="../img/More.svg" alt="???nh l???i"></button>
                                    <div class="v_popup">
                                        <!-- <center><button class="v_btn-del">GHI CH??</button></center> -->
                                        <center><a href="<?php echo urlDetail_courseOffline($row['course_id'], $row['course_slug']) ?>"><button class="v_btn-del">XEM TH??M</button></a></center>
                                    </div>
                                </div>
                            </div>
                            <div class="v_content-mb">
                                <div class="flex v_content-mb-div">
                                    <p class="v_content-mb-stt"><?php echo $i . "."; ?></p>
                                    <a class="v_content-mb-title" href="<?php echo urlDetail_courseOffline($row['course_id'],$row['course_slug']); ?>">
                                        <?php echo $row['course_name']; ?>
                                    </a>
                                </div>
                                <a class="v_tengiangvien" href="<?php echo $linkT; ?>"><?=$row['user_name']; ?></a>

                                <div class="flex v_info-all v_content-mb-div">
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ng??y ????ng k?? : </span><?php echo date("d-m-Y", $row['created_at']); ?></div>
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">H???c ph?? : </span> <?php echo number_format($price) . " ??"; ?>
                                </div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">M??n h???c : </span> <?php echo $row['cate_name']; ?>
                                </div>
                        </div>

                        <div class="flex v_mb-ghichu-all v_content-mb-div">
                            <!-- <div class="flex v_ghichu-mb">
                                <p class="v_ghichu-mb-p"><img src="../img/V_ghi-chu.svg" alt="???nh l???i"></p>
                                <p class="v_ghichu-mb-p v_gc"><a href="">Ghi ch??</a></p>
                            </div> -->
                            <div class="v_ghichu-mb v_xemthem"><i><a href="<?php echo urlDetail_courseOffline($row['course_id'], $row['course_slug']) ?>">Xem th??m</a></i></div>
                        </div>
                    </div>
                    <?php 
                    $i++;
                } 
            }
            ?>
        </div>

        <div id="v_chuyentrang">
            <a class="v_chuyen-trang-div">&lt;</a>
            <?php for ($i = 1; $i  <= ceil($pa) ; $i++) { ?>
                <a class="v_chuyen-trang-div"><?php echo $i ?></a>
            <?php } ?>
            <a class="v_chuyen-trang-div">&gt;</a>
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
    $(document).ready(function() {
        $('.v_chuyen-trang-div').eq(1).css({
            "color": "white",
            "background": "#1B6AAB"
        });

        if ($('#content').children(".v_noidungkh").length == 0) {
            $('#v_chuyentrang').remove();
            $('#v_content-title').remove();
        }

        $('.v_chuyen-trang-div').click(function() {
            var page = $(this).index(".v_chuyen-trang-div");
            var j;
            for (var i = 1; i < $('.v_chuyen-trang-div').length - 1; i++) {
                if (page == 0) {
                    if ($('.v_chuyen-trang-div').eq(1).css('color') == 'rgb(255, 255, 255)') {
                        page = 1;
                    }else if ($('.v_chuyen-trang-div').eq(i).css('color') == 'rgb(255, 255, 255)'){
                        page = i - 1;
                    }
                }

                if (page == $('.v_chuyen-trang-div').length - 1) {
                    if ($('.v_chuyen-trang-div').eq($('.v_chuyen-trang-div').length - 2).css('color') == 'rgb(255, 255, 255)') {
                        page = $('.v_chuyen-trang-div').length - 2;
                    }else if ($('.v_chuyen-trang-div').eq(i).css('color') == 'rgb(255, 255, 255)'){
                        page = i + 1;
                    }
                }

                if ($('.v_chuyen-trang-div').eq(i).css('color') == 'rgb(255, 255, 255)') {
                    j = i;
                }

                $('.v_chuyen-trang-div').eq(i).css({
                    'color': 'black',
                    'background': 'none'
                });
            }
            $.ajax({
                url: '../ajax/v_course_buy.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    number: page,
                    type: 1
                },
                success: function (data) {
                    $('.v_chuyen-trang-div').eq(page).css({
                        'color': 'white',
                        'background': '#1B6AAB'
                    });
                    $('.v_noidungkh').remove();
                    $('.v_content-mb').remove();
                    $('#content').append(data.html);
                },
                error: function () {
                   $('.v_chuyen-trang-div').eq(j).css({
                    'color': 'white',
                    'background': '#1B6AAB'
                });
                   alert("C?? l???i x???y ra. Vui l??ng th??? l???i");
               }
           });       
        });
    });
</script>

</html>