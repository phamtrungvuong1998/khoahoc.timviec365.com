<?php
include '../includes/v_insert_TT.php';
$db_courses = new db_query("SELECT * FROM courses WHERE user_id = '$user_id'");
$a = 0;
$b = 0;
$c = 0;
$common = 0;
while ($row_courses = mysql_fetch_assoc($db_courses->result)) {
    $id = $row_courses['course_id'];
    if ($row_courses['course_type'] == 2) {
        $db_orders = new db_query("SELECT * FROM orders WHERE course_id = '$id'");
        $dem = 0;
        $i = 0;
        $j = 0;
        while ($row1 = mysql_fetch_assoc($db_orders->result)) {
            if ($dem >= 19) {
                $i += 1;
            } else {
                $j += 1;
            }
            $dem++;
        }
        $a += $i;
        $b += $j;
    }
    $x = 0;
    $y = 0;
    $db_like = new db_query("SELECT * FROM save_course WHERE course_id='$id'");
    while ($row2 = mysql_fetch_assoc($db_orders->result)) {
        if ($dem >= 19) {
            $x += 1;
        }
        $dem++;
    }
    $c += $x;

    $db_common = new db_query("SELECT * FROM order_common WHERE course_id='$id'");
    while ($Row_common = mysql_fetch_assoc($db_common->result)) {
        if ($Row_common['numbers'] = $row_courses['quantity_std']) {
            $common += 1;
        }
        // echo $common['numbers'];
    }
    // echo $common;
}
$db_student = new db_query("SELECT count(save_id) as `save` FROM save_student WHERE user_teacher_id = '$user_id'");
$row3 = mysql_fetch_assoc($db_student->result);
$save = $row3['save'];
$num1 = new db_query("SELECT course_id FROM courses WHERE user_id = $user_id AND courses.hide_course = 1");
$num2 = new db_query("SELECT * FROM orders JOIN courses ON courses.course_id = orders.course_id WHERE courses.user_id = $user_id AND orders.course_type = 2");
$num3 = new db_query("SELECT * FROM orders JOIN courses ON courses.course_id = orders.course_id WHERE courses.user_id = $user_id AND orders.course_type = 1");
$num4 = new db_query("SELECT * FROM history_point WHERE center_teacher_id = $user_id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <title>Trang chủ trung tâm</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@200&display=swap" rel="stylesheet"> -->
    <?php
    include '../includes/l_inc_head.php';
    ?>
    <link rel="stylesheet" href="../css/tt_trangchu.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/slick.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/slick-theme.css?v=<?=$version?>">
    <style>
        .l_khoaonline_1{
            flex-wrap: wrap;
        }
        .l_khoaonline {
            width: 30%;
        }

        @media(max-width: 1300px){
            .l_khoaonline{
                width: 47%;
            }
        }
        @media(max-width: 767px){
            .l_khoaonline{
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="l_container">
        <!-- sidebar -->
        <?php
        include '../includes/l_inc_sidebar.php';
        ?>
        <!-- end: sidebar -->
        <div class="l_right">
            <!-- header -->
            <?php
            include '../includes/l_inc_header.php';
            ?>
            <!-- end header -->

            <!-- content -->
            <div class=" l_flex">
                <div class="l_content">
                    <div class="l_content_img"><img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/l_khoa-hoc-giang-day.svg" alt="icon"></div>
                    <div class="l_content_text"><?=mysql_num_rows($num1->result)?></div>
                    <div class="l_content_text1">KHÓA HỌC GIẢNG DẠY</div>
                </div>
                <div class="l_content">
                    <div class=" l_content_img"><img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/l_khoa-hoc-mua-nhieu-nhat.svg" alt="icon"></div>
                    <div class=" l_content_text"><?=mysql_num_rows($num2->result)?></div>
                    <div class="l_content_text1">KHÓA HỌC ONLINE ĐÃ BÁN</div>
                </div>
                <div class="l_content">
                    <div class=" l_content_img"><img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/l_khoa-hoc-yeu-thich-nhat.svg" alt="icon"></div>
                    <div class="l_content_text"><?=mysql_num_rows($num3->result)?></div>
                    <div class="l_content_text1">KHÓA HỌC OFFLINE ĐÃ ĐẶT CHỖ</div>
                </div>
                <div class="l_content">
                    <div class="l_content_img"><img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/l_so-luong-hoc-vien.svg" alt="icons"></div>
                    <div class="l_content_text"><?=mysql_num_rows($num4->result)?></div>
                    <div class="l_content_text1">HỌC VIÊN MUA TỪ ĐIỂM</div>
                </div>
            </div>
            <?
            $type = [2, 1];
            $title = ['KHÓA HỌC ONLINE', 'KHÓA HỌC OFFLINE'];
            for ($i = 0; $i < count($type); $i++) {
            ?>
                <div class="l_online">
                    <hr class="l_content-hr">
                    <div id="l_content-2">
                        <div class="flex l_tieude">
                            <div class="l_content-2-title"><? echo $title[$i] ?></div>
                        </div>
                        <div class="l_khoaonline_1">
                            <?
                            $db_online = new db_query("SELECT * FROM courses INNER JOIN levels ON levels.level_id = courses.level_id WHERE user_id = '$user_id' AND course_type='$type[$i]' AND courses.hide_course = 1 ORDER BY course_id DESC LIMIT 0,6");
                            while ($rowKH = mysql_fetch_assoc($db_online->result)) {
                                $id = $rowKH['course_id'];
                            ?>
                                <div class="l_khoaonline">
                                    <div class="l_online_top">
                                        <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="l_online_top_img lazyload" src="/img/load.gif" data-src="../img/course/<? echo $rowKH['course_avatar']; ?>" alt="loading...">
                                        <div class="l_detail">
                                            <?
                                            $t = $rowKH['center_teacher_id'];
                                            $teacher = new db_query("SELECT * FROM user_center_teacher WHERE user_id = '$user_id' AND center_teacher_id = '$t'");
                                            $row_teacher = mysql_fetch_assoc($teacher->result);
                                            ?>
                                            <div class="l_detail_img">
                                                <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/avatar/<? echo $row_teacher['teacher_avatar'] ?>" alt="avatar">
                                            </div>
                                            <div class="l_detail_item">
                                                <div class="l_detail_item1"><? echo $row_teacher['teacher_name'] ?></div>
                                                <?
                                                $cat_id = explode(',', $row_teacher['cate_id']);
                                                $e = '';
                                                for ($j = 0; $j < count($cat_id); $j++) {
                                                    $db_cate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cat_id[$j]'");
                                                    $row_cat = mysql_fetch_assoc($db_cate->result);
                                                    if ($j == (count($cat_id) - 1)) {
                                                        $e = $e . $row_cat['cate_name'];
                                                    } else {
                                                        $e = $e . $row_cat['cate_name'] . ', ';
                                                    }
                                                }
                                                ?>
                                                <div class="l_detail_item2"><? echo $e; ?></div>
                                            </div>
                                        </div>
                                        <!-- <div class="l_like">
                                            <img class="lazyload" src="/img/load.gif" data-src="../img/image/wpf_like (3).svg" alt="loading...">
                                        </div> -->
                                    </div>
                                    <? if ($rowKH['course_type'] == 1) {
                                    ?>
                                        <a class="l_color" href="/<? echo $rowKH['course_slug']; ?>-courseOf<? echo $id ?>.html">
                                            <div class=" l_online_title"><? echo $rowKH['course_name'] ?></div>
                                        </a>
                                    <?
                                    } else {
                                    ?>
                                        <a class="l_color" href="/<? echo $rowKH['course_slug']; ?>-courseOn<? echo $id ?>.html">
                                            <div class=" l_online_title"><? echo $rowKH['course_name'] ?></div>
                                        </a>
                                    <?
                                    } ?>
                                    <div class="l_flex_star">
                                        <?
                                        //$course_id = $rowKH['course_id'];
                                        $st = $type[$i];
                                        $db_star = new db_query("SELECT * FROM rate_course INNER JOIN courses ON rate_course.course_id = courses.course_id WHERE courses.course_id = '$id' AND course_type = '$st'");
                                        if ($st == 1) {
                                            $dem = (int) 0;
                                            $tong = (int) 0;
                                            while ($row_rate = mysql_fetch_assoc($db_star->result)) {
                                                $a = $row_rate['lesson'];
                                                $b = $row_rate['teacher'];
                                                $t = ($a + $b) / 2;
                                                $tong += $t;
                                                $dem++;
                                            }
                                            $total = 0;
                                            if ($dem > 1) {
                                                $a = (int) $tong / $dem;
                                                $total = round($a, 1);
                                            } else {
                                                $total = round($tong, 1);
                                            }
                                            if ($total >= 0 && $total < 1) {
                                                echo '<div class="l_star">Chưa có đánh giá</div>';
                                                echo '<div class="l_star">0 (0)</div>';
                                            } else if ($total >= 1 && $total < 2) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total >= 2 && $total < 3) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total >= 3 && $total < 4) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total >= 4 && $total < 5) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total == 5) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            }
                                            //echo $dem;
                                        } else {
                                            $dem = (int) 0;
                                            $tong = (int) 0;
                                            while ($row_rate = mysql_fetch_assoc($db_star->result)) {
                                                $a = $row_rate['lesson'];
                                                $b = $row_rate['video'];
                                                $c = $row_rate['teacher'];
                                                $t = ($a + $b + $c) / 3;
                                                $tong += $t;
                                                $dem++;
                                            }
                                            $total = 0;
                                            if ($dem > 1) {
                                                $a = (int) $tong / $dem;
                                                $total = round($a, 1);
                                            } else {
                                                $total = round($tong, 1);
                                            }
                                            if ($total >= 0 && $total < 1) {
                                                echo '<div class="l_star">Chưa có đánh giá</div>';
                                                echo '<div class="l_star">0 (0)</div>';
                                            } else if ($total >= 1 && $total < 2) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total >= 2 && $total < 3) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total >= 3 && $total < 4) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total >= 4 && $total < 5) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total == 5) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            }
                                            //echo $dem;
                                        }
                                        ?>
                                    </div>
                                    <?
                                    // $db_num = new db_query("SELECT * FROM orders WHERE course_id = '$id' AND course_type = 2");
                                    $d = 0;

                                    $db_odc = new db_query("SELECT * FROM order_student_common WHERE course_id = '$id'");
                                    //$odc = mysql_fetch_assoc($db_odc->result);
                                    if (mysql_num_rows($db_odc->result) == 0) {
                                        $number = 0;
                                    } else {
                                        $odc = mysql_num_rows($db_odc->result);
                                        $number = $odc;
                                    }
                                    // die();
                                    // while ($num = mysql_fetch_assoc($db_num->result)) {
                                    //     $d++;
                                    // }
                                    $d = $rowKH['number_buy'];
                                    ?>
                                    <div class="l_songuoidk"><? echo $d + $number ?> học viên đã mua khóa học</div>
                                    <?

                                    ?>
                                    <div class="l_info">
                                        <!-- <a href=""> -->
                                        <div class="v_info-detail l_info_detail"> <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/image/hocthu.svg" alt=""> Có
                                            học thử
                                        </div>
                                        <!-- </a> -->
                                        <div class="v_info-detail l_info_detail"> <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/image/chungchi.svg" alt="">
                                            <?
                                            // echo $rowKH['certification'];
                                            if ($rowKH['certification'] == 1) {
                                                echo 'Có cấp chứng chỉ';
                                            } else {
                                                echo 'Không cấp chứng chỉ';
                                            }
                                            ?></div>
                                        <div class="v_info-detail l_info_detail"> <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/image/nguoimoi.svg" alt="">
                                            <?
                                            // $db_level = new db_query('SELECT * FROM levels');
                                            // while ($level = mysql_fetch_assoc($db_level->result)) {
                                            //     if ($rowKH['level_id'] == $level['level_id']) {
                                            echo $rowKH['level_name'];
                                            //     }
                                            // }
                                            ?></div>
                                    </div>
                                    <center>
                                        <hr class="l_content-2-hr">
                                    </center>
                                    <div class="l_chinhsua">
                                        <? if ($type[$i] == 1) {
                                        ?>
                                            <a href="/cap-nhat-khoa-hoc-offline-trung-tam/id<?php echo $user_id; ?>-courseOf<?php echo $rowKH['course_id']; ?>.html">
                                                <button>
                                                    <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/image/chinhsua.svg" alt=""> Chỉnh sửa
                                                </button>
                                            </a>
                                        <?
                                        } else {
                                        ?>
                                            <a href="/cap-nhat-khoa-hoc-online-trung-tam/id<?php echo $user_id; ?>-courseOn<?php echo $rowKH['course_id']; ?>.html">
                                                <button>
                                                    <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/image/chinhsua.svg" alt=""> Chỉnh sửa
                                                </button>
                                            </a>
                                        <?
                                        } ?>

                                    </div>
                                </div>
                            <?
                            }
                            ?>
                        </div>
                        <?php
                        if ($type[$i] == 2) {
                            $link = '/trung-tam-khoa-hoc-online-giang-day/id'.$user_id.'&page1.html';
                        }else if($type[$i] == 1){
                            $link = '/trung-tam-khoa-hoc-offline-giang-day/id'.$user_id.'&page1.html';
                        }
                        ?>
                        <a href="<?php echo $link; ?>" class="v_link_course">XEM THÊM</a>
                    </div>
                </div>
            <?
            }
            ?>
            <div class="l_online">
                <hr class="l_content-hr">
                <div id="l_content-2">
                    <div class="flex l_tieude">
                        <div class="l_content-2-title">KHÓA HỌC MUA NHIỀU NHẤT</div>
                    </div>
                    <div class="l_khoaonline_1">
                        <?php
                        $i = 0;
                        $arr_course_count = [];
                        $qrCount = new db_query("SELECT orders.course_id FROM orders INNER JOIN courses ON orders.course_id = courses.course_id WHERE courses.user_id = $user_id");
                        while ($rowCount = mysql_fetch_array($qrCount->result)) {
                            if (!isset($arr_course_count[$rowCount['course_id']])) {
                                $arr_course_count[$rowCount['course_id']] = 1;
                            }else{
                                $arr_course_count[$rowCount['course_id']]++;
                            }
                        }
                        $qrCommon = new db_query("SELECT order_student_common.course_id FROM order_student_common INNER JOIN courses ON order_student_common.course_id = courses.course_id WHERE courses.user_id = $user_id");
                        while ($rowCommon = mysql_fetch_array($qrCommon->result)) {
                            if (!isset($arr_course_count[$rowCommon['course_id']])) {
                                $arr_course_count[$rowCommon['course_id']] = 1;
                            }else{
                                $arr_course_count[$rowCommon['course_id']]++;
                            }
                        }
                        arsort($arr_course_count);

                        if (count($arr_course_count) == 0) {
                            echo '<div class="emptys">Chưa có dữ liệu</div>';
                        }else{
                            foreach ($arr_course_count as $key => $value) 
                                $course_id = $key;
                                $course_daban = new db_query("SELECT * FROM courses INNER JOIN levels ON levels.level_id = courses.level_id WHERE courses.course_id = $course_id AND courses.hide_course = 1");
                                while ($rowKH = mysql_fetch_assoc($course_daban->result)) {
                                    $id = $rowKH['course_id'];
                                    if ($rowKH['course_type'] == 2) {
                                // echo $id;
                        ?>
                                <div class="l_khoaonline">
                                    <div class="l_online_top">
                                        <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="l_online_top_img lazyload" src="/img/load.gif" data-src="../img/course/<? echo $rowKH['course_avatar']; ?>" alt="loading...">
                                        <div class="l_detail">
                                            <?
                                            $t = $rowKH['center_teacher_id'];
                                            $teacher = new db_query("SELECT * FROM user_center_teacher WHERE user_id = '$user_id' AND center_teacher_id = '$t'");
                                            $row_teacher = mysql_fetch_assoc($teacher->result);
                                            ?>
                                            <div class="l_detail_img">
                                                <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/avatar/<? echo $row_teacher['teacher_avatar'] ?>" alt="avatar">
                                            </div>
                                            <div class="l_detail_item">
                                                <div class="l_detail_item1"><? echo $row_teacher['teacher_name'] ?></div>
                                                <?
                                                $cat_id = explode(',', $row_teacher['cate_id']);
                                                $e = '';
                                                for ($j = 0; $j < count($cat_id); $j++) {
                                                    $db_cate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cat_id[$j]'");
                                                    $row_cat = mysql_fetch_assoc($db_cate->result);
                                                    if ($j == (count($cat_id) - 1)) {
                                                        $e = $e . $row_cat['cate_name'];
                                                    } else {
                                                        $e = $e . $row_cat['cate_name'] . ', ';
                                                    }
                                                }
                                                ?>
                                                <div class="l_detail_item2"><? echo $e; ?></div>
                                            </div>
                                        </div>
                                        <!-- <div class="l_like">
                                        <img class="lazyload" src="/img/load.gif" data-src="../img/image/wpf_like (3).svg" alt="loading...">
                                    </div> -->
                                    </div>
                                    <? if ($rowKH['course_type'] == 1) {
                                    ?>
                                        <a class="l_color" href="/<? echo $rowKH['course_slug']; ?>-courseOf<? echo $id ?>.html">
                                            <div class=" l_online_title"><? echo $rowKH['course_name'] ?></div>
                                        </a>
                                    <?
                                    } else {
                                    ?>
                                        <a class="l_color" href="/<? echo $rowKH['course_slug']; ?>-courseOn<? echo $id ?>.html">
                                            <div class=" l_online_title"><? echo $rowKH['course_name'] ?></div>
                                        </a>
                                    <?
                                    } ?>
                                    <div class="l_flex_star">
                                        <?
                                        //$course_id = $rowKH['course_id'];
                                        //$st = $type[$i];
                                        //echo $st;
                                        //die();
                                        $db_star = new db_query("SELECT * FROM rate_course INNER JOIN courses ON rate_course.course_id = courses.course_id WHERE courses.course_id = '$id'");
                                        if ($rowKH['course_type'] == 1) {
                                            $dem = (int) 0;
                                            $tong = (int) 0;
                                            while ($row_rate = mysql_fetch_assoc($db_star->result)) {
                                                $a = $row_rate['lesson'];
                                                $b = $row_rate['teacher'];
                                                $t = ($a + $b) / 2;
                                                $tong += $t;
                                                $dem++;
                                            }
                                            $total = 0;
                                            if ($dem > 1) {
                                                $a = (int) $tong / $dem;
                                                $total = round($a, 1);
                                            } else {
                                                $total = round($tong, 1);
                                            }
                                            if ($total >= 0 && $total < 1) {
                                                echo '<div class="l_star">Chưa có đánh giá</div>';
                                                echo '<div class="l_star">0 (0)</div>';
                                            } else if ($total >= 1 && $total < 2) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total >= 2 && $total < 3) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total >= 3 && $total < 4) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total >= 4 && $total < 5) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total == 5) {
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            }
                                            //echo $dem;
                                        } else {
                                            $dem = (int) 0;
                                            $tong = (int) 0;
                                            while ($row_rate = mysql_fetch_assoc($db_star->result)) {
                                                $a = $row_rate['lesson'];
                                                $b = $row_rate['video'];
                                                $c = $row_rate['teacher'];
                                                $t = ($a + $b + $c) / 3;
                                                $tong += $t;
                                                $dem++;
                                            }
                                            $total = 0;
                                            if ($dem > 1) {
                                                $a = (int) $tong / $dem;
                                                $total = round($a, 1);
                                            } else {
                                                $total = round($tong, 1);
                                            }
                                            if ($total >= 0 && $total < 1) {
                                                echo '<div class="l_star">Chưa có đánh giá</div>';
                                                echo '<div class="l_star">0 (0)</div>';
                                            } else if ($total >= 1 && $total < 2) {
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total >= 2 && $total < 3) {
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total >= 3 && $total < 4) {
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total >= 4 && $total < 5) {
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            } else if ($total == 5) {
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star"><img class="lazyload" src="../img/bi_star-fill.svg" alt="icon"></div>';
                                                echo '<div class="l_star">' . $total . ' (' . $dem . ')</div>';
                                            }
                                            //echo $dem;
                                        }
                                        ?>
                                    </div>
                                    <!-- <div class="l_songuoidk">20.2000 học viên đã đăng kí khóa học</div> -->
                                    <?
                                    // $db_num = new db_query("SELECT * FROM orders WHERE course_id = '$id' AND course_type = 2");
                                    $d = 0;
                                    if ($rowKH['course_type'] == 2) {
                                        $db_odc = new db_query("SELECT * FROM order_student_common WHERE course_id = '$id'");
                                        // $odc = mysql_fetch_assoc($db_odc->result);
                                        if (mysql_num_rows($db_odc->result) == 0) {
                                            $number = 0;
                                        } else {
                                            $odc = mysql_num_rows($db_odc->result);
                                            $number = $odc;
                                        }
                                        // die();
                                        $d = $rowKH['number_buy'];
                                        // while ($num = mysql_fetch_assoc($db_num->result)) {
                                        //     $d++;
                                        // }
                                    ?>
                                        <div class="l_songuoidk"><? echo $d + $number; ?> học viên đã mua khóa học</div>
                                    <?
                                    }
                                    ?>
                                    <div class="l_info">
                                        <!-- <a href=""> -->
                                        <div class="v_info-detail l_info_detail"> <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/image/hocthu.svg" alt=""> Có
                                            học thử
                                        </div>
                                        <!-- </a> -->
                                        <div class="v_info-detail l_info_detail"> <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/image/chungchi.svg" alt="">
                                            <?
                                            // echo $rowKH['certification'];
                                            if ($rowKH['certification'] == 1) {
                                                echo 'Có cấp chứng chỉ';
                                            } else {
                                                echo 'Không cấp chứng chỉ';
                                            }
                                            ?></div>
                                        <div class="v_info-detail l_info_detail"> <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/image/nguoimoi.svg" alt="">
                                            <?
                                            // $db_level = new db_query('SELECT * FROM levels');
                                            // while ($level = mysql_fetch_assoc($db_level->result)) {
                                            //     if ($rowKH['level_id'] == $level['level_id']) {
                                            echo $rowKH['level_name'];
                                            //     }
                                            // }
                                            ?></div>
                                    </div>
                                    <center>
                                        <hr class="l_content-2-hr">
                                    </center>
                                    <div class="l_chinhsua">
                                        <? if ($rowKH['course_type'] == 1) {
                                        ?>
                                            <a href="/cap-nhat-khoa-hoc-offline-trung-tam/id<?php echo $user_id; ?>-courseOf<?php echo $rowKH['course_id']; ?>.html">
                                                <button>
                                                    <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/image/chinhsua.svg" alt=""> Chỉnh sửa
                                                </button>
                                            </a>
                                        <?
                                        } else {
                                        ?>
                                            <a href="/cap-nhat-khoa-hoc-online-trung-tam/id<?php echo $user_id; ?>-courseOn<?php echo $rowKH['course_id']; ?>.html">
                                                <button>
                                                    <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/image/chinhsua.svg" alt=""> Chỉnh sửa
                                                </button>
                                            </a>
                                        <?
                                        } ?>

                                    </div>
                                </div>
                            <?
                                }
                            } 
                            $i++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- end content -->
    </div>
    <!-- FOOTER -->
    <?php
    include '../includes/h_inc_footer.php';
    ?>
    <!-- END: FOOTER -->
</body>
<script src="../js/l_trungtam.js?v=<?=$version?>"></script>
<!-- <script src="../js/slick.min.js"></script>
<script >
$('.l_khoaonline_1').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    dots: true,
    focusOnSelect: true
}); -->

</html>