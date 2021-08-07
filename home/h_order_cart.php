<?php
session_start();
require_once '../code_xu_ly/h_home.php';
if (!isset($_COOKIE['user_id']) || $_COOKIE['user_type'] != 1) {
    header("Location: /");
}else{
    $user_id = $_COOKIE['user_id'];
    $qrCart = new db_query("SELECT * FROM carts INNER JOIN courses ON carts.course_id = courses.course_id WHERE user_student_id = $user_id ORDER BY cart_id DESC");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="../css/h_footer.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/custom-bootstrap.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_header-home.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_order.css?v=<?=$version?>">
    <style>
        .order-user,
        .order-price1,
        .order-info2{
            margin-bottom: 20px;
            background: #FFFFFF;
            box-shadow: 0px 4px 5px rgb(0 0 0 / 14%), 0px 1px 10px rgb(0 0 0 / 12%), 0px 2px 4px rgb(0 0 0 / 20%);
        }
        .order-info{
            background: none;
        }
        .order-all{
            margin-bottom: 20px;
            background: #FFFFFF;
        }
        .order-price1{
            padding-right: 100px;
            padding-left: 100px;
            padding-top: 23px;
        }
        .alert-danger{
            margin-top: 24px;
        }
        @media(max-width: 1300px){
            .order-main1{
                width: 100%;
            }
            .order-price1{
                padding-left: 15px;
                padding-right: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <?php
    include '../includes/h_inc_header.php';
    ?>
    <!-- END: HEADER -->

    <!-- MAIN -->
    <main>
        <div id="order-header">
            <div class="container">
                <p>THANH TOÁN GIỎ HÀNG</p>
            </div>
        </div>
        <!--Detail Main-->
        <div id="order-main">
            <div class="container">
                <div class="order-main1">
                    <form method="POST" enctype="multipart/form-data" onsubmit="return v_pay();">
                        <div class="order-info">
                            <div class="order-info1">
                                <hr>
                                <h3>Thông tin đơn hàng</h3>
                            </div>
                            <?php
                            $total_price = 0;
                            if (mysql_num_rows($qrCart->result) == 0) {
                                echo '<div class="alert alert-danger" role="alert">Không có hàng</div>';
                            }else{
                                while ($rowCart = mysql_fetch_array($qrCart->result)) {
                                    if ($rowCart['price_promotional'] == -1) {
                                        $price = $rowCart['price_listed'];
                                    }else{
                                        $price = $rowCart['price_promotional'];
                                    }
                                    $total_price = $total_price + $price;
                            ?>
                            <div class="order-info2 order_info3">
                                <div class="order-all">
                                    <div class="order-img-prd">
                                        <div class="order-img">
                                            <img width="100px" height="100px"
                                                onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                                src="../img/course/<?php echo $rowCart['course_avatar']; ?>">
                                        </div>
                                        <div class="order-product">
                                            <a href="">
                                                <h3><?php echo $rowCart['course_name']; ?></h3>
                                            </a>
                                            <p></p>
                                        </div>
                                        <a class="unsetcart" data-cart_id="<?php echo $rowCart['cart_id']; ?>">X</a>
                                    </div>
                                    <div class="order-ma">
                                        <div class="nhapma">
                                            <input type="text" class="code_name" placeholder="Nhập mã giảm giá">
                                            <button name="btncode" type="button" class="btn_code" data-teacher_id="<?php echo $rowCart['user_id']; ?>" data-course_id="<?php echo $rowCart['course_id']; ?>">ÁP DỤNG</button>
                                        </div>
                                    </div>
                                    <div class="order-total">
                                        <div class="order-price order-price_tamtinh">
                                            <span class="span1">Tạm tính</span>
                                            <span class="span2"><?php echo number_format($price); ?> đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            }
                            ?>
                            <div class="order-price order-price1">
                                <span class="span1">Tổng cộng</span>
                                <span class="span2" id="v_tongcong" ><?php echo number_format($total_price); ?> đ</span>
                            </div>
                        </div>
                        <div class="order-info order_pay">
                            <div class="order-info1">
                                <hr>
                                <h3>Thông tin tài khoản</h3>
                            </div>
                            <div class="order-info2">
                                <div class="order-user">
                                    <div class="user-img">
                                        <img style="border-radius: 100px;" width="48px" height="48px"
                                            onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                            src="../img/avatar/<?=$row['user_avatar']?>">
                                    </div>
                                    <div class="user-tk">
                                        <p class="userp1">Bạn đang đăng nhập tài khoản</p>
                                        <p class="userp2"><?=$row['user_mail']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="order-info order_pay">
                            <div class="order-info1">
                                <hr>
                                <h3>Thông tin thanh toán</h3>
                            </div>
                            <div class="order-info2">
                                <div class="order-user2">
                                    <div class="user-img">
                                        <input checked type="checkbox" required>
                                    </div>
                                    <div class="user-tk2">
                                        <p>Thanh toán bằng ví <span class="userspan1">Khóa học 365</span></p>
                                        <span class="userspan2">Thanh toán tiện lợi không mất phí giao dịch</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="order-check">
                            <div class="order-buy">
                                <label>
                                    <input checked required type="checkbox">
                                    Tôi đã đọc và đồng ý với <a href="https://timviec365.com/thoa-thuan-su-dung.html" target="_blank">Điều khoản sử dụng</a>
                                </label>
                            </div>
                            <button name="btn_buy" class="a-buy">TIẾN HÀNH THANH TOÁN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
    <!--END: MAIN-->


    <!-- FOOTER -->
    <?php
    include '../includes/h_inc_footer.php';
    ?>
    <!-- END: FOOTER -->
</body>
<script type="text/javascript">
    if ($(".order_info3").length == 0) {
        $(".order-price1").remove();
        $(".order-check").remove();
        $(".order_pay").remove();
    }

    $(".unsetcart").click(function() {
        var unsetcart = $(this);
        var n = confirm("Bạn có muốn xóa khóa học này khỏi giỏ hàng không ?");
        if (n == true) {
            var cart_id = $(this).data('cart_id');
            $.ajax({
                url: '../ajax/v_del_cart.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    cart_id: cart_id
                },
                success: function (data) {
                    if (data.type == true) {
                        unsetcart.parents(".order-info2").remove();
                        $("#v_tongcong").text(data.price);
                        if ($(".order_info3").length == 0) {
                            $(".order-price1").remove();
                            $(".order-check").remove();
                            $(".order_pay").remove();
                            $(".order-info").append('<div class="alert alert-danger" role="alert">Không có hàng</div>');
                        }
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại");
                }
            });
        }
    });

    $(".btn_code").click(function() {
        var btn_code = $(this);
        if ($(this).prev().val().trim() == "") {
            alert("Vui lòng nhập mã giảm giá");
        }else{
            var course_id = $(this).data('course_id');
            var count1 = $(this).parents(".order-ma").next().find(".span2");
            var count = $(this).parents(".order-ma").next().find(".span2").text().split("");
            var price = "";
            for (var i = 0; i < count.length; i++) {
                if (!isNaN(count[i])) {
                    price = price + count[i];
                }
            }
            price = Number(price);
            var code_name = $(this).prev().val().trim();
            var teacher_id = $(this).data('teacher_id');
            $.ajax({
                url: '../ajax/v_magiamgia.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    code_name: code_name,
                    user_id: teacher_id,
                    course_id: course_id
                },
                success: function (data) {
                    if (data.type == false) {
                        alert(data.msg);
                        btn_code.attr('data-code_id', "");
                        count1.text(data.discount_money);
                        $(".order-price1").find('.span2').text(data.total_price);
                    }else if(data.type == true){
                        count1.text(data.discount_money);
                        btn_code.attr('data-code_id', data.code_id);
                        $(".order-price1").find('.span2').text(data.total_price);
                    }
                }
            });
        }
    });

    function v_pay() {
        var arr_code = [];
        for (var i = 0; i < $(".btn_code").length; i++) {
            var code_id = $(".btn_code").eq(i).data("code_id");
            arr_code.push(code_id);
        }

        var count = $(".order-price1").find('.span2').text().trim().split("");
        var price = "";
        for (var i = 0; i < count.length; i++) {
            if (!isNaN(count[i])) {
                price = price + count[i];
            }
        }
        price = Number(price);

        var arr_tamtinh = [];
        
        for (var i = 0; i < $(".order-price_tamtinh").length; i++) {
            var count2 = $(".order-price_tamtinh").eq(i).find('.span2').text().trim().split("");
            var price2 = "";
            for (var j = 0; j < count2.length; j++) {
                if (!isNaN(count2[j])) {
                    price2 = price2 + count2[j];
                }
            }
            price2 = Number(price2);
            arr_tamtinh.push(price2);
        }

        var arr_course = [];
        for (var i = 0; i < $(".btn_code").length; i++) {
            arr_course.push($(".btn_code").eq(i).data('course_id'));
        }
        $.ajax({
            url: '../ajax/v_pay_cart.php',
            type: 'POST',
            dataType: 'json',
            data: {
                course: arr_course,
                price: price,
                tamtinh: arr_tamtinh,
                arr_code: arr_code
            },
            success: function (data) {
                if (data.type == false) {
                    alert(data.msg);
                }else{
                    alert("Mua khóa học thành công");
                    window.location.href = "/hoc-vien-khoa-hoc-online-da-mua/id"+data.user_id+".html";
                }
            }
        });
        return false;
    }
</script>
</html>