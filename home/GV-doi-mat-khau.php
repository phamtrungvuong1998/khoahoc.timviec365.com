<?php
require_once '../code_xu_ly/h_manager_GV.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <link rel="stylesheet" href="../css/select2.min.css?v=<?=$version?>" />
    <?php require_once '../includes/v_inc_GV_css.php'; ?>
    <link rel="stylesheet" href="../css/GV-cap-nhat-thong-tin.css?v=<?=$version?>">
    <script src="../../js//v-main.js?v=<?=$version?>"></script>
    <style>
    #v_thong-tin-tk {
        color: #1B6AAB;
    }

    #v_sidebar-tb-5 {
        display: block;
    }

    #v_doi_mat_khau_gv {
        color: #1B6AAB;
    }

    .v_form {
        padding-left: 200px;
        padding-right: 200px;
        padding-top: 50px;
        display: block;
    }

    @media(max-width:480px) {
        .v_form {
            padding: 0
        }
    }
    </style>
    <title>Cập nhật thông tin</title>
</head>

<body>
    <div id="v_wrapper" class="flex">
        <!-- Begin: sidebar -->
        <?php require_once '../includes/inc_GV_sidebar.php'; ?>
        <!-- End: sidebar -->

        <!-- Begin: main -->
        <div id="main">
            <!-- Begin: header -->
            <?php require_once '../includes/inc_GV_manager_header.php'; ?>
            <!-- End: header -->

            <!-- Begin: content -->
            <div id="v_content-box">
                <div id="v_content">
                    <form onsubmit="return validation()" enctype="multipart/form-data">
                        <div class="v_form">
                            <div class="v_form-input-1">
                                <label>Mật khẩu hiện tại</label>
                                <div><input type="password" name="pass" id="pass0" onkeypress="istrim(event)">
                                </div>
                            </div>
                            <div class="v_form-input-1">
                                <label>Mật khẩu mới</label>
                                <div><input type="password" name="pass1" id="pass1" onkeypress="istrim(event)">
                                </div>
                            </div>
                            <div class="v_form-input-1">
                                <label>Nhập lại mật khẩu mới</label>
                                <div><input type="password" name="pass2" id="pass2" onkeypress="istrim(event)"></div>
                            </div>
                            <center class="v_form-btn"><button name="btn">CẬP NHẬP</button></center>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End: content -->

        </div>
        <!-- End: main -->
    </div>
    </div>

    <!-- Begin: foooter -->
    <?php require_once '../includes/h_inc_footer.php'; ?>
    <!-- End: footer -->
    <script src="../js/v-main.js?v=<?=$version?>"></script>
    <script>
        function istrim(evt) {
            var num = String.fromCharCode(evt.which);
            if (num == " ") {
                evt.preventDefault();
            }
        }

    function validation() {
        var pass0 = $('#pass0').val();
        var pass1 = $('#pass1').val();
        var pass2 = $('#pass2').val();
        var rePass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

        if (pass0 == "") {
             alert('Vui lòng nhập mật hiện tại');
             return false;
        }

        if (pass1 == '') {
            alert('Vui lòng nhập mật khẩu mới');
            return false;
        } else if (pass1.length < 8) {
            alert('mật khẩu phải lớn hơn 8 ký tự');
            return false;
        } else if (rePass.test(pass1) == false) {
            alert('mật khẩu phải chứa chữ và số');
            return false;
        }

        if (pass2 == '') {
            alert('Vui lòng nhập lại mật khẩu');
            return false;
        }

        if (pass1 != pass2) {
            alert('Mật khẩu nhập lại không chính xác');
            return false;
        }

        $.ajax({
            url: '../ajax/v_ajax_gv_update_pass.php',
            type: 'POST',
            dataType: 'json',
            data: {
                pass1: pass1,
                pass0: pass0
            },
            success: function (data) {
                if (data.result == 0) {
                    alert("Mật khẩu hiện tại không đúng");
                }else{
                    alert('Cập nhật mật khẩu thành công');
                    $('#pass0').val("");
                    $('#pass1').val("");
                    $('#pass2').val("");
                }
            },
            error: function () {
                alert("Có lỗi xảy ra. Vui lòng thử lại");
            }

        });
        
        return false;
    }
    </script>
</body>

</html>