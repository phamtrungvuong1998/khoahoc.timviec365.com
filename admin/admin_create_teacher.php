<?php
require_once '../includes/Admin_insert.php';
if ($_COOKIE['adm_type'] == 0) {
    $module = 3;
    $check = new db_query("SELECT * FROM admin_permission WHERE adm_id = $adm_id AND module_id = $module AND permis_create = 1");
    if (mysql_num_rows($check->result) == 0) {
        header("location:/admin/index.php");
    }
}
if(isset($_POST['create_teacher'])){
    $teacher_name = getValue('teacher_name','str','POST','');
    $teacher_email = getValue('teacher_email','str','POST','');
    $teacher_phone = getValue('teacher_phone','str','POST','');
    $teacher_city = getValue('teacher_city','int','POST','');
    $teacher_district = getValue('teacher_district','int','POST','');
    $teacher_address = getValue('teacher_address','str','POST','');
    $teacher_gender = getValue('teacher_gender','int','POST','');
    $teacher_birth = getValue('teacher_birth','str','POST','');
    $teacher_cate = getValue('teacher_cate','arr','POST','');
    $teacher_pass = getValue('teacher_pass','str','POST','');

    $cate_id = implode(",", $teacher_cate);

    $checkmail = new db_query("SELECT user_mail FROM users WHERE user_mail = '$student_email'");
    if(mysql_num_rows($checkmail->result)>0){
        echo '<script>alert("Email đã tồn tại")</script>';
    }else{
        $data = [
        'cit_id'=>$teacher_city,
        'district_id'=>$teacher_district,
        'cate_id'=>$cate_id,
        'user_name'=>$teacher_name,
        'user_mail'=>$teacher_email,
        'user_phone'=>$teacher_phone,
        'user_pass'=>md5($teacher_pass),
        'user_address'=>$teacher_address,
        'user_gender'=>$teacher_gender,
        'user_birth'=>$teacher_birth,
        'user_slug'=>ChangeToSlug($teacher_name),
        'user_type'=>2,
        'user_active'=>1,
        'created_at'=>strtotime(date("d-m-Y")),
        'updated_at'=>strtotime(date("d-m-Y"))
    ];

        add('users', $data);
        $id = mysql_insert_id();

        $current_position = getValue('current_position', 'str', 'POST', '');
        $current_company = getValue('current_company', 'str', 'POST', '');
        $exp_work = getValue('exp_work', 'str', 'POST', '');
        $exp_teach = getValue('exp_teach', 'str', 'POST', '');
        $qualification = getValue('qualification', 'str', 'POST', '');

        $data2= [
        'user_id'=>$id,
        'current_position'=>$current_position,
        'current_company'=>$current_company,
        'exp_work'=>$exp_work,
        'exp_teach'=>$exp_teach,
        'qualification'=>$qualification,
    ];
        add('user_teach_experience', $data2);

        $benefit_id = getValue('benefit_id', 'str', 'POST', '0');
        $method_coop = getValue('method_coop', 'str', 'POST', '0');
        $teach_online_id = getValue('teach_online_id', 'str', 'POST', '0');
        $link_lecture_online = getValue('link_lecture_online', 'str', 'POST', '');
        $link_student_community = getValue('link_student_community', 'str', 'POST', '');
        $expect_coop = getValue('expect_coop', 'str', 'POST', '');

        $data3= [
            'user_id'=>$id,
            'benefit_id'=>$benefit_id,
            'method_coop'=>$method_coop,
            'teach_online_id'=>$teach_online_id,
            'link_lecture_online'=>$link_lecture_online,
            'link_student_community'=>$link_student_community,
            'expect_coop'=>$expect_coop
        ];
        add('user_teach_cooperation', $data3);

        header("Location: /Admin/admin_list_teacher.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm giảng viên</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
    #action3 {
        display: block;
    }

    #create_3 {
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

    .v_detail_student textarea {
        width: 100%;
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
                <form method="POST" onsubmit="return validate_update_student();">
                    <div class="v_detail_student">
                        <div>Tên học giảng viên:</div>
                        <div><input type="text" id="teacher_name" name="teacher_name" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Email:</div>
                        <div><input type="email" id="teacher_email" name="teacher_email" required></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Số điện thoại:</div>
                        <div><input type="text" name="teacher_phone" maxlength="11" minlength="10" id="teacher_phone"
                                required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Password:</div>
                        <div><input type="password" id="teacher_pass" name="teacher_password" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Nhập lại Password:</div>
                        <div><input type="password" id="teacher_repass" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tỉnh, thành phố:</div>
                        <div class="city"><select name="teacher_city" id="teacher_city" onchange="v_city()">
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
                        <div class="city"><select name="teacher_district" id="teacher_district">'
                                <option value="0">--chọn quận, huyện--</option>
                            </select></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Địa chỉ:</div>
                        <div><input type="text" name="teacher_address" id="teacher_address" required></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Giới tính:</div>
                        <div><select name="teacher_gender" id="teacher_gender">
                                <option value="0">Giới tính</option>
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>
                            </select></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Ngày sinh:</div>
                        <div><input type="date" name="teacher_birth"></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Kinh nghiệm giảng dạy:</div>
                        <div><textarea name="exp_teach"></textarea></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Kinh nghiệm làm việc:</div>
                        <div><textarea name="exp_work"></textarea></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Bằng cấp - Chứng chỉ:</div>
                        <div><textarea name="qualification"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Chức vụ hiện tại:</div>
                        <div><input type="text" name="current_position"></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Công ty hiện tại:</div>
                        <div><input type="text" name="current_company"></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Chủ đề giảng dạy:</div>
                        <div><select name="teacher_cate[]" id="categories" multiple>
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
                    <div><button type="submit" name="create_teacher" id="update_student">Thêm mới</button></div>
                </form>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript">
$("#teacher_city").select2();
$("#teacher_district").select2();
$("#categories").select2();

function v_city() {
    $.get("../ajax/v_district.php", {
        v_district: $("#teacher_city").val()
    }, function(data) {
        $("#teacher_district").html(data);
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
    if (isNaN($("#teacher_phone").val())) {
        alert('Số điện thoại phải là số');
        return false;
    }
    if ($("#teacher_phone").val().charAt(0) != 0) {
        alert('Số điện thoại sai định dạng');
        return false;
    }
    if ($("#teacher_city").val() == 0) {
        alert("Vui lòng chọn tỉnh, thành phố");
        return false;
    }
    if ($("#teacher_district").val() == 0) {
        alert("Vui lòng chọn quận, huyện");
        return false;
    }
    if ($("#teacher_gender").val() == 0) {
        alert("Vui lòng chọn giới tính");
        return false;
    }
    if ($("#categories").val() == null) {
        alert("Vui lòng chọn môn học quan tâm");
        return false;
    }
    if ($("#teacher_pass").val() != $("#teacher_repass").val()) {
        alert("Nhập lại mật khẩu sai");
        return false;
    }
    if (arr.includes($('#teacher_email').val()) === true) {
        alert("Email đã tồn tại");
        return false;
    }

    alert("Thêm thành công");
}
</script>
<?php require_once '../includes/Admin_permission.php'; ?>

</html>