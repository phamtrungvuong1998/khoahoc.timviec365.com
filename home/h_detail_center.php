<?php
require_once '../code_xu_ly/h_home.php';
require_once '../includes/v_insert_info.php';
$center_id = getValue('center_id', 'int', 'GET', '');
$qrCenter = new db_query("SELECT * FROM users JOIN user_center ON user_center.user_id = users.user_id  WHERE users.user_id = '$center_id'");
$rowCenter = mysql_fetch_array($qrCenter->result);
if (isset($_COOKIE['user_id'])) {
    if (!isset($_COOKIE['user_id'])) {
        $active = 0;
    } else {
        $active = 1;
    }

    $qrSave = new db_query("SELECT * FROM save_center WHERE user_student_id = '$cookie_id' AND center_id = '$center_id'");
    $rowSave = mysql_fetch_array($qrSave->result);

    if ($rowSave == "") {
        $btn_save = "THEO DÕI";
    } else {
        $btn_save = "HỦY THEO DÕI";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <title><?php echo $rowCenter['user_name']; ?></title>
    <link rel="preload" href="/css/h_detail_center.css?v=<?=$version?>" as="style">
    <?require_once '../includes/h_inc_css.php';?>
    <link rel="stylesheet" href="../css/h_detail_center.css?v=<?=$version?>">

</head>

<body>
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
                    <li><?php echo $rowCenter['user_name']; ?></li>
                </ol>
            </div>
        </div>
        <!--Detail Main-->
        <div class="container">
            <?
            if (isset($_COOKIE['user_id']) && $cookie_type == 1) {
            ?>
            <button id="v_save_center" value="<?php echo $btn_save; ?>"
                onclick="v_save_center(<?php echo $center_id; ?>, <?php echo $cookie_id; ?>,<?php echo $active; ?>)"><?php echo $btn_save; ?></button>
            <?php
            } else{
            ?>
            <button id="v_save_center" data-target="#modal-login">THEO DÕI</button>
            <?php
            }
            ?>
            <div id="main-detail">
                <h2 class="title1"><?php echo $rowCenter['user_name']; ?></h2>
                <h2 class="title2">Giới thiệu</h2>
                <div class="intro">
                    <p dir="ltr" id=""><span class="introtitle"><?php echo $rowCenter['user_name']; ?></span>
                        <?= $rowCenter['center_intro']; ?></p>
                    <div class="centerava"><img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                            class="imgtitle1 lazyload" src="/img/load.gif"
                            data-src="../img/avatar/<?= $rowCenter['user_avatar']; ?>"></div>
                    <?
                    $db_img = new db_query("SELECT * FROM user_center_img Where user_id = $center_id");
                    while ($row_img = mysql_fetch_assoc($db_img->result)) {
                    ?>
                    <div class="content1"><img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                            class="imgtitle1 lazyload" src="/img/load.gif"
                            data-src="../img/uploads/<?= $row_img['center_img']; ?>"></div>
                    <?
                    }
                    ?>
                    <div class="introtitle2" id="xemthem1">
                        <img class="imgtitle2 lazyload" src="/img/load.gif" width="15px" height="8px"
                            data-src="../img/image/down.svg">
                        <span> Xem thêm ảnh</span>
                    </div>
                </div>
                <div id="course-central">
                    <?
                    $qr1 = new db_query("SELECT * FROM courses JOIN categories ON courses.cate_id = categories.cate_id JOIN levels ON courses.level_id = levels.level_id
                                        WHERE user_id = $center_id AND courses.price_listed != -1 AND courses.hide_course = 1 AND courses.accept = 1 ORDER BY courses.course_id DESC");
                    while ($rowc = mysql_fetch_array($qr1->result)) {
                        $course_id = $rowc['course_id'];
                        if ($rowc['course_type'] == 1) {
                            $course_link = urlDetail_courseOffline($rowc['course_id'],$rowc['course_slug']);
                        }else if ($rowc['course_type'] == 2) {
                            $course_link = urlDetail_courseOnline($rowc['course_id'],$rowc['course_slug']);
                        }
                    ?>
                    <div class="product-course">
                        <div class="top-course">
                            <div class="prd-title">
                                <h3><a href="<?=$course_link?>"><?= $rowc['course_name'] ?></a></h3>
                            </div>
                            <div class="prd-topic">
                                <div class="prd-topic1">
                                    <div class="prd-topica"><img class="lazyload" width="20px" height="20px"
                                            src="/img/load.gif" data-src="../img/image/book2.svg">
                                        <?=$rowc['level_name']?>
                                    </div>
                                    <div class="prd-topica"><img class="lazyload" src="/img/load.gif" width="20px"
                                            height="20px" data-src="../img/image/clock2.svg"><?= $rowc['month_study'] ?>
                                        tháng</div>
                                </div>
                                <?
                                        $db_pr1 = new db_query("SELECT * from advantages_center limit 2");
                                        $array = [];
                                        $advantages = explode(",",$rowc['advantages_id']);
                                        if ($rowc['advantages_id']>0) {
                                            echo '<div class="prd-topic2">';
                                            while ($rowhome = mysql_fetch_array($db_pr1->result)) {
                                                $advantages_id = $rowhome['advantages_id'];
                                                $advantages_name = $rowhome['advantages_name'];
                                                if (in_array($advantages_id, $advantages)) {
                                                    $links = '<div class="prd-topica"><img width="20px" height="20px" class="lazyload" src="/img/load.gif" data-src="../img/image/paper.svg">'.$advantages_name.'</div>';
                                                    array_push($array, $links);
                                                }
                                            }
                                        echo implode(" ", $array);
                                        echo '</div>';
                                    }
                                    ?>
                            </div>
                            <div class="prd-buy">
                                <span><?php
                                if ($rowc['price_promotional'] == -1) {
                                    echo number_format($rowc['price_listed']);
                                }else{
                                    echo number_format($rowc['price_promotional']); 
                                }
                                ?> đ</span>
                                <?
                                    if (isset($cookie_id) && $cookie_type == 1) {
                                        $db_order = new db_query("SELECT course_id,user_student_id FROM orders WHERE user_student_id = $cookie_id AND course_id=$course_id");
                                        $db_order2 = new db_query("SELECT course_id,user_student_id FROM order_student_common WHERE user_student_id = $cookie_id AND course_id=$course_id");
                                        if (mysql_num_rows($db_order->result) > 0 || mysql_num_rows($db_order2->result) > 0 ) {
                                        echo '<div class="damua">
                                            <a>KHÓA HỌC ĐÃ MUA</a>
                                        </div>';
                                        } else {
                                ?>
                                <div class="prd-buy1">
                                    <a href="<?= urlOrders($cookie_id, $course_id) ?>" class="muangay">MUA NGAY</a>
                                    <a href="<?= urlOrderCommon($course_id) ?>" class="muachung">MUA CHUNG</a>
                                </div>
                                <div class="addcart">
                                    <?php
                                    $qrCart = new db_query("SELECT cart_id FROM carts WHERE user_student_id = $cookie_id AND course_id = $course_id");
                                    if (mysql_num_rows($qrCart->result) == 0) {
                                        echo '<a onclick="addCart(<?php echo $course_id; ?>)">THÊM VÀO GIỎ HÀNG</a>';
                                    }else{
                                        echo '<a>ĐÃ THÊM VÀO GIỎ HÀNG</a>';
                                    }
                                    ?>
                                    
                                </div>
                                <?php
                                        }
                                    } else {
                                        ?>
                                <div class="prd-buy1">
                                    <a data-toggle="modal" data-target="#modal-login" class="muangay">MUA NGAY</a>
                                    <a data-toggle="modal" data-target="#modal-login" class="muachung">MUA CHUNG</a>
                                </div>
                                <div class="addcart">
                                    <a data-toggle="modal" data-target="#modal-login">THÊM VÀO GIỎ HÀNG</a>
                                </div>
                                <?php
                                    }
                                    ?>
                            </div>
                            <div data-toggle="collapse" data-target="#bottomcourse<?= $course_id ?>" class="xemchitiet"
                                id="xemchitiet<?= $course_id ?>">
                                <span>Xem chi tiết</span><img class="lazyload" src="/img/load.gif" width="15px"
                                    height="8px" data-src="../img/image/down.svg">
                            </div>
                        </div>
                        <div class="bottom-course" id="bottomcourse<?= $course_id ?>">
                            <div class="title">
                                <span>Thông tin chung</span>
                            </div>
                            <ul class="course-info">
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/image/numstudent.svg">
                                    <?php
                                    $num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
                                    $num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");
                                    echo mysql_num_rows($num2->result) + mysql_num_rows($num3->result);
                                ?>
                                    học viên</li>
                                <li><img class="lazyload" src="/img/load.gif" width="20px" height="20px"
                                        data-src="../img/image/clock.svg"><?= $rowc['time_learn'] ?> buổi</li>
                                <li><img class="lazyload" src="/img/load.gif" width="20px" height="20px"
                                        data-src="../img/image/lession.svg"><?= $rowc['course_slide'] ?> bài</li>
                                <li><img class="lazyload" src="/img/load.gif" width="20px" height="20px"
                                        data-src="../img/image/video1.svg">Môn học
                                    : <?= $rowc['cate_name'] ?></li>
                                <?php
                                    $qr2 = new db_query("SELECT tag_name FROM tags JOIN courses ON tags.tag_id = courses.tag_id WHERE courses.course_id = $course_id");
                                    if (mysql_num_rows($qr2->result) > 0) {
                                        $rowt = mysql_fetch_array($qr2->result);
                                        echo '<li><img width="20px" height="20px" src="../img/image/book.svg">Môn học chi tiết :' . $rowt['tag_name'];
                                    } else {
                                        echo '';
                                    }

                                    ?>

                                </li>
                                <li><img class="lazyload" src="/img/load.gif" width="20px" height="20px"
                                        data-src="../img/image/tailieu.svg"><?= $rowc['course_slide'] ?> tài liệu</li>
                                <!-- <li><img src="../img/image/dailydate.svg">23/02/2021</li> -->
                            </ul>
                            <div class="title">
                                <span>Nội dung khóa học</span>
                                <p><?= $rowc['course_describe'] ?>.</p>
                            </div>
                            <!-- <div class="donglai" id="donglai">
                                <span>Đóng lại</span><img src="../img/image/up.svg">
                            </div> -->
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="student-rating">
                    <div class="title">
                        <h2>ĐÁNH GIÁ TỪ HỌC VIÊN</h2>
                        <?
                        if ($cookie_type == 1) {
                            $qr66 = new db_query("SELECT user_student_id FROM rate_center WHERE user_student_id = $cookie_id AND center_id = $center_id");
                            if(mysql_num_rows($qr66->result) == 0){
                                echo '<button data-toggle="modal" id="v_write_comment" data-target="#comment-rate">VIẾT ĐÁNH GIÁ</button>';
                            }else{
                                echo '<button data-toggle="modal" id="v_write_comment" data-target="#comment-rate" style="display: none;">VIẾT ĐÁNH GIÁ</button>';
                            }
                        }else{
                            echo '<button data-toggle="modal" id="v_write_comment" data-target="#modal-login">VIẾT ĐÁNH GIÁ</button>';
                        }
                        ?>
                    </div>
                    <div class="danhgia">
                        <span class="danhgiaspan">
                            <?
                            $qr6 = new db_query("SELECT * FROM rate_center WHERE center_id = $center_id");
                            echo mysql_num_rows($qr6->result);

                            ?>
                            đánh giá
                        </span>
                    </div>

                    <div class="udiem-tag">
                        <span class="udiem-mucdo">Ưu điểm nổi bật</span>
                        <div class="all-udiem">
                            <?
                                $db_pr2 = new db_query("SELECT * from advantages_center");
                                $array2 = [];
                                $advantages2 = explode(",",$rowCenter['advantages_id']);
                                if ($rowCenter['advantages_id']>0) {
                                    while ($rowhome = mysql_fetch_array($db_pr2->result)) {
                                        $advantages_id = $rowhome['advantages_id'];
                                        $advantages_name = $rowhome['advantages_name'];
                                        if (in_array($advantages_id, $advantages2)) {
                                            $links = '<div class="udiems"><span>'.$advantages_name.'</span></div>';
                                            array_push($array2, $links);
                                        }
                                    }
                                echo implode(" ", $array2);
                            }
                            ?>
                        </div>
                    </div>
                    <?
                    include '../includes/h_ratebar_center.php';
                    ?>
                </div>
            </div>
            <div class="student-comment">
                <div class="title">
                    <h2>NHẬN XÉT HỌC VIÊN</h2>
                </div>
                <div class="list-comment">
                    <?
                    $qr5 = new db_query("SELECT * FROM users JOIN rate_center ON users.user_id = rate_center.user_student_id WHERE center_id = $center_id");
                    if (mysql_num_rows($qr5->result) == 0) {
                        echo "<div class='no-cmt'>Hiện chưa có bình luận</div>";
                    }else{
                    while ($row5 = mysql_fetch_array($qr5->result)) {
                        $rate_id = $row5['rate_id']; 
                        $user_student_id = $row5['user_student_id'];
                    ?>
                    <div class="cmt-student" id="cmt-student<?= $rate_id ?>">
                        <div class="std-img">
                            <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload"
                                src="/img/load.gif" data-src="../img/avatar/<?= $row5['user_avatar'] ?>">
                        </div>
                        <div class="std-content">
                            <h4><?= $row5['user_name'] ?></h4>
                            <div class="stdstar">
                                <?
                                $qrrate = new db_query("SELECT Count(*) as total FROM rate_center WHERE user_student_id = $user_student_id");
                                $rowcount=mysql_fetch_array($qrrate->result);
                                $numrate = $rowcount['total'];
                                $qrsum = new db_query("SELECT * FROM `rate_center` WHERE user_student_id = $user_student_id");
                                $rowsum = mysql_fetch_array($qrsum->result);
                                $sumall = ($rowsum['teacher']+$rowsum['place_class'] + $rowsum['infrastructure']+$rowsum['student_number'] + $rowsum['enviroment']+$rowsum['student_care'] +$rowsum['practice']+$rowsum['pround_price'] + $rowsum['self_improvement']+$rowsum['ready_introduct'])/10;
                                $total_rate = $sumall/$numrate;
                                if ($total_rate == 5) {
                                    echo '
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                    ';
                                } elseif ($total_rate < 5 && $total_rate >= 4) {
                                    echo '
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                    ';
                                } elseif ($total_rate < 4 && $total_rate >= 3) {
                                    echo '
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                    ';
                                } elseif ($total_rate < 3 && $total_rate >= 2) {
                                    echo '
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                    ';
                                } elseif ($total_rate < 2 && $total_rate >= 1) {echo '
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                    ';
                                } else {
                                    echo '';
                                }
                                ?>
                                <span><?php
                                $time = strtotime($row5['created_at']);
                                echo date('d-m-Y h:i:s',$time);
                                 ?></span>
                            </div>
                            <p><?= $row5['comment_experiment'] ?></p>
                            <div class="answer">
                                <button id="clickrep" onclick="clickrep(<?= $rate_id ?>)">Phản hồi</button>
                                <?php
                                if ($row5['user_student_id'] == $_COOKIE['user_id']) {
                                    echo '<button id="delcmt" data-rate_id="'.$rate_id.'" onclick="del_comt(this)">Xóa</button>';
                                }
                                ?>    
                            </div>

                            <div class="reply-content" id="reply-content<?= $rate_id ?>">
                                <?php
                                    $qr8 = new db_query("SELECT * FROM users JOIN rep_rate_center ON users.user_id = rep_rate_center.user_student_id WHERE rate_id = $rate_id");
                        while ($row8 = mysql_fetch_array($qr8->result)) {
                            $rep_id = $row8['rep_id']; ?>
                                <div class="studentrep" id="studentrep<?= $rep_id ?>">
                                    <div class="std-img">
                                        <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                            class="lazyload" src="/img/load.gif"
                                            data-src="../img/avatar/<?= $row8['user_avatar'] ?>">
                                    </div>
                                    <div class="std-content">
                                        <h4><?= $row8['user_name'] ?> <span><?= $row8['created_at'] ?> </span></h4>
                                        <p><?= $row8['comment_rep'] ?></p>
                                        <div class="answer">
                                            <button id="delcmt" data-rep_id="<?= $rep_id ?>"
                                                onclick="del_repcomt(this)">Xóa</button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                        } ?>
                            </div>
                        </div>
                        <div class="reply-comment" id="repling<?= $rate_id ?>">
                            <textarea name="comment_rep" id="comment_rep<?= $rate_id ?>"></textarea>
                            <div class="divreply">
                                <button data-center_id="<?= $center_id ?>" data-student_id="<?= $cookie_id ?>"
                                    data-rate_id="<?= $rate_id ?>" data-avatar="<?= $row['user_avatar'] ?>"
                                    data-user_name="<?= $row['user_name'] ?>" onclick="rep_comment(this)">GỬI</button>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    }
                    ?>
                </div>
            </div>
            <div class="address">
                <span class="spanaddress">ĐỊA ĐIỂM</span>
                <div class="address1">
                    <div id="map"></div>
                    <div class="address2">
                        <?
                        $cit_id = $rowCenter['cit_id'];
                        $qr4 = new db_query("SELECT * FROM user_center_basis JOIN city ON city.cit_id = user_center_basis.cit_id WHERE user_id = $center_id");

                        while ($rowb = mysql_fetch_array($qr4->result)) {
                            $dis = $rowb['district_id'];
                            $db_dis = new db_query("SELECT * FROM city WHERE cit_id = $dis");
                            $r_dis = mysql_fetch_assoc($db_dis->result);
                        ?>

                        <span><?= $rowb['cit_name'] ?></span>
                        <div class="addresscont">
                            <div class="house-address">
                                <p class="house-address1">Cơ sở tại: <?= $rowb['center_basis_address'] ?></p>
                                <p class="house-address2"><img class="lazyload" src="/img/load.gif"
                                        data-src="../img/image/markerblue.svg"><?= $r_dis['cit_name'] ?> -
                                    <?= $rowb['cit_name'] ?></p>
                            </div>
                        </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--END: MAIN-->


    <!-- FOOTER -->
    <?php
    include '../includes/h_popup_dangnhap2.php';
    include '../includes/h_popup_detailcenter.php';
    include '../includes/h_inc_footer.php';
    ?>
    <!-- END: FOOTER -->
    <script src="../js/v_search.js?v=<?=$version?>"></script>
    <script src="../js/detail_center.js?v=<?=$version?>"></script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAHrQFnYhj0ksrdt_V7SiMzZlR01FNuRo&callback=initMap"
        type="text/javascript"></script>
</body>
<script type="text/javascript">
    function addCart(course_id) {
        var n = confirm("Bạn có muốn thêm khóa học này vào giỏ hàng không ?");
        if (n == true) {
            $.ajax({
             url: '../ajax/v_create_cart.php',
             type: 'GET',
             dataType: 'json',
             data: {
                course_id: course_id,
            },
            success: function (data) {
                if (data.type == true) {
                    alert("Thêm vào giỏ hàng thành công");
                    $(".addcart").html('<a>ĐÃ THÊM VÀO GIỎ HÀNG</a>');
                }
            },
            error: function () {
             alert("Có lỗi xảy ra. Vui lòng thử lại");
         }
     });
        }
    }
</script>
</html>