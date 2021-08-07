<?php
if (isset($_COOKIE['user_id']) || isset($_COOKIE['user_type'])) {
    header("Location: /");
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
    <script type="text/javascript" src="../js/v-main.js?v=<?=$version?>"></script>
    <style>
        #send_mail{
            color: white;
        }

        #img_send_mail{
            display: none;
            margin: 0 auto;
        }
    </style>
    <title>Forgot Pass</title>
</head>

<body>
    <div id="main">
        <!-- Begin: header -->
        <?php require_once("../includes/h_inc_header.php"); ?>

        <!-- End: header -->

        <!-- Begin: content -->
        <div onclick="v_dong_qlhv()" id="content-box" class="flex">
            <div id="content" class="forgotpass">
                <form name="v_forgot_pass" onsubmit="return v_validation();" method="POST">
                    <div class="signup-input">
                        <center id="pforgotpass">Vui lòng nhập địa chỉ email của bạn. Bạn sẽ nhận được một liên kết để
                            tạo mật khẩu mới
                            qua email.
                        </center>
                    </div>
                    <div class="signup-input">
                        <center><input class="signup-input-input inpforgot" id="v_email" name="mail" type="email" placeholder="Nhập Email"></center>
                        <p id="v-forgot-title" style="color: red;"></p>
                    </div>
                    <div id="btn-ttk">
                        <center><button type="submit" name="submit" id="forgotpass2"><img src="../img/Spinner-1s-200px.gif" id="img_send_mail" alt=""><span id="send_mail">Gửi về Mail</span></button></center>
                    </div>
                </form>
            </div>
        </div>
        <!-- End: content -->

        <!-- Begin: foooter -->
        <?php require_once("../includes/h_inc_footer.php"); ?>
        <!-- End: footer -->
    </div>
</body>

<script type="text/javascript">
    function v_validation() {
        var v_mail = document.v_forgot_pass.mail.value;
        if (v_mail == "") {
            document.getElementById('v-forgot-title').innerText = "Bạn phải nhập trường này";
            return false;
        } else {
            $('#img_send_mail').css('display', 'block');
            $('#send_mail').css('display', 'none');
            $('#forgotpass2')[0].type = 'button';
            $.ajax({
                url: '../code_xu_ly/v_quen_mk.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    email: v_mail,
                    user_type: <?php echo $_COOKIE['user_type_login']; ?>
                },
                success: function(data) {
                    if (data.type == 0) {
                        $("#v-forgot-title").text('Email chưa đăng kí');
                    } else if (data.type == 1) {
                        $("#v_email").val("");
                        alert("Email đổi mật khẩu đã được gửi. Vui lòng kiểm tra email của bạn");
                    }
                    $('#img_send_mail').css('display', 'none');
                    $('#send_mail').css('display', 'block');
                    $('#forgotpass2')[0].type = 'submit';
                },
                error: function () {
                    alert('Có lỗi xảy ra. Vui lòng thử lại');
                    $('#img_send_mail').css('display', 'none');
                    $('#send_mail').css('display', 'block');
                    $('#forgotpass2')[0].type = 'submit';
                }
            });

        }
        return false;
    }
</script>

</html>