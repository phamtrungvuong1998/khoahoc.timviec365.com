<?php
require_once '../includes/Admin_insert.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm trung tâm</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
        #action4 {
            display: block;
        }

        #create_4 {
            background: #18191b;
            border-left: 8px solid #13895F;
        }

        #title_manager {
            width: 100%;
        }

        [id*=admin_edit] {
            cursor: pointer;
            width: 12px;
            height: 12px;
            margin: 0;
            padding: 0;
            border: 0;
            outline: 0;
            font-weight: inherit;
            font-style: inherit;
            vertical-align: baseline;
        }

        #v_info_ad {
            display: block;
        }

        .v_detail_student {
            display: flex;
            padding-bottom: 20px;
        }

        .v_detail_student>div:first-child {
            flex-basis: 20%;
            text-align: left;
        }

        .v_detail_student>div:last-child {
            flex-basis: 60%;
        }

        .v_detail_student>div:last-child>input,
        .v_detail_student>div:last-child>select {
            width: 100%;
        }

        #update_student {
            border: none;
            background: orange;
            color: white;
            padding: 2px 10px;
        }

        .city {
            flex-basis: 20% !important;
        }

        .l_error {
            color: red;
        }
    </style>
</head>

<body>
    <!-- Left column -->
    <div class="templatemo-flex-row">
        <?php require_once '../includes/Admin_sidebar.php'; ?>
        <!-- Main content -->
        <div class="templatemo-content col-1 light-gray-bg">
            <?php require_once '../includes/Admin_nav.php'; ?>
            <center id="v_info_ad">
                <form onsubmit="validate_update_center(); return false;">
                    <div class="v_detail_student">
                        <div>Tên lĩnh vực:</div>
                        <div><input type="text" id="cate_name" name="center_name" required></div>
                    </div>
                    <p id="l_error1" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Thêm icon lĩnh vực:</div>
                        <div><input type="file" id="cate_icon" name="center_email" required></div>
                    </div>
                    <p id="l_error2" class="l_error"></p>
                    <div><button onclick="validate_update_center(); return false;" type="button" name="create_student" id="update_student">Thêm mới</button></div>
                </form>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript">
    function l_validate() {
        var flag = false;
        var user = document.getElementById('cate_name').value;
        var email = document.getElementById('cate_icon').value;

        if (user == "") {
            document.getElementById("l_error1").innerHTML = "Bạn chưa nhập tên trung tâm";
            document.getElementById('center_name').focus();
            return false;
        } else {
            document.getElementById("l_error1").innerHTML = '';
            flag = true;
        }

        // if (arr.includes($('#center_email').val()) === true) {
        //     document.getElementById("l_error2").innerHTML = "Email đã tồn tại";
        //     document.getElementById('center_email').focus();
        //     return false;
        // } else if (email == "") {
        //     document.getElementById("l_error2").innerHTML = "Bạn chưa nhập email";
        //     document.getElementById('center_email').focus();
        //     return false;
        // } else {
        //     document.getElementById("l_error2").innerHTML = '';
        //     flag = true;
        // }
        return flag;
    }

    function validate_update_center() {
        // console.log('123123');
        var flag = l_validate();
        if (flag == true) {
            var user = document.getElementById('cate_name').value;
            var data = new FormData();
            var avatar = $('#cate_icon')[0].files[0];
            data.append('file', avatar);
            data.append('cate_name', user);

            $.ajax({
                url: '../ajax/admin_create_category.php',
                type: "post",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.result == 1) {
                        $('#l_error1').html('');
                        $('#l_error1').html(response.message);
                        // console.log(response.message)
                        // alert(response.message);
                        // window.location.href = 'tt_dsgiangvien.php?page=' + response.pagenew;
                    } else if (response.result == 2) {
                        $('#cate_name').val('');
                        $('#cate_icon').val('');
                        alert(response.message)
                    }else{
                        alert(response.message);
                    }
                },
            });
        }
    }
</script>
<?php require_once '../includes/Admin_permission.php'; ?>

</html>