<?php
session_start();
// session_destroy();
require_once '../includes/Admin_insert.php';
if ($_COOKIE['adm_type'] == 0) {
    $module = 7;
    $check = new db_query("SELECT * FROM admin_permission WHERE adm_id = $adm_id AND module_id = $module AND permis_create = 1");
    if (mysql_num_rows($check->result) == 0) {
        header("location:/admin/index.php");
    }
}
if(isset($_POST['create_teacher'])){
    $today = strtotime(date("d-m-Y"));
    $count = count($_POST['course_id']);
    $total_prices = $_POST['totalprice'];
    if($_POST['user_student_id'] != 0){
        $user_student_id = $_POST['user_student_id'];
            for($i = 0; $i < $count ; $i++){
                $course_id = $_POST['course_id']; 
                $course_type = $_POST['course_type']; 
                $data1 = [
                    'user_student_id'=>$user_student_id,
                    'course_id'=>$course_id[$i],
                    'total_prices'=>$total_prices,
                    'course_type'=>$course_type[$i],
                    'day_buy'=>$today
                ];
                add('orders',$data1);
            }
            session_destroy();
            header("location:/Admin/admin_list_order.php");
    }else{
        $student_name = getValue('student_name','str','POST','');
        $student_email = getValue('student_email','str','POST','');
        $student_phone = getValue('student_phone','str','POST','');
        $student_city = getValue('student_city','int','POST','');
        $student_district = getValue('student_district','int','POST','');
        $student_address = getValue('student_address','str','POST','');
        $student_gender = getValue('student_gender','int','POST','');
        $student_birth = getValue('student_birth','str','POST','');
        
        $checkmail = new db_query("SELECT user_mail FROM users WHERE user_mail = '$student_email'");
        if(mysql_num_rows($checkmail->result)>0){
        echo '<script>alert("Email đã tồn tại")</script>';
        }else{
            $data = [
            'cit_id'=>$student_city,
            'district_id'=>$student_district,
            'user_name'=>$student_name,
            'user_mail'=>$student_email,
            'user_phone'=>$student_phone,
            'user_address'=>$student_address,
            'user_gender'=>$student_gender,
            'user_birth'=>$student_birth,
            'user_type'=>1,
            'user_active'=>1,
            'user_slug'=>ChangeToSlug($student_name),
            'created_at'=>strtotime(date("d-m-Y")),
            'updated_at'=>strtotime(date("d-m-Y"))
            ];
            add('users',$data);
            $user_student_id = mysql_insert_id();
            for($i = 0; $i < $count ; $i++){
                $course_id = $_POST['course_id']; 
                $course_type = $_POST['course_type']; 
                $data1 = [
                    'user_student_id'=>$user_student_id,
                    'course_id'=>$course_id[$i],
                    'total_prices'=>$total_prices,
                    'course_type'=>$course_type[$i],
                    'day_buy'=>$today
                ];
                add('orders',$data1);
            }
            session_destroy();
            header("location:/Admin/admin_list_order.php");
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
    <title>Tạo đơn hàng</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
    #action5 {
        display: block;
    }

    #create_order {
        background: #18191b;
        border-left: 8px solid #13895F;
    }

    .select2-container--open .select2-dropdown--below,
    .select2-container {
        width: 500px !important;
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
            <?php require_once '../includes/Admin_nav.php';?>
            <center id="v_info_ad">
                <form method="POST" onsubmit="return validate()">
                    <div class="v_detail_student" style="margin-bottom: 50px;">
                        <div>Chọn học viên (Nếu có):</div>
                        <div class="city"><select name="user_student_id" id="user_student_id"
                                onchange="showdetail(this)">
                                <option value="0">--CHỌN Học viên--</option>
                                <?php
                                $qrus = new db_query("SELECT * FROM users WHERE user_type = 1");
                                while ($rowCit = mysql_fetch_array($qrus->result)) {
                                ?>
                                <option value="<?php echo $rowCit['user_id']; ?>">
                                    <?php echo $rowCit['user_phone'].'-'.$rowCit['user_name']; ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div id="showdetail">
                        <div class="v_detail_student">
                            <div>Tên học viên:</div>
                            <div><input type="text" id="student_name" name="student_name"
                                    value="<?php if(isset($_POST['student_name'])) echo $_POST['student_name'] ?>">
                            </div>
                        </div>
                        <div class="v_detail_student">
                            <div>Email:</div>
                            <div><input type="email" id="student_email" name="student_email"
                                    value="<?php if(isset($_POST['student_email'])) echo $_POST['student_email'] ?>">
                            </div>
                        </div>

                        <div class="v_detail_student">
                            <div>Số điện thoại:</div>
                            <div><input type="number" name="student_phone" id="student_phone"
                                    value="<?php if(isset($_POST['student_phone'])) echo $_POST['student_phone'] ?>">
                            </div>
                        </div>
                        <div class="v_detail_student">
                            <div>Tỉnh, thành phố:</div>
                            <div class="city"><select name="student_city" id="student_city" onchange="v_city()"
                                    required>
                                    <option value="0">--CHỌN TỈNH, THÀNH PHỐ--</option>
                                    <?php
                                $qrCit = new db_query("SELECT * FROM city");
                                while ($rowCit = mysql_fetch_array($qrCit->result)) {
                                ?>
                                    <option
                                        <?php if(isset($_POST['student_city']) && $_POST['student_city'] == $rowCit['cit_id']) echo 'selected' ?>
                                        value="<?php echo $rowCit['cit_id']; ?>"><?php echo $rowCit['cit_name']; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                                </select></div>
                        </div>
                        <div class="v_detail_student">
                            <div>Quận huyện:</div>
                            <div class="city"><select name="student_district" id="student_district">
                                    <option value="0">--chọn quận, huyện--</option>
                                    <?php
                                    $qrCit1 = new db_query("SELECT * FROM city WHERE cit_parent > 0");
                                    while ($rowCit = mysql_fetch_array($qrCit1->result)) {
                                    ?>
                                    <option
                                        <?php if(isset($_POST['student_district']) && $_POST['student_district'] == $rowCit['cit_id']) echo 'selected' ?>
                                        value="<?php echo $rowCit['cit_id']; ?>"><?php echo $rowCit['cit_name']; ?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select></div>
                        </div>

                        <div class="v_detail_student">
                            <div>Địa chỉ:</div>
                            <div><input type="text" name="student_address" id="student_address"
                                    value="<?php if(isset($_POST['student_address'])) echo $_POST['student_address'] ?>">
                            </div>
                        </div>

                        <div class="v_detail_student">
                            <div>Giới tính:</div>
                            <div><select name="student_gender" id="student_gender">
                                    <option value="0">Giới tính</option>
                                    <option
                                        <?php if(isset($_POST['student_gender']) && $_POST['student_gender'] == 1) echo 'selected' ?>
                                        value="1">Nam</option>
                                    <option
                                        <?php if(isset($_POST['student_gender']) && $_POST['student_gender'] == 2) echo 'selected' ?>
                                        value="2">Nữ</option>
                                </select></div>
                        </div>

                        <div class="v_detail_student">
                            <div>Ngày sinh:</div>
                            <div><input type="date" name="student_birth"
                                    value="<?php if(isset($_POST['student_birth'])) echo $_POST['student_birth'] ?>">
                            </div>
                        </div>

                    </div>
                    <div class="v_detail_student">
                        <a id="chonkh" data-toggle="modal" data-target="#exampleModal">+ Chọn khóa học</a>
                    </div>
                    <div class="tongtien">
                        Tổng Tiền : <span id="allprice">0 đ</span>
                        <input id="totalprice" value="0" name="totalprice" type="hidden">
                    </div>
                    <div id="showcart"></div>
                    <div>
                        <button type="submit" name="create_teacher" id="update_student">Thêm mới</button>
                    </div>
                </form>
            </center>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Chọn khóa học</h1>
                    <input type="text" id="searchcourse" onkeyup="searchcourse(this)">
                </div>
                <div class="modal-body" id="allcourse"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#student_city").select2();
    $("#student_district").select2();
    $("#course_id").select2();
    $("#user_student_id").select2();

    load_data();

    function load_data(page) {
        courses = 'courses';
        $.ajax({
            url: "../ajax/h_Admin_paginate.php",
            method: "POST",
            data: {
                page: page,
                courses: courses
            },
            success: function(data) {
                $('#allcourse').html(data);
            }
        })
    }
    $(document).on('click', '.page-link', function() {
        var page = $(this).attr("id");
        load_data(page);
    });
});


function v_city() {
    $.get("../ajax/v_district.php", {
        v_district: $("#student_city").val()
    }, function(data) {
        $("#student_district").html(data);
    })
}

function showdetail(e) {
    var user_id = $(e).val();
    $.ajax({
        url: "../ajax/Admin_create_order.php",
        type: "POST",
        data: {
            'user_id': user_id,
        },
        success: function(data) {
            $('#showdetail').html(data);
        }
    });
}

load_cart_data();

function load_cart_data() {
    $.ajax({
        url: "../ajax/Admin_fetch_cart.php",
        method: "POST",
        dataType: "json",
        success: function(data) {
            $('#showcart').html(data.cart_details);
            $('#allprice').text(data.total_price);
            $('#totalprice').val(data.dbtotalprice);
        }
    });
}

function addcart(e) {
    var course_id = $(e).attr("id");
    var course_name = $('#name' + course_id + '').val();
    var course_type = $('#type' + course_id + '').val();
    var prices = $('#price' + course_id + '').val();
    var action = "add";
    $.ajax({
        url: "../ajax/Admin_create_order.php",
        method: "POST",
        data: {
            course_id: course_id,
            course_name: course_name,
            course_type: course_type,
            prices: prices,
            action: action
        },
        success: function(data) {
            load_cart_data();
            $("#" + course_id).replaceWith('<input type="button" id="del' + course_id +
                '" value="Đã Thêm"  class="added">');
        }
    });
}

function searchcourse(e) {
    var key = $(e).val();
    $.ajax({
        url: "../ajax/Admin_create_order.php",
        method: "POST",
        data: {
            key: key,
        },
        success: function(data) {
            $("#filtercourse").html(data);
        }
    });
}

function delcart(e) {
    var course_id = $(e).attr("id");
    var action = 'remove';
    $.ajax({
        url: "../ajax/Admin_create_order.php",
        method: "POST",
        data: {
            action: action,
            course_id: course_id
        },
        success: function() {
            load_cart_data();
            $("#del" + course_id).replaceWith('<input type="button" id="' + course_id +
                '" value="Thêm" onclick="addcart(this)" class="add_to_cart" />');
        }
    });
}


function validate() {
    if ($("#totalprice").val() == 0) {
        alert('Vui lòng chọn khóa học');
        return false;
    }
    if ($("#student_name").val() == '') {
        alert("Vui lòng nhập tên");
        $('#student_name').focus();
        return false;
    }
    if ($("#student_phone").val() == '') {
        alert("Vui lòng nhập số điện thoại");
        $('#student_phone').focus();
        return false;
    }
    if ($("#student_email").val() == '') {
        alert("Vui lòng nhập email");
        $('#student_email').focus();
        return false;
    }
    if ($("#student_address").val() == '') {
        alert("Vui lòng chọn tỉnh, thành phố");
        $('#student_address').focus();
        return false;
    }
    if ($("#student_city").val() == 0) {
        alert("Vui lòng chọn tỉnh, thành phố");
        $('#student_city').focus();
        return false;
    }
    if ($("#student_district").val() == 0) {
        alert("Vui lòng chọn quận, huyện");
        $('#student_district').focus();
        return false;
    }
    if ($("#student_gender").val() == 0) {
        alert("Vui lòng chọn giới tính");
        $('#student_gender').focus();
        return false;
    }

}
</script>
<?php require_once '../includes/Admin_permission.php'; ?>

</html>