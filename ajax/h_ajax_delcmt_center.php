<?
include_once '../config/config.php';
if(isset($_POST['rate_id'])){
    $rate_id = $_POST['rate_id'];
    $del = new db_query("DELETE FROM rate_center WHERE rate_id = $rate_id");
    $del2 = new db_query("DELETE FROM rep_rate_center WHERE rate_id = $rate_id");
}
if(isset($_POST['rep_id'])){
    $rep_id = $_POST['rep_id'];
    $del = new db_query("DELETE FROM rep_rate_center WHERE rep_id = $rep_id");
}
?>