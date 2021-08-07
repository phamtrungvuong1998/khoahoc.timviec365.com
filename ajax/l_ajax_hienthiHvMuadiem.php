<?php

include '../config/config.php';

$user_id = $_COOKIE['user_id'];

$point = getValue('point', 'int', 'GET', 0, 0);
$id = getValue('id', 'int', 'GET', 0, 0);

$cook_id = [
    'user_id' => $user_id
];

if ($point == 1) {
    $db_point = new db_query("SELECT * FROM points where user_id = '$user_id'");
    $row = mysql_fetch_assoc($db_point->result);

    $dataId = [
        'point_id'=>$row['point_id']
    ];

    $data = [
        'point'=>0
    ];

    update('points',$data,$dataId);

    $dataPoint = [
        'user_student_id'=>$id,
        'center_teacher_id'=>$user_id
    ];

    add('history_point',$dataPoint);

    $qrStudent = new db_query("SELECT * FROM users WHERE user_id = $id");
    $row = mysql_fetch_array($qrStudent->result);
    $phone = $row['user_phone'];
    $email = $row['user_mail'];
    $data2 = [
        'result'=>true,
        'phone'=>$phone,
        'email'=>$email,
        'money'=>-1
    ];
}else{
    $qrMoney = new db_query("SELECT * FROM users WHERE user_id = $user_id");
    $rowMoney = mysql_fetch_array($qrMoney->result);
    // echo $rowMoney['user_money'];
    if ($rowMoney['user_money'] < 10000) {
        $data2 = [
            'result'=>false,
        ];
    }else{
        $dataId = [
            'user_id'=>$user_id,
        ];

        $money = $rowMoney['user_money'] - 10000;

        $data = [
            'user_money'=>$money
        ];
        update('users',$data,$dataId);

        $dataPoint = [
            'user_student_id'=>$id,
            'center_teacher_id'=>$user_id
        ];

        add('history_point',$dataPoint);
        $qrStudent = new db_query("SELECT * FROM users WHERE user_id = $id");
        $row = mysql_fetch_array($qrStudent->result);
        $phone = $row['user_phone'];
        $email = $row['user_mail'];
        $data2 = [
            'result'=>true,
            'phone'=>$phone,
            'email'=>$email,
            'money'=>number_format($money)
        ];
    }
}

echo json_encode($data2);

// if ($point != 0 && $id != 0) {
//     $data = [
//         'user_student_id' => $id,
//         'center_teacher_id' => $user_id,
//         'point_minus' => 1,
//         'type_point' => 1
//     ];
//     add('history_point', $data);
//     $db_point = new db_query("SELECT * FROM points where user_id = '$user_id'");
//     $row = mysql_fetch_assoc($db_point->result);
//     $total = $row['point'];
//     $total_add = $row['point_add_total'];
//     if ($total > 0) {
//         $total2 = $total - 1;
//         $total3 = $row['point_minus_total'] + 1;
//         $data2 = [
//             'point' => $total2,
//             'point_minus_total' => $total3
//         ];
//         update('points', $data2, $cook_id);
//     }
//     else if($total == 0){
//         $qr = new db_query("SELECT * FROM users WHERE user_id = $user_id");
//         $row = mysql_fetch_array($qr->result);
//         if ($row['user_money'] < 10000) {
//             echo 'Bạn không đủ tiền để xem thông tin học viên';
//         }else{
//             $data = [
//                 'user_student_id' => $id,
//                 'center_teacher_id' => $user_id,
//                 'point_minus' => 1,
//                 'type_point' => 1
//             ];
//             add('history_point', $data);
//         }
//         $total_add1 = $total_add - 1;
//         $total_add2 = $row['point_minus_total'] + 1;
//         $data3 = [
//             'point_add_total' => $total_add1,
//             'point_minus_total' => $total_add2
//         ];
//         update('points', $data3, $cook_id);
//     }
//     $select = new db_query("SELECT * FROM users where user_id = '$id'");
//     $rowid = mysql_fetch_assoc($select->result);
//     echo $rowid['user_mail'];
//     echo 'nhanh';
//     echo $rowid['user_phone'];
// } else {
//     echo 'Bạn không đủ điểm để xem thông tin học viên';
// }
