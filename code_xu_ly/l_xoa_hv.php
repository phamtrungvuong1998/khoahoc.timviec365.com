
<?
include "../config/config.php";
$id = getValue('id','int','GET',0,0);
$page = getValue('page','int','GET',0,0);
$num = getValue('num','int','GET',0,0);

if($id != 0 && $page != 0 && $num !=0){
    $db_del = new db_query("DELETE FROM save_student WHERE save_id=".$id);


}
?>