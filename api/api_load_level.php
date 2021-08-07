<?
include '../config/config.php';
include 'functions.php';
$db_level = new db_query("SELECT * FROM levels");
$a = [];
while($row = mysql_fetch_assoc($db_level->result)){
    $a[] = $row; 
}
success('',$a);

?>