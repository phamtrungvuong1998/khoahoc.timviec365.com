<?php
require_once '../config/config.php';
$user_id = getValue('teacher_id','int','POST','');
setcookie('teacher_id',$user_id,time()+300,'/');
$qr = new db_query("SELECT * FROM users JOIN city ON city.cit_id = users.cit_id JOIN `user_teach_cooperation` ON `user_teach_cooperation`.`user_id` = `users`.`user_id` 
                        JOIN `user_teach_experience` ON `user_teach_experience`.`user_id` = `users`.`user_id` WHERE users.user_id = '$user_id'");
$row = mysql_fetch_array($qr->result);
$district_id = $row['district_id'];
$cit_id = $row['cit_id'];
if ($row['user_gender'] == 1) {
	$male = "selected";
	$female = "";
}else if ($row['user_gender'] == 2){
	$male = "";
	$female = "selected";
}

echo '<form action="../code_xu_ly/Admin_update_teacher.php" method="POST" onsubmit="return validate_update_teacher();">
<div class="v_detail_student">
<div>Tên học viên:</div>
<div><input type="text" id="teacher_name" name="teacher_name" value="'.$row['user_name'].'" required></div>
</div>
<div class="v_detail_student">
<div>Email:</div>
<div><input type="email" name="teacher_email" id="teacher_email" value="'.$row['user_mail'].'" readonly></div>
</div>

<div class="v_detail_student">
<div>Số điện thoại:</div>
<div><input type="text" name="teacher_phone" maxlength="11" minlength="10" id="teacher_phone" value="'.$row['user_phone'].'" required></div>
</div>
<div class="v_detail_student">
<div>Tỉnh, thành phố:</div>
<div class="city"><select name="teacher_city" id="teacher_city">';

$qrCity = new db_query("SELECT * FROM city");

while ($rowCit = mysql_fetch_array($qrCity->result)) {
	if ($rowCit['cit_id'] == $row['cit_id']) {
		$cit_select = 'selected';
	}else{
		$cit_select = "";
	}
    echo '<option value="'.$rowCit['cit_id'].'" name="teacher_gender" '.$cit_select.'>'.$rowCit['cit_name'].'</option>';
}

echo '</select></div>
</div>
<div class="v_detail_student">
<div>Quận huyện:</div>
<div class="city"><select name="teacher_district" id="teacher_district">';

$qrDistrict = new db_query("SELECT * FROM city WHERE cit_parent = '$cit_id'");
while ($rowDistrict = mysql_fetch_array($qrDistrict->result)) {
	if ($district_id == $rowDistrict['cit_id']) {
		$district_select = 'selected';
	}else{
		$district_select = "";
	}
    echo '<option value="'.$rowDistrict['cit_id'].'" name="teacher_gender" '.$district_select.'>'.$rowDistrict['cit_name'].'</option>';
}

echo '</select></div>
</div>

<div class="v_detail_student">
<div>Địa chỉ:</div>
<div><input type="text" name="teacher_address"  id="teacher_address" value="'.$row['user_address'].'" required></div>
</div>

<div class="v_detail_student">
<div>Giới tính:</div>
<div><select name="teacher_gender" id="">
<option value="1" '.$male.'>Nam</option>
<option value="2" '.$female.'>Nữ</option>
</select></div>
</div>

<div class="v_detail_student">
<div>Ngày sinh:</div>
<div><input type="date" name="teacher_birth" value="'.$row['user_birth'].'"></div>
</div>

<div class="v_detail_student">
<div>Kinh nghiệm giảng dạy:</div>
<div><textarea name="exp_teach">'.$row['exp_teach'].'</textarea></div>
</div>

<div class="v_detail_student">
<div>Kinh nghiệm làm việc:</div>
<div><textarea name="exp_work">'.$row['exp_work'].'</textarea></div>
</div>

<div class="v_detail_student">
<div>Bằng cấp - Chứng chỉ:</div>
<div><textarea name="qualification" >'.$row['qualification'].'</textarea></div>
</div>

<div class="v_detail_student">
<div>Chức vụ hiện tại:</div>
<div><input type="text" name="current_position" value="'.$row['current_position'].'"></div>
</div>

<div class="v_detail_student">
<div>Công ty hiện tại:</div>
<div><input type="text" name="current_company" value="'.$row['current_company'].'"></div>
</div>

<div class="v_detail_student">
<div>Link cộng đồng học viên ( Nếu có ):</div>
<div><input type="text" name="link_teacher_community" value="'.$row['link_teacher_community'].'"></div>
</div>

<div class="v_detail_student">
<div>Link bài giảng online ( Nếu có ):</div>
<div><input type="text" name="link_lecture_online" value="'.$row['link_lecture_online'].'"></div>
</div>

<div class="v_detail_student">
<div>Chủ đề giảng dạy:</div>
<div><select name="teacher_cate[]" id="categories" multiple>';

$arr_cate = explode(",", $row['cate_id']);
$qrCate = new db_query("SELECT * FROM categories");
while ($rowCate = mysql_fetch_array($qrCate->result)) {
	if (in_array($rowCate['cate_id'], $arr_cate)) {
		$cate_select = "selected";
	}else{
		$cate_select = "";
	}
    echo '<option value="'.$rowCate['cate_id'].'" '.$cate_select.'>'.$rowCate['cate_name'].'</option>';
}

echo '</select></div>
</div>
<div><button type="submit" name="update_teacher" id="update_teacher">Cập nhật</button></div>
</form>';


?>