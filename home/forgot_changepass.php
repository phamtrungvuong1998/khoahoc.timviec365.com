<?php
require_once '../config/config.php';
$id = getValue('id','int', 'GET','');
$token = getValue('token','str', 'GET','');
$time = getValue('time','int', 'GET','');

if (isset($_COOKIE['user_id']) || isset($_COOKIE['user_type'])) {
    header("Location: /");
}

if (time() > $time + 900) {
    echo 'Đường link không tồn tại';
    die();
}else{
    $qr = new db_query("SELECT user_id, token FROM tokens WHERE user_id = $id");
    if (mysql_num_rows($qr->result) == 0) {
        echo 'Đường link không tồn tại';
        die();
    }else{
        $row = mysql_fetch_array($qr->result);
        if (md5($row['user_id'].$row['token']) != $token) {
            echo 'Đường link không tồn tại';
            die();
        }
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
    <script type="text/javascript" src="../js/v-main.js?v=<?=$version?>"></script>
    <style>
    [id*=v_title_pass-] {
        text-align: center;
        color: red;
    }

    .signup-input-input {
        width: 100%;
    }

    #img_forgot_pass {
        margin: 0 auto;
        display: none;
    }

    #forgotpass3 {
        color: white;
    }
    </style>
    <title>CHange Pass</title>
</head>

<body>
    <div id="main">
        <!-- Begin: header -->
        <?php require_once("../includes/h_inc_header.php"); ?>

        <!-- End: header -->

        <!-- Begin: content -->
        <div onclick="v_dong_qlhv()" id="content-box" class="flex">
            <div id="content" class="forgotpass">
                <form method="POST" action="../code_xu_ly/v_forgot_pass.php" name="v_forgot"
                    onsubmit="return v_forgot_pass();">
                    <div class="signup-input">
                        <center>
                            <input class="signup-input-input" type="password" name="pass" onkeypress="istrim(event)" 
                                placeholder="Nhập Mật khẩu mới">
                            <p id="v_title_pass-1"></p>
                        </center>
                    </div>
                    <div class="signup-input">
                        <center>
                            <input class="signup-input-input" type="password" name="repass" onkeypress="istrim(event)" placeholder="Nhập lại mật khẩu">
                            <p id="v_title_pass-2"></p>
                        </center>
                    </div>
                    <div id="btn-ttk">
                        <center><button name="btn" id="forgotpass2"><img src="../img/Spinner-1s-200px.gif"
                                    id="img_forgot_pass" alt=""><span id="forgotpass3">ĐỔI MẬT KHẨU</span></button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
        <!-- End: content -->

        <!-- Begin: foooter -->
        <?php require_once("../includes/h_inc_footer.php"); ?>
        <!-- End: footer -->
    </div>

    <script type="text/javascript">
        function istrim(evt) {
            var num = String.fromCharCode(evt.which);
            if (num == " ") {
                evt.preventDefault();
            }
        }
    function v_forgot_pass() {
        var v_pass = document.v_forgot.pass.value;
        var v_repass = document.v_forgot.repass.value;
        var rePass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

        if (v_pass == "") {
            document.getElementById('v_title_pass-1').innerText = 'Bạn phải nhập trường này';
            return false;
        } else if (v_pass.length < 8) {
            document.getElementById('v_title_pass-1').innerText = 'Mật khẩu phải trên 8 kí tự';
            return false;
        }else if(rePass.test(v_pass) == false){
            document.getElementById('v_title_pass-1').innerText = 'Mật khẩu phải chứa 1 chữ, 1 số và không chứa khoảng trắng';
            return false;
        }else{
            document.getElementById('v_title_pass-1').innerText = '';
        }

        if (v_pass != v_repass) {
            document.getElementById('v_title_pass-2').innerText = 'Nhập lại mật khẩu không đúng';
            return false;
        }else {
            document.getElementById('v_title_pass-2').innerText = '';
            $("#forgotpass3").css('display', 'none');
            $("#img_forgot_pass").css('display', 'block');
            $('#forgotpass2')[0].type = 'button';
            $.ajax({
                url: '../code_xu_ly/v_forgot_pass.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: <?php echo $id; ?>,
                    password: v_pass
                },
                success: function(data) {
                    alert('Đổi mật khẩu thành công');
                    $("#forgotpass3").css('display', 'block');
                    $("#img_forgot_pass").css('display', 'none');
                    $('#forgotpass2')[0].type = 'submit';
                    window.location.href = "/dang-nhap.html";
                },
                error: function() {
                    $("#forgotpass3").css('display', 'block');
                    $("#img_forgot_pass").css('display', 'none');
                    $('#forgotpass2')[0].type = 'submit';
                    alert("Có lỗi xảy ra. Vui lòng thử lại")
                }
            });

        }
        return false;
    }
    </script>
</body>

</html>