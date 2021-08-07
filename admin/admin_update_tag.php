<?php
require_once '../includes/Admin_insert.php';
$tag_id = getValue('id', 'int', 'GET', '', '');
$type = getValue('type', 'int', 'GET', '', '');
if ($tag_id == 0 || $type == 0) {
        header("location:admin_list_tags_on.php");
}
if($type == 2){
    $db_tag = new db_query("SELECT tag_name,content_on,title_suggest_on,content_suggest_on FROM tags WHERE tag_id = $tag_id");
    $row_tag = mysql_fetch_assoc($db_tag->result);
    $tag_name = $row_tag['tag_name'];
    $content = $row_tag['content_on'];
    $title_suggest = $row_tag['title_suggest_on'];
    $content_suggest = $row_tag['content_suggest_on'];
}else if ($type == 1) {
    $db_tag = new db_query("SELECT tag_name,content_off,title_suggest_off,content_suggest_off FROM tags WHERE tag_id = $tag_id");
    $row_tag = mysql_fetch_assoc($db_tag->result);
    $tag_name = $row_tag['tag_name'];
    $content = $row_tag['content_off'];
    $title_suggest = $row_tag['title_suggest_off'];
    $content_suggest = $row_tag['content_suggest_off'];
}else{
    $db_tag = new db_query("SELECT tag_name,content_off,title_suggest_off,content_suggest_off FROM tags WHERE tag_id = $tag_id");
    $row_tag = mysql_fetch_assoc($db_tag->result);
    $tag_name = $row_tag['tag_name'];
    $content = $row_tag['content_off'];
    $title_suggest = $row_tag['title_suggest_off'];
    $content_suggest = $row_tag['content_suggest_off'];
}

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
            <!-- action="../ajax/admin_create_post.php" method="POST" -->
                <form onsubmit="validate_update_center(<? echo $tag_id; ?>,<? echo $type; ?>);">
                    <div class="v_detail_student">
                        <!-- <div>Tên lĩnh vực giảng dạy:</div> -->
                        <!-- <div>
                            <select name="cate_id" id="cate">
                                <option value="">--Chọn lĩnh vực giảng dạy--</option>
                                </?
                                $db_cate = new db_query("SELECT * FROM categories");
                                while ($row = mysql_fetch_assoc($db_cate->result)) {
                                ?>
                                    <option value="</? echo $row['cate_id'] ?>"></? echo $row['cate_name'] ?></option>
                                </?
                                }
                                ?>
                            </select>
                        </div> -->
                    </div>
                    <!-- <p id="l_error1" class="l_error"></p> -->
                    <div class="v_detail_student">
                        <div>Tên Môn học chi tiết:</div>
                        <div>
                            <!-- <select name="tag_id" id="tags">
                                <option value="">--Chọn Môn học chi tiết--</option>
                                </?
                                $db_cate = new db_query("SELECT * FROM categories");
                                while ($row = mysql_fetch_assoc($db_cate->result)) {
                                ?>
                                    <option value="</? echo $row['cate_id'] ?>"></? echo $row['cate_name'] ?></option>
                                </?
                                }
                                ?>
                            </select> -->

                            <input type="text" name="title" value="<? echo $tag_name ?>" id="title" readonly>

                        </div>
                    </div>
                    <!-- <p id="l_error2" class="l_error"></p> -->
                    <div class="v_detail_student">
                        <div>Nội dung:</div>
                        <div>
                            <textarea name="content" id="content" cols="" rows=""><? echo $content ?></textarea>
                        </div>
                    </div>
                    <p id="l_error1" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Tiêu đề liên quan:</div>
                        <div>
                            <input type="text" name="title" value="<? echo $title_suggest ?>" id="title_suggest">
                        </div>
                    </div>
                    <p id="l_error2" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Nội dung liên quan:</div>
                        <div>
                            <textarea name="content_suggest" id="content_suggest" cols="" rows=""><? echo $content_suggest ?></textarea>
                        </div>
                    </div>
                    <p id="l_error3" class="l_error"></p>
                    <div><button onclick="validate_update_center(<? echo $tag_id; ?>,<? echo $type; ?>);" type="button" name="create_student" id="update_student">Cập nhật</button></div>
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
        $("#cate").select2();
        $("#tags").select2();
        $("#cate").change(function() {
            var a = $("#cate").val();
            $.get('../ajax/admin_load_tags.php', {
                cate_id: a
            }, function(data) {
                $("#tags").html(data);
            });
        });
    });
    function l_validate() {
        var flag = false;
        var title_suggest = $("#title_suggest").val();
        var content= CKEDITOR.instances.content.getData();
        var content_suggest= CKEDITOR.instances.content_suggest.getData();
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

    function validate_update_center(a,type) {
        var flag = l_validate();
        if (flag == true) {
        var title_suggest = $("#title_suggest").val();
        var content= CKEDITOR.instances.content.getData();
        var content_suggest= CKEDITOR.instances.content_suggest.getData();
        // var type = 2;
        // console.log(type);
        // return false;
        var data = new FormData();
        data.append('tag_id', a);
        data.append('title_suggest', title_suggest);
        data.append('content', content);
        data.append('content_suggest', content_suggest);
        data.append('type', type);

        $.ajax({
            url: '../ajax/admin_create_post.php',
            type: "post",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.result == true) {
                    alert(response.message);
                }else {
                    alert(response.message);
                }
            },
        });
        }
    }
</script>
<!-- </?php require_once '../includes/Admin_permission.php'; ?> -->

</html>