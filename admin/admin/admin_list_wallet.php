<?php
require_once '../includes/Admin_insert.php';
if ($_COOKIE['adm_type'] == 0) {
    $module = 5;
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
    <title>Danh sách nap tien</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
    #action5 {
        display: block;
    }

    .v_filter {
        margin-top: 0;
    }

    #list_5 {
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
                    <div class="boloc chon">
                        <span class="bolocspan">Trạng thái :</span>
                        <select id="transtatus">
                            <option> </option>
                            <option value="0">Đang chờ</option>
                            <option value="1">Thành công</option>
                            <option value="2">Thất bại</option>
                        </select>
                    </div>

                    <div class="boloc ten">
                        <span class="bolocspan">Tên :</span>
                        <select id="transname">
                            <option></option>
                            <?
                                    $qr1 = new db_query("SELECT * FROM user_transaction JOIN users ON users.user_id = user_transaction.user_id WHERE user_type = 1 ");
                                    while ($rowHV = mysql_fetch_array($qr1->result)) {
                                        ?>
                            <option value="<?=$rowHV['user_id'];?>"><?=$rowHV['user_phone'];?> -
                                <?=$rowHV['user_name'];?></option>
                            <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="boloc chon">
                        <span class="bolocspan">Từ ngày :</span>
                        <input type="date" id="fromdate">
                    </div>
                    <div class="boloc chon">
                        <span class="bolocspan">Dến ngày :</span>
                        <input type="date" id="todate" onchange="searchdate()">
                    </div>
                    <div class="v_filter">
                        <a id="v_href_exel"><button id="v_xls">XUẤT EXCEL</button></a>
                    </div>
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
    $("#transname").select2();

    $("#transtatus").on('change', function() {
        var user_id = $(this).val();
        var trans = "transtatus";
        var get_wallet = '&wallet=' + trans;
        if (user_id == '') {
            return false;
        } else {
            $("#v_href_exel").attr({
                'href': '../code_xu_ly/Admin_xls_wallet.php?user_id=' + user_id + get_wallet
            });
            $.ajax({
                url: '../ajax/h_ajax_filter.php',
                method: 'POST',
                data: {
                    user_id: user_id,
                    trans: trans
                },
                success: function(data) {
                    $("#filter").html(data);
                }
            });
        }
    });

    $("#transname").on('change', function() {
        var user_id = $(this).val();
        var trans = "transname";
        var get_wallet = '&wallet=' + trans;
        if (user_id == '') {
            return false;
        } else {
            $("#v_href_exel").attr({
                'href': '../code_xu_ly/Admin_xls_wallet.php?user_id=' + user_id + get_wallet
            });
            $.ajax({
                url: '../ajax/h_ajax_filter.php',
                method: 'POST',
                data: {
                    user_id: user_id,
                    trans: trans
                },
                success: function(data) {
                    $("#filter").html(data);
                }
            });
        }
    });
    $("#fromdate").on('change', function() {
        var fromdate = $(this).val();
        var trans = "fromdate";
        var actived = 1;
        var get_wallet = '&wallet=' + trans;
        $("#v_href_exel").attr({
            'href': '../code_xu_ly/Admin_xls_wallet.php?user_id=' + fromdate + get_wallet
        });
        $.ajax({
            url: '../ajax/h_ajax_filter.php',
            method: 'POST',
            data: {
                fromdate: fromdate,
                trans: trans
            },
            success: function(data) {
                $("#filter").html(data);
            }
        });
    });

    load_data();

    function load_data(page) {
        trans = 'trans';
        adm_id = <?=$adm_id?>;
        get_wallet = '&wallet=' + trans;
        $("#v_href_exel").attr({
            'href': '../code_xu_ly/Admin_xls_wallet.php?user_id=' + adm_id + get_wallet
        });
        $.ajax({
            url: "../ajax/h_Admin_paginate.php",
            method: "POST",
            data: {
                adm_id: adm_id,
                page: page,
                trans: trans
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

function searchdate() {
    var fromdate = $('#fromdate').val();
    var todate = $('#todate').val();
    var trans = "betweenday";
    var get_wallet = '&wallet=' + trans + '&todate=' + todate;
    $("#v_href_exel").attr({
        'href': '../code_xu_ly/Admin_xls_wallet.php?user_id=' + fromdate + get_wallet
    });
    $.ajax({
        url: '../ajax/h_ajax_filter.php',
        method: 'POST',
        data: {
            fromdate: fromdate,
            todate: todate,
            trans: trans
        },
        success: function(data) {
            $("#filter").html(data);
        }
    });
}
</script>

</html>