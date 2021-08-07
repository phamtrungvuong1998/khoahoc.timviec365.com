<?
require_once '../code_xu_ly/h_home.php';
if(!isset($_COOKIE['user_id']) ||$_COOKIE['user_type'] == 1){
    header('location:/');
}elseif(!isset($_COOKIE['course_name'])){
    if($_COOKIE['user_type'] == 2){
        header("location:/giang-vien-khoa-hoc-online/id$cookie_id-p1.html");
    }elseif($_COOKIE['user_type'] == 3){
        header("location:/trung-tam-khoa-hoc-online-giang-day/id$cookie_id&page1.html");
    }
}else{
    $course_id = getValue('course_id', 'int', 'GET', '0');
    $dbon = new db_query("SELECT * FROM courses  WHERE course_id = $course_id");
    $rowon = mysql_fetch_array($dbon->result);
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
    <title>Cập nhật khóa học Online</title>
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

    #btnpost_span {
        display: block;
    }

    #btnpost>img {
        width: 40px;
        height: 40px;
    }

    #btnpost_img {
        display: none;
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
    .postright{
        height: auto;
    }
    .postright31{
        padding-bottom: 0;
    }
    @media(max-width: 480px){
        #month_study{
            width: 65% !important;
        }
    }

    <?php 
    if ($rowon['quantity_std'] == 0) {
        echo '#clearaddprice{
        display: block;
    }
    .addnewprices{
        display: none;
    }';
    }else{
        echo '#clearaddprice{
        display: none;
    }
    .addnewprices{
        display: block;
    }';
    }
    ?>
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
                    <h3>Nội dung khóa học : <?=$rowon['course_name']?></h3>
                    <div class="post-course1">
                        <form method="POST" enctype="multipart/form-data" onsubmit="return OnlineCourse()">
                            <div class="post5">
                                <div id="allposthere">
                                    <?
                                        $qr4 = new db_query("SELECT lesson_id,lesson_name FROM course_lesson WHERE course_id = $course_id AND lesson_parent = 0");
                                        $num2 = mysql_num_rows($qr4->result);
                                        while ($row4 = mysql_fetch_array($qr4->result)) {
                                                $lesson_id = $row4['lesson_id'];
                                    ?>
                                    <div class="post-item" id="post-item<?=$lesson_id?>">
                                        <div class="postleft">
                                            <img src="../img/image/scroll.svg">
                                        </div>
                                        <div class="postright">
                                            <div class="postright1">
                                                <div class="postright11">
                                                    <input type="text" name="season_name[]" class="season_name part1"
                                                        value="<?=$row4['lesson_name']?>">
                                                </div>
                                            </div>
                                            <div class="allpostright24">
                                                <?php
                                                $qr5 = new db_query("SELECT * FROM course_lesson WHERE course_id = $course_id AND lesson_parent = $lesson_id");
                                                while ($row5 = mysql_fetch_array($qr5->result)) {
                                                    $lesson_id1 = $row5['lesson_id'];
                                                        ?>
                                                <div class="csspostrightitem postrightitem"
                                                    id="postrightitem<?=$lesson_id1?>">
                                                    <div class="postright2">
                                                        <div class="postright21">
                                                            <img src="../img/image/scroll.svg">
                                                        </div>
                                                        <div class="postright22">
                                                            <img onclick="clickvideo(this)" class="clickvideo"
                                                                src="../img/image/video.svg">
                                                            <input type="text" name="episode_name[]"
                                                                class="episode_name part"
                                                                value="<?=$row5['lesson_name']?>">
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
                                                            <span class="vsp"><?=$row5['video']?></span>
                                                        </div>
                                                        <div class="upfile1">
                                                            <input type="file" class="document" name="document">
                                                            <label onclick="clickDoc2(this)">CHỌN FILE</label>
                                                            <span class="lsp"><?=$row5['document']?></span>
                                                        </div>
                                                    </div>
                                                    <p class="xclear del_epison" data-episode="<?=$lesson_id1?>"
                                                        onclick="del_episode(this)">X</p>
                                                    <!--End Document-->
                                                </div>
                                                <?php
                                                    } ?>
                                            </div>
                                            <div class="postright3" onclick="addlesson(this)">
                                                <div class="postright31">
                                                    <img src="../img/image/add2.svg">
                                                    <p>Thêm bài giảng</p>
                                                </div>
                                            </div>
                                        </div>
                                        <img class="move1" src="../img/image/up.svg">
                                        <img class="clear1 del_all" data-season="<?=$lesson_id?>"
                                            src="../img/image/delete.svg">
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>

                                <div class="postright31" id="addnewpost">
                                    <img src="../img/image/add2.svg">
                                    <a name="btn-post" id="btn-post" onclick="addnewpost(this)">Thêm học
                                        phần</a>
                                </div>
                            </div>

                            <div class="first">
                                <div class="first3">
                                    <div class="form-group">
                                        <label>Số buổi học</label>
                                        <?php
                                        if ($rowon['time_learn'] == 0) {
                                            $time_learn = "";
                                        }else{
                                            $time_learn = $rowon['time_learn'];
                                        }
                                        ?>
                                        <div class="first1">
                                            <input id="time_learn" type="text" onkeypress="isnumber(event)" name="time_learn"
                                                value="<?=$time_learn?>">
                                            <div class="first2">Buổi</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tài liệu học</label>
                                        <?php
                                        if ($rowon['course_slide'] == 0) {
                                            $course_slide = "";
                                        }else{
                                            $course_slide = $rowon['course_slide'];
                                        }
                                        ?>
                                        <div class="first1">
                                            <input id="course_slide" name="course_slide" type="text" onkeypress="isnumber(event)" value="<?=$course_slide?>">
                                            <div class="first2">Slide</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="first3">
                                    <div class="form-group form-group2">
                                        <label>Thời gian học</label>
                                        <?php
                                        if ($rowon['month_study'] == 0) {
                                            $month_study = "";
                                        }else{
                                            $month_study = $rowon['month_study'];
                                        }
                                        ?>
                                        <div class="first1">
                                            <input id="month_study" onkeypress="isnumber(event)" type="text" name="month_study" style="width: 60%;"
                                                value="<?=$month_study?>">
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
                                            <?php
                                            if ($rowon['price_listed'] == -1) {
                                                $price_listed = "";
                                            }else{
                                                $price_listed = $rowon['price_listed'];
                                            }

                                            if ($rowon['price_promotional'] == -1) {
                                                $price_promotional = "";
                                            }else{
                                                $price_promotional = $rowon['price_promotional'];
                                            }
                                            ?>
                                            <input type="text" name="price_listed" id="price_listed"
                                                onkeypress="isnumber(event)" value="<?=$price_listed?>">
                                            <div class="priced">d</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá khuyến mại</label>
                                        <div class="priceinput">
                                            <input type="text" name="price_promotional" id="price_promotional"
                                                onkeypress="isnumber(event)" value="<?=$price_promotional?>">
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
                                                    <?php
                                                    if ($rowon['quantity_std'] == 0) {
                                                        $quantity_std = "";
                                                        $price_discount = "";
                                                    }else{
                                                        $quantity_std = $rowon['quantity_std'];
                                                        $price_discount = $rowon['price_discount'];
                                                    }   
                                                    ?>
                                                    <label>Số lượng ( học viên)</label>
                                                    <input id="quantity_std" onkeypress="isnumber(event)" type="text"
                                                        value="<?=$quantity_std?>">
                                                </div>
                                                <div class="stdnumber2">
                                                    <label>Giá</label>
                                                    <input id="price_discount" onkeypress="isnumber(event)" type="text"
                                                        value="<?=$price_discount?>">
                                                </div>
                                                <img class="trash" src="../img/image/trash.svg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="post4">
                                <button name="btn_online2" type="submit" id="btnpost"><img
                                        src="../img/Spinner-1s-200px.gif" id="btnpost_img" alt=""><span
                                        id="btnpost_span">LƯU LẠI</span></button>
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
    include '../includes/h_popup_create_class.php';
    include '../includes/h_inc_footer.php';
    ?>
    <!-- END: FOOTER -->
    <script src="../js/select2.min.js?v=<?=$version?>"></script>
    <script src="../js/h_courses.js?v=<?=$version?>"></script>
    <script src="../js/v_search.js?v=<?=$version?>"></script>
    <script>
    if ($(".post-item").length == 0) {
        var v_n = 0;
    }else{
        var v_n = 1;
    }
    $(document).ready(function() {
        $(".del_all").click(function() {
            var index = $(this).index('.del_all');
            var lesson_id = $(this)[0].dataset.season;
            $.ajax({
                url: '../ajax/v_del_season_name.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    lesson_id: lesson_id
                },
                success: function(data) {
                    $('.post-item').eq(index).remove();
                    sum--;
                },
                error: function() {
                    alert("Có lỗi xảy ra. Vui lòng thử lại");
                }
            });
        });

        $(".del_epison").click(function() {
            var lesson_id = $(this)[0].dataset.episode;
            var index = $(this).index('.del_epison');
            $.ajax({
                url: '../ajax/v_del_epison.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    lesson_id: lesson_id
                },
                success: function(data) {
                    $(".postrightitem").eq(index).remove();
                },
                error: function() {
                    alert("Có lỗi xảy ra. Vui lòng thử lại");
                }
            });

        });
    });


    var sum = $(".post-item").length;
    var arr_epison = [];
    for (var i = 0; i < sum; i++) {
        arr_epison[i] = [];
        for (var j = 0; j < $(".post-item:eq(" + i + ") .episode_name").length; j++) {
            arr_epison[i].push($(".post-item:eq(" + i + ") .episode_name").val());
        }
    }

    function OnlineCourse() {
        var form_data = new FormData();
        var course_id = <?php echo $course_id; ?>;
        var time_learn = $("#time_learn").val();
        var course_slide = $("#course_slide").val();
        var price_promotional = Number($("#price_promotional").val());
        var price_listed = Number($("#price_listed").val());
        var price_discount = $("#price_discount").val();
        var quantity_std = $("#quantity_std").val();
        var month_study = $("#month_study").val();

        if ($("#price_promotional").val() != '') {
            form_data.append('price_promotional', Number($("#price_promotional").val()));
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
        if (course_slide == '') {
            alert("Vui lòng nhập số tài liệu");
            $("#course_slide").focus();
            return false;
        }else if (Number($('#course_slide').val()) == 0) {
            alert("Số tài liệu tối thiểu là 1");
            $("#course_slide").focus();
            return false;
        }
        if (time_learn == '') {
            alert("Vui lòng nhập thời gian học");
            $("#time_learn").focus();
            return false;
        }else if (Number($('#time_learn').val()) == 0) {
            alert("Số buổi học tối thiểu là 1");
            $("#time_learn").focus();
            return false;
        }

        if (month_study == '') {
            alert("Vui lòng nhập thời gian học");
            $("#month_study").focus();
            return false;
        }else if (Number($("#month_study").val()) == 0) {
            alert("Thời gian học tối thiểu là 1 tháng");
            $("#month_study").focus();
            return false;
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

        if ($("#price_promotional").val() != "") {
            if (price_promotional >= price_listed) {
                alert("Giá khuyến mại không được lớn hơn hoặc bằng giá gốc");
                $("#price_promotional").focus();
                return false;
            }else{
                form_data.append('price_promotional', price_promotional);
            }
        }

        var episode_name = [];
        var form_data = new FormData();
        form_data.append('course_id', course_id);

        if ($(".post-item").length == 0) {
            alert("Vui lòng nhập đầy đủ phần học");
            return false;
        }

        for (var i = 0; i < sum; i++) {
            if ($(".post-item .season_name")[i].value.trim() == "") {
                alert("Vui lòng nhập tên phần học");
                return false;
            } else {
                form_data.append('season_name[]', $(".post-item .season_name")[i].value);
            }
            for (var j = 0; j < $(".post-item:eq(" + i + ") .episode_name").length; j++) {
                if ($(".post-item:eq(" + i + ") .episode_name:eq(" + j + ")")[0].value.trim() == "") {
                    alert("Vui lòng nhập tên đầy đủ tên bài học");
                    return false;
                } else {
                    form_data.append('episode_name[' + i + '][' + j + ']', $(".post-item:eq(" + i +
                        ") .episode_name:eq(" + j + ")")[0].value);
                }
                if (arr_epison[i][j] == undefined) {
                    if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .video").prop('files')[0] ==
                        undefined) {
                        alert("Vui lòng chọn đủ bộ tài liệu");
                        return false;
                    }

                    if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .document").prop('files')[0] ==
                        undefined) {
                        alert("Vui lòng chọn đủ bộ tài liệu");
                        return false;
                    }
                }

                if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .video").prop('files')[0] != undefined) {
                    if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .video").prop('files')[0].type !=
                        'video/mp4') {
                        alert("Video phải định dạng mp4");
                        return false;
                    } else {
                        form_data.append('video[' + i + '][' + j + ']', $(".post-item:eq(" + i + ") .thepostright:eq(" +
                            j + ") .video").prop('files')[0]);
                    }
                }

                if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .document").prop('files')[0] != undefined) {
                    if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .document").prop('files')[0].type !=
                        'application/pdf') {
                        alert("Tài liệu phải định dạng pdf");
                        return false;
                    } else {
                        form_data.append('document[' + i + '][' + j + ']', $(".post-item:eq(" + i +
                                ") .thepostright:eq(" + j + ") .document")
                            .prop('files')[0]);
                    }
                }
            }
        }
        for (var i = sum; i < $(".post-item").length; i++) {
            if ($(".post-item .season_name")[i].value.trim() == "") {
                alert("Vui lòng nhập tên phần học");
                return false;
            } else {
                form_data.append('season_nameUpdate[]', $(".post-item .season_name")[i].value);
            }
            for (var j = 0; j < $(".post-item:eq(" + i + ") .episode_name").length; j++) {
                if ($(".post-item:eq(" + i + ") .episode_name:eq(" + j + ")")[0].value.trim() == "") {
                    alert("Vui lòng nhập tên đầy đủ tên bài học");
                    return false;
                } else {
                    form_data.append('episode_nameUpdate[' + (i - sum) + '][' + j + ']', $(".post-item:eq(" + i +
                        ") .episode_name:eq(" + j + ")")[0].value);
                }
                if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .video").prop('files')[0] == undefined) {
                    alert("Vui lòng chọn đủ bộ tài liệu");
                    return false;
                } else if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .video").prop('files')[0] !=
                    undefined) {
                    if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .video").prop('files')[0].type !=
                        'video/mp4') {
                        alert("Video phải định dạng mp4");
                        return false;
                    } else {
                        form_data.append('videoUpdate[' + (i - sum) + '][' + j + ']', $(".post-item:eq(" + i +
                            ") .thepostright:eq(" + j + ") .video").prop('files')[0]);
                    }
                }

                if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .document").prop('files')[0] == undefined) {
                    alert("Vui lòng chọn đủ bộ tài liệu");
                    return false;
                } else if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .document").prop('files')[0] !=
                    undefined) {
                    if ($(".post-item:eq(" + i + ") .thepostright:eq(" + j + ") .document").prop('files')[0].type !=
                        'application/pdf') {
                        alert("Tài liệu phải định dạng pdf");
                        return false;
                    } else {
                        form_data.append('documentUpdate[' + (i - sum) + '][' + j + ']', $(".post-item:eq(" + i +
                                ") .thepostright:eq(" + j + ") .document")
                            .prop('files')[0]);
                    }
                }
            }
        }
        form_data.append('time_learn', Number($("#time_learn").val()));
        form_data.append('course_slide', Number($("#course_slide").val()));
        form_data.append('price_listed', price_listed);
        form_data.append('month_study', Number($("#month_study").val()));
        form_data.append('v_n', v_n);
        $("#btnpost")[0].type = 'button';
        $("#btnpost_img").css('display', 'block');
        $("#btnpost_span").css('display', 'none');
        $("#btnpost").css('padding', '0');
        $.ajax({
            url: '../code_xu_ly/v_update_next.php',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type == 2) {
                    if (v_n == 0) {
                        alert("Gửi kiểm duyệt thành công. Vui lòng chờ phản hồi");
                    }
                    window.location = '/giang-vien-khoa-hoc-online/id' + course_id + '-p1.html';
                } else if (data.type == 3) {
                    window.location = '/trung-tam-khoa-hoc-online-giang-day/id' + course_id + '&page1.html';
                }
                $("#btnpost")[0].type = 'submit';
                $("#btnpost").css('padding', '0');
                $("#btnpost_img").css('display', 'none');
                $("#btnpost_span").css('display', 'block');
            },
            error: function() {
                alert("Có lỗi xảy ra. Vui lòng thử lại");
                $("#btnpost")[0].type = 'submit';
                $("#btnpost").css('padding', '9px 16px 8px 16px');
                $("#btnpost_img").css('display', 'none');
                $("#btnpost_span").css('display', 'block');
            }
        });
        return false;
    }
    </script>
</body>

</html>