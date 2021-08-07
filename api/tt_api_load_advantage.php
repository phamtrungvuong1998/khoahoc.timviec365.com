<?
include '../config/config.php';
include 'functions.php';
$db_ad = new db_query("SELECT * FROM advantages_center");
$a = [];
while($row = mysql_fetch_assoc($db_ad->result)){
    $a[] = $row; 
}
success('',$a);

?>