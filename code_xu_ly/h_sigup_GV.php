<?
require_once '../config/config.php';
if(isset($_POST['btn'])){
    $user_mail = getValue('usemail','str','POST','');
    //Kiểm tra Email
    $queryMail = new db_query("SELECT `user_mail` FROM `users` WHERE `user_mail` = '$user_mail'");
    $rowEmail = mysql_fetch_array($queryMail->result);

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
    
        $data= [
            'cit_id'=>$user_city,
            'district_id'=>$user_dis,
            'user_name'=>$user_name,
            'user_mail'=>$user_mail,
            'user_phone'=>$user_phone,
            'user_pass'=>md5($user_pass),
            'user_address'=>$user_address,
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

        $token = md5(time().$user_mail);
        setcookie('time_success',$token,time()+900,'/');
        $data4 = [
            'user_id'=>$id,
            'token' => $token
        ];
        add('tokens',$data4);

        // $title = "Email xác thực tài khoán";
        // $body = '<a href="http://localhost:8892/xac-thuc-thanh-cong/id'.$id.'-'.$token.'.html">Nhấn vào đây để xác thực</a>';
        // SendMailAmazon($title,$user_name,$user_mail,$body) ;
        header("Location: http://localhost:8892/xac-thuc-tai-khoan/id$id-$token.html");
    }
}
?>