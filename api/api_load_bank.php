<?
include '../config/config.php';
include 'functions.php';
$db_bank = new db_query("SELECT * FROM bank");
$a = [];
while($row = mysql_fetch_assoc($db_bank->result)){
    $a[] = $row; 
}
// $data = [
//     'city' => $a,
// ];
success('',$a);

?>