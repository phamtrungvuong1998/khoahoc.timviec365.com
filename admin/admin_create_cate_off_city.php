<?php
require_once '../includes/Admin_insert.php';
// $cit_id = getValue('id', 'int', 'GET', '', '');
// // $type = getValue('type', 'int', 'GET', '', '');
// if ($cit_id == 0) {
//     header("location:admin_list_post_off_city.php");
// }

// $db_city = new db_query("SELECT * FROM city WHERE cit_id = '$cit_id'");
// $row_city = mysql_fetch_assoc($db_city->result);

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
                <form onsubmit="validate_update_center();">
                    <div class="v_detail_student">
                        <div>Môn học:</div>
                        <div>
                            <select name="tag_id" id="tags">
                                <option value="">--Chọn môn học-</option>
                                <?
                                $db_cate = new db_query("SELECT * FROM categories");
                                while ($row = mysql_fetch_assoc($db_cate->result)) {
                                ?>
                                    <option value="<? echo $row['cate_id'] ?>"><? echo $row['cate_name'] ?></option>
                                <?
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <p id="l_error5" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Tên Tỉnh thành:</div>
                        <div>
                            <select name="tag_id" id="city">
                                <option value="">--Chọn tỉnh thành--</option>
                                <?
                                $db_cate = new db_query("SELECT * FROM city");
                                while ($row = mysql_fetch_assoc($db_cate->result)) {
                                ?>
                                    <option value="<? echo $row['cit_id'] ?>"><? echo $row['cit_name'] ?></option>
                                <?
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <p id="l_error4" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Nội dung:</div>
                        <div>
                            <textarea name="content" id="content" cols="" rows=""></textarea>
                        </div>
                    </div>
                    <p id="l_error1" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Tiêu đề liên quan:</div>
                        <div>
                            <input type="text" name="title" value="<? ?>" id="title_suggest">
                        </div>
                    </div>
                    <p id="l_error2" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Nội dung liên quan:</div>
                        <div>
                            <textarea name="content_suggest" id="content_suggest" cols="" rows=""><? ?></textarea>
                        </div>
                    </div>
                    <p id="l_error3" class="l_error"></p>
                    <div><button onclick="validate_update_center();" type="button" name="create_student" id="update_student">Tạo tin đăng</button></div>
                </form>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../ckeditor/config.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('content');
    CKEDITOR.replace('content_suggest');
    $(document).ready(function() {
        $("#city").select2();
        $("#tags").select2();
    });

    function l_validate() {
        var flag = false;
        var title_suggest = $("#title_suggest").val();
        var content = CKEDITOR.instances.content.getData();
        var content_suggest = CKEDITOR.instances.content_suggest.getData();
        var city = document.getElementById('city').value;
        var tag = document.getElementById('tags').value;
        if (city == "") {
            document.getElementById("l_error5").innerHTML = "Chọn tỉnh thành";
            document.getElementById('city').focus();
            return false;
        } else {
            document.getElementById("l_error5").innerHTML = '';
            flag = true;
        }
        if (tag == "") {
            document.getElementById("l_error4").innerHTML = "Chọn môn học";
            document.getElementById('tags').focus();
            return false;
        } else {
            document.getElementById("l_error4").innerHTML = '';
            flag = true;
        }
        if (content == "") {
            document.getElementById("l_error1").innerHTML = "Nhập nội dung bài viết";
            document.getElementById('content').focus();
            return false;
        } else {
            document.getElementById("l_error1").innerHTML = '';
            flag = true;
        }

        if (title_suggest == "") {
            document.getElementById("l_error2").innerHTML = "Nhập tiêu đề liên quan";
            document.getElementById('title_suggest').focus();
            return false;
        } else {
            document.getElementById("l_error2").innerHTML = '';
            flag = true;
        }

        if (content_suggest == "") {
            document.getElementById("l_error3").innerHTML = "Nhập nội dung liên quan";
            document.getElementById('content_suggest').focus();
            return false;
        } else {
            document.getElementById("l_error3").innerHTML = '';
            flag = true;
        }


        return flag;
    }

    function validate_update_center() {
        var flag = l_validate();
        if (flag == true) {
            var title_suggest = $("#title_suggest").val();
            var content = CKEDITOR.instances.content.getData();
            var content_suggest = CKEDITOR.instances.content_suggest.getData();
            var city = document.getElementById('city').value;
            var tag = document.getElementById('tags').value;
            var data = new FormData();
            data.append('cit_id', city);
            data.append('cate_id', tag);
            data.append('title_suggest', title_suggest);
            data.append('content', content);
            data.append('content_suggest', content_suggest);
            $.ajax({
                url: '../ajax/admin_create_cate_off_city.php',
                type: "post",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.result == 1) {
                        alert('Tin môn học tại tỉnh thành đã tồn tại');
                    } else if (response.result == 2) {
                        alert('Đăng tin thành công');
                    window.location.href = 'admin_list_category_off_city.php';
                    }else {
                        alert('Đăng tin thất bại');
                    }
                },
            });
        }
    }
</script>

</html>