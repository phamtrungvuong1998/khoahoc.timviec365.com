<?php
include '../includes/v_insert_TT.php';

$db_bank = new db_query("SELECT * FROM bank ")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <title>Rút tiền</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <?php
    include '../includes/l_inc_head.php';
    ?>
    <link rel="stylesheet" href="../css/select2.min.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/tt_ruttien.css?v=<?=$version?>">
</head>

<body>
    <div class="l_container">
        <!-- sidebar -->
        <?php
        include '../includes/l_inc_sidebar.php';
        ?>
        <!-- end: sidebar -->
        <div class="l_right">
            <!-- header -->
            <?php
            include '../includes/l_inc_header.php';
            ?>
            <!-- end header -->

            <!-- content -->
            <div class="l_title">
                <hr class="l_hr">
                <div class="l_title_text">RÚT TIỀN</div>
            </div>
            <div id="alert"></div>
            <div class="l_content">
                <form onsubmit="l_validate_submit(); return false;">
                    <div class="l_content_title">RÚT TIỀN</div>
                    <div class="l_flex">
                        <div class="l_sotien">
                            <div class="l_tieude_sotien">
                                Số tiền rút
                            </div>
                            <div class="l_nhap">
                                <input id="l_sotien" type="text" name="l_sotien" class="l_nhap_sotien" placeholder="1.000.000">
                                <div class="l_vnd">VNĐ</div>
                            </div>
                            <p id="l_error1" class="l_error"></p>
                        </div>
                        <div class="l_sotien">
                            <div class="l_tieude_sotien">
                                Tên chủ tài khoản
                            </div>
                            <div class="l_nhap">
                                <input id="l_ten" type="text" name="l_ten" class="l_nhap_sotien1" placeholder="Nguyễn Xuân Hòa">
                            </div>
                            <p id="l_error2" class="l_error"></p>
                        </div>
                    </div>
                    <div class="l_flex">
                        <div class="l_sotien">
                            <div class="l_tieude_sotien">
                                Số tài khoản
                            </div>
                            <div class="l_nhap">
                                <input id="l_stk" type="text" name="l_stk" class="l_nhap_sotien1">
                            </div>
                            <p id="l_error3" class="l_error"></p>
                        </div>
                        <div class="l_sotien">
                            <div class="l_tieude_sotien">
                                Tên ngân hàng
                            </div>
                            <select id="l_select" name="l_nganhang" class="l_nhap">
                                <option id="l_selected" value="" selected>Chọn ngân hàng</option>
                                <?
                                while ($row = mysql_fetch_assoc($db_bank->result)) {
                                ?>
                                    <option value="<? echo $row['bank_id'] ?>"><? echo $row['bank_name'] ?></option>
                                <?
                                }
                                ?>
                            </select>
                            <p id="l_error4" class="l_error"></p>
                        </div>
                    </div class="l_flex">
                    <div class="l_sotien l_clear">
                        <div class="l_tieude_sotien">
                            Chi nhánh ngân hàng
                        </div>
                        <div class="l_nhap">
                            <input type="text" id="l_chinhanh" name="l_chinhanh" class="l_nhap_sotien1">
                        </div>
                        <p id="l_error5" class="l_error"></p>
                    </div>
                    <div class="l_noidung">
                        <div class="l_tieude_sotien">
                            Nội dung chuyển tiền
                        </div>
                        <textarea name="l_noidung" id="l_noidung" cols="30" rows="10" class="l_textarear"></textarea>
                        <p id="l_error6" class="l_error"></p>
                    </div>
                    <div class="l_btn_ruttien">
                        <button onclick="l_validate_submit(); return false;" class="l_button_rt l_xacnhan">XÁC NHẬN RÚT TIỀN</button>
                        <button class="l_button_rt l_huy">HỦY</button>
                    </div>
                </form>
            </div>
            <!-- end content -->
        </div>
    </div>
    <!-- FOOTER -->
    <?php
    include '../includes/h_inc_footer.php';
    ?>
    <!-- END: FOOTER -->

</body>
<script src="../js/l_trungtam.js?v=<?=$version?>"></script>
<script src="../js/select2.min.js?v=<?=$version?>"></script>
<script>
    $(document).ready(function() {
        $('#l_select').select2();
    });
    function validate_str(str){
        str = str.replace(/[^0-9a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ\s]/gi, '');
        str = str.replace(/\s+/g, ' ');
        str = str.trim();
        return str;
    }
    function validate_number(str){
        str = str.replace(/[^0-9\s]/gi, '');
        str = str.replace(/\s+/g, '');
        str = str.trim();
        return str;
    }
    window.onload = function() {
        var l_sotien = document.getElementById("l_sotien");
        var l_ten = document.getElementById("l_ten");
        var l_stk = document.getElementById("l_stk");
        var l_chinhanh = document.getElementById("l_chinhanh");
        var l_noidung = document.getElementById("l_noidung");
        l_sotien.onblur = function() {
            this.value = validate_number(this.value);
        };
        l_ten.onblur = function() {
            this.value = validate_str(this.value);
        };
        l_chinhanh.onblur = function() {
            this.value = validate_str(this.value);
        };
        l_noidung.onblur = function() {
            this.value = validate_str(this.value);
        };
        l_stk.onblur = function() {
            this.value = validate_number(this.value);
        };
    };

    function l_validate() {
        var flag = false;
        var l_sotien = document.getElementById("l_sotien").value;
        var l_ten = document.getElementById("l_ten").value;
        var l_stk = document.getElementById("l_stk").value;
        var l_select = document.getElementById("l_select").value;
        var l_chinhanh = document.getElementById("l_chinhanh").value;
        var l_noidung = document.getElementById("l_noidung").value;

        if (l_sotien == '') {
            document.getElementById("l_error1").style.display = "block";
            document.getElementById("l_error1").innerHTML = "Bạn chưa nhập số tiền";
            document.getElementById("l_sotien").focus();
            return false;
        } else if (isNaN(l_sotien)) {
            document.getElementById("l_error1").style.display = "block";
            document.getElementById("l_error1").innerHTML = "Bạn phải nhập số";
            document.getElementById("l_sotien").focus();
            return false;
        } else {
            document.getElementById("l_error1").style.display = "none";
            flag = true;
        }

        if (l_ten == '') {
            document.getElementById("l_error2").style.display = "block";
            document.getElementById("l_error2").innerHTML = "Bạn chưa nhập tên";
            document.getElementById("l_ten").focus();
            return false;
        } else {
            document.getElementById("l_error2").style.display = "none";
            flag = true;
        }

        if (l_stk == '') {
            document.getElementById("l_error3").style.display = "block";
            document.getElementById("l_error3").innerHTML = "Bạn chưa nhập số tài khoản";
            document.getElementById("l_stk").focus();
            return false;
        } else if (isNaN(l_stk)) {
            document.getElementById("l_error3").style.display = "block";
            document.getElementById("l_error3").innerHTML = "Bạn phải nhập số";
            document.getElementById("l_stk").focus();
            return false;
        } else {
            document.getElementById("l_error3").style.display = "none";
            flag = true;
        }

        if (l_select == '') {
            document.getElementById("l_error4").style.display = "block";
            document.getElementById("l_error4").innerHTML = "Bạn chưa chọn ngân hàng";
            document.getElementById("l_select").focus();
            return false;
        } else {
            document.getElementById("l_error4").style.display = "none";
            flag = true;
        }

        if (l_chinhanh == '') {
            document.getElementById("l_error5").style.display = "block";
            document.getElementById("l_error5").innerHTML = "Bạn nhập chi nhánh ngân hàng";
            document.getElementById("l_chinhanh").focus();
            return false;
        } else {
            document.getElementById("l_error5").style.display = "none";
            flag = true;
        }

        if (l_noidung == '') {
            document.getElementById("l_error6").style.display = "block";
            document.getElementById("l_error6").innerHTML = "Bạn chưa nhập nội dung";
            document.getElementById("l_noidung").focus();
            return false;
        } else {
            document.getElementById("l_error6").style.display = "none";
            flag = true;
        }
        return flag;
    }

    function l_validate_submit() {
        var flag = l_validate();
        if (flag == true) {
            var l_sotien = document.getElementById("l_sotien").value;
            var l_ten = document.getElementById("l_ten").value;
            var l_stk = document.getElementById("l_stk").value;
            var l_select = document.getElementById("l_select").value;
            var l_chinhanh = document.getElementById("l_chinhanh").value;
            var l_noidung = document.getElementById("l_noidung").value;
            var data = new FormData();
            data.append('l_sotien',l_sotien);
            data.append('l_ten',l_ten);
            data.append('l_stk',l_stk);
            data.append('l_select',l_select);
            data.append('l_chinhanh',l_chinhanh);
            data.append('l_noidung',l_noidung);
            $.ajax({
                url: '../ajax/l_ajax_ruttien.php',
                type: 'post',
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.result == 0) {
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                $(".alert-success").remove();
                            });
                        }, 3000);
                        document.getElementById("l_sotien").value = '';
                        document.getElementById("l_ten").value = '';
                        document.getElementById("l_stk").value = '';
                        document.getElementById("l_selected").selected = true;
                        $('#l_selected').val("").change();
                        document.getElementById("l_chinhanh").value = '';
                        document.getElementById("l_noidung").value = '';
                        $(".l_menu_many").text(response.total);
                    }else if (response.result == 1) {
                        alert(response.message);
                        // window.location.href = "tt_dsgiangvien.php";
                    }
                },
            });
        }
    }

    
</script>

</html>