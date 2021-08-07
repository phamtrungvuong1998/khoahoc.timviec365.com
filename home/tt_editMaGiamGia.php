<?

include '../includes/v_insert_TT.php';
$discount_id = getValue('ma', 'int', 'get', 0, 0);
$db_getdis = new db_query("SELECT * FROM discount_code WHERE user_id ='$user_id' AND code_id= '$discount_id'");
$rowCode = mysql_fetch_assoc($db_getdis->result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <title>Tạo mã giảm giá</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <?php
    include '../includes/l_inc_head.php';
    ?>
    <link rel="stylesheet" href="../css/tt_magiamgia.css">
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
                <div class="l_title_text">SỬA MÃ GIẢM GIÁ</div>
            </div>
            <div id="alert"></div>
            <div class="l_content">
                <form onsubmit="l_validate_submit(); return false;" name="l_form" enctype="multipart/form-data">
                    <div class="l_content_item1">
                        <div class="l_item1"></div>
                        <div class="l_item1_text">Thông Tin Cơ Bản</div>
                    </div>
                    <div class="l_magiamgia">
                        <div class="l_tenmagiamgia">
                            Tên Mã Giảm Giá
                        </div>
                        <div class="l_nhapmagiamgia">
                            <div class="l_TVKH">TVKH</div>
                            <div class="l_input">
                                <input type="hidden" name="l_code_id" id="l_code_id" value="<? echo $discount_id ?>">
                                <input readonly value="<? echo $rowCode['code_name']; ?>" type="text" id="l_code_name" name="l_code_name" class="l_input_text">
                            </div>

                        </div>
                        <p id="l_error1" class="l_sao"></p>
                        <div class="l_chuthich">
                            vui lòng chỉ nhập các kí tự chữ cái ( A - Z) , số từ ( 0- 9), tối đa 5 kí tự. Mã giảm giá đầy đủ
                            : TVKN
                        </div>
                        <div class="l_date">
                            <div class="l_date_item">
                                <div class="l_date_text">Từ ngày</div>
                                <input value="<? echo $rowCode['date_start']; ?>" type="date" id="l_date_start" name="l_date_start" class=l_inputdate>
                                <p id="l_error2" class="l_sao"></p>
                            </div>
                            <div class="l_date_item">
                                <div class="l_date_text">Đến ngày</div>
                                <input value="<? echo $rowCode['date_end']; ?>" type="date" id="l_date_end" name="l_date_end" class="l_inputdate">
                                <p id="l_error3" class="l_sao"></p>
                            </div>
                        </div>
                    </div>
                    <div class="l_content_item1">
                        <div class="l_item1"></div>
                        <div class="l_item1_text">Thiết Lập Mã Giảm Giá</div>
                    </div>
                    <div class="l_thietlap">
                        <div class="l_sotien">
                            <div class="l_sotien_tieude">Số tiền có thể giảm</div>
                            <input value="<? echo $rowCode['discount_money']; ?>" type="text" id="l_discount_money" name="l_discount_money" class="l_nhapsotien">
                            <p id="l_error4" class="l_sao"></p>
                        </div>
                        <div class="l_sotien">
                            <div class="l_sotien_tieude">Giá trị khóa học tối thiểu</div>
                            <input value="<? echo $rowCode['course_value']; ?>" type="text" id="l_course" name="l_course" class="l_nhapsotien">
                            <p id="l_error5" class="l_sao"></p>
                            <div class="l_chuthich">
                                <span id="" class="l_sao">*</span> Mức giảm giá không được lớn hơn giá trị đơn hàng tối thiểu
                            </div>
                        </div>
                        <div class="l_sotien">
                            <div class="l_sotien_tieude">Số Lượng Mã Giảm Giá</div>
                            <input value="<? echo $rowCode['quantity']; ?>" type="text" id="l_quantity" name="l_quantity" class="l_nhapsotien" placeholder="vd: 50">
                            <p id="l_error6" class="l_sao"></p>
                        </div>
                        <div class="l_htmagiamgia">
                            <div class="l_sotien_tieude">Hiện Thị Mã Giảm Giá</div>
                            <div class="l_flex">
                                <div class="l_margin">
                                    <input <?
                                            if ($rowCode['show_code'] == 1) {
                                                echo "checked";
                                            }
                                            ?> type="radio" name="l_show" id="radio1" value="1" name="radio">
                                    <label for="radio1">Có</label>
                                </div>
                                <div>
                                    <input <?
                                            if ($rowCode['show_code'] == 0) {
                                                echo "checked";
                                            }
                                            ?> type="radio" name="l_show" value="0" id="radio2" name="radio" class="l_radio">
                                    <label for="radio2">Không</label>
                                </div>
                            </div>
                            <p id="l_error7" class="l_sao"></p>
                        </div>
                    </div>
                    <div class="l_btn_sukien_gg">
                        <button onclick="l_validate_submit(); return false;" type="submit" class="l_btn_sukien_item1">SỬA MÃ GIẢM GIÁ</button>
                        <button class="l_btn_sukien_item2" type="reset">HỦY BỎ</button>
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
    <script src="/js/l_trungtam.js"></script>
</body>
<script>
    function validate_number(str){
        str = str.replace(/[^0-9\s]/gi, '');
        str = str.replace(/\s+/g, '');
        str = str.trim();
        return str;
    }
    window.onload = function() {
        var textBx = document.getElementById("l_code_name");
        var l_discount_money = document.getElementById("l_discount_money");
        var l_course = document.getElementById("l_course");
        var l_quantity = document.getElementById("l_quantity");

        //l_discount_money.value = new Intl.NumberFormat('vi-VN').format(l_discount_money.value);
        //var l_course = document.getElementById("l_course");
        //l_course.value = new Intl.NumberFormat('vi-VN').format(l_course.value);
        textBx.onblur = function() {
            this.value = this.value.toUpperCase();
        };
        
        l_discount_money.onblur = function() {
            this.value = validate_number(this.value);
        };
        l_course.onblur = function() {
            this.value = validate_number(this.value);
        };
        l_quantity.onblur = function() {
            this.value = validate_number(this.value);
        };
    };

    function l_validate() {
        var flag = false;
        var l_code_name = document.getElementById("l_code_name").value;
        var l_date_start = document.getElementById("l_date_start").value;
        var l_date_end = document.getElementById("l_date_end").value;
        var l_discount_money = document.getElementById("l_discount_money").value;
        var l_course = document.getElementById("l_course").value;
        var l_quantity = document.getElementById("l_quantity").value;

        if (l_code_name == '') {
            document.getElementById("l_error1").innerHTML = "Bạn chưa nhập mã giảm giá";
            return false;
        } else if (l_code_name.length > 5) {
            document.getElementById("l_error1").innerHTML = "Mã không được lớn hơn 5 ký tự";
            return false;
        } else {
            document.getElementById("l_error1").style.display = "none";
            flag = true;
        }

        if (l_date_start == '') {
            document.getElementById("l_error2").innerHTML = "Bạn chưa nhập mã giảm giá";
            return false;
        } else {
            document.getElementById("l_error2").style.display = "none";
            flag = true;
        }

        if (l_date_end == '') {
            document.getElementById("l_error3").innerHTML = "Bạn chưa nhập mã giảm giá";
            return false;
        } else if (l_date_end < l_date_start) {
            document.getElementById("l_error3").innerHTML = "Ngày kết thúc không được nhỏ hơn ngày bắt đầu";
            return false;
        } else {
            document.getElementById("l_error3").style.display = "none";
            flag = true;
        }

        if (l_discount_money == '') {
            document.getElementById("l_error4").innerHTML = "Bạn chưa nhập số tiền";
            return false;
        } else if (isNaN(l_discount_money)) {
            document.getElementById("l_error4").innerHTML = "Bạn không được nhập ký tự vào ô trống";
            return false;
        } else {
            document.getElementById("l_error4").style.display = "none";
            flag = true;
        }

        if (l_course == '') {
            document.getElementById("l_error5").innerHTML = "Bạn chưa nhập số tiền";
            return false;
        } else if (isNaN(l_course)) {
            document.getElementById("l_error5").innerHTML = "Bạn không được nhập ký tự vào ô trống";
            return false;
        } else if (parseInt(l_course) < parseInt(l_discount_money)) {
            document.getElementById("l_error5").innerHTML = "Giá trị đơn hàng không thể nhỏ hơn số tiền giảm";
            return false;
        } else {
            document.getElementById("l_error5").style.display = "none";
            flag = true;
        }

        if (l_quantity == '') {
            document.getElementById("l_error6").innerHTML = "Bạn chưa nhập số lượng mã giảm giá";
            return false;
        } else if (isNaN(l_quantity)) {
            document.getElementById("l_error6").innerHTML = "Bạn không được nhập ký tự vào ô trống";
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
            var l_code_id = document.getElementById('l_code_id').value;
            var l_code_name = document.getElementById("l_code_name").value;
            var l_date_start = document.getElementById("l_date_start").value;
            var l_date_end = document.getElementById("l_date_end").value;
            var l_discount_money = document.getElementById("l_discount_money").value;
            var l_course = document.getElementById("l_course").value;
            var l_quantity = document.getElementById("l_quantity").value;
            var l_show = $("input[name='l_show']:checked").val();


            // $.get("../ajax/l_ajax_upDiscode.php", {
            //     l_code_id: l_code_id,
            //     l_code_name: l_code_name,
            //     l_date_start: l_date_start,
            //     l_date_end: l_date_end,
            //     l_discount_money: l_discount_money,
            //     l_course: l_course,
            //     l_quantity: l_quantity,
            //     l_show: l_show
            // }, function(data) {
            //     alert(data);
            //     window.location.href = 'tt_qlmagiamgia.php';
            // });


            var data = new FormData();
            data.append('l_code_id', l_code_id);
            data.append('l_code_name', l_code_name);
            data.append('l_date_start', l_date_start);
            data.append('l_date_end', l_date_end);
            data.append('l_discount_money', l_discount_money);
            data.append('l_course', l_course);
            data.append('l_quantity', l_quantity);
            data.append('l_show', l_show);
            console.log(l_show);
            $.ajax({
                url: '../ajax/l_ajax_upDiscode.php',
                type: 'post',
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if(response.result == true){
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                $(".alert-success").remove();
                            });
                        }, 3000);
                    }else{
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('sai');
                }
            });
        }
    }
</script>

</html>