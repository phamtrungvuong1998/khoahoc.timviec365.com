<?php 
require_once '../includes/v_inc_insert_HV.php';
$qrCount = new db_query("SELECT save_id FROM save_teacher WHERE user_student_id = '$user_id'");

$rowCount = mysql_num_rows($qrCount->result);
$pa = $rowCount/6;

$qr = new db_query("SELECT *,users.created_at FROM users INNER JOIN save_teacher ON save_teacher.teacher_id = users.user_id WHERE save_teacher.user_student_id = '$user_id' ORDER BY user_id DESC LIMIT 0,6");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <?php require_once '../includes/v_inc_HV_css.php'; ?>
    <link rel="stylesheet" href="../css/HV-ds_giang_vien_da_luu.css?v=<?=$version?>">
    <style type="text/css">
        #v_sidebar-1 {
            display: block;
        }

        #v_QL-khoa-hoc {
            color: #1B6AAB;
        }

        #v_gv-da-luu {
            color: #1B6AAB;
        }
        .v_sidebar-menu:nth-child(2) button{
            color: #1B6AAB;
        }
        #v_sidebar-tb-2{
            display: block;
        }
        #v_sidebar-tb-2 li:nth-child(6) a{
            color: #1B6AAB;
        }
        .v_content-play-p{
            flex-basis: 80%;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 24px;
            -webkit-line-clamp: 1;
            display: -webkit-box;
            -webkit-box-orient: vertical;
        }

        .p_active{
            background: #1B6AAB;
            color: white;
        }

    </style>
    <title>Danh sách giảng viên đã lưu</title>
</head>

<body>
    <div id="v_wrapper" class="flex">
        <!-- Begin: sidebar -->
        <?php require_once("../includes/inc_sidebar.php"); ?>
        <!-- End: sidebar -->
        <!-- Begin: main -->
        <div id="main">
            <!-- Begin: header -->
            <?php require_once '../includes/inc_manager_header.php'; ?>
            <!-- End: header -->

            <!-- Begin: content -->
            <div id="content-box" class="flex">
                <div id="content" class="flex">
                    <?php
                    if ($rowCount == 0) {
                        echo '<div class="emptys">Chưa có dữ liệu</div>';
                    }else{
                        while ($row = mysql_fetch_array($qr->result)) {
                            $qrRate = new db_query("SELECT teacher FROM courses INNER JOIN rate_course ON courses.course_id = rate_course.course_id WHERE user_id = " . $row['user_id']);
                            $total_rate = 0;
                            while($rowRate = mysql_fetch_array($qrRate->result)){
                                $total_rate = $total_rate + $rowRate['teacher'];
                            }
                            $rate = $total_rate/mysql_num_rows($qrRate->result);
                            $arr_cate = explode(",", $row['cate_id']);
                            $cate_name = "";
                            for ($i = 0; $i < count($arr_cate); $i++) {
                                $cate_id = $arr_cate[$i];
                                $qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
                                $rowCate = mysql_fetch_array($qrCate->result);
                                if ($i == count($arr_cate) - 1) {
                                    $cate_name = $cate_name . $rowCate['cate_name'];
                                }else{
                                    $cate_name = $cate_name . $rowCate['cate_name'] . ', ';
                                }
                            }
                            if ($row['user_avatar'] == 0) {
                                $v_avatar_teach = '../img/v_avatar_default.png';
                            }else{
                                $v_avatar_teach = '../img/avatar/' . $row['user_avatar'];
                            }
                            ?>
                            <div class="v_content-main">
                                <div class="v_content-1" id="v_save_teacher-<?php echo $row['save_id']; ?>">
                                    <hr class="v_content-main-hr">
                                    <center style="padding-top: 16px;"><img src="<?php echo $v_avatar_teach; ?>" class="v_content-1-img" alt="Ảnh lỗi"></center>
                                    <a href="<?php echo urlDetail_teacher($row['teacher_id'], $row['user_slug']); ?>"><p class="v_content-main-p"><?php echo $row['user_name']; ?></p></a>
                                    <div class="flex v_content-play">
                                        <p class="v_img-play"><img src="../img/gg_play-button-o.svg"
                                            alt="Ảnh lỗi"></p>
                                            <p class="v_content-play-p">Môn học giảng dạy : <?php echo $cate_name; ?></p>
                                        </div>
                                        <div class="flex v_content-play">
                                            <p class="v_img-play"><img src="../img/clarity_date-line.svg"
                                                alt="Ảnh lỗi"></p>
                                                <p><?php echo date('d-m-Y',$row['created_at']); ?></p>
                                            </div>
                                            <div class="flex v_content-play">
                                                <p class="v_img-play"><img src="../img/Group 31842.svg" alt="Ảnh lỗi">
                                                </p>
                                                <p><?php echo round($rate, 1); ?> (<?php echo mysql_num_rows($qrRate->result);?>)</p>
                                            </div>
                                            <div class="flex v_btn">
                                                <a href="<?php echo urlDetail_teacher($row['teacher_id'],$row['user_slug']); ?>" class="v_xem-them"><button>XEM THÊM</button></a>
                                                <button class="v_xoa" onclick="del_save_teacher(<?php echo $row['save_id']; ?>,2,1)">XÓA</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                }
                            } 
                            ?>
                        </div>
                        <div id="v_chuyentrang">
                            <a class="v_chuyen-trang-div" onclick="v_chuyentrang('previous', 2)">&lt;</a>
                            <?php for ($i = 1; $i  <= ceil($pa) ; $i++) { ?>
                                <a class="v_chuyen-trang-div v_phantrang" id="v_pa_<?php echo $i; ?>" onclick="v_chuyentrang(<?php echo $i; ?>,2)"><?php echo $i ?></a>
                            <?php } ?>
                            <a class="v_chuyen-trang-div" onclick="v_chuyentrang('next', 2)">&gt;</a>
                        </div>
                    </div>
                    <!-- End: content -->

                </div>
                <!-- End: main -->
            </div>

            <!-- Begin: foooter -->
            <?php require_once("../includes/h_inc_footer.php"); ?>
            <!-- End: footer -->
        </body>
        <script src="../js//v-main.js?v=<?=$version?>"></script>
        <script type="text/javascript">
            $('#v_pa_1').css({
                "color": "white",
                "background": "#1B6AAB"
            });
            if ($('#content').children('.v_content-main').length == 0) {
                $('#v_chuyentrang').remove();
            }

            function del_save_teacher(save_id, type,p) {
                var n = confirm("Bạn có muốn xóa không");
                if (n == true) {
                    $.ajax({
                        url: '../ajax/v_ajax_del_save.php',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            save_id: save_id,
                            type: type,
                            p: p
                        },
                        success: function (data){
                            if (data.html == 0) {
                                $('#v_chuyentrang').remove();
                                $('.v_content-main').remove();
                                $('#content').append('<div class="emptys">Chưa có dữ liệu</div>');
                            }else{
                                $('.v_content-main').remove();
                                $('#content').append(data.html);

                                if ($('#content').children('.v_content-main').length == 6) {
                                    $('#v_pa_' +(p - 1)).css({
                                        "color": "white",
                                        "background": "#1B6AAB"
                                    });

                                    $('#v_pa_'+p).remove();
                                }
                            }
                        }
                    });
                }
            }

            function v_chuyentrang(number, type) {
                var sum = $("#v_chuyentrang").children('.v_phantrang').length;
                if (number == 'previous') {
                    if ($('#v_pa_1').css("color") != "rgb(255, 255, 255)") {
                        for (var i = 1; i <= $("#v_chuyentrang").children('.v_phantrang').length; i++) {
                            if ($('#v_pa_' + i).css("color") == "rgb(255, 255, 255)") {
                                number = i - 1;
                                break;
                            }
                        }
                    }else{
                        number = 1;
                    }
                }else if (number == 'next') {
                    if ($('#v_pa_' + sum).css("color") != "rgb(255, 255, 255)") {
                        for (var i = 1; i <= $("#v_chuyentrang").children('.v_phantrang').length; i++) {
                            console.log($('#v_pa_' + i).css("color"));
                            if ($('#v_pa_' + i).css("color") == "rgb(255, 255, 255)") {
                                number = i + 1;
                                break;
                            }
                        }
                    }else{
                        number = sum;
                    }
                }

                for (var i = 1; i <= $("#v_chuyentrang").children('.v_phantrang').length; i++) {
                    $('#v_pa_' + i).css({
                        "color": "black",
                        "background": "#F4F2FF"
                    });
                }

                $.ajax({
                    url: '../ajax/v_save_teacher.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        number: number,
                        type: type,
                    },
                    success: function (data) {
                        $('#v_pa_' + number).css({
                            "color": "white",
                            "background": "#1B6AAB"
                        });

                        $('.v_content-main').remove();
                        $('#content').append(data.html);
                    }
                });
            }
        </script>

        </html>