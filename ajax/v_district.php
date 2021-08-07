<?php
require_once '../config/config.php';
$v_district = getValue('v_district', 'int', 'GET', '');
$queryDistrict = new db_query("SELECT cit_name,cit_id FROM city WHERE cit_parent = '$v_district'");
echo '<option value="0">--Chọn quận huyện--</option>';
while ($rowDistrict = mysql_fetch_array($queryDistrict->result)) {
	echo '<option value="'. $rowDistrict['cit_id'] .'">'. $rowDistrict['cit_name'] .'</option>';
}
?>