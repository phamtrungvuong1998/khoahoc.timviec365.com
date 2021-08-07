<?php 
require_once '../config/config.php';
$cookie_id = $_COOKIE['user_id'];
$keyword = getValue("keyword","str","POST","");
$db_point = new db_query("SELECT * FROM history_point INNER JOIN users ON user_student_id=users.user_id INNER JOIN city ON users.cit_id=city.cit_id Where center_teacher_id = '$cookie_id' AND users.user_name LIKE '%$keyword%' ORDER BY history_point_id DESC");
$db_pointMB = new db_query("SELECT * FROM history_point INNER JOIN users ON user_student_id=users.user_id INNER JOIN city ON users.cit_id=city.cit_id Where center_teacher_id = '$cookie_id' AND users.user_name LIKE '%$keyword%' ORDER BY history_point_id DESC");
if (mysql_num_rows($db_point->result)==0) {
	$html = '<div id="point_no">Chưa có dữ liệu</div>';
}else{
	$html = "";
	while ($row = mysql_fetch_array($db_point->result)) {
		$cat = explode(',', $row['cate_id']);
		$j = '';
		$i = 0;
		foreach ($cat as $value) {
			$db_cate = new db_query("SELECT cate_name FROM categories WHERE cate_id =" . $value);
			$a = mysql_fetch_assoc($db_cate->result);
                                    //echo $a['cate_name'];
			if ($i == count($cat) - 1) {
				$j = $j . $a['cate_name'];
			} else {
				$j = $j . $a['cate_name'] . ', ';
			}
			$i++;
		}
		$db_city = new db_query("SELECT cit_name FROM city where cit_id =" . $row['district_id']);
		$city = mysql_fetch_assoc($db_city->result);
		$c = $city['cit_name'];
		$c = $c . ' - ' . $row['cit_name'];
	    $html = $html . '<div class="v_noidungkh" id="v_noidungkh-">
                        <button class="v_content-list v_union"><img src="../img/Union.svg" alt="Ảnh lỗi"></button>
                        <div class="v_content-list v_monhoc">
                            <a href="'.urlDetail_student($row['user_id'],$row['user_slug']).'" class="v_point-name">'.$row['user_name'].'</a>
                            <p class="v_point-tx">'.$row['user_mail'].'</p>
                            <p class="v_point-tx">'.$row['user_phone'].'</p>
                        </div>
                        <div class="v_content-list v_monhoc-qt">'.$j.'
                        </div>
                        <div class="v_content-list">'.$c.'

                        </div>
                        <div class="v_content-list v_bacham">
                            <a href="'.urlDetail_student($row['user_id'], $row['user_slug']).'"
                                class="v_bacham-xt">Xem thêm</a>
                        </div>
                    </div>';
	}
	$htmlMB = '';
	while ($row2 = mysql_fetch_array($db_pointMB->result)) {
		$cat1 = explode(',', $row2['cate_id']);
		$j1 = '';
		$i1 = 0;
		for ($i = 0; $i < count($cat1); $i++) {
			$db_cate1 = new db_query("SELECT cate_name FROM categories WHERE cate_id =" . $cat1[$i]);
			$row1 = mysql_fetch_assoc($db_cate1->result);
			if ($i == count($cat1) - 1) {
				$j1 = $j1 . $row1['cate_name'];
			}else{
				$j1 = $j1 . $row1['cate_name'] .", ";
			}
		}
		$db_city1 = new db_query("SELECT cit_name FROM city where cit_id =" . $row2['district_id']);
		$city1 = mysql_fetch_assoc($db_city1->result);
		$c =  $city1['cit_name'];
		$c = $c . ' - ' . $row2['cit_name'];
	    $htmlMB = '<div class="v_content-mb">
                    <div class="flex v_info-all v_content-mb-div">
                        <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tên học viên :</span>
                            '.$row2['user_name'].'</div>
                        <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mail :
                            </span>'.$row2['user_mail'].'
                        </div>
                        <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số điện thoại : </span>
                            '.$row2['user_phone'].'
                        </div>
                        <div class="v_content-mb-thongtin v_content-mb-thongtin2"><span class="v_content-mb-span">Môn học quan tâm : </span>'.$j1.'
                        </div>
                        <div class="v_content-mb-thongtin">
                            <span class="v_content-mb-span">Địa chỉ :</span>
                            '.$c.'
                        </div>
                        </div>
                        <a class="v_content-mb-thongtin v_xemthem2" href="'.urlDetail_student($row2['user_id'], $row2['user_slug']).'">
                            <span class="v_content-mb-span">
                                Xem thêm
                            </span>
                        </a>
                </div>';
	}
}
$data = [
	'html'=>$html,
	'htmlMB'=>$htmlMB
];
echo json_encode($data);
?>