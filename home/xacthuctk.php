<?php
require_once '../config/config.php';

if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_type'])){
    $cookie_id = $_COOKIE['user_id'];
    $cookie_type = $_COOKIE['user_type'];
    $db = new db_query("SELECT * FROM users WHERE user_id = '$cookie_id'");
    $row = mysql_fetch_array($db->result);
}else{
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
    <link rel="stylesheet" href="../css/xacthuctk.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_footer.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_header-home.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/custom-bootstrap.css?v=<?=$version?>">
    <script type="text/javascript" src="../js/v-main.js?v=<?=$version?>"></script>
    <title>Xác thực tài khoản</title>
</head>

<body>
    <div id="main">
        <!-- Begin: header -->
        <?php require_once("../includes/h_inc_header.php"); ?>
        <!-- End: header -->

        <!-- Begin: content -->
        <div id="content-box" class="flex">
            <div id="content">
                <div id="img-xacthuc">
                    <center><img src="../img/xac-thuc.svg" alt="Ảnh lỗi"></center>
                </div>
                <div id="xacthuc-title" class="font-all-400">Xác thực tài khoản </div>
                <div id="xacthuc-text" class="font-all-400">Vui lòng kiểm tra email và làm theo hướng dẫn để xác thực
                    Email. Nếu bạn chưa nhận được email xác thực, hãy bấm vào nút “ <a>Gửi lại Email xác thực</a>
                ” dưới đây:</div>
                <div id="btn-xacthuc" class="font-all-700">
                    <form>
                        <center><button name="btn" type="button" id="xacthuctk_btn" onclick="v_reload()"><a id="xacthuc_a">Gửi
                        email xác thực</a><img id="singup_img" src="../img/Spinner-1s-200px.gif" alt=""></button></center>
                    </form>

                </div>
            </div>
        </div>
        <!-- End: content -->

        <!-- Begin: foooter -->
        <?php require_once("../includes/h_inc_footer.php"); ?>
        <!-- End: footer -->
    </div>
</body>
<script type="text/javascript">
    function v_reload() {
        $("#xacthuc_a").css('display', 'none');
        $("#xacthuctk_btn")[0].type = 'button';
        $("#singup_img").css('display', 'block');
        $.ajax({
            url: '../code_xu_ly/v_gui-lai-email.php',
            type: 'POST',
            dataType: 'json',
            data: {
                id: <?php echo $_COOKIE['user_id']; ?>,
            },
            success: function(data) {
                $("#xacthuc_a").css('display', 'block');
                $("#xacthuctk_btn")[0].type = 'submit';
                $("#singup_img").css('display', 'none');
                if (data.type == 1) {
                    alert("Link xác thực đã được gửi lại. Vui lòng kiểm tra email");
                } else {
                    alert("Link không tồn tại");
                }
            },
            error: function () {
                $("#xacthuc_a").css('display', 'block');
                $("#xacthuctk_btn")[0].type = 'submit';
                $("#singup_img").css('display', 'none');
                alert("Có lỗi xảy ra. Vui lòng thử lại");
            }
        });

    }
</script>

</html>