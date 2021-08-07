<?php
require_once '../includes/Admin_insert.php';
$module = 3;
if ($_COOKIE['adm_type'] == 0) {
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
    <title>Danh sách giảng viên</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
    #action3 {
        display: block;
    }

    #list_3 {
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
            <?php
            $qrId = new db_query("SELECT user_id FROM users WHERE user_type = 2 ORDER BY user_id DESC");
            $qrUserId = new db_query("SELECT user_name FROM users WHERE user_type = 2 ORDER BY user_id DESC");
            $qrPhone = new db_query("SELECT user_id,user_phone FROM users WHERE user_type = 2 ORDER BY user_id DESC");
            $qrEmail = new db_query("SELECT user_id,user_mail FROM users WHERE user_type = 2 ORDER BY user_id DESC");
            ?>
            <div id="v_filter_date">
                <span>Từ:</span>
                <input type="date" id="startTime" onchange="v_filter_teacher()">
                <span>Đến:</span>
                <input type="date" id="endTime" onchange="v_filter_teacher()">
            </div>
            <div id="v_filter">
                <div id="v_filter">
                    <div class="v_filter">
                        <span>ID Giảng viên:</span>
                        <select name="" id="v_select_id" class="v_filter_select" onchange="v_filter_teacher()">
                            <option value="0">ID Giảng viên</option>
                            <?php while($row_id = mysql_fetch_array($qrId->result)){ ?>
                            <option value="<?=$row_id['user_id']?>">
                                <?echo $row_id['user_id'];?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="v_filter">
                        <span>Giảng viên:</span>
                        <select name="" id="v_name" class="v_filter_select" onchange="v_filter_teacher()">
                            <option value="0">Giảng viên</option>
                            <?php while($row_name = mysql_fetch_array($qrUserId->result)){ ?>
                            <option value="<?=$row_name['user_name']?>">
                                <?echo $row_name['user_name'].'-'.$row_name['user_id'];?>
                            </option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="v_filter">
                        <span>Số điện thoại:</span>
                        <select name="" id="v_phone" class="v_filter_select" onchange="v_filter_teacher()">
                            <option value="0">Số điện thoại</option>
                            <?php while($row_name = mysql_fetch_array($qrPhone->result)){ ?>
                            <option value="<?=$row_name['user_phone']?>">
                                <?echo $row_name['user_phone'];?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="v_filter">
                        <span>Email:</span>
                        <select name="" id="v_email" class="v_filter_select" onchange="v_filter_teacher()">
                            <option value="0">Email</option>
                            <?php while($row_name = mysql_fetch_array($qrEmail->result)){ ?>
                            <option value="<?=$row_name['user_mail']?>">
                                <?echo $row_name['user_mail'];?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="v_filter">
                    <a href="../code_xu_ly/v_admin_xls.php?type=2" id="v_href_exel"><button id="v_xls">XUẤT
                            EXCEL</button></a>
                </div>
                <center id="v_info_ad">
                    <div class="title_input" id="title_manager">
                        <div id="manager">
                            <div class="v_title_student">No</div>
                            <div class="v_title_student">Mã giảng viên</div>
                            <div class="v_title_student">Họ tên</div>
                            <div class="v_title_student">Email</div>
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
                    $qr = new db_query("SELECT * FROM users WHERE user_type = 2 ORDER BY user_id DESC LIMIT 0, 30");
                    $count = new db_query("SELECT * FROM users WHERE user_type = 2");
                    $page = ceil(mysql_num_rows($count->result)/30);
                    while ($rowHV = mysql_fetch_array($qr->result)) {
                      if ($rowHV['user_active'] == 1) {
                        $user_active = "checked";
                    }else{
                        $user_active = "";
                    }

                    if ($rowHV['user_index'] == 1) {
                        $user_index = "checked";
                    }else{
                        $user_index = "";
                    }
                    ?>
                        <div class="manager" id="manager<?php echo $rowHV['user_id'];?>">
                            <div class="v_title_student"><?php echo $i; ?></div>
                            <div class="v_title_student"><?php echo $rowHV['user_id']; ?></div>
                            <div class="v_title_student"><a
                                    href="<?=urlDetail_teacher($rowHV['user_id'],$rowHV['user_slug'])?>"><?php echo $rowHV['user_name']; ?></a>
                            </div>
                            <div class="v_title_student"><?php echo $rowHV['user_mail']; ?></div>
                            <div class="v_title_student"><?php echo $rowHV['user_phone']; ?></div>
                            <div class="v_title_student"><?php echo $rowHV['user_address']; ?></div>
                            <div class="v_title_student"><?php echo date("d-m-Y",$rowHV['created_at']); ?></div>
                            <div class="v_title_student"><?php echo date("d-m-Y",$rowHV['updated_at']); ?></div>

                            <?
                            if ($_COOKIE['adm_type'] == 0) {
                                $check = new db_query("SELECT * FROM admin_permission WHERE adm_id = $adm_id AND module_id = $module AND permis_update = 1");
                                if (mysql_num_rows($check->result) > 0) {
                                    echo '
                                        <div class="v_title_student"><input type="checkbox" class="v_active"
                                            id="v_active'.$rowHV['user_id'].'" name="active"
                                            onclick="active('.$rowHV['user_id'].')" '.$user_active.' readOnly>
                                    </div>
                                    <div class="v_title_student"><input type="checkbox" class="v_index"
                                            id="v_index'.$rowHV['user_id'].'" name="student_index"
                                            onclick="active('.$rowHV['user_id'].')"'. $user_index.'></div>
                                    <div class="v_title_student"><img id="admin_edit'. $rowHV['user_id'].'"
                                            src="../img/vv_edi.svg" onclick="v_teacher_edit('. $rowHV['user_id'].')"
                                            alt="Ảnh lỗi"></div>
                                ';
                                }
                            }else{
                                echo '
                                        <div class="v_title_student"><input type="checkbox" class="v_active"
                                            id="v_active'.$rowHV['user_id'].'" name="active"
                                            onclick="active('.$rowHV['user_id'].')" '.$user_active.' readOnly>
                                    </div>
                                    <div class="v_title_student"><input type="checkbox" class="v_index"
                                            id="v_index'.$rowHV['user_id'].'" name="student_index"
                                            onclick="active('.$rowHV['user_id'].')"'. $user_index.'></div>
                                    <div class="v_title_student"><img id="admin_edit'. $rowHV['user_id'].'"
                                            src="../img/vv_edi.svg" onclick="v_teacher_edit('. $rowHV['user_id'].')"
                                            alt="Ảnh lỗi"></div>
                                ';
                            }
                                ?>
                        </div>
                        <?php
                            $i++;
                        }
                        
                        ?>
                    </div>
                    <div id="v_paginition">
                        <ul id="v_ul_paginition">
                            <li id="v_previous" onclick="v_paging('previous')">
                                < </li>
                                    <?php for ($i = 1; $i <= $page; $i++) { ?>
                            <li id="v_pa<?=$i?>" class="v_pa" onclick="v_paging(<?=$i?>)"><?=$i?></li>
                            <?php } ?>
                            <li id="v_next" onclick="v_paging('next')">></li>
                        </ul>
                    </div>
                </center>
            </div>

</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
    $(".v_filter_select").select2();
});

$("#v_pa1").css({
    background: '#1B6AAB',
    color: 'white'
});

$("#v_previous").hide();
if ($(".manager").length == <?php echo mysql_num_rows($count->result); ?>) {
    $("#v_next").hide();
}

function v_teacher_edit(user_id) {
    $.post('../ajax/Admin_update_teacher.php', {
        teacher_id: user_id
    }, function(data) {
        $("#v_info_ad").html(data);
        $("#student_city").select2();
        $("#student_district").select2();
        $('#categories').select2({
            multiple: true,
            maximumSelectionLength: 5,
            minimumInputLength: 0,
        });
    });
}

var adm_type = <?=$_COOKIE['adm_type']?>;
var adm_id = <?=$adm_id?>;
var module = <?=$module?>;

function v_filter_teacher() {
    var user_id = $("#v_select_id").val();
    if (user_id == 0) {
        var get_id = '';
    } else {
        var get_id = '&user_id=' + user_id;
    }
    var name = $("#v_name").val();
    if (name == '0') {
        var get_name = '';
    } else {
        var get_name = '&name=' + name;
    }
    var phone = $("#v_phone").val();
    if (phone == '0') {
        var get_phone = '';
    } else {
        var get_phone = '&phone=' + phone;
    }
    var email = $("#v_email").val();
    if (email == '0') {
        var get_email = '';
    } else {
        var get_email = '&email=' + email;
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
        'href': '../code_xu_ly/v_admin_xls.php?type=2' + get_id + get_name + get_phone + get_email +
            get_startTime + get_endTime
    });
    $.ajax({
        url: '../ajax/v_admin_list_teacher.php',
        type: 'POST',
        dataType: 'json',
        data: {
            user_id: user_id,
            name: name,
            phone: phone,
            email: email,
            startTime: startTime,
            endTime: endTime,
            adm_id: adm_id,
            adm_type: adm_type,
            module: module,
            page: 1
        },
        success: function(data) {
            $('.manager').remove();
            if (data.html == "") {
                $("#manager").hide();
                $("#v_paginition").remove();
                $('#title_manager').append('<div id="no-list">Không có danh sách</div>');
            } else {
                $("#no-list").remove();
                $("#manager").show();
                $('#title_manager').append(data.html);
                $('#v_paginition').html(data.v_paging);
                $("#v_pa1").css({
                    background: '#1B6AAB',
                    color: 'white'
                });
                $("#v_previous").hide();
                if ($(".v_pa").length == 1) {
                    $("#v_previous").remove();
                    $("#v_next").remove();
                    $(".v_pa").remove();
                }
            }
        }
    });
}


function v_paging(page) {
    var user_id = $("#v_select_id").val();
    if (user_id == 0) {
        var get_id = '';
    } else {
        var get_id = '&user_id=' + user_id;
    }
    var name = $("#v_name").val();
    if (name == '0') {
        var get_name = '';
    } else {
        var get_name = '&name=' + name;
    }
    var phone = $("#v_phone").val();
    if (phone == '0') {
        var get_phone = '';
    } else {
        var get_phone = '&phone=' + phone;
    }
    var email = $("#v_email").val();
    if (email == '0') {
        var get_email = '';
    } else {
        var get_email = '&email=' + email;
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
    if (page == 'next') {
        for (var i = 0; i < $('.v_pa').length; i++) {
            if ($(".v_pa")[i].style.background == "rgb(27, 106, 171)") {
                page = i + 2;
            }
        }
    } else if (page == 'previous') {
        for (var i = 0; i < $('.v_pa').length; i++) {
            if ($(".v_pa")[i].style.background == "rgb(27, 106, 171)") {
                page = i;
            }
        }
    }

    $("#v_href_exel").attr({
        'href': '../code_xu_ly/v_admin_xls.php?type=2&page=' + page + get_id + get_name + get_phone +
            get_email + get_startTime + get_endTime
    });

    $.ajax({
        url: '../ajax/v_admin_list_teacher.php',
        type: 'POST',
        dataType: 'json',
        data: {
            user_id: user_id,
            name: email,
            phone: phone,
            email: email,
            page: page,
            startTime: startTime,
            endTime: endTime,
            adm_id: adm_id,
            adm_type: adm_type,
            module: module,
        },
        success: function(data) {
            $('.manager').remove();
            $('#title_manager').append(data.html);
            for (var i = 0; i < $('.v_pa').length; i++) {
                if (i != page - 1) {
                    $('.v_pa')[i].style.background = "none";
                    $('.v_pa')[i].style.color = "black";
                } else {
                    $('.v_pa')[i].style.background = "#1B6AAB";
                    $('.v_pa')[i].style.color = "white";
                    if (i == 0) {
                        $("#v_previous").hide();
                        $("#v_next").show();
                        $("#v_previous").hide();
                        if ($(".manager").length == <?php echo mysql_num_rows($count->result); ?>) {
                            $("#v_next").hide();
                        }
                    } else if (i == $('.v_pa').length - 1) {
                        $("#v_next").hide();
                        $("#v_previous").show();
                    } else {
                        $("#v_previous").show();
                        $("#v_next").show();
                    }
                }
            }
        }
    })

}

function validate_update_student() {
    if (isNaN($("#student_phone").val())) {
        alert("Điện thoại phải là số");
        return false;
    } else if ($("#student_phone").val().charAt(0) != 0) {
        alert("Điện thoại sai định dạng");
        return false;
    }
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