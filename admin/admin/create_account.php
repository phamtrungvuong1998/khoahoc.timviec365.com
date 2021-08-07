<?php 
require_once '../includes/Admin_insert.php'; 
if ($_COOKIE['adm_type'] == 0) {
    $module = 1;
    $check = new db_query("SELECT * FROM admin_permission WHERE adm_id = $adm_id AND module_id = $module AND permis_create = 1");
    if (mysql_num_rows($check->result) == 0) {
        header("location:/admin/index.php");
    }
}

if(isset($_POST['btn'])){
    $adm_login_name  		= getValue("adm_login_name","str","POST","");
    $adm_name  	            = getValue("adm_name","str","POST","");
    $adm_phone  		    = getValue("adm_phone","str","POST","");
    $adm_email  			= getValue("adm_email","str","POST","");
    $adm_password  	        = getValue("adm_password","str","POST","");

    $check1 = new db_query("SELECT adm_login_name FROM admin WHERE adm_login_name = $adm_login_name");
    $check2 = new db_query("SELECT adm_email FROM admin WHERE adm_email = $adm_email");
    if (mysql_num_rows($check1->result)>0) {
        echo "<script>alert('Tên đăng nhập đã được sử dụng')</script>";
    }elseif (mysql_num_rows($check2->result)>0) {
        echo "<script>alert('Email đã được sử dụng')</script>";
    }else{
        $data = [
            'adm_login_name'=>$adm_login_name,
            'adm_name'=>$adm_name,
            'adm_phone'=>$adm_phone,
            'adm_email'=>$adm_email,
            'adm_password'=>md5($adm_password),
            'adm_active'=>1
        ];
        add('admin', $data);
        $last_id = mysql_insert_id();

        for ($i=0; $i< count($_POST['module_id']); $i++) {
            $module_id = $_POST['module_id'];
            $create = getValue("create".$module_id[$i], "int", "POST", "0");
            $update = getValue("update".$module_id[$i], "int", "POST", "0");
            $data1 = [
            'adm_id'=>$last_id,
            'module_id'=>$module_id[$i],
            'permis_create'=>$create,
            'permis_create'=>$update,
        ];
            add('admin_permission', $data1);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm mới tài khoản</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <style>
    #v_account {
        background: #18191b;
        border-left: 8px solid #13895F;
    }

    #action1 {
        display: block;
    }

    #create_1 {
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
                <form id="form_account" method="POST" onsubmit="return validation()" enctype="multipart/form-data">
                    <div>
                        <div class="title_account">Tên đăng nhập:</div>
                        <div class="title_input"><input type="text" id="adm_login_name" name="adm_login_name">
                        </div>
                    </div>
                    <div>
                        <div class="title_account">Họ tên:</div>
                        <div class="title_input"><input type="text" id="adm_name" name="adm_name"></div>
                    </div>
                    <div>
                        <div class="title_account">Số điện thoại:</div>
                        <div class="title_input"><input type="text" id="adm_phone" name="adm_phone"></div>
                    </div>
                    <div>
                        <div class="title_account">Mật khẩu:</div>
                        <div class="title_input"><input id="password" type="password" name="adm_password">
                        </div>
                    </div>
                    <div>
                        <div class="title_account">Nhập lại mật khẩu:</div>
                        <div class="title_input"><input id="repassword" type="password"></div>
                    </div>
                    <div>
                        <div class="title_account">email:</div>
                        <div class="title_input"><input id="adm_email" type="email" name="adm_email"></div>
                    </div>
                    <div>
                        <div class="title_account">Quyền quản lí:</div>
                        <div class="title_input" id="title_manager">
                            <div id="manager">
                                <div id="v_select">Chọn</div>
                                <div id="v_list">Danh sách</div>
                                <div id="v_create">Thêm</div>
                                <div id="v_edit">Sửa</div>
                            </div>
                            <?php 
                                $qrPer = new db_query("SELECT * FROM admin_modules");
                                while ($rowPer = mysql_fetch_array($qrPer->result)) {
                            ?>
                            <div class="manager">
                                <div class="v_select"><input type="checkbox" id="module_id" name="module_id[]"
                                        value="<?=$rowPer['module_id']; ?>">
                                </div>
                                <div class="v_list"><?=$rowPer['module_name']; ?></div>
                                <div class="v_create"><input type="checkbox" id="create<?=$rowPer['module_id']; ?>"
                                        value="1" name="create<?=$rowPer['module_id']; ?>">
                                </div>
                                <div class="v_edit"><input type="checkbox" id="update<?=$rowPer['module_id']; ?>"
                                        value="1" name="update<?=$rowPer['module_id']; ?>"></div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div><button type="submit" name="btn" id="btn_account">Cập nhật</button></div>
                </form>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script type="text/javascript">
function validation() {
    if ($("#adm_login_name").val() == '') {
        alert("Vui lòng nhập tên");
        $('#adm_login_name').focus();
        return false;
    }
    if ($("#adm_phone").val() == '') {
        alert("Vui lòng nhập số điện thoại");
        $('#adm_phone').focus();
        return false;
    }
    if ($("#adm_email").val() == '') {
        alert("Vui lòng nhập email");
        $('#adm_email').focus();
        return false;
    }
    if ($("#adm_name").val() == '') {
        alert("Vui lòng nhập tên");
        $('#adm_name').focus();
        return false;
    }
    if ($("#password").val() == '') {
        alert("Vui lòng nhập mật khẩu");
        $('#password').focus();
        return false;
    }
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
<?php require_once '../includes/Admin_permission.php'; ?>

</html>