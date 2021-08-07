<?php
require_once '../code_xu_ly/h_manager_GV.php';
$db_count = new db_query("SELECT count(history_point_id) as total FROM history_point WHERE center_teacher_id =" . $cookie_id);
$rowCount = mysql_fetch_array($db_count->result);
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

if (!isset($_GET['p'])) {
    $p = 1;
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
    <style>
    #v_QL-hv {
        color: #1B6AAB;
    }

    #v_sidebar-1 {
        display: block;
    }

    #v_hv-mua-tu-diem {
        color: #1B6AAB;
    }
    #v_sidebar-tb-1 {
        display: block;
    }
    .v_sidebar-menu:nth-child(2) button{
        color: #1B6AAB;
    }
    #v_sidebar_tb-1{
        display: block;
    }
    #v_sidebar_tb-1 li:nth-child(2) a{
        color: #1B6AAB;
    }
    .v_point-name {
        color: #1B6AAB;
        font-weight: 500;
        font-size: 14px;
    }

    .v_point-tx {
        font-size: 14px;
        font-weight: 400;
        color: #00000061;

    }

    .v_bacham {
        width: 10%;
    }

    .v_bacham-xt {
        color: #1B6AAB;
        font-size: 14px;
        font-weight: 400;
    }

    .v_union {
        border: none;
        background: white;
    }

    ::placeholder {
        color: #185DA0;
        font-weight: 400;
        font-size: 12px;
    }

    #v_sidebar-tb-1{
        display: block;
    }
    .v_monhoc-qt{
        white-space: normal;
        width: 40%;
    }
    @media (max-width: 1365px) {
        .v_monhoc-qt {
            font-weight: 500;
        }

    }

    @media (max-width: 767px) {
        .v_content-mb-thongtin {
            height: 32px;
            border-radius: 16px;
        }

        .v_content-mb-span {
            font-weight: 700;
            font-size: 12px;
            color: #1B6AAB;
        }

        .v_xemthem2{
            height: 45px;
            margin-left: 5%;
            background-size: auto 32px;
            margin-bottom: 16px;
            padding-top: 10px;
            padding-bottom: 10px;
            background: #1B6AAB;
        }

        .v_xemthem2 .v_content-mb-span{
            color: white;
            font-size:16px;
        }

        .v_content-mb{
            padding-bottom: 26px;
        }
        .v_content-mb-thongtin2{
            height: auto;
        }
    }
    </style>
    <title>Danh sách học viên mua từ điểm</title>
</head>

<body onclick="v_Function()">
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
                $actions = 'muatudiem';
                require_once '../includes/v_inc_GV_bo-loc.php';
                ?>
                <div id="content">
                    <div id="v_content-title">
                        <div class="v_content-title-div"></div>
                        <div class="v_content-title-div">TÊN HỌC VIÊN</div>
                        <div class="v_content-title-div">MÔN HỌC QUAN TÂM</div>
                        <div class="v_content-title-div">ĐỊA CHỈ</div>
                        <div class="v_content-title-div v_bacham"><img src="../img/More.png" alt="Ảnh lỗi"></div>
                    </div>
                    <?php
                     $db_point = new db_query("SELECT * FROM history_point INNER JOIN users ON user_student_id=users.user_id INNER JOIN city ON users.cit_id=city.cit_id Where center_teacher_id = '$cookie_id' ORDER BY history_point_id DESC LIMIT 0,10");
                    if (mysql_num_rows($db_point->result)==0) {
                                echo '<div >Chưa có dữ liệu</div>';
                    }else{
                    while ($row = mysql_fetch_assoc($db_point->result)) {
                    ?>
                    <div class="v_noidungkh" id="v_noidungkh-">
                        <button class="v_content-list v_union"><img src="../img/Union.svg" alt="Ảnh lỗi"></button>
                        <div class="v_content-list v_monhoc">
                            <a href="<?php echo urlDetail_student($row['user_id'],$row['user_slug']); ?>" class="v_point-name"><?=$row['user_name']?></a>
                            <p class="v_point-tx"><?=$row['user_mail']?></p>
                            <p class="v_point-tx"><?=$row['user_phone']?></p>
                        </div>
                        <div class="v_content-list v_monhoc-qt">
                            <?
                                $cat = explode(',', $row['cate_id']);
                                $j = '';
                                $i = 0;
                                foreach ($cat as $value) {
                                    $db_cate = new db_query("SELECT cate_name FROM categories WHERE cate_id =" . $value);
                                    $a = mysql_fetch_assoc($db_cate->result);
                                    //echo $a['cate_name'];
                                    if ($i == count($cat) - 1) {
                                        echo $j . $a['cate_name'];
                                    } else {
                                        echo $j . $a['cate_name'] . ', ';
                                    }
                                    $i++;
                                }
                                ?>
                        </div>
                        <div class="v_content-list">
                            <?
                                $db_city = new db_query("SELECT cit_name FROM city where cit_id =" . $row['district_id']);
                                $city = mysql_fetch_assoc($db_city->result);
                                echo $city['cit_name'];
                                echo ' - ' . $row['cit_name'];
                                ?>
                        </div>
                        <div class="v_content-list v_bacham">
                            <a href="<? echo urlDetail_student($row['user_id'], $row['user_slug']); ?>"
                                class="v_bacham-xt">Xem thêm</a>
                        </div>
                    </div>
                    <?php }
                } ?>
                </div>

                <?php $db_point2 = new db_query("SELECT * FROM history_point INNER JOIN users ON user_student_id=users.user_id INNER JOIN city ON users.cit_id=city.cit_id Where center_teacher_id = '$cookie_id' ORDER BY history_point_id DESC LIMIT 0,10");

                    while ($row2 = mysql_fetch_assoc($db_point2->result)) { ?>
                <div class="v_content-mb">
                    <div class="flex v_info-all v_content-mb-div">
                        <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tên học viên :</span>
                            <?=$row2['user_name']?></div>
                        <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mail :
                            </span><?=$row2['user_mail']?>
                        </div>
                        <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số điện thoại : </span>
                            <?=$row2['user_phone']?>
                        </div>
                        <div class="v_content-mb-thongtin v_content-mb-thongtin2"><span class="v_content-mb-span">Môn học quan tâm : </span>
                            <?
                                $cat1 = explode(',', $row2['cate_id']);
                                $j1 = '';
                                $i1 = 0;
                                for ($i = 0; $i < count($cat1); $i++) {
                                    $db_cate1 = new db_query("SELECT cate_name FROM categories WHERE cate_id =" . $cat1[$i]);
                                    $row1 = mysql_fetch_assoc($db_cate1->result);
                                    if ($i == count($cat1) - 1) {
                                        $j1 = $j1 . $row1['cate_name'];
                                    }else{
                                        $j1 = $j1 . $row1['cate_name'] .", ";
                                    }
                                }
                                echo $j1;
                                ?>
                        </div>
                        <div class="v_content-mb-thongtin">
                            <span class="v_content-mb-span">Địa chỉ :</span>
                            <?
                                $db_city1 = new db_query("SELECT cit_name FROM city where cit_id =" . $row2['district_id']);
                                $city1 = mysql_fetch_assoc($db_city1->result);
                                echo $city1['cit_name'];
                                echo ' - ' . $row2['cit_name'];
                                ?>
                        </div>
                        </div>
                        <a class="v_content-mb-thongtin v_xemthem2" href="<? echo urlDetail_student($row2['user_id'], $row2['user_slug']); ?>">
                            <span class="v_content-mb-span">
                                Xem thêm
                            </span>
                        </a>
                </div>
                <?php } ?>
                <div id="v_chuyentrang">
                    <a class="v_chuyen-trang-div" href="<?php if($p == 1){
                            echo '/danh-sach-hoc-vien-mua-tu-diem/id' . $_COOKIE['user_id'] . '-p1.html';
                        }else{
                            echo '/danh-sach-hoc-vien-mua-tu-diem/id' . $_COOKIE['user_id'] . '-p' . ($p-1).'.html';
                        } ?>">&lt;</a>
                    <?php for ($i = 0; $i  < $pa ; $i++) { ?>
                    <a href="/danh-sach-hoc-vien-mua-tu-diem/id<?php echo $_COOKIE['user_id']; ?>-p<?php echo $i  + 1; ?>.html"
                        class="v_chuyen-trang-div <?php if($p == $i+1){
                            echo "p_active";
                        } ?>"><?php echo $i + 1; ?></a>
                    <?php } ?>
                    <a href="<?php if($p == $i){
                            echo '/danh-sach-hoc-vien-mua-tu-diem/id' . $_COOKIE['user_id'] . '-p'. ($i) .'.html';
                        }else{
                            echo '/danh-sach-hoc-vien-mua-tu-diem/id' . $_COOKIE['user_id'] . '-p' . ($p+1).'.html';
                        } ?>" class="v_chuyen-trang-div">&gt;</a>
                </div>
                <!-- End: content -->

            </div>
            <!-- End: main -->
        </div>
    </div>

    <!-- Begin: foooter -->
    <?php require_once("../includes/h_inc_footer.php"); ?>
    <!-- End: footer -->
    <script src="../js/bootstrap.min.js?v=<?=$version?>"></script>
    <script src="../js/v-main.js?v=<?=$version?>"></script>
    <script type="text/javascript">
        $("#keywords").keyup(function() {
            var keyword = $("#keywords").val();
        $.ajax({
            url: '../ajax/v_GV_search_hv_point.php',
            type: 'POST',
            dataType: 'json',
            data: {
                keyword: keyword
            },
            success: function (data) {
                $(".v_noidungkh").remove();
                $("#point_no").remove();
                $(".v_content-mb").remove();
                $("#content").append(data.html);
                $("#v_chuyentrang").prev().append(data.htmlMB);
            }
        });
        
        });
    </script>
</body>

</html>