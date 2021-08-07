<meta charset="UTF-8">
<?php
require_once '../config/config.php';
$course_id = getValue('course_id','int','GET','');
$cate_id = getValue('cate_id','int','GET','');
$tag_id = getValue('tag_id','int','GET','');
$teacher_id = getValue('teacher_id','int','GET','');
$prices = getValue('prices','int','GET','');
$address = getValue('address','int','GET','');

if ($course_id != 0) {
	$qr_id = " AND courses.course_id = $course_id ";
}else{
	$qr_id = '';
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

if ($address != 0) {
	$qr_address = " AND course_basis.cit_id = $address ";
}else{
	$qr_address = '';
}

$query = "SELECT * FROM courses INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id INNER JOIN course_basis ON courses.course_id = course_basis.course_id INNER JOIN city ON city.cit_id = course_basis.cit_id WHERE courses.course_type = 1" . $qr_id . $qr_cate_id . $qr_tag_id . $qr_teacher_id . $qr_address . $qr_prices . " LIMIT " . $page .", 30";
$qr = new db_query($query);

$html = '';
$page = $page+1;
while($rowHV = mysql_fetch_array($qr->result)){
	if ($rowHV['user_type'] == 3) {
		$link = urlDetail_center($rowHV['user_id'], $rowHV['user_slug']);
	}else if ($rowHV['user_type'] == 2) {
		$link = urlDetail_teacher($rowHV['user_id'], $rowHV['user_slug']);
	}
	$html = $html .'<div class="manager" id="manager'.$rowHV['course_id'].'">
	<div class="v_title_student">'.$page.'</div>
	<div class="v_title_student">'.$rowHV['course_id'].'</div>
	<div class="v_title_student">'.$rowHV['course_name'].'</div>
	<div class="v_title_student">'. $rowHV['cate_name'] .'
	</div>
	<div class="v_title_student"><a href="'.$link.'">'.$rowHV['user_name'].'</a></div>
	<div class="v_title_student">'.$rowHV['cit_name'].'</div>
	<div class="v_title_student">'.number_format($rowHV['price_promotional']) . ' đ'.'</div>
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


?>