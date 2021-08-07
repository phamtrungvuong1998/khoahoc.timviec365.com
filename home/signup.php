<?php 
if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_type'])) {
    header("Location:/");
}else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <link rel="stylesheet" href="../css/reset.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/signup.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_footer.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_header-home.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/custom-bootstrap.css?v=<?=$version?>">
    <style>
    [id*=v_validation-] {
        color: red;
        padding-left: 5%;
    }
    </style>
    <title>Đăng ký</title>
</head>

<body>
    <div id="main">
        <!-- Begin: header -->
        <?php require_once("../includes/h_inc_header.php"); ?>
        <!-- End: header -->

        <!-- Begin: content -->
        <center id="content-box">
            <div id="content">
                <form name="v_signup" onsubmit="return(v_validation());">
                    <div class="font-all-400" id="content-title">Đăng ký</div>
                    <div class="signup-input">
                        <center><input type="text" id="name" name="username" placeholder="Họ tên"></center>
                        <p id="v_validation-1"></p>
                    </div>
                    <div class="signup-input">
                        <center><input type="text" id="email" name="mail" placeholder="Email"></center>
                        <p id="v_validation-2"></p>
                    </div>
                    <div class="signup-input">
                        <center><input type="text" id="phone" onkeypress="isnumber(event,this)" maxlength="12" name="phone" placeholder="Điện thoại"></center>
                        <p id="v_validation-3"></p>
                    </div>
                    <div class="signup-input">
                        <center><input type="password" id="password" onkeypress="istrim(event)" name="pass" placeholder="Mật khẩu"></center>
                        <p id="v_validation-4"></p>
                    </div>
                    <div class="signup-input">
                        <center><input type="password" id="repassword" onkeypress="istrim(event)" name="repass" placeholder="Nhập lại mật khẩu"></center>
                        <p id="v_validation-5"></p>
                    </div>
                    <div class="flex" id="xacnhan">
                        <div><input checked id="v_dieukhoan" type="checkbox"></div>
                        <div class="font-all-400">
                            <center>Tôi đã đọc và đồng ý với <a href="https://timviec365.com/thoa-thuan-su-dung.html" target="_blank">Điều khoản sử dụng</a> và <a href="https://timviec365.com/quy-dinh-bao-mat.html" target="_blank">Chính
                                    sách
                                    bảo mật</a></center>
                        </div>
                    </div>
                    <div id="btn-ttk">
                        <center><button type="submit" name="btn" id="taotaikhoan"
                                class="font-all-700"><span id="taotaikhoan-span">TẠO TÀI KHOẢN</span><img id="singup_img" src="../img/Spinner-1s-200px.gif" alt=""></button></center>
                    </div>
                    <div id="dacotk" class="font-all-400">Bạn đã có tài khoản? <a href="dang-nhap.html">Đăng nhập</a></div>
                </form>
            </div>
        </center>
        <!-- End: content -->

        <!-- Begin: foooter -->
        <?php require_once("../includes/h_inc_footer.php"); ?>
        <!-- End: footer -->
    </div>
    <script type="text/javascript" src="../js/v-main.js?v=<?=$version?>"></script>
    <script type="text/javascript">
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

        function v_validation() {
            var reName = /^[a-zA-Z]{1,}$/;
            var rePass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
            var reEmail = /^[a-zA-Z0-9@.]{1,}$/;
            var username = document.v_signup.username.value;
            var email = document.v_signup.mail.value;
            var phone = document.v_signup.phone.value;
            var pass = document.v_signup.pass.value;
            var repass = document.v_signup.repass.value;
            if (document.v_signup.username.value == "") {
                document.getElementById('v_validation-1').innerText = "Bạn phải nhập trường này";
                $("#name").focus();
                return false;
            }else if (username.charAt(0) == ' ' || username.charAt(username.length - 1) == ' ') {
                document.getElementById('v_validation-1').innerText = "Họ tên sai(Không được có khoảng trắng ở đầu và cuối tên)";
                $("#name").focus();
                return false;
            }else if (reName.test(changeSlug(username)) == false) {
                document.getElementById('v_validation-1').innerText = "Họ tên không được chứa số hoặc kí tự đặc biệt";
                $("#name").focus();
                return false;
            }else {
                document.getElementById('v_validation-1').innerText = "";
            }

            if (document.v_signup.mail.value == "") {
                document.getElementById('v_validation-2').innerText = "Bạn phải nhập trường này";
                $("#email").focus();
                return false;
            }else if(reEmail.test(email) == false || email.lastIndexOf(".") - email.indexOf("@") == 1 || email.indexOf("@") == -1 || email.indexOf(".") == -1 || email.charAt(0) == ' ' || email.charAt(email.length - 1) == ' '){
                document.getElementById('v_validation-2').innerText = "Sai định dạng email";
                $("#email").focus();
                return false;
            }else if(email.length - 1 == email.lastIndexOf(".")){
                document.getElementById('v_validation-2').innerText = "Sai định dạng email";
                $("#email").focus();
                return false;
            }else {
                document.getElementById('v_validation-2').innerText = "";
            }

            if (phone == "") {
                document.getElementById('v_validation-3').innerText = "Bạn phải nhập trường này";
                $("#phone").focus();
                return false;
            } else if (isNaN(phone)) {
                document.getElementById('v_validation-3').innerText = "Bạn chỉ được nhập số";
                $("#phone").focus();
                return false;
            } else if (phone.charAt(0) != 0) {
                document.getElementById('v_validation-3').innerText = "Bạn nhập sai số điện thoại";
                $("#phone").focus();
                return false;
            } else if (phone.length < 10) {
                document.getElementById('v_validation-3').innerText = "Số điện thoại phải trên 10 số";
                $("#phone").focus();
                return false;
            }else {
                document.getElementById('v_validation-3').innerText = "";
            }

            if (document.v_signup.pass.value == "") {
                document.getElementById('v_validation-4').innerText = "Bạn phải nhập trường này";
                $("#password").focus();
                return false;
            } else if (document.v_signup.pass.value.length < 8) {
                document.getElementById('v_validation-4').innerText = "Mật khẩu phải trên 8 kí tự";
                $("#password").focus();
                return false;
            }else if(rePass.test(changeSlug(document.v_signup.pass.value)) == false){
                document.getElementById('v_validation-4').innerText = "Mật khẩu phải chứa chữ và số";
                $("#password").focus();
                return false;
            }else {
                document.getElementById('v_validation-4').innerText = "";
            }

            if (document.v_signup.repass.value == "") {
                document.getElementById('v_validation-5').innerText = "Bạn phải nhập trường này";
                $("#repassword").focus();
                return false;
            } else if (document.v_signup.repass.value != document.v_signup.pass.value) {
                document.getElementById('v_validation-5').innerText = "Nhập lại mật khẩu sai";
                $("#repassword").focus();
                return false;
            }else {
                document.getElementById('v_validation-5').innerText = "";
            }

            if($("#v_dieukhoan")[0].checked == false){
                alert('Bạn chưa đồng ý với điều khoản');
                return false;
            }else{
                $("#taotaikhoan-span").css('display', 'none');
                $("#taotaikhoan-span")[0].type = 'button';
                $("#singup_img").css('display', 'block');
                $.ajax({
                    url: '../code_xu_ly/v_signup.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        username: username,
                        email: email,
                        phone: phone,
                        pass: pass
                    },
                    success: function (data) {
                        if (data.type == 0) {
                            document.getElementById('v_validation-2').innerText = "Email đã tồn tại";
                            $("#email").focus();
                        }else if (data.type == 1) {
                            window.location.href = "/xac-thuc-tai-khoan.html";
                        }
                        $("#taotaikhoan-span").css('display', 'block');
                        $("#taotaikhoan-span")[0].type = 'submit';
                        $("#singup_img").css('display', 'none');
                    },
                    error: function () {
                        $("#taotaikhoan-span").css('display', 'block');
                        $("#taotaikhoan-span")[0].type = 'submit';
                        $("#singup_img").css('display', 'none');
                        alert("Có lỗi xảy ra. Vui lòng thử lại");
                    }
                });

            }

            return false;
        }
    </script>
</body>

</html>


<?php } ?>

