<?
include_once '../config/config.php';
$today = strtotime(date("d-m-Y"));
$id = getValue('id','str','POST','','');
$name = getValue('name','str','POST','','');
$l_bangcap = getValue('l_bangcap','str','POST','','');
$date_join = getValue('date_join','str','POST','','');
$l_monhoc = getValue('l_monhoc','str','POST','','');

if ($id != '' && $name !='' && $l_bangcap != '' && $date_join != ''&& $l_monhoc != '') {
    $teacher_id = ['center_teacher_id' => $id];
    $date = strtotime($date_join);
    // echo $date;
    $update = [
        'teacher_name' => $name,
        'cate_id'=> $l_monhoc,
        'qualification' => $l_bangcap,
        'date_join' => $date,
        'updated_at' => $today
    ];
    update('user_center_teacher',$update,$teacher_id);
    $data = [
        'result' => true,
        'message'=> 'cập nhật thành công',
    ];
}else{
    $data = [
        'result' => false,
        'message'=> 'cập nhật thất bại',
    ];
}
echo json_encode($data);
?>