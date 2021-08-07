<?php
require_once '../config/config.php';
$course_id = getValue('course_id', 'int', 'GET', '');

$qr = new db_query("SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN users ON courses.user_id = users.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_id = $course_id");
$row = mysql_fetch_array($qr->result);
if ($row['certification'] == 1) {
	$cer = "checked";
	$nocer = "";
}else{
	$cer = "";
	$nocer = "checked";
}
// echo mysql_num_rows($qr->result);
$html = '';

$html = $html . '<form action="../code_xu_ly/Admin_update_online.php" method="POST" >
<input type="hidden" id="course_id" value="'.$row['course_id'].'" name="course_id" required>
<div class="v_detail_student">
<div>Tên khóa học:</div>
<div><input type="text" id="student_name" value="'.$row['course_name'].'" name="course_name" required></div>
</div>
<div class="v_detail_student">
<div>Môn học:</div>
<div>
<select name="cate_id" id="cate_id" class="v_select2">';

$qr_cate = new db_query("SELECT cate_id, cate_name FROM categories");
$html = $html . '<option value="0">Chọn môn học</option>';
while($row_cate = mysql_fetch_array($qr_cate->result)){
	if ($row_cate['cate_id'] == $row['cate_id']) {
		$cate_check = 'selected';
	}else{
		$cate_check = '';
	}
	$html = $html .'<option value="'.$row_cate['cate_id'].'"'.$cate_check.'>'.$row_cate['cate_name'].'</option>';
}
$html = $html .'</select>
</div>
</div>
<div class="v_detail_student">
<div>Môn học chi tiết:</div>
<div>
<select name="tag_id" id="tag_id" class="v_select2">
<option value="0">Chọn môn học chi tiết</option>';
$qr_tag = new db_query("SELECT tag_id, tag_name FROM tags WHERE cate_id = " . $row['cate_id']);
while($row_tag = mysql_fetch_array($qr_tag->result)){
	if ($row_tag['tag_id'] == $row['tag_id']) {
		$tag_check = 'selected';
	}else{
		$tag_check = '';
	}
	$html = $html .'<option value="'.$row_tag['tag_id'].'"'.$tag_check.'>'.$row_tag['tag_name'].'</option>';
}
$html = $html.'</select>
</div>
</div>
<div class="v_detail_student">
<div>Lợi ích khóa học:</div>
<div><textarea name="course_benefit" id="course_benefit" cols="30" minlength="50" rows="10" required>'.$row['course_benefit'].'</textarea></div>
</div>

<div class="v_detail_student">
<div>Phù hợp với ai:</div>
<div><textarea name="course_match" id="course_match" cols="30" rows="10" minlength="50" required>'.$row['course_match'].'</textarea></div>
</div>
<div class="v_detail_student">
<div>Yêu cầu khóa học:</div>
<div><textarea name="course_request" id="course_request" cols="30" rows="10" minlength="50" required>'.$row['course_request'].'</textarea></div>
</div>
<div class="v_detail_student">
<div>Mô tả tổng quát:</div>
<div><textarea name="general_describe" id="general_describe" cols="30" rows="10" minlength="50" required>'.$row['general_describe'].'</textarea></div>
</div>
</div>
<div class="v_detail_student">
<div>Thời gian học:</div>
<div><input type="number" id="time_learn" value="'.$row['time_learn'].'" placeholder="Buổi học" name="time_learn" required></div>
</div>
<div class="v_detail_student">
<div>Tài liệu học:</div>
<div><input type="number" placeholder="Số slide" value="'.$row['course_slide'].'" id="course_slide" name="course_slide" required></div>
</div>
<div class="v_detail_student">
<div>Giá gốc:</div>
<div><input type="number" id="price_listed" name="price_listed"  value="'.$row['price_listed'].'" required></div>
</div>
<div class="v_detail_student">
<div>Giá khuyến mại:</div>
<div><input type="number" id="price_promotional" value="'.$row['price_promotional'].'" required></div>
</div>
<div class="v_detail_student">
<div>Mua chung:</div>
<div>
<span>Số lượng học viên</span><input class="muachung" value="'.$row['quantity_std'].'" type="number" id="quantity_std" required>
<span>Khoảng giá</span><input class="muachung" value="'.$row['price_discount'].'" type="number" id="price_discount" required>
</div>
</div>

<div class="v_detail_student">
<div>Trình độ:</div>
<div class="levels">';

$qr_level = new db_query("SELECT * FROM levels");
while($row_lv = mysql_fetch_array($qr_level->result)){
	if ($row_lv['level_id'] == $row['level_id']) {
		$level = "checked";
	}else{
		$level = "";
	}
	$html = $html . '<input class="trinhdo" name="level_id" value="'.$row_lv['level_id'].'" type="radio" '.$level.'>'.$row_lv['level_name'];
}
$html =  $html . '</div>
</div>
<div class="v_detail_student">
<div>Thời gian học:</div>
<div><input type="text" value="'.$row['month_study'].'" placeholder="VD: 6 tháng" name="month_study" id="month_study" required></div>
</div>
<div><button type="submit" name="create_student" id="update_student">Sửa</button></div>
</form>';
$data = [
	'html'=>$html
];

echo json_encode($data);
?>