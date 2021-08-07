<?php
require_once '../code_xu_ly/h_home.php';
$teacher_id = getValue('user_id', 'int', 'GET', '');
$dbt = new db_query("SELECT * FROM users JOIN user_teach_experience ON user_teach_experience.user_id = users.user_id WHERE users.user_id = $teacher_id");
$rowt = mysql_fetch_array($dbt->result);

$num1 = new db_query("SELECT user_id FROM courses WHERE user_id = $teacher_id");
$num3 = new db_query("SELECT * FROM rate_course JOIN courses ON courses.course_id = rate_course.course_id WHERE courses.user_id = $teacher_id");
$num4 = new db_query("SELECT user_student_id FROM orders JOIN courses ON courses.course_id = orders.course_id WHERE courses.user_id = $teacher_id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <title><?php echo $rowt['user_name']; ?></title>
    <link rel="preload" href="/css/h_detail_teacher.css?v=<?=$version?>" as="style">
    <?require_once '../includes/h_inc_css.php';?>
    <link rel="stylesheet" href="../css/h_detail_teacher.css?v=<?=$version?>">
    <style>
        [class*=v_save]{
            width: 26px;
            height: 26px;
        }

        .buy_now1{
            color: white;
            font-weight: bold;
            font-size: 14px;
            line-height: 18px;
        }
        .teacher-follow{
        	cursor: pointer;
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
                    <li><a href="#">Trang chủ</a></li>
                    <li class="olli">></li>
                    <li>Thông tin giảng viên <?php echo $rowt['user_name']; ?></li>
                </ol>
            </div>
        </div>

        <hr class="hr1">
        <!--Detail Main-->
        <div class="container">
            <div id="main-detail">
                <div id="center-detail">
                    <div class="teacher-info">
                        <div class="teacher-img">
                            <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                src="../img/avatar/<?=$rowt['user_avatar']?>">
                            <h2><?=$rowt['user_name']?></h2>
                        </div>
                        <div class="teacher-course">
                            <div class="teacher-course1">
                                <div class="teacher-border-img">
                                    <img src="../img/image/teacherbook.svg">
                                </div>
                                <span><?=mysql_num_rows($num1->result)?></span>
                                <p>KHÓA HỌC</p>
                            </div>
                            <div class="teacher-course1">
                                <div class="teacher-border-img">
                                    <img src="../img/image/teacherstar.svg">
                                </div>
                                <span><?=mysql_num_rows($num3->result)?></span>
                                <p>ĐÁNH GIÁ</p>
                            </div>
                            <div class="teacher-course1">
                                <div class="teacher-border-img">
                                    <img src="../img/image/teacheruser.svg">
                                </div>
                                <span><?=mysql_num_rows($num4->result)?></span>
                                <p>HỌC VIÊN</p>
                            </div>
                        </div>
                        <?php
                            if($cookie_type == 1){
                            	$qrS = new db_query("SELECT * FROM save_teacher WHERE user_student_id = $cookie_id AND teacher_id = $teacher_id");
                            	if (mysql_num_rows($qrS->result) == 0) {
                            		echo '
                                    <div class="teacher-follow">
                                        <button id="follows" data-user="'.$cookie_id.'" data-teacher="'.$teacher_id.'" data-type="1" onclick="v_save_teach2(this)">THEO DÕI</button>
                                    </div>
                                ';
                            	}else{
                            		echo '
                                    <div class="teacher-follow">
                                        <button id="follows" data-user="'.$cookie_id.'" data-teacher="'.$teacher_id.'" data-type="2" onclick="v_save_teach2(this)">ĐÃ THEO DÕI</button>
                                    </div>
                                ';
                            	}
                            }else if ($cookie_type == 0) {
                            	echo '
                                    <div class="teacher-follow">
                                        <button id="follows" data-toggle="modal" data-target="#modal-login">THEO DÕI</button>
                                    </div>
                                ';
                            }
                        ?>


                    </div>

                    <div class="obj-course">
                        <div class="title">
                            <hr>
                            <h3>THÔNG TIN</h3>
                        </div>
                        <div class="content">
                            <p id="content1"><?=$rowt['qualification']?>
                            </p>
                        </div>
                    </div>
                    <div class="obj-course">
                        <div class="title">
                            <hr>
                            <h3>KINH NGHIỆM GIẢNG DẠY</h3>
                        </div>
                        <div class="content">
                            <p>
                                <?=$rowt['exp_teach']?>
                            </p>
                        </div>
                    </div>
                    <div class="obj-course">
                        <div class="title">
                            <hr>
                            <h3>KINH NGHIỆM LÀM VIỆC</h3>
                        </div>
                        <div class="content">
                            <p>
                                <?=$rowt['exp_work']?>
                            </p>
                        </div>
                    </div>

                    <!--Khoa hoc lien quan-->
                    <div id="course-relate">
                        <div class="title">
                            <hr class="title-hr">
                            <h2>CÁC KHÓA HỌC GIẢNG DẠY</h2>
                        </div>
                        <div class="feature-main">
                            <?
                            $dbc = new db_query("SELECT *,categories.cate_id FROM courses JOIN users ON courses.user_id = users.user_id JOIN levels ON courses.level_id = levels.level_id JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.user_id = $teacher_id AND courses.hide_course = 1 AND courses.accept = 1 AND courses.price_listed > -1 ORDER BY course_id DESC");
                            while ($rowc = mysql_fetch_array($dbc->result)) {
                                $course_id = $rowc['course_id'];
                                if ($rowc['certification'] == 1) {
                                    $cer = "Cấp chứng chỉ";
                                }else{
                                    $cer = "Không cấp chứng chỉ";
                                }
                                if ($rowc['tag_id'] != 0) {
                                    $tag_id = $rowc['tag_id'];
                                    $qrTag = new db_query("SELECT tag_name, cate_icon FROM tags JOIN categories ON tags.cate_id=categories.cate_id WHERE tag_id = '$tag_id'");
                                    $rowTag = mysql_fetch_array($qrTag->result);
                                    $cate_id = $rowc['cate_id'];

                                    $tag_name = '<div class="item">
                                            <img width="16px" height="16px" src="/img/load.gif" data-src="../img/categories/'. $rowTag['cate_icon'] .'" class="lazyload v_cate_icon"><span>'.$rowTag['tag_name'].'</span>
                                        </div>';
                                }else{
                                    $tag_name = '<div class="item">
                                            <img width="16px" height="16px" src="/img/load.gif" data-src="../img/categories/'. $rowc['cate_icon'] .'" class="lazyload v_cate_icon"><span>'.$rowc['cate_name'].'</span>
                                        </div>';
                                }
                                ?>
                            <div class="product-item">
                                <?php
                                if ($rowc['course_type'] == 1) {
                                    $course_url = urlDetail_courseOffline($rowc['course_id'],$rowc['course_slug']);
                                    $link_cate = urlOnline_cate($rowc['cate_id'],$rowc['cate_slug']);
                                }else{
                                    $course_url = urlDetail_courseOnline($rowc['course_id'],$rowc['course_slug']);
                                    $link_cate = urlOffline_cate($rowc['cate_id'],$rowc['cate_slug']);
                                }
                                ?>
                                <div class="product-img">
                                    <a href="<?php echo $course_url; ?>"><img class="lazyload img-main"
                                        onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                        src="/img/load.gif" data-src="../img/course/<?=$rowc['course_avatar']?>"></a>
                                    <div class="detail">
                                        <div class="detai-img">
                                            <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                                class="lazyload" src="/img/load.gif"
                                                data-src="../img/avatar/<?=$rowc['user_avatar']?>" alt="">
                                        </div>
                                        <div class="detai-item">
                                            <a
                                                href="<?php echo urlDetail_teacher($rowc['user_id'], $rowc['user_slug']) ?>">
                                                <p class="detai-item1"><?=$rowc['user_name']?></p>
                                            </a>
                                            <a href="<?php echo $link_cate; ?>" class="detai-item2"><?=$rowc['cate_name']?></a>
                                        </div>
                                    </div>
                                    <div class="like">
                                        <?php
                                            $qrS = new db_query("SELECT save_id FROM save_course WHERE user_student_id = '$cookie_id' AND course_id = " . $rowc['course_id']);
                                            if (mysql_num_rows($qrS->result) == 0) {
                                                $srcS = '../img/image/wpf_like (3).svg';
                                            }else{
                                                $srcS = '../img/heart-yellow2.svg';
                                            }
                                            if ($cookie_type == 1) {
                                            	echo '<button class="like-product" value="'.$rowc['course_id'].'"
                                            onclick="v_save_course(this)"><img src="'.$srcS.'" class="v_save<'.$rowc['course_id'].'"></button>';
                                            }else if ($cookie_id == 0) {
                                            	echo '<button class="like-product" data-toggle="modal" data-target="#modal-login"><img src="'.$srcS.'"></button>';
                                            }
                                            ?>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="prd-name">
                                        <a href="<?php echo $course_url; ?>"><?=$rowc['course_name']?></a>
                                    </div>
                                    <div class="star-rate">
                                        <?php
                                    $qrrate = new db_query("SELECT Count(*) as total FROM rate_course WHERE course_id = $course_id");
                                    $rowcount=mysql_fetch_array($qrrate->result);
                                    $numrate = $rowcount['total'];
                                    if ($numrate >0) {
                                        if ($rowc['course_type']==1) {
                                            $qrsum = new db_query("SELECT (sum(lesson)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
                                            $rowsum = mysql_fetch_array($qrsum->result);
                                            $sumall = $rowsum['(sum(lesson)+sum(teacher))']/2;
                                            $total_rate = $sumall/$numrate;
                                        } elseif ($rowc['course_type']==2) {
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
                                        <span>
                                            <?php echo round($total_rate,1) ?> (
                                            <?
                                            $num5 = new db_query("SELECT course_id FROM rate_course WHERE course_id = $course_id");
                                            echo round(mysql_num_rows($num5->result),1);
                                        ?>)
                                        </span>
                                    </div>
                                    <div class="prd-status">
                                        <p>
                                            <?
                                            $num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
                                            $num9 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");
                                            echo mysql_num_rows($num2->result) + mysql_num_rows($num9->result);
                                        ?>
                                            học viên đã mua
                                        </p>
                                    </div>
                                    <div class="prd-item">
                                        <div class="item">
                                            <img
                                                src="../img/nguoi-moi.svg"><span><?php echo $rowc['level_name'] ?></span>
                                        </div>
                                        <div class="item">
                                            <img src="../img/chung-chi.svg"><span><?php echo $cer; ?></span>
                                        </div>
                                        <?php echo $tag_name; ?>
                                    </div>
                                    <hr>
                                    <div class="prd-buy" id="prd_buy<?php echo $rowc['course_id']; ?>">

                                        <div class="prices">
                                            <p><?php
                                            if ($rowc['price_promotional'] == -1) {
                                                echo '<p style="height: 17.78px;">'.number_format($rowc['price_listed']). ' đ'.'</p>';
                                            }else{
                                                echo '<p style="height: 17.78px;">'.number_format($rowc['price_promotional']). ' đ'.'</p><span style="height: 17.78px; ">'.number_format($rowc['price_listed']). ' đ'.'</span>';
                                            }
                                            ?>
                                        </div>
                                        <?

                                        if(isset($cookie_id) && $cookie_type==1){
                                            $course_id = $rowc['course_id'];
                                            $db_order = new db_query("SELECT course_id,user_student_id FROM orders WHERE user_student_id = $cookie_id AND course_id=$course_id");
                                            $db_order2 = new db_query("SELECT course_id,user_student_id FROM order_student_common WHERE user_student_id = $cookie_id AND course_id=$course_id");
                                            if (mysql_num_rows($db_order->result)>0 || mysql_num_rows($db_order2->result)>0) {
                                                if ($rowc['course_type'] == 2) {
                                                    echo '<div class="buy-now2">
                                                    <a>ĐÃ MUA</a>
                                                    </div>';
                                                }else if ($rowc['course_type'] == 1){
                                                    echo '<div class="buy-now2">
                                                    <a>ĐÃ ĐẶT CHỖ</a>
                                                    </div>';
                                                }
                                            }else{
                                                if ($rowc['course_type'] == 2) {
                                                    echo '<a class="buy-now" id href="'.urlOrders($cookie_id, $course_id).'">
                                                    <p class="buy_now1">MUA NGAY</p>
                                                    </a>';
                                                }else if ($rowc['course_type'] == 1){
                                                    echo '<div class="buy-now" id="buy_now'.$rowc['course_id'].'" onclick="v_datcho2('.$rowc['course_id'].')">
                                                    <a>ĐẶT CHỖ</a>
                                                    </div>';
                                                }
                                            }
                                        }else{
                                            if ($rowc['course_type'] == 2) {
                                                echo '<div class="buy-now" data-toggle="modal" data-target="#modal-login">
                                                <a>MUA NGAY</a>
                                                </div>';
                                            }else if ($rowc['course_type'] == 1){
                                                echo '<div class="buy-now" data-toggle="modal" data-target="#modal-login">
                                                <a>ĐẶT CHỖ</a>
                                                </div>';
                                            }
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
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
    <script src="../js/v_search.js?v=<?=$version?>"></script>
</body>
<script type="text/javascript">
	function v_save_teach2(data) {
		var user_id = $(data)[0].dataset.user;
		var teacher_id = $(data)[0].dataset.teacher;
		var type = $(data)[0].dataset.type;
        var user_type = 2;
		$.ajax({
			url: '../ajax/v_ajax_save_teach.php',
			type: 'GET',
			dataType: 'json',
			data: {
				user_student_id: user_id,
				teacher_id: teacher_id,
				type: type,
                user_type: user_type
			},
			success: function (data) {
				if (type == 1) {
					$(".teacher-follow").html('<button id="follows" data-user="'+user_id+'" data-teacher="'+teacher_id+'" data-type="2" onclick="v_save_teach2(this)">ĐÃ THEO DÕI</button>');
				}else if (type == 2) {
					$(".teacher-follow").html('<button id="follows" data-user="'+user_id+'" data-teacher="'+teacher_id+'" data-type="1" onclick="v_save_teach2(this)">THEO DÕI</button>');
				}
			},
			error: function () {
				alert("Có lỗi xảy ra. Vui lòng thử lại");
			}
		});	
	}

	function v_datcho2(course_id) {
        $.ajax({
            url: '../ajax/v_ajax_dat_cho.php',
            type: 'GET',
            dataType: 'json',
            data: {
                course_id: course_id
            },
            success: function (data) {
                alert("Đặt chỗ thành công");
                $("#buy_now"+course_id).remove();
                $("#prd_buy"+course_id).append('<div class="buy-now2"><a>ĐÃ ĐẶT CHỖ</a></div>');
            },
            error: function () {
                alert("Có lỗi xảy ra. Vui lòng thử lại");
            }
        });
        
    }
</script>

</html>