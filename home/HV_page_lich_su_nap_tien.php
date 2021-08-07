<?php 
if ($_COOKIE['user_type'] == 1) {
    require_once '../includes/v_inc_insert_HV.php';
}else if ($_COOKIE['user_type'] == 2) {
    require_once '../code_xu_ly/h_manager_GV.php';
}else{
    include '../includes/v_insert_TT.php';
}
$user_id = $_COOKIE['user_id'];
$qrCount = new db_query("SELECT recharge_id FROM rechange_notice WHERE user_id = '$user_id'");

$rowCount = mysql_num_rows($qrCount->result);
$pa = $rowCount/10;

$qr = new db_query("SELECT * FROM rechange_notice INNER JOIN form_recharge ON rechange_notice.recharge_form_id = form_recharge.form_recharge_id INNER JOIN bank ON bank.bank_id = rechange_notice.bank_id WHERE user_id = '$user_id' ORDER BY recharge_id DESC LIMIT 0,10");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <?php
        if ($_COOKIE['user_type'] == 1) {
            require_once '../includes/v_inc_HV_css.php';
        }else if ($_COOKIE['user_type'] == 2) {
            require_once '../includes/v_inc_GV_css.php';
        }else{
            include '../includes/l_inc_head.php';
        }
        require_once '../includes/v_inc_DS_css.php';
     ?>
     <link rel="stylesheet" href="../css/v_phan-trang.css?v=<?=$version?>">
    <style type="text/css">
    #v_sidebar-2 {
        display: block;
    }

    #v_vi-kh {
        color: #1B6AAB;
    }
    #v_wrapper{
        display: flex;
    }
    #v_ls-nap-tien {
        color: #1B6AAB;
    }
    .l_modal_menu{
        z-index: 5;
    }
    .v_sidebar-menu:nth-child(3) button{
            color: #1B6AAB;
        }
        #v_sidebar-tb-3{
            display: block;
        }
        #v_sidebar-tb-3 li:nth-child(3) a{
            color: #1B6AAB;
        }
    .v_ghichu-mb{
        padding-left: 12px;
        padding-right: 8px;
    }

    .v_ghichu-mb-p a{
        color: #1B6AAB;
    }

    .v_btn-del:hover{
        background: #1B6AAB;
        color: white;
    }

    .p_active{
        color: white;
        background: #1B6AAB;
    }
    #v_chuyentrang{
        width: 95%;
    }
    .emptys {
        width: 95%; 
    }
    @media(max-width: 1300px){
        #content{
            display: table;
        }
        .l_right{
            width: 100%;
        }
    }
    </style>
    <script src="../js//v-main.js?v=<?=$version?>"></script>
    <title>Lịch sử nạp tiền</title>
</head>

<body>
    <div id="v_wrapper" class="flex">
        <!-- Begin: sidebar -->
        <?php
        if ($_COOKIE['user_type'] == 1) {
            require_once("../includes/inc_sidebar.php");
        }else if ($_COOKIE['user_type'] == 2) {
            require_once("../includes/inc_GV_sidebar.php");
        }else{
            include '../includes/l_inc_sidebar.php';
        }
        ?>
        <!-- End: sidebar -->

        <!-- Begin: main -->
        <div id="main" class="l_right">
            <!-- Begin: header -->
            <?php
            if ($_COOKIE['user_type'] == 1) {
                require_once '../includes/inc_manager_header.php';
            }else if($_COOKIE['user_type'] == 2){
                require_once '../includes/inc_GV_manager_header.php';
            }else{
                include '../includes/l_inc_header.php';
            }
            ?>
            <!-- End: header -->

            <!-- Begin: content -->
            <div id="content-box" class="flex">
                <div id="content">
                    <div id="v_content-title">
                        <div class="v_table-cell v_content-title-div">STT</div>
                        <div class="v_table-cell v_content-title-div">thời gian</div>
                        <div class="v_table-cell v_content-title-div">loại giao dịch</div>
                        <div class="v_table-cell v_content-title-div">số tiền</div>
                        <div class="v_table-cell v_content-title-div">trạng thái</div>
                        <div class="v_table-cell v_content-title-div v_bacham"><img src="../img/More.svg" alt="Ảnh lỗi">
                        </div>
                    </div>

                    <?php
                    $qr3 = new db_query("SELECT * FROM rechange_notice INNER JOIN form_recharge ON rechange_notice.recharge_form_id = form_recharge.form_recharge_id INNER JOIN bank ON bank.bank_id = rechange_notice.bank_id WHERE user_id = '$user_id' ORDER BY recharge_id DESC LIMIT 0,10");
                    if (mysql_num_rows($qr3->result) == 0) {
                        echo '<div class="emptys">Chưa có dữ liệu</div>';
                    }else{
                        $i = 1;
                        while ($row = mysql_fetch_array($qr3->result)) {
                            if ($row['status_recharge'] == 0) {
                                $status = "Đang chờ";
                            }else if ($row['status_recharge'] == 1) {
                                $status = "Thất bại";
                            }else{
                                $status = "Thành công";
                            }
                    ?>
                    <div class="v_noidungkh">
                        <div class="v_table-cell v_stt"><?php echo $i; ?></div>
                        <div class="v_table-cell v_content-list v_monhoc"><?php echo date("d-m-Y",$row['time_recharge']); ?></div>
                        <div class="v_table-cell v_content-list"><?php echo $row['form_recharge_name']; ?></div>
                        <div class="v_table-cell v_content-list"><?php echo number_format($row['amount']) . " đ"; ?></div>
                        <div class="v_table-cell v_content-list"><?php echo $status; ?></div>
                        <div class="v_table-cell v_content-list v_bacham">
                                <button class="v_btn-bacham"><img
                                        src="../img/More.svg" alt="Ảnh lỗi"></button>
                                <div class="v_popup" id="v_popup-<?php echo $row['recharge_id']; ?>">
                                    <!-- <center><button class="v_btn-del">GHI CHÚ</button></center> -->
                                </div>
                        </div>
                    </div>
                    <div class="v_content-mb">
                        <div class="flex v_content-mb-div">
                            <p class="v_content-mb-stt"><?php echo $i; ?></p>
                        </div>

                        <p class="v_tengiangvien"><?php echo date("d-m-Y h-i-s",$row['time_recharge']); ?></p>

                        <div class="flex v_info-all v_content-mb-div">
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Loại giao dịch : </span><?php echo $row['form_recharge_name']; ?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số tiền : </span><?php echo number_format($row['amount']) . " đ"; ?>
                            </div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Trạng thái :</span> <?php echo $status; ?></div>
                        </div>

                        <div class="flex v_mb-ghichu-all v_content-mb-div">
                           <!--  <div class="flex v_ghichu-mb">
                                <p class="v_ghichu-mb-p"><img src="../img/V_ghi-chu.svg" alt="Ảnh lỗi"></p>
                                <p class="v_ghichu-mb-p v_gc"><a href="">Ghi chú</a></p>
                            </div> -->
                        </div>
                    </div>
                    <?php 
                        $i++;
                        }
                    } 
                    ?>

                </div>

                <div id="v_chuyentrang">
                    <a class="v_chuyen-trang-div" onclick="v_chuyentrang('previous')">&lt;</a>
                    <?php for ($i = 1; $i  <= ceil($pa) ; $i++) { ?>
                    <a class="v_chuyen-trang-div v_phantrang" id="v_pa_<?php echo $i; ?>" onclick="v_chuyentrang(<?php echo $i; ?>)"><?php echo $i ?></a>
                    <?php } ?>
                    <a class="v_chuyen-trang-div" onclick="v_chuyentrang('next')">&gt;</a>
                </div>
            </div>
            <!-- End: content -->

        </div>
        <!-- End: main -->
    </div>

    <!-- Begin: foooter -->
    <?php require_once("../includes/h_inc_footer.php"); ?>
    <!-- End: footer -->
</body>
<script src="../js//v-main.js?v=<?=$version?>"></script>
<script type="text/javascript" src="../js/l_trungtam.js?v=<?=$version?>"></script>
<script type="text/javascript">
    $('#v_pa_1').css({
        "color": "white",
        "background": "#1B6AAB"
    });

    if ($('#content').children(".v_noidungkh").length == 0) {
        $('#v_chuyentrang').remove();
        $('#v_content-title').remove();
    }

    function v_chuyentrang(number, type) {
        var sum = $("#v_chuyentrang").children('.v_phantrang').length;
        if (number == 'previous') {
            if ($('#v_pa_1').css("color") != "rgb(255, 255, 255)") {
                for (var i = 1; i <= $("#v_chuyentrang").children('.v_phantrang').length; i++) {
                    if ($('#v_pa_' + i).css("color") == "rgb(255, 255, 255)") {
                        number = i - 1;
                        break;
                    }
                }
            }else{
                number = 1;
            }
        }else if (number == 'next') {
            if ($('#v_pa_' + sum).css("color") != "rgb(255, 255, 255)") {
                for (var i = 1; i <= $("#v_chuyentrang").children('.v_phantrang').length; i++) {
                    console.log($('#v_pa_' + i).css("color"));
                    if ($('#v_pa_' + i).css("color") == "rgb(255, 255, 255)") {
                        number = i + 1;
                        break;
                    }
                }
            }else{
                number = sum;
            }
        }

        for (var i = 1; i <= $("#v_chuyentrang").children('.v_phantrang').length; i++) {
                $('#v_pa_' + i).css({
                    "color": "black",
                    "background": "#F4F2FF"
                });
        }

        $.ajax({
            url: '../ajax/v_history_recharge.php',
            type: 'GET',
            dataType: 'json',
            data: {number: number},
            success: function (data) {
                $('#v_pa_' + number).css({
                    "color": "white",
                    "background": "#1B6AAB"
                });

                $('.v_noidungkh').remove();
                $('.v_content-mb').remove();
                $('#content').append(data.html);
            }
        });
    }
</script>

</html>