<?php
require_once '../includes/Admin_insert.php';

// $content = getValue('content','str','POST','');
// var_dump($content);
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
                <form action="../ajax/admin_create_post.php" method="POST" onsubmit="validate_update_center();">
                    <div class="v_detail_student">
                        <div>Tên lĩnh vực giảng dạy:</div>
                        <div>
                            <select name="cate_id" id="cate">
                                <option value="">--Chọn lĩnh vực giảng dạy--</option>
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
                    <p id="l_error1" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Tên Môn học chi tiết:</div>
                        <div>
                            <select name="tag_id" id="tags">
                                <option value="">--Chọn Môn học chi tiết--</option>
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
                    <p id="l_error2" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Nội dung:</div>
                        <div>
                            <textarea name="description" id="description" cols="" rows=""></textarea>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tiêu đề liên quan:</div>
                        <div>
                            <input type="text" name="title" id="title">
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Nội dung liên quan:</div>
                        <div>
                            <textarea name="content" id="content" cols="" rows=""></textarea>
                        </div>
                    </div>
                    <p id="l_error3" class="l_error"></p>
                    <div><button type="submit" name="create_student" id="update_student">Thêm mới</button></div>
                </form>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('description');
    CKEDITOR.replace('content');
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
    // function l_validate() {
    //     var flag = false;
    //     var user = document.getElementById('cate_name').value;
    //     var email = document.getElementById('cate_icon').value;

    //     if (user == "") {
    //         document.getElementById("l_error1").innerHTML = "Bạn chưa nhập tên trung tâm";
    //         document.getElementById('center_name').focus();
    //         return false;
    //     } else {
    //         document.getElementById("l_error1").innerHTML = '';
    //         flag = true;
    //     }
    //     return flag;
    // }

    function validate_update_center() {
        // console.log('123123');
        // var flag = l_validate();
        // if (flag == true) {
            // var a = $("#cate").val();
            // var b = $("#tags").val();
            // // var des = document.getElementsByName('text');
            // // console.log(des);
            // var title = $("#title").val();
            // var content = $("#content").val();
            // var des = $("#description").val();
            // var data = new FormData();
            // data.append('cate_id', a);
            // data.append('tags_id', b);
            // data.append('description', des);
            // data.append('title', title);
            // data.append('content', content);

            // $.ajax({
            //     url: '../ajax/admin_create_post.php',
            //     type: "post",
            //     data: data,
            //     dataType: 'json',
            //     contentType: false,
            //     processData: false,
            //     success: function(response) {
            //         if (response.result == 1) {
            //             // $('#l_error1').html('');
            //             // $('#l_error1').html(response.message);
            //             // console.log(response.message)
            //             // alert(response.message);
            //             // window.location.href = 'tt_dsgiangvien.php?page=' + response.pagenew;
            //         } else if (response.result == 2) {
            //             // $('#cate_name').val('');
            //             // $('#cate_icon').val('');
            //             // alert(response.message)
            //         } else {
            //             // alert(response.message);
            //         }
            //     },
            // });
        // }
    }
</script>
<!-- </?php require_once '../includes/Admin_permission.php'; ?> -->

</html>