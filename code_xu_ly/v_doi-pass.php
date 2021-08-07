<?php 
require_once '../config/config.php';
$password = getValue('password','str','POST','');
$newpassword = getValue('newpassword','str','POST','');
$password_md5 = md5($password);
$newpassword_md5 = md5($newpassword);

$qr = new db_query("SELECT user_id,user_mail FROM users WHERE user_pass = '$password_md5' AND user_id = " . $_COOKIE['user_id']);
if (mysql_num_rows($qr->result) == 0) {
	$data1 = [
		'alert'=>0
	];
}else{
	$data = [
		'user_pass'=>$newpassword_md5
	];

	$dataId = [
		'user_id'=>$_COOKIE['user_id']
	];

	update('users',$data,$dataId);

    //    -----đồng bộ đổi mật khẩu ứng viên--------
    $row = mysql_fetch_assoc($qr->result);
    $email = $row['user_mail'];
    $data_api = [
        'email'=>$email,
        'password'=>$password,
        'new_password'=>$newpassword,
    ];
    $loop = [
        'vltg'=>"https://vieclamtheogio.timviec365.com/api/doi_mk_uv.php",
        'giasu'=>"https://giasu.timviec365.com/api/doi_mk_uv.php",
        'freelancer'=>"https://freelancer.timviec365.com/api/doi_mk_uv.php",
        'timviec365'=>"https://timviec365.com/api/doi_mk_uv.php",
    ];
    foreach ($loop as $key => $value) {
        call_api($value,$data_api);
    }

//    -------------

	$data1 = [
		'alert'=>1
	];
}
echo json_encode($data1);

?>