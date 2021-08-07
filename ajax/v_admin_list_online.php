<?php
require_once '../config/config.php';
$course_id = getValue('course_id','int','POST','');
$cate_id = getValue('cate_id','int','POST','');
$tag_id = getValue('tag_id','int','POST','');
$teacher_id = getValue('teacher_id','int','POST','');
$prices = getValue('prices','int','POST','');
$address = getValue('address','int','POST','');
$page = getValue('page','int','POST','');

if ($page == 1) {
	$page = 0;
}else{
	$page = ($page-1)*30;
}

if ($course_id != 0) {
	$qr_id = " AND courses.course_id = $course_id ";
}else{
	$qr_id = '';
}

if ($cate_id != 0) {
	$qr_cate_id = " AND courses.cate_id = $cate_id ";
	$qr_tag = new db_query("SELECT tag_id,tag_name FROM tags WHERE cate_id = $cate_id");
	$tag = '<option value="0">Môn học chi tiết</option>';
	while($row_tag = mysql_fetch_array($qr_tag->result)){
		$tag = $tag . '<option value="'.$row_tag['tag_id'].'">'.$row_tag['tag_name'].'</option>';
	}
}else{
	$qr_cate_id = '';
	$tag = '';
}

if ($tag_id != 0) {
	$qr_tag_id = " AND courses.tag_id = $tag_id ";
}else{
	$qr_tag_id = '';
}

if ($teacher_id != 0) {
	$qr_teacher_id = " AND courses.user_id = $teacher_id ";
}else{
	$qr_teacher_id = '';
}

if ($prices == 0) {
	$qr_prices = ' ORDER BY courses.course_id DESC ';
}else if($prices == 1){
	$qr_prices = ' ORDER BY courses.price_promotional ASC ';
}else if($prices == 2){
	$qr_prices = ' ORDER BY courses.price_promotional DESC ';
}


$query = "SELECT * FROM courses INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE courses.course_type = 2" . $qr_id . $qr_cate_id . $qr_tag_id . $qr_teacher_id  . $qr_prices . " LIMIT " . $page .", 30";
// echo $query;
$qr = new db_query($query);
$qr_count = new db_query("SELECT courses.course_id FROM courses WHERE courses.course_type = 2" . $qr_id . $qr_cate_id . $qr_tag_id . $qr_teacher_id );
$count = ceil(mysql_num_rows($qr_count->result)/30);
$html = '';
$page = $page+1;
while($rowHV = mysql_fetch_array($qr->result)){
	if ($rowHV['user_type'] == 3) {
		$link = urlDetail_center($rowHV['user_id'], $rowHV['user_slug']);
	}else if ($rowHV['user_type'] == 2) {
		$link = urlDetail_teacher($rowHV['user_id'], $rowHV['user_slug']);
	}

	if ($rowHV['course_index'] == 1) {
		$user_index = "checked disabled";
	}else{
		$user_index = "";
	}

	if ($rowHV['accept'] == 1) {
		$user_accept = "checked";
	}else{
		$user_accept = "";
	}

	if ($rowHV['price_listed'] == 'false') {
		$price_listed = 'Chưa cập nhật';
	}else{
		$price_listed = number_format($rowHV['price_listed']) . ' đ';
	}

	if ($rowHV['price_promotional'] == 'false') {
		$price_promotional = 'Chưa cập nhật';
	}else{
		$price_promotional = number_format($rowHV['price_promotional']) . ' đ';
	}

	$html = $html .'<div class="manager" id="manager'.$rowHV['course_id'].'">
	<div class="v_title_student">'.$page.'</div>
	<div class="v_title_student">'.$rowHV['course_id'].'</div>
	<div class="v_title_student">'.$rowHV['course_name'].'</div>
	<div class="v_title_student">'. $rowHV['cate_name'] .'
	</div>
	<div class="v_title_student"><a href="'.$link.'">'.$rowHV['user_name'].'</a></div>
	<div class="v_title_student"><a href="'.$link.'">'.$rowHV['user_name'].'</a></div>
	<div class="v_title_student">'.$rowHV['cit_name'].'</div>
	<div class="v_title_student">'.$price_listed.'</div>
	<div class="v_title_student">'.$price_promotional.'</div>
	<div class="v_title_student">'.date("d-m-Y",$rowHV['created_at']).'</div>
	<div class="v_title_student">'.date("d-m-Y",$rowHV['updated_at']).'</div>
	<div class="v_title_student"><input type="checkbox" class="v_index"
	id="v_index'.$rowHV['user_id'].'" name="student_index"
	onclick="active('.$rowHV['user_id'].')"></div>
	<div class="v_title_student"><img id="admin_edit'.$rowHV['course_id'].'"
	src="../img/vv_edi.svg" onclick="v_student_edit('.$rowHV['course_id'].')"
	alt="Ảnh lỗi"></div>
	</div>';

	$page++;
}

$v_paging = '<ul id="v_ul_paginition">
<li id="v_previous" onclick="v_paging(\'previous\')"><</li>';

for ($i = 1; $i <= $count; $i++) {
	$v_paging = $v_paging . '<li id="v_pa'.$i.'" class="v_pa" onclick="v_paging('.$i.')">'.$i.'</li>';               	
}                         
$v_paging = $v_paging.'<li id="v_next" onclick="v_paging(\'next\')">></li>
</ul>';

$data = [
	'html'=>$html,
	'v_paging'=>$v_paging,
	'tag'=>$tag
];

echo json_encode($data);
?>