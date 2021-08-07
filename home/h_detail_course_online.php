<?php
session_start();
require_once '../code_xu_ly/h_home.php';
$course_id = getValue('course_id','int','GET','');

if (!isset($_COOKIE['user_id'])) {
    $user_id = 0;
    $active = 0;
    $a = 'comment-rate';
    $b= '';
}else{
    $user_id = $_COOKIE['user_id'];
    $active = 1;
    $b ='comment-rate';
    $a = '';
}

$type = 2;
$teachcen = new db_query("SELECT teacher_center FROM `courses` WHERE `course_id` = '$course_id'");
$rowtc = mysql_fetch_array($teachcen->result);
if($rowtc['teacher_center'] == 2){
    $qr = new db_query("SELECT *,courses.course_id FROM `users` JOIN courses on courses.user_id = users.user_id 
        JOIN user_teach_experience ON user_teach_experience.user_id = users.user_id  WHERE courses.course_id = '$course_id'");
}elseif($rowtc['teacher_center'] == 3){
    $qr = new db_query("SELECT *,courses.course_id FROM `users` JOIN courses on courses.user_id = users.user_id JOIN user_center ON user_center.user_id = users.user_id JOIN user_center_teacher ON user_center_teacher.user_id = users.user_id WHERE courses.course_id = '$course_id'");
}
$rowc = mysql_fetch_array($qr->result);
if (mysql_num_rows($qr->result) == 0) {
    header("Location: /");
}
if ($rowc['course_type'] == 1) {
    header("Location: " . urlDetail_courseOffline($rowc['course_id'],$rowc['course_slug']));
}else if ($rowc['course_type'] == 2) {
    $url = urlDetail_courseOnline($rowc['course_id'],$rowc['course_slug']);
    if ($_SERVER['REQUEST_URI'] != $url) {
        header("Location: $url");
    }
}

if ($cookie_type == 1){
    $buy = 1;
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
    <link rel="preload" href="/css/h_detail_course.css?v=<?=$version?>" as="style">
    <title><?=$rowc['course_name']?></title>
    <?require_once '../includes/h_inc_css.php';?>
    <link rel="stylesheet" href="../css/h_detail_course.css?v=<?=$version?>">
    <style>
        <?php if ($cookie_type==3 || $cookie_type==2) {
            ?>.buy-now {
                display: none;
            }

            <?php
        }

        ?>

        .btn_reply_img{
            display: none;
            width: 30px;
        }

        .btn_reply_span{
            color: white;
        }
    </style>
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
                    <li><a href="/khoa-hoc-online.html">Danh sách online</a></li>
                    <li style="font-size: 18px;">></li>
                    <li><?=$rowc['course_name']?></li>
                </ol>
            </div>
        </div>
        <div class="container">
            <div id="course-learn">
                <ul>
                    <li><a href="#what_learn">Lợi ích khóa học</a></li>
                    <li><a href="#student_obj">Phù hợp với ai?</a></li>
                    <li><a href="#introduction">Giới thiệu</a></li>
                    <li><a href="#teach_info">Thông tin người dạy</a></li>
                    <li><a href="#content_learn">Nội dung khóa học</a></li>
                    <li><a href="#rating">Đánh giá</a></li>
                </ul>
            </div>
        </div>
        <hr class="hr1">
        <!--Detail Main-->
        <div class="container">
            <div id="main-detail">
                <div class="detail-title1">
                    <h1><?=$rowc['course_name']?></h1>
                </div>
                <div class="detail-title2">
                    <p><?=$rowc['course_describe']?></p>
                </div>
                <div id="center-detail">
                    <?
                    if ($rowtc['teacher_center'] == 2) {
                        ?>
                        <div class="teacher-info">
                            <div class="teacher-img">
                                <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload"
                                src="/img/load.gif" data-src="../img/avatar/<?=$rowc['user_avatar']?>">
                            </div>
                            <div class="teacher-name">
                                <h4> <a
                                    href="<?=urlDetail_teacher($rowc['user_id'], $rowc['user_slug'])?>"><?=$rowc['user_name']?></a>
                                </h4>
                                <p class="teacher-name1"><?=$rowc['exp_work']?></p>
                                <p class="teacher-name2"><?=$rowc['exp_teach']?></p>
                            </div>
                        </div>
                        <?php
                    }elseif($rowtc['teacher_center'] == 3){
                        ?>
                        <div class="teacher-info">
                            <div class="teacher-img">
                                <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload"
                                src="/img/load.gif" data-src="../img/avatar/<?=$rowc['user_avatar']?>">
                            </div>
                            <div class="teacher-name">
                                <h4><a
                                    href="<?=urlDetail_center($rowc['user_id'], $rowc['user_slug'])?>"><?=$rowc['user_name']?></a>
                                </h4>
                                <p class="teacher-name2"><?=$rowc['center_intro']?></p>
                            </div>
                        </div>
                        <?
                    }
                    ?>
                    <!--Cart-->

                    <?php
                    include '../includes/h_inc_cart.php';
                    ?>
                    <!--End Cart-->

                    <div class="teacher" id="what_learn">
                        <div class="obj-course">
                            <div class="title">
                                <hr>
                                <h3>Lợi ích khóa học</h3>
                            </div>
                            <div class="content">
                                <p id="content1"><?php echo $rowc['course_benefit']; ?>
                            </p>
                        </div>
                        <div class="xemthem">
                            <span id="xemthem1">xem thêm</span>
                        </div>
                    </div>
                    <div class="obj-course" id="student_obj">
                        <div class="title">
                            <hr>
                            <h3>Phù hợp với ai</h3>
                        </div>
                        <div class="content">
                            <p>
                                <?php echo $rowc['course_match']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="obj-course" id="introduction">
                        <div class="title">
                            <hr>
                            <h3>Giới thiệu khóa học</h3>
                        </div>
                        <div class="content">
                            <p id="content2">
                                <?php echo $rowc['course_describe']; ?>
                            </p>
                        </div>
                        <div class="xemthem">
                            <span id="xemthem2">xem thêm</span>
                        </div>
                    </div>
                    <div class="obj-course" id="teach_info">
                        <div class="title">
                            <hr>
                            <h3>Thông tin người dạy</h3>
                        </div>
                        <?
                        if ($rowtc['teacher_center'] == 2) {
                            ?>
                            <div class="content">
                                <h4><?=$rowc['user_name']?></h4>
                                <p id="content3">
                                    <?=$rowc['exp_teach']?>
                                </p>
                            </div>
                            <?php
                        }elseif($rowtc['teacher_center'] == 3){
                            ?>
                            <div class="content">
                                <h4><?=$rowc['teacher_name']?></h4>
                                <p id="content3">
                                    <?=$rowc['qualification']?>
                                </p>
                            </div>
                            <?
                        }
                        ?>
                        <div class="xemthem">
                            <span id="xemthem3">xem thêm</span>
                        </div>
                    </div>
                    <div class="obj-course" id="content_learn">
                        <div class="title">
                            <hr>
                            <h3>Nội dung khóa học
                                <?
                                if(isset($cookie_id)){
                                    $qror = new db_query("SELECT user_student_id,course_id FROM orders WHERE course_id = $course_id AND user_student_id = $cookie_id");
                                    if (mysql_num_rows($qror->result)>0) {
                                        echo '<a id="hocthu" href="'.urlBaihoc($course_id).'">BẮT ĐẦU HỌC</a>';
                                    }
                                }
                                ?>
                            </h3>
                        </div>

                        <div class="all-document">
                            <?
                            $qrdoc = new db_query("SELECT lesson_id,lesson_name FROM course_lesson WHERE course_id = $course_id AND lesson_parent = 0");
                            if(mysql_num_rows($qrdoc->result) == 0){
                                echo "<div class='main-video' style='color:red'>Chưa có bài học</div>";
                            }else{
                                while ($row = mysql_fetch_array($qrdoc->result)) {
                                    $lesson_id = $row['lesson_id'];
                                    ?>
                                    <div class="navbar-toggle collapsed main-video" data-toggle="collapse"
                                    data-target="#video<?=$lesson_id?>" aria-expanded="false">
                                    <img class="lazyload" src="/img/load.gif" data-src="../img/image/down.svg">
                                    <h3><?=$row['lesson_name']?></h3>
                                    <span>(
                                        <?
                                        $qrdoc1 = new db_query("SELECT * FROM course_lesson WHERE lesson_parent = $lesson_id");
                                        echo mysql_num_rows($qrdoc1->result);
                                        ?> video)
                                    </span>
                                </div>
                                <ul id="video<?=$lesson_id?>" class="video-collapse">
                                    <?
                                    while ($row = mysql_fetch_array($qrdoc1->result)) {
                                        ?>
                                        <li class="video-lesson"><img class="lazyload" src="/img/load.gif"
                                            data-src="../img/image/video.svg">
                                            <?=$row['lesson_name']?>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="obj-course">
                    <div class="title">
                        <hr>
                        <h3>Yêu cầu khóa học</h3>
                    </div>
                    <div class="content">
                        <p>
                            <?php echo $rowc['course_request']; ?>
                        </p>
                    </div>
                </div>

                <!--RATE-->
                <?php
                include '../includes/h_ratebar_course.php';
                ?>
                <!--END RATE-->
            </div>

            <!-- Comment -->

            <div class="student-comment">
                <div class="title" id="v_title">
                    <hr>
                    <h2>NHẬN XÉT HỌC VIÊN</h2>
                    <?php
                    if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_type'])){
                        $qrRateUser = new db_query("SELECT rate_id FROM rate_course WHERE user_student_id = $user_id AND course_id = $course_id ORDER BY rate_id DESC");
                        $qrRateOrder = new db_query("SELECT user_student_id,course_id FROM orders WHERE user_student_id = '$cookie_id' AND course_id = '$course_id'");
                        if (mysql_num_rows($qrRateUser->result) == 0) {
                            echo '<button data-toggle="modal" id="v_write_comment" data-target="#comment-rate">VIẾT ĐÁNH GIÁ</button>';
                        }else{
                            echo '<button data-toggle="modal" id="v_write_comment" data-target="#comment-rate" style="display: none;">VIẾT ĐÁNH GIÁ</button>';
                        }
                    }else{
                        echo '<button data-toggle="modal" id="v_write_comment" data-target="#modal-login">VIẾT ĐÁNH GIÁ</button>';
                    }
                    ?>
                </div>
                <div class="list-comment" id="list-comment">

                    <?php 
                    $qrComment =  new db_query("SELECT * FROM rate_course WHERE course_id = '$course_id' ORDER BY rate_id DESC");
                    if (mysql_num_rows($qrComment->result) == 0) {
                        echo "<div class='no-cmt'>Hiện chưa có bình luận</div>";
                    }else{
                        while ($rowComment = mysql_fetch_array($qrComment->result)) {
                            $user_student_id = $rowComment['user_student_id'];
                            $rate_id = $rowComment['rate_id'];
                            $rateAll = $rowComment['lesson'] + $rowComment['video'] + $rowComment['teacher'];
                            $rate = $rateAll/3;
                    ?>
                            <div class="cmt-student">
                                <?php
                                $qrHV = new db_query("SELECT user_name, user_avatar,user_id FROM users WHERE user_id = '$user_student_id'");
                                $rowHV = mysql_fetch_array($qrHV->result); ?>
                                <div class="std-img">
                                    <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                    class="lazyload" src="/img/load.gif"
                                    data-src="../img/avatar/<?=$rowHV['user_avatar']?>">
                                </div>
                                <div class="std-content" data-set="<?php echo $rowComment['rate_id']; ?>">
                                    <h4><?php echo $rowHV['user_name']; ?></h4>
                                    <div class="stdstar">
                                        <?php
                                        for ($i = 1; $i <= $rate; $i++) {
                                            ?>
                                            <img class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">
                                            <?php
                                        } ?>
                                        <span><?php echo $rowComment['updated_at']; ?></span>
                                    </div>
                                    <p><?php echo $rowComment['comment_rate']; ?></p>
                                    <div class="answer">
                                        <?php 
                                        if ($rowHV['user_id'] == $cookie_id) {
                                            echo '<button class="clickrep" data-set="'.$rowComment['user_student_id'].'" onclick="clickrep(this)">Phản hồi</button>';
                                            echo '<button class="del_cmt" data-set="'.$rowComment['rate_id'].'" onclick="del_cmt(this)">Xóa</button>';
                                        }else if($cookie_id != 0){
                                            echo '<button class="clickrep" data-set="'.$rowComment['user_student_id'].'" onclick="clickrep(this)">Phản hồi</button>';
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    $qrRep = new db_query("SELECT * FROM rep_rate_course WHERE rate_id = '$rate_id' AND course_id = '$course_id'");
                                    while ($rowRep = mysql_fetch_array($qrRep->result)) {
                                        $user_id = $rowRep['user_student_id'];
                                        $qrUserRep =  new db_query("SELECT user_name,user_avatar FROM users WHERE user_id = '$user_id'");
                                        $rowUserRep = mysql_fetch_array($qrUserRep->result); ?>
                                        <div class="reply-content">
                                            <div class="studentrep">
                                                <div class="std-img">
                                                    <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                                    class="lazyload" src="/img/load.gif"
                                                    data-src="../img/avatar/<?=$rowUserRep['user_avatar'] ?>">
                                                </div>
                                                <div class="std-content">
                                                    <h4><?php echo $rowUserRep['user_name']; ?></h4>
                                                    <div class="stdstar">
                                                        <span><?php echo $rowRep['created_at']; ?></span>
                                                    </div>
                                                    <p><?php echo $rowRep['comment_rep']; ?></p>
                                                    <div class="answer-rep">
                                                        <?php
                                                        if ($user_id == $cookie_id) {
                                                            echo '<button class="delrep" data-rep="'.$rowRep['user_student_id'].'" data-set="'.$rowRep['rep_id'].'" onclick="delrep2(this)">Xóa</button>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    } ?>
                                </div>

                            </div>

                            <div class="reply-comment" data-set="<?php echo $rowComment['rate_id']; ?>">
                                <form
                                onsubmit="return rep_Comment(this);">
                                <textarea class="reply-comment-textarea"></textarea>
                                <div class="divreply">
                                    <button class="btn_reply"><img src="../img/Spinner-1s-200px.gif" class="btn_reply_img" alt=""><span class="btn_reply_span">GỬI</span></button>
                                </div>
                            </form>
                        </div>
                        <?php
                    }
                } ?>
            </div>
        </div>

        <!--Khoa hoc lien quan-->
        <div id="course-relate">
            <div class="title">
                <hr>
                <h2>KHÓA HỌC LIÊN QUAN</h2>
            </div>
            <div class="feature-main">
                <?php
                $cate_id = $rowc['cate_id'];
                 $qrCate = new db_query("SELECT * FROM `courses` JOIN categories ON courses.cate_id=categories.cate_id JOIN levels ON courses.level_id = levels.level_id WHERE courses.cate_id = '$cate_id' AND course_type = 2 AND course_id != $course_id AND courses.hide_course = 1 AND courses.price_listed > -1 AND accept = 1 ORDER BY courses.course_id DESC LIMIT 0,6");

                while ($rowCate = mysql_fetch_array($qrCate->result)) {
                    $course_id2 = $rowCate['course_id'];
                    $v_cate_id = $rowCate['cate_id'];
                    $v_qr_cate = new db_query("SELECT * FROM `categories` WHERE `cate_id` = '$v_cate_id'");
                    $v_rowCate = mysql_fetch_array($v_qr_cate->result);
                    $center_teacher_id = $rowCate['user_id'];
                    $qrTeach = new db_query("SELECT * FROM users WHERE user_id = '$center_teacher_id'");
                    $rowTeach = mysql_fetch_array($qrTeach->result);
                    if ($rowTeach['user_type'] == 2) {
                        $srcTeach = urlDetail_teacher($center_teacher_id, $rowTeach['user_slug']);
                    }else if($rowTeach['user_type'] == 3){
                        $srcTeach = urlDetail_center($center_teacher_id, $rowTeach['user_slug']);
                    }
                    if ($rowCate['certification'] == 1) {
                        $cer = "Cấp chứng chỉ";
                    }else{
                        $cer = "Không cấp chứng chỉ";
                    }

                    if ($rowCate['tag_id'] != 0) {
                        $tag_id = $rowCate['tag_id'];
                        $qrTag = new db_query("SELECT tag_name, cate_icon FROM tags JOIN categories ON tags.cate_id=categories.cate_id WHERE tag_id = '$tag_id'");
                        $rowTag = mysql_fetch_array($qrTag->result);
                        $cate_id = $rowCate['cate_id'];

                        $tag_name = '<div class="item">
                        <img width="16px" height="16px" src="/img/load.gif" data-src="../img/categories/'. $rowTag['cate_icon'] .'" class="lazyload v_cate_icon"><span>'.$rowTag['tag_name'].'</span>
                        </div>';
                    }else{
                        $tag_name = '<div class="item">
                        <img width="16px" height="16px" src="/img/load.gif" data-src="../img/categories/'. $rowCate['cate_icon'] .'" class="lazyload v_cate_icon"><span>'.$rowCate['cate_name'].'</span>
                        </div>';
                    }
                    ?>
                    <div class="product-item">
                        <div class="product-img">
                            <img class="img-main lazyload"
                            onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                            src="/img/load.gif"
                            data-src="../img/course/<?php echo $rowCate['course_avatar']; ?>">
                            <div class="detail">
                                <div class="detai-img">
                                    <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                    class="lazyload" src="/img/load.gif"
                                    data-src="../img/avatar/<?php echo $rowTeach['user_avatar']; ?>"
                                    alt="Ảnh lỗi">
                                </div>
                                <div class="detai-item">
                                    <a href="<?=$srcTeach?>">
                                        <p class="detai-item1"><?php echo $rowTeach['user_name']; ?></p>
                                        <p class="detai-item2"><?php echo $v_rowCate['cate_name']; ?></p>
                                    </a>
                                </div>
                            </div>
                            <div class="like">
                                <?php if (!isset($_COOKIE['user_id'])) {
                                    $src = "../img/image/wpf_like (3).svg";
                                    $status = 0;
                                    $v_style_like = " ";
                                    $user_id = "'none'";
                                } else {
                                    $user_id = $_COOKIE['user_id'];
                                    $status = 1;
                                    $qrLike = new db_query("SELECT * FROM `save_course` WHERE `user_student_id` = '$user_id' AND `course_id` = '$course_id2'");
                                    $rowLike = mysql_fetch_array($qrLike->result);
                                    if ($rowLike == "") {
                                        $src = "../img/image/wpf_like (3).svg";
                                    } else {
                                        $src = "../img/heart-yellow2.svg";
                                    }

                                    if ($cookie_type == 3 || $cookie_type == 2) {
                                        $v_style_like = "display: none;";
                                    } else {
                                        $v_style_like = " ";
                                    }
                                } ?>
                                <img class="lazyload like-product" style="cursor: pointer; <?php echo $v_style_like; ?>" onclick="v_save_course2(this)" data-course="<?php echo $rowCate['course_id']; ?>" id="like-product-<?php echo $rowCate['course_id']; ?>" src="/img/load.gif" data-src="<?php echo $src; ?>">
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="prd-name">
                                <a
                                href="<?php echo urlDetail_courseOnline($rowCate['course_id'], $rowCate['course_slug'])?>">
                                <p><?php echo $rowCate['course_name']; ?></p>
                            </a>
                        </div>
                        <div class="star-rate">
                            <?php
                            $qrrate = new db_query("SELECT Count(*) as total FROM rate_course WHERE course_id = $course_id2");
                            $rowcount=mysql_fetch_array($qrrate->result);
                            $numrate = $rowcount['total'];
                            if ($numrate >0) {
                                if ($rowCate['course_type']==1) {
                                    $qrsum = new db_query("SELECT (sum(lesson)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id2");
                                    $rowsum = mysql_fetch_array($qrsum->result);
                                    $sumall = $rowsum['(sum(lesson)+sum(teacher))']/2;
                                    $total_rate = $sumall/$numrate;
                                } elseif ($rowCate['course_type']==2) {
                                    $qrsum = new db_query("SELECT (sum(lesson)+sum(video)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id2");
                                    $rowsum = mysql_fetch_array($qrsum->result);
                                    $sumall = $rowsum['(sum(lesson)+sum(video)+sum(teacher))']/3;
                                    $total_rate = $sumall/$numrate;
                                }
                            }else{
                                $total_rate = 0;
                            }
                            if ($total_rate == 5) {
                                echo '
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                ';
                            } elseif ($total_rate < 5 && $total_rate >= 4) {
                                echo '
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                ';
                            } elseif ($total_rate < 4 && $total_rate >= 3) {
                                echo '
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                ';
                            } elseif ($total_rate < 3 && $total_rate >= 2) {
                                echo '
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                ';
                                } elseif ($total_rate < 2 && $total_rate >= 1) {echo '
                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                ';
                            } else {
                                echo 'Chưa có đánh giá';
                            }
                            ?>
                            <span><?=round($total_rate,1); ?> (

                                <?
                                $num5 = new db_query("SELECT course_id FROM rate_course WHERE course_id = $course_id2");
                                echo mysql_num_rows($num5->result);
                                ?>)
                            </span>
                        </div>
                        <div class="prd-status">
                            <p>
                                <?
                                $num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id2");
                                $num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id2");
                                echo mysql_num_rows($num2->result) + mysql_num_rows($num3->result);
                                ?>
                                học viên mua
                            </p>
                        </div>
                        <div class="prd-item">
                            <div class="item">
                                <img class="lazyload" src="/img/load.gif"
                                data-src="../img/nguoi-moi.svg"><span><?php echo $rowCate['level_name'] ?></span>
                            </div>
                            <div class="item">
                                <img class="lazyload" src="/img/load.gif"
                                data-src="../img/chung-chi.svg"><span><?php echo $cer; ?></span>
                            </div>
                            <div class="item">
                                <img class="lazyload" src="/img/load.gif" width="16px" height="16px"
                                data-src="../img/image/clock.svg"><span><?php echo $rowCate['month_study'] ?>
                            tháng</span>
                        </div>
                        <?php echo $tag_name; ?>
                    </div>
                    <hr id="prd-item_hr">
                    <div class="prd-buy">
                            <div class="prices">
                                <?php 
                                    if ($rowCate['price_promotional'] == -1) {
                                        echo '<p>'.number_format($rowCate['price_listed']) . ' đ</p>';
                                    }else{
                                        echo '<p>'.number_format($rowCate['price_promotional']) . ' đ</p>
                                    <span style="height: 17.78px;"">'.number_format($rowCate['price_listed']). ' đ</span>';
                                    }
                                ?>
                            </div>
                            <?

                            if(isset($cookie_id)&& $cookie_type==1){
                                $db_order = new db_query("SELECT course_id,user_student_id FROM orders WHERE user_student_id = $cookie_id AND course_id=$course_id2");
                                $db_order2 = new db_query("SELECT course_id,user_student_id FROM order_student_common WHERE user_student_id = $cookie_id AND course_id=$course_id2");
                                if (mysql_num_rows($db_order->result)>0 || mysql_num_rows($db_order2->result)>0) {
                                    ?>
                                    <div class="buy-now2">
                                        <a>ĐÃ MUA</a>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                    <div class="buy-now">
                                        <a href="<?=urlOrders($cookie_id, $course_id2)?>">MUA NGAY</a>
                                        <?php $pri = ""; ?>
                                    </div>
                                    <?php
                                }
                            }else{
                                ?>
                                <div class="buy-now">
                                    <a data-toggle="modal" data-target="#modal-login">MUA NGAY</a>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</div>
</div>
</div>
</main>
<!--END: MAIN-->


<!-- FOOTER -->
<?php
include '../includes/h_popup_dangnhap2.php';
include '../includes/h_popup_detailcourse.php';
include '../includes/h_inc_footer.php';
?>
<!-- END: FOOTER -->
<script defer src="../js/v_search.js?v=<?=$version?>"></script>
<script type="text/javascript">
    var student_value = <?php echo $cookie_id; ?>;
    var arr_del = [];

    var course_id = <?php echo $course_id; ?>;
    var user_id = <?php echo $user_id; ?>;
    for (var i = 0; i < $('.clickrep').length; i++) {
        if ($('.clickrep')[i].dataset.set != user_id) {
            $('.del_cmt').eq(i).remove();
        }
    }

    for (var i = 0; i < $(".delrep").length; i++) {
        if ($(".delrep").eq(i)[0].dataset.rep != user_id) {
            $(".delrep").eq(i).remove();
        }
    }

    function v_save_course2(e) {
        if (student_value == 0) {
            $("#modal-login").modal("show");
        }else{
            $.ajax({
                url: '../ajax/v_student_save_center.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    course_id: $(e)[0].dataset.course
                },
                success: function (data) {
                    if ($(e).attr('src') == '../img/image/wpf_like (3).svg') {
                        $(e).attr('src', '../img/heart-yellow2.svg');
                    }else{
                        $(e).attr('src', '../img/image/wpf_like (3).svg');
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại");
                    // if ($(e).attr('src') == '../img/image/wpf_like (3).svg') {
                    //     $(e).attr('src', '../img/heart-yellow2.svg');
                    // }else{
                    //     $(e).attr('src', '../img/image/wpf_like (3).svg');
                    // }
                }
            });
            
        }
    }

    function del_cmt(e) {
        $.ajax({
            url: '../ajax/v_del_comment.php',
            type: 'POST',
            dataType: 'json',
            data: {
                rate_id: e.dataset.set,
                course_id: course_id
            },
            success: function(data) {
                $('.list-comment').html(data.html1);
                $(".rate_star").html(data.rate_star);
                $("#rate_side_lesson").html(data.rate_lesson);
                $("#rate_side_video").html(data.rate_video);
                $("#rate_side_teacher").html(data.rate_teacher);
                $('#v_count_rate').html('<li id="v_count_rate"><span>('+ data.countRate +' đánh giá )</span></li>');
                $(e).parent().parent().parent().remove();
                $("#v_write_comment").css('display', 'block');
            },
            error: function() {
                alert('Có lỗi xảy ra. Vui lòng thử lại');
            }
        });
    }

    function comment_rate() {
        if ($("#lesson1").val() == 0) {
            alert("Vui lòng đánh giá ít nhất là 1 sao");
            return false;
        } else if ($("#teacher1").val() == 0) {
            alert("Vui lòng đánh giá ít nhất là 1 sao");
            return false;
        } else if ($("#video1").val() == 0) {
            alert("Vui lòng đánh giá ít nhất là 1 sao");
            return false;
        } else if ($("#comment").val() == '') {
            alert("Đánh giá không được để trống");
            return false;
        } else if ($("#comment").val().length < 20) {
            alert("Đánh giá ít nhất 20 kí tự");
            return false;
        } else {
            var video = 0;
            var lesson = 0;
            var teacher = 0;
            var comment = $("#comment").val();
            for (var i = 1; i <= 5; i++) {
                lesson = lesson + Number($("#lesson" + i).val());
                teacher = teacher + Number($("#teacher" + i).val());
                video = video + Number($("#video" + i).val());
            }

            $("#btn_cmt_img").css('display', 'block');
            $("#btn_cmt_span").css('display', 'none');
            $("#btn-cmt")[0].type = 'button';
            $.ajax({
                url: '../ajax/v_ajax_comment_online.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    lesson: lesson,
                    teacher: teacher,
                    video: video,
                    comment: comment,
                    course_id: course_id
                },
                success: function(data) {
                    $('#v_write_comment').css('display', 'none');
                    $('.list-comment').html(data.html1);
                    $(".rate_star").html(data.rate_star);
                    $("#rate_side_lesson").html(data.rate_lesson);
                    $("#rate_side_video").html(data.rate_video);
                    $("#rate_side_teacher").html(data.rate_teacher);
                    $('#v_count_rate').html('<li id="v_count_rate"><span>('+ data.countRate +' đánh giá )</span></li>');
                    $('#comment-rate').modal('hide');
                    $("#btn_cmt_img").css('display', 'none');
                    $("#btn_cmt_span").css('display', 'block');
                    $("#btn-cmt")[0].type = 'submit';
                },
                error: function() {
                    alert('Có lỗi xảy ra. Vui lòng thử lại');
                    $("#btn_cmt_img").css('display', 'none');
                    $("#btn_cmt_span").css('display', 'block');
                    $("#btn-cmt")[0].type = 'submit';
                }

            });


            return false;
        }
    }

    function rep_Comment(e){
        if ($(e).children('.reply-comment-textarea').val() == "") {
            alert("Vui lòng nhập phản hồi");
            return false;
        }else{
            $(e).find('.btn_reply_img').css('display', 'block');
            $(e).find('.btn_reply_span').css('display', 'none');
            $(e).find('.btn_reply')[0].type = 'button';
            $.ajax({
                url: "../ajax/v_ajax_rep_comment.php",
                type: "POST",
                dataType: "json",
                data: {
                    rate_id: $(e).parent()[0].dataset.set,
                    course_id: <?php echo $course_id; ?>,
                    rep_comment: $(e).children(".reply-comment-textarea").val()
                },
                success: function (data) {
                    $(e).parent().prev().children(".std-content").append(data.html);
                    $(e).find('.btn_reply_img').css('display', 'none');
                    $(e).find('.btn_reply_span').css('display', 'block');
                    $(e).find('.btn_reply')[0].type = 'submit';
                    $(e).parent().toggle();
                },
                error: function(){
                    alert("Có lỗi xảy ra. Vui lòng thử lại");
                    $(e).find('.btn_reply_img').css('display', 'none');
                    $(e).find('.btn_reply_span').css('display', 'block');
                    $(e).find('.btn_reply')[0].type = 'submit';
                }
            });
        }
        return false;
    }

    function clickrep(e){
        $(e).parents(".cmt-student").next().toggle();
    }

    function delrep2(e) {
        var rep_id = $(e)[0].dataset.set;
        $.ajax({
            url: '../ajax/v_del_rep_comment.php',
            type: 'POST',
            dataType: 'json',
            data: {
                rep_id: rep_id
            },
            success: function (data) {
                if (data.type == 1) {
                    $(e).parent().parent().parent().remove();
                }
            },
            error: function (e) {
                alert("Có lỗi xảy ra. Vui lòng thử lại");
            }
        });   
    }
    $(".create_cart").click(function() {
       $.ajax({
           url: '../ajax/v_create_cart.php',
           type: 'GET',
           dataType: 'json',
           data: {
            course_id: <?php echo $course_id ?>,
           },
           success: function (data) {
                if (data.type == true) {
                    alert("Thêm vào giỏ hàng thành công");
                    $(".create_cart").addClass('create_cart2');
                    $(".create_cart2").removeClass('create_cart');
                    $(".listbuy3").html('<img src="../img/image/giohang.svg"> ĐÃ THÊM VÀO GIỎ HÀNG');
                }
           },
           error: function () {
               alert("Có lỗi xảy ra. Vui lòng thử lại");
           }
       });
       
    });
    if ("undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery");
    ! function(t) {
        "use strict";
        var e = jQuery.fn.jquery.split(" ")[0].split(".");
        if (e[0] < 2 && e[1] < 9 || 1 == e[0] && 9 == e[1] && e[2] < 1) throw new Error(
            "Bootstrap's JavaScript requires jQuery version 1.9.1 or higher")
    }(),
function(t) {
    "use strict";

    function e(e) {
        var i, o = e.attr("data-target") || (i = e.attr("href")) && i.replace(/.*(?=#[^\s]+$)/, "");
        return t(o)
    }

    function i(e) {
        return this.each(function() {
            var i = t(this),
            n = i.data("bs.collapse"),
            s = t.extend({}, o.DEFAULTS, i.data(), "object" == typeof e && e);
            !n && s.toggle && /show|hide/.test(e) && (s.toggle = !1), n || i.data("bs.collapse", n = new o(
                this, s)), "string" == typeof e && n[e]()
        })
    }
    var o = function(e, i) {
        this.$element = t(e), this.options = t.extend({}, o.DEFAULTS, i), this.$trigger = t(
            '[data-toggle="collapse"][href="#' + e.id + '"],[data-toggle="collapse"][data-target="#' + e
            .id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() :
        this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle()
    };
    o.VERSION = "3.3.4", o.TRANSITION_DURATION = 350, o.DEFAULTS = {
        toggle: !0
    }, o.prototype.dimension = function() {
        return this.$element.hasClass("width") ? "width" : "height"
    }, o.prototype.show = function() {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var e, n = this.$parent && this.$parent.children(".panel").children(".in, .collapsing");
            if (!(n && n.length && (e = n.data("bs.collapse"), e && e.transitioning))) {
                var s = t.Event("show.bs.collapse");
                if (this.$element.trigger(s), !s.isDefaultPrevented()) {
                    n && n.length && (i.call(n, "hide"), e || n.data("bs.collapse", null));
                    var a = this.dimension();
                    this.$element.removeClass("collapse").addClass("collapsing")[a](0).attr("aria-expanded", !
                        0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this
                    .transitioning = 1;
                    var r = function() {
                        this.$element.removeClass("collapsing").addClass("collapse in")[a](""), this
                        .transitioning = 0, this.$element.trigger("shown.bs.collapse")
                    };
                    if (!t.support.transition) return r.call(this);
                    var l = t.camelCase(["scroll", a].join("-"));
                    this.$element.one("bsTransitionEnd", t.proxy(r, this)).emulateTransitionEnd(o
                        .TRANSITION_DURATION)[a](this.$element[0][l])
                }
            }
        }
    }, o.prototype.hide = function() {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var e = t.Event("hide.bs.collapse");
            if (this.$element.trigger(e), !e.isDefaultPrevented()) {
                var i = this.dimension();
                this.$element[i](this.$element[i]())[0].offsetHeight, this.$element.addClass("collapsing")
                .removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed")
                .attr("aria-expanded", !1), this.transitioning = 1;
                var n = function() {
                    this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse")
                    .trigger("hidden.bs.collapse")
                };
                return t.support.transition ? void this.$element[i](0).one("bsTransitionEnd", t.proxy(n, this))
                .emulateTransitionEnd(o.TRANSITION_DURATION) : n.call(this)
            }
        }
    }, o.prototype.toggle = function() {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    }, o.prototype.getParent = function() {
        return t(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent +
            '"]').each(t.proxy(function(i, o) {
                var n = t(o);
                this.addAriaAndCollapsedClass(e(n), n)
            }, this)).end()
        }, o.prototype.addAriaAndCollapsedClass = function(t, e) {
            var i = t.hasClass("in");
            t.attr("aria-expanded", i), e.toggleClass("collapsed", !i).attr("aria-expanded", i)
        };
        var n = t.fn.collapse;
        t.fn.collapse = i, t.fn.collapse.Constructor = o, t.fn.collapse.noConflict = function() {
            return t.fn.collapse = n, this
        }, t(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function(o) {
            var n = t(this);
            n.attr("data-target") || o.preventDefault();
            var s = e(n),
            a = s.data("bs.collapse") ? "toggle" : n.data();
            i.call(s, a)
        })
    }(jQuery)
</script>
<script src="../js/detail_course.js?v=<?=$version?>"></script>
</body>

</html>