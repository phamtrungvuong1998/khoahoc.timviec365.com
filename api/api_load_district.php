<?
include_once '../config/config.php';
include_once 'functions.php';
$district = getValue('city_id', 'str', 'GET', '', '');
if ($district != '') {
    $db_district = new db_query('SELECT cit_id,cit_name FROM city WHERE cit_parent ='.$district);
    $arr = [];
    while ($row = mysql_fetch_assoc($db_district->result)) {
        $arr [] = $row;
    }
}else{
   set_error('404',' Chọn tỉnh thành trước ');
}
?>