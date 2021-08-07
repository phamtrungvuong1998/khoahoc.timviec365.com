<style>
#v_info_ad {
    display: flex !important;
}
</style>
<?php
require_once '../config/config.php';
$adm_id = getValue('adm_id','int','POST','');
setcookie('adm_id',$adm_id,time()+300,'/');
$qr = new db_query("SELECT * FROM admin WHERE adm_id = '$adm_id'");
$row = mysql_fetch_array($qr->result);

$acess_module			= "";
$arrayAddEdit 			= array();
$db_access = new db_query("SELECT * FROM admin, admin_permission, admin_modules WHERE admin.adm_id = admin_permission.adm_id AND admin_permission.module_id = admin_modules.module_id AND admin.adm_id = $adm_id");
while ($row_access = mysql_fetch_array($db_access->result)){
	$acess_module 			.= "[" . $row_access['module_id'] . "]";
	$arrayAddEdit[$row_access['module_id']] = array($row_access["permis_create"],$row_access["permis_update"]);
}
unset($db_access);


$output = '';
$output.= '<form action="../code_xu_ly/Admin_update_admin.php" id="form_account" method="POST" enctype="multipart/form-data">
                    <div>
                        <div class="title_account">Tên đăng nhập:</div>
                        <div class="title_input"><input readonly style="background:#eee" type="text" id="adm_login_name" name="adm_login_name" value="'.$row['adm_login_name'].'">
                        </div>
                    </div>
                    <div>
                        <div class="title_account">email:</div>
                        <div class="title_input"><input readonly style="background:#eee" id="adm_email" type="email" name="adm_email" value="'.$row['adm_email'].'"></div>
                    </div>
                    <div>
                        <div class="title_account">Họ tên:</div>
                        <div class="title_input"><input type="text" id="adm_name" name="adm_name" value="'.$row['adm_name'].'"></div>
                    </div>
                    <div>
                        <div class="title_account">Số điện thoại:</div>
                        <div class="title_input"><input type="text" id="adm_phone" name="adm_phone" value="'.$row['adm_phone'].'"></div>
                    </div>
                    <div>
                        <div class="title_account">Quyền quản lí:</div>
                        <div class="title_input" id="title_manager">
                            <div id="manager">
                                <div id="v_select">Chọn</div>
                                <div id="v_list">Danh sách</div>
                                <div id="v_create">Thêm</div>
                                <div id="v_edit">Sửa</div>
                            </div>
                            ';
                                $qrMod = new db_query("SELECT * FROM admin_modules WHERE module_parent = 0");
                                while ($rowmod = mysql_fetch_array($qrMod->result)) {
                                    $checked2 ="";
                                    $checked1 = "";
                                    $checked3 ="";
                                    if (strpos($acess_module, "[" .$rowmod['module_id'] . "]" ) !==false) {
                                        $checked1 = "checked";
                                    }
                                    if(isset($arrayAddEdit[$rowmod['module_id']])){
                                        if($arrayAddEdit[$rowmod['module_id']][0]==1) {
                                            $checked2 ="checked";
                                        } 
                                    }
                                    if(isset($arrayAddEdit[$rowmod['module_id']])){
                                        if($arrayAddEdit[$rowmod['module_id']][1]==1){
                                            $checked3 ="checked";
                                        }
                                    }
                                    $output .='
                            <div class="manager">
                                <div class="v_select"><input type="checkbox" '.$checked1.' id="module_id" name="module_id[]" value="'.$rowmod['module_id'].'"></div>
                                <div class="v_list">'.$rowmod['module_name'].'</div>
                                <div class="v_create"><input type="checkbox" '.$checked2.' id="create'.$rowmod['module_id'].'"value="1" name="create'.$rowmod['module_id'].'"></div>
                                <div class="v_edit"><input type="checkbox" '.$checked3.' id="update'.$rowmod['module_id'].'" value="1" name="update'.$rowmod['module_id'].'"></div>
                            </div>';
                            }
                            $output .='
                        </div>
                    </div>
                    <div><button type="submit" name="btn" id="btn_account">Cập nhật</button></div>
                </form>
                
                <form  action="../code_xu_ly/Admin_update_admin.php" id="form_account" method="POST" onsubmit="return validation2()">
                    <div>
                        <div class="title_account">Mật khẩu mới:</div>
                        <div class="title_input"><input id="password" type="password" name="adm_password"></div>
                    </div>
                    <div>
                        <div class="title_account">Nhập lại mật khẩu:</div>
                        <div class="title_input"><input id="repassword" type="password"></div>
                    </div>

                    <div><button type="submit" name="btn2" id="btn_account">Cập nhật</button></div>
                </form>'
                ;
echo $output;
?>