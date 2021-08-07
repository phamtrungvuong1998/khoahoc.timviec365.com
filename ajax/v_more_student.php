<?php 
require_once '../config/config.php';
if (isset($_COOKIE['user_id'])) {
	$user_id = $_COOKIE['user_id'];
}else{
	$user_id = 0;
}
$n = getValue('n','int','GET','');
$cit_id = getValue('cit_id','int','GET','');
$qr = new db_query("SELECT * FROM users INNER JOIN city ON city.cit_id = users.cit_id WHERE users.user_avatar != '0' AND users.user_birth != '0000-00-00' AND users.cit_id != '0' AND users.cate_id != '0' AND users.cit_id = '$cit_id' AND users.user_type = 1 ORDER BY users.user_id DESC LIMIT $n,8");
$html = "";
while ($row = mysql_fetch_array($qr->result)) {
	$arrayCate = explode(",", $row['cate_id']);
	$cate_name = '';
	for ($i = 0; $i < count($arrayCate); $i++) {
		$cate_id = $arrayCate[$i];
		$qrCate = new db_query("SELECT `cate_name` FROM `categories` WHERE `cate_id` = '$cate_id'");
		$rowCate = mysql_fetch_array($qrCate->result);
		if ($i == count($arrayCate) - 1) {
			$cate_name = $cate_name . $rowCate['cate_name'];
		} else {
			$cate_name = $cate_name . $rowCate['cate_name'] . ",";
		}
	}
	$v_qrSave = new db_query("SELECT `save_id` FROM `save_student` WHERE `user_student_id` = ". $row['user_id'] ." AND `user_teacher_id` = '$user_id'");
	$v_rowSave = mysql_fetch_array($v_qrSave->result);
	if (!isset($v_rowSave['save_id'])) {
		$imgS = '../img/image/paperyellow1.svg';
	} else {
		$imgS = '../img/paperyellow.svg';
	}
	$html = $html . '<div class="student-item">
	<div class="item">
	<img src="'.$imgS.'" class="item-img" id="item-img-'.$row['user_id'].'"
	onclick="item_img('.$row['user_id'].','. $lg.')"
	style="cursor: pointer;" alt="Ảnh lỗi">
	</div>
	<div class="item1">
	<img onerror=\'this.onerror=null;this.src="../img/avatar/error.png";\'
	src="../img/avatar/'.$row['user_avatar'].'">
	<a href="'.urlDetail_student($row['user_id'], $row['user_slug']).'">
	<h3>'.$row['user_name'].'</h3>
	</a>
	</div>
	<div class="item2">
	<ul>
	<li>
	<div><img src="../img/image/video1.svg"></div>
	<span class="v_cate_name">
	Môn học quan tâm : '.$cate_name.'
	</span>
	</li>
	<li>
	<div style="margin-left: 3px;"><img src="../img/image/dailydate.svg"></div>
	'.$row['user_birth'].'
	</li>
	<li>
	<div><img src="../img/image/markerblue.svg"></div>
	'.$row['cit_name'].'
	</li>
	</ul>
	</div>
	</div>';
}

$more = '<button id="xemthem" onclick="more_student('.($n+8).','.$cit_id.')"><a>XEM THÊM</a></button>';

$data = [
	'html'=>$html,
	'more'=>$more
];

echo json_encode($data);
?>