<?php 
header("Cache-Control: no-cache, must-revalidate");
if (isset($_COOKIE['user_id']) || isset($_COOKIE['user_type'])) {
    header("Location: /");
}else if (!isset($_COOKIE['user_type_login'])) {
    header("Location: /lua-chon-dang-nhap.html");
}

if (isset($_COOKIE['user_type_login'])) {
	if ($_COOKIE['user_type_login'] == 1) {
		$linkSingup = '/dang-ki-hoc-vien.html';
	}else if ($_COOKIE['user_type_login'] == 2) {
		$linkSingup = '/dang-ki-giang-vien.html';
	}else if ($_COOKIE['user_type_login'] == 3) {
		$linkSingup = '/dang-ki-trung-tam.html';
	}
}
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
    <link rel="stylesheet" href="../css/login.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_footer.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_header-home.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/custom-bootstrap.css?v=<?=$version?>">
    <style>
    [id*=v_login-] {
        color: red;
        padding-left: 18%;
    }
    </style>
    <title>Đăng nhập</title>
</head>

<body>
    <div id="main">
        <!-- Begin: header -->
        <?php require_once("../includes/h_inc_header.php"); ?>

        <!-- End: header -->

        <!-- Begin: content -->
        <div id="content-box" class="flex">
            <div id="content">
                <form name="v_login" onsubmit="return v_validation();">
                    <div class="font-all-400" id="content-title">Đăng nhập</div>
                    <div class="signup-input">
                        <center><input class="signup-input-input" id="email" type="text" name="mail"
                                placeholder="Email">
                        </center>
                        <p id="v_login-1"></p>
                    </div>
                    <div class="signup-input">
                        <center><input class="signup-input-input" id="password" type="password" name="pass" placeholder="Mật khẩu">
                        </center>
                        <p id="v_login-2"></p>
                    </div>
                    <div id="btn-ttk">
                        <center><button type="submit" name="submit" id="taotaikhoan"><span id="login_btn">ĐĂNG NHẬP</span><img id="singup_img" src="../img/Spinner-1s-200px.gif" alt=""></button>
                        </center>
                        <p style="text-align: center; color: red; padding-top: 10px;" id="errLogin"></p>
                    </div>
                    <div id="dacotk" class="font-all-400"><a class="v_form-div-a" href="/quen-mat-khau.html">Quên mật
                            khẩu</a></div>
                    <div id="dangki" class="font-all-400">Nếu bạn chưa đăng ký? <a href="<?php echo $linkSingup; ?>">Đăng
                            ký</a></div>
                </form>
            </div>
        </div>
        <!-- End: content -->

        <!-- Begin: foooter -->
        <?php require_once("../includes/h_inc_footer.php"); ?>
        <!-- End: footer -->
    </div>

    <script type="text/javascript">
    function v_validation() {
        var reEmail = /^[a-zA-Z0-9@.]{1,}$/;
        var email = $("#email").val();
        var password = $("#password").val();
        if (email == "") {
            $("#v_login-1").text("Bạn phải nhập trường này");
            return false;
        } else if(reEmail.test(email) == false || email.lastIndexOf(".") - email.indexOf("@") == 1 || email.indexOf("@") == -1 || email.indexOf(".") == -1 || email.charAt(0) == ' ' || email.charAt(email.length - 1) == ' '){
            $("#v_login-1").text("Sai định dạng email");
            $("#email").focus();
            return false;
        }else if(email.length - 1 == email.lastIndexOf(".")){
            $("#v_login-1").text("Sai định dạng email");
            $("#email").focus();
            return false;
        } else {
            $("#v_login-1").text("");
        }

        if (password == "") {
            $("#v_login-2").text("Bạn phải nhập trường này");
            $("#password").focus();
            return false;
        } else {
            $("#v_login-2").text("");
        }

        $("#login_btn").css('display', 'none');
        $("#taotaikhoan")[0].type = 'button';
        $("#singup_img").css('display', 'block');
        $.ajax({
            url: '../code_xu_ly/v_login.php',
            type: 'POST',
            dataType: 'json',
            data: {
                user_type_login: <?php echo $_COOKIE['user_type_login']; ?>,
                email: email,
                password: password
            },
            success: function(data) {
                $("#login_btn").css('display', 'block');
                $("#singup_img").css('display', 'none');
                if (data.type == 0) {
                    $("#errLogin").text('Tài khoản hoặc mật khẩu không chính xác');
                    $("#taotaikhoan")[0].type = 'submit';
                } else if (data.type == 1) {
                    window.location.href = "/xac-thuc-tai-khoan.html";
                } else if (data.type == 2) {
                    $("#errLogin").text('');
                    window.location.href = data.link;
                }
            },
            error: function() {
                $("#login_btn").css('display', 'block');
                $("#taotaikhoan")[0].type = 'submit';
                $("#singup_img").css('display', 'none');
                alert("Có lỗi xảy ra. Vui lòng thử lại");
            }
        });

        return false;
    }
    </script>
</body>

</html>