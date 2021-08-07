<?php
require_once '../code_xu_ly/h_manager_GV.php';

$qrCount = new db_query("SELECT COUNT(*) FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = 1 AND hide_course = 1");

$rowCount = mysql_fetch_array($qrCount->result);
$pa = $rowCount[0]/10;

$p = getValue('p','str','GET','');

$number_page = 10;

if (!isset($_GET['p']) || $p == 1) {
    $start = 0;
    $end = 10;
}else{
    $start = $number_page * ($p - 1);
    $end = 10;
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
    <style type="text/css">
    #v_ql-kh {
        color: #1B6AAB;
    }

    #v_sidebar-tb-2 {
        display: block;
    }

    #v_kh-offline {
        color: #1B6AAB;
    }
    .v_sidebar-menu:nth-child(3) button{
        color: #1B6AAB;
    }
    #v_sidebar_tb-2{
        display: block;
    }
    #v_sidebar_tb-2 li:nth-child(2) a{
        color: #1B6AAB;
    }
    .v_popup {
        width: 160px;
        height: 52px;
        padding-bottom: 50px;
    }
    .v_monhoc{
        width: 15%;
    }
    .v_content-list{
        width: 13%;
    }
    .v_monhoc p{
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 1;
        font-size: 14px;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        color: rgba(0, 0, 0, 0.54);
        line-height: 19px;
    }
    .v_btn-buy {
        padding: 10px;
        background: rgba(24, 93, 160, 1);
        color: white;
    }
    .v_price_promotional{
        width: 17%;
    }
    .v_bacham{
        color: white;
    }
    .v_btn-bacham{
        display: block;
    }
    @media (max-width: 767px) {
        .v_mb-edit {
            border: none;
            background: #1B6AAB;
            border-radius: 16px;
            color: white;
            font-weight: 700;
            font-size: 12px;
            height: 32px;
            padding: 10px;
        }
        .v_xoakh3{
            margin-top: 1px;   
        }
        #content{
            display: none !important;
        }
    }
    </style>
    <title>Khóa học offline giảng dạy</title>
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
                    $actions = 'offline';
                    require_once '../includes/v_inc_GV_bo-loc.php'; 
                ?>

                <div id="content">
                    <div id="v_content-title">
                        <!-- <div class="checkboxs">No</div> -->
                        <div class="v_content-title-div">Khóa học</div>
                        <div class="v_content-title-div">Môn học</div>
                        <div class="v_content-title-div">SỐ BUỔI HỌC</div>
                        <div class="v_content-title-div">TÀI LIỆU</div>
                        <div class="v_content-title-div">Giá gốc</div>
                        <div class="v_content-title-div">Giá khuyến mại</div>
                        <div class="v_content-title-div">NGÀY ĐĂNG</div>
                        <div class="v_content-title-div v_bacham"><img class="lazyload" src="/img/load.gif"
                                data-src="../img/More.png" alt="Ảnh lỗi"></div>
                    </div>

                    <div id="filter">
                        <?php 
                        $dbon = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = 1 AND hide_course = 1 ORDER BY course_id DESC LIMIT $start,$end");
                        if (mysql_num_rows($dbon->result)==0) {
                                echo '<div >Chưa có dữ liệu</div>';
                            }else{
                                while ($rowc = mysql_fetch_array($dbon->result)) {
                                    ?>
                        <div class="v_noidungkh" id="v_noidungkh-<?=$rowc['course_id']?>">
                            <div class="v_content-list v_monhoc"><p><?=$rowc['course_name']?></p></div>
                            <div class="v_content-list"><?=$rowc['cate_name']?></div>
                            <div class="v_content-list v_trungtam"><?=$rowc['time_learn']?></div>
                            <div class="v_content-list"><?=$rowc['course_slide']?></div>
                            <div class="v_content-list"><?php
                            echo number_format($rowc['price_listed']) . " đ";
                            ?></div>
                            <div class="v_content-list v_price_promotional"><?php
                            if ($rowc['price_promotional'] == -1) {
                                echo "Chưa cập nhật";
                            }else{
                                echo number_format($rowc['price_promotional']) . " đ";
                            }
                            ?></div>
                            <div class="v_content-list"><?=date("d-m-Y", $rowc['created_at']) ?></div>
                            <div class="v_content-list v_bacham">
                                <button class="v_btn-bacham" onclick="v_bacham(<?=$rowc['course_id']?>)"><img
                                        class="lazyload" src="/img/load.gif" data-src="../img/More.svg"
                                        alt="Ảnh lỗi"></button>
                                        Vuong
                                <div class="v_popup" id="v_popup-<?=$rowc['course_id']?>">
                                    <center><a
                                            href="/cap-nhat-khoa-hoc-offline-giang-vien/id<?=$cookie_id?>-courseOf<?=$rowc['course_id']?>.html"
                                            class="v_btn-buy"><img class="lazyload" src="/img/load.gif"
                                                data-src="../img/chinh-sua.svg" alt="Ảnh l">CHỈNH
                                            SỬA</a></center>
                                    <center><button class="v_xoakh" data-course="<?php echo $rowc['course_id'];?>" onclick="v_del_course(this)">XÓA KHÓA HỌC</button></center>
                                </div>
                                
                            </div>
                        </div>
                        <?php
                                }
                            }?>
                    </div>
                </div>

                <div id="filter2">
                    <?php 
                    $dbon1 = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = 1 AND hide_course = 1 ORDER BY course_id DESC LIMIT $start,$end");
                    while ($rowc = mysql_fetch_array($dbon1->result)){
                    ?>
                    <div class="v_content-mb">
                        <div class="flex v_content-mb-div">
                            <p class="v_content-mb-title"><?=$rowc['course_name']?></p>
                        </div>

                        <div class="flex v_info-all v_content-mb-div">
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học :</span>
                                <?=$rowc['cate_name']?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Giá gốc:
                                </span><?php
                                echo number_format($rowc['price_listed']) . " đ";
                                ?>
                            </div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Giá khuyến mại:
                                </span><?php
                                if ($rowc['price_promotional'] == -1) {
                                    echo "Chưa cập nhật";
                                }else{
                                    echo number_format($rowc['price_promotional']) . "đ";
                                }
                                ?>
                            </div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số lượng bải giảng : </span><?=$rowc['course_slide']?> video</div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tài liệu : </span>
                                <?=$rowc['course_slide']?> file
                            </div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ngày đăng : </span>
                                <?=date("d-m-Y", $rowc['created_at']) ?></div>
                        </div>

                        <div class="flex v_mb-ghichu-all v_content-mb-div">
                            <div class="v_mb-edit-div v_chinhsua1"><a
                                    href="/cap-nhat-khoa-hoc-offline-giang-vien/id<?=$cookie_id?>-courseOf<?=$rowc['course_id']?>.html"
                                    class="v_mb-edit"><img class="lazyload" src="/img/load.gif"
                                        data-src="../img/chinh-sua.svg" alt="Ảnh lỗi">Chỉnh sửa</a></div>
                            <div class="v_mb-edit-div v_xoakh3" data-course="<?php echo $rowc['course_id'];?>"><button class="v_mb-edit v_xoakh2" data-course="<?php echo $rowc['course_id'];?>" onclick="v_del_course(this)">Xóa khóa học</button></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div id="v_chuyentrang">
                    <a class="v_chuyen-trang-div" href="<?php if($p == 1){
                            echo '/giang-vien-khoa-hoc-offline/id' . $_COOKIE['user_id'] . '-p1.html';
                        }else{
                            echo '/giang-vien-khoa-hoc-offline/id' . $_COOKIE['user_id'] . '-p' . ($p-1).'.html';
                        } ?>">&lt;</a>
                    <?php for ($i = 0; $i  < $pa ; $i++) { ?>
                    <a href="/giang-vien-khoa-hoc-offline/id<?php echo $_COOKIE['user_id']; ?>-p<?php echo $i  + 1; ?>.html"
                        class="v_chuyen-trang-div <?php if($p == $i+1){
                            echo "p_active";
                        } ?>" class="v_tranght"><?php echo $i + 1; ?></a>
                    <?php } ?>
                    <a href="<?php if($p == $i){
                            echo '/giang-vien-khoa-hoc-offline/id' . $_COOKIE['user_id'] . '-p'. ($i) .'.html';
                        }else{
                            echo '/giang-vien-khoa-hoc-offline/id' . $_COOKIE['user_id'] . '-p' . ($p+1).'.html';
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
            var type = "offline";
            var type2 = "offline";
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

    function v_del_course(e) {
        var n = confirm("Bạn có muốn xóa khóa học này không");
        if (n == true) {
            $.ajax({
                url: '../ajax/v_hide_course_gv.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    course_id: $(e)[0].dataset.course,
                    course_type: 1,
                    p: <?php echo $p; ?>
                },
                success: function (data) {
                    window.location.reload();
                    // if (data.result == 0) {
                    //     $("#v_content-title").remove();
                    //     $("#filter").remove();
                    //     $('#filter2').remove();
                    //     $('#v_chuyentrang').remove();
                    //     $("#content").html(data.html);
                    // }else if (data.result == 1) {
                    //     $("#content").html(data.htmlPC);
                    //     $("#filter2").html(data.htmlMB);
                    //     $('#v_chuyentrang').html(data.chuyentrang);
                    // }
                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại");
                }
            });
        }
    }
    </script>
</body>

</html>