<?php
require_once '../includes/v_inc_insert_HV.php';
$user_id = $_COOKIE['user_id'];

$v_mon_hoc = explode(",",$rowHV['cate_id']);


if ($rowHV['user_gender'] == 1) {
    $v_gender_nam = 'checked=""';
}else if($rowHV['user_gender'] == 2){
    $v_gender_nu = 'checked=""';
}


    //Lấy toàn bộ tỉnh, thành phố
$qrCity = new db_query("SELECT cit_name,cit_id FROM city WHERE cit_parent = 0");


    //Lấy quận huyện của tỉnh, thành phố mà học viên đăng kí
$v_rowHV_district = $rowHV['cit_id'];
$qrDistrict = new db_query("SELECT cit_name,cit_id FROM city WHERE cit_parent = '$v_rowHV_district'");
        //Lấy tên môn học
$qrCategories = new db_query("SELECT cate_id,cate_name FROM categories");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <link rel="stylesheet" href="../css/select2.min.css?v=<?=$version?>" />
    <script type="text/javascript" src="../js/jquery.js?v=<?=$version?>"></script>
    <?php
    require_once '../includes/v_inc_HV_css.php'; 
    ?>
    <link rel="stylesheet" href="../css/HV-page_thong_tin_ca_nhan.css?v=<?=$version?>">
    <style>
    #user_gender {
        background: none;
    }

    #user_date {
        background: none;
    }
    .v_sidebar-list_info{
        color: #1B6AAB;
    }
    #v_sidebar-tb-5{
        display: block;
    }
    #v_sidebar-tb-5 li:nth-child(1) a{
        color: #1B6AAB;
    }
    .alert-success {
        position: fixed;
        width: 20%;
        top: 20px;
        right: 1%;
        z-index: 1;
        background: #dff0d8;
        color: #3c763d;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }


    .content-div-div > .v_info{
        width: auto;
    }

    @media (max-width: 1365px) {
        .alert-success {
            width: 50%;
        }
    }

    @media (max-width: 1365px) {
        .alert-success {
            width: 98%;
        }
    }

    #student_pass_img,
    #student_img {
        display: none;
        margin: 0 auto;
    }

    #student_pass_update,
    #student_update {
        color: white;
        font-weight: 700;
    }

    #student_pass_update {
        color: white;
    }

        #student_pass_update{
            color: white;
        }

        #v_sidebar-3{
            display: block;
        }

        #v_sidebar-3 a{
            color: #1B6AAB;
        }

        #v_thong-tin-tk-1{
            color: #1B6AAB;
        }
        #v_thong-tin-tk{
            cursor: pointer;
        }
        #content-div{
            padding-left: 39px;
        }
        @media (max-width: 767px){
            #content-div{
                padding-left: 5%;
            }
        }
    </style>
    <title>Thông tin tài khoản</title>
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
            <div id="v_anh-dai-dien">
                <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload"
                src="../img/load.gif" data-src="../img/avatar/<?php echo $rowHV['user_avatar']; ?>" id="avatar"
                alt="Ảnh lỗi">
                <img src="../img/Group33608.svg" class="camera-img" id="v_update-avatar" alt="Ảnh lỗi">
                <input type="file" style="display: none;" name="avatar" id="img" onchange="changeImg(this)"
                accept=".png, .jpg, .jpeg">
            </div>
            <div id="content-box" class="flex">
                <div id="v_alert"></div>
                <div id="content">
                    <div class="flex" id="content-div">
                        <div class="content-div-div" id="v_thong-tin-tk" onclick="v_doi(1)"><p id="v_info1">Thông tin tài khoản</p></div>
                        <div class="content-div-div" id="v_doi-mk" onclick="v_doi(2)"><p class="v_info" id="v_info2">Đổi mật khẩu</p></div>
                    </div>
                    <center>
                        <hr width="97%">
                    </center>
                    <form name="v_detail" enctype="multipart/form-data" onsubmit="return v_detail_once();"
                        id="v_chi-tiet-tk">
                        <div id="v_form">
                            <div class="v_form-div">
                                <div class="v_form-div-div">
                                    <p class="v_form-p">Email</p>
                                    <input class="v_input-1" id="v_input-email"
                                        value="<?php echo $rowHV['user_mail']; ?>" name="mail" type="email" disabled>
                                </div>
                                <div class="v_form-div-div">
                                    <p class="v_form-p">Họ tên</p>
                                    <input class="v_input-1" id="v_name2" name="name"
                                        value="<?php echo $rowHV['user_name']; ?>" type="text">
                                </div>
                                <p id="v_detail-2"></p>
                                <div class="v_input-2 v_form-div-div">
                                    <div id="v_gender-all">
                                        <p class="v_form-p" id="v_form-p-gender">Giới tính</p>
                                        <input type="radio" class="user_gender" <?php if (isset($v_gender_nam)) {
                                                echo $v_gender_nam;
                                            } ?> value="1" name="v_gender">
                                        <label class="v_gender" id="v_gender-nam">Nam</label>
                                        <input type="radio" class="user_gender" <?php if (isset($v_gender_nu)) {
                                                echo $v_gender_nu;
                                            } ?> value="2" name="v_gender">
                                        <label class="v_gender" id="v_gender-nu">Nữ</label>
                                    </div>
                                    <div id="v_sdt">
                                        <p class="v_form-p">Số điện thoại</p>
                                        <input class="v_input-1" id="v_phone2" name="phone" onkeypress="isnumber(event)"
                                            value="<?php echo $rowHV['user_phone']; ?>" maxlength="10" type="text">
                                        <p id="v_detail-3"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="v_form-div">
                                <div class="v_form-div-div">
                                    <p class="v_form-p">Địa chỉ</p>
                                    <input class="v_input-1" id="v_address2" name="address"
                                        value="<?php echo $rowHV['user_address']; ?>" type="text">
                                    <p id="v_detail-1"></p>
                                </div>
                                <div id="v_address" class="v_form-div-div">
                                    <div class="v_address-div">
                                        <p class="v_form-p">Tỉnh, thành phố</p>
                                        <select name="city" id="v_city">
                                            <option value="0">Tỉnh, thành phố</option>
                                            <?php while($rowCity = mysql_fetch_array($qrCity->result)) {
                                                    ?>
                                            <option value="<?php echo $rowCity['cit_id']; ?>" <?php if ($rowHV['cit_id'] == $rowCity['cit_id']) {
                                                        echo "selected";
                                                    } ?>><?php echo $rowCity['cit_name']; ?></option>
                                            <?php
                                                }
                                                ?>
                                        </select>
                                    </div>
                                    <div class="v_address-div">
                                        <p class="v_form-p">Quận, huyện</p>
                                        <select name="district" id="v_district">
                                            <option value="0">Quận, huyện</option>
                                            <?php while ($v_HV_district = mysql_fetch_array($qrDistrict->result)) {
                                                    ?>

                                            <option value="<?php echo $v_HV_district['cit_id']; ?>" <?php if ($v_HV_district['cit_id'] == $rowHV['district_id']) {
                                                        echo "selected";
                                                    } ?>><?php echo $v_HV_district['cit_name']; ?></option>

                                            <?php 
                                                } 
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="v_form-div-div">
                                    <p class="v_form-p">Ngày Sinh</p>
                                    <input class="v_input-1" id="user_date" name="birth"
                                        value="<?php echo $rowHV['user_birth']; ?>" type="date">
                                </div>
                            </div>
                            <div class="v_form-div" id="v_mh-quan-tam">
                                <p class="v_form-p">Môn học quan tâm</p>
                                <div id="v_ds-mh-qt">
                                    <center id="v_them-theme">
                                        <select name="cate_id[]" id="cate_id" multiple>
                                            <?php 
                                                while ($rowCate = mysql_fetch_array($qrCategories->result)) { ?>
                                            <option value="<?php echo $rowCate['cate_id']; ?>" <?php for ($i=0; $i < count($v_mon_hoc) ; $i++) { 
                                                        if ($v_mon_hoc[$i] == $rowCate['cate_id']) {
                                                            echo "selected";
                                                        }
                                                    } ?>><?php echo $rowCate['cate_name']; ?></option>
                                            <?php        
                                                }
                                                ?>
                                        </select>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <input id="v_cate_1" type="hidden" value="" name="categories">
                        <div id="v_submit">
                            <center><button id="v_submit-input" name="v_submit-detail" type="submit"><span
                                        id="student_update">CẬP NHẬT</span><img id="student_img"
                                        src="../img/Spinner-1s-200px.gif" alt=""></button></center>
                        </div>
                    </form>
                    <form onsubmit="return v_checkPass()" name="v_update_pass" id="v_doi-password">
                        <div id="v_form-1">
                            <div class="v_form-div-div-1">
                                <p class="v_form-p">Mật khẩu hiện tại</p>
                                <input class="v_input-3" name="v_pass" onkeypress="istrim(event)" id="v_xem-pass-1" type="password">

                                <img class="v_doi-pass" onclick="v_xem_pass(1)" src="../img/doi-pass.svg" alt="Ảnh lỗi">
                                <?php if (isset($_COOKIE['errPass'])) {
                                        echo $_COOKIE['errPass'];
                                    } ?>
                            </div>
                            <div class="v_form-div-div-1" id="v_form-div-div-1">
                            </div>
                            <div class="v_form-div-div-2">
                                <p class="v_form-p">Mật khẩu mới</p>
                                <input class="v_input-3" onkeypress="istrim(event)" name="v_pass_new" id="v_xem-pass-2" type="password">
                                <img class="v_doi-pass-1" onclick="v_xem_pass(2)" src="../img/doi-pass.svg"
                                    alt="Ảnh lỗi">
                                <p id="v_pass-update-1"></p>
                            </div>
                            <div class="v_form-div-div-2">
                                <p class="v_form-p">Nhập lại mật khẩu mới</p>
                                <input class="v_input-3" name="v_repass_new" onkeypress="istrim(event)" id="v_xem-pass-3" type="password">
                                <img class="v_doi-pass-1" onclick="v_xem_pass(3)" src="../img/doi-pass.svg"
                                    alt="Ảnh lỗi">
                                <p id="v_pass-update-2"></p>
                            </div>
                            <center><button type="submit" name="v_doi-pass" id="v_xem-pass-btn"><span
                                        id="student_pass_update">CẬP NHẬP</span><img id="student_pass_img"
                                        src="..img/Spinner-1s-200px" alt=""></button></center>
                        </div>
                    </form>
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
<script type="text/javascript" src="../js/v-main.js?v=<?=$version?>"></script>
<script src="../js/select2.min.js?v=<?=$version?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#v_city").select2({
        dropdownAutoWidth: true
    });
    $("#v_district").select2({
        dropdownAutoWidth: true
    });
    $("#v_city").change(function() {
        var a = $("#v_city").val();
        $.get('../ajax/v_district.php', {
            v_district: a
        }, function(data) {
            $("#v_district").html(data);
        });
    });

    $('#cate_id').select2({
        dropdownAutoWidth: true,
        multiple: true,
        maximumSelectionLength: 5,
        minimumInputLength: 0,
    });
});

function isnumber(evt) {
    var num = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(num))) {
        evt.preventDefault();
    }
}

function istrim(evt) {
    var num = String.fromCharCode(evt.which);
    if (num == " ") {
        evt.preventDefault();
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

function v_detail_once() {
    var reAddress = /^[a-zA-Z0-9]{1,}$/;
    var reName = /^[a-zA-Z]{1,}$/;
    var rePass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    var v_address = document.v_detail.address.value;
    var v_phone = document.v_detail.phone.value;
    var gender = document.v_detail.v_gender.value;
    var birth = document.v_detail.birth.value;
    var phone = document.v_detail.phone.value;
    if (v_address == "") {
        $("#v_alert").append('<div class="alert-danger" id="alert_address">Địa chỉ không được để trống</div>');
        setTimeout(function() {
            $("#alert_address").fadeOut(1000, function() {
                $("#alert_address").remove();
            });
        }, 2000);
        $("#v_address2").focus();
        return false;
    } else if (reAddress.test(changeSlug(v_address)) == false) {
        $("#v_alert").append(
            '<div class="alert-danger" id="alert_name">Địa chỉ sai( không được có kí tự đặc biệt )</div>');
        setTimeout(function() {
            $("#alert_name").fadeOut(1000, function() {
                $("#alert_name").remove();
            });
        }, 2000);
        $("#v_address2").focus();
        return false;
    } else if ($("#v_name2").val() == '') {
        $("#v_alert").append('<div class="alert-danger" id="alert_name">Họ tên không được để trống</div>');
        setTimeout(function() {
            $("#alert_name").fadeOut(1000, function() {
                $("#alert_name").remove();
            });
        }, 2000);
        $("#v_name2").focus();
        return false;
    } else if (reName.test(changeSlug($("#v_name2").val())) == false) {
        $("#v_alert").append(
            '<div class="alert-danger" id="alert_name">Tên sai( không được có kí tự đặc biệt hoặc chữ số )</div>');
        setTimeout(function() {
            $("#alert_name").fadeOut(1000, function() {
                $("#alert_name").remove();
            });
        }, 2000);
        $("#v_name2").focus();
        return false;
    } else if ($("#v_city").val() == 0) {
        $("#v_alert").append('<div class="alert-danger" id="alert_city">Vui lòng chọn tỉnh thành phố</div>');
        setTimeout(function() {
            $("#alert_city").fadeOut(1000, function() {
                $("#alert_city").remove();
            });
        }, 2000);
        return false;
    } else if ($("#v_district").val() == 0) {
        $("#v_alert").append('<div class="alert-danger" id="v_district">Vui lòng chọn Quận huyện</div>');
        setTimeout(function() {
            $("#v_district").fadeOut(1000, function() {
                $("#v_district").remove();
            });
        }, 2000);
        return false;
    } else if (gender != 1 && gender != 2) {
        $("#v_alert").append('<div class="alert-danger" id="v_gender">Vui lòng chọn giới tính</div>');
        setTimeout(function() {
            $("#v_gender").fadeOut(1000, function() {
                $("#v_gender").remove();
            });
        }, 2000);
        return false;
    } else if (phone == "") {
        $("#v_alert").append('<div class="alert-danger" id="v_phone">Vui lòng điền số điện thoại</div>');
        $("#v_phone2").focus();
        setTimeout(function() {
            $("#v_birth").fadeOut(1000, function() {
                $("#v_birth").remove();
            });
        }, 2000);
        return false;
    } else if (isNaN(phone)) {
        $("#v_alert").append('<div class="alert-danger" id="v_phone">Sai định dạng số điện thoại</div>');
        $("#v_phone2").focus();
        setTimeout(function() {
            $("#v_phone").fadeOut(1000, function() {
                $("#v_phone").remove();
            });
        }, 2000);
        return false;
    } else if (phone.charAt(0) != '0') {
        $("#v_alert").append('<div class="alert-danger" id="v_phone">Sai định dạng số điện thoại</div>');
        $("#v_phone2").focus();
        setTimeout(function() {
            $("#v_birth").fadeOut(1000, function() {
                $("#v_birth").remove();
            });
        }, 2000);
        return false;
    } else if(phone.length < 10){
        $("#v_alert").append('<div class="alert-danger" id="v_phone">Sai định dạng số điện thoại</div>');
        $("#v_phone2").focus();
        setTimeout(function() {
            $("#v_birth").fadeOut(1000, function() {
                $("#v_birth").remove();
            });
        }, 2000);
        return false;
    }else if (birth == "") {
        $("#v_alert").append('<div class="alert-danger" id="v_birth">Vui lòng chọn ngày sinh</div>');
        setTimeout(function() {
            $("#v_birth").fadeOut(1000, function() {
                $("#v_birth").remove();
            });
        }, 2000);
        return false;
    } else if ($("#cate_id").val() == null) {
        $("#v_alert").append('<div class="alert-danger" id="v_birth">Vui lòng chọn môn học quan tâm</div>');
        setTimeout(function() {
            $("#v_birth").fadeOut(1000, function() {
                $("#v_birth").remove();
            });
        }, 2000);
        return false;
    } else if ($('#img').prop('files')[0] != undefined) {
        var match = ["image/jpeg", "image/JPEG", "image/png", "image/PNG", "image/jpg", "image/JPG"];
        var j = 0;
        for (var i = 0; i < match.length; i++) {
            if ($('#img').prop('files')[0].type != match[i]) {
                j++;
            }
        }
        if (j == 6) {
            $("#v_alert").append('<div class="alert-danger" id="alert_img">Vui lòng chọn đúng định dạng ảnh</div>');
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
            var form_data = new FormData();
            form_data.append('file', $('#img').prop('files')[0]);
            $.ajax({
                url: '../ajax/v_cap_nhat_anh_HV.php',
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: form_data,
                success: function(data) {
                    $("#v_avatar").attr({
                        'src': '../img/avatar/' + data.avatar
                    });
                    $("#v_header-avatar-img2").attr('src', '../img/avatar/' + data.avatar);
                    $("#v_header-avatar-img").attr('src', '../img/avatar/' + data.avatar);
                    $("#v_header-avatar-img1").attr('src', '../img/avatar/' + data.avatar);
                },
                error: function() {
                    $("#v_alert").append(
                        '<div class="alert-danger" id="alert_img">Có lỗi xảy ra. Vui lòng thử lại</div>'
                        );
                    setTimeout(function() {
                        $("#alert_img").fadeOut(1000, function() {
                            $("#alert_img").remove();
                        });
                    }, 2000);
                }
            });
        }
    }
    $("#student_update").css('display', 'none');
    $("#student_img").css('display', 'block');
    $("#v_submit-input")[0].type = "button";
    $.ajax({
        url: '../code_xu_ly/v_doi-chi-tiet.php',
        type: 'POST',
        dataType: 'json',
        data: {
            address: v_address,
            name: $("#v_name2").val(),
            city: $("#v_city").val(),
            district: $("#v_district").val(),
            gender: gender,
            phone: phone,
            birth: birth,
            cate_id: $("#cate_id").val()
        },
        success: function(data) {
            $("#v_alert").append('<div class="alert-success">Cập nhật thành công</div>');
            $("#v_name_HV").text(data.name);
            $("#v_header-avatar-dropdown-name").text(data.name);
            $("#v_tenhocvien").text(data.name);
            $("#student_img").css('display', 'none');
            $("#student_update").css('display', 'block');
            $("#v_submit-input")[0].type = "submit";
            setTimeout(function() {
                $(".alert-success").fadeOut(1000, function() {
                    $(".alert-success").remove();
                });
            }, 2000);
        },
        error: function() {
            $("#v_alert").append(
                '<div class="alert-danger" id="alert_img">Có lỗi xảy ra. Vui lòng thử lại</div>');
            $("#student_img").css('display', 'none');
            $("#student_update").css('display', 'block');
            $("#v_submit-input")[0].type = "submit";
            setTimeout(function() {
                $("#alert_img").fadeOut(1000, function() {
                    $("#alert_img").remove();
                });
            }, 2000);
        }
    });

    return false;
}


function v_checkPass() {
    var v_pass = document.v_update_pass.v_pass.value;
    var v_pass_new = document.v_update_pass.v_pass_new.value;
    var v_repass_new = document.v_update_pass.v_repass_new.value;
    var rePass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    if (v_pass == "") {
        $("#v_alert").append('<div class="alert-danger" id="alert_pass">Mật khẩu không được để trống</div>');
        setTimeout(function() {
            $("#alert_pass").fadeOut(1000, function() {
                $("#alert_pass").remove();
            });
        }, 2000);
        $("#v_xem-pass-1").focus();
        return false;
    } else if (v_pass_new.length < 8) {
        $("#v_alert").append('<div class="alert-danger" id="alert_pass">Mật khẩu mới phải trên 8 kí tự</div>');
        setTimeout(function() {
            $("#alert_pass").fadeOut(1000, function() {
                $("#alert_pass").remove();
            });
        }, 2000);
        $("#v_xem-pass-2").focus();
        return false;
    }else if (rePass.test(v_pass_new) == false) {
        $("#v_alert").append('<div class="alert-danger" id="alert_pass">Mật khẩu mới phải chứa chữ và số</div>');
        setTimeout(function() {
            $("#alert_pass").fadeOut(1000, function() {
                $("#alert_pass").remove();
            });
        }, 2000);
        $("#v_xem-pass-2").focus();
        return false;
    } else if (v_pass == v_pass_new) {
        $("#v_alert").append('<div class="alert-danger" id="alert_newpass">Mật khẩu không thay đổi</div>');
        setTimeout(function() {
            $("#alert_newpass").fadeOut(1000, function() {
                $("#alert_newpass").remove();
            });
        }, 2000);
        $("#v_xem-pass-2").focus();
        return false;
    } else if (v_pass_new != v_repass_new) {
        $("#v_alert").append('<div class="alert-danger" id="alert_renewpass">Nhập lại mật khẩu sai</div>');
        setTimeout(function() {
            $("#alert_renewpass").fadeOut(1000, function() {
                $("#alert_renewpass").remove();
            });
        }, 2000);
        $("v_xem-pass-3").focus();
        return false;
    } else if ($('#img').prop('files')[0] != undefined) {
        var match = ["image/jpeg", "image/JPEG", "image/png", "image/PNG", "image/jpg", "image/JPG"];
        var j = 0;
        for (var i = 0; i < match.length; i++) {
            if ($('#img').prop('files')[0].type != match[i]) {
                j++;
            }
        }
        if (j == 6) {
            $("#v_alert").append('<div class="alert-danger" id="alert_img">Vui lòng chọn đúng định dạng ảnh</div>');
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
            var form_data = new FormData();
            form_data.append('file', $('#img').prop('files')[0]);
            $.ajax({
                url: '../ajax/v_cap_nhat_anh_HV.php',
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: form_data,
                success: function(data) {
                    $("#v_avatar").attr({
                        'src': '../img/avatar/' + data.avatar
                    });
                    $("#v_header-avatar-img2").attr('src', '../img/avatar/' + data.avatar);
                    $("#v_header-avatar-img").attr('src', '../img/avatar/' + data.avatar);
                    $("#v_header-avatar-img1").attr('src', '../img/avatar/' + data.avatar);
                },
                error: function() {
                    $("#v_alert").append(
                        '<div class="alert-danger" id="alert_img">Có lỗi xảy ra. Vui lòng thử lại</div>'
                        );
                    setTimeout(function() {
                        $("#alert_img").fadeOut(1000, function() {
                            $("#alert_img").remove();
                        });
                    }, 2000);
                }
            });
        }
    }

    $("#student_pass_update").css('display', 'none');
    $("#student_pass_img").css('display', 'block');
    $("#v_xem-pass-btn")[0].type = "button";
    $.ajax({
        url: '../code_xu_ly/v_doi-pass.php',
        type: 'POST',
        dataType: 'json',
        data: {
            password: v_pass,
            newpassword: v_pass_new
        },
        success: function(data) {
            if (data.alert == 0) {
                $("#v_alert").append('<div class="alert-danger" id="alert_pass">Mật khẩu sai</div>');
                setTimeout(function() {
                    $("#alert_pass").fadeOut(1000, function() {
                        $("#alert_pass").remove();
                    });
                }, 2000);
                $("#v_xem-pass-1").focus();
            } else if (data.alert == 1) {
                $("#v_alert").append('<div class="alert-success">Cập nhật mật khẩu thành công</div>');
                setTimeout(function() {
                    $(".alert-success").fadeOut(1000, function() {
                        $(".alert-success").remove();
                    });
                }, 2000);
                $("#v_xem-pass-1").val("");
                $("#v_xem-pass-2").val("");
                $("#v_xem-pass-3").val("");
            }
            $("#student_pass_img").css('display', 'none');
            $("#student_pass_update").css('display', 'block');
            $("#v_xem-pass-btn")[0].type = "submit";
        },
        error: function() {
            $("#v_alert").append(
                '<div class="alert-danger" id="alert_img">Có lỗi xảy ra. Vui lòng thử lại</div>');
            $("#student_pass_update").css('display', 'none');
            $("#student_pass_img").css('display', 'block');
            $("#v_xem-pass-btn")[0].type = "button";
            setTimeout(function() {
                $("#alert_img").fadeOut(1000, function() {
                    $("#alert_img").remove();
                });
            }, 2000);
        }
    });

    return false;
}

function changeImg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#avatar').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$('.camera-img').click(function() {
    $('#img').click();
});
</script>

</html>