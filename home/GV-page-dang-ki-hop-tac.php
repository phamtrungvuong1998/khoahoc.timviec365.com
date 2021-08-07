<?php
require_once '../config/config.php';
if(isset($_POST['btn'])){
    $user_mail = getValue('usemail','str','POST','');
    //Kiểm tra Email
    $queryMail = new db_query("SELECT `user_mail` FROM `users` WHERE `user_mail` = '$user_mail' AND user_type = 2");
    $rowEmail = mysql_num_rows($queryMail->result);

    if ($rowEmail > 0) {
        $error = "<span class='l_text_color'>Email đã được sử dụng</span>";
    } else {
        $today = strtotime(date("d-m-Y"));
        $user_name = getValue('usename','str','POST','');
        $user_phone = getValue('usephone','str','POST','');
        $user_pass = getValue('pass','str','POST','');
        $user_city = getValue('cit_id','str','POST','');
        $user_dis = getValue('district_id','str','POST','');
        $user_address = getValue('address','str','POST','');
    
        $data = [
            'cit_id'=>$user_city,
            'district_id'=>$user_dis,
            'user_name'=>$user_name,
            'user_mail'=>$user_mail,
            'user_phone'=>$user_phone,
            'user_pass'=>md5($user_pass),
            'user_address'=>$user_address,
            'user_money'=>0,
            'user_slug'=> ChangeToSlug($user_name),
            'user_type'=>2,
            'created_at'=>$today,
            'updated_at'=>$today
        ];
        add('users', $data);
        $id = mysql_insert_id();

        $current_position = getValue('current_position','str','POST','');
        $current_company = getValue('current_company','str','POST','');
        $exp_work = getValue('exp_work','str','POST','');
        $exp_teach = getValue('exp_teach','str','POST','');
        $qualification = getValue('qualification','str','POST','');
        $profile_cv = getValue('profile_cv','str','POST','');

        $data2= [
            'user_id'=>$id,
            'current_position'=>$current_position,
            'current_company'=>$current_company,
            'exp_work'=>$exp_work,
            'exp_teach'=>$exp_teach,
            'qualification'=>$qualification,
            'profile_cv'=>$profile_cv
        ];
        add('user_teach_experience', $data2);

        $benefit_id = getValue('benefit_id','str','POST','0');
        $method_coop = getValue('method_coop','str','POST','0');
        $teach_online_id = getValue('teach_online_id','str','POST','0');
        $link_lecture_online = getValue('link_lecture_online','str','POST','');
        $link_student_community = getValue('link_student_community','str','POST','');
        $expect_coop = getValue('expect_coop','str','POST','');

        $data3 = [
            'user_id'=>$id,
            'benefit_id'=>$benefit_id,
            'method_coop'=>$method_coop,
            'teach_online_id'=>$teach_online_id,
            'link_lecture_online'=>$link_lecture_online,
            'link_student_community'=>$link_student_community,
            'expect_coop'=>$expect_coop
        ];
        add('user_teach_cooperation', $data3);

        $token = md5(time().$user_mail);
        $data4 = [
            'user_id'=>$id,
            'token' => $token
        ];
        add('tokens',$data4);

        $title = 'Xác thực tài khoản giảng viên';
        $user_type = "giảng viên";
        $user_search = "tìm kiếm học viên";
        $link = $domain.'/xac-thuc-thanh-cong/id' . $id . '-' . time() . '-' . $token . '.html';
        $body = file_get_contents('../EmailTemplate/01_EmailXacThucTaiKhoanTrungTam.htm');
        $body = str_replace('<%name_company%>', $user_name, $body);
        $body = str_replace('<%user_type%>', $user_type, $body);
        $body = str_replace('<%user_search%>', $user_search, $body);
        $body = str_replace('<%link%>', $link, $body);
        SendMailAmazon($title, $user_name, $user_mail, $body);
        setcookie('user_id',$id,time() + 3600*6,'/');
        setcookie('user_type',2,time() + 3600*6,'/');
        //     --------set cookie UV chung---------
        $arr_cookie['page_login'] = 5;
        $arr_cookie['check_ntd'] = 3;
        $arr_cookie['from'] = 'khoahoc.timviec365.com';
        $arr_cookie['email'] = $user_mail;
        $arr_cookie['phone'] = $user_phone;
        $arr_cookie['name'] = $user_name;
        $arr_cookie['cit_id'] = $user_city;
        $arr_cookie['district_id'] = $user_dis;
        $arr_cookie['address'] = $user_address;
        $arr_cookie['pw'] = md5($user_pass);
        $arr_cookie['avatar'] = '';
        $arr_cookie['active'] = 0;
        $token_cookie = json_encode($arr_cookie);
        setcookie('general_login', $token_cookie, time() + 7*6000,'/','.timviec365.com');
//     --------------------
        $time = time();
        header("Location: /xac-thuc-tai-khoan.html");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/select2.min.css" />
    <link rel="stylesheet" href="../css/GV-tro-thanh-gv.css">
    <link rel="stylesheet" href="../css/h_footer.css">
    <title>Page đăng kí hợp tác trở thành Giảng Viên</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-sm-7"><img class="lazyload" src="/img/load.gif"
                    data-src="../img/GV-page-tro-thanh-gv.png" alt="Ảnh lỗi"></div>
            <div class="col-lg-5 col-sm-5" id="v_title">
                <p id="v_title-1">REGISTRATION FORM</p>
                <p id="v_title-2">Biểu mẫu đăng ký hợp tác</p>
                <p id="v_title-3">Anh Chị vui lòng cung cấp đầy đủ các thông tin theo biểu mẫu bên dưới. <a>Khóa học</a> sẽ liên hệ lại với anh chị trong vòng 05 ngày làm việc</p>
            </div>
            <div class="col-lg-12 col-sm-12">
                <p id="v_bieu-mau-title">LƯU Ý: CÁC Ô ĐÁNH DẤU <span>*</span> LÀ THÔNG TIN BẮT BUỘC PHẢI NHẬP</p>
                <center>
                    <form method="POST" id="v_form" onsubmit="return validation()">
                        <div class="v_form-1">
                            <div id="v_form-title">
                                <hr id="v_form-title-hr">
                                <p id="v_form-title-1">THÔNG TIN LIÊN HỆ</p>
                            </div>
                            <div class="v_form-detail">
                                <label class="v_form-label">Họ và tên <span>*</span> <span class='l_text_color'
                                        id="error1"></span> </label>
                                <input type="text" id="usename" name="usename" class="v_form-input" placeholder="Nguyễn Văn A"
                                    value="<?php if(isset($_POST['usename'])) echo $_POST['usename'] ?>">
                            </div>
                            <div class="v_form-detail">
                                <label class="v_form-label">Địa chỉ email <span>*</span>
                                    <?php  
										if(isset($error)){echo $error;}
									?>
                                    <span class='l_text_color' id="error2"></span>
                                </label>
                                <input type="email" id="usemail" name="usemail" class="v_form-input"
                                   placeholder="12345@gmail.com" value="<?php if(isset($_POST['usemail'])) echo $_POST['usemail'] ?>">

                            </div>
                            <div class="v_form-detail">
                                <label class="v_form-label">Số điện thoại <span>*</span> <span class='l_text_color'
                                        id="error3"></span></label>
                                <input type="text" onkeypress="isnumber(event)" id="usephone" name="usephone" class="v_form-input" placeholder="Số điện thoại" value="<?php if(isset($_POST['usephone'])) echo $_POST['usephone'] ?>">
                            </div>
                            <div class="v_form-detail">
                                <label class="v_form-label">Mật khẩu <span>*</span> <span class='l_text_color'
                                        id="error4"></span></label>
                                <input type="password" placeholder="Mật khẩu" name="pass" id="pass1" class="v_form-input">
                            </div>
                            <div class="v_form-detail">
                                <label class="v_form-label">Nhập lại mật khẩu <span>*</span> <span class='l_text_color'
                                        id="error5"></span><span class='l_text_color' id="error6"></span></label>
                                <input type="password" placeholder="Nhập lại mật khẩu" id="pass2" class="v_form-input">
                            </div>
                            <div id="v_form-address">
                                <div class="v_form-address-2">
                                    <div class="v_form-label">Tỉnh Thành <span>*</span> <span class='l_text_color'
                                            id="error7"></span></div>
                                    <select id="cit_id" name="cit_id">
                                        <option value="0">Chọn tỉnh thành</option>
                                        <?
                                        
									$db_cit = new db_query("SELECT `cit_id`,`cit_name` FROM `city` WHERE `cit_parent` = 0");
                                    while ($row = mysql_fetch_array($db_cit->result)) {
                                        ?>
                                        <option
                                            <?php if(isset($_POST['cit_id']) && $_POST['cit_id'] == $row['cit_id']) echo 'selected'; ?>
                                            class="chontinhthanh" value="<?=$row['cit_id']?>"><?=$row['cit_name']?>
                                        </option>
                                        <?
      		                              }
										?>
                                    </select>
                                </div>
                                <div class="v_form-address-3">
                                    <div class="v_form-label">Quận, huyện <span>*</span> <span class='l_text_color'
                                            id="error8"></span></div>
                                    <select name="district_id" id="district_id">
                                        <option value="0">Chọn Quận huyện</option>
                                        <?
									$db_qh = new db_query("SELECT `cit_id`,`cit_name` FROM `city` WHERE `cit_parent` > 0");
                                    while ($row = mysql_fetch_array($db_qh->result)) {
                                        ?>
                                        <option
                                            <?php if(isset($_POST['district_id']) && $_POST['district_id'] == $row['cit_id']) echo 'selected'; ?>
                                            class="chonquanhuyen" value="<?=$row['cit_id']?>"><?=$row['cit_name']?>
                                        </option>
                                        <?
      		                              }
										?>
                                    </select>
                                </div>
                                <div class="v_form-address-1">
                                    <label class="v_form-label">Địa chỉ <span>*</span> <span class='l_text_color'
                                            id="error9"></span></label>
                                    <input type="text" placeholder="Địa chỉ" name="address" id="address" class="v_form-input-2"
                                        value="<?php if(isset($_POST['address'])) echo $_POST['address'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="v_form-2">
                            <div id="v_form-title">
                                <hr id="v_form-title-hr">
                                <p id="v_form-title-1">KINH NGHIỆM - BẰNG CẤP</p>
                            </div>
                            <div class="v_form-detail">
                                <label class="v_form-label">Chức vụ hiện tại <span>*</span> <span class='l_text_color'
                                        id="error10"></span></label>
                                <input type="text" name="current_position" id="current_position" class="v_form-input" placeholder="Chức danh - vị trí công việc hiện tại"
                                    value="<?php if(isset($_POST['current_position'])) echo $_POST['current_position'] ?>">
                            </div>

                            <div class="v_form-detail">
                                <label class="v_form-label">Nơi công tác <span>*</span> <span class='l_text_color'
                                        id="error11"></span></label>
                                <input type="text" name="current_company" id="current_company" class="v_form-input" placeholder="Tên công ty/ tổ chức"
                                    value="<?php if(isset($_POST['current_company'])) echo $_POST['current_company'] ?>">
                            </div>
                            <div class="v_form-detail">
                                <label class="v_form-label">Kinh nghiệm làm việc của Anh/Chị <span>*</span><span
                                        class='l_text_color' id="error12"></span>
                                </label>
                                <textarea name="exp_work" placeholder="Lĩnh vực làm việc - Vị trí - Số năm kinh nghiệm" 
                                    id="exp_work"><?php if(isset($_POST['exp_work'])) echo $_POST['exp_work'] ?></textarea>
                            </div>
                            <div class="v_form-detail">
                                <label class="v_form-label">Kinh nghiệm giảng dạy của Anh/Chị <span>*</span><span
                                        class='l_text_color' id="error13"></span>
                                </label>
                                <textarea name="exp_teach" placeholder="Lĩnh vực giảng dạy - Tổ chức đào tạo - Số năm kinh nghiệm"
                                    id="exp_teach"><?php if(isset($_POST['exp_teach'])) echo $_POST['exp_teach'] ?></textarea>
                            </div>
                            <div class="v_form-detail">
                                <label class="v_form-label">Bằng cấp - Chứng chỉ <span>*</span><span
                                        class='l_text_color' id="error14"></span>
                                </label>
                                <textarea name="qualification" placeholder="Bằng cấp, chứng chỉ liên quan đến lĩnh vực muốn giảng dạy" 
                                    id="qualification"><?php if(isset($_POST['qualification'])) echo $_POST['qualification'] ?></textarea>
                            </div>
                            <div class="v_form-detail">
                                <label class="v_form-label">Profile - Cv</label>
                                <input type="text" class="v_form-input" name="profile_cv" placeholder="Anh chị vui lòng dẫn link Profile - CV"
                                    value="<?php if(isset($_POST['profile_cv'])) echo $_POST['profile_cv'] ?>"
                                    placeholder="Anh chị vui lòng dẫn link Profile - CV">
                            </div>
                        </div>

                        <div class="v_form-3">
                            <div id="v_form-title">
                                <hr id="v_form-title-hr">
                                <p id="v_form-title-1">THÔNG TIN HỢP TÁC</p>
                            </div>

                            <div class="v_form-detail">
                                <label class="v_form-label-2">Hình thức muốn hợp tác <span>*</span> <span
                                        class='l_text_color' id="error15"></span>
                                </label></label>
                                <div class="row" style="margin-left: 0">
                                    <div class="col-lg-1 col-sm-1 col-xs-1 v_form-radio"><input type="radio" name="method_coop" <?php if(isset($_POST['method_coop']) == 1) echo 'checked'; ?> value="1">
                                    </div>
                                    <div class="col-lg-11 col-sm-11 col-xs-11 v_form-radio-text">Hợp tác phân phối khóa học ( Anh
                                        chị có sẵn khóa học hoàn chỉnh và mong muốn được phân phối trên nền tảng Khóa
                                        học )</div>
                                    <div class="col-lg-1 col-sm-1 col-xs-1 v_form-radio"><input type="radio" name="method_coop"
                                            <?php if(isset($_POST['method_coop']) == 2) echo 'checked'; ?> value="2">
                                    </div>
                                    <div class="col-lg-11 col-sm-11 col-xs-11 v_form-radio-text">Hợp tác sản xuất khóa học ( Anh
                                        chị có nội dung giảng dạy và mong muốn hợp tác quay dừng, sản xuất khóa học độc
                                        quyền )</div>
                                    <div class="col-lg-1 col-sm-1 col-xs-1 v_form-radio"><input type="radio" name="method_coop"
                                            <?php if(isset($_POST['method_coop']) == 3) echo 'checked'; ?> value="3">
                                    </div>
                                    <div class="col-lg-11 col-sm-11 col-xs-11 v_form-radio-text">Cả hai</div>
                                </div>

                                <label class="v_form-label-3">Anh/Chị đã từng giảng dạy online chưa
                                    <span>*</span> <span class='l_text_color' id="error16"></span> </label>
                                <div class="row" style="margin-left: 0;">
                                    <?
									$db_teach = new db_query("SELECT * FROM `teach_online`");
                                    while ($row = mysql_fetch_array($db_teach->result)) {
                                        ?>
                                    <div class="col-lg-1 col-sm-1 col-xs-1 v_form-radio"><input type="radio"
                                            <?php if(isset($_POST['teach_online_id']) == $row['teach_online_id']) echo 'checked'; ?>
                                            value="<?=$row['teach_online_id']?>" name="teach_online_id">
                                    </div>
                                    <div class="col-lg-11 col-sm-11 col-xs-11 v_form-radio-text"><?=$row['teach_method']?></div>
                                    <?
									}
									?>
                                </div>
                            </div>

                            <div class="v_form-detail">
                                <label class="v_form-label">Link bài giảng online ( Nếu có )</label>
                                <input type="text" name="link_lecture_online" class="v_form-input" placeholder="Link Video demo trên Google Driver, Link Youtube, Link trên Website..."
                                    value="<?php if(isset($_POST['link_lecture_online'])) echo $_POST['link_lecture_online'] ?>">
                            </div>

                            <div class="v_form-detail">
                                <label class="v_form-label">Link cộng đồng học viên ( Nếu có )</label>
                                <input type="text" name="link_student_community" class="v_form-input" placeholder="Link Facebook cá nhân/ Facebook fanpage/ Youtube/ Website cá nhân..."
                                    value="<?php if(isset($_POST['link_student_community'])) echo $_POST['link_student_community'] ?>">
                            </div>

                            <div class="v_form-detail">
                                <label class="v_form-label-3">Chủ đề giảng dạy <span>*</span> <span class='l_text_color'
                                        id="error17"></span></label>
                                <p id="v_form-3-p">Anh Chị lưu ý chọn đúng ô có chiều lĩnh vực và trình độ tương ứng với
                                    nội dung mà mình muốn hợp tác. Có thể chọn nhiều mục.</p>
                            </div>
                            <div id="v_form-detail-2">
                                <div class="v_form-detail-2-text">
                                    <div></div>
                                    <div>Cơ bản</div>
                                    <div>Nâng cao</div>
                                    <div>Chuyên sâu</div>
                                    <div>Mọi cấp độ</div>
                                </div>
                                <?
								$db_cat = new db_query("SELECT `cate_id`,`cate_name` FROM `categories`");
                                while ($row = mysql_fetch_array($db_cat->result)) {
                                    $cate_name = $row['cate_name'];
                                    $cate_id = $row['cate_id'];
                                    ?>
                                <div class="v_form-detail-2-text">
                                    <div class="v_linh-vuc"><?=$row['cate_name']?></div>
                                    <div><input
                                            <?php if(isset($_POST["cate_id1$cate_id"]) == $row['cate_id']) echo 'checked'; ?>
                                            value="<?=$row['cate_id']?>" type="checkbox" name="cate_id1<?=$cate_id?>">
                                    </div>
                                    <div><input
                                            <?php if(isset($_POST["cate_id2$cate_id"]) == $row['cate_id'])  echo 'checked'; ?>
                                            value="<?=$row['cate_id']?>" type="checkbox" name="cate_id2<?=$cate_id?>">
                                    </div>
                                    <div><input
                                            <?php if(isset($_POST["cate_id3$cate_id"]) == $row['cate_id'] ) echo 'checked'; ?>
                                            value="<?=$row['cate_id']?>" type="checkbox" name="cate_id3<?=$cate_id?>">
                                    </div>
                                    <div><input
                                            <?php if(isset($_POST["cate_id4$cate_id"]) == $row['cate_id']) echo 'checked'; ?>
                                            value="<?=$row['cate_id']?>" type="checkbox" name="cate_id4<?=$cate_id?>">
                                    </div>
                                </div>
                                <?php
                                }
								?>
                            </div>

                            <div class="v_form-detail">
                                <label class="v_form-label-3">Dưới đây là các lợi ích tiêu biểu khi trở thành
                                    giảng viên của chúng tôi. Anh chị vui lòng chọn điều anh/chị quan tâm nhất
                                    <span>*</span> <span class='l_text_color' id="error18"></span></label>
                                <div class="row">
                                    <?
									$db_benef = new db_query("SELECT * FROM `benefit_become_teacher`");
                                    while ($row = mysql_fetch_array($db_benef->result)) {
                                        ?>
                                    <div class="col-lg-11 col-sm-11 v_form-radio-text"><?=$row['benefit_name'] ?></div>
                                    <div class="col-lg-1 col-sm-1 v_form-radio"><input type="radio" name="benefit_id"
                                            <?php if(isset($_POST['benefit_id']) == $row['benefit_id']) echo 'checked'; ?>
                                            value="<?=$row['benefit_id'] ?>"></div>
                                    <?php
                                    }
									?>
                                </div>

                                <label class="v_form-label-3">Anh chị có mong đợi hay chia sẻ gì thêm về việc
                                    đăng kí hợp tác?</label>
                                <textarea name="expect_coop"
                                    id="expect_coop"><?php if(isset($_POST['expect_coop'])) echo $_POST['expect_coop'] ?></textarea>
                            </div>
                            <button name="btn" id="v_btn-submit">HOÀN TẤT ĐĂNG KÍ</button>

                    </form>
                </center>
            </div>
        </div>
    </div>
    <?php require_once '../includes/h_inc_footer.php'; ?>
    <script src="../js/select2.min.js"></script>
    <script>
        function isnumber(evt) {
            var num = String.fromCharCode(evt.which);
            if (!(/[0-9]/.test(num))) {
                evt.preventDefault();
            }
        }

    $(document).ready(function() {
        $('#cit_id').select2({
            data: $('.chontinhthanh').val()
        });
        $('#district_id').select2({
            data: $('.chonquanhuyen').val()
        });
        $('#cate_id').select2({
            multiple: true,
            maximumSelectionLength: 5,
            minimumInputLength: 0,
        });
        $('#cit_id').change(function() {
            tinh = $(this).val();
            $.ajax({
                type: "POST",
                url: "/../ajax/h_ajax_load_city.php",
                data: {
                    tinh: tinh
                },
                success: function(result) {
                    $("#district_id").html(result);
                }
            });
        });
        $('#usephone').on('keyup', function() {
            var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
            var tele = $(this).val();
            if (tele !== '') {
                if (vnf_regex.test(tele) == false) {
                    document.getElementById('error3').innerHTML = 'Số điện thoại không hợp lệ !';
                } else {
                    document.getElementById('error3').innerHTML = '';
                }
            }
        });
        $('.camera-img').click(function() {
            $('#img').click();
        });
    });

    function changeImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#avatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function validation() {
        var usename = $('#usename').val();
        var usemail = $('#usemail').val();
        var usephone = $('#usephone').val();
        var pass1 = $('#pass1').val();
        var pass2 = $('#pass2').val();
        var current_position = $('#current_position').val();
        var address = $('#address').val();
        var district_id = $('#district_id').val();
        var cit_id = $('#cit_id').val();
        var current_company = $('#current_company').val();
        var exp_work = $('#exp_work').val();
        var exp_teach = $('#exp_teach').val();
        var qualification = $('#qualification').val();
        var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        var rePass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        flag = true;

        if (district_id == 0 || district_id == '') {
            document.getElementById('error8').innerHTML = 'Chọn quận huyện';
            $('#district_id').focus();
            return false;
        } else {
            document.getElementById('error8').innerHTML = '';
        }
        if (current_position == '') {
            document.getElementById('error10').innerHTML = 'Hãy điền chức vụ';
            $('#current_position').focus();
            flag = false;
        } else {
            document.getElementById('error10').innerHTML = '';
        }
        if (current_company == '') {
            document.getElementById('error11').innerHTML = 'Hãy điền công ty';
            $('#current_company').focus();
            flag = false;
        } else {
            document.getElementById('error11').innerHTML = '';
        }
        if (exp_work == '') {
            document.getElementById('error12').innerHTML = 'Hãy điền kinh nghiệm làm việc';
            $('#exp_work').focus();
            flag = false;
        } else {
            document.getElementById('error12').innerHTML = '';
        }
        if (exp_teach == '') {
            document.getElementById('error13').innerHTML = 'Hãy điền kinh nghiệm dạy';
            $('#exp_teach').focus();
            flag = false;
        } else {
            document.getElementById('error13').innerHTML = '';
        }
        if (qualification == '') {
            document.getElementById('error14').innerHTML = 'Hãy nêu bằng cấp';
            $('#qualification').focus();
            flag = false;
        } else {
            document.getElementById('error14').innerHTML = '';
        }
        if (cit_id == 0) {
            document.getElementById('error7').innerHTML = 'Vui chọn tỉnh thành';
            $('#cit_id').focus();
            flag = false;
        } else {
            document.getElementById('error7').innerHTML = '';
        }
        if (address == '') {
            document.getElementById('error9').innerHTML = 'Vui lòng nhập địa chỉ';
            $('#address').focus();
            flag = false;
        } else {
            document.getElementById('error9').innerHTML = '';
        }
        if (pass1 == '') {
            document.getElementById('error4').innerHTML = 'Vui lòng nhập mật khẩu';
            $('#pass1').focus();
            flag = false;
        } else if (pass1.length < 8) {
            document.getElementById('error4').innerHTML = 'Mật khẩu phải lớn hơn 8 ký tự';
            $('#pass1').focus();
            flag = false;
        }else if(rePass.test(pass1) == false){
            document.getElementById('error4').innerHTML = 'Mật khẩu phải chứa chữ và số';
            $('#pass1').focus();
            flag = false;
        } else {
            document.getElementById('error4').innerHTML = '';
        }
        
        if (pass2 == '') {
            document.getElementById('error6').innerHTML = 'Vui lòng nhập lại mật khẩu';
            $('#pass2').focus();
            flag = false;
        } else if (pass1 != pass2) {
            document.getElementById('error6').innerHTML = 'Mật khẩu nhập lại không chính xác';
            $('#pass2').focus();
            flag = false;
        } else {
            document.getElementById('error6').innerHTML = '';
        }

        if (usephone == '') {
            document.getElementById('error3').innerHTML = 'Vui lòng nhập số điện thoại';
            $('#usephone').focus();
            flag = false;
        } else if (vnf_regex.test(usephone) == false) {
            document.getElementById('error3').innerHTML = 'Số điện thoại không hợp lệ !';
            $('#usephone').focus();
            flag = false;
        } else {
            document.getElementById('error3').innerHTML = '';
        }

        if (usemail == '') {
            document.getElementById('error2').innerHTML = 'Vui lòng nhập Email';
            $('#usemail').focus();
            flag = false;
        } else {
            document.getElementById('error2').innerHTML = '';
        }

        if (usename == '') {
            document.getElementById('error1').innerHTML = 'Vui lòng nhập tên';
            $('#usename').focus();
            flag = false;
        } else {
            document.getElementById('error1').innerHTML = '';
        }

        var method_coop = document.getElementsByName("method_coop");
        for (var i = 0; i < method_coop.length; i++) {
            if (method_coop[i].checked == true) {
                document.getElementById('error15').innerHTML = '';
                flag = true;
                break;
            }
        }
        if (i == method_coop.length) {
            document.getElementById('error15').innerHTML = 'Hãy chọn hình thức';
            flag = false;
        }

        var teach_online_id = document.getElementsByName("teach_online_id");
        for (var i = 0; i < teach_online_id.length; i++) {
            if (teach_online_id[i].checked == true) {
                document.getElementById('error16').innerHTML = '';
                flag = true;
                break;
            }
        }
        if (i == teach_online_id.length) {
            document.getElementById('error16').innerHTML = 'Anh/Chị đã từng giảng dạy online chưa !';
            flag = false;
        }

        var cate_id = document.getElementsByName("cate_id");
        for (var i = 0; i < cate_id.length; i++) {
            if (cate_id[i].checked == true) {
                document.getElementById('error17').innerHTML = '';
                flag = true;
                break;
            }
        }
        if (i == cate_id.length) {
            document.getElementById('error17').innerHTML = 'Vui lòng chọn Chủ đề giảng dạy !';
            flag = false;
        }

        var benefit_id = document.getElementsByName("benefit_id");
        for (var i = 0; i < benefit_id.length; i++) {
            if (benefit_id[i].checked == true) {
                document.getElementById('error18').innerHTML = '';
                flag = true;
                break;
            }
        }
        if (i == benefit_id.length) {
            document.getElementById('error18').innerHTML = 'Vui lòng chọn điều anh/chị quan tâm nhất !';
            flag = false;
        }
        return flag;
    }

    function validation2() {
        var usename = $('#usename').val();
        var usephone = $('#usephone').val();
        var current_position = $('#current_position').val();
        var address = $('#address').val();
        var district_id = $('#district_id').val();
        var cit_id = $('#cit_id').val();
        var current_company = $('#current_company').val();
        var exp_work = $('#exp_work').val();
        var exp_teach = $('#exp_teach').val();
        var qualification = $('#qualification').val();
        var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        flag = true;

        if (usename == '') {
            document.getElementById('error1').innerHTML = 'Vui lòng nhập tên';
            $('#usename').focus();
            flag = false;
        } else {
            document.getElementById('error1').innerHTML = '';
        }

        if (usephone == '') {
            document.getElementById('error3').innerHTML = 'Vui lòng nhập số điện thoại';
            $('#usephone').focus();
            flag = false;
        } else if (vnf_regex.test(usephone) == false) {
            document.getElementById('error3').innerHTML = 'Số điện thoại không hợp lệ !';
            $('#usephone').focus();
            flag = false;
        } else {
            document.getElementById('error3').innerHTML = '';
        }

        if (address == '') {
            document.getElementById('error9').innerHTML = 'Vui lòng nhập địa chỉ';
            $('#address').focus();
            flag = false;
        } else {
            document.getElementById('error9').innerHTML = '';
        }
        if (cit_id == 0) {
            document.getElementById('error7').innerHTML = 'Vui chọn tỉnh thành';
            $('#cit_id').focus();
            flag = false;
        } else {
            document.getElementById('error7').innerHTML = '';
        }
        if (district_id == 0 || district_id == '') {
            document.getElementById('error8').innerHTML = 'Vui lòng chọn quận huyện';
            $('#district_id').focus();
            flag = false;
        } else {
            document.getElementById('error8').innerHTML = '';
        }
        if (current_position == '') {
            document.getElementById('error10').innerHTML = 'Hãy điền chức vụ';
            $('#current_position').focus();
            flag = false;
        } else {
            document.getElementById('error10').innerHTML = '';
        }
        if (current_company == '') {
            document.getElementById('error11').innerHTML = 'Hãy điền công ty';
            $('#current_company').focus();
            flag = false;
        } else {
            document.getElementById('error11').innerHTML = '';
        }
        if (exp_work == '') {
            document.getElementById('error12').innerHTML = 'Hãy điền kinh nghiệm làm việc';
            $('#exp_work').focus();
            flag = false;
        } else {
            document.getElementById('error12').innerHTML = '';
        }
        if (exp_teach == '') {
            document.getElementById('error13').innerHTML = 'Hãy điền kinh nghiệm dạy';
            $('#exp_teach').focus();
            flag = false;
        } else {
            document.getElementById('error13').innerHTML = '';
        }
        if (qualification == '') {
            document.getElementById('error14').innerHTML = 'Hãy nêu bằng cấp';
            $('#qualification').focus();
            flag = false;
        } else {
            document.getElementById('error14').innerHTML = '';
        }

        return flag;
    }
    </script>
</body>

</html>