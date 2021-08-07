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

$html = $html . '<form name="course_form" 
onsubmit="return validate_update_student('.$course_id.');">
<div class="v_detail_student">
<div>Tên khóa học:</div>
<div><input type="text" id="student_name" value="'.$row['course_name'].'" name="student_name" required></div>
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
<div>Mô tả khóa học:</div>
<div><textarea name="" id="course_describe" cols="30" minlength="50" rows="10" required>'.$row['course_describe'].'</textarea></div>
</div>

<div class="v_detail_student">
<div>Bạn sẽ học những gì:</div>
<div><textarea name="" id="course_learn" cols="30" rows="10" minlength="50" required>'.$row['course_learn'].'</textarea></div>
</div>
<div class="v_detail_student">
<div>Đối tượng học viên:</div>
<div><textarea name="" id="course_object" cols="30" rows="10" minlength="50" required>'.$row['course_object'].'</textarea></div>
</div>
<div class="v_detail_student">
<div>Giảng viên giảng dạy:</div>
<div>';
if ($row['user_type'] == 3) {
	$html = $html . '<select name="" id="center_teacher_id" class="v_select2">
<option value="0">Chọn giảng viên</option>';
$qr_teacher = new db_query("SELECT center_teacher_id, teacher_name FROM user_center_teacher WHERE user_id = " . $row['user_id']);
while($row_teacher = mysql_fetch_array($qr_teacher->result)){
	if ($row['center_teacher_id'] == $row_teacher['center_teacher_id']) {
		$teacher_check = "checked";
	}else{
		$teacher_check = "";
	}
	$html = $html . '<option value="'.$row_teacher['center_teacher_id'].'"'.$teacher_check.'>'.$row_teacher['teacher_name'].'</option>';
}
$html = $html . '</select>';
}
$html = $html . '
</div>
</div>
<div class="v_detail_student">
<div>Thời gian học:</div>
<div><input type="number" id="time_learn" value="'.$row['time_learn'].'" placeholder="Buổi học" name="student_name" required></div>
</div>
<div class="v_detail_student">
<div>Tài liệu học:</div>
<div><input type="number" placeholder="Số slide" value="'.$row['course_slide'].'" id="course_slide" name="student_name" required></div>
</div>
<div class="v_detail_student">
<div>Giá gốc:</div>
<div><input type="number" id="price_listed"  value="'.$row['price_listed'].'" required></div>
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
<div>Chứng chỉ:</div>
<div class="certification">
<input class="chungchi" value="1" type="radio" name="certification" '.$cer.'>Có
<input class="chungchi" value="2" type="radio" name="certification" '.$nocer.'>Không
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
	$html = $html . '<input class="trinhdo" name="course_level" value="'.$row_lv['level_id'].'" type="radio" '.$level.'>'.$row_lv['level_name'];
}
$html =  $html . '</div>
</div>
<div class="v_detail_student">
<div>Thời gian học:</div>
<div><input type="number" value="'.$row['month_study'].'" name="month_study" id="month_study" required></div>
</div>
<div><button type="submit" name="create_student" id="update_student">Sửa</button></div>
</form>';
$data = [
	'html'=>$html
];

echo json_encode($data);
?>