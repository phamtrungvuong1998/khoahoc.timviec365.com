<?php
require_once '../config/config.php';
$today = strtotime(date("d-m-Y"));
$user_name = getValue('username','str','POST','');
$user_mail = getValue('email','str','POST','');
$user_phone = getValue('phone','str','POST','');
$user_pass = getValue('pass','str','POST','');
$md5_user_pass = md5($user_pass);
//Kiểm tra Email có tồn tại không
$queryMail = new db_query("SELECT user_id FROM users WHERE user_mail = '$user_mail' AND user_type = 1");
if (mysql_num_rows($queryMail->result) == 1) {
	$data = [
		'type'=>0
	];
}else if (mysql_num_rows($queryMail->result) == 0) {
	$token = md5(time().$user_mail);
	$data1 = [
		'user_name'=>$user_name,
		'user_mail'=>$user_mail,
		'user_phone'=>$user_phone,
		'user_pass'=>$md5_user_pass,
		'user_type'=>1,
		'user_slug'=> ChangeToSlug($user_name),
		'user_money'=>0,
		'created_at'=>$today,
		'updated_at'=>$today,
	];
	add('users', $data1);
	$id = mysql_insert_id();
    
    $title = 'Xác thực tài khoản học viên';
    $user_type = "học viên";
    $user_search = "tìm kiếm trung tâm";
    $link = $domain.'/xac-thuc-thanh-cong/id' . $id . '-' . time() . '-' . $token . '.html';
    $body = file_get_contents('../EmailTemplate/01_EmailXacThucTaiKhoanTrungTam.htm');
    $body = str_replace('<%name_company%>', $user_name, $body);
    $body = str_replace('<%user_type%>', $user_type, $body);
    $body = str_replace('<%user_search%>', $user_search, $body);
    $body = str_replace('<%link%>', $link, $body);
    SendMailAmazon($title, $user_name, $user_mail, $body);
    setcookie('user_id',$id,time() + 3600*6,'/');
    setcookie('user_type',1,time() + 3600*6,'/');
    //------------đồng bộ đăng ký ứng viên---------------

    $data_api = [
        'site_from'=>5,
        'email'=>$user_mail,
        'from' => 'khoahoc.timviec365.com',
        'password' => $user_pass,
        'name' => $user_name,
        'gender'=>'',
        'birthday' => '',
        'phone' => $user_phone,
        'city_id' => 0,
        'district_id' => 0,
        'address' => '',
        'job' => '',
        'job_address' => '',
        'career' => '',
        'avatar' => '',
    ];
    // $url = "";
    $loop = [
        'vltg' => "https://vieclamtheogio.timviec365.com/api/register_uv.php",
        'giasu' => "https://giasu.timviec365.com/api/register_uv.php",
        'freelancer' => "https://freelancer.timviec365.com/api/register_uv.php",
        'timviec365' => "https://timviec365.com/api/register_uv.php",
    ];

    foreach($loop as $key => $value){
        call_api($value,$data_api);
    }
    //     --------set cookie UV chung---------
    $arr_cookie['page_login'] = 5;
    $arr_cookie['check_ntd'] = 2;
    $arr_cookie['from'] = 'khoahoc.timviec365.com';
    $arr_cookie['email'] = $user_mail;
    $arr_cookie['phone'] = $user_phone;
    $arr_cookie['name'] = $user_name;
    $arr_cookie['cit_id'] = '';
    $arr_cookie['district_id'] = '';
    $arr_cookie['address'] = '';
    $arr_cookie['pw'] = $md5_user_pass;
    $arr_cookie['avatar'] = '';
    $arr_cookie['active'] = 0;
    $token_cookie = json_encode($arr_cookie);
    setcookie('general_login', $token_cookie, time() + 7*6000,'/','.timviec365.com');
//     --------------------

	// Thêm vào tokens 
	$data2 = [
		'user_id'=>$id,
		'token' => $token
	];
	add('tokens',$data2);

	$data = [
		'type'=>1,
		'id'=>$id,
		'token'=>$token,
		'time'=>time()
	];
}
echo json_encode($data);
?>