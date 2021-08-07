<?php
include_once "../config/config.php";
if (isset($_COOKIE['user_id']) || isset($_COOKIE['user_type'])) {
    header("Location: /");
}

$cookie_id = 0;
$cookie_type = 0;
$db_city = new db_query('SELECT * FROM city Where cit_parent=0')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <title>Đăng ký trung tâm</title>
    <link rel="stylesheet" href="../css/select2.min.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/custom-bootstrap.css">
    <link rel="stylesheet" href="../css/h_footer.css">
    <link rel="stylesheet" href="../css/h_header-home.css">
    <link rel="stylesheet" href="../css/tt_themthanhvien.css">
    <link rel="stylesheet" href="../css/h_header-home.css">
    <style>
        #l_dangky_span{
            font-style: normal;
            font-weight: bold;
            font-size: 14px;
            color: rgba(0, 0, 0, 0.87);
        }

        #l_dangky_img{
            display: none;
            width: 40px;
            height: 20px;
        }
    </style>

</head>

<body>
    <!-- header -->
    <?php
    include '../includes/h_inc_header.php';
    ?>
    <!-- end: header -->
    <!-- content -->
    <form onsubmit="l_validate_submit(); return false;">
        <div class="l_contact">
            <div class="l_title">
                <div class="l_hop"></div>
                <div class="l_title_text">THÔNG TIN LIÊN HỆ</div>
            </div>
            <div class="l_title-1 ">
                <div>Tên trung tâm ( Doanh nghiệp ) <span class="l_text_color">*</span></div>
                <input type="text" name="l_user" id="l_user" placeholder="Trung tâm ..." class="l_input">
                <p id="l_error1" class="l_text_color"></p>
            </div>
            <div class="l_title-1 l_margin">
                <div>Địa chỉ email <span class="l_text_color">*</span></div>
                <input type="mail" name="l_email" id="l_email" placeholder="abc@gmail.com" class="l_input">
                <p id="l_error2" class="l_text_color"></p>
                <p id="l_checkmail" class="l_text_color"></p>
            </div>
            <div class="l_title-1 l_margin">
                <div>Số điện thoại <span class="l_text_color">*</span></div>
                <input type="text" name="l_phone" id="l_phone" placeholder="0391234567" class="l_input">
                <p id="l_error3" class="l_text_color"></p>
            </div>
            <div class="l_title-1 l_margin">
                <div>Mật khẩu <span class="l_text_color">*</span></div>
                <input type="password" name="l_pass" onkeypress="istrim(event)" placeholder="Nhập mật khẩu" id="l_pass" class="l_input">
                <p id="l_error4" class="l_text_color"></p>
            </div>
            <div class="l_title-1 l_margin">
                <div>Nhập lại mật khẩu <span class="l_text_color">*</span></div>
                <input type="password" onkeypress="istrim(event)" name="l_retypePass" placeholder="Nhập lại mật khẩu" id="l_retypePass" class="l_input">
                <p id="l_error5" class="l_text_color"></p>
            </div>
            <div class="l_flex_city l_title-1">
                <div class="l_city">
                    <div>Tỉnh thành <span class="l_text_color">*</span></div>
                    <select id="l_city" name="l_city" data-live-search="true" title="Chọn tỉnh thành">
                        <option value="" selected hidden>Chọn tỉnh thành</option>
                        <?
                        while ($row = mysql_fetch_assoc($db_city->result)) {
                        ?>
                            <option value="<? echo $row['cit_id'] ?>">
                                <? echo $row['cit_name'] ?>
                            </option>
                        <?
                        }
                        ?>

                    </select>
                    <p id="l_error6" class="l_text_color"></p>

                </div>
                <div class="l_city">
                    <div>Quận huyện <span class="l_text_color">*</span></div>
                    <select id="l_district" name="l_district" data-live-search="true" title="Chọn tỉnh thành">
                        <option value="" selected hidden>Chọn quận huyện</option>
                    </select>
                    <p id="l_error7" class="l_text_color"></p>

                </div>
            </div>
            <div class="l_title-1 l_margin l_flex l_padding">
                <div class="l_title_right">
                    <div class="l_title-1 l_margin-1">
                        <div>Địa chỉ trung tâm <span class="l_text_color">*</span></div>
                        <input type="text" id="l_address" name="l_address" placeholder="Địa chỉ chi tiết" class="l_input">
                        <p id="l_error8" class="l_text_color"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="l_contact">
            <div class="l_title">
                <div class="l_hop"></div>
                <div class="l_title_text">CHỦ ĐỀ GIẢNG DẠY</div>
            </div>
            <div class="l_title-1">
                <div class="l_luuy">Lưu ý chọn đúng ô có chiều lĩnh vực và trình độ tương ứng với nội dung mà mình muốn
                    hợp tác.</br>Có thể chọn nhiều mục.</div>
            </div>
            <div class="l_title-1 l_table ">
                <div class="l_content-title">
                    <div class="l_table-cell l_center"></div>
                    <div class="l_table-cell l_center">Cơ bản</div>
                    <div class="l_table-cell l_center">Nâng cao</div>
                    <div class="l_table-cell l_center">Chuyên sâu</div>
                    <div class="l_table-cell l_center">Mọi cấp độ</div>
                </div>
                <div class="l_noidungkh">
                    <div class="l_table-cell l_table_text">
                        Sales - CSKH
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
                <div class="l_noidungkh">
                    <div class="l_table-cell l_table_text">
                        Marketing - Truyền thông
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
                <div class="l_noidungkh">
                    <div class="l_table-cell l_table_text">
                        Tài chính - Kế toán
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
                <div class="l_noidungkh">
                    <div class="l_table-cell l_table_text">
                        Hành chính - nhân sự
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
                <div class="l_noidungkh">
                    <div class="l_table-cell l_table_text">
                        Kinh doanh - Khởi nghiệp
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
                <div class="l_noidungkh">
                    <div class="l_table-cell l_table_text">
                        Kỹ năng công việc
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
                <div class="l_noidungkh">
                    <div class="l_table-cell l_table_text">
                        Kỹ năng con người
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
                <div class="l_noidungkh">
                    <div class="l_table-cell l_table_text">
                        Kỹ năng quản trị
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
                <div class="l_noidungkh">
                    <div class="l_table-cell l_table_text">
                        Phát triển cá nhân
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
                <div class="l_noidungkh">
                    <div class="l_table-cell l_table_text">
                        Đời sống
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
                <div class="l_noidungkh">
                    <div class="l_table-cell l_table_text">
                        Thiết kế - Đồ họa
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
                <div class="l_noidungkh">
                    <div class="l_table-cell l_table_text">
                        Ngoại ngữ
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="l_table-cell l_center">
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
            </div>
            <div class="l_class_btn">
                <button onclick="l_validate_submit(); return false;" type="submit" name="btn" class="l_dangky">
                    <span id="l_dangky_span">HOÀN TẤT ĐĂNG KÝ</span>
                    <img src="../img/Spinner-1s-200px.gif" id="l_dangky_img" alt="">
                </button>
            </div>
        </div>
    </form>
    <!-- end:content -->

    <!-- footer -->
    <?php include '../includes/h_inc_footer.php' ?>
    <!-- end: footer -->

</body>

</html>

<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#l_city').select2();
        $('#l_district').select2();
    });
    $(document).ready(function() {
        $("#l_city").change(function() {
            var a = $("#l_city").val();
            $.get('../ajax/l_ajax_load_city.php', {
                l_district: a
            }, function(data) {
                $("#l_district").html(data);
            });
        });
    });

    function validateEmail(a) {
        const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(a);
    }
    function istrim(evt) {
        var num = String.fromCharCode(evt.which);
        if (num == " ") {
            evt.preventDefault();
        }
    }

    function validate_str(str) {
        str = str.replace(/[^0-9a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ\s]/gi, '');
        str = str.replace(/\s+/g, ' ');
        str = str.trim();
        return str;
    }

    function validate_number(str) {
        str = str.replace(/[^0-9\s]/gi, '');
        str = str.replace(/\s+/g, '');
        str = str.trim();
        return str;
    }

    window.onload = function() {
        var user = document.getElementById('l_user');
        var email = document.getElementById('l_email');
        var phone = document.getElementById('l_phone');
        var pass = document.getElementById('l_pass');
        var retypePass = document.getElementById('l_retypePass');
        var address = document.getElementById('l_address');

        user.onblur = function() {
            this.value = validate_str(this.value);
        };
        phone.onblur = function() {
            this.value = validate_number(this.value);
        };
        address.onblur = function() {
            this.value = validate_str(this.value);
        };
    };

    function l_validate() {
        var flag = false;
        var rePass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        var user = document.getElementById('l_user').value;
        var email = document.getElementById('l_email').value;
        // var phone = document.getElementById('l_phone').value;
        var pass = document.getElementById('l_pass').value;
        var retypePass = document.getElementById('l_retypePass').value;
        var city = document.getElementById('l_city').value;
        var district = document.getElementById('l_district').value;
        var address = document.getElementById('l_address').value;
        if (user == "") {
            document.getElementById("l_error1").innerHTML = "Bạn chưa nhập tên trung tâm";
            document.getElementById('l_user').focus();
            return false;
        } else {
            document.getElementById("l_error1").innerHTML = '';
            flag = true;
        }

        if (email == "") {
            document.getElementById("l_error2").innerHTML = "Bạn chưa nhập email";
            document.getElementById('l_email').focus();
            return false;
        } else if (!validateEmail(email)) {
            document.getElementById("l_error2").innerHTML = "Nhập không đúng email";
            document.getElementById('l_email').focus();
            return false;
        } else {
            document.getElementById("l_error2").innerHTML = '';
            flag = true;
        }

        var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        var mobile = $('#l_phone').val();
        if (mobile == '') {
            document.getElementById("l_error3").innerHTML = "Bạn chưa nhập số điện thoại";
            document.getElementById('l_phone').focus();
            return false;
        } else if (vnf_regex.test(mobile) == false) {
            document.getElementById("l_error3").innerHTML = "Số điện thoại không đúng định dạng";
            document.getElementById('l_phone').focus();
            return false;
        } else {
            document.getElementById("l_error3").innerHTML = '';
            flag = true;
        }

        var vd_pass = /[^0-9a-z\s]/g;
        if (pass == '') {
            document.getElementById("l_error4").innerHTML = "Không được để trống";
            document.getElementById('l_pass').focus();
            return false;
        } else if (vd_pass.test(pass) == true) {
            document.getElementById("l_error4").innerHTML = "Mật khẩu chỉ bao gồm chữ hoa, chữ thường, số, không bao gồm ký tự";
            document.getElementById('l_pass').focus();
            return false;
        } else if (pass.length < 8) {
            document.getElementById("l_error4").innerHTML = "Mật khẩu phải có ít nhất 8 ký tự";
            document.getElementById('l_pass').focus();
            return false;
        }else if (rePass.test(pass) == false) {
            document.getElementById("l_error4").innerHTML = "Mật khẩu phải chứa ít nhất 1 chữ, 1 số và không chứa dấu cách";
            document.getElementById('l_pass').focus();
            return false;
        } else {
            document.getElementById("l_error4").innerHTML = '';
            flag = true;
        }

        if (retypePass == "") {
            document.getElementById("l_error5").innerHTML = "Bạn chưa nhập lại mật khẩu";
            document.getElementById('l_retypePass').focus();
            return false;
        } else if (pass != retypePass) {
            document.getElementById("l_error5").innerHTML = "Nhập lại mật khẩu sai";
            document.getElementById('l_retypePass').focus();
            return false;
        } else {
            document.getElementById("l_error5").innerHTML = '';
            flag = true;
        }

        if (city == "") {
            document.getElementById("l_error6").innerHTML = "Bạn chưa chọn tỉnh thành phố";
            document.getElementById('l_city').focus();
            return false;
        } else {
            document.getElementById("l_error6").innerHTML = '';
            flag = true;
        }

        if (district == "") {
            document.getElementById("l_error7").innerHTML = "Bạn chưa chọn quận, huyện";
            document.getElementById('l_district').focus();
            return false;
        } else {
            document.getElementById("l_error7").innerHTML = '';
            flag = true;
        }

        if (address == "") {
            document.getElementById("l_error8").innerHTML = "Bạn chưa nhập địa chỉ";
            document.getElementById('l_address').focus();
            return false;
        } else {
            document.getElementById("l_error8").innerHTML = '';
            flag = true;
        }
        return flag;
    }

    function l_validate_submit() {
        var flag = l_validate();
        if (flag == true) {
            // console.log(112312);
            var user = document.getElementById('l_user').value;
            var email = document.getElementById('l_email').value;
            var phone = document.getElementById('l_phone').value;
            var pass = document.getElementById('l_pass').value;
            var retypePass = document.getElementById('l_retypePass').value;
            var city = document.getElementById('l_city').value;
            var district = document.getElementById('l_district').value;
            var address = document.getElementById('l_address').value;

            var data = new FormData();
            data.append('user', user);
            data.append('email', email);
            data.append('phone', phone);
            data.append('pass', pass);
            data.append('retypePass', retypePass);
            data.append('city', city);
            data.append('district', district);
            data.append('address', address);
            $("#l_dangky_span").css('display', 'none');
            $("#l_dangky_img").css('display', 'block');
            $(".l_dangky")[0].type = 'button';
            $.ajax({
                url: '../ajax/l_ajax_checkmail.php',
                type: 'post',
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#l_dangky_span").css('display', 'block');
                    $("#l_dangky_img").css('display', 'none');
                    if (response.result == 1) {
                        $('#l_error1').html('');
                        $('#l_user').focus();
                        $('#l_error1').html(response.message);
                        $(".l_dangky")[0].type = 'submit';
                    } else if (response.result == 2) {
                        $('#l_checkmail').html('');
                        $('#l_email').focus();
                        $('#l_checkmail').html(response.message);
                        $(".l_dangky")[0].type = 'submit';
                    } else if (response.result == 3) {
                        window.location.href = "/xac-thuc-tai-khoan.html";
                    } else {
                        alert(response.message);
                        $(".l_dangky")[0].type = 'submit';
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại");
                    $("#l_dangky_span").css('display', 'blcok');
                    $("#l_dangky_img").css('display', 'none');
                    $(".l_dangky")[0].type = 'submit';
                }
            });
        }
        // return false;
    }
</script>