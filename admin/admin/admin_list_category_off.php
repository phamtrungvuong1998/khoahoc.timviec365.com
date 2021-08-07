<?php
require_once '../includes/Admin_insert.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danh sách học viên</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
        #action2 {
            display: block;
        }

        #list_sudent {
            background: #18191b;
            border-left: 8px solid #13895F;
        }

        #title_manager {
            width: 100%;
        }

        [id*=admin_edit],
        [id*=remove] {
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

        .l_img {
            width: 35px;
        }

        .l_cuson {
            cursor: pointer;
        }

        .l_click {
            background: white;
        }

        .l_address {
            width: 234px;
            height: 30px;
            padding: 3px 5px;
            border-radius: 10px;
        }

        .l_phantrang {
            clear: left;
            text-align: center;
            padding: 18px 0px 20px;
        }

        .l_phantrang_btn {
            margin-right: 10px;
            padding: 6px 12px;
            background: no-repeat;
            outline: none;
            border: 1px solid rgba(0, 0, 0, 0.3);
            box-sizing: border-box;
            border-radius: 4px;
            color: black;
        }

        .l_phantrang_btn1 {
            margin-right: 10px;
            padding: 6px 12px;
            background: no-repeat;
            outline: none;
            border: 1px solid rgba(0, 0, 0, 0.3);
            box-sizing: border-box;
            border-radius: 4px;
            background: #1B6AAB;
            color: rgb(255, 255, 255);
        }

        #v_paginition {
            margin: 20px auto;
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
            <?php
            $qrCate = new db_query("SELECT * FROM categories");
            ?>
            <div id="v_filter">
                <div class="v_filter">
                    <span>Lĩnh Vực:</span>
                    <select name="" id="v_name" class="v_filter_select" onchange="l_filter_center(1)">
                        <option value="0">--Chọn Lĩnh Vực--</option>
                        <?php while ($row_name = mysql_fetch_array($qrCate->result)) { ?>
                            <option value="<? echo $row_name['cate_id'] ?>"><? echo $row_name['cate_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="v_filter">
                <a href="../code_xu_ly/l_xls_admin_categories.php" id="v_href_exel"><button id="v_xls">XUẤT EXCEL</button></a>
            </div>
            <center id="v_info_ad">
                <div class="title_input" id="title_manager">
                    <div id="manager">
                        <div class="v_title_student">No</div>
                        <div class="v_title_student">Mã lĩnh vực</div>
                        <div class="v_title_student">Tên lĩnh vực</div>
                        <!-- <div class="v_title_student">ảnh lĩnh vực</div> -->
                        <div class="v_title_student">Sửa</div>
                    </div>
                    <?php
                    $i = 1;
                    $qr = new db_query("SELECT * FROM categories LIMIT 0, 30");
                    $count = new db_query("SELECT * FROM categories");
                    $page = ceil(mysql_num_rows($count->result) / 30);
                    while ($rowHV = mysql_fetch_array($qr->result)) {
                    ?>
                        <div class="manager remove" id="manager_2">
                            <div class="v_title_student"><?php echo $i; ?></div>
                            <div class="v_title_student"><?php echo $rowHV['cate_id']; ?></div>
                            <div class="v_title_student"><?php echo $rowHV['cate_name']; ?></div>
                            <!-- <div class="v_title_student"></v?php echo $rowHV['cate_icon']; ?></div> -->
                            <div class="v_title_student"><a href="admin_update_category.php?id=<? echo $rowHV['cate_id']; ?>&type=1"><img id="admin_edit<?php echo $rowHV['cate_id']; ?>" src="../img/vv_edi.svg" alt="Ảnh lỗi"></a></div>
                        </div>
                    <?php
                        $i++;
                    }
                    ?>
                </div>
                <center id="thongbao"></center>
                <div id="v_paginition">
                    <ul id="v_ul_paginition">
                        <li id="v_previous" onclick="v_paging('previous')">
                            << /li>
                                <?php for ($i = 1; $i <= $page; $i++) { ?>
                        <li id="v_pa<?= $i ?>" class="v_pa" onclick="v_paging(<?= $i ?>)"><?= $i ?></li>
                    <?php } ?>
                    <li id="v_next" onclick="v_paging('next')">></li>
                    </ul>
                </div>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript">
    $("#v_name").select2();
    $("#v_select_id").select2();
    $("#v_phone").select2();
    $("#v_email").select2();
    $("#l_city").select2();
    $("#l_district").select2();
    $("#v_pa1").css({
        background: '#1B6AAB',
        color: 'white'
    });

    $("#v_previous").hide();
    if ($(".manager").length == <?php echo mysql_num_rows($count->result); ?>) {
        $("#v_next").hide();
    }

    function l_filter_center(page) {

        var name = $('#v_name').val();

        var data = new FormData();
        data.append('name', name);
        data.append('page', page);

        $.ajax({
            url: '../ajax/admin_list_category.php',
            type: 'post',
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.result == 1) {
                    $('.remove').remove();
                    $('#thongbao').html('');
                    $('#v_paginition').html('');
                    // $("#l_district").html(response.city);
                    $('#title_manager').append(response.html)
                    $('#v_paginition').html(response.phantrang)
                } else {
                    $('.remove').remove();
                    $('#thongbao').html('');
                    $('#thongbao').html(response.message);
                }
            },
        });

        // $.get("../ajax/v_district.php", {
        //     v_district: $("#l_city").val()
        // }, function(data) {
        //     $("#l_district").html(data);
        // });

        var user_id = $("#v_name").val();
        if (user_id == 0) {
            var get_id = '';
        } else {
            var get_id = '&id=' + user_id;
        }
        var l_address = $("#l_address").val();
        if (l_address == '') {
            var get_add = '';
        } else {
            var get_add = '&address=' + l_address;
        }
        var l_city = $("#l_city").val();
        if (l_city == '0') {
            var get_city = '';
        } else {
            var get_city = '&city=' + l_city;
        }
        var l_district = $("#l_district").val();
        if (l_district == '0') {
            var get_district = '';
        } else {
            var get_district = '&district=' + l_district;
        }
        var startTime = $("#startTime").val();
        if (startTime == '') {
            var get_startTime = '';
        } else {
            var get_startTime = '&startTime=' + startTime;
        }
        var endTime = $("#endTime").val();
        if (endTime == '') {
            var get_endTime = '';
        } else {
            var get_endTime = '&endTime=' + endTime;
        }

        $("#v_href_exel").attr({
            'href': '../code_xu_ly/l_xls_admin_center.php?type=3' + get_id + get_startTime + get_endTime + get_city + get_district + get_add
        });

    }

    // function validate_update_student() {
    //     if (isNaN($("#student_phone").val())) {
    //         alert("Điện thoại phải là số");
    //         return false;
    //     } else if ($("#student_phone").val().charAt(0) != 0) {
    //         alert("Điện thoại sai định dạng");
    //         return false;
    //     }
    // }

    // function v_city() {
    //     var cit_id = $("#student_city").val();
    //     $.get('../ajax/v_district.php', {
    //         v_district: cit_id
    //     }, function(data) {
    //         $("#student_district").html(data);
    //     });
    // }
    // var adm_student_type = </?php
    //                         if ($row['adm_type'] == 1) {
    //                             echo $row['adm_type'];
    //                         } else {
    //                             echo $row['student_edit'];
    //                         }
    //                         ?>;

    // if (adm_student_type == 0) {
    //     for (var i = 0; i < $(".v_active").length; i++) {
    //         $(".v_active")[i].disabled = true;
    //         $(".v_index")[i].disabled = true;
    //     }
    // }

    // function active(user_id) {
    //     var adm_student_type = </?php
    //                             if ($row['adm_type'] == 1) {
    //                                 echo $row['adm_type'];
    //                             } else {
    //                                 echo $row['student_edit'];
    //                             }
    //                             ?>;
    //     if (adm_student_type == 0) {
    //         alert("Bạn không có quyền sửa");

    //     } else if (adm_student_type == 1) {
    //         if ($("#v_active" + user_id)[0].checked === true) {
    //             var active = 1;
    //         } else if ($("#v_active" + user_id)[0].checked === false) {
    //             var active = 0;
    //         }

    //         if ($("#v_index" + user_id)[0].checked === true) {
    //             var index = 1;
    //         } else if ($("#v_index" + user_id)[0].checked === false) {
    //             var index = 0;
    //         }

    //         $.get('../ajax/v_user_active.php', {
    //             active: active,
    //             index: index,
    //             user_id: user_id
    //         }, function(data) {});
    //     }
    // }

    // function v_delete(user_id) {
    //     if (adm_student_delete == 0) {
    //         alert("Bạn không có quyền xóa");
    //     } else {
    //         $.get('../ajax/v_admin_delete_student.php', {
    //             user_id: user_id
    //         }, function(data) {
    //             $("#manager" + user_id).remove();
    //         });
    //     }
    // }
</script>
<?php require_once '../includes/Admin_permission.php'; ?>

</html>