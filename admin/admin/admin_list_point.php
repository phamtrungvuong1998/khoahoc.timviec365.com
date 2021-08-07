<?php
require_once '../includes/Admin_insert.php';
if ($_COOKIE['adm_type'] == 0) {
    $module = 6;
    $check = new db_query("SELECT * FROM admin_permission WHERE adm_id = $adm_id AND module_id = $module");
    if (mysql_num_rows($check->result) == 0) {
        header("location:/admin/index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danh sách điểm</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
    #action6 {
        display: block;
    }

    #list_6 {
        background: #18191b;
        border-left: 8px solid #13895F;
    }

    .v_detail_student textarea {
        width: 100%;
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

    .manager {
        display: contents;
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
                <div id="boloc">
                    <form>
                        <div class="boloc chon">
                            <select id="center_teacher">
                                <option value="2">Giảng viên</option>
                                <option value="3">Trung tâm</option>
                            </select>
                        </div>

                        <div class="boloc ten">
                            <span class="bolocspan">Tên :</span>
                            <select id="pointname">
                                <option></option>
                                <?
                                    $qr1 = new db_query("SELECT * FROM points JOIN users ON users.user_id = points.user_id ");
                                    while ($rowHV = mysql_fetch_array($qr1->result)) {
                                        ?>
                                <option value="<?=$rowHV['user_id'];?>"><?=$rowHV['user_phone'];?> -
                                    <?=$rowHV['user_name'];?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="boloc mail">
                            <span class="bolocspan">Email :</span>
                            <select id="pointmail">
                                <option></option>
                                <?
                                    $qr2 = new db_query("SELECT * FROM points JOIN users ON users.user_id = points.user_id");
                                    while ($rowHV = mysql_fetch_array($qr2->result)) {
                                        ?>
                                <option value="<?=$rowHV['user_id'];?>"><?=$rowHV['user_mail'];?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="title_input" id="title_manager">
                </div>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#pointname").select2();
    $("#pointmail").select2();

    $("#center_teacher").on('change', function() {
        var user_id = $(this).val();
        var point = "center_teacher";
        if (user_id == '') {
            return false;
        } else {
            $.ajax({
                url: '../ajax/h_ajax_filter.php',
                method: 'POST',
                data: {
                    user_id: user_id,
                    point: point
                },
                success: function(data) {
                    $("#filter").html(data);
                }
            });
        }
    });

    $("#pointname").on('change', function() {
        var user_id = $(this).val();
        var point = "pointnamemail";
        if (user_id == '') {
            return false;
        } else {
            $.ajax({
                url: '../ajax/h_ajax_filter.php',
                method: 'POST',
                data: {
                    user_id: user_id,
                    point: point
                },
                success: function(data) {
                    $("#filter").html(data);
                }
            });
        }
    });
    $("#pointmail").on('change', function() {
        var user_id = $(this).val();
        var point = "pointnamemail";
        if (user_id == '') {
            return false;
        } else {
            $.ajax({
                url: '../ajax/h_ajax_filter.php',
                method: 'POST',
                data: {
                    user_id: user_id,
                    point: point
                },
                success: function(data) {
                    $("#filter").html(data);
                }
            });
        }
    });

    load_data();

    function load_data(page) {
        point = 'point';
        adm_id = <?=$adm_id?>;
        $.ajax({
            url: "../ajax/h_Admin_paginate.php",
            method: "POST",
            data: {
                adm_id: adm_id,
                page: page,
                point: point
            },
            success: function(data) {
                $('#title_manager').html(data);
            }
        })
    }
    $(document).on('click', '.page-link', function() {
        var page = $(this).attr("id");
        load_data(page);
    });
});

function v_teacher_edit(user_id) {
    $.post('../ajax/Admin_update_point.php', {
        point_id: user_id
    }, function(data) {
        $("#v_info_ad").html(data);
    });
}




function active(user_id) {

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
</script>

</html>