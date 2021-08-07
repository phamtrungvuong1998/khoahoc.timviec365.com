<?
include '../config/config.php';
$id = getValue('id','int','POST','','');
if($id!=0){
    $dele = new db_query("DELETE FROM user_center_basis WHERE center_basis_id = '$id'");
    $data = [
        'result'=>true,
        'message'=> 'Đã xóa địa chỉ',
    ];
}else{
    $data = [
        'result'=>false,
        'message'=> 'Rỗng',
    ];
}
echo json_encode($data);
?>