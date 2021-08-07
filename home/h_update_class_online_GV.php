<?php
require_once '../code_xu_ly/h_home.php';

if(!isset($_COOKIE['user_id']) ||$_COOKIE['user_type'] != 2){
    header('location:/');
}
$course_id = getValue('course_id','int','GET','0');
$dbon = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id WHERE courses.course_id = $course_id");
$rowon = mysql_fetch_array($dbon->result);
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
    <link rel="stylesheet" href="../css/h_postclasson.css?v=<?=$version?>">
    <style>
        #btnpost_img,
        #btnnext_img{
            display: none;
            width: 25px;
        }

        .success{
            background-color: #dff0d8;
            color: #3c763d;
        }
        .container_gv{
            padding-left: 20%;
        }
        .container_detail{
            padding-right: 0 !important;
        }
        @media(max-width: 767px){
            .container_gv{
                padding-left: 2%;
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
            <div id="v_alert"></div>
            <div class="container container_gv">
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
                    <h3>Thông tin khóa học</h3>
                    <div class="post-course1">
                        <form method="POST" name="v_create_center" enctype="multipart/form-data" onsubmit="return validation()">
                            <div class="post1">
                                <div class="post11">
                                    <div class="form-group">
                                        <label>Tên khóa học</label>
                                        <input type="text" name="course_name" id="course_name"
                                            value="<?=$rowon['course_name']?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả thêm</label>
                                        <input type="text" id="course_describe"
                                            value="<?=$rowon['course_describe']?>">
                                    </div>
                                </div>
                                <div class="post12">
                                    <img id="avatar" src="../img/course/<?=$rowon['course_avatar']?>"
                                        onerror='this.onerror=null;this.src="../img/image/white.svg";'>
                                    <!-- <div class="postimg camera-img">
                                        <img class="" src="../img/image/addimg.svg">
                                        <span>Ảnh khóa học</span>
                                        <input type="file" class="hidden" id="img" onchange="changeImg(this)"
                                            accept=".png, .jpg, .jpeg">
                                    </div> -->
                                    <button type="button" class="postimg camera-img"><img
                                            src=" ../img/image/addimg.svg">Ảnh
                                        khóa học</button>
                                    <input type="file" class="hidden" id="img" onchange="changeImg(this)"
                                        name="course_avatar">
                                </div>
                            </div>
                            <div class="post2">
                                <div class="form-group">
                                    <label>Môn học</label>
                                    <select class="cate2" id="cate_id" name="cate_id">
                                        <option value="0">Chọn Môn học</option>
                                        <?
                                            $db_cate = new db_query("SELECT * FROM categories");
                                            while ($row = mysql_fetch_array($db_cate->result)) {
                                                ?>
                                        <option <?php if($rowon['cate_id'] == $row['cate_id']) echo 'selected'; ?>
                                            class="catet2db" value="<?=$row['cate_id']?>"><?=$row['cate_name']?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label>Môn học chi tiết</label>
                                    <select class="tag2" name="tag_id" id="tag_id">
                                        <option value="0">Chọn môn học chi tiết</option>
                                        <?
                                            if($rowon['tag_id'] != 0){
                                            $db_tag = new db_query("SELECT * FROM tags");
                                            while ($row = mysql_fetch_array($db_tag->result)) {
                                                ?>
                                        <option <?php if ($rowon['tag_id'] == $row['tag_id']) {
                                                    echo 'selected';
                                                } ?> class="tag2db" value="<?=$row['tag_id']?>"><?=$row['tag_name']?>
                                        </option>
                                        <?php
                                            }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="post3">
                                <div class="form-group">
                                    <label>Lợi ích khóa học <img src="../img/image/question1.svg"></label>
                                    <textarea name="course_benefit"
                                        id="course_benefit"><?=$rowon['course_benefit']?></textarea>
                                </div>
                            </div>
                            <div class="post3">
                                <div class="form-group">
                                    <label>Phù hợp với ai<img src="../img/image/question1.svg"></label>
                                    <textarea name="course_match"
                                        id="course_match"><?=$rowon['course_match']?></textarea>
                                </div>
                            </div>
                            <div class="post3">
                                <div class="form-group">
                                    <label>Yêu cầu khóa học<img src="../img/image/question1.svg"></label>
                                    <textarea name="course_request"
                                        id="course_request"><?=$rowon['course_request']?></textarea>
                                </div>
                            </div>
                            <div class="post3">
                                <div class="form-group">
                                    <label>Mô tả tổng quát <img src="../img/image/question1.svg"></label>
                                    <textarea name="general_describe"
                                        id="general_describe"><?=$rowon['general_describe']?></textarea>
                                </div>
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
                                        <input <?php if($rowon['level_id'] == $row['level_id']) echo 'checked';  ?>
                                            type="radio" value="<?=$row['level_id']?>" name="level_id">
                                        <label><?=$row['level_name']?></label>
                                    </div>
                                    <?
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="post4">
                                <button name="btn_online" id="btnpost"><img src="../img/Spinner-1s-200px.gif" id="btnpost_img" alt=""><span id="btnpost_span">LƯU LẠI</span></button>
                                <button name="btn_next" id="btnnext" value="1" type="button"><img
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
    <script>
    function validation() {
        var reName = /^[a-zA-Z0-9]{1,}$/;
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
        }else{
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
        }else{
            form_data.append('cate_id', $("#cate_id").val());
        }

        if ($("#img").prop('files')[0] != undefined) {
            if ($("#img").prop('files')[0].size > 204800) {
                $("#v_alert").append(
                    '<div class="alert" id="alert_img">Vui lòng chọn kích thước ảnh dưới 200KB</div>');
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
                '<div class="alert" id="alert_description">Mô tả thêm không được để trống</div>');
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

        if ($("#course_benefit").val() == "") {
            $("#v_alert").append(
                '<div class="alert" id="alert_get_what">Lợi ích không được để trống</div>');
            setTimeout(function() {
                $("#alert_get_what").fadeOut(1000, function() {
                    $("#alert_get_what").remove();
                });
            }, 2000);
            $('#course_benefit').focus();
            return false;
        }else{
            form_data.append('course_benefit', $("#course_benefit").val());
        }

        if ($("#course_match").val() == "") {
            $("#v_alert").append(
                '<div class="alert" id="alert_object">Phù hợp với ai không đươc để trống</div>');
            setTimeout(function() {
                $("#alert_object").fadeOut(1000, function() {
                    $("#alert_object").remove();
                });
            }, 2000);
            $('#course_match').focus();
            return false;
        }else{
            form_data.append('course_match', $("#course_match").val());
        }

        if ($("#course_request").val() == "") {
            $("#v_alert").append(
                '<div class="alert" id="alert_get_what">Yêu cầu không được để trống</div>');
            setTimeout(function() {
                $("#alert_get_what").fadeOut(1000, function() {
                    $("#alert_get_what").remove();
                });
            }, 2000);
            $('#course_request').focus();
            return false;
        }else{
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
        }else{
            form_data.append('general_describe', $("#general_describe").val());
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

        form_data.append('tag_id',$("#tag_id").val());
        form_data.append('course_id',<?php echo $course_id; ?>);
        form_data.append('submit',2);
        $("#btnpost_img").css('display', 'block');
        $("#btnpost_span").css('display', 'none');
        $("#btnpost")[0].type = 'button';
        $("#btnnext").val(0);
        $.ajax({
            url: '../code_xu_ly/h_update_class_teacher.php',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: form_data,
            success: function (data) {
                $("#btnpost_img").css('display', 'block');
                $("#btnpost_span").css('display', 'none');
                if (data.type == 0) {
                    $("#v_alert").append('<div class="alert" id="alert_24_course">Tên khóa học đã tồn tại</div>');
                    setTimeout(function() {
                        $("#alert_24_course").fadeOut(1000, function() {
                            $("#alert_24_course").remove();
                        });
                    }, 2000);
                    $("#btnpost")[0].type = 'submit';
                    $("#btnnext").val(1);
                }else if (data.type == 1) {
                    $("#v_alert").append('<div class="success" id="alert_24_course">Cập nhật học thành công</div>');
                    setTimeout(function() {
                        $("#alert_24_course").fadeOut(1000, function() {
                            $("#alert_24_course").remove();
                        });
                    }, 2000);
                    window.location.href = "/giang-vien-khoa-hoc-online/id"+data.user_id+"-p1.html";
                }
            }
        });
        
        return false;
    }

    $("#btnnext").click(function() {
        if ($("#btnnext").val() == 1) {
            var reName = /^[a-zA-Z0-9]{1,}$/;
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
            }else{
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
            }else{
                form_data.append('cate_id', $("#cate_id").val());
            }

            if ($("#img").prop('files')[0] != undefined) {
                if ($("#img").prop('files')[0].size > 204800) {
                    $("#v_alert").append(
                        '<div class="alert" id="alert_img">Vui lòng chọn kích thước ảnh dưới 200KB</div>');
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
                    '<div class="alert" id="alert_description">Mô tả thêm không được để trống</div>');
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

            if ($("#course_benefit").val() == "") {
                $("#v_alert").append(
                    '<div class="alert" id="alert_get_what">Lợi ích không được để trống</div>');
                setTimeout(function() {
                    $("#alert_get_what").fadeOut(1000, function() {
                        $("#alert_get_what").remove();
                    });
                }, 2000);
                $('#course_benefit').focus();
                return false;
            }else{
                form_data.append('course_benefit', $("#course_benefit").val());
            }

            if ($("#course_match").val() == "") {
                $("#v_alert").append(
                    '<div class="alert" id="alert_object">Phù hợp với ai không đươc để trống</div>');
                setTimeout(function() {
                    $("#alert_object").fadeOut(1000, function() {
                        $("#alert_object").remove();
                    });
                }, 2000);
                $('#course_match').focus();
                return false;
            }else{
                form_data.append('course_match', $("#course_match").val());
            }

            if ($("#course_request").val() == "") {
                $("#v_alert").append(
                    '<div class="alert" id="alert_get_what">Yêu cầu không được để trống</div>');
                setTimeout(function() {
                    $("#alert_get_what").fadeOut(1000, function() {
                        $("#alert_get_what").remove();
                    });
                }, 2000);
                $('#course_request').focus();
                return false;
            }else{
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
            }else{
                form_data.append('general_describe', $("#general_describe").val());
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

            form_data.append('tag_id',$("#tag_id").val());
            form_data.append('course_id',<?php echo $course_id; ?>);
            form_data.append('submit',3);
            $("#btnnext_img").css('display', 'block');
            $("#btnnext_span").css('display', 'none');
            $("#btnnext").val(0);
            $("#btnpost")[0].type = 'button';

            $.ajax({
                url: '../code_xu_ly/h_update_class_teacher.php',
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    $("#btnnext_img").css('display', 'none');
                    $("#btnnext_span").css('display', 'block');
                    if (data.type == 0) {
                        $("#v_alert").append('<div class="alert" id="alert_24_course">Tên khóa học đã tồn tại</div>');
                        setTimeout(function() {
                            $("#alert_24_course").fadeOut(1000, function() {
                                $("#alert_24_course").remove();
                            });
                        }, 2000);
                        $("#btnnext").val(1);
                        $("#btnpost")[0].type = 'submit';
                    }else if (data.type == 1) {
                        window.location.href = '/cap-nhat-khoa-hoc-online-next/id'+data.user_id+'-courseOn'+data.course_id+'.html';
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại");
                    $("#btnnext_img").css('display', 'none');
                    $("#btnnext_span").css('display', 'block');
                    $("#btnnext").val(1);
                    $("#btnpost")[0].type = 'submit';
                }
            });
            
            return false;
        }
    });
    </script>
</body>

</html>