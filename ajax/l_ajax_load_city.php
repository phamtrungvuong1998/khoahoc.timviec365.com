<?php

include "../config/config.php";
$district = getValue('l_district', 'str', 'GET', '', '');
if ($district != 0) {
    $db_district = new db_query('SELECT * FROM city WHERE cit_parent ='.$district);
    while ($row = mysql_fetch_assoc($db_district->result)) {
        echo "<option value=" . $row['cit_id'] . ">". $row['cit_name'] . "</option>";
    }
}else{
    echo "<option value=''>Chọn tỉnh thành trước</option>";
}
