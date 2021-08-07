<?php
require_once '../config/config.php';
$id = getValue('id', 'int', 'POST', '');
$query = new db_query("SELECT user_name, user_mail, user_type,token FROM users INNER JOIN tokens ON users.user_id = tokens.user_id WHERE users.user_id = $id");
if (mysql_num_rows($query->result) == 0) {
	$data = [
		'type'=>0
	];
} else {
	$row = mysql_fetch_array($query->result);
	$token = $row['token'];
	if ($row['user_type'] == 1) {
		$title = 'Xác thực tài khoản học viên';
		$user_type = "học viên";
		$user_search = "tìm kiếm trung tâm";
	} else if ($row['user_type'] == 2) {
		$title = 'Xác thực tài khoản giảng viên';
		$user_type = "giảng viên";
		$user_search = "tìm kiếm học viên";
	} else {
		$title = 'Xác thực tài khoản trung tâm';
		$user_type = "trung tâm";
		$user_search = "đăng tin miễn phí và tìm hồ sơ ứng viên";
	}

	$user_name = $row['user_name'];
	$user_mail = $row['user_mail'];

	$link = $domain . '/xac-thuc-thanh-cong/id' . $id . '-' . time() . '-' . $token . '.html';
	$body = file_get_contents('../EmailTemplate/01_EmailXacThucTaiKhoanTrungTam.htm');
	$body = str_replace('<%name_company%>', $user_name, $body);
	$body = str_replace('<%user_type%>', $user_type, $body);
	$body = str_replace('<%user_search%>', $user_search, $body);
	$body = str_replace('<%link%>', $link, $body);

	SendMailAmazon($title, $user_name, $user_mail, $body);
	$data = [
		'type' => 1
	];
}
echo json_encode($data);

?>
