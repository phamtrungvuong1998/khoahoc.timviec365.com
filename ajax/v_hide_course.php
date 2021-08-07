<?php 
require_once '../config/config.php';

$course_id = getValue('course_id','int','GET','');
$course_type = getValue('course_type','int','GET','');
$user_id = $_COOKIE['user_id'];

$data = [
	'hide_course'=>0
];

$dataId = [
	'course_id'=>$course_id
];

update('courses',$data,$dataId);

$db_count = new db_query("SELECT course_id FROM courses Where course_type=2 AND user_id = $user_id AND hide_course = 1 AND accept = 1");
$row1 = mysql_num_rows($db_count->result);
$total_records = $row1;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$total_page = ceil($total_records / $limit);
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}
$start = ($current_page - 1) * $limit;

$html = '';

$db_point = new db_query("SELECT * FROM courses Where user_id = '$user_id' AND course_type = $course_type AND hide_course = 1 AND accept = 1 ORDER BY course_id DESC LIMIT 0, 10");

$db_point_mb = new db_query("SELECT * FROM courses Where user_id = '$user_id' AND course_type = $course_type AND hide_course = 1 AND accept = 1 ORDER BY course_id DESC LIMIT 0, 10");

if (mysql_num_rows($db_point->result) == 0) {
	$html = $html . '<div class = "l_font_size">Danh sách rỗng</div>';
	$data1 = [
		'result'=>0,
		'html'=>$html
	];
}else{
	$htmlPC = '<div class="l_content">
	<div class="l_content-title">
	<div class="l_table-cell l_size">KHÓA HỌC</div>
	<div class="l_table-cell l_size">MÔN HỌC</div>
	<div class="l_table-cell l_size2">TÊN GIẢNG VIÊN</div>
	<div class="l_table-cell l_size2">SỐ BUỔI HỌC</div>
	<div class="l_table-cell">TÀI LIỆU</div>
	<div class="l_table-cell">HỌC PHÍ</div>
	<div class="l_table-cell">NGÀY ĐĂNG</div>
	<div class="l_table-cell">
	<img class="lazyload" src="../img/More.svg" alt="ẢNh lỗi">
	</div>
	</div>';
	while ($rowOff = mysql_fetch_array($db_point->result)) {
		$cate_id = $rowOff['cate_id'];
		$qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
		$rowCate = mysql_fetch_array($qrCate->result);

		$center_teacher_id = $rowOff['center_teacher_id'];
		$qrGV = new db_query("SELECT teacher_name FROM user_center_teacher WHERE center_teacher_id = '$center_teacher_id'");
		$rowGV = mysql_fetch_array($qrGV->result);

		$price = $rowOff['price_listed'];

		$htmlPC = $htmlPC . '<div class="l_noidungkh">
		<div class="l_table-cell l_table-text">
		<a href="'.urlDetail_courseOnline($rowOff['course_id'],$rowOff['course_slug']).'"><p class="p">'.$rowOff['course_name'].'</p></a>
		</div>
		<div class="l_table-cell">'.$rowCate['cate_name'].'
		</div>
		<div class="l_table-cell l_madonhang">'.$rowGV['teacher_name'].'</div>
		<div class="l_table-cell l_content-list">'.$rowOff['time_learn'].' buổi</div>

		<div class="l_table-cell">'.$rowOff['course_slide'].' file</div>
		<div class="l_table-cell">'.format_number($price).' đ</div>
		<div class="l_table-cell">'.date("d-m-Y", $rowOff['created_at']).'</div>
		<div class="l_table-cell l_curson">
		<div onclick="l_chinhsua('.$rowOff['course_id'].')">
		<img class="lazyload" src="/img/load.gif" data-src="../img/More.svg" alt="">
		</div>
		<div class="l_hienthi_chinhsua" id="l_hienthi_chinhsua'.$rowOff['course_id'].'">
		<a href="/cap-nhat-khoa-hoc-online-trung-tam/id'.$user_id.'-courseOn'.$rowOff['course_id'].'.html">
		<button class="l_btn_chinhsua">
		<img src="/img/load.gif" data-src="../img/l_chinhsua.svg" alt="" class="l_img_chinhsua lazyload">
		<div class="l_chinhsuachu">
		Chỉnh sửa
		</div>
		</button>
		</a>
		<button class="l_xoakh" data-course="'.$rowOff['course_id'].'" onclick="v_del_course(this)">
		<div class="l_chinhsuachu">
		Xóa khóa học
		</div>
		</button>
		</div>
		</div>
		</div>';
	}

	$htmlPC = $htmlPC . '</div>
	</div>';

	$htmlMB = '';
	$htmlMB = $htmlMB .'<div class="mobile">';
	while ($value = mysql_fetch_array($db_point_mb->result)) {
		$cate_id = $value['cate_id'];
		$qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
		$rowCate = mysql_fetch_array($qrCate->result);
		$center_teacher_id = $value['center_teacher_id'];
		$qrGV = new db_query("SELECT teacher_name FROM user_center_teacher WHERE center_teacher_id = '$center_teacher_id'");
		$rowGV = mysql_fetch_array($qrGV->result);

		$htmlMB = $htmlMB . '<div class="v_content-mb">
		<div class="flex v_content-mb-div">
		<p class="v_content-mb-title">'.$value['course_name'].'</p>
		</div>

		<div class="flex v_info-all v_content-mb-div">
		<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Khóa học :</span>'.$value['course_name'].'</div>
		<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học: </span>'.$rowCate['cate_name'].'</div>
		<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tên giảng viên :</span>'.$rowGV['teacher_name'].'</div>
		<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số buổi học :</span> '.$value['time_learn'].' Buổi</div>
		<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tài liệu :</span>'.$value['course_slide'].' file</div>
		<div class="v_content-mb-thongtin"><span class="v_content-mb-span">Học phí :</span>'.format_number($value['price_listed']).' đ</div>
		</div>
		<div class="l_action2">
		<button class="l_action__ghichu">
		<a href="/cap-nhat-khoa-hoc-online-trung-tam/id'.$user_id.'-courseOn'.$value['course_id'].'.html">
		<img src="../img/Vector_chinh_sua.svg" alt="Ảnh lôi">
		<span class="l_action__ghichu--span">Chỉnh sửa </span>
		</a>
		</button>
		<button class="l_action__xoakh" data-course="'.$value['course_id'].'" onclick="v_del_course(this)"><span class="l_action__xoakh--span">Xóa khóa học</span></button>
		</div>
		</div>
		';
	}

	$htmlMB = $htmlMB . '</div>';

	$html_phantrang = '';

	$html_phantrang = $html_phantrang . '<div class="l_phantrang">';
	if ($current_page > 1 && $total_page > 1) {
		$html_phantrang = $html_phantrang . '<a class="l_phantrang_btn" href="/trung-tam-khoa-hoc-online-giang-day/id' . $user_id . '&page' . ($current_page - 1) . '.html">&lt;</a>';
	}

	for ($i = 1; $i <= $total_page; $i++) {
		if ($i == $current_page) {
			$html_phantrang = $html_phantrang . '<span class="l_phantrang_btn1">' . $i . '</span>';
		} else {
			$html_phantrang = $html_phantrang . '<a class="l_phantrang_btn" href="/trung-tam-khoa-hoc-online-giang-day/id' . $user_id . '&page' . $i . '.html">' . $i . '</a>';
		}
	}
	if ($current_page < $total_page && $total_page > 1) {
		$html_phantrang = $html_phantrang . '<a class="l_phantrang_btn" href="/trung-tam-khoa-hoc-online-giang-day/id' . $user_id . '&page' . ($current_page + 1) . '.html">&gt;</a>';
	}
	$html_phantrang = $html_phantrang .'</div>';

	$data1 = [
		'result'=>1,
		'htmlPC'=>$htmlPC,
		'htmlMB'=>$htmlMB,
		'html_phantrang'=>$html_phantrang
	];
}

echo json_encode($data1);
?>