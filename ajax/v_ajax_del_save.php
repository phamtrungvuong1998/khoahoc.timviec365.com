<?php 
require_once '../config/config.php';
$save_id = getValue('save_id','int','GET','');
$type = getValue('type','int','GET','');
$p = getValue('p','int','GET','');
$user_id = $_COOKIE['user_id'];

$start = ($p-1)*6;

if ($type == 3) {
	$qrDel = new db_query("DELETE FROM save_center WHERE save_id = $save_id");

	$qrCount = new db_query("SELECT * FROM users INNER JOIN save_center ON save_center.center_id = users.user_id WHERE save_center.user_student_id = $user_id");

	$qr = new db_query("SELECT *,users.created_at FROM users INNER JOIN save_center ON save_center.center_id = users.user_id WHERE save_center.user_student_id = '$user_id' ORDER BY user_id DESC LIMIT $start,6");
}else if ($type == 2) {
	$qrDel = new db_query("DELETE FROM save_teacher WHERE save_id = $save_id");

	$qrCount = new db_query("SELECT * FROM users INNER JOIN save_teacher ON save_teacher.teacher_id = users.user_id WHERE save_teacher.user_student_id = $user_id");

	$qr = new db_query("SELECT *,users.created_at FROM users INNER JOIN save_teacher ON save_teacher.teacher_id = users.user_id WHERE save_teacher.user_student_id = '$user_id' LIMIT $start,6");
}


if (mysql_num_rows($qrCount->result) == 0) {
	$data = [
		'html'=>0
	];
}else{
	$html = '';
	if (mysql_num_rows($qr->result) == 0) {
		if ($p > 0) {
			$start = ($p-1)*6;
		}else{
			$start = 0;
		}
		if ($type == 3) {
			$qr = new db_query("SELECT *,users.created_at FROM users LEFT JOIN rate_center ON rate_center.center_id = users.user_id INNER JOIN save_center ON save_center.center_id = users.user_id WHERE save_center.user_student_id = '$user_id' LIMIT $start,6");
		}else if($type == 2) {
			$qr = new db_query("SELECT *,users.created_at FROM users INNER JOIN save_teacher ON save_teacher.teacher_id = users.user_id WHERE save_teacher.user_student_id = '$user_id' LIMIT $start,10");
		}
	}

	while ($row = mysql_fetch_array($qr->result)) {
		if ($type == 2) {
			$qrRate = new db_query("SELECT teacher FROM courses INNER JOIN rate_course ON courses.course_id = rate_course.course_id WHERE user_id = " . $row['user_id']);
			$rate = 0;
			while($rowRate = mysql_fetch_array($qrRate->result)){
				$rate = $rate + $rowRate['teacher'];
			}
			if (mysql_num_rows($qrRate->result) == 0) {
				$r = 1;
			}else{
				$r = mysql_num_rows($qrRate->result);
			}
			$rate = $rate/$r;
			$arr_cate = explode(",", $row['cate_id']);
		}else if ($type == 3) {
			$qrRate = new db_query("SELECT * FROM rate_center WHERE center_id = " . $row['user_id']);
            $rate = 0;
            while ($rowR = mysql_fetch_array($qrRate->result)) {
                $rate = $rowR['teacher'] + $rowR['place_class'] + $rowR['infrastructure'] + $rowR['student_number'] + $rowR['enviroment'] + $rowR['student_care'] + $rowR['practice'] + $rowR['pround_price'] + $rowR['self_improvement'] + $rowR['ready_introduct'];
            }
		}
		$rate = $rate/10;
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

		if ($type == 3) {
			$center_id = $row['center_id'];
		}else if ($type == 2) {
			$center_id = $row['teacher_id'];
		}
		$qr_rep_center = new db_query("SELECT rate_id FROM rate_center WHERE center_id = '$center_id'");

		if ($type == 2) {
			$linkCT = urlDetail_teacher($row['teacher_id'], $row['user_slug']);
		}else if ($type == 3) {
			$lintCT = urlDetail_center($row['center_id'], $row['user_slug']);
		}
		$html = $html . '<div class="v_content-main">
		<div class="v_content-1" id="v_save_teacher-'.$row['save_id'].'">
		<hr class="v_content-main-hr">
		<center style="padding-top: 16px;"><img src="'.$v_avatar_teach.'" class="v_content-1-img" alt="Ảnh lỗi"></center>
		<a href="'.$linkCT.'"><p class="v_content-main-p">'.$row['user_name'].'</p></a>
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
		<p>'.$rate.' ('.mysql_num_rows($qr_rep_center->result).')</p>
		</div>
		<div class="flex v_btn">
		<a class="v_xem-them" href="'.$linkCT.'"><button>XEM THÊM</button></a>
		<button class="v_xoa" onclick="del_save_teacher('.$row['save_id'].',3,1)">XÓA</button>
		</div>
		</div>
		</div>';
	}

	$data = [
		'html'=>$html
	];
}

echo json_encode($data);

?>