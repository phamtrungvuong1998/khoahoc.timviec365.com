<?
include_once '../config/config.php';
$id = getValue('id','str','POST','','');
$status = getValue('tt','str','POST','','');

if ($id != '' && $status !='') {
    
    // echo $status;
    $update = [
        'status'=> $status,
    ];
    $id = [
        'transaction_id' => $id,
    ];
    update('user_transaction',$update,$id);
    $html = '';
    if ($status == 1) {
        $html = 'Thành công';
    }else{
        $html = 'Thất bại';
    }
    $data = [
        'result' => true,
        'message' => 'Cập nhật thành công',
        'status' => $html,
    ];
}else{
    $data = [
        'result' => false,
        'message' => 'Cập nhật thất bại'
    ];
}
echo json_encode($data);
?>