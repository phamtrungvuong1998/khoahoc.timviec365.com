<?php
require_once '../config/config.php';
$point_id = getValue('point_id','int','POST','');
setcookie('point_id',$point_id,time()+300,'/');
$qr = new db_query("SELECT * FROM points JOIN users ON users.user_id = points.user_id WHERE point_id = '$point_id'");
$row = mysql_fetch_array($qr->result);

if(isset($_POST['btn'])){
    $sql_point = new db_query("SELECT point_add_total,user_id FROM points WHERE point_id =  $point_id");
    $row_point = mysql_fetch_array($sql_point->result);
    $point_total = $row_point['point_add_total'] + $point_add;
    $dataId = [
        'point_id'=> $point_id
    ];

    $data = [
        'point_add_total'=>$point_total,
    ];

    update('points',$data,$dataId);

    $center_teacher_id = $row_point['user_id'];
    $data2 = [
        'center_teacher_id'=>$center_teacher_id,
        'point_add'=>$point_add
    ];
    add('history_point',$data2);

    header("Location: /Admin/admin_list_point.php");
}

echo '<form action="../code_xu_ly/Admin_update_point.php" method="POST" onsubmit="return validate_update_student();">
<div class="v_detail_student">
<div>Tên học viên:</div>
<div><input type="text" id="student_name" name="student_name" value="'.$row['user_name'].'" readonly></div>
</div>
<div class="v_detail_student">
<div>Email:</div>
<div><input type="email" name="student_email" id="student_email" value="'.$row['user_mail'].'" readonly></div>
</div>

<div class="v_detail_student">
<div>Thêm điểm:</div>
<div><input type="number" name="point_add_total"></div>
</div>

<div><button name="btn" type="submit" id="update_student">Cập nhật</button></div>
</form>';

?>