<?php
require_once '../code_xu_ly/h_home.php';
if(!isset($_COOKIE['user_id']) ||$_COOKIE['user_type'] != 2){
    header('location:/');
}

$course_id = getValue('course_id','int','GET','0');
$dbon = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id WHERE courses.course_id = $course_id");
$rowof = mysql_fetch_array($dbon->result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <title>Cập nhật khóa học Offline</title>
    <link rel="stylesheet" href="../css/custom-bootstrap.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_footer.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_header-home.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_nav_search.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/select2.min.css?v=<?=$version?>" />
    <link rel="stylesheet" href="../css/h_postclass.css?v=<?=$version?>">
    <style>
        .success{
            background-color: #dff0d8;
            color: #3c763d;
        }
        #login_btn{
            color: white;
        }
        #singup_img{
            width: 25px;
            display: none;
        }
        <?php 
        if ($rowof['quantity_std'] == 0) { 
            echo '#addprices{
            display: block;
        }

        #addnewprice{
            display: none;
        }';
        }else{
            echo '#addprices{
            display: none;
        }

        #addnewprice{
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
            <div class="container">
                <ol>
                    <li><a href="#">Trang chủ</a></li>
                    <li style="font-size: 18px;">></li>
                    <li>Tạo bài giảng</li>
                </ol>
            </div>
        </div>
        <div class="container">
            <div id="v_alert"></div>
            <div id="main-post">
                <form method="POST" name="v_create_center" enctype="multipart/form-data" onsubmit="return validation()">
                    <div class="first">
                        <hr>
                        <h3>Thông tin cơ bản</h3>
                        <div class="container">
                            <div class="form-group">
                                <label>Tên khóa học</label>
                                <div class="first1">
                                    <input id="course_name" type="text" onkeyup="v_demkitu()"  name="course_name"
                                        value="<?=$rowof['course_name']?>">
                                    <div class="first2 count_kitu">0/120</div>
                                </div>
                            </div>
                            <div class="first3">
                                <div class="form-group cate_tag_id">
                                    <label>Môn học</label>
                                    <select class="cate2" id="cate_id" name="cate_id">
                                        <option value="0">Chọn Môn học</option>
                                        <?php
                                            $db_cate = new db_query("SELECT * FROM categories");
                                            while ($row = mysql_fetch_array($db_cate->result)) {
                                                ?>
                                        <option <?php if($row['cate_id'] == $rowof['cate_id']) echo 'selected' ?>
                                            class="catet2db" value="<?=$row['cate_id']?>"><?=$row['cate_name']?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group cate_tag_id">
                                    <label>Môn học chi tiết</label>
                                    <select class="tag2" name="tag_id" id="tag_id">
                                        <option value="0">Chọn Môn học</option>
                                        <?
                                            $db_tag = new db_query("SELECT * FROM tags");
                                            while ($row = mysql_fetch_array($db_tag->result)) {
                                                ?>
                                        <option <?php if($row['tag_id'] == $rowof['tag_id']) echo 'selected' ?>
                                            class="tag2db" value="<?=$row['tag_id']?>"><?=$row['tag_name']?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="post12" id="ava-off">
                                <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' id="avatar"
                                    src="../img/course/<?=$rowof['course_avatar']?>">
                                <button type="button" class="postimg camera-img"><img src=" ../img/image/addimg.svg">Ảnh
                                    khóa học</button>
                                <input type="file" class="hidden" id="img" onchange="changeImg(this)"
                                    name="course_avatar">
                            </div>
                            <div class="form-group">
                                <label>Mô tả khóa học</label>
                                <textarea id="course_describe"
                                    name="course_describe"><?=$rowof['course_describe']?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Bạn sẽ học những gì</label>
                                <textarea id="course_learn" name="course_learn"><?=$rowof['course_learn']?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Đối tượng học viên</label>
                                <textarea id="course_object"
                                    name="course_object"><?=$rowof['course_object']?></textarea>
                            </div>
                            <div class="first3">
                                <div class="form-group time_learn_slide">
                                    <label>Thời gian học</label>
                                    <div class="first1">
                                        <input id="time_learn" type="text" onkeypress="isnumber(event)" name="time_learn"
                                            value="<?=$rowof['time_learn']?>">
                                        <div class="first2">Buổi</div>
                                    </div>
                                </div>
                                <div class="form-group time_learn_slide">
                                    <label>Tài liệu học</label>
                                    <div class="first1">
                                        <input id="course_slide" name="course_slide" onkeypress="isnumber(event)" type="text"
                                            value="<?=$rowof['course_slide']?>">
                                        <div class="first2">Slide</div>
                                    </div>
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
                                    <input type="text" id="price_listed" placeholder="Nhập vào"
                                        onkeypress="isnumber(event)" value="<?=$rowof['price_listed']?>">
                                    <div class="priced">d</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Giá khuyến mại</label>
                                <div class="priceinput">
                                    <input type="text" id="price_promotional" placeholder="Nhập vào"
                                        onkeypress="isnumber(event)" value="<?php 
                                        if($rowof['price_promotional'] != -1){
                                            echo $rowof['price_promotional'];
                                        }
                                        ?>">
                                    <div class="priced">d</div>
                                </div>
                            </div>

                            <div class="form-group" id="clearaddprice">
                                <div class="priceinput">
                                    <div class="postright31 addprices" id="addprices">
                                        <p><img src="../img/image/add2.svg">Thêm khoảng giá</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group addnewprices" id="addnewprice">
                                <label>Mua chung</label>
                                <?php
                                if ($rowof['quantity_std'] != 0) {
                                    $quantity_std = $rowof['quantity_std'];
                                    $price_discount = $rowof['price_discount'];
                                }else{
                                    $quantity_std = '';
                                    $price_discount = '';
                                }
                                ?>
                                <div class="newprices">
                                    <div class="stdnumber">
                                        <div class="stdnumber1">
                                            <label>Số lượng ( học viên)</label>
                                            <input type="text" name="quantity_std" id="quantity_std" onkeypress="isnumber(event)"
                                                value="<?=$quantity_std?>">
                                        </div>
                                        <div class="stdnumber2">
                                            <label>Giá</label>
                                            <input type="text" name="price_discount" id="price_discount" onkeypress="isnumber(event)"
                                                value="<?=$price_discount?>">
                                        </div>
                                        <img class="trash" src="../img/image/trash.svg">
                                    </div>

                                    <!-- <div class="postright31 addprices">
                                        <img src="../img/image/add2.svg">
                                        <p>Thêm khoảng giá</p>
                                    </div> -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="first">
                        <hr>
                        <h3>Trình độ</h3>
                        <div class="second2">
                            <?
                                $db_lv = new db_query("SELECT * FROM `levels`");
                                while ($row = mysql_fetch_array($db_lv->result)) {
                            ?>
                            <div class="form-group">
                                <input class="level_id" <?php if($row['level_id'] == $rowof['level_id']) echo 'checked' ?> type="radio"
                                    value="<?=$row['level_id']?>" name="level_id">
                                <label><?=$row['level_name']?></label>
                            </div>
                            <?
                                }
                            ?>
                        </div>
                    </div>
                    <div class="first">
                        <hr>
                        <h3>Thời gian học</h3>
                        <div class="second">
                            <div class="form-group month_study1">
                                <input type="text" name="month_study" id="month_study"
                                    value="<?=$rowof['month_study']?>" onkeypress="isnumber(event)"
                                    value="<?php if(isset($_POST['month_study'])) echo $_POST['month_study'] ?>" placeholder="VD:6 tháng">
                                <div class="first2">Tháng</div>
                            </div>
                        </div>
                        <p id="v_course-16"></p>
                    </div>
                    <div class="first">
                        <hr>
                        <h3>Địa điểm học</h3>
                        <div class="second3">
                            <div class="form-group v_address">
                                <?php
                                $db_course_basis = new db_query("SELECT * FROM course_basis WHERE course_id = $course_id");
                                $row_basis = mysql_fetch_array($db_course_basis->result);
                                ?>
                                <select id="cit_id" name="cit_id">
                                    <option value="0">Chọn tỉnh thành</option>
                                    <?php
									$db_cit = new db_query("SELECT cit_id,cit_name FROM city WHERE cit_parent = 0");
                                    while ($row = mysql_fetch_array($db_cit->result)) {
                                        if ($row['cit_id'] == $row_basis['cit_id']) {
                                            $select = 'selected';
                                        }else{
                                            $select = '';
                                        }
                                        ?>
                                    <option class="chontinhthanh" value="<?=$row['cit_id']?>" <?php echo $select; ?>>
                                        <?=$row['cit_name']?>
                                    </option>
                                    <?
      		                              }
										?>
                                </select>
                                <select name="district_id" id="district_id">
                                    <?php
                                        $db_cit = new db_query("SELECT cit_id,cit_name FROM city WHERE cit_parent = " . $row_basis['cit_id']);
                                        while ($row = mysql_fetch_array($db_cit->result)) {
                                            if ($row['cit_id'] == $row_basis['district_id']) {
                                                $select = 'selected';
                                            }else{
                                                $select = '';
                                            }
                                    ?>
                                    <option class="chonquanhuyen" value="<?=$row['cit_id']?>" <?php echo $select; ?>><?=$row['cit_name']?>
                                    </option>
                                    <?php
                                            }
                                    ?>
                                </select>
                                <input type="text" name="course_address" id="course_address"
                                    value="<?=$row_basis['course_address']?>" placeholder="số nhà, ngõ, ngách, đường, phố"
                                    class="address">
                            </div>
                        </div>
                    </div>
                    <div class="btnsave">
                        <button name="btn_offline" id="btnnext"><span id="login_btn">LƯU VÀ HIỂN THỊ</span><img id="singup_img" src="../img/Spinner-1s-200px.gif" alt=""></button>
                    </div>

                </form>
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
    function v_demkitu() {
        var count = $("#course_name").val().length;
        $(".count_kitu").text(count + "/120");
    }
    function validation() {
        var form_data = new FormData();
        if ($("#course_name").val() == "") {
            $("#v_alert").append(
                '<div class="alert" id="alert_course_name">Tên khóa học không được để trống</div>');
            $("#course_name").focus();
            setTimeout(function() {
                $("#alert_course_name").fadeOut(1000, function() {
                    $("#alert_course_name").remove();
                })
            }, 2000);
            return false;
        } else if ($("#course_name").val().length > 120) {
            $("#v_alert").append(
                '<div class="alert" id="alert_course_name">Tên khóa học không được hơn 120 kí tự</div>');
            $("#course_name").focus();
            setTimeout(function() {
                $("#alert_course_name").fadeOut(1000, function() {
                    $("#alert_course_name").remove();
                })
            }, 2000);
            return false;
        } else {
            form_data.append('course_name', $("#course_name").val());
        }

        if ($("#cate_id").val() == 0) {
            $("#v_alert").append('<div class="alert" id="alert_cate">Vui lòng chọn môn học</div>');
            $("#cate_id").focus();
            setTimeout(function() {
                $("#alert_cate").fadeOut(1000, function() {
                    $("#alert_cate").remove();
                })
            }, 2000);
            return false;
        } else {
            form_data.append('cate_id', $("#cate_id").val());
        }

        if ($("#img").prop('files')[0] != undefined) {
            if ($("#img").prop('files')[0].size > 204800) {
                $("#v_alert").append('<div class="alert" id="alert_img">Vui lòng chọn kích thước ảnh dưới 200KB</div>');
                $("#img").show();
                $("#img").focus();
                $("#img").hide();
                setTimeout(function() {
                    $("#alert_img").fadeOut(1000, function() {
                        $("#alert_img").remove();
                    });
                }, 2000);
                return false;
            }
            var match = ["image/jpeg", "image/JPEG", "image/png", "image/PNG", "image/jpg", "image/JPG"];
            var j = 0;
            for (var i = 0; i < match.length; i++) {
                if ($('#img').prop('files')[0].type != match[i]) {
                    j++;
                }
            }
            if (j == 6) {
                $("#v_alert").append('<div class="alert" id="alert_img">Vui lòng chọn đúng định dạng ảnh</div>');
                setTimeout(function() {
                    $("#alert_img").fadeOut(1000, function() {
                        $("#alert_img").remove();
                    });
                }, 2000);
                $('#img').show();
                $('#img').focus();
                $('#img').hide();
                return false;
            } else {
                form_data.append('file', $('#img').prop('files')[0]);
            }
        }

        if ($("#course_describe").val() == "") {
            $("#v_alert").append(
                '<div class="alert" id="alert_description">Mô tả khóa học không được để trống</div>');
            setTimeout(function() {
                $("#alert_description").fadeOut(1000, function() {
                    $("#alert_description").remove();
                });
            }, 2000);
            $('#course_describe').focus();
            return false;
        }else{
            form_data.append('course_describe', $("#course_describe").val());
        }

        if ($("#course_learn").val() == "") {
            $("#v_alert").append(
                '<div class="alert" id="alert_get_what">Bạn sẽ học những gì không được để trống</div>');
            setTimeout(function() {
                $("#alert_get_what").fadeOut(1000, function() {
                    $("#alert_get_what").remove();
                });
            }, 2000);
            $('#course_learn').focus();
            return false;
        } else {
            form_data.append('course_learn', $("#course_learn").val());
        }

        if ($("#course_object").val() == "") {
            $("#v_alert").append(
                '<div class="alert" id="alert_object">Đối tượng học viên không đươc để trống</div>');
            setTimeout(function() {
                $("#alert_object").fadeOut(1000, function() {
                    $("#alert_object").remove();
                });
            }, 2000);
            $('#course_object').focus();
            return false;
        } else {
            form_data.append('course_object', $("#course_object").val());
        }

        if ($("#time_learn").val() == "") {
            $("#v_alert").append(
                '<div class="alert" id="alert_time_learn">Thời gian học không được để trống</div>');
            setTimeout(function() {
                $("#alert_time_learn").fadeOut(1000, function() {
                    $("#alert_time_learn").remove();
                });
            }, 2000);
            $('#time_learn').focus();
            return false;
        } else if (Number($("#time_learn").val()) == 0) {
            $("#v_alert").append('<div class="alert" id="alert_time_learn">Thời gian học phải lớn hơn 0</div>');
            setTimeout(function() {
                $("#alert_teach2").fadeOut(1000, function() {
                    $("#alert_teach2").remove();
                });
            }, 2000);
            $('#time_learn').focus();
            return false;
        }else{
            form_data.append('time_learn', Number($("#time_learn").val()));
        }

        if ($("#course_slide").val() == "") {
            $("#v_alert").append('<div class="alert" id="alert_slide">Tài liệu học không được để trống</div>');
            setTimeout(function() {
                $("#alert_slide").fadeOut(1000, function() {
                    $("#alert_slide").remove();
                });
            }, 2000);
            $('#course_slide').focus();
            return false;
        } else if (Number($("#course_slide").val()) == 0) {
            $("#v_alert").append('<div class="alert" id="alert_slide">Tài liệu học phải lớn hơn 0</div>');
            setTimeout(function() {
                $("#alert_slide").fadeOut(1000, function() {
                    $("#alert_slide").remove();
                });
            }, 2000);
            $('#course_slide').focus();
            return false;
        } else {
            form_data.append('course_slide', Number($("#course_slide").val()));
        }

        if ($("#price_listed").val() == "") {
            $("#v_alert").append('<div class="alert" id="alert_prices_listed">Giá gốc không được để trống</div>');
            setTimeout(function() {
                $("#alert_prices_listed").fadeOut(1000, function() {
                    $("#alert_prices_listed").remove();
                });
            }, 2000);
            $('#price_listed').focus();
            return false;
        } else {
            form_data.append('price_listed', Number($("#price_listed").val()));
        }

        if ($("#price_promotional").val() != "") {
            if (Number($("#price_promotional").val()) > Number($("#price_listed").val())) {
                $("#v_alert").append(
                    '<div class="alert" id="alert_price_promotional">Giá khuyển mại không được lớn hơn hoặc bằng giá gốc</div>');
                setTimeout(function() {
                    $("#alert_price_promotional").fadeOut(1000, function() {
                        $("#alert_price_promotional").remove();
                    });
                }, 2000);
                $('#price_promotional').focus();
                return false;
            } else {
                form_data.append('price_promotional', Number($("#price_promotional").val()));
            }
        }

        if ($("#quantity_std").val() != "") {
            if (Number($("#quantity_std").val()) < 2) {
                $("#v_alert").append(
                    '<div class="alert" id="alert_quantity_std">Số lượng học viên mua chung phải lớn hơn 1</div>'
                    );
                $("#quantity_std").focus();
                setTimeout(function() {
                    $("#alert_quantity_std").fadeOut(1000, function() {
                        $("#alert_quantity_std").remove();
                    });
                }, 2000);
                return false;
            }else if ($("#price_discount").val() == "") {
                $("#v_alert").append(
                    '<div class="alert" id="alert_price_discount">Giá mua chung không được để trống</div>');
                setTimeout(function() {
                    $("#alert_price_discount").fadeOut(1000, function() {
                        $("#alert_price_discount").remove();
                    });
                }, 2000);
                $('#price_discount').focus();
                return false;
            }else{
                form_data.append('quantity_std', Number($("#quantity_std").val()));
                form_data.append('price_discount', Number($("#price_discount").val()));
            }
        }else{
            if ($("#price_discount").val() != "") {
                $("#v_alert").append(
                    '<div class="alert" id="alert_price_discount">Bạn chưa nhập số lượng học viên mua chung</div>');
                setTimeout(function() {
                    $("#alert_price_discount").fadeOut(1000, function() {
                        $("#alert_price_discount").remove();
                    });
                }, 2000);
                $('#quantity_std').focus();
                return false;
            }
        }

        if (document.v_create_center.level_id.value == "") {
            $("#v_alert").append('<div class="alert" id="alert_level">Vui lòng chọn trình độ</div>');
            setTimeout(function() {
                $("#alert_level").fadeOut(1000, function() {
                    $("#alert_level").remove();
                });
            }, 2000);
            $('.level_id').focus();
            return false;
        } else {
            form_data.append('level_id', document.v_create_center.level_id.value);
        }

        if ($("#month_study").val() == "") {
            $("#v_alert").append('<div class="alert" id="alert_month_study">Vui lòng điền thời gian học</div>');
            setTimeout(function() {
                $("#alert_month_study").fadeOut(1000, function() {
                    $("#alert_month_study").remove();
                });
            }, 2000);
            $('#month_study').focus();
            return false;
        }else if (Number($("#month_study").val()) == 0) {
            $("#v_alert").append('<div class="alert" id="alert_month_study">Thời gian học tối thiểu là 1 tháng</div>');
            setTimeout(function() {
                $("#alert_month_study").fadeOut(1000, function() {
                    $("#alert_month_study").remove();
                });
            }, 2000);
            $('#month_study').focus();
            return false;
        }else{
            form_data.append('month_study', Number($("#month_study").val()));
        }

        if ($("#cit_id").val() == 0) {
            $("#v_alert").append('<div class="alert" id="alert_city">Vui lòng nhập tỉnh, thành phố</div>');
            setTimeout(function() {
                $("#alert_city").fadeOut(1000, function() {
                    $("#alert_city").remove();
                });
            }, 2000);
            $('#cit_id').focus();
            return false;
        }else{
            form_data.append('cit_id', $("#cit_id").val());
        }

        if ($("#district_id").val() == 0) {
            $("#v_alert").append('<div class="alert" id="alert_district">Vui lòng nhập quận, huyện</div>');
            setTimeout(function() {
                $("#alert_district").fadeOut(1000, function() {
                    $("#alert_district").remove();
                });
            }, 2000);
            $('#cit_id').focus();
            return false;
        }else{
            form_data.append('district_id', $("#district_id").val());
        }

        if ($("#course_address").val() == "") {
            $("#v_alert").append('<div class="alert" id="alert_course_address">Vui lòng nhập địa chỉ chi tiết</div>');
            setTimeout(function() {
                $("#alert_course_address").fadeOut(1000, function() {
                    $("#alert_course_address").remove();
                });
            }, 2000);
            $('#course_address').focus();
            return false;
        }else{
            form_data.append('course_address', $("#course_address").val());
        }

        form_data.append('course_id',<?php echo $course_id; ?>);
        form_data.append('tag_id', $("#tag_id").val());
        form_data.append('submit',1);
        $("#login_btn").css('display', 'none');
        $("#singup_img").css('display', 'block');
        $("#btnnext")[0].type = 'button';
        $.ajax({
            url: '../code_xu_ly/h_update_class_teacher.php',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: form_data,
            success: function (data) {
                $("#login_btn").css('display', 'block');
                $("#singup_img").css('display', 'none');
                if (data.type == 0) {
                    $("#v_alert").append('<div class="alert" id="alert_24_course">Tên khóa học đã tồn tại</div>');
                    setTimeout(function() {
                        $("#alert_24_course").fadeOut(1000, function() {
                            $("#alert_24_course").remove();
                        });
                    }, 2000);
                    $("#btnnext")[0].type = 'submit';
                }else if (data.type == 1) {
                    $("#v_alert").append('<div class="success" id="alert_24_course">Cập nhật khóa học thành công</div>');
                    setTimeout(function() {
                        $("#alert_24_course").fadeOut(1000, function() {
                            $("#alert_24_course").remove();
                        });
                    }, 2000);
                    window.location.href = "/giang-vien-khoa-hoc-offline/id"+data.user_id+"-p1.html";
                }
            },
            error: function () {
                alert("Có lỗi xảy ra. Vui lòng thử lại");
                $("#login_btn").css('display', 'block');
                $("#singup_img").css('display', 'none');
                $("#btnnext")[0].type = 'submit';
            }
        });
        
        return false;
    }
    </script>
</body>

</html>