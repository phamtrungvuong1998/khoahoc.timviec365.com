<?php
require_once '../config/config.php';

$number = getValue('number','int','GET','');

$type = getValue('type','int','GET','');

$start = ($number - 1) * 6; 

$user_id = $_COOKIE['user_id'];

if ($type == 2) {
	$qr = new db_query("SELECT *,users.created_at FROM users INNER JOIN save_teacher ON save_teacher.teacher_id = users.user_id WHERE save_teacher.user_student_id = '$user_id' ORDER BY users.user_id DESC LIMIT $start,6");
	// echo $qr->query;
}else if ($type == 3) {
	$qr = new db_query("SELECT * FROM users INNER JOIN save_center ON save_center.center_id = users.user_id WHERE save_center.user_student_id = '$user_id' ORDER BY user_id DESC LIMIT $start,6");
}
$html = '';
while ($row = mysql_fetch_array($qr->result)) {
	if ($type == 2) {
		$qrRate = new db_query("SELECT teacher FROM courses INNER JOIN rate_course ON courses.course_id = rate_course.course_id WHERE user_id = " . $row['user_id']);
		$rate_all = 0;
		while($rowRate = mysql_fetch_array($qrRate->result)){
			$rate_all = $rate_all + $rowRate['teacher'];
		}
		$rate_all = round($rate_all/mysql_num_rows($qrRate->result),1);
		$link = urlDetail_teacher($row['user_id'], $row['user_slug']);
	}else if ($type == 3) {
		$rate_all = 0;
		$qrRate = new db_query("SELECT * FROM rate_center WHERE center_id = " . $row['user_id']);
		while ($rowRate = mysql_fetch_array($qrRate->result)) {
			$rate = $rowRate['teacher'] + $rowRate['place_class'] + $rowRate['infrastructure'] + $rowRate['student_number'] + $rowRate['enviroment'] + $rowRate['student_care'] + $rowRate['practice'] + $rowRate['pround_price'] + $rowRate['self_improvement'] + $rowRate['ready_introduct'];
			$rate = $rate/10;
			$rate_all = $rate_all + $rate;
		}
		if (mysql_num_rows($qrRate->result) == 0) {
			$r = 1;
		}else{
			$r = mysql_num_rows($qrRate->result);
		}
		$rate_all = round($rate_all/$r,1);
		$center_id = $row['center_id'];
		$qrRate = new db_query("SELECT rate_id FROM rate_center WHERE center_id = '$center_id'");
		$link = urlDetail_center($row['user_id'], $row['user_slug']);
	}
	$arr_cate = explode(",", $row['cate_id']);
	$cate_name = "";
	for ($i = 0; $i < count($arr_cate); $i++) {
		$cate_id = $arr_cate[$i];
		$qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
		$rowCate = mysql_fetch_array($qrCate->result);
		if ($i == count($arr_cate) - 1) {
			$cate_name = $cate_name . $rowCate['cate_name'];
		}else{
			$cate_name = $cate_name . $rowCate['cate_name'] . ',';
		}
	}

	if ($row['user_avatar'] == 0) {
		$v_avatar_teach = '../img/v_avatar_default.png';
	}else{
		$v_avatar_teach = '../img/avatar/' . $row['user_avatar'];
	}

	$html = $html . ' <div class="v_content-main">
	<div class="v_content-1" id="v_save_teacher-'.$row['save_id'].'">
	<hr class="v_content-main-hr">
	<center style="padding-top: 16px;"><img src="'.$v_avatar_teach.'" class="v_content-1-img" alt="Ảnh lỗi"></center>
	<a href="'.$link.'"><p class="v_content-main-p">'.$row['user_name'].'</p></a>
	<div class="flex v_content-play">
	<p class="v_img-play"><img src="../img/gg_play-button-o.svg"
	alt="Ảnh lỗi"></p>
	<p class="v_content-play-p">Môn học giảng dạy : '.$cate_name.'</p>
	</div>
	<div class="flex v_content-play">
	<p class="v_img-play"><img src="../img/clarity_date-line.svg"
	alt="Ảnh lỗi"></p>
	<p>'.date('d-m-Y',$row['created_at']).'</p>
	</div>
	<div class="flex v_content-play">
	<p class="v_img-play"><img src="../img/Group 31842.svg" alt="Ảnh lỗi">
	</p>
	<p>'.$rate_all.' ('.mysql_num_rows($qrRate->result).')</p>
	</div>
	<div class="flex v_btn">
	<a href="'.$link.'" class="v_xem-them"><button>XEM THÊM</button></a>
	<button class="v_xoa" onclick="del_save_teacher('.$row['save_id'].','. $type .','.$number.')">XÓA</button>
	</div>
	</div>
	</div>';
}
$data = [
	'html'=>$html
];

echo json_encode($data);
?>