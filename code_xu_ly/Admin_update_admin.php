<?php
require_once '../config/config.php';
if(isset($_POST['btn'])){
    $adm_login_name  		= getValue("adm_login_name","str","POST","");
    $adm_name  	            = getValue("adm_name","str","POST","");
    $adm_phone  		    = getValue("adm_phone","str","POST","");
    $adm_email  			= getValue("adm_email","str","POST","");
    $data = [
        'adm_login_name'=>$adm_login_name,
        'adm_name'=>$adm_name,
        'adm_phone'=>$adm_phone,
        'adm_email'=>$adm_email,
    ];
    $where =[
        'adm_id'=>$_COOKIE['adm_id'],
    ];
    update('admin',$data,$where);

    $module_id = getValue("module_id","arr","POST","");
    $db_delete = new db_query("DELETE FROM admin_permission WHERE adm_id = ". $_COOKIE['adm_id']);
    if (isset($module_id[0])) {
        for ($i=0; $i< count($module_id); $i++) {
            $create = getValue("create".$module_id[$i], "int", "POST", "0");
            $update = getValue("update".$module_id[$i], "int", "POST", "0");
            $data1 = [
                'adm_id'=>$_COOKIE['adm_id'],
                'module_id'=>$module_id[$i],
                'permis_create'=>$create,
                'permis_update'=>$update,
            ];
            add('admin_permission', $data1);
        }
    }
    header("Location:/Admin/list_account.php");
}
if (isset($_POST['btn2'])) {
    $adm_password  	        = getValue("adm_password","str","POST","");
    $data = [
        'adm_password'=>md5($adm_password),
    ];
    $where =[
        'adm_id'=>$_COOKIE['adm_id'],
    ];
    update('admin',$data,$where);
    header("Location:/Admin/list_account.php");
}
?>