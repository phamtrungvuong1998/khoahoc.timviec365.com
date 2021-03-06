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
    <title>N???p ti???n</title>
</head>

<body>
    <center id="v_alert-rechange">
        <form id="v_alert-content" onsubmit="return v_alert();">
            <h2 id="v_alert-title">TH??NG B??O N???P TI???N</h2>
            <div id="v_alert-detail">
                <div class="v_alert-detail-1">
                    <label for="">Ng??n h??ng nh???n ti???n</label>
                    <select name="bank_get" id="bank_get">
                        <option value="0">--Ch???n ng??n h??ng--</option>
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
                    <label for="">S??? ti???n n???p</label>
                    <input type="text" id="v_amount" placeholder="1.000.000" name="amount">
                    <button class="v_d">VN??</button>
                    <p id="v_bank_validate-2"></p>
                </div>
                <div class="v_alert-detail-1">
                    <label for="">H??nh th???c chuy???n ti???n</label>
                    <select name="" id="v_form_recharge">
                        <option value="0">--Ch???n h??nh th???c chuy???n ti???n--</option>
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
                    <label for="">Ng??n h??ng chuy???n ti???n</label>
                    <select name="bank_set" id="bank_set">
                        <option value="0">--Ch???n ng??n h??ng--</option>
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
                    <label for="">T??n ng?????i chuy???n ti???n</label>
                    <input type="text" name="name_recharge" placeholder="Nguy???n Xu??n H??a" id="name_recharge">
                    <p id="v_bank_validate-5"></p>
                </div>
                <div class="v_alert-detail-1">
                    <label for="">S??? t??i kho???n chuy???n ti???n</label>
                    <input type="text" name="bank_account" id="bank_account">
                    <p id="v_bank_validate-6"></p>
                </div>
                <div class="v_alert-detail-1">
                    <label for="">Th???i gian chuy???n ti???n</label>
                    <input type="date" id="time_recharge" name="time_rechange">
                    <p id="v_bank_validate-7"></p>
                </div>
                <div class="v_alert-detail-1">
                    <label for="">N???i dung chuy???n ti???n</label>
                    <input type="text" id="content_rechange" name="content_rechange">
                    <p id="v_bank_validate-8"></p>
                </div>
                <div id="v_alert-div-btn">
                    <button class="v_alert-btn1">G???I TH??NG B??O</button>
                    <div class="v_alert-btn" style="cursor: pointer; padding-top: 6px;">H???Y</div>
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
                <div id="v_title">TH??NG TIN T??I KHO???N</div>
                <div id="v_bank">
                    <center>
                        <div id="v_bank-detail">
                            <h2 id="v_bank-detail-title">TH??NG TIN T??I KHO???N &nbsp;<span id="v_name-bank"></span></h2>

                            <p class="v_bank-detail-info">T??n ng??n h??ng : &nbsp;<span id="v_ten-ngan-hang"></span></p>

                            <p class="v_bank-detail-info">S??? t??i kho???n : &nbsp;<span id="v_so-tk"></span></p>
                            <p class="v_bank-detail-info">Ch??? t??i kho???n : &nbsp;<span id="v_chu-tk"></span></p>
                            <p class="v_bank-detail-info">Chi nh??nh : &nbsp;<span id="v_chi-nhanh"></span></p>
                            <p class="v_bank-detail-info">N???i dung chuy???n kho???n : &nbsp;<span id="v_noi-dung"></span>
                            </p>
                        </div>
                    </center>
                    <center id="v_bank-1">
                        <button onclick="v_bank(1)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/techcombank.png" alt="???nh l???i">
                        <div class="v_border_bank"></div>
                        </button>
                        <button onclick="v_bank(2)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/bidv2.png" alt="???nh l???i">
                        <div class="v_border_bank"></div></button>
                        <button onclick="v_bank(3)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/vietcombank.png" alt="???nh l???i">
                        <div class="v_border_bank"></div></button>
                        <button onclick="v_bank(4)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/sacombank.png" alt="???nh l???i">
                        <div class="v_border_bank"></div></button>
                    </center>
                    <center id="v_bank-2">
                        <button onclick="v_bank(5)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/acb.png" alt="???nh l???i">
                        <div class="v_border_bank"></div></button>
                        <button onclick="v_bank(6)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/vib.png" alt="???nh l???i">
                        <div class="v_border_bank"></div></button>
                        <button onclick="v_bank(7)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/agribank.png" alt="???nh l???i">
                        <div class="v_border_bank"></div></button>
                        <button onclick="v_bank(8)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/viettinbank.png" alt="???nh l???i">
                        <div class="v_border_bank"></div></button>
                    </center>
                    <center id="v_bank-3">
                        <button onclick="v_bank(9)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/mbbank.png" alt="???nh l???i">
                        <div class="v_border_bank"></div></button>
                        <button onclick="v_bank(10)" class="v_bank3"><img class="lazyload v_bank2" src="/img/load.gif" data-src="../img/tpbank.png" alt="???nh l???i">
                            <div class="v_border_bank"></div></button>
                    </center>
                </div>

                <div id="v_danger">
                    <div id="v_danger-1">L??U ?? : KHI CHUY???N KHO???N VUI L??NG GHI ????NG N???I DUNG</div>
                    <div id="v_danger-2">SAU KHI CHUY???N TI???N TH??NH C??NG QU?? KH??CH VUI L??NG G???I TH??NG B??O CHUY???N TI???N CHO
                        H??? TH???NG THEO M???T TRONG C??C C??CH SAU</div>
                </div>

                <div id="v_content-contact">
                    <div class="v_content-contact-div">
                        <div class="v_content-contact-1" style="cursor: pointer;">
                            <p class="v_content-contact-img"><img class="lazyload" src="/img/load.gif" data-src="../img/simple-icons_minutemailer (1).svg" alt="???nh l???i"></p>
                            <p class="v_content-contact-text">G???i th??ng b??o n???p ti???n</p>
                        </div>
                    </div>
                    <div class="v_content-contact-div">
                        <div class="v_content-contact-1">
                            <p class="v_content-contact-img"><img class="lazyload" src="/img/load.gif" data-src="../img/ion_chatbox-ellipses.svg"></p>
                            <p class="v_content-contact-text"><a href="">Th??ng b??o tr??n chatbox</a></p>
                        </div>
                    </div>
                    <div class="v_content-contact-div">
                        <div class="v_content-contact-1">
                            <p class="v_content-contact-img"><img class="lazyload" src="/img/load.gif" data-src="../img/logos_skype.svg" alt="???nh l???i"></p>
                            <p class="v_content-contact-text"><a href="">Th??ng b??o qua skype</a></p>
                        </div>
                    </div>
                    <div class="content-contact-div">
                        <div class="v_content-contact-1">
                            <p class="v_content-contact-img"><img class="lazyload" src="/img/load.gif" data-src="../img/entypo_old-phone.svg" alt="???nh l???i"></p>
                            <p class="v_content-contact-text"><a href="">Th??ng b??o qua Hotline</a></p>
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
            $("#v_bank_validate-1").text("Vui l??ng ch???n ng??n h??ng nh???n ti???n");
            $(".v_d").css('bottom', '57px');
            return false;
        }else{
            $(".v_d").css('bottom', '35px');
            $("#v_bank_validate-1").text("");
        }

        if ($("#v_amount").val() == "") {
            $(".v_d").css('bottom', '57px');
            $("#v_bank_validate-2").text("Vui l??ng nh???p s??? ti???n");
            return false;
        } else if (isNaN($("#v_amount").val())) {
            $(".v_d").css('bottom', '57px');
            $("#v_bank_validate-2").text("s??? ti???n ph???i l?? s???");
            return false;
        }else if(Number($("#v_amount").val()) == 0){
            $(".v_d").css('bottom', '57px');
            $("#v_bank_validate-2").text("s??? ti???n ph???i l???n h??n 0");
            return false;
        }else{
            $(".v_d").css('bottom', '35px');
            $("#v_bank_validate-2").text("");
        }

        if ($("#v_form_recharge").val() == 0) {
            $("#v_bank_validate-3").text("Vui l??ng ch???n h??nh th???c chuy???n ti???n");
            return false;
        }else{
            $("#v_bank_validate-3").text("");
        }

        if ($("#bank_set").val() == 0) {
            $("#v_bank_validate-4").text("Vui l??ng ch???n ng??n h??ng chuy???n ti???n");
            return false;
        }else{
            $("#v_bank_validate-4").text("");
        }

        if ($("#name_recharge").val() == "") {
            $("#v_bank_validate-5").text("Vui l??ng ??i???n t??n ng?????i chuy???n ti???n");
            return false;
        }else{
            $("#v_bank_validate-5").text("");
        }

        if ($("#bank_account").val() == "") {
            $("#v_bank_validate-6").text("Vui l??ng ??i???n s??? t??i kho???n chuy???n ti???n");
            return false;
        }else{
            $("#v_bank_validate-6").text("");
        }

        if ($("#time_recharge").val() == "") {
            $("#v_bank_validate-7").text("Vui l??ng ch???n th???i gian chuy???n ti???n");
            return false;
        }else{
            $("#v_bank_validate-7").text("");
        }

        if ($("#content_rechange").val() == "") {
            $("#v_bank_validate-8").text("Vui l??ng ??i???n n???i dung chuy???n ti???n");
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
            alert("G???i th??ng b??o n???p ti???n th??nh c??ng. Vui l??ng ch??? ph???n h???i");
        });

        return false;
    }

    function v_bank(n) {
        switch (n) {
            case 1:
                document.getElementById("v_name-bank").innerText = "TECHCOMBANK";
                document.getElementById("v_ten-ngan-hang").innerText = "Ng??n h??ng TMCP k??? th????ng Vi???t Nam ( Techcombank )";
                document.getElementById("v_so-tk").innerText = "19031707022012";
                document.getElementById("v_chu-tk").innerText = "D????NG TH??? MINH TUY???N";
                document.getElementById("v_chi-nhanh").innerText = "?????ng ??a, H?? N???i";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ T??n kh??a h???c_ M?? ????n h??ng_ kh??a h???c t???i timviec365.com";
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
                document.getElementById("v_ten-ngan-hang").innerText = "Ng??n h??ng ?????u t?? v?? ph??t tri???n Vi???t Nam ( BIDV )";
                document.getElementById("v_so-tk").innerText = "21610000462781";
                document.getElementById("v_chu-tk").innerText = "D????NG TH??? MINH TUY???N";
                document.getElementById("v_chi-nhanh").innerText = "H?? N???i";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ T??n kh??a h???c_ M?? ????n h??ng_ kh??a h???c t???i timviec365.com";
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
                    "Ng??n h??ng TMCP ngo???i th????ng Vi???t Nam ( Vietcombank )";
                document.getElementById("v_so-tk").innerText = "0301000383905";
                document.getElementById("v_chu-tk").innerText = "D????NG TH??? MINH TUY???N";
                document.getElementById("v_chi-nhanh").innerText = "Ho??n Ki???m, H?? N???i";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ T??n kh??a h???c_ M?? ????n h??ng_ kh??a h???c t???i timviec365.com";
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
                document.getElementById("v_ten-ngan-hang").innerText = "Ng??n h??ng s??i g??n th????ng t??n ( Sacombank )";
                document.getElementById("v_so-tk").innerText = "020085965000";
                document.getElementById("v_chu-tk").innerText = "D?? TH??? NH???N";
                document.getElementById("v_chi-nhanh").innerText = "?????NH C??NG, HO??NG MAI, H?? N???I";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ T??n kh??a h???c_ M?? ????n h??ng_ kh??a h???c t???i timviec365.com";
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
                document.getElementById("v_ten-ngan-hang").innerText = "Ng??n h??ng TMCP ?? CH??U ( ACB )";
                document.getElementById("v_so-tk").innerText = "245415299";
                document.getElementById("v_chu-tk").innerText = "D????NG TH??? MINH TUY???N";
                document.getElementById("v_chi-nhanh").innerText = "H?? N???I";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ T??n kh??a h???c_ M?? ????n h??ng_ kh??a h???c t???i timviec365.com";
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
                document.getElementById("v_ten-ngan-hang").innerText = "Ng??n h??ng TMCP Qu???c t??? Vi???t Nam ( VIB )";
                document.getElementById("v_so-tk").innerText = "019704060197072";
                document.getElementById("v_chu-tk").innerText = "D?? TH??? NH???N";
                document.getElementById("v_chi-nhanh").innerText = "H?? ????NG, H?? N???I";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ T??n kh??a h???c_ M?? ????n h??ng_ kh??a h???c t???i timviec365.com";
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
                    "Ng??n h??ng n??ng nghi???p v?? ph??t tri???n n??ng th??n Vi???t Nam ( Agribank )";
                document.getElementById("v_so-tk").innerText = "1300206354722";
                document.getElementById("v_chu-tk").innerText = "D????NG TH??? MINH TUY???N";
                document.getElementById("v_chi-nhanh").innerText = "TH??NG LONG, H?? N???I";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ T??n kh??a h???c_ M?? ????n h??ng_ kh??a h???c t???i timviec365.com";
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
                document.getElementById("v_ten-ngan-hang").innerText = "Ng??n h??ng TMCP C??ng Th????ng Vi???t Nam ( Vietinbank )";
                document.getElementById("v_so-tk").innerText = "103867423326";
                document.getElementById("v_chu-tk").innerText = "D????NG TH??? MINH TUY???N";
                document.getElementById("v_chi-nhanh").innerText = "THANH XU??N, H?? N???I";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ T??n kh??a h???c_ M?? ????n h??ng_ kh??a h???c t???i timviec365.com";
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
                document.getElementById("v_ten-ngan-hang").innerText = "Ng??n h??ng TMCP Qu??n ?????i ( MB bank )";
                document.getElementById("v_so-tk").innerText = "0680117278008";
                document.getElementById("v_chu-tk").innerText = "D????NG TH??? MINH TUY???N";
                document.getElementById("v_chi-nhanh").innerText = "H?? N???I";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ T??n kh??a h???c_ M?? ????n h??ng_ kh??a h???c t???i timviec365.com";
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
                document.getElementById("v_ten-ngan-hang").innerText = "Ng??n h??ng TMCP Ti??n Phong ( TP bank )";
                document.getElementById("v_so-tk").innerText = "01818446301";
                document.getElementById("v_chu-tk").innerText = "D????NG TH??? MINH TUY???N";
                document.getElementById("v_chi-nhanh").innerText = "THANH XU??N, H?? N???I";
                document.getElementById("v_noi-dung").innerText =
                    "Email_ T??n kh??a h???c_ M?? ????n h??ng_ kh??a h???c t???i timviec365.com";
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