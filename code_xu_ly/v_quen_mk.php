<?php 
require_once '../config/config.php';
$email = getValue('email','str','POST','');
$user_type = getValue('user_type','int','POST','');

$qr = new db_query("SELECT users.user_id, token, user_name FROM users INNER JOIN tokens ON users.user_id = tokens.user_id WHERE users.user_mail = '$email' AND user_type = $user_type");
if (mysql_num_rows($qr->result) == 0) {
	$data = [
		'type'=>0
	];
}else{
	$row = mysql_fetch_array($qr->result);
	$token = md5($row['user_id'] . $row['token']);
	$user_id = $row['user_id'];
	$user_name = $row['user_name'];
	$link = $domain.'/doi-mat-khau/id'. $row['user_id'] . '-'.time() . '-' . $token .'.html';
	$body = file_get_contents('../EmailTemplate/02_EmailQuenMatKhau.htm');
    $body = str_replace('<%name_company%>',$user_name,$body);
    $body = str_replace('<%link%>',$link,$body);
    $title = "Đổi mật khẩu";
	// $body = '<a href="http://localhost:8892/doi-mat-khau/id'. $row['user_id'] . '-'. $token .'.html">Nhấn vào đây để xác thực</a>';

	// $title = "Email đổi mật khẩu";

	SendMailAmazon($title,$user_name,$email,$body) ;
	$data = [
		'type'=>1
	];
}
echo json_encode($data);
?>