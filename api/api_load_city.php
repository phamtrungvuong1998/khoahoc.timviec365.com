<?
include '../config/config.php';
include 'functions.php';
$db_city = new db_query("SELECT cit_id,cit_name FROM city WHERE cit_parent = 0");
$a = [];
while($row = mysql_fetch_assoc($db_city->result)){
    $a[] = $row; 
}
// $data = [
//     'city' => $a,
// ];
success('',$a);

?>