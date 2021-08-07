<?php
require_once '../includes/Admin_insert.php';
if($_COOKIE['adm_type'] == 0){
    $module = 1;
    $check = new db_query("SELECT * FROM admin_permission WHERE adm_id = $adm_id AND module_id = $module");
    if(mysql_num_rows($check->result) == 0){
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
    <title>Danh sách tài khoản</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
    #action1 {
        display: block;
    }

    #list_1 {
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
            <center id="v_info_ad">
                <div class="title_input" id="title_manager">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tài khoản</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Quyền</th>
                                <th scope="col">Active</th>
                                <th scope="col">Sửa</th>
                            </tr>
                        </thead>
                        <tbody id="filter">
                            <?
                            $i = 1;
                              $query = new db_query("SELECT * FROM admin  WHERE adm_type = 0  ORDER BY adm_id DESC");
                            while ($rowHV = mysql_fetch_array($query->result)) {
                                if ($rowHV['adm_active'] == 1) {
                                    $adm_active = "checked";
                                }else{
                                    $adm_active = "";
                                }
					
					?>
                            <tr>
                                <td><?=$i?></td>
                                <td><?=$rowHV['adm_login_name']?></td>
                                <td><?=$rowHV['adm_name']?></td>
                                <td>
                                    <?
                                        $db_access = new db_query("SELECT * FROM admin, admin_permission, admin_modules WHERE admin.adm_id = admin_permission.adm_id AND admin_permission.module_id = admin_modules.module_id AND admin.adm_id =" . $rowHV['adm_id']);
                                    while ($row_access = mysql_fetch_array($db_access->result)){
                                        echo $row_access['module_name'] . " , ";
                                    }
                                    ?>
                                </td>
                                <?
                                if ($_COOKIE['adm_type'] == 0) {
                                    $check = new db_query("SELECT * FROM admin_permission WHERE adm_id = $adm_id AND module_id = $module AND permis_create = 1");
                                    if (mysql_num_rows($check->result) == 0) {
                                        echo '';
                                    }
                                }else{
                                    echo '
                                        <td><input type="checkbox" class="v_active" id="v_active'.$rowHV['adm_id'].'"
                                            name="adm_active" onclick="active('.$rowHV['adm_id'].')" '.$adm_active.'></td>
                                        <td><img id="admin_edit'.$rowHV['adm_id'].'" src="../img/vv_edi.svg"
                                            onclick="v_admin_edit('.$rowHV['adm_id'].')" alt="Ảnh lỗi"></td>
                                    ';
                                }
                                ?>
                            </tr>
                            <?
                            $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript">
function v_admin_edit(adm_id) {
    $.post('../ajax/Admin_update_admin.php', {
        adm_id: adm_id
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

    $.get('../ajax/h_admin_active.php', {
        active: active,
        user_id: user_id
    }, function(data) {});

}

function validation() {
    if ($("#adm_phone").val() == '') {
        alert("Vui lòng nhập số điện thoại");
        $('#adm_phone').focus();
        return false;
    }
    if ($("#adm_name").val() == '') {
        alert("Vui lòng nhập tên");
        $('#adm_name').focus();
        return false;
    }
}

function validation2() {
    if ($("#repassword").val() == '') {
        alert("Vui lòng nhập mật khẩu");
        $('#repassword').focus();
        return false;
    }
    if ($("#password").val() != $("#repassword").val()) {
        alert("Mật khẩu nhập lại không đúng");
        $('#repassword').focus();
        return false;
    }
}
</script>

</html>