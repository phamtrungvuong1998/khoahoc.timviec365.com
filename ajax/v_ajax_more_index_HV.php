<?php
require_once '../config/config.php';

$type = getValue('type','int','GET','');

$p = getValue('p','int','GET','');

$user_id = $_COOKIE['user_id'];

if ($type == 1) {
	$qr = new db_query("SELECT * FROM orders WHERE user_student_id = '$user_id' AND course_type = 2 LIMIT $p,3");
	echo '<button id="v_more_buy_on" class="v_more" onclick="v_more(1,'. ($p + 3) .')">XEM THÊM</button>';
}else if ($type == 2) {
	$qr = new db_query("SELECT * FROM orders WHERE user_student_id = '$user_id' AND course_type = 1 LIMIT $p,3");
	echo '<button id="v_more_buy_off" class="v_more" onclick="v_more(2,'. ($p + 3) .')">XEM THÊM</button>';
}else if ($type == 3) {
	$qr = new db_query("SELECT * FROM save_course WHERE user_student_id = '$user_id' LIMIT $p,3");
	echo '<button id="v_more_save" class="v_more" onclick="v_more(3,'. ($p + 3) .')">XEM THÊM</button>';
}else if ($type == 4) {
	//Lấy cate_id của bảng courses
	$qrCate = new db_query("SELECT cate_id FROM courses");

	//Lấy cate_id của bảng users với user_id = $user_id
	$qrHV  = new db_query("SELECT * FROM users WHERE user_id = '$user_id'");

	

	echo '<button id="v_more_fit" class="v_more" onclick="v_more(4,'. ($p + 3) .')">XEM THÊM</button>';
}

echo 'v_phan_trang';

$k = 0;
while ($row = mysql_fetch_array($qr->result)) {
	$course_id = $row['course_id'];
	$qrKH = new db_query("SELECT * FROM courses WHERE course_id = '$course_id'");
	$rowKH = mysql_fetch_array($qrKH->result);

	$teacher_id = $rowKH['center_teacher_id'];
	$qrTeach = new db_query("SELECT * FROM users WHERE user_id = '$teacher_id'");
	$rowTeach = mysql_fetch_array($qrTeach->result);

	$qrSave = new db_query("SELECT save_id FROM save_course WHERE user_student_id = '$user_id' AND course_id = '$course_id' AND course_type = 2");
	if (mysql_num_rows($qrSave->result) > 0) {
		$srcHeart = '../img/heart-yellow2.svg';
	}else{
		$srcHeart = '../img/wpf_like(3).svg';
	}

	if ($rowTeach['user_type'] == 2) {
		$link_teach = urlDetail_teacher($rowTeach['user_id'], $rowTeach['user_slug']);
	}else if ($rowTeach['user_type'] == 3){
		$link_teach = urlDetail_center($rowTeach['user_id'], $rowTeach['user_slug']);
	}

	$arr_cate_id = explode(",", $rowTeach['cate_id']);
	$cate_name = "";
	for ($i = 0; $i < count($arr_cate_id); $i++) {
		$cate_id = $arr_cate_id[$i];
		$qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
		$rowCate = mysql_fetch_array($qrCate->result);
		if ($i == count($arr_cate_id) - 1) {
			$cate_name = $cate_name . $rowCate['cate_name'];
		}else{
			$cate_name = $cate_name . $rowCate['cate_name'] . ",";
		}
	}

	if ($rowTeach['user_avatar'] == 0) {
		$teacher_avatar = '../img/v_avatar_default.png';
	}else{
		$teacher_avatar = '../img/avatar/' . $rowTeach['user_avatar'];
	}

	if ($rowKH['certification'] == 1) {
		$certification = 'Cấp chứng chỉ';
	}else if ($rowKH['certification'] == 2){
		$certification = 'Không cấp chứng chỉ';
	}

	if ($rowKH['level_id'] == 1) {
		$level = 'Dành cho người mới';
	}else{
		$level = 'Không dành cho người mới';
	}

	echo '<div class="v_khoaonline">
	<img class="v_trai-tim" src="'.$srcHeart.'" id="v_save-<?php echo $course_id; ?>"
	onclick="v_Save_Course('.$user_id.','.$course_id.',2)"
	alt="Ảnh lỗi">
	<div class="v_pos">
	<div class="v_gv">
	<div class="v_gv-div v_gv-img"><img
	src="../img/course/'.$rowKH['course_avatar'].'" alt="Ảnh lỗi">
	</div>
	<div class=" v_gv-div v_gv-text">
	<a href="<?php echo $link_teach; ?>">
	<p class="v_gv-div-p">'.$rowTeach['user_name'].'</p>
	</a>
	<p class="v_gv-div-p">
	<?php echo $cate_name; ?>
	</p>
	</div>
	</div>
	<img class="v_khoaonline-background" src="<?php echo $teacher_avatar; ?>" alt="Ảnh lỗi">
	</div>
	<a href="'.urlDetail_courseOnline($rowKH['course_id'], $rowKH['course_slug']).'">
	<div class="v_khoaonline-title">'.$rowKH['course_name'].'</div>
	</a>
	<div id="v_star" class="flex">
	<div class="v_star"><img src="../img/bi_star-fill.svg" alt="Ảnh lỗi"></div>
	<div class="v_star"><img src="../img/bi_star-fill.svg" alt="Ảnh lỗi"></div>
	<div class="v_star"><img src="../img/bi_star-fill.svg" alt="Ảnh lỗi"></div>
	<div class="v_star"><img src="../img/bi_star-fill.svg" alt="Ảnh lỗi"></div>
	<div class="v_star"><img src="../img/bi_star-fill.svg" alt="Ảnh lỗi"></div>
	</div>
	<div class="v_songuoidk">20.2000 học viên đã đăng kí khóa học</div>
	<div class="flex v_info">
	<div class="v_info-detail flex">
	<div><img src="../img/hoc-thu.svg" alt="Ảnh lỗi"></div>
	<div>Có học thử</div>
	</div>
	<div class="v_info-detail flex">
	<div><img src="../img/chung-chi.svg" alt="Ảnh lỗi"></div>
	<div>'.$certification.'</div>
	</div>
	<div class="v_info-detail flex">
	<div><img src="../img/nguoi-moi.svg" alt="Ảnh lỗi"></div>
	<div>'.$level.'</div>
	</div>
	</div>
	<center>
	<hr class="v_content-2-hr">
	</center>
	<div class="v_batdauhoc"><button>BẮT ĐẦU HỌC</button></div>
	</div>';
}
?>