<?php
require_once '../code_xu_ly/h_home.php';

$page = getValue('page','int','GET','');
if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_type'])) {
    $user_id = $_COOKIE['user_id'];
    $user_type = $_COOKIE['user_type'];
}else{
    $user_id = 0;
    $user_type = 0;
}

$number_page = 16;
if ($page == '') {
    $v_start = 0;
    $v_end = 16;
}else{
    $v_start = $number_page * ($page - 1);
    $v_end = 16;
}

$qrNumberPage = new db_query("SELECT user_id FROM users WHERE user_type = 1 AND user_avatar != '0' AND user_birth != '0000-00-00' AND cit_id != '0' AND cate_id != '0'");

$rowNumberPage = mysql_num_rows($qrNumberPage->result);

$v_number_page = ceil($rowNumberPage/16);

$qrHV = new db_query("SELECT * FROM users INNER JOIN city ON users.cit_id = city.cit_id WHERE users.user_avatar != '0' AND users.user_birth != '0000-00-00' AND users.cit_id != '0' AND users.cate_id != '0' AND users.user_type = 1 AND users.user_id != $user_id LIMIT $v_start,$v_end");


$v_qrCate = new db_query("SELECT `cate_id`,`cate_name`FROM `categories`");

$v_array_keyword = [];
while ($v_rowCate = mysql_fetch_array($v_qrCate->result)) {
    $v_array_keyword[$v_rowCate['cate_id']] = 0;
}

$qrHVAll = new db_query("SELECT cate_id FROM users WHERE user_avatar != '0' AND user_birth != '0000-00-00' AND cit_id != '0' AND cate_id != '0' AND user_type = 1");

if (!isset($_COOKIE['user_type'])){
    $lg = 0;
}else{
    $lg = 1;
}

//Lấy từ khóa phổ biến


while ($rowHVAll = mysql_fetch_array($qrHVAll->result)){
    $arrayCate = explode(",", $rowHVAll['cate_id']);
    for ($i=0; $i < count($arrayCate); $i++) { 
        $cate_id = $arrayCate[$i];
        $v_array_keyword[$cate_id]++;
    }
}

arsort($v_array_keyword);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <title>Danh sách học viên</title>
    <?require_once '../includes/h_inc_css.php';?>
    <link rel="stylesheet" href="../css/h_student.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/v_popup_choose_login.css?v=<?=$version?>">
    <style>
        #v_category-student {
            display: flex;
            flex-wrap: wrap;
        }
        .v_cate_name {
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 20px;
            -webkit-line-clamp: 2;
            display: -webkit-box;
            -webkit-box-orient: vertical;
        }

        .item-img {
            cursor: pointer;
        }

        .v_name {
            color: black;
        }

        .all-keyword {
            width: auto;
        }

        .all-keyword a:hover {
            background: orange;
        }

        .page-link:hover {
            background: #1B6AAB;
            color: white;
        }
        .active{
            color: white !important;
            background: #1B6AAB !important;
        }
        .page-item:hover .page_arrow{
            color: white;
        }


        @media (max-width: 1365px) {
            .all-student {
                flex-basis: 45%;
                margin-left: 2.5%;
                margin-right: 2.5%;
            }
        }

        @media (max-width: 767px) {
            .all-student {
                flex-basis: 100%;
            }
        }
    </style>
</head>

<body style="position: relative;">
    <div id="popup_choose_login" style="display: none;">
        <center id="popup_choose_login_detail">
            <div id="v_choose_login">LỰA CHỌN ĐĂNG NHẬP</div>
            <div><button class="v_login_gv_tt" data-type="2">GIẢNG VIÊN</button></div>
            <div><button class="v_login_gv_tt" data-type="3">TRUNG TÂM</button></div>
        </center>
    </div>
    <!-- HEADER -->
    <?php
    include '../includes/h_inc_header.php';
    ?>
    <!-- END: HEADER -->

    <!--SEARCH-->
    <?php
    include '../includes/h_inc_search.php';
    ?>
    <!--END: SEARCH-->

    <!-- MAIN -->
    <main>
        <div id="breadcrumb">
            <div class="container">
                <ol>
                    <li><a href="/">Trang chủ</a></li>
                    <li style="font-size: 18px;">></li>
                    <li>Danh sách học viên</li>
                </ol>
            </div>
        </div>
        <!--Detail Main-->
        <div class="container">
            <div id="category-student">
                <div id="v_category-student">
                    <?php 
                    while ($rowHV = mysql_fetch_array($qrHV->result)){
                        $v_student_id = $rowHV['user_id'];
                        $v_qrSave = new db_query("SELECT `save_id` FROM `save_student` WHERE `user_student_id` = '$v_student_id' AND `user_teacher_id` = '$user_id'");
                        $v_rowSave = mysql_fetch_array($v_qrSave->result);
                        ?>
                        <div class="all-student">
                            <div class="student-item">
                                <div class="item">
                                    <?php
                                    if($cookie_type == 2 || $cookie_type == 3 || $cookie_type == 0){
                                        ?>
                                        <img src="<?php 
                                        if(!isset($v_rowSave['save_id'])){
                                            echo '../img/image/paperyellow1.svg';
                                            }else{
                                                echo '../img/paperyellow.svg';
                                            }
                                            ?>" class="item-img" id="item-img-<?php echo $rowHV['user_id']; ?>"
                                            onclick="item_img(<?php echo $rowHV['user_id']; ?>,<?php echo $lg; ?>)"
                                            alt="Ảnh lỗi">
                                        <?php }?>
                                    </div>
                                    <div class="item1">
                                        <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                        src="../img/avatar/<?php echo $rowHV['user_avatar']; ?>" alt="Ảnh lỗi">

                                        <h3><a href="<?php echo urlDetail_student($rowHV['user_id'],$rowHV['user_slug']); ?>"
                                            class="v_name"><?php echo $rowHV['user_name']; ?></a></h3>

                                        </div>
                                        <div class="item2">
                                            <ul>
                                                <?php 
                                                $arrayCate = explode(",", $rowHV['cate_id']);
                                                $cate_name = '';
                                                for ($i=0; $i < count($arrayCate); $i++) { 
                                                    $cate_id = $arrayCate[$i];
                                                    $qrCate = new db_query("SELECT `cate_name` FROM `categories` WHERE `cate_id` = '$cate_id'" );
                                                    $rowCate = mysql_fetch_array($qrCate->result);
                                                    if ($i == count($arrayCate) - 1) {
                                                        $cate_name = $cate_name . $rowCate['cate_name'];
                                                    }else{
                                                        $cate_name = $cate_name . $rowCate['cate_name'] . ",";
                                                    }

                                                }
                                                ?>
                                                <li>
                                                    <div><img src="../img/image/video1.svg"></div>
                                                    <span class="v_cate_name">
                                                        Môn học quan tâm : <?php echo $cate_name; ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <div style="margin-left: 3px;"><img src="../img/image/dailydate.svg"></div>
                                                    <?php echo date("d-m-Y",$rowHV['created_at']); ?>
                                                </li>
                                                <li>
                                                    <div><img src="../img/image/markerblue.svg"></div>
                                                    <?php echo $rowHV['cit_name']; ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } 
                            ?>
                        </div>
                        <div class="paginate-product">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <?php 
                                        if($page == 0){
                                            $page = 1;
                                        }
                                        if($page != 1 && $page != 0){
                                        ?>
                                        <a class="page-link" href="<?php 
                                                echo 'danh-sach-hoc-vien.html?page=' . ($page - 1);
                                            ?>" aria-label="Previous">
                                            <span class="page_arrow" aria-hidden="true">&laquo;</span>
                                        </a>
                                        <?php 
                                        }
                                        ?>
                                    </li>

                                    <?php for ($j=1; $j <= $v_number_page; $j++) {
                                        if($j == $page){
                                            $active = "active";
                                        }else{
                                            $active = "";
                                        }
                                    ?>
                                        <li class="page-item"><a class="page-link <?=$active?>"
                                        href="danh-sach-hoc-vien.html?page=<?php echo $j; ?>"><?php echo $j; ?></a>
                                    </li>
                                <? } ?>
                                <?php
                                if($page < $j - 1){
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php 
                                            echo 'danh-sach-hoc-vien.html?page=' . ($page + 1);
                                        ?>" aria-label="Next">
                                        <span class="page_arrow" aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div id="keyword">
                    <hr>
                    <h2>Từ khóa phổ biến</h2>
                    <?php
                    $k = 1;
                    foreach ($v_array_keyword as $key => $value) { 
                        $qrKeyword = new db_query("SELECT * FROM `categories` WHERE `cate_id` = '$key'");
                        $rowKeyword = mysql_fetch_array($qrKeyword->result);
                        if ($k <= 3) {
                            $value_old = $value;
                            ?>
                            <div class="all-keyword">
                                <a
                                href="<?=urlOnline_cate($rowKeyword['cate_id'], $rowKeyword['cate_slug']);?>"><?php echo $rowKeyword['cate_name']. ' ' . '(' . $value . ')'; ?></a>
                            </div>
                            <?php
                        }else if ($value_old == $value) {
                            $k--;
                            ?>
                            <div class="all-keyword">
                                <a
                                href="<?=urlOnline_cate($rowKeyword['cate_id'], $rowKeyword['cate_slug']);?>"><?php echo $rowKeyword['cate_name']. ' ' . '(' . $value . ')'; ?></a>
                            </div>
                            <?php
                        }else{
                            break;
                        }
                        $k++;
                    } 
                    ?>
                </div>
            </div>

        </main>
        <!--END: MAIN-->


        <!-- FOOTER -->
        <?php
        include '../includes/h_inc_footer.php';
        require_once '../includes/h_popup_dangnhap.php';
        ?>
        <!-- END: FOOTER -->
        <script src="../js/v_search.js?v=<?=$version?>"></script>
        <script type="text/javascript">
            $(".v_login_gv_tt").click(function() {
                $("#choose_login_input").val($(this)[0].dataset.type);
                $("#popup_choose_login").fadeOut('fast',function () {
                    $("#modal-login").modal("show");
                });
            });

            $("body").click(function() {
                if (event.target.id == "popup_choose_login") {
                    $("#popup_choose_login").fadeOut('fast');
                }
            });

            var user_type = <?php echo $user_type; ?>;
            if (user_type == 1) {
                console.log(111);
                $(".item-img").remove();
            }

            function item_img(n, lg) {
                if (lg == 0) {
                    $("#popup_choose_login").fadeIn('fast');
            // $("#modal-login").modal("show");
        } else if (lg == 1) {
            var id_item = "#item-img-" + n;
            if ($(id_item).attr("src") == "../img/image/paperyellow1.svg") {
                $(id_item).attr({
                    "src": "../img/paperyellow.svg"
                });
                $.get("../ajax/v_save_student.php", {
                    studentId: n,
                    status_save: 0
                }, function(data) {

                });
            } else {
                $(id_item).attr({
                    "src": "../img/image/paperyellow1.svg"
                });
                $.get("../ajax/v_save_student.php", {
                    studentId: n,
                    status_save: 1
                }, function(data) {

                });
            }
        }
    }

</script>
</body>

</html>