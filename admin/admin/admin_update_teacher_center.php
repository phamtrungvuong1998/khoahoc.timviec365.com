<?php
require_once '../includes/Admin_insert.php';

$center_id = getValue('id', 'int', 'GET', 0, 0);
if ($center_id == 0) {
    header('location: admin_teacher_center.php');
}
$db_user = new db_query("SELECT * FROM users where user_type = 3");
$db_cat = new db_query("SELECT * FROM categories");
$db_teacher = new db_query("SELECT * FROM user_center_teacher Where center_teacher_id = '$center_id'");
$row_teacher = mysql_fetch_assoc($db_teacher->result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cập nhật trung tâm</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
        #action2 {
            display: block;
        }

        /* #create_student {
            background: #18191b;
            border-left: 8px solid #13895F;
        } */

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

        .l_flex {
            display: flex;
            justify-content: space-around;
        }

        .l_width {
            width: 100%;
        }

        .l_city {
            width: 20%;
            text-align: left;
        }

        .city1 {

            text-align: left;
        }

        #l_gioithieu {
            width: 100%;
        }

        .select2-container {
            width: 60% !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
            background: no-repeat;
            border-radius: 10px;
        }

        .select2-container--default .select2-selection--single {
            height: 45px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            float: right;
            margin-left: 10px;
            color: #1B6AAB;
            border-radius: 100px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            padding: 4px 4px 4px 8px;
            border: none;
            border-radius: 16px;
            color: #1B6AAB;
            margin-right: 10px;
        }

        .select2-container--default .select2-selection--multiple {
            width: 100%;
            height: 192px;
            border: 1px solid #0000001F;
            border-radius: 8px;
            padding-top: 16px;
            padding-left: 15px;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: 1px solid rgba(0, 0, 0, 0.12) !important;
        }

        .select2-container--open .select2-dropdown {
            left: 0px;
            top: 3px;
        }

        .l_padding {
            padding-bottom: 100px !important;
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
    </style>
</head>

<body>
    <!-- Left column -->
    <div class="templatemo-flex-row">
        <?php require_once '../includes/Admin_sidebar.php'; ?>
        <!-- Main content -->
        <div class="templatemo-content col-1 light-gray-bg">
            <?php require_once '../includes/Admin_nav.php'; ?>
            <div id="alert"></div>
            <center id="v_info_ad">
                <form onsubmit="validate_update_center(<? echo $row_teacher['center_teacher_id'] ?>); return false;">
                    <div class="v_detail_student">
                        <div>Họ tên giảng viên:</div>
                        <div><input type="text" value="<? echo $row_teacher['teacher_name']; ?>" id="teacher_name" name="center_name" required></div>
                    </div>
                    <p id="l_error1" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Môn học giảng dạy:</div>
                        <select name="l_monhoc[]" id="l_monhoc" multiple >
                            <?
                            $a = explode(',',$row_teacher['cate_id']);
                            while ($row = mysql_fetch_assoc($db_cat->result)) {
                            ?>
                                <option
                                <?
                                foreach ($a as $value) {
                                    if ($value == $row['cate_id']) {
                                        echo 'selected';
                                    }
                                }
                                ?>
                                 value="<? echo $row['cate_id'] ?>"><? echo $row['cate_name'] ?></option>
                            <?
                            }
                            ?>

                        </select>
                    </div>
                    <p id="l_error2" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Bằng cấp chứng chỉ:</div>
                        <div><input type="text" value="<? echo $row_teacher['qualification']; ?>" name="l_bangcap" id="l_bangcap" required></div>

                    </div>
                    <p id="l_error3" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Ngày tham gia:</div>
                       
                        <div><input type="date" value="<? echo date('Y-m-d',$row_teacher['date_join']);?>" id="date_join" name="date_join" required></div>

                    </div>
                    <p id="l_error4" class="l_error"></p>
                    <!-- <div class="v_detail_student">
                        <div>Trung tâm giảng dạy:</div>
                        <select name="l_center[]" id="l_center">
                            </?
                            while ($row = mysql_fetch_assoc($db_user->result)) {
                            ?>
                                <option
                                </?
                                if ($row_teacher['user_id'] == $row['user_id']) {
                                    echo 'selected';
                                }
                                ?>
                                 value="</? echo $row['user_id'] ?>"></? echo $row['user_name'] ?></option>
                            </?
                            }
                            ?>

                        </select>
                    </div> -->
                    <p id="l_error5" class="l_error"></p>
                    
                    
                    <div class="l_padding"><button onclick="validate_update_center(<? echo $row_teacher['center_teacher_id'] ?>); return false;" type="button" name="create_student" id="update_student">Cập nhật</button></div>
                </form>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $("#l_monhoc").select2();
    $("#l_center").select2();
        $("#l_chude").select2();
    });

    function validate_update_center(a) {
        // var flag = l_validate();
        // if (flag == true) {
             var name = document.getElementById('teacher_name').value;
            var l_bangcap = document.getElementById('l_bangcap').value;
            var date_join = document.getElementById('date_join').value;
            // var center_thue = document.getElementById('center_thue').value;
            // // var city = document.getElementById('center_city').value;
            // // var district = document.getElementById('center_district').value;
            // // var address = document.getElementById('center_address').value;
            // var l_gioithieu = document.getElementById('l_gioithieu').value;
            // var l_link = document.getElementById('l_link').value;
            // var l_chude = document.getElementById('l_chude').value;

            var data = new FormData();
            data.append('id', a);
            data.append('name', name);
            data.append('l_bangcap', l_bangcap);
            data.append('date_join', date_join);

            var l_monhoc = [];
            $('#l_monhoc :selected').each(function() {
                l_monhoc.push($(this).val());
            });
            data.append('l_monhoc', l_monhoc);

            $.ajax({
                url: '../ajax/admin_update_teacher_center.php',
                type: "post",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.result == true) {
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                $(".alert-success").remove();
                            });
                        }, 3000);
                    } else {
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                $(".alert-success").remove();
                            });
                        }, 3000);
                    }
                },
            });
        }
    // }
</script>
<?php require_once '../includes/Admin_permission.php'; ?>

</html>