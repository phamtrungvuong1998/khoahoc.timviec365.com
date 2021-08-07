<?
require_once '../code_xu_ly/h_home.php';
// require_once '../code_xu_ly/h_create_class_center.php';
if ($_COOKIE['user_type'] != 3 || !isset($_COOKIE['user_id'])) {
    header("Location: /");
} else {
    $user_id = $_COOKIE['user_id'];
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
    <link rel="stylesheet" href="../css/h_postclasson.css?v=<?=$version?>">
    <style>
    [id*=v_course_online-] {
        color: red;
    }
    .certification2{
        width: 50%;
    }
    #btnpost_img,
    #btnnext_img {
        display: none;
        width: 16px;
        height: 16px;
        margin: 0 auto;
    }
    .container_detail{
        padding-right: 0 !important;
    }
    #btnpost_span,
    #btnnext_span {
        font-size: 16px;
        color: white;
    }
    .post33 .form-group{
        flex-basis: 30%;
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
                <div id="v_alert"></div>
                <ol>
                    <li><a href="/">Trang chủ</a></li>
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
                    <h3 id="v_course-label-1">Thông tin khóa học</h3>
                    <div class="post-course1">
                        <form method="POST" enctype="multipart/form-data" name="v_couse_online"
                            onsubmit="return course_online_onsubmit();">
                            <div class="post1">
                                <div class="post11">
                                    <div class="form-group">
                                        <label id="v_course-label-2">Tên khóa học</label>
                                        <input type="text" id="course_name" name="course_name"
                                            placeholder="VD : Thành thạo tiếng anh trong 30 ngày ">
                                        <p id="v_course_online-1"></p>
                                    </div>
                                    <div class="form-group">
                                        <label id="v_course-label-4">Mô tả thêm</label>
                                        <input type="text" id="course_describe" name="course_describe"
                                            placeholder="VD : Trọn bộ kỹ năng tiếng anh giao tiếp cơ bản ">
                                    </div>
                                    <p id="v_course_online-2"></p>
                                </div>
                                <div class="post12">
                                    <img id="avatar" src="../img/image/white.svg">
                                    <!-- <div class="postimg camera-img">
                                        <img class="" src="../img/image/addimg.svg">
                                        <span>Ảnh khóa học</span>
                                        <input type="file" class="hidden" id="img" onchange="changeImg(this)"
                                            accept=".png, .jpg, .jpeg">
                                        </div> -->
                                    <button type="button" class="postimg camera-img"><img
                                            src=" ../img/image/addimg.svg">Ảnh khóa học</button>
                                    <input type="file" name="course_avatar" class="hidden" id="img"
                                        onchange="changeImg(this)" accept=".png, .jpg, .jpeg">
                                    <p id="v_course_online-3"></p>
                                </div>
                            </div>
                            <div class="post2">
                                <div class="form-group">
                                    <label>Môn học</label>
                                    <select class="cate2" name="cate_id" id="cate_id">
                                        <option value="0">Chọn Môn học</option>
                                        <?php
                                        $qrCate = new db_query("SELECT * FROM categories");
                                        while ($rowCate = mysql_fetch_array($qrCate->result)) {
                                        ?>
                                        <option class="catet2db" value="<?php echo $rowCate['cate_id']; ?>">
                                            <?php echo $rowCate['cate_name']; ?></option>

                                        <?php } ?>
                                    </select>
                                    <p id="v_course_online-4"></p>
                                </div>
                                <div class="form-group">
                                    <label>Môn học chi tiết</label>
                                    <select class="tag2" id="tag2" name="tag_id">
                                        <option>Chọn Môn học chi tiết</option>
                                        <option class="tag2db"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group onlinegv">
                                <label>Giảng viên giảng dạy</label>
                                <select class="teach2" id="teach2" onchange="teach_2()" name="center_teacher">
                                    <option value="0">Lựa chọn giảng viên dạy</option>
                                    <?php
                                    $qrGV = new db_query("SELECT * FROM user_center_teacher WHERE user_id = $user_id");
                                    while ($rowGV = mysql_fetch_array($qrGV->result)) {
                                    ?>
                                    <option class="teach2db" value="<?php echo $rowGV['center_teacher_id']; ?>">
                                        <?php echo $rowGV['teacher_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <p id="v_course_online-5"></p>
                                <div class="first4" id="first4">
                                    <span>( Nếu chưa có giảng viên, ấn vào đây để thêm )</span>
                                    <a data-toggle="modal" data-target="#addteacher"><img
                                            src="../img/image/add1.svg">Thêm giảng viên</a>
                                </div>
                            </div>
                            <div class="post3" id="v_course-label-5">
                                <div class="form-group">
                                    <label>Lợi ích khóa học <img src="../img/image/question1.svg"></label>
                                    <textarea name="course_benefit" id="course_benefit"></textarea>
                                </div>
                                <p id="v_course_online-6"></p>
                            </div>
                            <div class="post3" id="v_course-label-6">
                                <div class="form-group">
                                    <label>Phù hợp với ai<img src="../img/image/question1.svg"></label>
                                    <textarea name="course_match" id="course_match"></textarea>
                                </div>
                                <p id="v_course_online-7"></p>
                            </div>
                            <div class="post3" id="v_course-label-7">
                                <div class="form-group">
                                    <label>Yêu cầu khóa học<img src="../img/image/question1.svg"></label>
                                    <textarea name="course_request" id="course_request"></textarea>
                                </div>
                                <p id="v_course_online-8"></p>
                            </div>
                            <div class="post3" id="v_course-label-8">
                                <div class="form-group">
                                    <label>Mô tả tổng quát <img src="../img/image/question1.svg"></label>
                                    <textarea name="general_describe" id="general_describe"></textarea>
                                </div>
                                <p id="v_course_online-9"></p>
                            </div>
                            <div class="post3 certification">
                                <div class="form-group">
                                    <label>Cấp chứng chỉ <img src="../img/image/question1.svg"></label>
                                    <div class="certification2">
                                        <div class="form-group">
                                            <input name="certification" value="1" type="radio"><label>Có</label>
                                        </div>
                                        <div class="form-group">
                                            <input name="certification" value="2" type="radio"><label>Không</label>
                                        </div>
                                    </div>
                                </div>
                                <p id="v_course_online-10"></p>
                            </div>
                            <div class="post3 postlv">
                                <hr>
                                <h3>Trình độ</h3>
                                <div class="second2">
                                    <?
                                    $db_lv = new db_query("SELECT * FROM `levels`");
                                    while ($row = mysql_fetch_array($db_lv->result)) {
                                    ?>
                                    <div class="form-group">
                                        <input type="radio" id="level" value="<?= $row['level_id'] ?>" name="level_id">
                                        <label><?= $row['level_name'] ?></label>
                                    </div>
                                    <?
                                    }
                                    ?>
                                </div>
                                <p id="v_course_online-11"></p>
                            </div>
                            <div class="post3 post33">
                                <label>Ưu điểm trung tâm</label>
                                <?
                                $db_adv = new db_query("SELECT * FROM advantages_center WHERE advantages_type = 0");
                                while ($row = mysql_fetch_array($db_adv->result)) {
                                ?>
                                <div class="form-group">
                                    <input type="checkbox" value="<?= $row['advantages_id'] ?>" class="advantages_id"
                                        name="advantages_id[]" id="advantages_id<?php echo $row['advantages_id'] ?>">
                                    <label><?= $row['advantages_name'] ?></label>
                                </div>
                                <?php
                                }
                                ?>
                                <!-- <div class="form-group">
                                    <input id="addtienich" name="addtienich" type="text"
                                        placeholder="Nhập thêm tiện ích khác">
                                </div> -->
                            </div>
                            <div class="post4">
                                <button name="btn_online" id="btnpost"><img src="../img/Spinner-1s-200px.gif" id="btnpost_img" alt=""><span id="btnpost_span">LƯU LẠI</span></button>
                                <button name="btn_next" type="button" id="btnnext" value="1"><img
                                        src="../img/Spinner-1s-200px.gif" id="btnnext_img" alt=""><span
                                        id="btnnext_span">TIẾP TỤC</span></button>
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
</body>
<script type="text/javascript">
function teach_2() {
    if (document.getElementById('teach2').value == 0) {
        document.getElementById('first4').style.display = "block";
    } else {
        document.getElementById('first4').style.display = "none";
    }
}

function changeSlug(text) {
    text = text.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    text = text.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    text = text.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    text = text.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    text = text.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    text = text.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    text = text.replace(/(đ)/g, 'd');
    text = text.replace(/( )/g, '');
    text = text.toLowerCase();
    return text;
}

function course_online_onsubmit() {
    var reName = /^[a-zA-Z0-9]{1,}$/;
    var form_data = new FormData();
    if ($("#course_name").val().trim() == "") {
        $("#v_alert").append('<div class="alert" id="alert_course_name">Tên khóa học không được để trống</div>');
        $("#course_name").focus();
        setTimeout(function() {
            $("#alert_course_name").fadeOut(1000, function() {
                $("#alert_course_name").remove();
            })
        }, 2000);
        return false;
    } else if (reName.test(changeSlug($("#course_name").val())) == false) {
        $("#v_alert").append(
            '<div class="alert" id="alert_course_name">Tên khóa học không được chứa kí tự đặc biệt</div>');
        $("#course_name").focus();
        setTimeout(function() {
            $("#alert_course_name").fadeOut(1000, function() {
                $("#alert_course_name").remove();
            })
        }, 2000);
        return false;
    } else if ($("#course_name").val().length > 120) {
        $("#v_alert").append(
            '<div class="alert" id="alert_course_name">Tên khóa học không được lớn hơn 120 kí tự</div>');
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

    if ($("#course_describe").val() == "") {
        $("#v_alert").append('<div class="alert" id="alert_course_describe">Mô tả thêm không được để trống</div>');
        $("#course_describe").focus();
        setTimeout(function() {
            $("#alert_course_describe").fadeOut(1000, function() {
                $("#alert_course_describe").remove();
            })
        }, 2000);
        return false;
    } else {
        form_data.append('course_describe', $("#course_describe").val());
    }

    if ($("#img").prop('files')[0] == undefined) {
        $("#v_alert").append('<div class="alert" id="alert_img">Vui lòng chọn ảnh</div>');
        $("#img").show();
        $("#img").focus();
        $("#img").hide();
        setTimeout(function() {
            $("#alert_img").fadeOut(1000, function() {
                $("#alert_img").remove();
            })
        }, 2000);
        return false;
    } else if ($("#img").prop('files')[0] != undefined) {
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
        }else if($('#img').prop('files')[0].size > 204800){
            $("#v_alert").append('<div class="alert" id="alert_img">Vui lòng chọn dung lượng ảnh dưới 200KB</div>');
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

    if ($("#cate_id").val() == 0) {
        $("#v_alert").append('<div class="alert" id="alert_cate_id">Vui lòng chọn môn học giảng dạy</div>');
        $("#cate_id").focus();
        setTimeout(function() {
            $("#alert_cate_id").fadeOut(1000, function() {
                $("#alert_cate_id").remove();
            })
        }, 2000);
        return false;
    } else {
        form_data.append('cate_id', $("#cate_id").val());
    }

    if ($("#teach2").val() == 0) {
        $("#v_alert").append('<div class="alert" id="alert_teach2">Vui lòng chọn giảng viên giảng dạy</div>');
        $("#teach2").focus();
        setTimeout(function() {
            $("#alert_teach2").fadeOut(1000, function() {
                $("#alert_teach2").remove();
            })
        }, 2000);
        return false;
    } else {
        form_data.append('teach', $("#teach2").val());
    }

    if ($("#course_benefit").val() == "") {
        $("#v_alert").append('<div class="alert" id="alert_course_benefit">Lợi ích khóa học không được để trống</div>');
        $("#course_benefit").focus();
        setTimeout(function() {
            $("#alert_course_benefit").fadeOut(1000, function() {
                $("#alert_course_benefit").remove();
            })
        }, 2000);
        return false;
    } else {
        form_data.append('course_benefit', $("#course_benefit").val());
    }

    if ($("#course_match").val() == "") {
        $("#v_alert").append('<div class="alert" id="alert_course_match">Phù hợp với ai không được để trống</div>');
        $("#course_match").focus();
        setTimeout(function() {
            $("#alert_course_match").fadeOut(1000, function() {
                $("#alert_course_match").remove();
            })
        }, 2000);
        return false;
    } else {
        form_data.append('course_match', $("#course_match").val());
    }

    if ($("#course_request").val() == "") {
        $("#v_alert").append('<div class="alert" id="alert_course_request">Yêu cầu khóa học không được để trống</div>');
        $("#course_request").focus();
        setTimeout(function() {
            $("#alert_course_request").fadeOut(1000, function() {
                $("#alert_course_request").remove();
            })
        }, 2000);
        return false;
    } else {
        form_data.append('course_request', $("#course_request").val());
    }

    if ($("#general_describe").val() == "") {
        $("#v_alert").append(
            '<div class="alert" id="alert_general_describe">Mô tả tổng quát không được để trống</div>');
        $("#general_describe").focus();
        setTimeout(function() {
            $("#alert_general_describe").fadeOut(1000, function() {
                $("#alert_general_describe").remove();
            })
        }, 2000);
        return false;
    } else {
        form_data.append('general_describe', $("#general_describe").val());
    }

    if (document.v_couse_online.certification.value != 1 && document.v_couse_online.certification.value != 2) {
        $("#v_alert").append('<div class="alert" id="alert_certification">Vui lòng chọn cấp chứng chỉ</div>');
        $("#certification").focus();
        setTimeout(function() {
            $("#alert_certification").fadeOut(1000, function() {
                $("#alert_certification").remove();
            })
        }, 2000);
        return false;
    } else {
        form_data.append('certification', document.v_couse_online.certification.value);
    }

    if (document.v_couse_online.level_id.value == "") {
        $("#v_alert").append('<div class="alert" id="alert_level_id">Vui lòng chọn trình độ</div>');
        $("#level").focus();
        setTimeout(function() {
            $("#alert_level_id").fadeOut(1000, function() {
                $("#alert_level_id").remove();
            })
        }, 2000);
        return false;
    } else {
        form_data.append('level', document.v_couse_online.level_id.value);
    }

    form_data.append('tag_id', $("#tag2").val());

    var arr_advantages = [];
    for (var i = 0; i < $(".advantages_id").length; i++) {
        if ($(".advantages_id")[i].checked == true) {
            arr_advantages.push($(".advantages_id")[i].value);
        }
    }
    form_data.append('advantages_id', arr_advantages);
    form_data.append('submit', 2);
    $("#btnpost_img").css("display", "block");
    $("#btnpost_span").css("display", "none");
    $("#btnpost")[0].type = 'button';
    $("#btnpost").val(0);
    $.ajax({
        url: '../code_xu_ly/v_create_course.php',
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        data: form_data,
        success: function(data) {
            if (data.type == 0) {
                $("#v_alert").append(
                    '<div class="alert" id="alert_course_name">Tên khóa học đã tồn tại</div>');
                $("#course_name").focus();
                setTimeout(function() {
                    $("#alert_course_name").fadeOut(1000, function() {
                        $("#alert_course_name").remove();
                    })
                }, 2000);
            } else if (data.type == 1) {
                $("#v_alert").append('<div class="success" id="success">Tạo khóa học thành công</div>');
                setTimeout(function() {
                    $("#success").fadeOut(1000, function() {
                        $("#success").remove();
                    });
                }, 2000);
                window.location.href = '/trung-tam-khoa-hoc-online-giang-day/id' + data.user_id +
                    '&page1.html';
            } else if (data.type == -1) {
                $("#v_alert").append(
                    '<div class="alert" id="success">Vui lòng tạo thêm khóa học sau 20 phút nữa</div>'
                );
                setTimeout(function() {
                    $("#success").fadeOut(1000, function() {
                        $("#success").remove();
                    });
                }, 2000);
            } else if (data.type == -2) {
                $("#v_alert").append(
                    '<div class="alert" id="success">Bạn chỉ được tạo tối đa 24 khóa học trong 1 ngày</div>'
                );
                setTimeout(function() {
                    $("#success").fadeOut(1000, function() {
                        $("#success").remove();
                    });
                }, 2000);
            }

            $("#btnpost_img").css("display", "none");
            $("#btnpost_span").css("display", "block");
            $("#btnpost")[0].type = 'submit';
            $("#btnpost").val(1);
        },
        error: function() {
            alert("Có lỗi xảy ra. Vui lòng thử lại");
            $("#btnpost_img").css("display", "none");
            $("#btnpost_span").css("display", "block");
            $("#btnpost")[0].type = 'submit';
            $("#btnnext").val(1);
        }
    });

    return false;
}

$("#btnnext").click(function() {
    if ($("#btnnext").val() == 1) {
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
        } else {
            form_data.append('course_name', $("#course_name").val());
        }

        if ($("#course_describe").val() == "") {
            $("#v_alert").append(
                '<div class="alert" id="alert_course_describe">Mô tả thêm không được để trống</div>');
            $("#course_describe").focus();
            setTimeout(function() {
                $("#alert_course_describe").fadeOut(1000, function() {
                    $("#alert_course_describe").remove();
                })
            }, 2000);
            return false;
        } else {
            form_data.append('course_describe', $("#course_describe").val());
        }

        if ($("#img").prop('files')[0] == undefined) {
            $("#v_alert").append('<div class="alert" id="alert_img">Vui lòng chọn ảnh</div>');
            $("#img").show();
            $("#img").focus();
            $("#img").hide();
            setTimeout(function() {
                $("#alert_img").fadeOut(1000, function() {
                    $("#alert_img").remove();
                })
            }, 2000);
            return false;
        } else if ($("#img").prop('files')[0] != undefined) {
            var match = ["image/jpeg", "image/JPEG", "image/png", "image/PNG", "image/jpg", "image/JPG"];
            var j = 0;
            for (var i = 0; i < match.length; i++) {
                if ($('#img').prop('files')[0].type != match[i]) {
                    j++;
                }
            }
            if (j == 6) {
                $("#v_alert").append(
                '<div class="alert" id="alert_img">Vui lòng chọn đúng định dạng ảnh</div>');
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

        if ($("#cate_id").val() == 0) {
            $("#v_alert").append('<div class="alert" id="alert_cate_id">Vui lòng chọn môn học giảng dạy</div>');
            $("#cate_id").focus();
            setTimeout(function() {
                $("#alert_cate_id").fadeOut(1000, function() {
                    $("#alert_cate_id").remove();
                })
            }, 2000);
            return false;
        } else {
            form_data.append('cate_id', $("#cate_id").val());
        }

        if ($("#teach2").val() == 0) {
            $("#v_alert").append(
                '<div class="alert" id="alert_teach2">Vui lòng chọn giảng viên giảng dạy</div>');
            $("#teach2").focus();
            setTimeout(function() {
                $("#alert_teach2").fadeOut(1000, function() {
                    $("#alert_teach2").remove();
                })
            }, 2000);
            return false;
        } else {
            form_data.append('teach', $("#teach2").val());
        }

        if ($("#course_benefit").val() == "") {
            $("#v_alert").append(
                '<div class="alert" id="alert_course_benefit">Lợi ích khóa học không được để trống</div>');
            $("#course_benefit").focus();
            setTimeout(function() {
                $("#alert_course_benefit").fadeOut(1000, function() {
                    $("#alert_course_benefit").remove();
                })
            }, 2000);
            return false;
        } else {
            form_data.append('course_benefit', $("#course_benefit").val());
        }

        if ($("#course_match").val() == "") {
            $("#v_alert").append(
                '<div class="alert" id="alert_course_match">Phù hợp với ai không được để trống</div>');
            $("#course_match").focus();
            setTimeout(function() {
                $("#alert_course_match").fadeOut(1000, function() {
                    $("#alert_course_match").remove();
                })
            }, 2000);
            return false;
        } else {
            form_data.append('course_match', $("#course_match").val());
        }

        if ($("#course_request").val() == "") {
            $("#v_alert").append(
                '<div class="alert" id="alert_course_request">Yêu cầu khóa học không được để trống</div>');
            $("#course_request").focus();
            setTimeout(function() {
                $("#alert_course_request").fadeOut(1000, function() {
                    $("#alert_course_request").remove();
                })
            }, 2000);
            return false;
        } else {
            form_data.append('course_request', $("#course_request").val());
        }

        if ($("#general_describe").val() == "") {
            $("#v_alert").append(
                '<div class="alert" id="alert_general_describe">Mô tả tổng quát không được để trống</div>');
            $("#general_describe").focus();
            setTimeout(function() {
                $("#alert_general_describe").fadeOut(1000, function() {
                    $("#alert_general_describe").remove();
                })
            }, 2000);
            return false;
        } else {
            form_data.append('general_describe', $("#general_describe").val());
        }

        if (document.v_couse_online.certification.value != 1 && document.v_couse_online.certification.value !=
            2) {
            $("#v_alert").append(
                '<div class="alert" id="alert_certification">Vui lòng chọn cấp chứng chỉ</div>');
            $("#certification").focus();
            setTimeout(function() {
                $("#alert_certification").fadeOut(1000, function() {
                    $("#alert_certification").remove();
                })
            }, 2000);
            return false;
        } else {
            form_data.append('certification', document.v_couse_online.certification.value);
        }

        if (document.v_couse_online.level_id.value == "") {
            $("#v_alert").append('<div class="alert" id="alert_level_id">Vui lòng chọn trình độ</div>');
            $("#level").focus();
            setTimeout(function() {
                $("#alert_level_id").fadeOut(1000, function() {
                    $("#alert_level_id").remove();
                })
            }, 2000);
            return false;
        } else {
            form_data.append('level', document.v_couse_online.level_id.value);
        }

        form_data.append('tag_id', $("#tag2").val());

        var arr_advantages = [];
        for (var i = 0; i < $(".advantages_id").length; i++) {
            if ($(".advantages_id")[i].checked == true) {
                arr_advantages.push($(".advantages_id")[i].value);
            }
        }
        form_data.append('advantages_id', arr_advantages);
        form_data.append('submit', 3);
        $("#btnnext_span").css("display", "none");
        $("#btnnext_img").css("display", "block");
        $("#btnpost")[0].type = 'button';
        $("#btnnext").val(0);
        $.ajax({
            url: '../code_xu_ly/v_create_course.php',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type == 0) {
                    $("#v_alert").append(
                        '<div class="alert" id="alert_course_name">Tên khóa học đã tồn tại</div>'
                        );
                    $("#course_name").focus();
                    setTimeout(function() {
                        $("#alert_course_name").fadeOut(1000, function() {
                            $("#alert_course_name").remove();
                        })
                    }, 2000);
                } else if (data.type == 1) {
                    window.location.href = '/tao-khoa-hoc-online-next/id' + data.user_id + '.html';
                } else if (data.type == -1) {
                    $("#v_alert").append(
                        '<div class="alert" id="success">Vui lòng tạo thêm khóa học sau 20 phút nữa</div>'
                    );
                    setTimeout(function() {
                        $("#success").fadeOut(1000, function() {
                            $("#success").remove();
                        });
                    }, 2000);
                } else if (data.type == -2) {
                    $("#v_alert").append(
                        '<div class="alert" id="success">Bạn chỉ được tạo tối đa 24 khóa học trong 1 ngày</div>'
                    );
                    setTimeout(function() {
                        $("#success").fadeOut(1000, function() {
                            $("#success").remove();
                        });
                    }, 2000);
                }
                $("#btnnext_span").css("display", "block");
                $("#btnnext_img").css("display", "none");
                $("#btnpost")[0].type = 'submit';
                $("#btnnext").val(1);
            },
            error: function() {
                alert("Có lỗi xảy ra. Vui lòng thử lại");
                $("#btnnext_span").css("display", "block");
                $("#btnnext_img").css("display", "none");
                $("#btnpost")[0].type = 'submit';
                $("#btnnext").val(1);
            }
        });

        return false;
    }
});
</script>

</html>