<?php
require_once '../code_xu_ly/h_manager_GV.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <?php require_once '../includes/v_inc_GV_css.php'; ?>
    <link rel="stylesheet" href="../css/GV-page-rut-tien.css?v=<?=$version?>">
    <script src="../js//v-main.js?v=<?=$version?>"></script>
    <style>
    #v_vi-kh {
        color: #1B6AAB;
    }

    #v_sidebar-tb-3 {
        display: block;
    }

    #v_rut-tien {
        color: #1B6AAB;
    }
    #v_btn-sucess{
        background: #1B6AAB;
        color: white;
    }
    #v_number5{
        position: relative;
    }
    #v_donvi{
        height: 18px;
        padding-left: 16px;
        border-left: 1px solid #0000001F;
        position: absolute;
        right: 10px;
        font-size: 14px;
        top: 11px;
        color: #00000061;
    }
    </style>
    <title>Rút tiền</title>
</head>

<body>
    <div id="v_wrapper" class="flex">
        <!-- Begin: sidebar -->
        <?php require_once("../includes/inc_GV_sidebar.php"); ?>
        <!-- End: sidebar -->

        <!-- Begin: main -->
        <div id="main">
            <!-- Begin: header -->
            <?php require_once '../includes/inc_GV_manager_header.php'; ?>
            <!-- End: header -->

            <!-- Begin: content -->
            <div id="v_content-box">
                <div id="v_content-hr">
                    <hr>
                </div>
                <div id="v_content-title">RÚT TIỀN</div>
                <div id="v_content">
                    <div id="v_title">RÚT TIỀN</div>
                    <form method="POST" enctype="multipart/form-data" onsubmit="return validation();">
                        <div id="v_content-detail">
                            <div class="v_content-detail-1">
                                <label>Số tiền rút</label>
                                <div id="v_number5">
                                    <input type="text" placeholder="1.000.000 đ" onkeypress="isnumber(event)" id="withdrawal_amount" name="withdrawal_amount">
                                    <p id="v_donvi">VNĐ</p>
                                </div>
                            </div>
                            <div class="v_content-detail-1">
                                <label>Tên chủ tài khoản</label>
                                <div><input type="text" id="transaction_name" placeholder="Nguyễn Xuân Hòa" name="transaction_name"></div>
                            </div>
                            <div class="v_content-detail-1">
                                <label>Số tài khoản</label>
                                <div><input type="text" id="acc_number" name="acc_number"></div>
                            </div>
                            <div class="v_content-detail-1">
                                <label>Tên ngân hàng</label>
                                <div>
                                    <select id="bank_id" name="bank_id">
                                        <option value="0">Chọn ngân hàng</option>
                                        <?
                                            $dbb = new db_query("SELECT * FROM bank");
                                            while ($rowb = mysql_fetch_array($dbb->result)) {
                                                ?>
                                        <option value="<?=$rowb['bank_id']?>"><?=$rowb['bank_name']?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="v_content-detail-2">
                                <label>Chi nhánh ngân hàng</label>
                                <div><input type="text" id="bank_branch" name="bank_branch"></div>
                            </div>
                            <div class="v_content-detail-2">
                                <label>Nội dung chuyển tiền</label>
                                <div>
                                    <textarea id="transaction_content" name="transaction_content"></textarea>
                                </div>

                                <center id="v_content-btn">
                                    <button class="v_content-btn-1" name="btn" id="v_btn-sucess">XÁC NHẬN RÚT
                                        TIỀN</button>
                                    <button class="v_content-btn-1" id="v_btn-del">HỦY</button>
                                </center>
                            </div>
                    </form>
                </div>

            </div>
            <!-- End: content -->
        </div>
    </div>
    <!-- End: main -->
    </div>

    <!-- Begin: foooter -->
    <?php require_once("../includes/h_inc_footer.php"); ?>
    <!-- End: footer -->
    <script src="../js/bootstrap.min.js?v=<?=$version?>"></script>
    <script src="../js/v-main.js?v=<?=$version?>"></script>
    <script>
    function isnumber(evt) {
        var num = String.fromCharCode(evt.which);
        if (!(/[0-9]/.test(num))) {
            evt.preventDefault();
        }
    }
    function validation() {
        var withdrawal_amount = $('#withdrawal_amount').val();
        var wa = Number($('#withdrawal_amount').val());
        var transaction_name = $('#transaction_name').val();
        var bank_id = $("#bank_id").val();
        var acc_number = $('#acc_number').val();
        var bank_branch = $('#bank_branch').val();
        var transaction_content = $('#transaction_content').val();
        if (withdrawal_amount == '') {
            alert('Vui lòng nhập số tiền cần rút');
            $('#withdrawal_amount').focus();
            return false;
        }else if(wa == 0){
            alert('Số tiền rút phải lớn hơn 0');
            $('#withdrawal_amount').focus();
            return false;
        }else if (bank_id == 0) {
            alert('Vui lòng chọn Ngân hàng');
            $('#bank_id').focus();
            return false;
        }else if (acc_number == '') {
            alert('Vui lòng nhập số tài khoản');
            $('#acc_number').focus();
            return false;
        }else if (transaction_name == '') {
            alert('Vui lòng nhập số tiền giảm');
            $('#transaction_name').focus();
            return false;
        }else if (transaction_content == '') {
            alert('Vui lòng nhập tên chủ tài khoản');
            $('#transaction_content').focus();
            return false;
        }else if (bank_branch == '') {
            alert('Vui lòng nhập chi nhánh ngân hàng');
            $('#bank_branch').focus();
            return false;
        }else{
            $.ajax({
                url: '../ajax/v_gv_rut_tien.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    withdrawal_amount : wa,
                    transaction_name: transaction_name,
                    acc_number: acc_number,
                    transaction_content: transaction_content,
                    bank_branch: bank_branch,
                    bank_id: bank_id
                },
                success: function (data) {
                    if (data.type == 1) {
                        alert("Thông báo rút tiền đã được gửi. Vui lòng đợi phản hồi");
                    }else if (data.type == 0){
                        alert("Số dư của bạn không đủ để rút tiền");
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại");
                }
            });
            
        }

        return false;
    }
    </script>
</body>

</html>