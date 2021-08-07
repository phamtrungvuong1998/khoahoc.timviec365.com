<?php
require_once '../code_xu_ly/h_manager_GV.php';
$qrCount = new db_query("SELECT COUNT(*) FROM  rate_course JOIN courses ON courses.course_id = rate_course.course_id JOIN users on users.user_id = rate_course.user_student_id WHERE courses.user_id = $cookie_id");

$rowCount = mysql_fetch_array($qrCount->result);
$pa = $rowCount[0]/10;

$p = getValue('p','str','GET','');

$number_page = 10;

if (!isset($_GET['p']) || $p == 1) {
    $start = 0;
    $end = 10;
}else{
    $start = $number_page * ($p - 1);
    $end = $number_page  * $p;
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
    <link rel="stylesheet" href="../css/GV-hv-danh-gia.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/GV-ds-hv-da-mua.css?v=<?=$version?>">
    <style>
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
    #v_sidebar_tb-2 li:nth-child(5) a{
        color: #1B6AAB;
    }
    #v_hv-danh-gia {
        color: #1B6AAB;
    }
    @media(max-width: 1300px){
        #v_content-filter{
            max-width: 95%;
        }
        #content{
            display: table;
            max-width: 95%;
        }
        #v_chuyentrang{
            max-width: 95%;
        }
    }
    </style>
    <script src="../js//v-main.js?v=<?=$version?>"></script>
    <title>Quản lý đánh giá của học viên</title>
</head>

<body>
    <div id="v_wrapper" class="flex">
        <!-- Begin: sidebar -->
        <?php require_once("../includes/inc_GV_sidebar.php"); ?>
        <!-- End: sidebar -->

        <!-- Begin: main -->
        <div id="main">
            <!-- Begin: header -->
            <?php
            $actions = "danhgia";
            require_once '../includes/inc_GV_manager_header.php'; ?>
            <!-- End: header -->

            <!-- Begin: content -->
            <div id="content-box" class="flex">
                <?php require_once '../includes/v_inc_GV_bo-loc.php'; ?>
                <div id="content">
                    <div id="v_content-title">
                        <div class="v_content-title-div">MÃ ĐÁNH GIÁ</div>
                        <div class="v_content-title-div">KHÓA HỌC</div>
                        <div class="v_content-title-div">ĐÁNH GIÁ</div>
                        <div class="v_content-title-div">PHẢN HỒI</div>
                    </div>

                    <div id="filter">
                        <?php 
                        $qr1 = new db_query("SELECT * FROM rate_course JOIN courses ON courses.course_id = rate_course.course_id JOIN users on users.user_id = rate_course.user_student_id WHERE courses.user_id = $cookie_id LIMIT $start,$end");
                        while($row1 = mysql_fetch_array($qr1->result)){
                        	$qrRep = new db_query("SELECT * FROM rep_rate_course WHERE user_student_id = $cookie_id AND rate_id = " .$row1['rate_id']);
                            $rate_id = $row1['rate_id'];
                            if($row1['course_type'] == 2){
                                $total_rate = ($row1['lesson'] + $row1['video'] + $row1['teacher'])/3;
                            }elseif($row1['course_type'] == 1){
                                $total_rate = ($row1['lesson'] + $row1['teacher'])/2;
                            }

                            if ($row1['course_type'] == 1) {
                                $linkC = urlDetail_courseOffline($row1['course_id'],$row1['course_slug']);
                            }else{
                                $linkC = urlDetail_courseOnline($row1['course_id'],$row1['course_slug']);
                            }
                    ?>
                        <div class="v_noidungkh" id="v_noidungkh-<?=$rate_id?>">
                            <div class="v_content-list v_monhoc"><?=$rate_id?></div>
                            <div class="v_content-list"><a href="<?php echo $linkC; ?>"><?=$row1['course_name']?></a></div>
                            <div class="v_content-list v_trungtam">
                                <p class="v_name-hv"><?=$row1['comment_rate']?></p>
                                <div style="display: flex;">
                                    <?php for ($i=0; $i < $total_rate; $i++) { ?>
                                    <p><img class="lazyload" src="/img/load.gif" data-src="../img/star.svg"
                                            alt="Ảnh lỗi"></p>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="v_content-list">
                                <div class="v_reply-div">
                                    <p><img class="lazyload" src="/img/load.gif" data-src="../img/tra-loi-danh-gia.svg"
                                            alt="Ảnh lỗi"></p>
                                    <?php
                                    if (mysql_num_rows($qrRep->result) == 0) {
                                    	echo '<p><button onclick="v_reply('.$rate_id.')" class="v_reply v_reply'.$rate_id.'">Trả lời đánh giá</button></p>';
                                    }else{
                                    	echo '<p><button class="v_reply">Đã trả lời đánh giá</button></p>';
                                    }
                                    ?>

                                    <form class="v_reply-detail v_reply_form<?php echo $rate_id; ?>" onsubmit="return v_rep_submit(this)" id="v_reply-<?=$rate_id?>" method="POST">
                                        <input type="hidden" class="rate_id" value="<?=$rate_id?>">
                                        <input type="hidden" class="course_id" value="<?=$row1['course_id']?>">
                                        <center><textarea name="comment_rep" class="comment_rep"></textarea></center>
                                        <button class="v_reply-detail-a" name="btn">GỬI</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div id="filter2">
                    <?php 
                    $qr2 = new db_query("SELECT * FROM rate_course JOIN courses ON courses.course_id = rate_course.course_id JOIN users on users.user_id = rate_course.user_student_id WHERE courses.user_id = $cookie_id");
                        while($row2 = mysql_fetch_array($qr2->result)){
                            $rate_id = $row2['rate_id'];
                    ?>
                    <div class="v_content-mb">
                        <div class="flex v_content-mb-div">
                            <!-- <p class="v_content-mb-stt">1.</p> -->
                            <p class="v_content-mb-title"><?=$row2['course_name']?></p>
                        </div>

                        <p class="v_tengiangvien"><?=$row['user_name']?></p>

                        <div class="v_info-all v_content-mb-div">
                            <div class="v_content-mb-thongtin"><span class="v_info-all-span">Học viên :</span>
                                <?=$row2['user_name']?></div>
                            <div class="v_content-mb-thongtin"><span class="v_info-all-span">Mã đánh giá:</span>
                                <?=$rate_id?>
                            </div>
                        </div>

                        <center class="v_danh-gia-center">
                        	<?php
                        	if($row1['course_type'] == 2){
                                $total_rate = ($row1['lesson'] + $row1['video'] + $row1['teacher'])/3;
                            }elseif($row1['course_type'] == 1){
                                $total_rate = ($row1['lesson'] + $row1['teacher'])/2;
                            }
                         	$qrRep = new db_query("SELECT * FROM rep_rate_course WHERE user_student_id = $cookie_id AND rate_id = " .$row2['rate_id']);
                        	?>
                            <div class="v_danh-gia">
                                <p class="v_danh-gia-title">Đánh giá:</p>
                                <p class="v_danh-gia-content"><?=$row2['comment_rate']?></p>
                                <?php 
                            for ($i=0; $i < $total_rate; $i++) { 
                                ?>
                                <p><img class="v_danh-gia-star lazyload" src="/img/load.gif" data-src="../img/star.svg"
                                        alt="Ảnh lỗi"></p>
                                <?php } ?>
                            </div>
                        </center>
                        <?php
                        if (mysql_num_rows($qrRep->result) > 0) {
                        ?>
                        <div class="v_info-all v_content-mb-div v_rep_div">
                            <div class="v_content-mb-thongtin v_rep_rate_course"><span class="v_info-all-span v_rep_rate">Đã trả lời đánh giá</span></div>
                        </div>
                        <?php	
                        }else{
                        ?>
                        <div class="v_info-all v_content-mb-div v_rep_div">
                            <div class="v_content-mb-thongtin v_rep_rate_course" onclick="v_reply_mb(this)"><span class="v_info-all-span v_rep_rate v_reply<?php echo $rate_id; ?>">Trả lời đánh giá</span></div>
                            <form action="" onsubmit="return v_rep_submit(this)" method="POST" class="v_reply-detail2 v_reply_form<?php echo $rate_id;?>">
                            	<input type="hidden" class="rate_id" value="<?=$rate_id?>">
                            	<input type="hidden" class="course_id" value="<?=$row1['course_id']?>">
                            	<center><textarea name="comment_rep" class="comment_rep_mb comment_rep" id="comment_rep"></textarea></center>
                            	<center><button class="v_reply-detail-a v_reply_rate" name="btn">GỬI</button></center>
                            </form>
                        </div>
                        <?php
                    	}
                        ?>
                    </div>
                    <?php } ?>
                </div>
                <div id="v_chuyentrang">
                    <a class="v_chuyen-trang-div" href="<?php if($p == 1){
                            echo '/quan-li-danh-gia-cua-hoc-vien/id' . $_COOKIE['user_id'] . '-p1.html';
                        }else{
                            echo '/quan-li-danh-gia-cua-hoc-vien/id' . $_COOKIE['user_id'] . '-p' . ($p-1).'.html';
                        } ?>">&lt;</a>
                    <?php for ($i = 0; $i  < $pa ; $i++) { ?>
                    <a href="/quan-li-danh-gia-cua-hoc-vien/id<?php echo $_COOKIE['user_id']; ?>-p<?php echo $i  + 1; ?>.html"
                        class="v_chuyen-trang-div <?php if($p == $i+1){
                            echo "p_active";
                        } ?>" class="v_tranght"><?php echo $i + 1; ?></a>
                    <?php } ?>
                    <a href="<?php if($p == $i){
                            echo '/quan-li-danh-gia-cua-hoc-vien/id' . $_COOKIE['user_id'] . '-p'. ($i) .'.html';
                        }else{
                            echo '/quan-li-danh-gia-cua-hoc-vien/id' . $_COOKIE['user_id'] . '-p' . ($p+1).'.html';
                        } ?>" class="v_chuyen-trang-div">&gt;</a>
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
    function v_reply_mb(e) {
    	$(e).next().toggle();
    }
    function v_rep_submit(e) {
    	if ($(e).find('.comment_rep').val().trim() == "") {
    		alert("Vui lòng viết trả lời đánh giá");
    		return false;
    	}else{
    		var rate_id = $(e).find('.rate_id').val();
    		var course_id = $(e).find('.course_id').val();
    		var comment_rep = $(e).find('.comment_rep').val();
    		$.ajax({
    			url: '../ajax/v_center_teacher_rep.php',
    			type: 'POST',
    			dataType: 'json',
    			data: {
    				rate_id: rate_id,
    				course_id: course_id,
    				comment_rep: comment_rep
    			},
    			success: function () {
    				alert("Bạn đã trả lời đánh giá");
    				$(".v_reply"+rate_id).text('Đã trả lời đánh giá');
    				$('.v_reply_form'+rate_id).remove();
    			},
    			error: function () {
    				alert("Có lỗi xảy ra. Vui lòng thử lại");
    			}
    		});
    		return false;
    	}
    }
    $(document).ready(function() {
        $("#keywords").keyup(function() {
            var cookie_id = <?=$cookie_id?>;
            var search = $(this).val();
            var type = "qldanhgia";
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
                    $("#filter").html(data);
                }
            });

            var type2 = "qldanhgia";
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
    </script>
</body>

</html>