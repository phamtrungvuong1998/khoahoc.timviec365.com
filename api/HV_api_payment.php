<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';
$total_prices = getValue('total_prices','int','POST','');

$course_id = getValue('course_id','int','POST','');

$code_id = getValue('code_id','int','POST','');

$course_type = getValue('course_type','int','POST','');
if ($row['user_money'] < $total_prices) {
    set_error('404','Số tiền trong tài khoản không đủ');
}else{
    $data1 = [
        'user_student_id'=>$user_id,
        'course_id'=>$course_id,
        'code_id'=>$code_id,
        'total_prices'=>$total_prices,
        'course_type'=>$course_type
    ];
    
    add('orders',$data1);
    
    $data2 = [
        'user_money'=>$row['user_money']-$total_prices
    ];

    $dataId2 = [
        'user_id'=>$user_id
    ];

    update('users',$data2,$dataId2);
    $data = [
        'result'=>1
    ];
    success('Thanh toán thành công',$data);
}
?>