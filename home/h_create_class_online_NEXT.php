<?php
require_once '../code_xu_ly/h_home.php';
if(!isset($_COOKIE['user_id']) || $_COOKIE['user_type'] == 1){
   header('location:/');
}elseif(!isset($_COOKIE['course_name'])){
   header('location:/');
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
    <title>Tạo khóa học Online</title>
    <link rel="stylesheet" href="../css/custom-bootstrap.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_footer.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_header-home.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_nav_search.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/select2.min.css?v=<?=$version?>" />
    <link rel="stylesheet" href="../css/h_postclass.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_postclassNext.css?v=<?=$version?>">
    <style>
    #btnpost>img {
        width: 40px;
        height: 40px;
    }
    #btnpost_img {
        display: none;
    }
    .first .form-group{
        padding-left: 0 !important;
    }
    #btnpost_span {
        display: block;
    }
    .first, .post6{
        width: 100%;
        margin-left: 0;
    }
    .first{
        padding-bottom: 24px;
    }
    #course_slide{
        width: 65%;
    }
    .first2{
        width: 30%;
    }
    #month_study{
        width: 68%;
    }
    .postright{
        width: 100%;
    }
    .post4 button{
        margin-right: 0;
    }
    .container_next{
        padding-left: 1% !important;
    }
    .csspostright4 span{
        width: 65%;
    }
    @media(max-width: 480px){
        #month_study{
            width: 65% !important;
        }
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
            <div class="container container_next">
                <ol>
                    <li><a href="#">Trang chủ</a></li>
                    <li style="font-size: 18px;">></li>
                    <li>Tạo bài giảng</li>
                </ol>
            </div>
        </div>
        <div id="main-post">
            <div class="container">
                <div class="post-header">
                    <div class="post-header1">
                        <div class="post-header2">
                            <div class="post-header3">1</div>
                        </div>
                        <span>Tạo mô tả</span>
                    </div>
                    <img src="../img/image/bigright.svg">
                    <div class="post-header1">
                        <div class="post-header2">
                            <div class="post-header3">2</div>
                        </div>
                        <span>Tạo nội dung</span>
                    </div>
                    <img src="../img/image/bigright.svg">
                    <div class="post-header1">
                        <div class="post-header2">
                            <div class="post-header3">3</div>
                        </div>
                        <span>Gửi kiểm duyệt</span>
                    </div>
                    <img src="../img/image/bigright.svg">
                    <div class="post-header1">
                        <div class="post-header2">
                            <div class="post-header3">4</div>
                        </div>
                        <span>Xuất bản</span>
                    </div>
                </div>
                <div class="post-course">
                    <hr>
                    <h3>Nội dung khóa học : <?php
                    if (isset($_COOKIE['course_name'])) {
                        echo $_COOKIE['course_name'];
                    }
                    ?> </h3>
                    <div class="post-course1">
                        <form method="POST" enctype="multipart/form-data" onsubmit="return OnlineCourse()">
                            <div class="post5">
                                <div id="allposthere">
                                    <div id="postitem-main1"></div>
                                    <div class="post-item">
                                        <!-- <div class="postleft" id="postleft">
                                            <img src="../img/image/scroll.svg">
                                        </div> -->
                                        <div class="postright">
                                            <div class="postright1">
                                                <div class="postright11">
                                                    <input type="text" name="season_name[]" class="season_name part1"
                                                        placeholder="Phần 1: Tên phần">
                                                </div>
                                            </div>
                                            <div class="allpostright24">
                                                <div id="postitem-main3"></div>
                                                <div class="csspostrightitem postrightitem">
                                                    <div class="postright2">
                                                        <div class="postright21">
                                                            <img src="../img/image/scroll.svg">
                                                        </div>
                                                        <div class="postright22">
                                                            <img onclick="clickvideo(this)" class="clickvideo"
                                                                src="../img/image/video.svg">
                                                            <input type="text" name="episode_name[]"
                                                                class="episode_name part" placeholder="Tên bài">
                                                        </div>
                                                    </div>
                                                    <!--Document-->
                                                    <div class="csspostright4 thepostright">
                                                        <ul class="postright41">
                                                            <li class="upvideo activeli1" onclick="upvideo(this)">
                                                                Upload video </li>
                                                            <li class="upfile" onclick="upfile(this)">Upload tài liệu
                                                            </li>
                                                        </ul>
                                                        <div class="upvideo1">
                                                            <input type="file" class="video" name="video">
                                                            <label onclick="clickVideo2(this)">CHỌN FILE</label>
                                                            <span class="vsp">Chỉ được up file mp4</span>
                                                        </div>
                                                        <div class="upfile1">
                                                            <input type="file" class="document" name="document">
                                                            <label onclick="clickDoc2(this)">CHỌN FILE</label>
                                                            <span class="lsp">Chỉ được up file pdf</span>
                                                        </div>
                                                    </div>
                                                    <!--End Document-->
                                                </div>
                                            </div>
                                            <div class="postright3" onclick="addlesson(this)">
                                                <div class="postright31">
                                                    <img src="../img/image/add2.svg">
                                                    <p>Thêm bài giảng</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="postright31" id="addnewpost">
                                    <img src="../img/image/add2.svg">
                                    <a name="btn-post" id="btn-post" onclick="addnewpost(this)">Thêm học
                                        phần</a>
                                </div>
                            </div>

                            <div class="first">
                                <div class="first3">
                                    <div class="form-group time_learn_slide2">
                                        <label>Số buổi học</label>
                                        <div class="first1">
                                            <input id="time_learn" type="number" name="time_learn">
                                            <div class="first2">Buổi</div>
                                        </div>
                                    </div>
                                    <div class="form-group time_learn_slide2">
                                        <label>Tài liệu học</label>
                                        <div class="first1">
                                            <input id="course_slide" name="course_slide" type="number">
                                            <div class="first2">Slide</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="first3">
                                    <div class="form-group">
                                        <label>Thời gian học</label>
                                        <div class="first1">
                                            <input id="month_study" type="number" name="month_study"
                                                style="width: 68%;">
                                            <div class="first2">Tháng</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="post6">
                                <hr>
                                <h3>Thông tin bán hàng</h3>

                                <div class="post61">

                                    <div class="form-group">
                                        <label>Giá gốc</label>
                                        <div class="priceinput">

                                            <input type="text" name="price_listed" id="price_listed"
                                                onkeypress="isnumber(event)" placeholder="Nhập vào" id="price_listed">

                                            <div class="priced">d</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá khuyến mại</label>
                                        <div class="priceinput">

                                            <input type="text" name="price_promotional" id="price_promotional"
                                                onkeypress="isnumber(event)" placeholder="Nhập vào"
                                                id="price_promotional">

                                            <div class="priced">d</div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="clearaddprice">
                                        <label>Mua chung</label>
                                        <div class="priceinput">
                                            <div class="postright31 addprices" id="addprices">
                                                <p><img src="../img/image/add2.svg">Thêm khoảng giá</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group addnewprices">
                                        <div class="newprices">
                                            <div class="stdnumber">
                                                <div class="stdnumber1">
                                                    <label>Số lượng ( học viên)</label>
                                                    <input id="quantity_std" name="quantity_std" onkeypress="isnumber(event)" type="number">
                                                </div>
                                                <div class="stdnumber2">
                                                    <label>Giá</label>
                                                    <input id="price_discount" onkeypress="isnumber(event)" name="price_discount" type="number">
                                                </div>
                                                <img class="trash" src="../img/image/trash.svg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="post4">
                                <button name="btn_online2" id="btnpost"><img src="../img/Spinner-1s-200px.gif" id="btnpost_img" alt=""><span id="btnpost_span">GỬI KIỂM DUYỆT</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--END: MAIN-->


    <!-- FOOTER -->
    <?php
    include '../includes/h_inc_footer.php';
    ?>
    <!-- END: FOOTER -->
    <script src="../js/select2.min.js?v=<?=$version?>"></script>
    <script src="../js/h_courses.js?v=<?=$version?>"></script>
    <script src="../js/v_search.js?v=<?=$version?>"></script>
    <script>
    function OnlineCourse() {
        var form_data = new FormData();
        var user_id = <?=$cookie_id?>;
        var time_learn = $("#time_learn").val();
        var course_slide = $("#course_slide").val();
        var price_promotional = Number($("#price_promotional").val());

        if ($("#price_promotional").val() != '') {
            form_data.append('price_promotional', Number($("#price_promotional").val()));
        }
        var price_listed = Number($("#price_listed").val());
        if ($("#price_discount").val() != "") {
            var price_discount = Number($("#price_discount").val());
        }else{
            var price_discount = 0;
        }
        var quantity_std = Number($("#quantity_std").val());
        if ($("#quantity_std").val() != "") {
            var quantity_std = Number($("#quantity_std").val());
        }else{
            var quantity_std = 0;
        }
        var month_study = $("#month_study").val();

        if (course_slide == '') {
            alert("Vui lòng nhập số tài liệu");
            $("#course_slide").focus();
            return false;
        }else if(Number($("#course_slide").val()) == 0){
            alert("Số tài liệu tối thiểu là 1");
            $("#course_slide").focus();
            return false;
        }

        if (time_learn == '') {
            alert("Vui lòng nhập thời gian học");
            $("#time_learn").focus();
            return false;
        }else if (Number($("#time_learn").val()) == 0) {
            alert("Số buổi học tối thiểu là 1");
            $("#time_learn").focus();
            return false;
        }

        if (month_study == '') {
            alert("Vui lòng nhập thời gian học");
            $("#month_study").focus();
            return false;
        }else if (Number($('#month_study').val()) == 0) {
            alert("Thời gian học tối thiểu là 1 tháng");
            $("#month_study").focus();
            return false;
        }

        if ($("#price_listed").val() == '') {
            alert("Vui lòng nhập giá gốc");
            $("#price_listed").focus();
            return false;
        }

        if ($("#price_promotional").val() != "") {
            if (price_promotional >= price_listed) {
                alert("Giá khuyến mại không được lớn hơn hoặc bằng giá gốc");
                $("#price_promotional").focus();
                return false;
            }else{
                form_data.append('price_promotional', price_promotional);
            }
        }
        if ($("#quantity_std").val() != "") {
            if (quantity_std < 2) {
                alert("Số lượng học viên mua chung tối thiểu là 2");
                $("#quantity_std").focus();
                return false;
            }else{
                form_data.append('quantity_std', quantity_std);
            }

            if ($("#price_discount").val() == "") {
                alert("Vui lòng nhập khoảng giá");
                $("#price_discount").focus();
                return false;
            }else{
                form_data.append('price_discount', price_discount);
            }
        }else{
            if ($("#price_discount").val() != "") {
                alert("Bạn chưa nhập số lượng học viên mua chung");
                $("#quantity_std").focus();
                return false;
            }
        }

        var episode_name = [];
        for (var i = 0; i < $(".post-item").length; i++) {
            episode_name[i] = [];
            if ($(".post-item .season_name")[i].value.trim() == "") {
                alert("Vui lòng nhập tên phần học");
                return false;
            } else {
                form_data.append('season_name[]', $(".post-item .season_name")[i].value);
            }

            for (var j = 0; j < $(".post-item:eq(" + i + ") .episode_name").length; j++) {
                if ($(".post-item:eq(" + i + ") .episode_name")[j].value.trim() == "") {
                    alert("Vui lòng nhập tên đầy đủ tên bài học");
                    return false;
                } else {
                    episode_name[i].push($(".post-item:eq(" + i + ") .episode_name")[j].value);
                }
                if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .video").prop('files')[0] == undefined) {
                    alert("Vui lòng chọn đủ Video mỗi bài học");
                    return false;
                } else if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .video").prop('files')[0].type !=
                    'video/mp4') {
                    alert("Video phải định dạng mp4");
                    return false;
                } else {
                    form_data.append('video[]', $(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .video").prop(
                        'files')[0]);
                }

                if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .document").prop('files')[0] == undefined) {
                    alert("Vui lòng chọn đủ Tài liệu mỗi bài học");
                    return false;
                } else if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .document").prop('files')[0].type !=
                    'application/pdf') {
                    alert("Tài liệu phải định dạng pdf");
                    return false;
                } else {
                    form_data.append('document[]', $(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .document")
                        .prop('files')[0]);
                }
            }
            form_data.append('episode_name[]', episode_name[i]);
            form_data.append('time_learn', Number($("#time_learn").val()));
            form_data.append('course_slide', Number($("#course_slide").val()));
            form_data.append('price_listed', price_listed);
            form_data.append('month_study', Number($('#month_study').val()));
            $("#btnpost")[0].type = 'button';
            $("#btnpost_img").css('display', 'block');
            $("#btnpost_span").css('display', 'none');
            $("#btnpost").css('padding', '0');
        }
        $.ajax({
            url: '../code_xu_ly/v_next.php',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type == 2) {
                    alert("Gửi kiểm duyệt thành công. Vui lòng chờ phản hồi");
                    window.location.href = '/giang-vien-khoa-hoc-online/id' + user_id + '-p1.html';
                } else if (data.type == 3) {
                    alert("Gửi kiểm duyệt thành công. Vui lòng chờ phản hồi");
                    window.location.href = '/trung-tam-khoa-hoc-online-giang-day/id' + user_id +
                        '&page1.html';
                }
                $("#btnpost")[0].type = 'submit';
                $("#btnpost").css('padding', '0');
                $("#btnpost_img").css('display', 'none');
                $("#btnpost_span").css('display', 'block');
            },
            error: function() {
                alert("Có lỗi xảy ra. Vui lòng thử lại");
                $("#btnpost")[0].type = 'submit';
                $("#btnpost").css('padding', '0');
                $("#btnpost_img").css('display', 'none');
                $("#btnpost_span").css('display', 'block');
            }
        });
        return false;
    }
    </script>
</body>

</html>