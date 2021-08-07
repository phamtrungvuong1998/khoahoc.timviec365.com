<?
include '../config/config.php';
$db_city = new db_query("SELECT * FROM categories");
$cate = [];
while($row = mysql_fetch_assoc($db_city->result)){
    $cate[] = $row; 
}
// $data = [
//     'city' => $cate,
// ];
// success('',$cate);

?>