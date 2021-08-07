<?php
require_once '../includes/v_inc_insert_HV.php';
$qrCount = new db_query("SELECT save_id FROM save_course WHERE user_student_id = '$user_id' AND course_type = 1");

$rowCount = mysql_num_rows($qrCount->result);
$pa = $rowCount/10;

$qr = new db_query("SELECT * FROM save_course INNER JOIN courses ON save_course.course_id = courses.course_id INNER JOIN users ON courses.user_id = users.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_type = 1 AND save_course.user_student_id = '$user_id' ORDER BY save_id DESC LIMIT 0,10");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <?php
     require_once '../includes/v_inc_HV_css.php';
     require_once '../includes/v_inc_DS_css.php';
    ?>
    <link rel="stylesheet" href="../css/V_CSS/dskhoahocdamuaonline.css?v=<?=$version?>">
    <style type="text/css">
        #v_sidebar-1 {
            display: block;
        }

        #v_QL-khoa-hoc {
            color: #1B6AAB;
        }

        #v_kh-luu-offline {
            color: #1B6AAB;
        }
        .v_sidebar-menu:nth-child(2) button{
            color: #1B6AAB;
        }
        #v_sidebar-tb-2{
            display: block;
        }
        #v_sidebar-tb-2 li:nth-child(4) a{
            color: #1B6AAB;
        }

        .v_monhoc p {
            width: 114px !important;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 1;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            color: rgba(0, 0, 0, 0.54);
            line-height: 19px;
        }

        .p_active {
            background: #1B6AAB;
            color: white;
        }

        #v_kh-luu-offline{
            color: #1B6AAB;
        }
        .v_teacher_center{
            width: 20%;
        }
        .v_teacher_center a{
            width: 100%;
        }
        .v_monhoc a {
            width: 100% !important;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 1;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            color: rgba(0, 0, 0, 0.54);
            line-height: 19px;
        }
        .v_btn-del{
            margin-bottom: 0;
        }
        .v_popup center{
            margin-bottom: 7px;
        }
        .v_monhoc{
            width: 30%;
        }
        @media(max-width: 1300px){
            #content{
                display: table;
            }
        }
    </style>
    <title>Danh sách khóa học offline đã lưu</title>
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
            <div id="content-box" class="flex" onclick="dongquanlihocvien()">
                <div id="content">
                    <div id="v_content-title">
                        <div class="v_table-cell v_content-title-div">STT</div>
                        <div class="v_table-cell v_content-title-div">Khóa học</div>
                        <div class="v_table-cell v_content-title-div">Môn học</div>
                        <div class="v_table-cell v_content-title-div">Giảng viên</div>
                        <div class="v_table-cell v_content-title-div">Học phí</div>
                        <div class="v_table-cell v_content-title-div v_bacham"><img src="../img/More.svg" alt="Ảnh lỗi">
                        </div>
                    </div>

                    <?php
                    if ($rowCount == 0) {
                        echo '<div class="emptys">Chưa có dữ liệu</div>';
                    }else{
                        $j = 1;
                        while ($row = mysql_fetch_array($qr->result)) {
                            $qrOrder = new db_query("SELECT order_id FROM orders WHERE user_student_id = $user_id AND course_id = " . $row['course_id']);
                            if (mysql_num_rows($qrOrder->result) == 0) {
                                $order1 = '<center><a href="'.urlDetail_courseOffline($row['course_id'],$row['course_slug']).'" class="v_btn-buy"><button>ĐẶT CHỖ</button></a></center>';
                                $order2 = '<a href="'.urlDetail_courseOffline($row['course_id'],$row['course_slug']).'" class="flex v_ghichu-mb">
                                <p class="v_ghichu-mb-p v_gc">ĐẶT CHỖ</p>
                                </a>';
                            }else{
                                $order1 = '<center><a class="v_btn-buy"><button>ĐÃ ĐẶT CHỖ</button></a></center>';
                                $order2 = '<a class="flex v_ghichu-mb">
                                <p class="v_ghichu-mb-p v_gc">ĐÃ ĐẶT CHỖ</p>
                                </a>';
                            }
                            ?>
                            <div class="v_noidungkh" id="v_noidungkh-<?php echo $row['save_id']; ?>">
                                <div class="v_table-cell v_stt" id="v_stt-<?php echo $j; ?>"><?php echo $j; ?></div>

                                <div class="v_table-cell v_content-list v_monhoc">
                                    <a href="<?php echo urlDetail_courseOffline($row['course_id'],$row['course_slug']); ?>"><?php echo $row['course_name']; ?></a>
                                </div>
                                <div class="v_table-cell v_content-list" id="course_name"><?php echo $row['cate_name']; ?>
                            </div>
                            <?php 
                            if ($row['user_type'] == 2) {
                                $linkT = urlDetail_teacher($row['user_id'],$row['user_slug']);
                            }else{
                                $linkT = urlDetail_center($row['user_id'],$row['user_slug']);
                            }
                            ?>
                            <div class="v_table-cell v_content-list v_teacher_center"><a href="<?php echo $linkT; ?>"><?php echo $row['user_name']; ?></a></div>
                            <?php 
                            if ($row['price_promotional'] == -1) {
                                $price = $row['price_listed'];
                            }else{
                                $price = $row['price_promotional'];
                            } 
                            ?>

                            <div class="v_table-cell v_content-list"><?php echo number_format($price) . " đ"; ?></div>
                            <div class="v_table-cell v_content-list v_bacham">
                                <button class="v_btn-bacham" onclick="v_popup(this)"><img
                                    src="../img/More.svg" alt="Ảnh lỗi"></button>
                                    <div class="v_popup">
                                        <?php echo $order1; ?>
                                        <center><button value="<?php echo $row['save_id']; ?>" class="v_btn-del v_save_del" onclick="v_save_del(this)">HỦY</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="v_content-mb" id="v_content-mb-<?php echo $row['save_id']; ?>">
                                <div class="flex v_content-mb-div">
                                    <p class="v_content-mb-stt"><?php echo $j . '.'; ?></p>
                                    <p class="v_content-mb-title">
                                        <?php echo $row['course_name']; ?>
                                    </p>
                                </div>
                                <p class="v_tengiangvien"><?php echo $row['user_name']; ?></p>

                                <div class="flex v_info-all v_content-mb-div">
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học
                                    : </span><?php echo $row['cate_name']; ?></div>
                                    <?php $price = $row['price_listed'] - $row['price_promotional']; ?>

                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Học phí : </span>
                                        <?php echo number_format($price). " đ"; ?>
                                    </div>
                                </div>

                                <div class="flex v_mb-ghichu-all v_content-mb-div">
                                    <?php echo $order2; ?>
                                    <button value="<?php echo $row['save_id']; ?>" class="v_ghichu-mb v_xemthem v_save_del" onclick="v_save_del(this)"><span>HỦY</span>

                                    </button>
                                </div>
                            </div>
                            <?php
                            $j++;
                        } 
                    }
                    ?>
                </div>
                <div id="v_chuyentrang">
                    <a class="v_chuyen-trang-div">&lt;</a>
                    <?php for ($i = 1; $i  <= ceil($pa) ; $i++) { ?>
                        <a class="v_chuyen-trang-div"><?php echo $i ?></a>
                    <?php } ?>
                    <a class="v_chuyen-trang-div">&gt;</a>

                </div>
            </div>

        </div>
        <!-- End: content -->

    </div>
    <!-- End: main -->

    <!-- Begin: foooter -->
    <?php require_once("../includes/h_inc_footer.php"); ?>
    <!-- End: footer -->
</body>
<script src="../js//v-main.js?v=<?=$version?>"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $('.v_chuyen-trang-div').eq(1).css({
            "color": "white",
            "background": "#1B6AAB"
        });

        if ($('#content').children('.v_noidungkh').length == 0) {
            $('#v_content-title').remove();
            $('#v_chuyentrang').remove();
        }

        $('.v_chuyen-trang-div').click(function() {
            var page = $(this).index(".v_chuyen-trang-div");
            var j;
            for (var i = 1; i < $('.v_chuyen-trang-div').length - 1; i++) {
                if (page == 0) {
                    if ($('.v_chuyen-trang-div').eq(1).css('color') == 'rgb(255, 255, 255)') {
                        page = 1;
                    }else if ($('.v_chuyen-trang-div').eq(i).css('color') == 'rgb(255, 255, 255)'){
                        page = i - 1;
                    }
                }

                if (page == $('.v_chuyen-trang-div').length - 1) {
                    if ($('.v_chuyen-trang-div').eq($('.v_chuyen-trang-div').length - 2).css('color') == 'rgb(255, 255, 255)') {
                        page = $('.v_chuyen-trang-div').length - 2;
                    }else if ($('.v_chuyen-trang-div').eq(i).css('color') == 'rgb(255, 255, 255)'){
                        page = i + 1;
                    }
                }

                if ($('.v_chuyen-trang-div').eq(i).css('color') == 'rgb(255, 255, 255)') {
                    j = i;
                }

                $('.v_chuyen-trang-div').eq(i).css({
                    'color': 'black',
                    'background': 'none'
                });
            }
            $.ajax({
                url: '../ajax/v_course_save.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    number: page,
                    type: 1
                },
                success: function (data) {
                    $('.v_chuyen-trang-div').eq(page).css({
                        'color': 'white',
                        'background': '#1B6AAB'
                    });
                    $('.v_noidungkh').remove();
                    $('.v_content-mb').remove();
                    $('#content').append(data.html);
                },
                error: function () {
                   $('.v_chuyen-trang-div').eq(j).css({
                    'color': 'white',
                    'background': '#1B6AAB'
                });
                   alert("Có lỗi xảy ra. Vui lòng thử lại");
               }
           });       
        });
    });

    function v_save_del(e) {
        var save_id = $(e).val();
        var n = confirm("Bạn có muốn hủy không");
        if (n == true) {
            for (var i = 1; i < $(".v_chuyen-trang-div").length - 1; i++) {
                if ($(".v_chuyen-trang-div").eq(i).css('color') == 'rgb(255, 255, 255)') {
                    var pa = i;
                }
            }
            $.ajax({
                url: '../ajax/v_ajax_delete_course.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    save_id: save_id,
                    type: 1,
                    pa: pa
                },
                success: function (data) {
                    $('.v_noidungkh').remove();
                    $('.v_content-mb').remove();
                    if (data.html == 0) {
                        $('#v_content-title').remove();
                        $('#v_chuyentrang').remove();
                        $('#content').append('Không có danh sách');
                    }else{
                        $('#content').append(data.html);
                        if ($('#content').children('.v_noidungkh').length == 0) {
                            $('.v_chuyen-trang-div').eq(pa - 1).css({
                                "color": "white",
                                "background": "#1B6AAB"
                            });

                            $('.v_chuyen-trang-div').eq(pa).remove();
                            for (var i = 1; i < $(".v_chuyen-trang-div").length - 1; i++) {
                                $(".v_chuyen-trang-div").eq(i).text(i);
                            }
                        }
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại");
                }
            });
        }
    };
</script>

</html>