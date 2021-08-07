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
            $qrId = new db_query("SELECT user_id FROM users WHERE user_type = 3 ORDER BY user_id DESC");
            $qrUserId = new db_query("SELECT user_name,user_id FROM users WHERE user_type = 3 ORDER BY user_id DESC");
            $qrPhone = new db_query("SELECT user_id,user_phone FROM users WHERE user_type = 3 ORDER BY user_id DESC");
            $qrEmail = new db_query("SELECT user_id,user_mail FROM users WHERE user_type = 3 ORDER BY user_id DESC");
            $qrCity = new db_query("SELECT * FROM city WHERE cit_parent = 0");
            ?>
            <div id="v_filter_date">
                <span>Từ:</span>
                <input type="date" id="startTime" onchange="l_filter_center(1)">
                <span>Đến:</span>
                <input type="date" id="endTime" onchange="l_filter_center(1)">
            </div>
            <div id="v_filter">
                <!-- <div class="v_filter">
                    <span>ID Trung tâm:</span>
                    <select name="" id="v_select_id" class="v_filter_select" onchange="l_filter_center(1)">
                        <option value="0">ID Trung tâm</option>
                        </?php while ($row_id = mysql_fetch_array($qrId->result)) { ?>
                            <option value="</?= $row_id['user_id'] ?>"></? echo $row_id['user_id']; ?></option>
                        </?php } ?>
                    </select>
                </div> -->
                <div class="v_filter">
                    <span>Trung tâm:</span>
                    <select name="" id="v_name" class="v_filter_select" onchange="l_filter_center(1)">
                        <option value="0">Trung tâm</option>
                        <?php while ($row_name = mysql_fetch_array($qrUserId->result)) { ?>
                            <option value="<?= $row_name['user_id'] ?>"><? echo $row_name['user_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- <div class="v_filter">
                    <span>Số điện thoại:</span>
                    <select name="" id="v_phone" class="v_filter_select" onchange="l_filter_center(1)">
                        <option value="0">Số điện thoại</option>
                        </?php while ($row_name = mysql_fetch_array($qrPhone->result)) { ?>
                            <option value="</?= $row_name['user_phone'] ?>"></? echo $row_name['user_phone']; ?></option>
                        </?php } ?>
                    </select>
                </div> -->
                <!-- <div class="v_filter">
                    <span>Email:</span>
                    <select name="" id="v_email" class="v_filter_select" onchange="l_filter_center(1)">
                        <option value="0">Email</option>
                        </?php while ($row_name = mysql_fetch_array($qrEmail->result)) { ?>
                            <option value="</?= $row_name['user_mail'] ?>"></? echo $row_name['user_mail']; ?></option>
                        </?php } ?>
                    </select>
                </div> -->
                <div class="v_filter">
                    <span>Tỉnh thành phố:</span>
                    <select name="" id="l_city" class="v_filter_select" onchange="l_filter_center(1)">
                        <option value="0">--Chọn tỉnh thành--</option>
                        <?php while ($row_name = mysql_fetch_array($qrCity->result)) { ?>
                            <option value="<?= $row_name['cit_id'] ?>"><? echo $row_name['cit_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="v_filter">
                    <span>Quận huyện:</span>
                    <select name="" id="l_district" class="v_filter_select" onchange="l_filter_center(1)">
                        <option value="0" selected>--Chọn quận huyện--</option>
                    </select>
                </div>
                <div class="v_filter">
                    <span>Địa chỉ chi tiết:</span>
                    <input type="text" value="" name="" class="l_address" id="l_address" onchange="l_filter_center(1)">
                </div>
            </div>
            <div class="v_filter">
                <a href="../code_xu_ly/l_xls_admin_center.php" id="v_href_exel"><button id="v_xls">XUẤT EXCEL</button></a>
            </div>
            <center id="v_info_ad">
                <div class="title_input" id="title_manager">
                    <div id="manager">
                        <div class="v_title_student">No</div>
                        <div class="v_title_student">Mã trung tâm</div>
                        <div class="v_title_student">Tên trung tâm</div>
                        <div class="v_title_student">Email</div>
                        <!-- <div class="v_title_student">Ảnh đại diện</div> -->
                        <div class="v_title_student">Số điện thoại</div>
                        <div class="v_title_student">Địa chỉ</div>
                        <div class="v_title_student">Ngày đăng kí</div>
                        <div class="v_title_student">Ngày cập nhật</div>
                        <div class="v_title_student">Active</div>
                        <div class="v_title_student">index</div>
                        <div class="v_title_student">Sửa</div>
                    </div>
                    <?php
                    $i = 1;
                    $qr = new db_query("SELECT * FROM users WHERE user_type = 3 ORDER BY user_id DESC LIMIT 0, 30");
                    $count = new db_query("SELECT * FROM users WHERE user_type = 3");
                    $page = ceil(mysql_num_rows($count->result) / 30);

                    while ($rowHV = mysql_fetch_array($qr->result)) {
                        if ($rowHV['user_active'] == 1) {
                            $user_active = "checked";
                        } else {
                            $user_active = "";
                        }

                        if ($rowHV['user_index'] == 1) {
                            $user_index = "checked";
                        } else {
                            $user_index = "";
                        }
                    ?>
                        <div class="manager remove" id="manager_2">
                            <div class="v_title_student"><?php echo $i; ?></div>
                            <div class="v_title_student"><?php echo $rowHV['user_id']; ?></div>
                            <div class="v_title_student"><a href="<?= urlDetail_center($rowHV['user_id'], $rowHV['user_slug']) ?>"><?php echo $rowHV['user_name']; ?></a>
                            </div>
                            <div class="v_title_student"><?php echo $rowHV['user_mail']; ?></div>
                            <div class="v_title_student"><?php echo $rowHV['user_phone']; ?></div>
                            <div class="v_title_student">
                                <?
                                $city = $rowHV['user_id'];
                                $j = 1;
                                $db_center_basis = new db_query("SELECT * FROM user_center_basis INNER JOIN city ON user_center_basis.cit_id = city.cit_id where user_id = '$city'");
                                while ($row_ar = mysql_fetch_assoc($db_center_basis->result)) {
                                    $district = $row_ar['district_id'];
                                    $db_district = new db_query("SELECT cit_name FROM city where cit_id = '$district'");
                                    $row_dis = mysql_fetch_assoc($db_district->result);
                                ?>
                                    <div class="">Cơ Sở
                                        <?
                                        echo  $j . ": " . $row_ar['center_basis_address'] . ' - ' . $row_dis['cit_name'] . ' - ' . $row_ar['cit_name'];
                                        ?>
                                    </div>
                                <?
                                    $j++;
                                }
                                ?>
                            </div>
                            <div class="v_title_student"><?php echo date("d-m-Y", $rowHV['created_at']); ?></div>
                            <div class="v_title_student"><?php echo date("d-m-Y", $rowHV['updated_at']); ?></div>
                            <div class="v_title_student"><input type="checkbox" class="v_active" id="v_active<?php echo $rowHV['user_id']; ?>" name="active" onclick="active(<?php echo $rowHV['user_id']; ?>)" <?php echo $user_active; ?>>
                            </div>
                            <div class="v_title_student"><input type="checkbox" class="v_index" id="v_index<?php echo $rowHV['user_id']; ?>" name="student_index" onclick="active(<?php echo $rowHV['user_id']; ?>)" <?php echo $user_index; ?>></div>
                            <div class="v_title_student"><a href="admin_update_center.php?id=<? echo $rowHV['user_id']; ?>"><img id="admin_edit<?php echo $rowHV['user_id']; ?>" src="../img/vv_edi.svg" alt="Ảnh lỗi"></a></div>
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

        var user_id = $('#v_select_id').val();
        var name = $('#v_name').val();
        var email = $('#v_email').val();
        var phone = $('#v_phone').val();
        var l_city = $('#l_city').val();
        var l_district = $('#l_district').val();
        var l_address = $('#l_address').val();
        var startTime = $('#startTime').val();
        var endTime = $('#endTime').val();

        var data = new FormData();
        data.append('user_id', user_id);
        data.append('name', name);
        data.append('email', email);
        data.append('phone', phone);
        data.append('l_city', l_city);
        data.append('l_district', l_district);
        data.append('l_address', l_address);
        data.append('startTime', startTime);
        data.append('endTime', endTime);
        data.append('page', page);

        $.ajax({
            url: '../ajax/admin_list_center.php',
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
                    $("#l_district").html(response.city);
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
        // $.ajax({
        //     url: '../ajax/admin_list_center.php',
        //     type: 'POST',
        //     dataType: 'json',
        //     data: {
        //         user_id: user_id,
        //         name: name,
        //         phone: phone,
        //         email: email,
        //         startTime: startTime,
        //         endTime: endTime,
        //         page: 1
        //     },
        //     success: function(data) {
        //         $('.manager').remove();
        //         if (data.html == "") {
        //             $("#manager").hide();
        //             $("#v_paginition").remove();
        //             $('#title_manager').append('<div id="no-list">Không có danh sách</div>');
        //         } else {
        //             $("#no-list").remove();
        //             $("#manager").show();
        //             $('#title_manager').append(data.html);
        //             $('#v_paginition').html(data.v_paging);
        //             $("#v_pa1").css({
        //                 background: '#1B6AAB',
        //                 color: 'white'
        //             });
        //             $("#v_previous").hide();
        //             if ($(".v_pa").length == 1) {
        //                 $("#v_previous").remove();
        //                 $("#v_next").remove();
        //                 $(".v_pa").remove();
        //             }
        //         }
        //     }
        // });

    }

    // function v_paging(page) {
    //     var user_id = $("#v_name").val();
    //     if (user_id == '0') {
    //         var get_id = '';
    //     } else {
    //         var get_id = '&user_id=' + user_id;
    //     }
    //     var name = $("#v_name").val();
    //     if (name == '0') {
    //         var get_name = '';
    //     } else {
    //         var get_name = '&name=' + name;
    //     }
    //     var phone = $("#v_phone").val();
    //     if (phone == '0') {
    //         var get_phone = '';
    //     } else {
    //         var get_phone = '&phone=' + phone;
    //     }
    //     var email = $("#v_email").val();
    //     if (email == '0') {
    //         var get_email = '';
    //     } else {
    //         var get_email = '&email=' + email;
    //     }
    //     var startTime = $("#startTime").val();
    //     if (startTime == '') {
    //         var get_startTime = '';
    //     } else {
    //         var get_startTime = '&startTime=' + startTime;
    //     }
    //     var endTime = $("#endTime").val();
    //     if (endTime == '') {
    //         var get_endTime = '';
    //     } else {
    //         var get_endTime = '&endTime=' + endTime;
    //     }
    //     if (page == 'next') {
    //         for (var i = 0; i < $('.v_pa').length; i++) {
    //             if ($(".v_pa")[i].style.background == "rgb(27, 106, 171)") {
    //                 page = i + 2;
    //             }
    //         }
    //     } else if (page == 'previous') {
    //         for (var i = 0; i < $('.v_pa').length; i++) {
    //             if ($(".v_pa")[i].style.background == "rgb(27, 106, 171)") {
    //                 page = i;
    //             }
    //         }
    //     }

    //     $("#v_href_exel").attr({
    //         'href': '../code_xu_ly/v_admin_xls.php?type=1&page=' + page + get_id + get_name + get_phone + get_email + get_startTime + get_endTime
    //     });

    //     $.ajax({
    //         url: '../ajax/admin_list_center.php',
    //         type: 'POST',
    //         dataType: 'json',
    //         data: {
    //             user_id: user_id,
    //             name: email,
    //             phone: phone,
    //             email: email,
    //             page: page,
    //             startTime: startTime,
    //             endTime: endTime
    //         },
    //         success: function(data) {
    //             $('.manager').remove();
    //             $('#title_manager').append(data.html);
    //             for (var i = 0; i < $('.v_pa').length; i++) {
    //                 if (i != page - 1) {
    //                     $('.v_pa')[i].style.background = "none";
    //                     $('.v_pa')[i].style.color = "black";
    //                 } else {
    //                     $('.v_pa')[i].style.background = "#1B6AAB";
    //                     $('.v_pa')[i].style.color = "white";
    //                     if (i == 0) {
    //                         $("#v_previous").hide();
    //                         $("#v_next").show();
    //                         $("#v_previous").hide();
    //                         if ($(".manager").length == <?php echo mysql_num_rows($count->result); ?>) {
    //                             $("#v_next").hide();
    //                         }
    //                     } else if (i == $('.v_pa').length - 1) {
    //                         $("#v_next").hide();
    //                         $("#v_previous").show();
    //                     } else {
    //                         $("#v_previous").show();
    //                         $("#v_next").show();
    //                     }
    //                 }
    //             }
    //         }
    //     });

    // }

    // function v_student_edit(user_id) {
    //     var adm_edit = </?php
    //                     if ($row['adm_type'] == 1) {
    //                         echo $row['adm_type'];
    //                     } else {
    //                         echo $row['student_edit'];
    //                     }
    //                     ?>;
    //     if (adm_edit == 0) {
    //         alert("Bạn không có quyền sửa");
    //     } else if (adm_edit == 1) {
    //         $.ajax({
    //             url: '../ajax/admin_update_center.php',
    //             type: 'POST',
    //             dataType: 'json',
    //             data: {
    //                 student_id: user_id
    //             },
    //             success: function(data) {
    //                 console.log(data.html);
    //                 $("#v_info_ad").html(data.html);
    //                 $(".v_filter").remove();
    //                 $("#v_filter_date").remove();
    //                 $("#student_city").select2();
    //                 $("#student_district").select2();
    //                 $('#categories').select2({
    //                     multiple: true,
    //                     maximumSelectionLength: 5,
    //                     minimumInputLength: 0,
    //                 });
    //             }
    //         });
    //     }
    // }

    function validate_update_student() {
        if (isNaN($("#student_phone").val())) {
            alert("Điện thoại phải là số");
            return false;
        } else if ($("#student_phone").val().charAt(0) != 0) {
            alert("Điện thoại sai định dạng");
            return false;
        }
    }

    function v_city() {
        var cit_id = $("#student_city").val();
        $.get('../ajax/v_district.php', {
            v_district: cit_id
        }, function(data) {
            $("#student_district").html(data);
        });
    }
    var adm_student_type = <?php
                            if ($row['adm_type'] == 1) {
                                echo $row['adm_type'];
                            } else {
                                echo $row['student_edit'];
                            }
                            ?>;

    if (adm_student_type == 0) {
        for (var i = 0; i < $(".v_active").length; i++) {
            $(".v_active")[i].disabled = true;
            $(".v_index")[i].disabled = true;
        }
    }

    function active(user_id) {
        var adm_student_type = <?php
                                if ($row['adm_type'] == 1) {
                                    echo $row['adm_type'];
                                } else {
                                    echo $row['student_edit'];
                                }
                                ?>;
        if (adm_student_type == 0) {
            alert("Bạn không có quyền sửa");

        } else if (adm_student_type == 1) {
            if ($("#v_active" + user_id)[0].checked === true) {
                var active = 1;
            } else if ($("#v_active" + user_id)[0].checked === false) {
                var active = 0;
            }

            if ($("#v_index" + user_id)[0].checked === true) {
                var index = 1;
            } else if ($("#v_index" + user_id)[0].checked === false) {
                var index = 0;
            }

            $.get('../ajax/v_user_active.php', {
                active: active,
                index: index,
                user_id: user_id
            }, function(data) {});
        }
    }

    function v_delete(user_id) {
        if (adm_student_delete == 0) {
            alert("Bạn không có quyền xóa");
        } else {
            $.get('../ajax/v_admin_delete_student.php', {
                user_id: user_id
            }, function(data) {
                $("#manager" + user_id).remove();
            });
        }
    }
</script>
<?php require_once '../includes/Admin_permission.php'; ?>

</html>