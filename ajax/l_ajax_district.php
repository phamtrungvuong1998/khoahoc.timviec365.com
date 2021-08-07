<?
require_once '../config/config.php';

if(!empty($_POST["city_id"])){
    if($_POST["city_id"] == 0){
        echo '<option value="">Chọn tỉnh thành trước</option>';
        return false;
    }
    else{
    $query = new db_query("SELECT * FROM city WHERE cit_parent =".$_POST["city_id"]); 
        while($row = mysql_fetch_assoc($query->result)){  
            echo '<option value="'.$row['cit_id'].'">'.$row['cit_name'].'</option>'; 
        }
    }
}

?>