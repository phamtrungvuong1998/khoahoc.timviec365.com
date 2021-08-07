<?php
require_once '../includes/Admin_insert.php';

$center_id = getValue('id', 'int', 'GET', 0, 0);
if ($center_id == 0) {
    header('location: admin_list_center.php');
}
$db_user = new db_query("SELECT * FROM users Where user_id = '$center_id'");
$db_user_center = new db_query("SELECT * FROM user_center Where user_id = '$center_id'");
$db_cat = new db_query("SELECT * FROM categories");
$db_ad = new db_query("SELECT * FROM advantages_center");
$row_user = mysql_fetch_assoc($db_user->result);
$user_center = mysql_fetch_assoc($db_user_center->result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cập nhật trung tâm</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
        #action2 {
            display: block;
        }

        /* #create_student {
            background: #18191b;
            border-left: 8px solid #13895F;
        } */

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

        .l_flex {
            display: flex;
            justify-content: space-around;
        }

        .l_width {
            width: 100%;
        }

        .l_city {
            width: 20%;
            text-align: left;
        }

        .city1 {

            text-align: left;
        }

        #l_gioithieu {
            width: 100%;
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
            background: no-repeat;
            border-radius: 10px;
        }

        .select2-container--default .select2-selection--single {
            height: 45px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            float: right;
            margin-left: 10px;
            color: #1B6AAB;
            border-radius: 100px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            padding: 4px 4px 4px 8px;
            border: none;
            border-radius: 16px;
            color: #1B6AAB;
            margin-right: 10px;
        }

        .select2-container--default .select2-selection--multiple {
            width: 100%;
            height: 192px;
            border: 1px solid #0000001F;
            border-radius: 8px;
            padding-top: 16px;
            padding-left: 15px;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: 1px solid rgba(0, 0, 0, 0.12) !important;
        }

        .select2-container--open .select2-dropdown {
            left: 0px;
            top: 3px;
        }

        .l_padding {
            padding-bottom: 100px !important;
        }
    
        .alert-success{
            position: fixed;
            width: 20%;
            top: 20px;
            right: 1%;
            z-index: 1;
            background: #dff0d8;
            color: #3c763d;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
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
            <div id="alert"></div>
            <center id="v_info_ad">
                <form onsubmit="validate_update_center(<? echo $row_user['user_id'] ?>); return false;">
                    <div class="v_detail_student">
                        <div>Tên trung tâm:</div>
                        <div><input type="text" value="<? echo $row_user['user_name']; ?>" id="center_name" name="center_name" required></div>
                    </div>
                    <p id="l_error1" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Email:</div>
                        <div><input type="email" readonly value="<? echo $row_user['user_mail']; ?>" id="center_email" name="center_email" required></div>

                    </div>
                    <p id="l_error2" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Số điện thoại:</div>
                        <div><input type="text" value="<? echo $row_user['user_phone']; ?>" name="center_phone" maxlength="11" minlength="10" id="center_phone" required></div>

                    </div>
                    <p id="l_error3" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Ngày hoạt động:</div>
                        <div><input type="date" value="<? echo $row_user['user_birth']; ?>" id="center_date" name="center_password" required></div>

                    </div>
                    <p id="l_error4" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Mã số thuế:</div>
                        <div><input type="text" value="<? echo $user_center['tax_code'] ?>" id="center_thue" required></div>

                    </div>
                    <p id="l_error5" class="l_error"></p>
                    <?
                    $db_basis = new db_query("SELECT * FROM user_center_basis WHERE user_id = '$center_id'");
                    while ($row = mysql_fetch_assoc($db_basis->result)) {
                    ?>
                        <div class="v_detail_student">
                            <span class="l_city">Tỉnh, thành phố:</span>
                            <div class="city1">
                                <select class="center_city" name="center_city[]" id="center_city<? echo $row['center_basis_id'] ?>" onchange="v_city(<? echo $row['center_basis_id'] ?>)">
                                    <option value="0">--Chọn tỉnh, thành phố--</option>
                                    <?php
                                    $row_city = $row['cit_id'];
                                    $qrCit = new db_query("SELECT * FROM city WHERE cit_parent = 0");
                                    while ($rowCit = mysql_fetch_array($qrCit->result)) {
                                    ?>
                                        <option <?
                                                if ($row['cit_id'] == $rowCit['cit_id']) {
                                                    echo 'selected';
                                                }
                                                ?> value="<?php echo $rowCit['cit_id']; ?>"><?php echo $rowCit['cit_name']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <p id="l_error6" class="l_error"></p>
                            </div>
                        </div>
                        <div class="v_detail_student">
                            <span class="l_city">Quận huyện:</span>
                            <div class="city1">
                                <select class="center_district" name="center_district[]" id="center_district<? echo $row['center_basis_id'] ?>">
                                    <?
                                    $tinh = $row['cit_id'];
                                    $dis = new db_query("SELECT * FROM city Where cit_parent='$tinh'");
                                    while ($row_dis = mysql_fetch_assoc($dis->result)) {
                                    ?>
                                        <option <?
                                                if ($row['district_id'] == $row_dis['cit_id']) {
                                                    echo "selected";
                                                }
                                                ?> value="<? echo $row_dis['cit_id'] ?>"><? echo $row_dis['cit_name'] ?></option>
                                    <?
                                    }
                                    ?>
                                </select>
                                <p id="l_error7" class="l_error"></p>
                            </div>
                        </div>
                        <div class="v_detail_student">
                            <div>Địa chỉ:</div>
                            <div><input type="text" name="center_address[]" value="<? echo $row['center_basis_address']; ?>" id="center_address" required>
                                <p id="l_error8" class="l_error"></p>
                            </div>

                        </div>
                    <?
                    }
                    ?>

                    <p id="l_error8" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Giới thiệu trung tâm:</div>
                        <div><textarea name="" id="l_gioithieu" cols="30" rows="10"><? echo $user_center['center_intro'] ?></textarea></div>

                    </div>
                    <p id="l_error9" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Link cộng đồng:</div>
                        <div><input type="text" value="<? echo $user_center['link_student_community'] ?>" id="l_link" name="l_link" required></div>

                    </div>
                    <p id="l_error10" class="l_error"></p>
                    <div id="l_chudegiangday" class="v_detail_student l_chudegiangday">
                        <div>Chủ đề giảng dạy:</div>
                        <div>
                            <select name="l_chude[]" id="l_chude" multiple>
                                <?php
                                $cat = $row_user['cate_id'];
                                $cat_ex = explode(',', $cat);
                                while ($row = mysql_fetch_assoc($db_cat->result)) { ?>
                                    <option value="
                                        <?
                                        echo $row['cate_id'];
                                        ?>" <?
                                            for ($i = 0; $i < count($cat_ex); $i++) {
                                                if ($row['cate_id'] == $cat_ex[$i]) {
                                                    echo "selected";
                                                }
                                            }
                                            ?>>
                                        <? echo $row['cate_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                    <p id="l_error11" class="l_error"></p>
                    <div class="v_detail_student">
                        <div>Ưu điểm trung tâm:</div>
                        <div class="l_hinhanh_item l_flex">
                            <?
                            $chude = $user_center['advantages_id'];
                            $chude_ex = explode(',', $chude);
                            $dem = 1;
                            while ($ad = mysql_fetch_assoc($db_ad->result)) {
                            ?>
                                <div class="l_checkbox l_flex">
                                    <input <?
                                            for ($i = 0; $i < count($chude_ex); $i++) {
                                                if ($ad['advantages_id'] == $chude_ex[$i]) {
                                                    echo "checked";
                                                }
                                            }
                                            ?> type="checkbox" class="l_img_checkbox l_check" id="<? echo $ad['advantages_id'] ?>" name="check1[]" value="<? echo $ad['advantages_id'] ?>">
                                    <label for="<? echo $ad['advantages_id'] ?>" class="l_text_checkbox"><? echo $ad['advantages_name'] ?></label>
                                </div>
                            <?
                                //$dem++;
                            }
                            ?>
                        </div>

                    </div>
                    <p id="l_error12" class="l_error"></p>
                    <div class="l_padding"><button onclick="validate_update_center(<? echo $row_user['user_id'] ?>); return false;" type="button" name="create_student" id="update_student">Thêm mới</button></div>
                </form>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript">
    $(".center_city").select2();
    $(".center_district").select2();
    $("#categories").select2();
    $(document).ready(function() {
        $("#l_chude").select2();
    });

    function v_city(a) {
        var b = $("#center_city" + a).val()
        console.log(b);
        $.get("../ajax/l_ajax_load_city.php", {
            l_district: $("#center_city" + a).val()
        }, function(data) {
            $("#center_district" + a).html(data);
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
        // var phone = document.getElementById('center_phone').value;
        var center_date = document.getElementById('center_date').value;
        var center_thue = document.getElementById('center_thue').value;
        var city = document.getElementsByClassName('center_city').value;
        var district = document.getElementsByClassName('center_district').value;
        var address = document.getElementById('center_address').value;
        var l_gioithieu = document.getElementById('l_gioithieu').value;
        var l_link = document.getElementById('l_link').value;
        var l_chude = document.getElementById('l_chude').value;
        if (user == "") {
            document.getElementById("l_error1").innerHTML = "Bạn chưa nhập tên trung tâm";
            document.getElementById('center_name').focus();
            return false;
        } else {
            document.getElementById("l_error1").innerHTML = '';
            flag = true;
        }

        var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        var mobile = $('#center_phone').val();
        if (mobile == '') {
            document.getElementById("l_error3").innerHTML = "Bạn chưa nhập số điện thoại";
            document.getElementById('center_phone').focus();
            return false;
        } else if (vnf_regex.test(mobile) == false) {
            document.getElementById("l_error3").innerHTML = "Số điện thoại không đúng định dạng";
            document.getElementById('center_phone').focus();
            return false;
        } else {
            document.getElementById("l_error3").innerHTML = '';
            flag = true;
        }
        //     if (vnf_regex.test(mobile) == false) {
        //         alert('Số điện thoại của bạn không đúng định dạng!');
        //     } else {
        //         alert('Số điện thoại của bạn hợp lệ!');
        //     }


        // if (phone == "") {
        //     document.getElementById("l_error3").innerHTML = "Bạn chưa nhập số điện thoại";
        //     document.getElementById('center_phone').focus();
        //     return false;
        // } else if (isNaN(phone)) {
        //     document.getElementById("l_error3").innerHTML = "Bạn chỉ được nhập số điện thoại";
        //     document.getElementById('center_phone').focus();
        //     return false;
        // } else if (phone.charAt(0) != 0) {
        //     document.getElementById("l_error3").innerHTML = "Bạn nhập sai số điện thoại";
        //     document.getElementById('center_phone').focus();
        //     return false;
        // } else if (phone.length == 9) {
        //     document.getElementById("l_error3").innerHTML = "Số điện thoại phải là 10 số";
        //     document.getElementById('center_phone').focus();
        //     return false;
        // } else {
        //     document.getElementById("l_error3").innerHTML = '';
        //     flag = true;
        // }

        if (center_date == "") {
            document.getElementById("l_error4").innerHTML = "Bạn chưa nhập ngày hoạt động";
            document.getElementById('center_date').focus();
            return false;
        } else {
            document.getElementById("l_error4").innerHTML = '';
            flag = true;
        }

        if (center_thue == "0") {
            document.getElementById("l_error5").innerHTML = "Bạn chưa nhập mã số thuế";
            document.getElementById('center_thue').focus();
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
        if (l_gioithieu == "") {
            document.getElementById("l_error9").innerHTML = "Bạn chưa nhập giới thiệu";
            document.getElementById('l_gioithieu').focus();
            return false;
        } else {
            document.getElementById("l_error9").innerHTML = '';
            flag = true;
        }
        if (l_link == "0") {
            document.getElementById("l_error10").innerHTML = "Bạn chưa nhập đường link";
            document.getElementById('l_link').focus();
            return false;
        } else {
            document.getElementById("l_error10").innerHTML = '';
            flag = true;
        }
        if (l_chude == "") {
            document.getElementById("l_error11").innerHTML = "Bạn chưa chọn chủ đề";
            document.getElementById('l_chude').focus();
            return false;
        } else {
            document.getElementById("l_error11").innerHTML = '';
            flag = true;
        }

        if (($("input[name*='check1']:checked").length) == 0) {
            document.getElementById("l_error12").innerHTML = "Bạn chưa chọn ưu điểm trung tâm";
            return false;
        } else {
            document.getElementById("l_error12").innerHTML = "";
            flag = true;
        }
        return flag;
    }

    function validate_update_center(a) {
        var flag = l_validate();
        if (flag == true) {
            var user = document.getElementById('center_name').value;
            var phone = document.getElementById('center_phone').value;
            var center_date = document.getElementById('center_date').value;
            var center_thue = document.getElementById('center_thue').value;
            // var city = document.getElementById('center_city').value;
            // var district = document.getElementById('center_district').value;
            // var address = document.getElementById('center_address').value;
            var l_gioithieu = document.getElementById('l_gioithieu').value;
            var l_link = document.getElementById('l_link').value;
            // var l_chude = document.getElementById('l_chude').value;

            var data = new FormData();
            data.append('id', a);
            data.append('user', user);
            data.append('phone', phone);
            data.append('center_date', center_date);
            data.append('center_thue', center_thue);

            var l_city = [];
            $('.center_city :selected').each(function() {
                l_city.push($(this).val());
            });
            data.append('l_city', l_city);
            var l_district = [];
            $('.center_district :selected').each(function() {
                l_district.push($(this).val());
            });
            data.append('l_district', l_district);

            var l_address = $('input[name="center_address[]"]').map(function() {
                return this.value;
            }).get();
            data.append('l_address', l_address);

            data.append('l_gioithieu', l_gioithieu);
            data.append('l_link', l_link);
            var l_chude = [];
            $('#l_chude :selected').each(function() {
                l_chude.push($(this).val());
            });
            data.append('l_chude', l_chude);

            var l_check = [];
            $(".l_check").each(function() {
                if ($(this).is(":checked")) {
                    l_check.push($(this).val());
                }
            });
            data.append('l_check', l_check);

            $.ajax({
                url: '../ajax/admin_update_center.php',
                type: "post",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.result == 1) {
                        $("#l_error1").html(response.message);
                        $('#center_name').focus();
                    } else if (response.result == 2) {
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                $(".alert-success").remove();
                            });
                        }, 3000);
                    }
                },
            });
        }
    }
</script>
<?php require_once '../includes/Admin_permission.php'; ?>

</html>