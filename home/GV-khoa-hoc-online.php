<?php
require_once '../code_xu_ly/h_manager_GV.php';
$qrCount = new db_query("SELECT COUNT(*) FROM  courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = 2 AND hide_course = 1 ORDER BY course_id DESC");

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
    .v_sidebar-menu:nth-child(3) button{
        color: #1B6AAB;
    }
    #v_sidebar_tb-2{
        display: block;
    }
    #v_sidebar_tb-2 li:nth-child(1) a{
        color: #1B6AAB;
    }
    #v_kh-online {
        color: #1B6AAB;
    }

    .v_popup {
        width: 160px;
        height: 52px;
        padding-bottom: 50px;
    }

    .v_btn-buy {
        padding: 10px;
        background: rgba(24, 93, 160, 1);
        color: white;
    }

    .v_xoakh{
        background: red;
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
        #content{
            display: none;
        }
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
            margin-top: -6px;   
        }
        .v_xoakh2{
            height: 34px;
            background: red;
        }
    }
    </style>
    <title>Kh??a h???c online gi???ng d???y</title>
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
                    echo '<div class="emptys">Ch??a c?? d??? li???u</div>';
                }else{
                $actions = 'online';
                require_once '../includes/v_inc_GV_bo-loc.php'; ?>

                <div id="content">
                    <div id="v_content-title">
                        <div class="v_content-title-div">Kh??a h???c</div>
                        <div class="v_content-title-div">M??n h???c</div>
                        <div class="v_content-title-div">S??? BU???I H???C</div>
                        <div class="v_content-title-div">T??I LI???U</div>
                        <div class="v_content-title-div">Gi?? g???c</div>
                        <div class="v_content-title-div">Gi?? khuy???n m???i</div>
                        <div class="v_content-title-div">NG??Y ????NG</div>
                        <div class="v_content-title-div v_bacham"><img class="lazyload" src="/img/load.gif"
                                data-src="../img/More.png" alt="???nh l???i"></div>
                    </div>

                    <div id="filter">
                        <?php 
                        $dbon = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = 2 AND hide_course = 1 ORDER BY course_id DESC LIMIT $start,10");
                        if (mysql_num_rows($dbon->result)==0) {
                                echo '<div >Ch??a c?? d??? li???u</div>';
                            }else{
                                while ($rowc = mysql_fetch_array($dbon->result)) {
                                    ?>
                        <div class="v_noidungkh" id="v_noidungkh-<?=$rowc['course_id']?>">
                            <div class="v_content-list v_monhoc"><p><?=$rowc['course_name']?></p></div>
                            <div class="v_content-list"><?=$rowc['cate_name']?></div>
                            <div class="v_content-list v_trungtam"><?php
                            if ($rowc['time_learn'] == 0) {
                                echo 'Ch??a c???p nh???t';
                            }else{
                                echo $rowc['time_learn'];
                            }
                            ?></div>
                            <div class="v_content-list"><?php
                            if ($rowc['course_slide'] == 0) {
                                echo 'Ch??a c???p nh???t';
                            }else{
                                echo $rowc['course_slide'];
                            }
                            ?></div>
                            <div class="v_content-list"><?php
                            if ($rowc['price_listed'] == -1) {
                                echo "Ch??a c???p nh???t";
                            }else{
                                echo number_format($rowc['price_listed']) . " ??";
                            }?></div>
                            <div class="v_content-list v_price_promotional"><?php
                            if ($rowc['price_promotional'] == -1) {
                                echo "Ch??a c???p nh???t";
                            }else{
                                echo number_format($rowc['price_promotional']) . " ??";
                            }
                            ?></div>
                            <div class="v_content-list"><?=date("d-m-Y", $rowc['created_at']) ?></div>
                            <div class="v_content-list v_bacham">
                                <button class="v_btn-bacham" onclick="v_bacham(<?=$rowc['course_id']?>)"><img
                                        class="lazyload" src="/img/load.gif" data-src="../img/More.svg"
                                        alt="???nh l???i"></button>
                                        Vuong
                                <div class="v_popup" id="v_popup-<?=$rowc['course_id']?>">
                                    <center><a
                                            href="/cap-nhat-khoa-hoc-online-giang-vien/id<?=$cookie_id?>-courseOn<?=$rowc['course_id']?>.html"
                                            class="v_btn-buy"><img class="lazyload" src="/img/load.gif"
                                                data-src="../img/chinh-sua.svg" alt="???nh l">CH???NH
                                            S???A</a></center>
                                    <center><button class="v_xoakh" data-course="<?php echo $rowc['course_id'];?>" onclick="v_del_course(this)">X??A KH??A H???C</button></center>
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
                    $dbon1 = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = 2 AND hide_course = 1 ORDER BY course_id DESC LIMIT $start,$end");
                    while ($rowc = mysql_fetch_array($dbon1->result)){
                    ?>
                    <div class="v_content-mb">
                        <div class="flex v_content-mb-div">
                            <p class="v_content-mb-title"><?=$rowc['course_name']?></p>
                        </div>

                        <div class="flex v_info-all v_content-mb-div">
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">M??n h???c :</span>
                                <?=$rowc['cate_name']?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Gi?? g???c:
                                </span><?php
                                if ($rowc['price_listed'] == -1) {
                                    echo "Ch??a c???p nh???t";
                                }else{
                                    echo number_format($rowc['price_listed']) . " ??";
                                }
                                ?>
                            </div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Gi?? khuy???n m???i : </span><?php
                                if ($rowc['price_promotional'] == -1) {
                                    echo "Ch??a c???p nh???t";
                                }else{
                                    echo number_format($rowc['price_promotional']) . " ??";
                                }
                                ?>
                            </div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">S??? l?????ng b???i gi???ng: </span><?=$rowc['course_slide']?> video</div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">T??i li???u : </span>
                                <?=$rowc['course_slide']?> file
                            </div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ng??y ????ng : </span>
                                <?=date("d-m-Y", $rowc['created_at']) ?></div>
                        </div>

                        <div class="flex v_mb-ghichu-all v_content-mb-div">
                            <div class="v_mb-edit-div"><a
                                    href="/cap-nhat-khoa-hoc-online-giang-vien/id<?=$cookie_id?>-courseOn<?=$rowc['course_id']?>.html"
                                    class="v_mb-edit"><img class="lazyload" src="/img/load.gif"
                                        data-src="../img/chinh-sua.svg" alt="???nh l???i">Ch???nh s???a</a></div>
                            <div class="v_mb-edit-div v_xoakh3" data-course="<?php echo $rowc['course_id'];?>"><button class="v_mb-edit v_xoakh2" data-course="<?php echo $rowc['course_id'];?>" onclick="v_del_course(this)">X??a kh??a h???c</button></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div id="v_chuyentrang">
                    <a class="v_chuyen-trang-div" href="<?php if($p == 1){
                            echo '/giang-vien-khoa-hoc-online/id' . $_COOKIE['user_id'] . '-p1.html';
                        }else{
                            echo '/giang-vien-khoa-hoc-online/id' . $_COOKIE['user_id'] . '-p' . ($p-1).'.html';
                        } ?>">&lt;</a>
                    <?php for ($i = 0; $i  < $pa ; $i++) { ?>
                    <a href="/giang-vien-khoa-hoc-online/id<?php echo $_COOKIE['user_id']; ?>-p<?php echo $i  + 1; ?>.html"
                        class="v_chuyen-trang-div <?php if($p == $i+1){
                            echo "p_active";
                        } ?>" class="v_tranght"><?php echo $i + 1; ?></a>
                    <?php } ?>
                    <a href="<?php if($p == $i){
                            echo '/giang-vien-khoa-hoc-online/id' . $_COOKIE['user_id'] . '-p'. ($i) .'.html';
                        }else{
                            echo '/giang-vien-khoa-hoc-online/id' . $_COOKIE['user_id'] . '-p' . ($p+1).'.html';
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
            var type = "online";
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
                        if (data == "Kh??ng t??m th???y b???n ghi") {
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

            var type2 = "online";
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
        var n = confirm("B???n c?? mu???n x??a kh??a h???c n??y kh??ng");
        if (n == true) {
            $.ajax({
                url: '../ajax/v_hide_course_gv.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    course_id: $(e)[0].dataset.course,
                    course_type: 2,
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
                    alert("C?? l???i x???y ra. Vui l??ng th??? l???i");
                }
            });
        }
    }
    </script>
</body>

</html>