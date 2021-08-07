<?php
require_once '../code_xu_ly/h_manager_GV.php';
$db_count = new db_query("SELECT count(save_id) FROM save_student JOIN users ON users.user_id = save_student.user_student_id JOIN city ON users.cit_id = city.cit_id WHERE user_teacher_id = $cookie_id");
$rowCount = mysql_fetch_array($db_count->result);
$pa = $rowCount[0]/6;
$p = getValue('p','int','GET','');

$number_page = 6;

if (!isset($_GET['p']) || $p == 1) {
    $start = 0;
    $end = 6;
}else{
    $start = $number_page * ($p - 1);
    $end = 6;
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
    <link rel="stylesheet" href="../css/GV-hv-da-luu.css?v=<?=$version?>">
    <style>
        #v_chuyentrang {
            background: #E5E5E5;
            border: none;
        }

        #v_QL-hv {
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
        #v_sidebar_tb-1 li:nth-child(1) a{
            color: #1B6AAB;
        }
        #v_hv-da-luu {
            color: #1B6AAB;
        }

        #v_chuyentrang{
            background: none;
        }
        <?php
        if ($rowCount[0] == 0) {
        ?>
        #v_chuyentrang{
            display: none;
        }
        <?php      
        }
        ?>
    </style>
    <title>Danh sách học viên đã lưu</title>
</head>

<body>
    <div id="v_wrapper">
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
                <div id="content">
                    <?php 
                    $dbs = new db_query("SELECT * FROM save_student JOIN users ON users.user_id = save_student.user_student_id JOIN city ON users.cit_id = city.cit_id WHERE user_teacher_id = $cookie_id LIMIT $start,$end");
                    if (mysql_num_rows($dbs->result)==0) {
                        echo '<div class="emptys">Chưa có dữ liệu</div>';
                    }else{
                        while ($rows = mysql_fetch_array($dbs->result)) {
                            $cit_id = $rows['cit_id']; ?>
                            <div class="v_content-detail" id="v_noidungkh-<?=$rows['user_id'] ?>">
                                <hr class="v_content-detail-hr">
                                <center class="v_content-detail-img"><a href="<?php  echo urlDetail_student($rows['user_id'],$rows['user_slug']);?>"><img class="lazyload student_avatar" src="/img/load.gif" data-src="../img/avatar/<?=$rows['user_avatar']?>"
                                    onerror='this.onerror=null;this.src="/img/avatar/error.png";'></a></center>
                                    <div class="v_content-detail-name"><a href="<?php  echo urlDetail_student($rows['user_id'],$rows['user_slug']);?>"><?=$rows['user_name']?></a></div>
                                    <div class="v_content-detail-ND">
                                        <div class="v_content-detail-tx">
                                            <img class="lazyload" src="/img/load.gif" data-src="../img/MH-quan-tam.svg"
                                            alt="Ảnh lỗi">
                                            <span class="v_content-detail-span v_content-detail-span1">
                                                <span class="v_content-detail-span1-span">Môn học quan tâm :
                                                <?php
                                                $cate = explode(",", $rows['cate_id']);
                                                $db_cate = new db_query("SELECT * from categories");
                                                $array =[];
                                                if (isset($rows['cate_id'])) {
                                                    while ($rowcat = mysql_fetch_array($db_cate->result)) {
                                                        $cate_slug = $rowcat['cate_slug'];
                                                        $cate_id = $rowcat['cate_id'];
                                                        $cate_name = $rowcat['cate_name'];
                                                        if (in_array($cate_id, $cate)) {
                                                            array_push($array, $cate_name);
                                                        }
                                                    }
                                                    echo implode(", ", $array);
                                                } ?></span>
                                            </span>
                                        </div>
                                        <div class="v_content-detail-tx">
                                            <img class="lazyload" src="/img/load.gif" data-src="../img/ngay.svg" alt="Ảnh lỗi">
                                            <span class="v_content-detail-span"><?php
                                            echo date("d/m/Y", $rows['created_at']);
                                            ?></span>
                                        </div>
                                        <div class="v_content-detail-tx">
                                            <img class="lazyload" src="/img/load.gif" data-src="../img/dia-diem.svg" alt="Ảnh lỗi">
                                            <span class="v_content-detail-span">
                                                <?php
                                                $db_cit = new db_query("SELECT cit_name FROM city WHERE cit_parent = $cit_id");
                                                $rowcit = mysql_fetch_array($db_cit->result);
                                                echo $rowcit['cit_name']; ?>
                                                - <?=$rows['cit_name']?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="v_content-detail-btn">
                                        <a href="<?=urlDetail_student($rows['user_id'], $rows['user_slug'])?>"
                                            class="v_content-detail-xt">XEM THÊM</a>
                                            <a onclick="h_delete(<? echo $rows['save_id']; ?>)" class="v_content-detail-del">XÓA</a>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } ?>
                            <div id="v_chuyentrang">
                                <a class="v_chuyen-trang-div" href="<?php if($p == 1){
                                    echo '/danh-sach-hoc-vien-da-luu/id' . $_COOKIE['user_id'] . '-p1.html';
                                    }else{
                                        echo '/danh-sach-hoc-vien-da-luu/id' . $_COOKIE['user_id'] . '-p' . ($p-1).'.html';
                                    } ?>">&lt;</a>
                                    <?php for ($i = 0; $i  < $pa ; $i++) {
                                    ?>
                                        <a href="/danh-sach-hoc-vien-da-luu/id<?php echo $_COOKIE['user_id']; ?>-p<?php echo $i  + 1; ?>.html"
                                            class="v_chuyen-trang-div <?php if($p == ($i+1)){
                                                echo "p_active";
                                            } ?>"><?php echo $i + 1; ?></a>
                                        <?php } ?>
                                        <a href="<?php if($p == $i){
                                            echo '/danh-sach-hoc-vien-da-luu/id' . $_COOKIE['user_id'] . '-p'. ($i) .'.html';
                                            }else{
                                                echo '/danh-sach-hoc-vien-da-luu/id' . $_COOKIE['user_id'] . '-p' . ($p+1).'.html';
                                            } ?>" class="v_chuyen-trang-div">&gt;</a>
                            </div>
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
                            function h_delete(id) {
                                var n = confirm("Bạn có muốn xóa học viên đã lưu này không");
                                if (n == true) {
                                    $.ajax({
                                        url: "../ajax/h_ajax_xoahocvien.php",
                                        type: "post",
                                        data: {
                                            id: id
                                        },
                                        success: function() {
                                            location.reload();
                                        }
                                    });
                                }
                            }
                        </script>
                    </body>

                    </html>