<?
require_once '../code_xu_ly/h_home.php';
if (!isset($_COOKIE['user_id'])) {
    $arr_cate_id = [];
}else{
    if ($_COOKIE['user_type'] == 1) {
        $arr_cate_id = explode(",", $row['cate_id']);
    }else{
        $arr_cate_id = [];
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
    <title>Home</title>
    <link rel="preload" href="/css/h_home.css?v=<?=$version?>" as="style">
    <?
    require_once '../includes/h_inc_css.php';
    if(isset($_COOKIE['user_id'])){
        echo "
        <link rel='preload' href='/css/slick-theme.css?v=".$version."' as='style'>
        <link rel='preload' href='/css/slick.css?v=".$version."' as='style'>
        <link rel='stylesheet' href='/css/slick-theme.css?v=".$version."'>
        <link rel='stylesheet' href='/css/slick.css?v=".$version."' >
        ";
    }
    ?>
    <link rel="stylesheet" href="../css/h_home.css?v=<?=$version?>">
    
        <?php if ($cookie_type==3 || $cookie_type==2) {
            ?>
            <style>
            .like-product2 {
                display: none;
            }
            </style>
            <?php
        }

        ?>

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
        <div id="all-feature">
            <div class="container">
                <!--ĐĂNG KÍ NHIỀU NHẤT TUẦN-->
                <?php
                $timeStart = strtotime("previous Monday");
                $timeEnd = strtotime("previous Monday") + 518400;
                $arr_course_sum = [];
                $qrCount = new db_query("SELECT orders.course_id FROM orders INNER JOIN courses ON orders.course_id = courses.course_id WHERE courses.hide_course = 1 AND courses.accept = 1 AND orders.day_buy > $timeStart AND orders.day_buy < $timeEnd");
                while ($rowCount = mysql_fetch_array($qrCount->result)) {
                    if (!isset($arr_course_sum[$rowCount['course_id']])) {
                        $arr_course_sum[$rowCount['course_id']] = 1;
                    }else{
                        $arr_course_sum[$rowCount['course_id']]++;
                    }
                }

                $qrCommon = new db_query("SELECT order_student_common.course_id,day_buy_common FROM order_student_common INNER JOIN courses ON order_student_common.course_id = courses.course_id WHERE courses.hide_course = 1 AND courses.accept = 1");
                while ($rowCommon = mysql_fetch_array($qrCommon->result)) {
                    $day_buy = strtotime($rowCommon['day_buy_common']);
                    if ($day_buy > $timeStart && $day_buy < $timeEnd) {
                        if (!isset($arr_course_sum[$rowCommon['course_id']])) {
                            $arr_course_sum[$rowCommon['course_id']] = 1;
                        }else{
                            $arr_course_sum[$rowCommon['course_id']]++;
                        }
                    }
                }
                arsort($arr_course_sum);
                // print_r($arr_course_sum);
                if (count($arr_course_sum)>0) {
                    ?>
                    <div id="dknhieutuan">
                        <div class="title-home">
                            <hr>
                            <h2>ĐĂNG KÝ NHIỀU NHẤT TUẦN</h2>
                        </div>
                        <div class="feature-main">
                            <?php
                            $i = 0;
                            foreach ($arr_course_sum as $key => $value) {
                                if ($i == 6) {
                                    break;
                                }else {
                                    $i++;
                                }
                                $qrYouLike = new db_query("SELECT *,COUNT(rate_id),(sum(lesson)+sum(teacher)),(sum(lesson)+sum(video)+sum(teacher)) FROM courses LEFT JOIN rate_course ON rate_course.course_id = courses.course_id INNER JOIN orders ON orders.course_id = courses.course_id INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN users ON users.user_id = courses.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.hide_course = 1 AND courses.accept = 1 AND courses.course_id = $key AND courses.price_listed > -1 GROUP BY orders.course_id ORDER BY COUNT(orders.course_id) DESC LIMIT 0,6");
                            
                            while ($rowOff = mysql_fetch_array($qrYouLike->result)) {
                                $course_id = $rowOff['course_id'];
                                if ($rowOff['user_type'] == 2) {
                                    $linkct = urlDetail_teacher($rowOff['user_id'], $rowOff['user_slug']);
                                } elseif ($rowOff['user_type'] == 3) {
                                    $linkct = urlDetail_center($rowOff['user_id'], $rowOff['user_slug']);
                                }

                                if ($rowOff['certification'] == 1) {
                                    $cer = "Cấp chứng chỉ";
                                } else {
                                    $cer = "Không cấp chứng chỉ";
                                } 

                                if ($rowOff['tag_id'] != 0) {
                                    $tag_id = $rowOff['tag_id'];
                                    $qrTag = new db_query("SELECT tag_name, cate_icon FROM tags JOIN categories ON tags.cate_id=categories.cate_id WHERE tag_id = '$tag_id'");
                                    $rowTag = mysql_fetch_array($qrTag->result);
                                    $cate_id = $rowOff['cate_id'];

                                    $tag_name = '<div class="item">
                                    <img width="16" height="16" src="/img/load.gif" data-src="../img/categories/'. $rowTag['cate_icon'] .'" class="lazyload v_cate_icon"><span>'.$rowTag['tag_name'].'</span>
                                    </div>';
                                }else{
                                    $tag_name = '<div class="item">
                                    <img width="16" height="16" src="/img/load.gif" data-src="../img/categories/'. $rowOff['cate_icon'] .'" class="lazyload v_cate_icon"><span>'.$rowOff['cate_name'].'</span>
                                    </div>';
                                }
                                if ($rowOff['course_type'] == 1) {
                                    $linkCourse = urlDetail_courseOffline($rowOff['course_id'], $rowOff['course_slug']);
                                } elseif ($rowOff['course_type'] == 2) {
                                    $linkCourse = urlDetail_courseOnline($rowOff['course_id'], $rowOff['course_slug']);
                                }
                                ?>
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="<?php echo $linkCourse; ?>"><img class="img-main lazyload"
                                        onerror='this.onerror=null;this.src="../img/avatar/error.png";' src="/img/load.gif"
                                        data-src="../img/course/<?php echo $rowOff['course_avatar']; ?>" alt=""></a>
                                        <div class="detail">
                                            <div class="detai-img">
                                                <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                                class="lazyload" src="/img/load.gif"
                                                data-src="../img/avatar/<?php echo $rowOff['user_avatar']; ?>" alt="">
                                            </div>
                                            <div class="detai-item">
                                                <a href="<?php echo $linkct; ?>">
                                                    <p class="detai-item1"><?php echo $rowOff['user_name']; ?></p>
                                                </a>
                                                <p class="detai-item2"><?php echo $rowOff['cate_name']; ?></p>
                                            </div>
                                        </div>
                                        <?php
                                        $qrSave = new db_query("SELECT save_id FROM save_course WHERE user_student_id = $cookie_id AND course_id = " . $rowOff['course_id']);

                                        if (mysql_num_rows($qrSave->result) == 0) {
                                            $srcS = '../img/image/wpf_like (3).svg';
                                        } else {
                                            $srcS = '../img/heart-yellow2.svg';
                                        } ?>
                                        <div class="like">
                                            <button onclick="v_save_course(this)"
                                            value="<?php echo $rowOff['course_id']; ?>"><img
                                            class="like-product2 v_save<?php echo $rowOff['course_id']; ?> lazyload" src="/img/load.gif"
                                            data-src="<?php echo $srcS; ?>"></button>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <div class="prd-name">
                                            <a href="<?php echo $linkCourse; ?>">
                                                <p><?php echo $rowOff['course_name']; ?></p>
                                            </a>
                                        </div>
                                        <div class="star-rate">
                                            <?php
                                            if ($rowOff['COUNT(rate_id)'] >0) {
                                                if ($rowOff['course_type']==1) {
                                                    $sumall = $rowOff['(sum(lesson)+sum(teacher))']/2;
                                                    $total_rate = $sumall/$rowOff['COUNT(rate_id)'];
                                                } elseif ($rowOff['course_type']==2) {
                                                    $sumall = $rowOff['(sum(lesson)+sum(video)+sum(teacher))']/3;
                                                    $total_rate = $sumall/$rowOff['COUNT(rate_id)'];
                                                }
                                            } else {
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
                                            } elseif ($total_rate < 2 && $total_rate >= 1) {
                                                echo '
                                                <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
                                                ';
                                            } else {
                                                echo 'Chưa có đánh giá';
                                            } ?>
                                            <span><?php echo round($total_rate, 1); ?> (<?php $num5 = new db_query("SELECT course_id FROM rate_course WHERE course_id = $course_id");
                                            echo mysql_num_rows($num5->result); ?>)</span>
                                        </div>
                                        <div class="prd-status">
                                            <p><?php
                                            $num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
                                            $num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");

                                            echo mysql_num_rows($num2->result) + mysql_num_rows($num3->result); ?> học viên đã mua</p>
                                        </div>
                                        <div class="prd-item">
                                            <div class="item">
                                                <img class="lazyload" src="/img/load.gif" width="16" height="16"
                                                data-src="../img/nguoi-moi.svg"><span><?php echo $rowOff['level_name'] ?></span>
                                            </div>
                                            <div class="item">
                                                <img class="lazyload" src="/img/load.gif" width="16" height="16"
                                                data-src="../img/chung-chi.svg"><span><?php echo $cer; ?></span>
                                            </div>
                                            <div class="item">
                                                <img class="lazyload" src="/img/load.gif" width="16" height="16"
                                                data-src="../img/image/clock.svg"><span><?php echo $rowOff['month_study'] ?>
                                            tháng</span>
                                        </div>
                                        <?=$tag_name?>
                                    </div>
                                    <hr>
                                    <div class="prd-buy">
                                            <div class="prices">
                                                <?php
                                                if ($rowOff['price_promotional'] == -1) {
                                                    echo '<p>'.number_format($rowOff['price_listed']) . ' đ'.'</p>';
                                                }else{
                                                    echo '<p>'.number_format($rowOff['price_promotional']) . ' đ'.'</p>
                                                    <span>'.number_format($rowOff['price_listed']). ' đ'.'</span>';
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            if ($cookie_id != 0 && $cookie_type == 1) {
                                                $db_order = new db_query("SELECT course_id,user_student_id FROM orders WHERE user_student_id = $cookie_id AND course_id=$course_id");
                                                $db_order2 = new db_query("SELECT course_id,user_student_id FROM order_student_common WHERE user_student_id = $cookie_id AND course_id=$course_id");
                                                if (mysql_num_rows($db_order->result)>0 || mysql_num_rows($db_order2->result)>0) {
                                                    if ($rowOff['course_type'] == 1) {
                                                        echo '<div class="buy-now2">
                                                        <a>ĐÃ ĐẶT CHỖ</a>
                                                        </div>';
                                                    }else{
                                                        echo '<div class="buy-now2">
                                                        <a>ĐÃ MUA</a>
                                                        </div>';
                                                    }
                                                }else{
                                                    if ($rowOff['course_type'] == 1) {
                                                        echo '<div class="buy-nowOf buy_now'.$rowOff['course_id'].'" onclick="v_datcho('.$rowOff['course_id'].')">
                                                        <a>ĐĂT CHỖ</a>
                                                        </div>';
                                                    }else{
                                                        echo '<a class="buy-now" href="'.urlOrders($cookie_id, $course_id).'">
                                                        <span>MUA NGAY</span>
                                                        </a>';
                                                    }
                                                }
                                            }else{
                                                if ($rowOff['course_type'] == 1) {
                                                    echo '<div class="buy-now0" data-toggle="modal" data-target="#modal-login">
                                                    <a>ĐẶT CHỖ</a>
                                                    </div>';
                                                }else{
                                                    echo '<div class="buy-now0" data-toggle="modal" data-target="#modal-login">
                                                    <a>MUA NGAY</a>
                                                    </div>';
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                        } ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <!--CÓ THỂ BẠN SẼ THÍCH-->
            <div id="bansethich">
                <div class="title-home">
                    <hr>
                    <h2>CÓ THỂ BẠN SẼ THÍCH</h2>
                </div>
                <div class="feature-main2" id="feature-slider">
                    <?php
                        //Lấy cate_id của user về dạng (1,2,3,...,n)
                    if (count($arr_cate_id) == 0) {
                        $strCate = '(0)';
                    }else if (count($arr_cate_id) == 1) {
                        $strCate = '(' . $arr_cate_id[0] . ')';
                    }else{
                        for ($i = 0; $i < count($arr_cate_id); $i++) {
                            if ($i == 0) {
                                $strCate = '(' . $arr_cate_id[$i] . ',';
                            }else if ($i > 0 && $i < count($arr_cate_id) - 1) {
                                $strCate = $strCate . $arr_cate_id[$i] . ',';
                            }else if ($i == count($arr_cate_id) - 1){
                                $strCate = $strCate . $arr_cate_id[$i] . ')';
                            }
                        }
                    }
                    $qrYouLike = new db_query("SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN users ON users.user_id = courses.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.cate_id IN $strCate AND courses.price_listed > -1 AND courses.hide_course = 1 AND courses.accept = 1 ORDER BY courses.course_id DESC");
                    while ($rowOff = mysql_fetch_array($qrYouLike->result)) {
                        $course_id = $rowOff['course_id'];
                        if ($rowOff['user_type'] == 2) {
                            $linkct = urlDetail_teacher($rowOff['user_id'], $rowOff['user_slug']);
                        }else if ($rowOff['user_type'] == 3) {
                            $linkct = urlDetail_center($rowOff['user_id'], $rowOff['user_slug']);
                        }
                        if ($rowOff['tag_id'] != 0) {
                            $tag_id = $rowOff['tag_id'];
                            $qrTag = new db_query("SELECT * FROM tags JOIN categories ON tags.cate_id=categories.cate_id WHERE tag_id = '$tag_id'");
                            $rowTag = mysql_fetch_array($qrTag->result);
                            $cate_id = $rowOff['cate_id'];

                            $tag_name = '<div class="item">
                            <img width="16" height="16" src="/img/load.gif" data-src="../img/categories/'. $rowTag['cate_icon'] .'" class="lazyload v_cate_icon"><span>'.$rowTag['tag_name'].'</span>
                            </div>';
                        }else{
                            $tag_name = '<div class="item">
                            <img width="16" height="16" src="/img/load.gif" data-src="../img/categories/'. $rowOff['cate_icon'] .'" class="lazyload v_cate_icon"><span>'.$rowOff['cate_name'].'</span>
                            </div>';
                        }

                        if ($rowOff['certification'] == 1) {
                            $cer = "Cấp chứng chỉ";
                        }else{
                            $cer = "Không cấp chứng chỉ";
                        }
                        ?>
                        <div class="product-item">
                            <div class="product-img">
                                <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                class="img-main lazyload" src="/img/load.gif"
                                data-src="../img/course/<?php echo $rowOff['course_avatar']; ?>" alt="">
                                <div class="detail">
                                    <div class="detai-img">

                                        <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                        class="lazyload" src="/img/load.gif"
                                        data-src="../img/avatar/<?php echo $rowOff['user_avatar']; ?>" alt="">
                                    </div>
                                    <div class="detai-item">
                                        <a href="<?php echo $linkct; ?>">
                                            <p class="detai-item1"><?php echo $rowOff['user_name']; ?></p>
                                        </a>
                                        <p class="detai-item2"><?php echo $rowOff['cate_name']; ?></p>
                                    </div>
                                </div>
                                <?php 
                                $qrSave = new db_query("SELECT save_id FROM save_course WHERE user_student_id = $cookie_id AND course_id = " . $rowOff['course_id']);
                                if (mysql_num_rows($qrSave->result) == 0) {
                                    $srcS = '../img/image/wpf_like (3).svg';
                                }else{
                                    $srcS = '../img/heart-yellow2.svg';
                                }
                                ?>
                                <div class="like">
                                    <button onclick="v_save_course(this)"
                                    value="<?php echo $rowOff['course_id']; ?>"><img
                                    class="like-product2 v_save<?php echo $rowOff['course_id']; ?> lazyload" src="/img/load.gif"
                                    data-src="<?php echo $srcS; ?>"></button>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="prd-name">
                                    <?php 
                                    if ($rowOff['course_type'] == 1) {
                                        $linkCourse = urlDetail_courseOffline($rowOff['course_id'],$rowOff['course_slug']);
                                    }else if ($rowOff['course_type'] == 2){
                                        $linkCourse = urlDetail_courseOnline($rowOff['course_id'],$rowOff['course_slug']);
                                    }
                                    ?>
                                    <a href="<?php echo $linkCourse; ?>">
                                        <p><?php echo $rowOff['course_name']; ?></p>
                                    </a>
                                </div>
                                <div class="star-rate">
                                    <?
                                    $qrrate = new db_query("SELECT Count(*) as total FROM rate_course WHERE course_id = " . $rowOff['course_id']);
                                    $rowcount=mysql_fetch_array($qrrate->result);
                                    $numrate = $rowcount['total'];
                                    if ($numrate >0) {
                                        if ($rowOff['course_type']==1) {
                                            $qrsum = new db_query("SELECT (sum(lesson)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
                                            $rowsum = mysql_fetch_array($qrsum->result);
                                            $sumall = $rowsum['(sum(lesson)+sum(teacher))']/2;
                                            $total_rate = $sumall/$numrate;
                                        } elseif ($rowOff['course_type']==2) {
                                            $qrsum = new db_query("SELECT (sum(lesson)+sum(video)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
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
                                    <span><?php echo round($total_rate, 1);?> (<?php $num5 = new db_query("SELECT course_id FROM rate_course WHERE course_id = " . $rowOff['course_id']);
                                    echo mysql_num_rows($num5->result); ?>)</span>
                                </div>
                                <div class="prd-status">
                                    <p><?php
                                    $num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
                                    $num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");
                                    echo mysql_num_rows($num2->result) + mysql_num_rows($num3->result);
                                    ?> học viên đã mua</p>
                                </div>
                                <div class="prd-item">
                                    <div class="item">
                                        <img class="lazyload" src="/img/load.gif" width="16" height="16"
                                        data-src="../img/nguoi-moi.svg"><span><?php echo $rowOff['level_name'] ?></span>
                                    </div>
                                    <div class="item">
                                        <img class="lazyload" src="/img/load.gif" width="16" height="16"
                                        data-src="../img/chung-chi.svg"><span><?php echo $cer; ?></span>
                                    </div>
                                    <div class="item">
                                        <img class="lazyload" src="/img/load.gif" width="16" height="16"
                                        data-src="../img/image/clock.svg"><span><?php echo $rowOff['month_study'] ?>
                                    tháng</span>
                                </div>
                                <?=$tag_name?>
                            </div>
                            <hr>
                            <div class="prd-buy">
                                <div class="prices">
                                    <?php
                                    if ($rowOff['price_promotional'] == -1) {
                                        echo '<p>'.number_format($rowOff['price_listed']) . ' đ'.'</p>';
                                    }else{
                                        echo '<p>'.number_format($rowOff['price_promotional']) . ' đ'.'</p>
                                        <span>'.number_format($rowOff['price_listed']). ' đ'.'</span>';
                                    }
                                    ?>
                                </div>
                                <?
                                if (isset($cookie_id)&& $cookie_type==1) {
                                    $db_order = new db_query("SELECT course_id,user_student_id FROM orders WHERE user_student_id = $cookie_id AND course_id=$course_id");
                                    $db_order2 = new db_query("SELECT course_id,user_student_id FROM order_student_common WHERE user_student_id = $cookie_id AND course_id=$course_id");
                                    if (mysql_num_rows($db_order->result)>0 || mysql_num_rows($db_order2->result)>0) {
                                        if ($rowOff['course_type'] == 1) {
                                            echo '<div class="buy-now2">
                                            <a>ĐÃ ĐẶT CHỖ</a>
                                            </div>';
                                        }else{
                                            echo '<div class="buy-now2">
                                            <a>ĐÃ MUA</a>
                                            </div>';
                                        }
                                    }else{
                                        if ($rowOff['course_type'] == 1) {
                                            echo '<div class="buy-nowOf buy_now'.$rowOff['course_id'].'" onclick="v_datcho('.$rowOff['course_id'].')">
                                            <a>ĐẶT CHỖ</a>
                                            </div>';
                                        }else{
                                            echo '<a class="buy-now" href="'.urlOrders($cookie_id, $course_id).'">
                                            <span>MUA NGAY</span>
                                            </a>';
                                        }
                                    }
                                }else{
                                    if ($rowOff['course_type'] == 1) {
                                        echo '<div class="buy-now0" data-toggle="modal" data-target="#modal-login">
                                        <a>ĐẶT CHỖ</a>
                                        </div>';
                                    }else{
                                        echo '<div class="buy-now0" data-toggle="modal" data-target="#modal-login">
                                        <a>MUA NGAY</a>
                                        </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        // }
                }
                ?>
            </div>
        </div>

        <!--TOP KHÓA HỌC OFFLINE-->
        <div id="topoffline">
            <div class="title-home">
                <hr>
                <h2>TOP KHÓA HỌC OFFLINE</h2>
                <?php 
                $arr_cate = [];
                $qrCate = new db_query("SELECT cate_id FROM courses WHERE course_type = 1 AND hide_course = 1 AND accept = 1");
                while ($rowOff = mysql_fetch_array($qrCate->result)) {
                    if (!isset($arr_cate[$rowOff['cate_id']])) {
                        $arr_cate[$rowOff['cate_id']] = 1;
                    }else{
                        $arr_cate[$rowOff['cate_id']]++;
                    }
                }
                $count_offline = mysql_num_rows($qrCate->result);
                arsort($arr_cate);
                ?>
            </div>
            <div class="product-tag">
                <?php 
                $k = 0;
                foreach ($arr_cate as $key => $value) {
                    if ($k == 2) {
                        break;
                    }
                    $qrCa = new db_query("SELECT cate_name, cate_slug FROM categories WHERE cate_id = '$key'");
                    $rowCa = mysql_fetch_array($qrCa->result);
                    echo '<a class="tag-item" href="'. urlOffline_cate($key, $rowCa['cate_slug']) .'">
                    <span>'.$rowCa['cate_name'].'
                    ('.$value.')</span>
                    </a>';
                    $k++;
                } 
                ?>
            </div>
            <div class="feature-main" id="feature-main-offline">
                <?php 
                $qrOff = new db_query("SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN users ON users.user_id = courses.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_type = 1 AND courses.hide_course = 1 AND courses.accept = 1 ORDER BY courses.course_id DESC LIMIT 0,6");
                while ($rowOff = mysql_fetch_array($qrOff->result)) {
                    $course_id = $rowOff['course_id'];
                    if ($rowOff['user_type'] == 2) {
                        $linkct = urlDetail_teacher($rowOff['user_id'], $rowOff['user_slug']);
                    }else if ($rowOff['user_type'] == 3) {
                        $linkct = urlDetail_center($rowOff['user_id'], $rowOff['user_slug']);
                    }
                    if ($rowOff['tag_id'] != 0) {
                        $tag_id = $rowOff['tag_id'];
                        $qrTag = new db_query("SELECT tag_name, cate_icon FROM tags JOIN categories ON tags.cate_id=categories.cate_id WHERE tag_id = '$tag_id'");
                        $rowTag = mysql_fetch_array($qrTag->result);
                        $cate_id = $rowOff['cate_id'];

                        $tag_name = '<div class="item">
                        <img width="16" height="16" src="/img/load.gif" data-src="../img/categories/'. $rowTag['cate_icon'] .'" class="lazyload v_cate_icon"><span>'.$rowTag['tag_name'].'</span>
                        </div>';
                    }else{
                        $tag_name = '<div class="item">
                        <img width="16px" height="16px" src="/img/load.gif" data-src="../img/categories/'. $rowOff['cate_icon'] .'" class="lazyload v_cate_icon"><span>'.$rowOff['cate_name'].'</span>
                        </div>';
                    }

                    if ($rowOff['certification'] == 1) {
                        $cer = "Cấp chứng chỉ";
                    }else{
                       $cer = "Không cấp chứng chỉ";
                   }

                   ?>
                   <div class="product-item">
                    <div class="product-img">
                        <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                        class="img-main lazyload" src="/img/load.gif"
                        data-src="../img/course/<?php echo $rowOff['course_avatar']; ?>" alt="">
                        <div class="detail">
                            <div class="detai-img">

                                <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                class="lazyload" src="/img/load.gif"
                                data-src="../img/avatar/<?php echo $rowOff['user_avatar']; ?>" alt="">
                            </div>
                            <div class="detai-item">
                                <a href="<?php echo $linkct; ?>">
                                    <p class="detai-item1"><?php echo $rowOff['user_name']; ?></p>
                                </a>
                                <p class="detai-item2"><?php echo $rowOff['cate_name']; ?></p>
                            </div>
                        </div>
                        <?php 
                        $qrSave = new db_query("SELECT save_id FROM save_course WHERE user_student_id = $cookie_id AND course_id = " . $rowOff['course_id']);
                        if (mysql_num_rows($qrSave->result) == 0) {
                            $srcS = '../img/image/wpf_like (3).svg';
                        }else{
                            $srcS = '../img/heart-yellow2.svg';
                        }
                        ?>
                        <div class="like">
                            <button onclick="v_save_course(this)"
                            value="<?php echo $rowOff['course_id']; ?>"><img
                            class="like-product2 v_save<?php echo $rowOff['course_id']; ?> lazyload" src="/img/load.gif"
                            data-src="<?php echo $srcS; ?>"></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="prd-name">
                            <a
                            href="<?php echo urlDetail_courseOffline($rowOff['course_id'],$rowOff['course_slug']); ?>">
                            <p><?php echo $rowOff['course_name']; ?></p>
                        </a>
                    </div>
                    <div class="star-rate">
                        <?
                        $qrrate = new db_query("SELECT Count(*) as total FROM rate_course WHERE course_id = $course_id");
                        $rowcount=mysql_fetch_array($qrrate->result);
                        $numrate = $rowcount['total'];
                        if ($numrate >0) {
                            if ($rowOff['course_type']==1) {
                                $qrsum = new db_query("SELECT (sum(lesson)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
                                $rowsum = mysql_fetch_array($qrsum->result);
                                $sumall = $rowsum['(sum(lesson)+sum(teacher))']/2;
                                $total_rate = $sumall/$numrate;
                            } elseif ($rowOff['course_type']==2) {
                                $qrsum = new db_query("SELECT (sum(lesson)+sum(video)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
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
                        <span><?php echo round($total_rate, 1);?> (<?php $num5 = new db_query("SELECT course_id FROM rate_course WHERE course_id = $course_id");
                        echo mysql_num_rows($num5->result); ?>)
                    </span>
                </div>
                <div class="prd-status">
                    <p><?php
                    $num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
                    $num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");
                    echo mysql_num_rows($num2->result) + mysql_num_rows($num3->result);
                    ?> học viên đã mua</p>
                </div>
                <div class="prd-item">
                    <div class="item">
                        <img class="lazyload" src="/img/load.gif" width="16" height="16"
                        data-src="../img/nguoi-moi.svg"><span><?php echo $rowOff['level_name'] ?></span>
                    </div>
                    <div class="item">
                        <img class="lazyload" src="/img/load.gif" width="16" height="16"
                        data-src="../img/chung-chi.svg"><span><?php echo $cer; ?></span>
                    </div>
                    <div class="item">
                        <img class="lazyload" src="/img/load.gif" width="16" height="16"
                        data-src="../img/image/clock.svg"><span><?php echo $rowOff['month_study'] ?>
                    tháng</span>
                </div>
                <?=$tag_name?>
            </div>
            <hr>
            <div class="prd-buy">
                    <div class="prices">
                        <?php
                        if ($rowOff['price_promotional'] == -1) {
                            echo '<p>'.number_format($rowOff['price_listed']) . ' đ'.'</p>';
                        }else{
                            echo '<p>'.number_format($rowOff['price_promotional']) . ' đ'.'</p>
                            <span>'.number_format($rowOff['price_listed']). ' đ'.'</span>';
                        }
                        ?>
                    </div>
                    <?
                    if(isset($cookie_id)&& $cookie_type==1){
                        $db_order = new db_query("SELECT course_id,user_student_id FROM orders WHERE user_student_id = $cookie_id AND course_id=$course_id");
                        if (mysql_num_rows($db_order->result)>0) {
                            echo '<div class="buy-now2">
                            <a>ĐÃ ĐẶT CHỖ</a>
                            </div>';
                        }else{
                            echo '<div class="buy-nowOf buy_now'.$rowOff['course_id'].'" onclick="v_datcho('.$rowOff['course_id'].')">
                            <a>ĐẶT CHỖ</a>
                            </div>';
                        }
                    }else{
                        echo '<div class="buy-now0" data-toggle="modal" data-target="#modal-login">
                        <a>ĐẶT CHỖ</a>
                        </div>';
                    }
                ?>
            </div>
        </div>
    </div>
    <?php
}
?>
</div>

<!--xem them-->
<div class="xemthem xemthem-offline">
    <a id="xemthem-online" href="/khoa-hoc-offline.html"> XEM THÊM</a>
</div>

</div>

<!--TOP KHÓA HỌC ONLINE-->
<div id="toponline">
    <div class="title-home">
        <hr>
        <h2>TOP KHÓA HỌC ONLINE</h2>
        <?php 
        $arr_cate = [];
        $qrCate = new db_query("SELECT cate_id FROM courses WHERE course_type = 2 AND hide_course = 1 AND accept = 1");
        while ($rowOff = mysql_fetch_array($qrCate->result)) {
            if (!isset($arr_cate[$rowOff['cate_id']])) {
                $arr_cate[$rowOff['cate_id']] = 1;
            }else{
                $arr_cate[$rowOff['cate_id']]++;
            }
        }
        $qrCount = new db_query("SELECT course_id FROM courses WHERE course_type = 2 AND hide_course = 1 AND accept = 1 AND courses.price_listed != 'false'");
        $count_online = mysql_num_rows($qrCount->result);
        arsort($arr_cate);
        ?>
    </div>
    <div class="product-tag">
        <?php 
        $k = 0;
        foreach ($arr_cate as $key => $value) {
            if ($k == 2) {
                break;
            }
            $qrCa = new db_query("SELECT cate_name, cate_slug FROM categories WHERE cate_id = '$key'");
            $rowCa = mysql_fetch_array($qrCa->result);
            echo '<a class="tag-item" href="'. urlOnline_cate($key, $rowCa['cate_slug']) .'">
            <span>'.$rowCa['cate_name'].'
            ('.$value.')</span>
            </a>';
            $k++;
        } 
        ?>
    </div>
    <div class="feature-main" id="feature-main-online">
        <?php 
        $qrOn = new db_query("SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN users ON users.user_id = courses.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_type = 2 AND courses.price_listed > -1 AND courses.hide_course = 1 AND courses.accept = 1 ORDER BY courses.course_id DESC LIMIT 0,6");
        while ($rowOff = mysql_fetch_array($qrOn->result)) {
            $course_id = $rowOff['course_id'];
            if ($rowOff['user_type'] == 2) {
                $linkct = urlDetail_teacher($rowOff['user_id'], $rowOff['user_slug']);
            }else if ($rowOff['user_type'] == 3) {
                $linkct = urlDetail_center($rowOff['user_id'], $rowOff['user_slug']);
            }
            if ($rowOff['certification'] == 1) {
                $cer = "Cấp chứng chỉ";
            }else {
                $cer = "Không cấp chứng chỉ";
            }
            if ($rowOff['tag_id'] != 0) {
                $tag_id = $rowOff['tag_id'];
                $qrTag = new db_query("SELECT tag_name, cate_icon FROM tags JOIN categories ON tags.cate_id=categories.cate_id WHERE tag_id = '$tag_id'");
                $rowTag = mysql_fetch_array($qrTag->result);
                $cate_id = $rowOff['cate_id'];

                $tag_name = '<div class="item">
                <img width="16px" height="16px" src="/img/load.gif" data-src="../img/categories/'. $rowTag['cate_icon'] .'" class="lazyload v_cate_icon"><span>'.$rowTag['tag_name'].'</span>
                </div>';
            }else{
                $tag_name = '<div class="item">
                <img width="16px" height="16px" src="/img/load.gif" data-src="../img/categories/'. $rowOff['cate_icon'] .'" class="lazyload v_cate_icon"><span>'.$rowOff['cate_name'].'</span>
                </div>';
            }
            ?>
            <div class="product-item">
                <div class="product-img">
                    <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                    class="img-main lazyload" src="/img/load.gif"
                    data-src="../img/course/<?php echo $rowOff['course_avatar']; ?>" alt="">
                    <div class="detail">
                        <div class="detai-img">
                            <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                            class="lazyload" src="/img/load.gif"
                            data-src="../img/avatar/<?php echo $rowOff['user_avatar']; ?>" alt="">
                        </div>
                        <div class="detai-item">
                            <a href="<?php echo $linkct; ?>">
                                <p class="detai-item1"><?php echo $rowOff['user_name']; ?></p>
                            </a>
                            <p class="detai-item2"><?php echo $rowOff['cate_name']; ?></p>
                        </div>
                    </div>
                    <?php 
                    $qrSave = new db_query("SELECT save_id FROM save_course WHERE user_student_id = $cookie_id AND course_id = " . $rowOff['course_id']);
                    if (mysql_num_rows($qrSave->result) == 0) {
                        $srcS = '../img/image/wpf_like (3).svg';
                    }else{
                        $srcS = '../img/heart-yellow2.svg';
                    }
                    ?>
                    <div class="like">
                        <button onclick="v_save_course(this)"
                        value="<?php echo $rowOff['course_id']; ?>"><img
                        class="like-product2 v_save<?php echo $rowOff['course_id']; ?> lazyload" src="/img/load.gif"
                        data-src="<?php echo $srcS; ?>"></button>
                    </div>
                </div>
                <div class="product-info">
                    <div class="prd-name">
                        <a
                        href="<?php echo urlDetail_courseOnline($rowOff['course_id'],$rowOff['course_slug']); ?>">
                        <p><?php echo $rowOff['course_name']; ?></p>
                    </a>
                </div>
                <div class="star-rate">
                    <?
                    $qrrate = new db_query("SELECT Count(*) as total FROM rate_course WHERE course_id = $course_id");
                    $rowcount=mysql_fetch_array($qrrate->result);
                    $numrate = $rowcount['total'];
                    if ($numrate >0) {
                        if ($rowOff['course_type']==1) {
                            $qrsum = new db_query("SELECT (sum(lesson)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
                            $rowsum = mysql_fetch_array($qrsum->result);
                            $sumall = $rowsum['(sum(lesson)+sum(teacher))']/2;
                            $total_rate = $sumall/$numrate;
                        } elseif ($rowOff['course_type']==2) {
                            $qrsum = new db_query("SELECT (sum(lesson)+sum(video)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
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
                    <span><?php echo round($total_rate, 1);?> (<?php $num5 = new db_query("SELECT course_id FROM rate_course WHERE course_id = $course_id");
                    echo mysql_num_rows($num5->result); ?>)</span>
                </div>
                <div class="prd-status">
                    <p><?php
                    $num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
                    $num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");
                    echo mysql_num_rows($num2->result) + mysql_num_rows($num3->result);
                    ?> học viên đã mua</p>
                </div>
                <div class="prd-item">
                    <div class="item">
                        <img class="lazyload" src="/img/load.gif" width="16" height="16"
                        data-src="../img/nguoi-moi.svg"><span><?php echo $rowOff['level_name'] ?></span>
                    </div>
                    <div class="item">
                        <img class="lazyload" src="/img/load.gif" width="16" height="16"
                        data-src="../img/chung-chi.svg"><span><?php echo $cer; ?></span>
                    </div>
                    <div class="item">
                        <img class="lazyload" src="/img/load.gif" width="16" height="16"
                        data-src="../img/image/clock.svg"><span><?php echo $rowOff['month_study'] ?>
                    tháng</span>
                </div>
                <?=$tag_name?>
            </div>
            <hr>
            <div class="prd-buy">
                <?
                ?>
                <div class="prices">
                    <?php
                    if ($rowOff['price_promotional'] == -1) {
                        echo '<p>'.number_format($rowOff['price_listed']) . ' đ'.'</p>';
                    }else{
                        echo '<p>'.number_format($rowOff['price_promotional']) . ' đ'.'</p>
                        <span>'.number_format($rowOff['price_listed']). ' đ'.'</span>';
                    }
                    ?>
                </div>
                <?

                if(isset($cookie_id)&& $cookie_type==1){
                    $db_order = new db_query("SELECT course_id,user_student_id FROM orders WHERE user_student_id = $cookie_id AND course_id=$course_id");

                    $db_order2 = new db_query("SELECT course_id,user_student_id FROM order_student_common WHERE user_student_id = $cookie_id AND course_id=$course_id");
                    if (mysql_num_rows($db_order->result)>0 || mysql_num_rows($db_order2->result) > 0) {
                        echo '<div class="buy-now2">
                        <a>ĐÃ MUA</a>
                        </div>';
                    }else{
                        echo '<a class="buy-now" href="'.urlOrders($cookie_id, $course_id).'">
                        <span>MUA NGAY</span>
                        </a>';
                    }
                }else{
                    echo '<div class="buy-now0" data-toggle="modal" data-target="#modal-login">
                    <a>MUA NGAY</a>
                    </div>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
?>
</div>
<!--xem them-->
<div class="xemthem xemthem-online">
    <a id="xemthem-online" href="/khoa-hoc-online.html"> XEM THÊM</a>
</div>

</div>
</div>

<div id="about-us">
    <div class="container">
        <div class="title-us">
            <img class="lazyload" src="/img/load.gif" data-src="../img/image/thinking.svg">
            <h1>Tại sao chọn chúng tôi?</h1>
        </div>
        <div class="about-us1">
            <div class="about-us1-1">
                <img class="lazyload" src="/img/load.gif" data-src="../img/image/tietkiemhieuqua.png">
                <h3>HỌC PHÍ RẺ BẰNG 1/10</h3>
                <p>Tại Khóa Học của timviec365.com đây, chỉ từ 270,000đ. Bạn có thể học được các khóa học
                    chất
                    lượng về tin học, lập trình và mỹ thuật đa phương tiện, ngoại ngữ được giảng dạy bởi
                    giảng
                viên chất lượng quốc tế.</p>
            </div>
            <div class="about-us1-1">
                <img class="lazyload" src="/img/load.gif" data-src="../img/webp/kienthucthucte.webp">
                <h3>HỌC MỌI LÚC - MỌI NƠI - KHÔNG GIỚI HẠN</h3>
                <p>Bạn sẽ được học đi học lại nhiều lần nếu chưa hiểu. Lợi thế của các video bạn có thể thực
                hành và làm theo các bài giảng đã được quay sẵn</p>
            </div>
            <div class="about-us1-1">
                <img class="lazyload" src="/img/load.gif" data-src="../img/webp/kienthucthucte.webp">
                <h3>KIẾN THỨC THỰC TẾ</h3>
                <p>Các bài giảng trong khóa học là những kiến thức thực tế được làm việc trong môi trường
                    quốc
                tế, giúp học viên có thể làm được việc sau khóa học...</p>
            </div>
        </div>
        <div class="title-us2">
            <h1>Cảm nhận học viên</h1>
        </div>
        <div class="about-us2">
            <div class="about-us2-1">
                <div class="about-us2-2">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/image/camnhan.svg">
                    <p>Mình theo học khóa dạy phát âm tiếng Anh căn bản giọng Mỹ của cô Lan Bercu. Đây là
                        một
                        khóa học vô cùng bổ ích, mình cảm thấy tiến bộ rất nhiều sau khi luyện tập với
                        phương
                    pháp của cô. Cảm ơn cô rất nhiều ạ.</p>
                </div>
                <div class="about-us2-3">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/image/camnhan1.svg">
                    <h5>Nguyễn Thu Huyền</h5>
                </div>
            </div>
            <div class="about-us2-1">
                <div class="about-us2-2">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/image/camnhan.svg">
                    <p>Thi IELTS là một thử thách rất khó, mình đã áp dụng rất nhiều tip trên mạng nhưng
                        điểm
                        thi thử không ổn định, thế nhưng chỉ 1 khóa học tip luyện thi IELTS của thầy Tiến là
                    mình đã tự tin hơn rất nhiều.</p>
                </div>
                <div class="about-us2-3">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/image/camnhan1.svg">
                    <h5>Xóm Bánh Bèo</h5>
                </div>
            </div>
            <div class="about-us2-1">
                <div class="about-us2-2">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/image/camnhan.svg">
                    <p>Cuối năm ngoái, mình đăng ký mua khóa học Bootstrap của thầy Nguyễn Đức Việt. Thấy
                        khóa
                        học của thầy rất thực tế, dễ hiểu, support nhiệt tình nên mình đã quyết định mua hết
                        các
                        khóa học của thầy liên quan đến học thiết kế Website (từ Bootstrap, jQuery,
                        WordPress và
                    cả Photoshop nữa), các khóa học rất logic và bài bản.</p>
                </div>
                <div class="about-us2-3">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/image/camnhan1.svg">
                    <h5>Nguyễn Hoài An</h5>
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
include '../includes/h_inc_footer.php';
?>
<!-- END: FOOTER -->
<div id="addSlick"></div>
<script defer src="../js/v_search.js?v=<?=$version?>"></script>
<script>
    var count_online = <?php echo $count_online; ?>;
    if (count_online <= 6) {
        $(".xemthem-online").remove();
    }
    var count_offline = <?php echo $count_offline; ?>;
    if (count_offline <= 6) {
        $(".xemthem-offline").remove();
    }
    <?php if (isset($_COOKIE['user_id'])) { ?>
        $(window).scroll(function() {
            var scrollTop = $(this).scrollTop();
            if (scrollTop > 100 && !$('#addSlick').hasClass('addSlick')) {
                $('#addSlick').addClass('addSlick').html(
                    '<script defer src="../js/slick.min.js"><\/script>');
                $('#feature-slider').slick({
                    dots: true,
                    infinite: false,
                    speed: 300,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    prevArrow: '<div class="prd-slide-prev"><img width="40px" height="40px" class="lazyload" src="/img/load.gif" data-src="../img/image/previous.svg"></div>',
                    nextArrow: '<div class="prd-slide-next"><img width="40px" height="40px" class="lazyload" src="/img/load.gif" data-src="../img/image/next.svg"></div>',
                    responsive: [{
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            infinite: true,
                            dots: true,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                    ]
                });
            }
        });
    <?php } ?>
    var user_id = <?php echo $cookie_id; ?>;

    if (user_id == 0) {
        $("#bansethich").remove();
    }

    var user_type = <?php echo $cookie_type; ?>;

    if (user_type == 2 || user_type == 3) {
        $("#bansethich").remove();
    }

    function v_datcho(course_id) {
        $.ajax({
            url: '../ajax/v_ajax_dat_cho.php',
            type: 'GET',
            dataType: 'json',
            data: {
                course_id: course_id
            },
            success: function (data) {
                if (data.result == true) {
                    alert("Đã đặt chỗ thành công");
                    $(".buy_now"+course_id).css('background', 'green');
                    $(".buy_now"+course_id+" a").text('ĐÃ ĐẶT CHỖ');
                }
            },
            error: function () {
                alert("Có lỗi xảy ra. Vui lòng thử lại");
            }
        });   
    }
</script>
</body>

</html>