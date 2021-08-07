<?php
require_once '../config/config.php';
require_once '../includes/v_inc_insert_HV.php';
$page = getValue("page","int","GET","");
$user_id = $_COOKIE['user_id'];
//Lấy cate_id của học viên về dạng (1,2,3,4,...,n)
$arr_cate_id = "";
$cate_fit = "";
if ($rowHV['cate_id'] != 0) {
	$user_cate_id = explode(",", $rowHV['cate_id']);
	if (count($user_cate_id) == 1) {
		$cate_fit = $cate_fit . "(" . $user_cate_id[0] . ")";
	}else{
		for ($i = 0; $i < count($user_cate_id); $i++) {
			if ($i == 0) {
				$cate_fit = '(' . $user_cate_id[$i] . ',';
			}else if ($i < count($user_cate_id) - 1 && $i > 0){
				$cate_fit = $cate_fit . $user_cate_id[$i] . ',';
			}else if ($i == count($user_cate_id) - 1) {
				$cate_fit = $cate_fit . $user_cate_id[$i] . ')';
			}
		}
	}
}else{
	$arr_cate_id = "(0)";
}

$html = "";
$qrFit = new db_query("SELECT * FROM courses INNER JOIN users ON courses.user_id = users.user_id INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.cate_id IN ". $cate_fit ." AND courses.price_listed != -1 AND courses.hide_course = 1 AND courses.accept = 1 ORDER BY course_id DESC LIMIT $page,3");
while ($rowFit = mysql_fetch_array($qrFit->result)){
	if ($rowFit['course_type'] == 1) {
		$rate = 0;
		$qrRate = new db_query("SELECT lesson, teacher FROM rate_course WHERE course_id = " . $rowFit['course_id']);
		while ($rowR = mysql_fetch_array($qrRate->result)) {
			$rate = $rate + ($rowR['lesson'] + $rowR['teacher'])/2;
		}
	}else if ($rowFit['course_type'] == 2) {
		$qrRate = new db_query("SELECT lesson, teacher, video FROM rate_course WHERE course_id = " . $rowFit['course_id']);
		$rate = 0;
		while ($rowR = mysql_fetch_array($qrRate->result)) {
			$rate = $rate + ($rowR['lesson'] + $rowR['teacher'] + $rowR['video'])/3;
		}
	}
	if ($rate == 0) {
		$rate_count = 1;
	}else{
		$rate_count = mysql_num_rows($qrRate->result);
	}
	$rate = $rate/$rate_count;
	$qrSave = new db_query("SELECT save_id FROM save_course WHERE user_student_id = '$user_id' AND course_id = " . $rowFit['course_id']);
	if (mysql_num_rows($qrSave->result) > 0) {
		$srcHeart = '../img/heart-yellow2.svg';
	}else{
		$srcHeart = '../img/wpf_like(3).svg';
	}
	if ($rowFit['user_type'] == 2) {
		$link_teach = urlDetail_teacher($rowFit['user_id'], $rowFit['user_slug']);
	}else if ($rowFit['user_type'] == 3){
		$link_teach = urlDetail_center($rowFit['user_id'], $rowFit['user_slug']);
	}
	$arr_cate_id = explode(",", $rowFit['cate_id']);
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
	if ($rowFit['user_avatar'] == 0) {
		$teacher_avatar = '../img/v_avatar_default.png';
	}else{
		$teacher_avatar = '../img/avatar/' . $rowFit['user_avatar'];
	}

	if ($rowFit['user_type'] == 2) {
		$link_teach = urlDetail_teacher($rowFit['user_id'], $rowFit['user_slug']);
	}else if ($rowFit['user_type'] == 3){
		$link_teach = urlDetail_center($rowFit['user_id'], $rowFit['user_slug']);
	}
	$qrOrder = new db_query("SELECT order_id FROM orders WHERE course_id = " . $rowFit['course_id']);
	$qrOrderCommon = new db_query("SELECT order_student_id FROM order_student_common WHERE course_id = " . $rowFit['course_id']);
	if ($rowFit['certification'] == 1) {
		$certification = 'Cấp chứng chỉ';
	}else if ($rowFit['certification'] == 2){
		$certification = 'Không cấp chứng chỉ';
	}
	if ($rowFit['price_promotional'] == 0) {
		$price = $rowFit['price_listed'];
	}else{
		$price = $rowFit['price_promotional'];
	}
	$html = $html .'<div class="v_course_fit v_khoaonline">
	<button value="'.$rowFit['course_id'].'" class="v_trai-tim"><img class="v_save_fit2 lazyload" onclick="v_Save_Course(this)" src="/img/load.gif" data-src="'.$srcHeart.'" alt="Ảnh lỗi"></button>
	<div class="v_pos">
	<div class="v_gv v_gv_img">
	<div><img class="v_fit_img lazyload" onerror="this.onerror=null;this.src=\'../img/avatar/error.png\';" src="/img/load.gif" data-src="../img/avatar/'.$rowFit['user_avatar'].'" alt="Ảnh lỗi"></div>
	<div>
	<a href="'.$link_teach.'">
	<p>'.$rowFit['user_name'].'</p>
	</a>
	<p class="v_gv-div-p">
	'.$cate_name.'
	</p>
	</div>
	</div>
	<img class="v_khoaonline-background lazyload" onerror="this.onerror=null;this.src=\'../img/avatar/error.png\';" src="/img/load.gif" data-src="../img/course/'.$rowFit['course_avatar'].'" alt="Ảnh lỗi">
	</div>
	<a href="'.urlDetail_courseOnline($rowFit['course_id'], $rowFit['course_slug']).'">
	<div class="v_khoaonline-title">'.$rowFit['course_name'].'</div>
	</a>
	<div id="v_star" class="flex">';
	for ($i = 1; $i <= $rate; $i++) {
		$html = $html . '<div class="v_star"><img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="Ảnh lỗi"></div>';
	}
	$html = $html .'</div>
	<div class="v_songuoidk">'.(mysql_num_rows($qrOrder->result) + mysql_num_rows($qrOrderCommon->result)).' học viên đã đăng kí khóa học</div>
	<div class="flex v_info">
	<div class="v_info-detail flex">
	<div><img class="lazyload" src="/img/load.gif" data-src="../img/chung-chi.svg" alt="Ảnh lỗi"></div>
	<div>'.$certification.'</div>
	</div>
	<div class="v_info-detail flex">
	<div><img class="lazyload" src="/img/load.gif" data-src="../img/nguoi-moi.svg" alt="Ảnh lỗi"></div>
	<div>'.$rowFit['level_name'].'</div>
	</div>
	<div class="v_info-detail flex">
	<div><img class="lazyload" src="/img/load.gif" data-src="../img/categories/'.$rowFit['cate_icon'].'" alt="Ảnh lỗi"></div>
	<div>'.$rowFit['cate_name'].'</div>
	</div>
	</div>
	<center>
	<hr class="v_content-2-hr">
	</center>
	<div class="flex v_giakhoahoc">
	<div>';

	if ($rowFit['price_promotional'] == -1) {
		$html = $html . '<div class="v_gia">'.number_format($rowFit['price_listed']) . ' đ'.'</div>
		</div>';
	}else{
		$html = $html . '<div class="v_gia">'.number_format($rowFit['price_promotional']) . ' đ'.'</div>
		<div class="v_giamgia">'. number_format($rowFit['price_listed']) . ' đ'.'</div>
		</div>';
	}

	$qrOrder = new db_query("SELECT * FROM orders WHERE user_student_id = $user_id AND course_id = " . $rowFit['course_id']);
	$qrOrder2 = new db_query("SELECT * FROM order_student_common WHERE user_student_id = $user_id AND course_id = " . $rowFit['course_id']);
	if (mysql_num_rows($qrOrder->result) == 0 || mysql_num_rows($qrOrder2->result) == 0) {
		if ($rowFit['course_type'] == 2) {
			$html = $html . '<div class="v_muangay"><a
			href="/mua-khoa-hoc-ngay/id'.$_COOKIE['user_id'].'-course'.$rowFit['course_id'].'.html"><button>MUA
			NGAY</button></a></div>
			</div>
			</div>';
		}else{
			$html = $html . '<div class="v_muangay"><a href="'.urlDetail_courseOffline($rowFit['course_id'],$rowFit['course_slug']).'"><button>CHI TIẾT</button></a></div>
			</div>
			</div>';
		}
	}else{
		if ($rowFit['course_type'] == 2) {
			$html = $html . '<div class="v_muangay"><button class="v_damua2">ĐÃ MUA</button></div>
			</div>
			</div>
			</div>';
		}else{
			$html = $html . '<div class="v_muangay"><button class="v_damua2">ĐÃ ĐẶT CHỖ</button></div>
			</div>
			</div>
			</div>';
		}
	}
}

$page = $page + 3;

$qrFit = new db_query("SELECT * FROM courses INNER JOIN users ON courses.user_id = users.user_id INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.cate_id IN ". $cate_fit ." AND courses.price_listed != -1 AND courses.hide_course = 1 AND courses.accept = 1 ORDER BY course_id DESC LIMIT $page,3");
if (mysql_num_rows($qrFit->result) == 0) {
	$more = '';
}else{
	$more = '<button id="v_fit" onclick="more_fit('.$page.')"><a>XEM THÊM</a></button>';
}

$data = [
	'html'=>$html,
	'more'=>$more
];

echo json_encode($data);

?>