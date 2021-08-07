<?php
require_once '../config/config.php';

$number = getValue('number', 'int', 'GET', '');

$start = ($number - 1) * 10;

$user_id = $_COOKIE['user_id'];

$qrCommon = new db_query("SELECT * FROM order_student_common INNER JOIN order_common ON order_student_common.common_id = order_common.common_id INNER JOIN courses ON courses.course_id = order_common.course_id WHERE user_student_id = $user_id ORDER BY order_student_id DESC LIMIT $start,10");
// echo $qrCommon->query;
$start = $start + 1;
$html = '';
while ($row = mysql_fetch_array($qrCommon->result)) {
	if ($row['price_promotional'] == -1) {
		$price = $row['price_listed'];
	}else{
		$price = $row['price_promotional'];
	}
	$linkCourse = urlDetail_courseOnline($row['course_id'],$row['course_slug']);

	$html = $html . '<div class="v_noidungkh">
	<div class="v_table-cell v_stt">'.$start.'</div>
	<div class="v_table-cell v_content-list v_monhoc"><a href="'.$linkCourse.'">'.$row['course_name'].'</a></div>
	<div class="v_table-cell v_content-list">'.date('d-m-Y', $row['created_at']).'</div>
	<div class="v_table-cell v_content-list v_trungtam">'.$row['numbers'].' / '.$row['quantity_std'].'</div>
	<div class="v_table-cell v_content-list">'.number_format($row['price_discount']).' đ</div>
	<div class="v_table-cell v_content-list">'.number_format($price).' đ</div>
	<div class="v_table-cell v_content-list v_bacham">
	<button class="v_btn-bacham" onclick="v_popup(this)"><img
	src="../img/More.svg" alt="Ảnh lỗi"></button>
	<div class="v_popup" id="v_popup-'.$start.'">
	<center><a href="'.$linkCourse.'"><button class="v_btn-del">CHI TIẾT</button></a></center>
	</div>
	</div>
	</div>
	<div class="v_content-mb">
	<div class="flex v_content-mb-div">
	<p class="v_content-mb-stt">'.$start.'. </p>
	<a class="v_content-mb-title" href="'.$linkCourse.'">'.$row['course_name'].'
	</a>
	</div>
	<div class="flex v_info-all v_content-mb-div">
	<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ngày đăng ký : </span>'.date('d-m-Y', $row['created_at']).'</div>
	<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số người đăng ký : </span>'.$row['numbers'].' / '.$row['quantity_std'].'</div>
	<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Đặt cọc : </span> '.number_format($row['price_discount']).' đ
	</div>
	<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Học phí : </span> '.number_format($price).' đ
	</div>
	</div>

	<div class="flex v_mb-ghichu-all v_content-mb-div">
	<a href="'.$linkCourse.'" class="v_ghichu-mb v_xemthem"><span>Chi tiết</span></a>
	</div>
	</div>';
	$start++;
}

$data = [
	'html'=>$html
];

echo json_encode($data);
?>