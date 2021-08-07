<?php
require_once '../config/config.php';
$id = getValue('id','int','GET','');
$time = getValue('time','int','GET','');
$token = getValue('token','str','GET','');

$qrC = new db_query("SELECT * FROM users WHERE user_id = $id");
$rowc = mysql_fetch_array($qrC->result);
if ($rowc['user_active'] == 1) {
    header("Location: /");
}

if(time() > $time + 900){
    echo "Đường link không tồn tại";
    die();
}else{
    if (!isset($_COOKIE['user_id']) || !isset($_COOKIE['user_type'])) {
        setcookie("user_id",$id,time() + 3600*6,'/');
        setcookie("user_type",$rowc['user_type'],time() + 3600*6,'/');
        $cookie_type = $rowc['user_type'];
    }else{
        $cookie_type = $rowc['user_type'];
    }

    $cookie_id = $id;

    $qr = new db_query("SELECT * FROM tokens WHERE token = '$token' AND user_id = $id");
    if (mysql_num_rows($qr->result) == 0) {
        echo "Đường link không tồn tại";
        die();
    }else{
        $data = [
            'user_active'=>1
        ];
        $where = [
            'user_id' => $id
        ];
        update('users',$data,$where);
        $qr = new db_query("SELECT * FROM users WHERE user_id = $id");
        $row = mysql_fetch_array($qr->result);
        //--------set cookie UV chung---------
        if(isset($_COOKIE['general_login'])){
            unset($_COOKIE['general_login']);
        }
        if ($row['user_avatar'] != '') {
            $avt = 'https://khoahoc.timviec365.com/img/avatar/'.$row['user_avatar'];
        }else{
            $avt = '';
        }
        if($row['user_type'] == 1){
            $check_ntd = 2;
        }else if($row['user_type'] == 3){
            $check_ntd = 1;
        }else{
            $check_ntd = 3;
        }
        setcookie('general_login', '', time() - 7*6000,'/','.timviec365.com');
        $arr_cookie['page_login'] = 5;
        $arr_cookie['check_ntd'] = $check_ntd;
        $arr_cookie['from'] = 'khoahoc.timviec365.com';
        $arr_cookie['email'] = $row['user_mail'];
        $arr_cookie['phone'] = $row['user_phone'];
        $arr_cookie['name'] = $row['user_name'];
        $arr_cookie['cit_id'] = $row['cit_id'];
        $arr_cookie['district_id'] = $row['district_id'];
        $arr_cookie['address'] = $row['user_address'];
        $arr_cookie['pw'] = $row['user_pass'];
        $arr_cookie['avatar'] = $avt;
        $arr_cookie['active'] = 1;
        $token_cookie = json_encode($arr_cookie);
        setcookie('general_login', $token_cookie, time() + 7*6000,'/','.timviec365.com');
        //-----------------------
        // setcookie('user_id',$id,time() + 3600*6,'/');
        // setcookie('user_type',$row['user_type'],time() + 3600*6,'/');

        //-----------đồng bộ xác thực đăng ký ứng viên----------
        if($check_ntd == 2){
            $data_api = [
                'email'=>$row['user_mail'],
            ];
            $loop = [
                'vltg'=>"https://vieclamtheogio.timviec365.com/api/xacthuc_dangky_uv.php",
                'giasu'=>"https://giasu.timviec365.com/api/xacthuc_dangky_uv.php",
                'freelancer'=>"https://freelancer.timviec365.com/api/xacthuc_dangky_uv.php",
                'timviec365'=>"https://timviec365.com/api/xacthuc_dangky_uv.php",
            ];
            foreach($loop as $key => $value){
                call_api($value,$data_api);
            }
        }

        //---------------------

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <link rel="stylesheet" href="../css/reset.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/dangkithanhcong.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_footer.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_header-home.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/custom-bootstrap.css?v=<?=$version?>">
    <script type="text/javascript" src="../js/v-main.js?v=<?=$version?>"></script>
    <style>
        #content{
            margin: 0 auto;
        }
        #content-box{
            width: 100%;
        }
    </style>
    <title>Đăng kí thành công</title>
</head>

<body>
    <div id="main">
        <!-- Begin: header -->
        <?php require_once("../includes/h_inc_header.php"); ?>
        <!-- End: header -->

        <!-- Begin: content -->
        <div onclick="v_dong_qlhv()" id="content-box">
            <div id="content">
                <div id="img-success">
                    <center><img id="img-success-img" src="../img/V_dang-ki-tc.svg" alt="Ảnh lỗi"></center>
                </div>
                <div id="success-title" class="font-all-400">Tài khoản của bạn đã được kích hoạt</div>
                <div id="success-text" class="chucmung">Chúc mừng bạn đã đăng ký thành công tài khoản KHÓA HỌC tại <a href="https://timviec365.com/" target="_blank">Timviec365.com</a></div>
                <div id="success-back">
                    <center><a href="/" class="returnhome"><img id="success-back-img" src="../img/quay-tro-lai.svg"
                        alt="Ảnh lỗi">Quay
                        trở về <span>trang chủ khóa học</span></a></center>
                    </div>
                </div>
            </div>
            <!-- End: content -->

            <!-- Begin: foooter -->
            <?php require_once("../includes/h_inc_footer.php"); ?>
            <!-- End: footer -->
        </div>
    </body>

    </html>