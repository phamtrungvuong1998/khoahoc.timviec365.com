<?php
require_once '../includes/Admin_insert.php';
if ($_COOKIE['adm_type'] == 0) {
    $module = 2;
    $check = new db_query("SELECT * FROM admin_permission WHERE adm_id = $adm_id AND module_id = $module AND permis_create = 1");
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
    <title>Danh sách học viên</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
    #action2 {
        display: block;
    }

    #create_2 {
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
                <form action="../code_xu_ly/v_admin_create_sudent.php" method="POST"
                    onsubmit="return validate_update_student();">
                    <div class="v_detail_student">
                        <div>Tên học viên:</div>
                        <div><input type="text" id="student_name" name="student_name" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Email:</div>
                        <div><input type="email" id="student_email" name="student_email" required></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Số điện thoại:</div>
                        <div><input type="text" name="student_phone" maxlength="11" minlength="10" id="student_phone"
                                required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Password:</div>
                        <div><input type="password" id="student_pass" name="student_password" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Nhập lại Password:</div>
                        <div><input type="password" id="student_repass" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tỉnh, thành phố:</div>
                        <div class="city"><select name="student_city" id="student_city" onchange="v_city()">
                                <option value="0">--CHỌN TỈNH, THÀNH PHỐ--</option>
                                <?php
            $qrCit = new db_query("SELECT * FROM city");
            while ($rowCit = mysql_fetch_array($qrCit->result)) {
              ?>
                                <option value="<?php echo $rowCit['cit_id']; ?>"><?php echo $rowCit['cit_name']; ?>
                                </option>
                                <?php
            }
            ?>
                            </select></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Quận huyện:</div>
                        <div class="city"><select name="student_district" id="student_district">'
                                <option value="0">--chọn quận, huyện--</option>
                            </select></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Địa chỉ:</div>
                        <div><input type="text" name="student_address" id="student_address" required></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Giới tính:</div>
                        <div><select name="student_gender" id="student_gender">
                                <option value="0">Giới tính</option>
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>
                            </select></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Ngày sinh:</div>
                        <div><input type="date" name="student_birth"></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Môn học quan tâm:</div>
                        <div><select name="student_cate[]" id="categories" multiple>
                                <?php
            $qrCate = new db_query("SELECT * FROM categories");
            while ($rowCate = mysql_fetch_array($qrCate->result)) {
              ?>
                                <option value="<?php echo $rowCate['cate_id']; ?>"><?php echo $rowCate['cate_name']; ?>
                                </option>
                                <?php
            }
            ?>
                            </select></div>
                    </div>
                    <div><button type="submit" name="create_student" id="update_student">Thêm mới</button></div>
                </form>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript">
$("#student_city").select2();
$("#student_district").select2();
$("#categories").select2();

function v_city() {
    $.get("../ajax/v_district.php", {
        v_district: $("#student_city").val()
    }, function(data) {
        $("#student_district").html(data);
    })
}
var arr = [];
<?php
  $qrEmail = new db_query("SELECT user_mail FROM users");
  while ($rowEmail = mysql_fetch_array($qrEmail->result)) {
  ?>
arr.push('<?php echo $rowEmail['user_mail']; ?>');
<?php  
  }
  ?>

function validate_update_student() {
    if (isNaN($("#student_phone").val())) {
        alert('Số điện thoại phải là số');
        return false;
    }
    if ($("#student_phone").val().charAt(0) != 0) {
        alert('Số điện thoại sai định dạng');
        return false;
    }
    if ($("#student_city").val() == 0) {
        alert("Vui lòng chọn tỉnh, thành phố");
        return false;
    }
    if ($("#student_district").val() == 0) {
        alert("Vui lòng chọn quận, huyện");
        return false;
    }
    if ($("#student_gender").val() == 0) {
        alert("Vui lòng chọn giới tính");
        return false;
    }
    if ($("#categories").val() == null) {
        alert("Vui lòng chọn môn học quan tâm");
        return false;
    }
    if ($("#student_pass").val() != $("#student_repass").val()) {
        alert("Nhập lại mật khẩu sai");
        return false;
    }
    if (arr.includes($('#student_email').val()) === true) {
        alert("Email đã tồn tại");
        return false;
    }

    alert("Thêm thành công");
}
</script>
<?php require_once '../includes/Admin_permission.php'; ?>

</html>