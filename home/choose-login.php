<?php 
if (isset($_COOKIE['user_id'])) {
    header("Location:/");
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
    <title>Lựa chọn đăng nhập</title>
</head>

<body>
    <div id="main">
        <!-- Begin: header -->
        <?php require_once("../includes/h_inc_header.php"); ?>

        <!-- End: header -->

        <div id="banner">
            <div class="container">
                <div class="object">
                    <center class="object1">
                        <img src="../img/imglogin1.png">
                    </center>
                    <div class="object2">
                        <ul>
                            <li><img src="../img/checkyellow.png">Tạo thu nhập thụ động</li>
                            <li><img src="../img/checkyellow.png">Nâng cao kỹ năng giảng dạy</li>
                            <li><img src="../img/checkyellow.png">Hỗ trợ nội dung</li>
                            <li><img src="../img/checkyellow.png">Hỗ trợ kỹ thuật</li>
                        </ul>
                    </div>
                    <div class="object3">
                        <a data-set="2" class="v_login">GIẢNG VIÊN</a>
                    </div>
                </div>
                <div class="object">
                    <center class="object1">
                        <img src="../img/imglogin2.png">
                    </center>
                    <div class="object2">
                        <ul>
                            <li><img src="../img/checkyellow.png">Tạo thu nhập thụ động</li>
                            <li><img src="../img/checkyellow.png">Nâng cao kỹ năng giảng dạy</li>
                            <li><img src="../img/checkyellow.png">Hỗ trợ nội dung</li>
                            <li><img src="../img/checkyellow.png">Hỗ trợ kỹ thuật</li>
                        </ul>
                    </div>
                    <div class="object3">
                        <a data-set="3" class="v_login">TRUNG TÂM</a>
                    </div>
                </div>

                <div class="object ob3">
                    <center class="object1">
                        <img src="../img/imglogin3.png">
                    </center>
                    <div class="object2">
                        <ul>
                            <li><img src="../img/checkyellow.png">Mua 1 lần sử dụng trọn đời</li>
                            <li><img src="../img/checkyellow.png">Được update nội dung liên tục</li>
                            <li><img src="../img/checkyellow.png">Hỗ trợ nội dung</li>
                            <li><img src="../img/checkyellow.png">Hỗ trợ kỹ thuật</li>
                        </ul>
                    </div>
                    <div class="object3">
                        <a data-set="1" class="v_login">HỌC VIÊN</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Begin: foooter -->
        <?php require_once("../includes/h_inc_footer.php"); ?>
        <!-- End: footer -->
    </div>

</body>
<script type="text/javascript">
$(document).ready(function() {
    $(".v_login").click(function() {
        if ($(this)[0].dataset.set == 2) {
            document.cookie = "user_type_login=2; path=/dang-nhap.html;";
            document.cookie = "user_type_login=2; path=/quen-mat-khau.html;";
        } else if ($(this)[0].dataset.set == 1) {
            document.cookie = "user_type_login=1; path=/dang-nhap.html";
            document.cookie = "user_type_login=1; path=/quen-mat-khau.html";
        } else if ($(this)[0].dataset.set == 3) {
            document.cookie = "user_type_login=3; path=/dang-nhap.html";
            document.cookie = "user_type_login=3; path=/quen-mat-khau.html";
        }

        window.location.href = '/dang-nhap.html';
    });
});
</script>

</html>