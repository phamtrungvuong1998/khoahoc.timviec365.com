<?
include_once '../config/config.php';
$today = strtotime(date("d-m-Y"));
$name = getValue('name','str','POST','','');
$l_bangcap = getValue('l_bangcap','str','POST','','');
$date_join = getValue('date_join','str','POST','','');
$l_center = getValue('l_center','str','POST','','');
$l_monhoc = getValue('l_monhoc','str','POST','','');

if($name != '' && $l_bangcap != '' && $date_join !='' && $l_center != '' && $l_monhoc !=''){
    // echo '123123';
    $add = [
        'cate_id' => $l_monhoc,
        'teacher_name' => $name,
        'qualification' => $l_bangcap,
        'date_join' =>  strtotime($date_join),
        'user_id' => $l_center,
    ];
    add('user_center_teacher',$add);
    $data = [
        'result' => true,
        'message' => 'Thêm thành công',
    ];
}else{
    $data = [
        'result' => false,
        'message' => 'Thêm thất bại',
    ];
}
echo json_encode($data);
?>