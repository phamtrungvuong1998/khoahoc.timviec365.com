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
    <link rel="stylesheet" href="../css/GV-page-tao-ma-giam-gia.css?v=<?=$version?>">
    <script src="../js//v-main.js?v=<?=$version?>"></script>
    <style>
    #v_ma-giam-gia {
        color: #1B6AAB;
    }
    #v_content-box-title{
        padding-top: 
    }
    #v_sidebar-tb-4 {
        display: block;
    }
    #v_gv_magiamgia3 button{
        color: #1B6AAB;
    }
    #v_sidebar_tb-4{
        display: block;
    }
    #v_sidebar_tb-4 li:nth-child(1) a{
        color: #1B6AAB;
    }
    #v_kh-online {
        color: #1B6AAB;
    }
    #v_tao-ma-gg {
        color: #1B6AAB;
    }

    .v_monhoc {
        font-weight: 700;
        font-size: 14px;
        color: rgba(0, 0, 0, 0.87);
    }

    .v_trungtam-1 {
        display: none;
    }

    @media (max-width: 1365px) {
        .v_trungtam {
            display: none;
        }

        .v_trungtam-1 {
            position: relative;
            display: block;
            background-color: white;
        }

      /*  ul {
            position: absolute;
            background: rgba(255, 255, 255, 1);
            box-shadow: 0px 8px 10px rgba(0, 0, 0, 0.14), 0px 3px 14px rgba(0, 0, 0, 0.12), 0px 5px 5px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }*/

        .v_email {
            text-align: left;
            color: #1B6AAB;
        }

        .v_name {
            font-weight: 500;
            color: #000000CC;
        }

    }
    </style>
    <title>Tạo mã giảm giá</title>
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
            <div id="content-box">
                <div id="v_content-box-hr">
                    <hr>
                </div>
                <h2 id="v_content-box-title">TẠO MÃ GIẢM GIÁ MỚI</h2>
                <form method="POST" onsubmit="return validation()" name="validation_code">
                    <div id="v_content">
                        <div class="v_content-title">
                            <img class="lazyload" src="/img/load.gif" data-src="../img/giam-gia-title.svg"
                                alt="Ảnh lỗi">
                            <span class="v_content-title-span">thông tin cơ bản</span>
                        </div>
                        <div class="v_content-input">
                            <label class="v_content-label"><b>Tên mã giảm giá</b></label>
                            <div>
                                <button id="v_tvkh">TVKH</button><input name="code_name" id="code_name" maxlength="5" type="text">
                            </div>
                            <p id="v_tvkh-note">vui lòng chỉ nhập các kí tự chữ cái ( A - Z) , số từ ( 0- 9), tối đa 5 kí tự . Mã giảm giá đầy đủ : TVKN</p>
                        </div>

                        <div class="v_content-input-2">
                            <div class="v_content-input-2-1">
                                <label class="v_content-label"><b>Từ ngày</b></label>
                                <div><input name="date_start" id="date_start" type="date"></div>
                            </div>
                            <div class="v_content-input-2-1">
                                <label class="v_content-label"><b>Đến ngày</b></label>
                                <div><input name="date_end" id="date_end" type="date"></div>
                            </div>
                        </div>

                        <div class="v_content-title">
                            <img class="lazyload" src="/img/load.gif" data-src="../img/giam-gia-title.svg"
                                alt="Ảnh lỗi">
                            <span class="v_content-title-span">thiết lập mã giảm giá</span>
                            <div class="v_content-input-3 v_sl_code">
                                <div class="v_content-input-3-1">
                                    <label class="v_content-label"><b>Số tiền có thể giảm</b></label>
                                    <div><input name="discount_money" id="discount_money" type="text"></div>
                                </div>
                                <div class="v_content-input-3-1">
                                    <label class="v_content-label"><b>giá trị khóa học tối thiểu</b></label>
                                    <div><input name="course_value" id="course_value" type="text"></div>
                                    <p id="v_content-3-p"><span id="v_content-3-1-note">*</span> Mức giảm giá không được
                                        lớn hơn giá trị đơn hàng tối thiểu</p>
                                </div>
                            </div>
                        </div>

                        <div class="v_content-input-3">
                            <div class="v_content-input-3-1">
                                <label class="v_content-label"><b>Số lượng mã giảm giá</b></label>
                                <div><input name="quantity" id="quantity" type="text" placeholder="Vd : 50"></div>
                            </div>
                            <div>
                                <label class="v_content-label"><b>Hiển thị mã giảm giá</b></label>
                                <div class="v_input-4">
                                    <input name="show_code" type="radio" class="v_content-3-radio" value="1"><span
                                        class="v_check-text">Có</span>
                                    <input name="show_code" type="radio" class="v_content-3-radio" value="2"><span
                                        class="v_check-text">Không</span>
                                </div>
                            </div>
                        </div>

                        <div id="v_content-btn">
                            <button name="btn_cre" id="v_create-mgg">TẠO MÃ GIẢM GIÁ</button>
                            <!-- <button id="v_cancel" type="button">HỦY BỎ</button> -->
                        </div>
                    </div>
                </form>
            </div>
            <!-- End: content -->

        </div>
        <!-- End: main -->
    </div>
    </div>

    <!-- Begin: foooter -->
    <?php require_once("../includes/h_inc_footer.php"); ?>
    <!-- End: footer -->
    <script src="../js/bootstrap.min.js?v=<?=$version?>"></script>
    <script src="../js/v-main.js?v=<?=$version?>"></script>
    <script>
    function validation() {
        var reName = /^[A-Z0-9]{1,}$/;
        var code_name = $('#code_name').val();
        var date_start = $('#date_start').val();
        var date_end = $('#date_end').val();
        var discount_money = $('#discount_money').val();
        var course_value = $('#course_value').val();
        var quantity = $('#quantity').val();

        if (code_name == '') {
            alert('Vui lòng nhập tên mã giảm giá');
            $('#code_name').focus();
            return false;
        }else if (reName.test(code_name) == false){
            alert('Sai định dạng mã giảm giá');
            $('#code_name').focus();
            return false;
        }
        if (date_start == 0) {
            alert('Vui lòng chọn ngày bắt đầu');
            $('#date_start').focus();
            return false;
        }
        if (date_end == '') {
            alert('Vui lòng chọn ngày hết hạn');
            $('#date_end').focus();
            return false;
        }
        if (date_start >= date_end) {
            alert('Thời gian hết hạn phải lớn hơn thời gian bắt đầu');
            $('#date_start').focus();
            return false;
        }
        if (discount_money == '') {
            alert('Vui lòng nhập số tiền giảm');
            $('#discount_money').focus();
            return false;
        }else{
            discount_money = Number($('#discount_money').val());
        }

        if (course_value == '') {
            alert('Vui lòng nhập mức giảm');
            $('#course_value').focus();
            return false;
        }else{
            course_value = Number($('#course_value').val());
        }

        if (quantity == '') {
            alert('Vui lòng nhập số lượng');
            $('#quantity').focus();
            return false;
        }else if(Number($('#quantity').val()) == 0){
            alert('Số lượng mã giảm giá tối thiểu là 1');
            $('#quantity').focus();
            return false;
        }

        if ($(".v_content-3-radio")[0].checked == false && $(".v_content-3-radio")[1].checked == false) {
            alert('Bạn có muốn hiển thị mã giảm giá không ?');
            $('.v_content-3-radio').eq(0).focus();
            return false;
        }

        var show_code = document.validation_code.show_code.value;
        $.ajax({
            url: '../ajax/GV_tao_ma_giam_gia.php',
            type: 'POST',
            dataType: 'json',
            data: {
                code_name: code_name,
                date_start: date_start,
                date_end: date_end,
                discount_money: discount_money,
                course_value: course_value,
                quantity: quantity,
                show_code: show_code,
                submit: 1
            },
            success: function (data) {
                if (data.type == 0) {
                    alert("Mã giảm giá đã tồn tại");
                }else{
                    alert("Tạo mã giảm giá thành công");
                    window.location.href = "/giang-vien-quan-li-ma-giam-gia/id"+data.user_id+"-p1.html";
                }
            },
            error: function () {
                alert("Có lỗi xảy ra. Vui lòng thử lại");
            }
        });
        
        return false;
    }
    </script>
</body>

</html>