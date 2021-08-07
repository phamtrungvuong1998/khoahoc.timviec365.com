<?php
require_once '../config/config.php';

$save_id = getValue('save_id', 'int', 'GET', '');

$type = getValue('type', 'int', 'GET', '');

$pa = getValue('pa', 'int', 'GET', '');

$start = ($pa - 1) * 1;

$user_id = $_COOKIE['user_id'];
$qrDel = new db_query("DELETE FROM save_course WHERE save_id = '$save_id'");

$qrCount = new db_query("SELECT * FROM save_course INNER JOIN courses ON save_course.course_id = courses.course_id INNER JOIN users ON courses.user_id = users.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_type = $type AND save_course.user_student_id = '$user_id'");

$qr = new db_query("SELECT * FROM save_course INNER JOIN courses ON save_course.course_id = courses.course_id INNER JOIN users ON courses.user_id = users.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_type = '$type' AND save_course.user_student_id = '$user_id' ORDER BY save_course.save_id DESC LIMIT $start,10");
$start = $start + 1;
if (mysql_num_rows($qrCount->result) == 0) {
	$html = 0;
}else{
	$html = '';
	if (mysql_num_rows($qr->result) == 0) {
		$pa = $pa - 1;
		$start = ($pa - 1) * 10;
		$qr = new db_query("SELECT * FROM save_course INNER JOIN courses ON save_course.course_id = courses.course_id INNER JOIN users ON courses.user_id = users.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_type = '$type' AND save_course.user_student_id = '$user_id' ORDER BY save_course.save_id DESC LIMIT $start,10");
		$start = $start + 1;
	}
	while ($row = mysql_fetch_array($qr->result)) {
		if ($row['price_promotional'] == -1) {
			$price = $row['price_listed'];
		}else{
			$price = $row['price_promotional'];
		}

		if ($row['course_type'] == 1) {
			$linkCouse = urlDetail_courseOffline($row['course_id'],$row['course_slug']);
		}else if ($row['course_type'] == 2) {
			$linkCouse = urlDetail_courseOnline($row['course_id'],$row['course_slug']);
		}

		if ($row['user_type'] == 2) {
			$linkT = urlDetail_teacher($row['user_id'],$row['user_slug']);
		}else{
			$linkT = urlDetail_center($row['user_id'],$row['user_slug']);
		}

		$qrOrder = new db_query("SELECT order_id FROM orders WHERE user_student_id = $user_id AND course_id = " . $row['course_id']);
		if (mysql_num_rows($qrOrder->result) == 0) {
			if ($row['course_type'] == 1) {
				$order1 = '<center><a href="'.urlDetail_courseOffline($row['course_id'],$row['course_slug']).'" class="v_btn-buy"><button>ĐẶT CHỖ</button></a></center>';
				$order2 = '<a href="'.urlDetail_courseOffline($row['course_id'],$row['course_slug']).'" class="flex v_ghichu-mb">
				<p class="v_ghichu-mb-p v_gc">ĐẶT CHỖ</p>
				</a>';
			}else if ($row['course_type'] == 2) {
				$order1 = '<center><a href="/mua-khoa-hoc-ngay/id$user_id'.'-course'.$row['course_id'].'.html" class="v_btn-buy"><button>MUA NGAY</button></a></center>';
				$order2 = '<a href="/mua-khoa-hoc-ngay/id'.$user_id.'-course'.$row['course_id'].'.html" class="flex v_ghichu-mb">
				<p class="v_ghichu-mb-p v_gc">MUA NGAY</p>
				</a>';
			}
		}else{
			if ($row['course_type'] == 2) {
				$order1 = '<center><a class="v_btn-buy"><button>ĐÃ MUA</button></a></center>';
				$order2 = '<a class="flex v_ghichu-mb"><p class="v_ghichu-mb-p v_gc">ĐÃ MUA</p></a>';
			}else if ($row['course_type'] == 1){
				$order1 = '<center><a class="v_btn-buy"><button>ĐÃ ĐẶT CHỖ</button></a></center>';
				$order2 = '<a class="flex v_ghichu-mb"><p class="v_ghichu-mb-p v_gc">ĐÃ ĐẶT CHỖ</p></a>';
			}
		}
		if ($row['course_type'] == 1) {
			$linkCouse = urlDetail_courseOffline($row['course_id'],$row['course_slug']);
		}else if ($row['course_type'] == 2) {
			$linkCouse = urlDetail_courseOnline($row['course_id'],$row['course_slug']);
		}

		if ($row['user_type'] == 2) {
			$linkT = urlDetail_teacher($row['user_id'],$row['user_slug']);
		}else{
			$linkT = urlDetail_center($row['user_id'],$row['user_slug']);
		}
		$html = $html . '<div class="v_noidungkh" id="v_noidungkh-'.$row['save_id'].'">
		<div class="v_table-cell v_stt" id="v_stt-'.$start.'">'.$start.'</div>
		<div class="v_table-cell v_content-list v_monhoc">
		<a href="'.$linkCouse.'">'.$row['course_name'].'</a>
		</div>
		<div class="v_table-cell v_content-list" id="course_name">'.$row['cate_name'].'
		</div>
		<div class="v_table-cell v_content-list v_teacher_center"><a href="'.$linkT.'">'.$row['user_name'].'</a></div>
		<div class="v_table-cell v_content-list">'.number_format($price) . ' đ'.'</div>
		<div class="v_table-cell v_content-list v_bacham">
		<button class="v_btn-bacham" onclick="v_popup(this)"><img
		src="../img/More.svg" alt="Ảnh lỗi"></button>
		<div class="v_popup" id="v_popup-'.$row['save_id'].'">
		'.$order1.'
		<center><button value="'.$row['save_id'].'" class="v_btn-del v_save_del" onclick="v_save_del(this)">HỦY</button>
		</center>
		</div>
		</div>
		</div>';

		$html = $html . '<div class="v_content-mb" id="v_content-mb-'.$row['save_id'].'">
		<div class="flex v_content-mb-div">
		<p class="v_content-mb-stt">'.$start . '.</p>
		<a href="'.$linkCouse.'" class="v_content-mb-title">
		'.$row['course_name'].'
		</a>
		</div>
		<a class="v_tengiangvien" href="'.$linkT.'">'.$row['user_name'].'</a>

		<div class="flex v_info-all v_content-mb-div">
		<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học
		: </span>'.$row['cate_name'].'</div>

		<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Học phí : </span>
		'.number_format($price). ' đ'.'
		</div>
		</div>

		<div class="flex v_mb-ghichu-all v_content-mb-div">
		'.$order2.'
		<button value="'.$row['save_id'].'" class="v_ghichu-mb v_xemthem v_save_del" onclick="v_save_del(this)"><span>HỦY</span>
		</button>
		</div>
		</div>';
		$start++;
	}
}

$data = [
	'html'=>$html
];

echo json_encode($data);
?>