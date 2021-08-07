<?php
require_once '../code_xu_ly/h_manager_GV.php';
$num1 = new db_query("SELECT course_id FROM courses WHERE user_id = $cookie_id AND courses.hide_course = 1");
$num2 = new db_query("SELECT * FROM orders JOIN courses ON courses.course_id = orders.course_id WHERE courses.user_id = $cookie_id AND orders.course_type = 2");
$num3 = new db_query("SELECT * FROM orders JOIN courses ON courses.course_id = orders.course_id WHERE courses.user_id = $cookie_id AND orders.course_type = 1");
$num4 = new db_query("SELECT * FROM history_point WHERE center_teacher_id = $cookie_id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <?php require_once '../includes/v_inc_GV_css.php'; ?>
    <link rel="stylesheet" href="../css/v_index.css">
    <link rel="stylesheet" href="../css/GV-quan-li-chung.css?v=<?=$version?>">

    <style>
    #v_QL-chung {
        color: #1B6AAB;
    }
    .v_sidebar-menu:nth-child(1) a{
        color: #1B6AAB;
    }
    .v_gv>div p {
        cursor: context-menu;
        display: -webkit-box;
        max-width: 100%;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .v_batdauhoc a {
        border: none;
        background: rgba(27, 106, 171, 1);
        font-weight: 700;
        font-size: 14px;
        color: white;
        border-color: rgba(27, 106, 171, 1);
        border-radius: 4px;
        text-align: center;
        padding: 10px;
    }
    </style>
    <title>Page Quản lí chung (giảng viên)</title>
</head>

<body>
    <div id="v_wrapper">
        <!-- Begin: sidebar -->
        <?php require_once("../includes/inc_GV_sidebar.php"); ?>
        <!-- End: sidebar -->
        <div id="main">
            <!-- Begin: header -->
            <?php require_once '../includes/inc_GV_manager_header.php'; ?>
            <!-- End: header -->

            <!-- Begin: content -->
            <div id="v_content">
                <!-- Begin: content-1 -->
                <div id="v_content-1">
                    <div>
                        <div class="v_content-1-img"><img class="lazyload" src="/img/load.gif"
                                data-src="../img/Group 1803.png" alt="Ảnh lỗi"></div>
                        <div class="v_content-text"><?=mysql_num_rows($num1->result)?></div>
                        <div class="v_content-text">KHÓA HỌC GIẢNG DẠY</div>
                    </div>
                    <div>
                        <div class="v_content-1-img"><img class="lazyload" src="/img/load.gif"
                                data-src="../img/muanhieunhat.svg" alt="Ảnh lỗi"></div>
                        <div class="v_content-text"><?=mysql_num_rows($num2->result)?></div>
                        <div class="v_content-text">KHÓA HỌC ONLINE ĐÃ BÁN</div>
                    </div>
                    <div>
                        <div class="v_content-1-img"><img class="lazyload" src="/img/load.gif"
                                data-src="../img/Group 1803.png" alt="Ảnh lỗi"></div>
                        <div class="v_content-text"><?=mysql_num_rows($num3->result)?></div>
                        <div class="v_content-text">KHÓA HỌC OFFLINE ĐÃ ĐẶT CHỖ</div>
                    </div>
                    <div>
                        <div class="v_content-1-img"><img class="lazyload" src="/img/load.gif"
                                data-src="../img/soluonghocvien.svg" alt="Ảnh lỗi"></div>
                        <div class="v_content-text"><?=mysql_num_rows($num4->result)?></div>
                        <div class="v_content-text">HỌC VIÊN MUA TỪ ĐIỂM</div>
                    </div>
                </div>

                <div id="v_content-1-tb">
                    <div>
                        <div class="v_content-1-img">
                            <center><img class="lazyload" src="/img/load.gif" data-src="../img/Group 32027.png"
                                    alt="Ảnh lỗi"></center>
                        </div>
                        <div class="v_content-text"><?=mysql_num_rows($num1->result)?></div>
                        <div class="v_content-text-2">KHÓA HỌC GIẢNG DẠY</div>
                    </div>
                    <div>
                        <div class="v_content-1-img">
                            <center><img class="lazyload" src="/img/load.gif" data-src="../img/Group 32028.png"
                                    alt="Ảnh lỗi"></center>
                        </div>
                        <div class="v_content-text"><?=mysql_num_rows($num2->result)?></div>
                        <div class="v_content-text-2">KHÓA HỌC ONLINE ĐÃ BÁN</div>
                    </div>
                    <div>
                        <div class="v_content-1-img">
                            <center><img class="lazyload" src="/img/load.gif" data-src="../img/Group 32029.png"
                                    alt="Ảnh lỗi"></center>
                        </div>
                        <div class="v_content-text"><?=mysql_num_rows($num3->result)?></div>
                        <div class="v_content-text-2">KHÓA HỌC OFFLINE ĐÃ ĐẶT CHỖ</div>
                    </div>
                    <div>
                        <div class="v_content-1-img">
                            <center><img class="lazyload" src="/img/load.gif" data-src="../img/Group 32030.png"
                                    alt="Ảnh lỗi"></center>
                        </div>
                        <div class="v_content-text"><?=mysql_num_rows($num4->result)?></div>
                        <div class="v_content-text-2">HỌC VIÊN MUA TỪ ĐIỂM</div>
                    </div>
                </div>
                <!-- End: content-1 -->
                <div class="v_content-hr-div">
                    <hr class="v_content-hr">
                </div>

                <!-- Begin: content-2 -->
                <div id="v_content-2">
                    <div class="v_tieude">
                        <div class="v_cap"><img class="lazyload" src="/img/load.gif"
                                data-src="../img/BriefcaseFill(1).png" alt="Ảnh lỗi"></div>
                        <div class="v_content-2-title">KHÓA HỌC ONLINE</div>
                    </div>
                    <div class="flex v_khoaonline-1">
                        <?
                            $qr1 = new db_query("SELECT * FROM courses JOIN levels ON courses.level_id = levels.level_id JOIN categories ON courses.cate_id = categories.cate_id JOIN users ON users.user_id = courses.user_id WHERE courses.user_id = $cookie_id AND course_type = 2 AND courses.hide_course = 1 ORDER BY courses.course_id DESC LIMIT 0,6");
                            if(mysql_num_rows($qr1->result)==0){
                                echo '<div class="emptys">Chưa có dữ liệu</div>';
                            }else{
                                while ($row1 = mysql_fetch_array($qr1->result)) {
                                    $course_id = $row1['course_id'];
                                    if ($row1['tag_id'] != 0) {
                                        $tag_id = $row1['tag_id'];
                                        $cate_id = $row1['cate_id'];
                                        $qrTag = new db_query("SELECT tag_name, cate_icon FROM tags JOIN categories ON tags.cate_id=categories.cate_id WHERE tag_id = '$tag_id'");
                                        $rowTag = mysql_fetch_array($qrTag->result);
                                        $tag_name = '<div class="v_info-detail flex">
                                            <img src="../img/categories/'. $rowTag['cate_icon'] .'" class="v_cate_icon"><span>'.$rowTag['tag_name'].'</span>
                                        </div>';
                                    } else {
                                        $tag_name = '';
                                    } ?>
                        <div class="v_khoaonline">
                            <div class="v_pos">
                                <div class="v_gv">
                                    <div class="v_gv-div v_gv-img"><img
                                            onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                            class="lazyload" src="/img/load.gif"
                                            data-src="../img/avatar/<?php echo $row1['user_avatar']; ?>" alt="Ảnh lỗi">
                                    </div>
                                    <div class=" v_gv-div v_gv-text">
                                        <a href="<?php echo urlDetail_teacher($row1['user_id'], $row1['user_slug']) ?>">
                                            <p class="v_gv-div-p"><?php echo $row1['user_name']; ?></p>
                                        </a>
                                        <p class="v_gv-div-p">
                                            <?php echo $row1['cate_name']; ?>
                                        </p>
                                    </div>
                                </div>
                                <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                    class="v_khoaonline-background"
                                    src="../img/course/<?php echo $row1['course_avatar']; ?>" alt="Ảnh lỗi">
                            </div>
                            <div class="v_khoaonline-title"><?=$row1['course_name']?></div>
                            <div id="v_star">
                                <?php
                                $qrrate = new db_query("SELECT Count(*) as total FROM rate_course WHERE course_id = $course_id");
                                    $rowcount=mysql_fetch_array($qrrate->result);
                                    $numrate = $rowcount['total'];
                                    if ($numrate >0) {
                                        if ($row1['course_type']==1) {
                                            $qrsum = new db_query("SELECT (sum(lesson)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
                                            $rowsum = mysql_fetch_array($qrsum->result);
                                            $sumall = $rowsum['(sum(lesson)+sum(teacher))']/2;
                                            $total_rate = $sumall/$numrate;
                                        } elseif ($row1['course_type']==2) {
                                            $qrsum = new db_query("SELECT (sum(lesson)+sum(video)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
                                            $rowsum = mysql_fetch_array($qrsum->result);
                                            $sumall = $rowsum['(sum(lesson)+sum(video)+sum(teacher))']/3;
                                            $total_rate = $sumall/$numrate;
                                        }
                                    } else {
                                        $total_rate = 0;
                                    }
                                    if ($total_rate == 5) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } elseif ($total_rate < 5 && $total_rate >= 4) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } elseif ($total_rate < 4 && $total_rate >= 3) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } elseif ($total_rate < 3 && $total_rate >= 2) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } elseif ($total_rate < 2 && $total_rate >= 1) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } else {
                                        echo '<div class="v_star">Chưa có đánh giá</div>';
                                    } ?>

                            </div>
                            <div class="v_songuoidk">
                                <?php
                        $num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
                                    $num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");
                                    echo mysql_num_rows($num2->result) + mysql_num_rows($num3->result); ?> học viên đã
                                mua khóa học
                            </div>
                            <div class="v_info">
                                <!-- <div class="v_info-detail flex">
                                    <div><img src="../img/hoc-thu.svg" alt="Ảnh lỗi"></div>
                                    <div>Có học thử</div>
                                </div> -->
                                <div class="v_info-detail flex">
                                    <div><img src="../img/nguoi-moi.svg" alt="Ảnh lỗi"></div>
                                    <div><?php echo $row1['level_name'] ?></div>
                                </div>
                                <?=$tag_name?>
                            </div>
                            <center>
                                <hr class="v_content-2-hr">
                            </center>
                            <div class="v_batdauhoc"><a
                                    href="/cap-nhat-khoa-hoc-online-giang-vien/id<?=$cookie_id?>-courseOn<?=$row1['course_id']?>.html"><img
                                        src="../img/chinh-sua.svg" alt="Ảnh lỗi">Chỉnh sửa</a></div>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                    <?php
                    if(mysql_num_rows($qr1->result)>0){
                    ?>
                    <a href="/giang-vien-khoa-hoc-online/id<?php echo $cookie_id; ?>-p1.html" class="v_link_course">XEM THÊM</a>
                    <?php
                    }
                    ?>
                </div>
                <!-- End: content-2 -->

                <div class="v_content-hr-div">
                    <hr class="v_content-hr">
                </div>
                <!-- Begin: content-3 -->
                <div id="v_content-3">
                    <div class="flex v_tieude">
                        <div class="v_cap"><img src="../img/BriefcaseFill(1).png" alt="Ảnh lỗi"></div>
                        <div class="v_content-2-title">KHÓA HỌC OFFLINE</div>
                    </div>
                    <div class="flex v_khoaonline-1">
                        <?
                            $qr2 = new db_query("SELECT * FROM courses JOIN levels ON courses.level_id = levels.level_id JOIN categories ON courses.cate_id = categories.cate_id JOIN users ON users.user_id = courses.user_id WHERE courses.user_id = $cookie_id AND course_type = 1 AND courses.hide_course = 1");
                            if(mysql_num_rows($qr2->result)==0){
                                echo '<div class="emptys">Chưa có dữ liệu</div>';
                            }else{
                                while ($row1 = mysql_fetch_array($qr2->result)) {
                                    $course_id = $row1['course_id'];
                                    if ($row1['tag_id'] != 0) {
                                        $tag_id = $row1['tag_id'];
                                        $qrTag = new db_query("SELECT tag_name, cate_icon FROM tags JOIN categories ON tags.cate_id=categories.cate_id WHERE tag_id = '$tag_id'");
                                        $rowTag = mysql_fetch_array($qrTag->result);
                                        $cate_id = $row1['cate_id'];

                                        $tag_name = '<div class="v_info-detail flex">
                                            <img src="../img/categories/'. $rowTag['cate_icon'] .'" class="v_cate_icon"><span>'.$rowTag['tag_name'].'</span>
                                        </div>';
                                    } else {
                                        $tag_name = '';
                                    } ?>
                        <div class="v_khoaonline">
                            <div class="v_pos">
                                <div class="v_gv">
                                    <div class="v_gv-div v_gv-img"><img
                                            onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                            class="lazyload" src="/img/load.gif"
                                            data-src="../img/avatar/<?php echo $row1['user_avatar']; ?>" alt="Ảnh lỗi">
                                    </div>
                                    <?php if ($row1['user_type'] == 2) {
                                        $link_teach = urlDetail_teacher($row1['user_id'], $row1['user_slug']);
                                        $link_update = "/cap-nhat-khoa-hoc-online-giang-vien/id$cookie_id-courseOn".$row1['course_id'].".html";
                                    } elseif ($row1['user_type'] == 3) {
                                        $link_teach = urlDetail_center($row1['user_id'], $row1['user_slug']);
                                        $link_update = "/cap-nhat-khoa-hoc-online-giang-vien/id$cookie_id-courseOn".$row1['course_id'].".html";
                                    } ?>
                                    <div class=" v_gv-div v_gv-text">
                                        <a href="<?php echo $link_teach; ?>">
                                            <p class="v_gv-div-p"><?php echo $row1['user_name']; ?></p>
                                        </a>
                                        <p class="v_gv-div-p">
                                            <?php echo $row1['cate_name']; ?>
                                        </p>
                                    </div>
                                </div>
                                <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                    class="v_khoaonline-background lazyload" src="/img/load.gif"
                                    data-src="../img/course/<?php echo $row1['course_avatar']; ?>" alt="Ảnh lỗi">
                            </div>
                            <div class="v_khoaonline-title"><?=$row1['course_name']?></div>
                            <div id="v_star">
                                <?php
                                $qrrate = new db_query("SELECT Count(*) as total FROM rate_course WHERE course_id = $course_id");
                                    $rowcount=mysql_fetch_array($qrrate->result);
                                    $numrate = $rowcount['total'];
                                    if ($numrate >0) {
                                        if ($row1['course_type']==1) {
                                            $qrsum = new db_query("SELECT (sum(lesson)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
                                            $rowsum = mysql_fetch_array($qrsum->result);
                                            $sumall = $rowsum['(sum(lesson)+sum(teacher))']/2;
                                            $total_rate = $sumall/$numrate;
                                        } elseif ($row1['course_type']==2) {
                                            $qrsum = new db_query("SELECT (sum(lesson)+sum(video)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
                                            $rowsum = mysql_fetch_array($qrsum->result);
                                            $sumall = $rowsum['(sum(lesson)+sum(video)+sum(teacher))']/3;
                                            $total_rate = $sumall/$numrate;
                                        }
                                    } else {
                                        $total_rate = 0;
                                    }
                                    if ($total_rate == 5) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } elseif ($total_rate < 5 && $total_rate >= 4) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } elseif ($total_rate < 4 && $total_rate >= 3) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } elseif ($total_rate < 3 && $total_rate >= 2) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } elseif ($total_rate < 2 && $total_rate >= 1) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } else {
                                        echo '<div class="v_star">Chưa có đánh giá</div>';
                                    } ?>
                            </div>
                            <div class="v_songuoidk">
                                <?php
                        $num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
                                    $num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");
                                    echo mysql_num_rows($num2->result) + mysql_num_rows($num3->result); ?> học viên đã
                                mua khóa học
                            </div>
                            <div class="v_info">
                                <!-- <div class="v_info-detail flex">
                                    <div><img src="../img/hoc-thu.svg" alt="Ảnh lỗi"></div>
                                    <div>Có học thử</div>
                                </div> -->
                                <div class="v_info-detail flex">
                                    <div><img class="lazyload" src="/img/load.gif" data-src="../img/nguoi-moi.svg"
                                            alt="Ảnh lỗi"></div>
                                    <div><?php echo $row1['level_name'] ?></div>
                                </div>
                                <?=$tag_name?>
                            </div>
                            <center>
                                <hr class="v_content-2-hr">
                            </center>
                            <?php
                                if ($row1['course_type'] == 1) {
                                    $link_update = "/cap-nhat-khoa-hoc-offline-giang-vien/id$cookie_id-courseOf".$row1['course_id'].".html";
                                } elseif ($row1['course_type'] == 2) {
                                    $link_update = "/cap-nhat-khoa-hoc-online-giang-vien/id$cookie_id-courseOn".$row1['course_id'].".html";
                                } ?>
                            <div class="v_batdauhoc"><a href="<?=$link_update?>"><img class="lazyload"
                                        src="/img/load.gif" data-src="../img/chinh-sua.svg" alt="Ảnh lỗi">Chỉnh sửa</a>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                    <?php
                    if(mysql_num_rows($qr2->result)>0){
                    ?>
                    <a href="/giang-vien-khoa-hoc-offline/id<?php echo $cookie_id; ?>-p1.html" class="v_link_course">XEM THÊM</a>
                    <?php
                    }
                    ?>
                </div>
                <!-- End: content-3 -->

                <div class="v_content-hr-div">
                    <hr class="v_content-hr">
                </div>
                <!-- Begin: content-4 -->
                <div id="v_content-4">
                    <div class="flex v_tieude">
                        <div class="v_cap"><img src="../img/BriefcaseFill(1).png" alt="Ảnh lỗi"></div>
                        <div class="v_content-2-title">KHÓA HỌC MUA NHIỀU NHẤT</div>
                    </div>
                    <div class="flex v_khoaonline-1">
                        <?php
                        $arr_course_id = [];
                        $arr_course_count = [];
                        $qrCount = new db_query("SELECT orders.course_id FROM orders INNER JOIN courses ON orders.course_id = courses.course_id WHERE courses.user_id = $cookie_id");
                        while ($rowCount = mysql_fetch_array($qrCount->result)) {
                            if (!isset($arr_course_count[$rowCount['course_id']])) {
                                $arr_course_count[$rowCount['course_id']] = 1;
                            }else{
                                $arr_course_count[$rowCount['course_id']]++;
                            }
                        }
                        $qrCommon = new db_query("SELECT order_student_common.course_id FROM order_student_common INNER JOIN courses ON order_student_common.course_id = courses.course_id WHERE courses.user_id = $cookie_id");
                        while ($rowCommon = mysql_fetch_array($qrCommon->result)) {
                            if (!isset($arr_course_count[$rowCommon['course_id']])) {
                                $arr_course_count[$rowCommon['course_id']] = 1;
                            }else{
                                $arr_course_count[$rowCommon['course_id']]++;
                            }
                        }
                        arsort($arr_course_count);

                        if (count($arr_course_count)==0) {
                                echo '<div class="emptys">Chưa có dữ liệu</div>';
                        }else{
                            foreach ($arr_course_count as $key => $value) {
                                $qr3 = new db_query("SELECT * FROM courses JOIN levels ON courses.level_id = levels.level_id JOIN users ON users.user_id = courses.user_id JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_id = $key");
                                while ($row1 = mysql_fetch_array($qr3->result)) {
                                    $course_id = $row1['course_id'];
                                    if (!in_array($course_id, $arr_course_id)) {
                                    	if ($row1['tag_id'] != 0) {
                                    		$tag_id = $row1['tag_id'];
                                    		$qrTag = new db_query("SELECT tag_name, cate_icon FROM tags JOIN categories ON tags.cate_id=categories.cate_id WHERE tag_id = '$tag_id'");
                                    		$rowTag = mysql_fetch_array($qrTag->result);
                                    		$cate_id = $row1['cate_id'];

                                    		$tag_name = '<div class="v_info-detail flex">
                                    		<img src="../img/categories/'. $rowTag['cate_icon'] .'" class="v_cate_icon"><span>'.$rowTag['tag_name'].'</span>
                                    		</div>';
                                    	} else {
                                    		$tag_name = '';
                                    	}
                     				?>
                        <div class="v_khoaonline">
                            <div class="v_pos">
                                <div class="v_gv">
                                    <div class="v_gv-div v_gv-img"><img
                                            onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                            class="lazyload" src="/img/load.gif"
                                            data-src="../img/avatar/<?php echo $row1['user_avatar']; ?>" alt="Ảnh lỗi">
                                    </div>
                                    <?php if ($row1['user_type'] == 2) {
                                        $link_teach = urlDetail_teacher($row1['user_id'], $row1['user_slug']);
                                        $link_update = "/cap-nhat-khoa-hoc-online-giang-vien/id$cookie_id-courseOn".$row1['course_id'].".html";
                                    } elseif ($row1['user_type'] == 3) {
                                        $link_teach = urlDetail_center($row1['user_id'], $row1['user_slug']);
                                        $link_update = "/cap-nhat-khoa-hoc-online-giang-vien/id$cookie_id-courseOn".$row1['course_id'].".html";
                                    } ?>
                                    <div class=" v_gv-div v_gv-text">
                                        <a href="<?php echo $link_teach; ?>">
                                            <p class="v_gv-div-p"><?php echo $row1['user_name']; ?></p>
                                        </a>
                                        <p class="v_gv-div-p">
                                            <?php echo $row1['cate_name']; ?>
                                        </p>
                                    </div>
                                </div>
                                <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                    class="v_khoaonline-background lazyload" src="/img/load.gif"
                                    data-src="../img/course/<?php echo $row1['course_avatar']; ?>" alt="Ảnh lỗi">
                            </div>
                            <div class="v_khoaonline-title"><?=$row1['course_name']?></div>
                            <div id="v_star">
                                <?php
                                $qrrate = new db_query("SELECT Count(*) as total FROM rate_course WHERE course_id = $course_id");
                                    $rowcount=mysql_fetch_array($qrrate->result);
                                    $numrate = $rowcount['total'];
                                    if ($numrate >0) {
                                        if ($row1['course_type']==1) {
                                            $qrsum = new db_query("SELECT (sum(lesson)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
                                            $rowsum = mysql_fetch_array($qrsum->result);
                                            $sumall = $rowsum['(sum(lesson)+sum(teacher))']/2;
                                            $total_rate = $sumall/$numrate;
                                        } elseif ($row1['course_type']==2) {
                                            $qrsum = new db_query("SELECT (sum(lesson)+sum(video)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
                                            $rowsum = mysql_fetch_array($qrsum->result);
                                            $sumall = $rowsum['(sum(lesson)+sum(video)+sum(teacher))']/3;
                                            $total_rate = $sumall/$numrate;
                                        }
                                    } else {
                                        $total_rate = 0;
                                    }
                                    if ($total_rate == 5) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } elseif ($total_rate < 5 && $total_rate >= 4) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } elseif ($total_rate < 4 && $total_rate >= 3) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } elseif ($total_rate < 3 && $total_rate >= 2) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } elseif ($total_rate < 2 && $total_rate >= 1) {
                                        echo '
                                        <div class="v_star"><img src="../img/bi_star-fill.png" alt="Ảnh lỗi"></div>
                                    ';
                                    } else {
                                        echo '<div class="v_star">Chưa có đánh giá</div>';
                                    } ?>
                            </div>
                            <div class="v_songuoidk">
                                <?php
                     $num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
                                    $num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");
                                    echo mysql_num_rows($num2->result) + mysql_num_rows($num3->result); ?> học viên đã
                                mua khóa học
                            </div>
                            <div class="v_info">
                                <!-- <div class="v_info-detail flex">
                                    <div><img src="../img/hoc-thu.svg" alt="Ảnh lỗi"></div>
                                    <div>Có học thử</div>
                                </div> -->
                                <div class="v_info-detail flex">
                                    <div><img class="lazyload" src="/img/load.gif" data-src="../img/nguoi-moi.svg"
                                            alt="Ảnh lỗi"></div>
                                    <div><?php echo $row1['level_name'] ?></div>
                                </div>
                                <?=$tag_name?>
                            </div>
                            <center>
                                <hr class="v_content-2-hr">
                            </center>
                            <?php
                                if ($row1['course_type'] == 1) {
                                    $link_update = "/cap-nhat-khoa-hoc-offline-giang-vien/id$cookie_id-courseOf".$row1['course_id'].".html";
                                } elseif ($row1['course_type'] == 2) {
                                    $link_update = "/cap-nhat-khoa-hoc-online-giang-vien/id$cookie_id-courseOn".$row1['course_id'].".html";
                                } ?>
                            <div class="v_batdauhoc"><a href="<?=$link_update?>"><img src="../img/chinh-sua.svg"
                                        alt="Ảnh lỗi">Chỉnh sửa</a></div>
                        </div>
                        <?php
                        $arr_course_id[] = $course_id;
                                	}
                                }
                            }
                        }
                        ?>
                    </div>
                    <?php
                    if(count($arr_course_count)>0){
                    ?>
                    <a href="//giang-vien-khoa-hoc-online-da-ban/id<?php echo $cookie_id; ?>-p1.html" class="v_link_course">XEM THÊM</a>
                    <?php
                    }
                    ?>
                </div>
                <!-- End: content-4 -->
            </div>
            <!-- End: content -->
        </div>
    </div>
    </div>
    <!-- Begin: foooter -->
    <?php require_once("../includes/h_inc_footer.php"); ?>
    <!-- End: footer -->
    <script src="../js/bootstrap.min.js?v=<?=$version?>"></script>
    <script src="../js/v-main.js?v=<?=$version?>"></script>
</body>

</html>