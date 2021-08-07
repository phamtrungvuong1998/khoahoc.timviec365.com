<?php 
require_once '../includes/Admin_insert.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DashBoard</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <style>
    #v_dashboard {
        background: #18191b;
        border-left: 8px solid #13895F;
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
                <div class="v_info_ad">
                    <div class="v_title">Thay đổi email</div>
                    <form action="" class="v_form" onsubmit="return v_validate_email();">
                        <div class="v_input">
                            <div class="v_tt">Tên đăng nhập:</div>
                            <div class="v_tt_all"><?php echo $row['adm_name']; ?></div>
                        </div>
                        <div class="v_input">
                            <div class="v_tt">Email:</div>
                            <div class="v_tt_all"><input type="email" id="email"
                                    value="<?php echo $row['adm_email']; ?>" name="email" class="v_ip_text"></div>
                        </div>
                        <button class="v_tt_btn" name="update_email">Cập nhật</button>
                    </form>
                </div>
                <div class="v_info_ad">
                    <div class="v_title">Thay đổi mật khẩu</div>
                    <form method="POST" class="v_form" onsubmit="return v_validate_pass();">
                        <div class="v_input">
                            <div class="v_tt">Mật khẩu cũ:</div>
                            <div class="v_tt_all"><input type="password" name="old_pass" id="old_pass"
                                    class="v_ip_text"></div>
                        </div>
                        <div class="v_input">
                            <div class="v_tt">Mật khẩu mới:</div>
                            <div class="v_tt_all"><input type="password" name="new_pass" id="new_pass"
                                    class="v_ip_text"></div>
                        </div>
                        <div class="v_input">
                            <div class="v_tt">Nhập lại mật khẩu mới:</div>
                            <div class="v_tt_all"><input type="password" id="re_new_pass" class="v_ip_text"></div>
                        </div>
                        <button class="v_tt_btn" name="update_pass">Cập nhật</button>
                    </form>
                </div>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script type="text/javascript">
function v_validate_email() {
    if (document.getElementById('email').value == '') {
        alert('Vui lòng nhập email');
        return false;
    }

    $.post('../ajax/v_cap_nhat_admin.php', {
        email: document.getElementById('email').value,
        type: 1
    }, function(data) {
        alert(data);
    });
    return false;
}

function v_validate_pass() {
    if (document.getElementById('old_pass').value == '') {
        alert('Vui lòng nhập mật khẩu cũ');
        return false;
    } else if (document.getElementById('new_pass').value == '') {
        alert('Vui lòng nhập mật khẩu mới');
        return false;
    } else if (document.getElementById('re_new_pass').value == '') {
        alert('Vui lòng nhập lại mật khẩu mới');
        return false;
    }

    if (document.getElementById('new_pass').value != document.getElementById('re_new_pass').value) {
        alert('Nhập lại mật khẩu không đúng');
        return false;
    }

    $.post('../ajax/v_cap_nhat_admin.php', {
        old_pass: document.getElementById('old_pass').value,
        new_pass: document.getElementById('new_pass').value,
        type: 2
    }, function(data) {
        if (data == '0') {
            alert('Sai mật khẩu');
        } else {
            alert('Cập nhật mật khẩu thành công');
            document.getElementById('old_pass').value = '';
            document.getElementById('new_pass').value = '';
            document.getElementById('re_new_pass').value = '';
        }
    });
    return false;
}
</script>
<?php require_once '../includes/Admin_permission.php'; ?>

</html>