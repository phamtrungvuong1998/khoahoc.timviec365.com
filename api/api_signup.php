
<?php
include_once '../config/config.php';
require_once 'functions.php';
use Firebase\JWT\JWT;

$name = getValue('name','str','POST','');
$email = getValue('email','str','POST','');
$phone = getValue('phone','int','POST','');
$pass = getValue('pass','str','POST','');
$today = strtotime(date('d-m-Y'));

if($email != ''){
    $db_user = new db_query("SELECT user_mail FROM users WHERE user_mail = '$email'");
    if (mysql_num_rows($db_user->result) > 0) {
        set_error('404','Email đã tồn tại');
    }else{
        if ($name != '' && $phone !='' && $pass != '') {

        	$pass = md5($pass);

            $token = md5(time().$email);
            $user = [
                'user_name'=>$name,
                'user_mail' => $email,
                'user_phone' => $phone,
                'user_pass' => $pass,
                'user_type'=>1,
                'user_slug'=> ChangeToSlug($name),
                'user_money'=>0,
                'created_at'=>$today,
                'updated_at'=>$today,
            ];

            add('users',$user);

            $id = mysql_insert_id();
            
            $data_token = [
                'user_id'=> $id,
                'token' => $token
            ];

            add('tokens', $data_token); 

            $otp = rand(100000,999999);
            
            $token_otp = [
                'otp'=>$otp,
                'user_id'=>$id,
                'time'=>time()
            ];

            $token_t = JWT::encode($token_otp,$key);
            $data = [
                'token' => $token_t,
            ];
            success('Mã xác thực đã được gửi về email',$data);
        }else{
        	set_error('404','Không được để trống');
        }
    }
}else{
    set_error('404','Không được để trống');
}
?>
