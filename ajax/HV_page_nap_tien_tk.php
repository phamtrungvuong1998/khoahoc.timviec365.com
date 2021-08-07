<?php
require_once '../includes/v_inc_insert_HV.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <?php require_once '../includes/v_inc_HV_css.php'; ?>
    <link rel="stylesheet" href="../css/HV-page_nap _tien_tk.css?v=<?=$version?>">
    <style type="text/css">
        #v_sidebar-2 {
            display: block;
        }

        #v_vi-kh {
            color: #1B6AAB;
        }

        #v_nap-tien {
            color: #1B6AAB;
        }

        [id*=v_bank_validate-] {
            color: red;
        }

        #v_alert-content {
            display: none;
        }

        .v_bank3{
            position: relative;
        }
        .v_sidebar-menu:nth-child(3) button{
            color: #1B6AAB;
        }
        #v_sidebar-tb-3{
            display: block;
        }
        #v_sidebar-tb-3 li:nth-child(1) a{
            color: #1B6AAB;
        }
        .v_border_bank{
            display: none;
            position: absolute;
            top: 7px;
            left: 9px;
            border: 2px solid #1B6AAB;
            border-radius: 4px;
            width: 167px;
            height: 92px;

        }
        .v_alert-detail-1:nth-child(2){
            position: relative;
        }
        .v_d{
            color: #00000061;
            position: absolute;
            background: none;
            border-bottom: none;
            border-top: none;
            border-right: none;
            bottom: 35px;
            right: 10px;
            padding-left: 10px;
            border-left: 1px solid rgba(0, 0, 0, 0.12);
        }
        #v_amount{
            padding-right: 30px;
        }
        ::placeholder{
            color: #00000061;
            font-weight: 400;
        }
        @media(max-width: 320px){
            .v_border_bank{
                left: 8px;
                width: 139px;
                height: 77px;
            }
        }
    </style>
    <title>Nạp tiền</title>
</head>

<body>
    <center id="v_alert-rechange">
        <form id="v_alert-content" onsubmit="return v_alert();">
            <h2 id="v_alert-title">THÔNG BÁO NẠP TIỀN</h2>
            <div id="v_alert-detail">
                <div class="v_alert-detail-1">
                    <label for="">Ngân hàng nhận tiền</label>
                    <select name="bank_get" id="bank_get">
                        <option value="0">--Chọn ngân hàng--</option>
                        <?php
                        $qrBank = new db_query("SELECT * FROM bank");
                        while ($rowBank = mysql_fetch_array($qrBank->result)) {
                        ?>
                            <option value="<?php echo $rowBank['bank_id']; ?>"><?php echo $rowBank['bank_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <p id="v_bank_validate-1"></p>
                </div>
                <div class="v_alert-detail-1">
                    <label for="">Số tiền nạp</label>
                    <input type="text" id="v_amount" placeholder="1.000.000" name="amount">
                    <button class="v_d">VNĐ</button>
                    <p id="v_bank_validate-2"></p>
                </div>
                <div class="v_alert-detail-1">
                    <label for="">Hình thức chuyển tiền</label>
                    <select name="" id="v_form_recharge">
                        <option value="0">--Chọn hình thức chuyển tiền--</option>
                        <?php
                        $qrRecharge = new db_query("SELECT * FROM form_recharge");
                        while ($rowRecharge = mysql_fetch_array($qrRecharge->result)) {
                        ?>
                            <option value="<?php echo $rowRecharge['form_recharge_id']; ?>">
                                <?php echo $rowRecharge['form_recharge_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <p id="v_bank_validate-3"></p>
                </div>
                <div class="v_alert-detail-1">
                    <label for="">Ngân hàng chuyển tiền</label>
                    <select name="bank_set" id="bank_set">
                        <option value="0">--Chọn ngân hàng--</option>
                        <?php
                        $qrBank = new db_query("SELECT * FROM bank");
                        while ($rowBank = mysql_fetch_array($qrBank->result)) {
                        ?>
                            <option value="<?php echo $rowBank['bank_id']; ?>"><?php echo $rowBank['bank_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <p id="v_bank_validate-4"></p>
                </div>
                <div class="v_alert-detail-1">
                    <label for="">Tên người chuyển tiền</label>
                    <input type="text" name="name_recharge" placeholder="Nguyễn Xuân Hòa" id="name_recharge">
                    <p id="v_bank_validate-5"></p>
                </div>
                <div class="v_alert-detail-1">
                    <label for="">Số tài khoản chuyển tiền</label>
                    <input type="text" name="bank_account" id="bank_account">
                    <p id="v_bank_validate-6"></p>
                </div>
                <div class="v_alert-detail-1">
                    <label for="">Thời gian chuyển tiền</label>
                    <input type="date" id="time_recharge" name="time_rechange">
                    <p id="v_bank_validate-7"></p>
                </div>
                <div class="v_alert-detail-1">
                    <label for="">Nội dung chuyển tiền</label>
                    <input type="text" id="content_rechange" name="content_rechange">
                    <p id="v_bank_validate-8"></p>
                </div>
                <div id="v_alert-div-btn">
                    <button class="v_alert-btn1">GỬI THÔNG BÁO</button>
                    <div class="v_alert-btn" style="cursor: pointer; padding-top: 6px;">HỦY</div>
                </div>
        </form>
    </center>
    <div id="v_wrapper" class="flex">
        <!-- Begin: sidebar -->
        <?php require_once("../includes/inc_sidebar.php"); ?>
        <!-- End: sidebar -->

        <!-- Begin: main -->
        <div id="main">
            <!-- Begin: header -->
            <?php require_once '../includes/inc_manager_header.php'; ?>
            <!-- End: header -->
            <!-- Begin: content -->
            <div id="v_content">
                <div id="v_content-div-hr">
                    <hr id="v_content-hr">
                </div>
                <div id="v_title">THÔNG TIN TÀI KHOẢN</div>
                <div id="v_bank">
                    <center>
                        <div id="v_bank-detail">
                            <h2 id="v_bank-detail-title">THÔNG TIN TÀI KHOẢN &nbsp;<span id="v_name-bank"></span></h2>

                            <p class="v_bank-detail-info">Tên ngân hàng : &nbsp;<span id="v_ten-ngan-hang"></span></p>

                            <p class="v_bank-detail-info">Số tài khoản : &nbsp;<span id="v_so-tk"></span></p>
                            <p class="v_bank-detail-info">Chủ tài khoản : &nbsp;<span id="v_chu-tk"></span></p>
                            <p class="v_bank-detail-info">Chi nhánh : &nbsp;<span id="v_chi-nhanh"></span></p>
                            <p class="v_bank-detail-info">Nội dung chuyển khoản : &nbsp;<span id="v_noi-dung"></span>
                            </p>
                        </div>
                    </center>
                    <center id="v_bank-1">
                        <button onclick="v_bank(1)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/techcombank.png" alt="Ảnh lỗi">
                        <div class="v_border_bank"></div>
                        </button>
                        <button onclick="v_bank(2)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/bidv2.png" alt="Ảnh lỗi">
                        <div class="v_border_bank"></div></button>
                        <button onclick="v_bank(3)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/vietcombank.png" alt="Ảnh lỗi">
                        <div class="v_border_bank"></div></button>
                        <button onclick="v_bank(4)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/sacombank.png" alt="Ảnh lỗi">
                        <div class="v_border_bank"></div></button>
                    </center>
                    <center id="v_bank-2">
                        <button onclick="v_bank(5)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/acb.png" alt="Ảnh lỗi">
                        <div class="v_border_bank"></div></button>
                        <button onclick="v_bank(6)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/vib.png" alt="Ảnh lỗi">
                        <div class="v_border_bank"></div></button>
                        <button onclick="v_bank(7)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/agribank.png" alt="Ảnh lỗi">
                        <div class="v_border_bank"></div></button>
                        <button onclick="v_bank(8)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/viettinbank.png" alt="Ảnh lỗi">
                        <div class="v_border_bank"></div></button>
                    </center>
                    <center id="v_bank-3">
                        <button onclick="v_bank(9)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/mbbank.png" alt="Ảnh lỗi">
                        <div class="v_border_bank"></div></button>
                        <button onclick="v_bank(10)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/tpbank.png" alt="Ảnh lỗi">
                            <div class="v_border_bank"></div></button>
                    </center>
                </div>

                <div id="v_danger">
                    <div id="v_danger-1">LƯU Ý : KHI CHUYỂN KHOẢN VUI LÒNG GHI ĐÚNG NỘI DUNG</div>
                    <div id="v_danger-2">SAU KHI CHUYỂN TIỀN THÀNH CÔNG QUÝ KHÁCH VUI LÒNG GỬI THÔNG BÁO CHUYỂN TIỀN CHO
                        HỆ THỐNG THEO MỘT TRONG CÁC CÁCH SAU</div>
                </div>

                <div id="v_content-contact">
                    <div class="v_content-contact-div">
                        <div class="v_content-contact-1" style="cursor: pointer;">
                            <p class="v_content-contact-img"><img class="lazyload" src="/img/load.gif" data-src="../img/simple-icons_minutemailer (1).svg" alt="Ảnh lỗi"></p>
                            <p class="v_content-contact-text">Gửi thông báo nạp tiền</p>
                        </div>
                    </div>
                    <div class="v_content-contact-div">
                        <div class="v_content-contact-1">
                            <p class="v_content-contact-img"><img class="lazyload" src="/img/load.gif" data-src="../img/ion_chatbox-ellipses.svg"></p>
                            <p class="v_content-contact-text"><a href="">Thông báo trên chatbox</a></p>
                        </div>
                    </div>
                    <div class="v_content-contact-div">
                        <div class="v_content-contact-1">
                            <p class="v_content-contact-img"><img class="lazyload" src="/img/load.gif" data-src="../img/logos_skype.svg" alt="Ảnh lỗi"></p>
                            <p class="v_content-contact-text"><a href="">Thông báo qua skype</a></p>
                        </div>
                    </div>
                    <div class="content-contact-div">
                        <div class="v_content-contact-1">
                            <p class="v_content-contact-img"><img class="lazyload" src="/img/load.gif" data-src="../img/entypo_old-phone.svg" alt="Ảnh lỗi"></p>
                            <p class="v_content-contact-text"><a href="">Thông báo qua Hotline</a></p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- End: content -->

        </div>
        <!-- End: main -->
    </div>

    <!-- Begin: foooter -->
    <!-- Begin: foooter -->
    <!-- End: footer -->
    <!-- End: footer -->
    <?php require_once '../includes/h_inc_footer.php'; ?>
</body>
<script src="../js/v-main.js?v=<?=$version?>"></script>
<script type="text/javascript">
    function v_alert() {
        if ($("#bank_get").val() == 0) {
            $("#v_bank_validate-1").text("Vui lòng chọn ngân hàng nhận tiền");
            $(".v_d").css('bottom', '57px');
            return false;
        }else{
            $(".v_d").css('bottom', '35px');
            $("#v_bank_validate-1").text("");
        }

        if ($("#v_amount").val() == "") {
            $(".v_d").css('bottom', '57px');
            $("#v_bank_validate-2").text("Vui lòng nhập số tiền");
            return false;
        } else if (isNaN($("#v_amount").val())) {
            $(".v_d").css('bottom', '57px');
            $("#v_bank_validate-2").text("số tiền phải là số");
            return false;
        }else if(Number($("#v_amount").val()) == 0){
            $(".v_d").css('bottom', '57px');
            $("#v_bank_validate-2").text("số tiền phải lớn hơn 0");
            return false;
        }else{
            $(".v_d").css('bottom', '35px');
            $("#v_bank_validate-2").text("");
        }

        if ($("#v_form_recharge").val() == 0) {
            $("#v_bank_validate-3").text("Vui lòng chọn hình thức chuyển tiền");
            return false;
        }else{
            $("#v_bank_validate-3").text("");
        }

        if ($("#bank_set").val() == 0) {
            $("#v_bank_validate-4").text("Vui lòng chọn ngân hàng chuyển tiền");
            return false;
        }else{
            $("#v_bank_validate-4").text("");
        }

        if ($("#name_recharge").val() == "") {
            $("#v_bank_validate-5").text("Vui lòng điền tên người chuyển tiền");
            return false;
        }else{
            $("#v_bank_validate-5").text("");
        }

        if ($("#bank_account").val() == "") {
            $("#v_bank_validate-6").text("Vui lòng điền số tài khoản chuyển tiền");
            return false;
        }else{
            $("#v_bank_validate-6").text("");
        }

        if ($("#time_recharge").val() == "") {
            $("#v_bank_validate-7").text("Vui lòng chọn thời gian chuyển tiền");
            return false;
        }else{
            $("#v_bank_validate-7").text("");
        }

        if ($("#content_rechange").val() == "") {
            $("#v_bank_validate-8").text("Vui lòng điền nội dung chuyển tiền");
            return false;
        }else{
            $("#v_bank_validate-8").text("");
        }

        $.get('../ajax/v_ajax_alert_recharge.php', {
            bank_get: $("#bank_get").val(),
            amount: $("#v_amount").val(),
            form_recharge: $("#v_form_recharge").val(),
            bank_set: $("#bank_set").val(),
            name_recharge: $("#name_recharge").val(),
            bank_account: $("#bank_account").val(),
            time_recharge: $("#time_recharge").val(),
            content_recharge: $("#content_rechange").val()
        }, function(data) {
            alert("Gửi thông báo nạp tiền thành công. Vui lòng chờ phản hồi");
        });

        return false;
    }

    function v_bank(n) {
        switch (n) {
            case 1:
                document.getElementById("v_name-bank").innerText = "TECHCOMBANK";
                document.getElementById("v_ten-ngan-hang").innerText = "Ngân hàng TMCP kỹ thương Việt Nam ( Techcombank )";
                document.getElementById("v_so-tk").innerText = "19031707022012";
                document.getElementById("v_chu-tk").innerText = "DƯƠNG THỊ MINH TUYỂN";
                document.getElementById("v_chi-nhanh").innerText = "Đống Đa, Hà Nội";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ Tên khóa học_ Mã đơn hàng_ khóa học tại timviec365.com";
                for (var i = 0; i < $(".v_border_bank").length; i++) {
                    if (i == n - 1) {
                        $(".v_border_bank").eq(i).css('display', 'block');
                    }else{
                        $(".v_border_bank").eq(i).css('display', 'none');
                    }
                }
                break;

            case 2:
                document.getElementById("v_name-bank").innerText = "BIDV";
                document.getElementById("v_ten-ngan-hang").innerText = "Ngân hàng đầu tư và phát triển Việt Nam ( BIDV )";
                document.getElementById("v_so-tk").innerText = "21610000462781";
                document.getElementById("v_chu-tk").innerText = "DƯƠNG THỊ MINH TUYỂN";
                document.getElementById("v_chi-nhanh").innerText = "Hà Nội";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ Tên khóa học_ Mã đơn hàng_ khóa học tại timviec365.com";
                for (var i = 0; i < $(".v_border_bank").length; i++) {
                    if (i == n - 1) {
                        $(".v_border_bank").eq(i).css('display', 'block');
                    }else{
                        $(".v_border_bank").eq(i).css('display', 'none');
                    }
                }
                break;

            case 3:
                document.getElementById("v_name-bank").innerText = "VIETCOMBANK";
                document.getElementById("v_ten-ngan-hang").innerText =
                    "Ngân hàng TMCP ngoại thương Việt Nam ( Vietcombank )";
                document.getElementById("v_so-tk").innerText = "0301000383905";
                document.getElementById("v_chu-tk").innerText = "DƯƠNG THỊ MINH TUYỂN";
                document.getElementById("v_chi-nhanh").innerText = "Hoàn Kiếm, Hà Nội";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ Tên khóa học_ Mã đơn hàng_ khóa học tại timviec365.com";
                for (var i = 0; i < $(".v_border_bank").length; i++) {
                    if (i == n - 1) {
                        $(".v_border_bank").eq(i).css('display', 'block');
                    }else{
                        $(".v_border_bank").eq(i).css('display', 'none');
                    }
                } 
                break;

            case 4:
                document.getElementById("v_name-bank").innerText = "SACOMBANK";
                document.getElementById("v_ten-ngan-hang").innerText = "Ngân hàng sài gòn thương tín ( Sacombank )";
                document.getElementById("v_so-tk").innerText = "020085965000";
                document.getElementById("v_chu-tk").innerText = "DƯ THỊ NHẠN";
                document.getElementById("v_chi-nhanh").innerText = "ĐỊNH CÔNG, HOÀNG MAI, HÀ NỘI";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ Tên khóa học_ Mã đơn hàng_ khóa học tại timviec365.com";
                for (var i = 0; i < $(".v_border_bank").length; i++) {
                    if (i == n - 1) {
                        $(".v_border_bank").eq(i).css('display', 'block');
                    }else{
                        $(".v_border_bank").eq(i).css('display', 'none');
                    }
                }
                break;

            case 5:
                document.getElementById("v_name-bank").innerText = "ACB";
                document.getElementById("v_ten-ngan-hang").innerText = "Ngân hàng TMCP Á CHÂU ( ACB )";
                document.getElementById("v_so-tk").innerText = "245415299";
                document.getElementById("v_chu-tk").innerText = "DƯƠNG THỊ MINH TUYỂN";
                document.getElementById("v_chi-nhanh").innerText = "HÀ NỘI";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ Tên khóa học_ Mã đơn hàng_ khóa học tại timviec365.com";
                for (var i = 0; i < $(".v_border_bank").length; i++) {
                    if (i == n - 1) {
                        $(".v_border_bank").eq(i).css('display', 'block');
                    }else{
                        $(".v_border_bank").eq(i).css('display', 'none');
                    }
                }
                break;

            case 6:
                document.getElementById("v_name-bank").innerText = "VIB";
                document.getElementById("v_ten-ngan-hang").innerText = "Ngân hàng TMCP Quốc tế Việt Nam ( VIB )";
                document.getElementById("v_so-tk").innerText = "019704060197072";
                document.getElementById("v_chu-tk").innerText = "DƯ THỊ NHẠN";
                document.getElementById("v_chi-nhanh").innerText = "HÀ ĐÔNG, HÀ NỘI";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ Tên khóa học_ Mã đơn hàng_ khóa học tại timviec365.com";
                for (var i = 0; i < $(".v_border_bank").length; i++) {
                    if (i == n - 1) {
                        $(".v_border_bank").eq(i).css('display', 'block');
                    }else{
                        $(".v_border_bank").eq(i).css('display', 'none');
                    }
                }
                break;

            case 7:
                document.getElementById("v_name-bank").innerText = "AGRIBANK";
                document.getElementById("v_ten-ngan-hang").innerText =
                    "Ngân hàng nông nghiệp và phát triển nông thôn Việt Nam ( Agribank )";
                document.getElementById("v_so-tk").innerText = "1300206354722";
                document.getElementById("v_chu-tk").innerText = "DƯƠNG THỊ MINH TUYỂN";
                document.getElementById("v_chi-nhanh").innerText = "THĂNG LONG, HÀ NỘI";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ Tên khóa học_ Mã đơn hàng_ khóa học tại timviec365.com";
                for (var i = 0; i < $(".v_border_bank").length; i++) {
                    if (i == n - 1) {
                        $(".v_border_bank").eq(i).css('display', 'block');
                    }else{
                        $(".v_border_bank").eq(i).css('display', 'none');
                    }
                }
                break;

            case 8:
                document.getElementById("v_name-bank").innerText = "VIETTINBANK";
                document.getElementById("v_ten-ngan-hang").innerText = "Ngân hàng TMCP Công Thương Việt Nam ( Vietinbank )";
                document.getElementById("v_so-tk").innerText = "103867423326";
                document.getElementById("v_chu-tk").innerText = "DƯƠNG THỊ MINH TUYỂN";
                document.getElementById("v_chi-nhanh").innerText = "THANH XUÂN, HÀ NỘI";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ Tên khóa học_ Mã đơn hàng_ khóa học tại timviec365.com";
                for (var i = 0; i < $(".v_border_bank").length; i++) {
                    if (i == n - 1) {
                        $(".v_border_bank").eq(i).css('display', 'block');
                    }else{
                        $(".v_border_bank").eq(i).css('display', 'none');
                    }
                }
                break;

            case 9:
                document.getElementById("v_name-bank").innerText = "MBBANK";
                document.getElementById("v_ten-ngan-hang").innerText = "Ngân hàng TMCP Quân Đội ( MB bank )";
                document.getElementById("v_so-tk").innerText = "0680117278008";
                document.getElementById("v_chu-tk").innerText = "DƯƠNG THỊ MINH TUYỂN";
                document.getElementById("v_chi-nhanh").innerText = "HÀ NỘI";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ Tên khóa học_ Mã đơn hàng_ khóa học tại timviec365.com";
                for (var i = 0; i < $(".v_border_bank").length; i++) {
                    if (i == n - 1) {
                        $(".v_border_bank").eq(i).css('display', 'block');
                    }else{
                        $(".v_border_bank").eq(i).css('display', 'none');
                    }
                }
                break;

            case 10:
                document.getElementById("v_name-bank").innerText = "TPBANK";
                document.getElementById("v_ten-ngan-hang").innerText = "Ngân hàng TMCP Tiên Phong ( TP bank )";
                document.getElementById("v_so-tk").innerText = "01818446301";
                document.getElementById("v_chu-tk").innerText = "DƯƠNG THỊ MINH TUYỂN";
                document.getElementById("v_chi-nhanh").innerText = "THANH XUÂN, HÀ NỘI";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ Tên khóa học_ Mã đơn hàng_ khóa học tại timviec365.com";
                for (var i = 0; i < $(".v_border_bank").length; i++) {
                    if (i == n - 1) {
                        $(".v_border_bank").eq(i).css('display', 'block');
                    }else{
                        $(".v_border_bank").eq(i).css('display', 'none');
                    }
                }
                break;
        }
    }
</script>

</html>