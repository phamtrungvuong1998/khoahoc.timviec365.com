<?php
require_once '../config/config.php';
$user_id = getValue('student_id','int','POST','');
setcookie('student_id',$user_id,time()+300,'/');
$qr = new db_query("SELECT * FROM users WHERE user_id = '$user_id'");
$row = mysql_fetch_array($qr->result);
$cit_id = $row['cit_id'];
$district_id = $row['district_id'];
if ($row['user_gender'] == 1) {
	$male = "selected";
	$female = "";
	$select = "";
}else if ($row['user_gender'] == 2){
	$male = "";
	$female = "selected";
	$select = "";
}else if ($row['user_gender'] == 0) {
	$male = "";
	$female = "";
	$select = "selected";
}
$html = '<form action="../code_xu_ly/Admin_update_student.php" method="POST" onsubmit="return validate_update_student();">
<div class="v_detail_student">
<div>Tên học viên:</div>
<div><input type="text" id="student_name" name="student_name" value="'.$row['user_name'].'" required></div>
</div>
<div class="v_detail_student">
<div>Email:</div>
<div><input type="email" name="student_email" id="student_email" value="'.$row['user_mail'].'" readonly></div>
</div>

<div class="v_detail_student">
<div>Số điện thoại:</div>
<div><input type="text" name="student_phone" maxlength="11" minlength="10" id="student_phone" value="'.$row['user_phone'].'" required></div>
</div>
<div class="v_detail_student">
<div>Tỉnh, thành phố:</div>
<div class="city"><select name="student_city" id="student_city" onchange="v_city()">';

$qrCity = new db_query("SELECT * FROM city");

$html = $html . '<option value="0" name="student_gender">Chọn tỉnh, thành phố</option>';

while ($rowCit = mysql_fetch_array($qrCity->result)) {
	if ($rowCit['cit_id'] == $row['cit_id']) {
		$cit_select = 'selected';
	}else{
		$cit_select = "";
	}
    $html = $html . '<option value="'.$rowCit['cit_id'].'" name="student_gender" '.$cit_select.'>'.$rowCit['cit_name'].'</option>';
}

$html = $html . '</select></div>
</div>
<div class="v_detail_student">
<div>Quận huyện:</div>
<div class="city"><select name="student_district" id="student_district">';

if ($row['cit_id'] == 0) {
	$html = $html . '<option value="0" name="student_gender">Chọn quận huyện</option>';
}else{
	$html = $html . '<option value="0" name="student_gender">Chọn quận huyện</option>';	
	$qrDistrict = new db_query("SELECT * FROM city WHERE cit_parent = '$cit_id'");
	while ($rowDistrict = mysql_fetch_array($qrDistrict->result)) {
		if ($district_id == $rowDistrict['cit_id']) {
			$district_select = 'selected';
		}else{
			$district_select = "";
		}
		$html = $html . '<option value="'.$rowDistrict['cit_id'].'" name="student_gender" '.$district_select.'>'.$rowDistrict['cit_name'].'</option>';
	}
}

$html = $html . '</select></div>
</div>

<div class="v_detail_student">
<div>Địa chỉ:</div>
<div><input type="text" name="student_address" maxlength="11" minlength="10" id="student_address" value="'.$row['user_address'].'" required></div>
</div>

<div class="v_detail_student">
<div>Giới tính:</div>
<div><select name="" id="">
<option value="" name="student_gender" '.$select.'>Giới tính</option>
<option value="" name="student_gender" '.$male.'>Nam</option>
<option value="" name="student_gender" '.$female.'>Nữ</option>
</select></div>
</div>

<div class="v_detail_student">
<div>Ngày sinh:</div>
<div><input type="date" value="'.$row['user_birth'].'"></div>
</div>

<div class="v_detail_student">
<div>Môn học quan tâm:</div>
<div><select name="student_cate[]" id="categories" multiple>';

$arr_cate = explode(",", $row['cate_id']);
$qrCate = new db_query("SELECT * FROM categories");
while ($rowCate = mysql_fetch_array($qrCate->result)) {
	if (in_array($rowCate['cate_id'], $arr_cate)) {
		$cate_select = "selected";
	}else{
		$cate_select = "";
	}
    $html = $html . '<option value="'.$rowCate['cate_id'].'" '.$cate_select.'>'.$rowCate['cate_name'].'</option>';
}

$html = $html . '</select></div>
</div>
<div><button type="submit" id="update_student">Cập nhật</button></div>
</form>';

$data = [
	'html'=>$html
];

echo json_encode($data);

?>