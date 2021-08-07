<?php 
require_once '../includes/v_inc_insert_HV.php';
$user_id = $_COOKIE['user_id'];
//Lấy course_id
$qrCommon = new db_query("SELECT * FROM order_student_common INNER JOIN order_common ON order_student_common.common_id = order_common.common_id INNER JOIN courses ON courses.course_id = order_common.course_id WHERE user_student_id = $user_id ORDER BY order_student_id DESC LIMIT 0,10");

//Lấy số lượng
$db_count_common = new db_query("SELECT course_id FROM order_student_common WHERE user_student_id = $user_id");
$pa = ceil(mysql_num_rows($db_count_common->result)/10);
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
        #v_sidebar-1 {
            display: block;
        }

        #v_QL-khoa-hoc {
            color: #1B6AAB;
        }

        #v_kh-mua-chung {
            color: #1B6AAB;
        }
        .v_sidebar-menu:nth-child(2) button{
            color: #1B6AAB;
        }
        #v_sidebar-tb-2{
            display: block;
        }
        #v_sidebar-tb-2 li:nth-child(5) a{
            color: #1B6AAB;
        }

        .v_monhoc p{
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 1;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            color: rgba(0, 0, 0, 0.54);
            line-height: 19px;
        }
        .v_monhoc a {
            width: 100% !important;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 1;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            color: rgba(0, 0, 0, 0.54);
            line-height: 19px;
        }
        .v_trungtam p{
            line-height: 19px;
            font-size: 14px;
            font-weight: 400;
            color: rgba(27, 106, 171, 1);
        }
        .v_popup {
            height: 70px !important;
        }
    </style>
    <title>Khóa học mua chung</title>
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
                        <div class="v_table-cell v_content-title-div">Ngày đăng ký</div>
                        <div class="v_table-cell v_content-title-div">số người đăng ký</div>
                        <div class="v_table-cell v_content-title-div">số tiền đặt cọc</div>
                        <div class="v_table-cell v_content-title-div">Học phí</div>
                        <div class="v_table-cell v_content-title-div v_bacham"><img src="../img/More.svg" alt="Ảnh lỗi">
                        </div>
                    </div>

                    <?php
                    $i = 1;
                    if (mysql_num_rows($qrCommon->result) == 0) {
                        echo '<div class="emptys">Chưa có dữ liệu</div>';
                    }else{
                        while ($row = mysql_fetch_array($qrCommon->result)){
                            $link_course = urlDetail_courseOnline($row['course_id'], $row['course_slug']);
                            ?>
                            <div class="v_noidungkh">
                                <div class="v_table-cell v_stt"><?php echo $i; ?></div>
                                <div class="v_table-cell v_content-list v_monhoc"><a href="<?php echo $linkCourse; ?>"><?php echo $row['course_name']; ?></a></div>
                                <div class="v_table-cell v_content-list"><?php echo date('d-m-Y', $row['created_at']); ?></div>
                                <div class="v_table-cell v_content-list v_trungtam"><p><?php echo $row['numbers']; ?> / <?php echo $row['quantity_std']; ?></p></div>
                                <div class="v_table-cell v_content-list"><?php echo number_format($row['price_discount']); ?> đ</div>
                                <?php
                                if ($row['price_promotional'] == -1) {
                                    $price = $row['price_listed'];
                                }else{
                                    $price = $row['price_promotional'];
                                } ?>
                                <div class="v_table-cell v_content-list"><?php echo number_format($price); ?> đ</div>
                                <div class="v_table-cell v_content-list v_bacham">
                                    <button class="v_btn-bacham" onclick="v_popup(this)"><img
                                        src="../img/More.svg" alt="Ảnh lỗi"></button>
                                        <div class="v_popup" id="v_popup-<?php echo $i; ?>">
                                            <center><a href="<?php echo $link_course; ?>"><button class="v_btn-del">CHI TIẾT</button></a></center>
                                        </div>
                                    </div>
                                </div>
                                <div class="v_content-mb">
                                    <div class="flex v_content-mb-div">
                                        <p class="v_content-mb-stt"><?php echo $i; ?>. </p>
                                        <a class="v_content-mb-title" href="<?php echo $linkCourse; ?>"><?php echo $row['course_name']; ?>
                                    </a>
                                </div>
                                <div class="flex v_info-all v_content-mb-div">
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ngày đăng ký : </span><?php echo date('d-m-Y', $row['created_at']); ?></div>
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số người đăng ký
                                    : </span><?php echo $row['numbers']; ?> / <?php echo $row['quantity_std']; ?></div>
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Đặt cọc : </span> <?php echo number_format($row['price_discount']); ?> đ
                                    </div>
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Học phí : </span> <?php echo number_format($price); ?> đ
                                    </div>
                                </div>

                                <div class="flex v_mb-ghichu-all v_content-mb-div">
                               <!--  <div class="flex v_ghichu-mb">
                                    <p class="v_ghichu-mb-p"><img src="../img/V_ghi-chu.svg" alt="Ảnh lỗi"></p>
                                    <p class="v_ghichu-mb-p v_gc"><a href="">Ghi chú</a></p>
                                </div> -->
                                <a href="<?php echo $link_course; ?>" class="v_ghichu-mb v_xemthem"><span>Chi tiết</span></a>
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
    $("#v_pa_1").css({
        "color":"white",
        "background": "#1B6AAB"
    })

    if ($('.v_noidungkh').length == 0) {
        $('#v_content-title').remove();
        $('#v_chuyentrang').remove();
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
            url: '../ajax/v_ajax_common.php',
            type: 'GET',
            dataType: 'json',
            data: {number: number},
            success: function(data){
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