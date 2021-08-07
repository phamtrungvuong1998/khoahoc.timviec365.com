<?php
require_once '../config/config.php';
$duoi = explode('/', $_FILES['file']['type']);
$duoi = $duoi[(count($duoi) - 1)];

$_FILES['file']['name'] = md5(rand()) . "." . $duoi;

$tmp_name = $_FILES['file']['tmp_name'];
$qr = new db_query("SELECT user_avatar,user_mail FROM users WHERE user_id = " . $_COOKIE['user_id']);
$row = mysql_fetch_array($qr->result);

if ($row['user_avatar'] != 0) {
	unlink('../img/avatar/'.$row['user_avatar']);
}

move_uploaded_file($tmp_name, '../img/avatar/'.$_FILES['file']['name']);
$data = [
	'user_avatar'=>$_FILES['file']['name']
];

$dataId = [
	'user_id'=>$_COOKIE['user_id']
];
update('users',$data,$dataId);

$data1 = [
	'avatar'=>$_FILES['file']['name']
];
//    --------đồng bộ cập nhật thông tin ứng viên-------------

$avt = "https://khoahoc.timviec365.com/img/avatar/" . $_FILES['file']['name'];
$data_api = [
    'email' => $row['user_mail'],
    'avatar' => $avt,
];
$loop = [
    'vltg' => "https://vieclamtheogio.timviec365.com/api/update_info_uv.php",
    'giasu' => "https://giasu.timviec365.com/api/update_info_uv.php",
    'freelancer' => "https://freelancer.timviec365.com/api/update_info_uv.php",
    'timviec365' => "https://timviec365.com/api/update_info_uv.php",
];
foreach ($loop as $key => $value) {
    call_api($value, $data_api);
}

//    ---------------------

echo json_encode($data1);
?>