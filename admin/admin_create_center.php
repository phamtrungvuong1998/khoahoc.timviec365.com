<?php
require_once '../includes/Admin_insert.php';

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
                <form onsubmit="validate_update_center(); return false;">
                    <div class="v_detail_student">
                        <div>Tên trung tâm:</div>
                        <div><input type="text" id="center_name" name="center_name" required></div>
                    </div>
                    <p id="l_error1" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Email:</div>
                        <div><input type="email" id="center_email" name="center_email" required></div>

                    </div>
                    <p id="l_error2" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Số điện thoại:</div>
                        <div><input type="text" name="center_phone" maxlength="11" minlength="10" id="center_phone"
                                required></div>

                    </div>
                    <p id="l_error3" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Password:</div>
                        <div><input type="password" id="center_pass" name="center_password" required></div>

                    </div>
                    <p id="l_error4" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Nhập lại Password:</div>
                        <div><input type="password" id="center_repass" required></div>

                    </div>
                    <p id="l_error5" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Tỉnh, thành phố:</div>
                        <div class="city"><select name="center_city" id="center_city" onchange="v_city()">
                                <option value="0">--Chọn tỉnh, thành phố--</option>
                                <?php
                                $qrCit = new db_query("SELECT * FROM city");
                                while ($rowCit = mysql_fetch_array($qrCit->result)) {
                                ?>
                                <option value="<?php echo $rowCit['cit_id']; ?>"><?php echo $rowCit['cit_name']; ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <p id="l_error6" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Quận huyện:</div>
                        <div class="city"><select name="center_district" id="center_district">'
                                <option value="0">--chọn quận, huyện--</option>
                            </select></div>

                    </div>
                    <p id="l_error7" class="l_error"></p>

                    <div class="v_detail_student">
                        <div>Địa chỉ:</div>
                        <div><input type="text" name="center_address" id="center_address" required></div>

                    </div>
                    <p id="l_error8" class="l_error"></p>
                    <div><button onclick="validate_update_center(); return false;" type="button" name="create_student"
                            id="update_student">Thêm mới</button></div>
                </form>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript">
$("#center_city").select2();
$("#center_district").select2();
$("#categories").select2();

function v_city() {
    $.get("../ajax/v_district.php", {
        v_district: $("#center_city").val()
    }, function(data) {
        $("#center_district").html(data);
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

function l_validate() {
    var flag = false;
    var user = document.getElementById('center_name').value;
    var email = document.getElementById('center_email').value;
    var phone = document.getElementById('center_phone').value;
    var pass = document.getElementById('center_pass').value;
    var retypePass = document.getElementById('center_repass').value;
    var city = document.getElementById('center_city').value;
    var district = document.getElementById('center_district').value;
    var address = document.getElementById('center_address').value;
    if (user == "") {
        document.getElementById("l_error1").innerHTML = "Bạn chưa nhập tên trung tâm";
        document.getElementById('center_name').focus();
        return false;
    } else {
        document.getElementById("l_error1").innerHTML = '';
        flag = true;
    }
    if (arr.includes($('#center_email').val()) === true) {
        document.getElementById("l_error2").innerHTML = "Email đã tồn tại";
        document.getElementById('center_email').focus();
        return false;
    } else if (email == "") {
        document.getElementById("l_error2").innerHTML = "Bạn chưa nhập email";
        document.getElementById('center_email').focus();
        return false;
    } else {
        document.getElementById("l_error2").innerHTML = '';
        flag = true;
    }

    if (phone == "") {
        document.getElementById("l_error3").innerHTML = "Bạn chưa nhập số điện thoại";
        document.getElementById('center_phone').focus();
        return false;
    } else if (isNaN(phone)) {
        document.getElementById("l_error3").innerHTML = "Bạn chỉ được nhập số điện thoại";
        document.getElementById('center_phone').focus();
        return false;
    } else if (phone.charAt(0) != 0) {
        document.getElementById("l_error3").innerHTML = "Bạn nhập sai số điện thoại";
        document.getElementById('center_phone').focus();
        return false;
    } else if (phone.length == 9) {
        document.getElementById("l_error3").innerHTML = "Số điện thoại phải là 10 số";
        document.getElementById('center_phone').focus();
        return false;
    } else {
        document.getElementById("l_error3").innerHTML = '';
        flag = true;
    }

    if (pass == "") {
        document.getElementById("l_error4").innerHTML = "Bạn chưa nhập mật khẩu";
        document.getElementById('center_pass').focus();
        return false;
    } else if (pass.length < 7) {
        document.getElementById("l_error4").innerHTML = "Mật khẩu phải có ít nhất 8 ký tự";
        document.getElementById('center_pass').focus();
        return false;
    } else {
        document.getElementById("l_error4").innerHTML = '';
        flag = true;
    }

    if (retypePass == "") {
        document.getElementById("l_error5").innerHTML = "Bạn chưa nhập lại mật khẩu";
        document.getElementById('center_repass').focus();
        return false;
    } else if (pass != retypePass) {
        document.getElementById("l_error5").innerHTML = "Nhập lại mật khẩu sai";
        document.getElementById('center_repass').focus();
        return false;
    } else {
        document.getElementById("l_error5").innerHTML = '';
        flag = true;
    }

    if (city == 0) {
        document.getElementById("l_error6").innerHTML = "Bạn chưa nhập thành phố";
        document.getElementById('center_city').focus();
        return false;
    } else {
        document.getElementById("l_error6").innerHTML = '';
        flag = true;
    }

    if (district == 0) {
        document.getElementById("l_error7").innerHTML = "Bạn chưa nhập quận, huyện";
        document.getElementById('center_district').focus();
        return false;
    } else {
        document.getElementById("l_error7").innerHTML = '';
        flag = true;
    }

    if (address == "") {
        document.getElementById("l_error8").innerHTML = "Bạn chưa nhập địa chỉ";
        document.getElementById('center_address').focus();
        return false;
    } else {
        document.getElementById("l_error8").innerHTML = '';
        flag = true;
    }
    return flag;
}

function validate_update_center() {
    var flag = l_validate();
    if (flag == true) {
        var user = document.getElementById('center_name').value;
        var email = document.getElementById('center_email').value;
        var phone = document.getElementById('center_phone').value;
        var pass = document.getElementById('center_pass').value;
        var retypePass = document.getElementById('center_repass').value;
        var city = document.getElementById('center_city').value;
        var district = document.getElementById('center_district').value;
        var address = document.getElementById('center_address').value;

        var data = new FormData();
        data.append('user', user);
        data.append('email', email);
        data.append('phone', phone);
        data.append('pass', pass);
        data.append('retypePass', retypePass);
        data.append('city', city);
        data.append('district', district);
        data.append('address', address);

        $.ajax({
            url: '../ajax/admin_create_center.php',
            type: "post",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.result == 1) {
                    $('#l_error1').html('');
                    $('#l_error1').html(response.message);
                    // console.log(response.message)
                    // alert(response.message);
                    // window.location.href = 'tt_dsgiangvien.php?page=' + response.pagenew;
                } else if (response.result == 2) {
                    $('#center_name').val('');
                    $('#center_email').val('');
                    $('#center_phone').val('');
                    $('#center_pass').val('');
                    $('#center_repass').val('');
                    $('#center_city').val('');
                    $('#center_district').val('');
                    $('#center_address').val('');
                    alert(response.message)
                }
            },
        });
    }
}
</script>
<?php require_once '../includes/Admin_permission.php'; ?>

</html>