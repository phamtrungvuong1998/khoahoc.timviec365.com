<?
include_once '../config/config.php';
include_once 'functions.php';
use Firebase\JWT\JWT;
// thong tin ca nhan
$today = strtotime(date('d-m-Y'));
$name = getValue('name','str','POST','','');
$email = getValue('email','str','POST','','');
$phone = getValue('phone','str','POST','','');
$city = getValue('city','str','POST','','');
$district = getValue('district','str','POST','','');
$address = getValue('address','str','POST','','');
$pass = getValue('pass','str','POST','','');
// user_teacher_copp
$student_community = getValue('student_community','str','POST','','');
$lecture_online = getValue('lecture_online','str','POST','','');
$expect_coop = getValue('expect_coop','str','POST','','');

// user_teacher_exp
$cate_id = getValue('cate_id','str','POST','','');
$current_position = getValue('current_position','str','POST','','');
$current_company = getValue('current_company','str','POST','','');
$exp_work = getValue('exp_work','str','POST','','');
// $exp_teach = getValue('exp_teach','str','POST','','');
$location = getValue('location','str','POST','','');
$area = getValue('area','str','POST','','');
$year = getValue('year','str','POST','','');
$qualification = getValue('qualification','str','POST','','');
$profile_cv = getValue('profile_cv','str','POST','','');


if ($name != '' && $email != '' && $phone != '' && $city != '' && $district != ''&& $address != ''&& $pass != ''&& $cate_id != ''&& $current_position != ''&& $current_company != ''&& $location != ''&& $area != ''&& $year != ''&& $qualification != '') {
    $user_slug = ChangeToSlug($name);
    $token = md5(time() . $email);
    $pass = md5($pass);
    $db_mail = new db_query("SELECT user_mail FROM users WHERE user_mail = '$email'");
    if (mysql_num_rows($db_mail->result) > 0) {
        set_error('404', 'Email tồn tại');
    } else {
        $add1 = [
            'user_name' => $name,
            'user_mail' => $email,
            'user_phone' => $phone,
            'cit_id' => $city,
            'user_slug' => $user_slug,
            'user_type' => 2,
            'district_id' => $district,
            'user_address' => $address,
            'user_pass' => $pass,
            'created_at' => $today,
            'updated_at' => $today,
        ];
        add('users', $add1);
        $id = mysql_insert_id();
        // echo $id;
        // die();
        $exp_teach ='Vị trí: '. $location.' - Lĩnh vực: - '.$area.' - Số năm kinh nghiệm: - '.$year;
        $add2 = [
            'user_id' => $id,
            'link_lecture_online' => $lecture_online,
            'link_student_community' => $student_community,
            'expect_coop'=> $expect_coop,
        ];
        add('user_teach_cooperation',$add2);

        $data3 = [
            'user_id' => $id,
            'cate_id' => $cate_id,
            'current_position' => $current_position,
            'current_company' => $current_company,
            'exp_work' => $exp_work,
            'exp_teach' => $exp_teach,
            'qualification' => $qualification,
            'profile_cv' => $profile_cv,
        ];
        add('user_teach_experience', $data3);
        $data4 = [
            'user_id' => $id,
            'token' => $token
        ];
        $otp = rand(100000, 999999);
        $data_otp = [
            'otp' => $otp,
            'user_id' => $id,
            'time' =>time(),
        ];
        $token = JWT::encode($data_otp,$key);
        success('Đăng ký thành công',$token);
    }
}else {
    set_error('404','Bạn phải điền đầy đủ thông tin!');
}
?>