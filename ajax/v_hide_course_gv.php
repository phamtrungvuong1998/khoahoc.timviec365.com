<?php
require_once '../config/config.php';

$cookie_id = $_COOKIE['user_id'];
$course_id = getValue('course_id','int','GET','');
$course_type = getValue('course_type','int','GET','');
$p = getValue('p','int','GET','');

$data = [
	'hide_course'=>0
];

$dataId = [
	'course_id'=>$course_id
];

update('courses',$data,$dataId);


$qrCount = new db_query("SELECT COUNT(*) FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = $course_type AND hide_course = 1 AND accept = 1");

$rowCount = mysql_fetch_array($qrCount->result);
$pa = $rowCount[0]/10;


$number_page = 10;

if (!isset($_GET['p']) || $p == 1) {
	$start = 0;
	$end = 10;
}else{
	$start = $number_page * ($p - 1);
	$end = 10;
}

$dbon = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = $course_type AND hide_course = 1 AND accept = 1 ORDER BY course_id DESC LIMIT $start,$end");

$dbon1 = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = $course_type AND hide_course = 1 AND accept = 1 ORDER BY course_id DESC LIMIT $start,$end");

if ($pa == 0) {
	$html = '<div>Chưa có dữ liệu</div>';
	$data = [
		'result'=>0,
		'html'=>$html
	];
}else{
	if (mysql_num_rows($dbon->result) == 0) {
		$p = $p - 1;
		if (!isset($_GET['p']) || $p == 1) {
			$start = 0;
			$end = 10;
		}else{
			$start = $number_page * ($p - 1);
			$end = 10;
		}
		$dbon = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id WHERE user_id = $cookie_id AND course_type = $course_type AND hide_course = 1 AND accept = 1 ORDER BY course_id DESC LIMIT $start,$end");

		$dbon1 = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id WHERE user_id = $cookie_id AND course_type = $course_type AND hide_course = 1 AND accept = 1 ORDER BY course_id DESC LIMIT $start,$end");
	}
	$htmlPC = '<div id="v_content-title">
	<div class="v_content-title-div">Khóa học</div>
	<div class="v_content-title-div">Môn học</div>
	<div class="v_content-title-div">SỐ BUỔI HỌC</div>
	<div class="v_content-title-div">TÀI LIỆU</div>
	<div class="v_content-title-div">GIÁ GỐC</div>
	<div class="v_content-title-div">GIÁ KHUYẾN MẠI</div>
	<div class="v_content-title-div">NGÀY ĐĂNG</div>
	<div class="v_content-title-div v_bacham"><img src="../img/More.png" alt="Ảnh lỗi"></div>
	</div>';

	while ($rowc = mysql_fetch_array($dbon->result)) {
		if ($rowc['price_listed'] == -1) {
			$price_listed = "Chưa cập nhật";
		}else{
			$price_listed = number_format($rowc['price_listed']) . " đ";
		}
		if ($rowc['price_promotional'] == -1) {
			$price_promotional = "Chưa cập nhật";
		}else{
			$price_promotional = number_format($rowc['price_promotional']) . " đ";
		}
		$htmlPC = $htmlPC .'<div class="v_noidungkh" id="v_noidungkh-'.$rowc['course_id'].'">
		<div class="v_content-list v_monhoc">'.$rowc['course_name'].'</div>
		<div class="v_content-list">'.$rowc['cate_name'].'</div>
		<div class="v_content-list v_trungtam">'.$rowc['time_learn'].'</div>
		<div class="v_content-list">'.$rowc['course_slide'].'</div>
		<div class="v_content-list">'.$price_listed.'</div>
		<div class="v_content-list">'.$price_promotional.'</div>
		<div class="v_content-list">'.date("d-m-Y", $rowc['created_at']).'</div>
		<div class="v_content-list v_bacham">
		<button class="v_btn-bacham" onclick="v_bacham('.$rowc['course_id'].')"><img src="../img/More.svg"
		alt="Ảnh lỗi"></button>
		<div class="v_popup" id="v_popup-'.$rowc['course_id'].'">
		<center><a
		href="/cap-nhat-khoa-hoc-offline-giang-vien/id'.$cookie_id.'-courseOf'.$rowc['course_id'].'.html"
		class="v_btn-buy"><img class="lazyload" src="/img/load.gif"
		data-src="../img/chinh-sua.svg" alt="Ảnh l">CHỈNH
		SỬA</a></center>
		<center><button class="v_xoakh" data-course="'.$rowc['course_id'].'" onclick="v_del_course(this)">XÓA KHÓA HỌC</button></center>
		</div>
		</div>
		</div>';
	}
	$htmlMB = '';
	while ($rowc = mysql_fetch_array($dbon1->result)){
		if ($rowc['price_listed'] == -1) {
			$price_listed = "Chưa cập nhật";
		}else{
			$price_listed = number_format($rowc['price_listed']) . " đ";
		}

		if ($rowc['price_promotional'] == -1) {
			$price_promotional = "Chưa cập nhật";
		}else{
			$price_promotional = number_format($rowc['price_promotional']) . " đ";
		}

		$htmlMB = $htmlMB . '<div class="v_content-mb">
		<div class="flex v_content-mb-div">
		<p class="v_content-mb-title">'.$rowc['course_name'].'</p>
		</div>
		<div class="flex v_info-all v_content-mb-div">
		<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học :</span>
		'.$rowc['cate_name'].'</div>
		<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Giá gốc :
		</span>'.$price_listed.'
		</div>
		<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Giá khuyến mại :
		</span>'.$price_promotional.'
		</div>
		<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số lượng bải giảng
		:</span>'.$rowc['course_slide'].' video</div>
		<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tài liệu :</span>
		'.$rowc['course_slide'].' file
		</div>
		<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ngày đăng :</span>
		'.date("d-m-Y", $rowc['created_at']) .'</div>
		</div>

		<div class="flex v_mb-ghichu-all v_content-mb-div">
		<div class="v_mb-edit-div"><a
		href="/cap-nhat-khoa-hoc-offline-giang-vien/id'.$cookie_id.'-courseOf'.$rowc['course_id'].'.html"
		class="v_mb-edit"><img class="lazyload" src="/img/load.gif"
		data-src="../img/chinh-sua.svg" alt="Ảnh lỗi">Chỉnh sửa</a></div>
		<div class="v_mb-edit-div v_xoakh3" data-course="'.$rowc['course_id'].'"><button class="v_mb-edit v_xoakh2">Xóa khóa học</button></div>
		</div>
		</div>';
	}

	$html_chuyentrang = '';
	if ($p == 1) {
		$link1 = '/giang-vien-khoa-hoc-offline/id' . $_COOKIE['user_id'] . '-p1.html';
	}else{
		$link1 = '/giang-vien-khoa-hoc-offline/id' . $_COOKIE['user_id'] . '-p' . ($p-1).'.html';
	}

	$html_chuyentrang = '<a class="v_chuyen-trang-div" href="'.$link1.'">&lt;</a>';

	for ($i = 0; $i < $pa; $i++) {
		if($p == $i+1){
			$css = "p_active";
		}
		$html_chuyentrang = $html_chuyentrang . '<a href="/giang-vien-khoa-hoc-offline/id'.$_COOKIE['user_id'].'-p'.($i  + 1).'.html"
		class="v_chuyen-trang-div '.$css.'" class="v_tranght">'.($i + 1).'</a>';
	}

	if($p == $i){
		$link2 = '/giang-vien-khoa-hoc-offline/id' . $_COOKIE['user_id'] . '-p'. ($i) .'.html';
	}else{
		$link2 = '/giang-vien-khoa-hoc-offline/id' . $_COOKIE['user_id'] . '-p' . ($p+1).'.html';
	}

	$html_chuyentrang = $html_chuyentrang . '<a href="'.$link2.'" class="v_chuyen-trang-div">&gt;</a>';

	$data = [
		'result'=>1,
		'htmlPC'=>$htmlPC,
		'htmlMB'=>$htmlMB,
		'chuyentrang'=>$html_chuyentrang
	];
}

echo json_encode($data);