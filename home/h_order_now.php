<?php
session_start();
require_once '../code_xu_ly/h_home.php';
if ($cookie_id == 0 || $cookie_type == 2 || $cookie_type == 3) {
    header("Location: /");
}
$course_id = getValue('course_id', 'int', 'GET', '0');
    $dbc = new db_query("SELECT * FROM courses JOIN users on users.user_id=courses.user_id WHERE course_id = $course_id");
    $rowc = mysql_fetch_array($dbc->result);
    if ($rowc['price_promotional'] == -1) {
        $price = $rowc['price_listed'];
    }else{
        $price = $rowc['price_promotional'];
    }
    $center_teacher_id = $rowc['user_id'];
    if ($rowc['price_listed'] == -1) {
        header("Location: /");
    }
    if($rowc['course_type'] == 1){
        header("Location: /");
        $course_type = 1;
    }elseif($rowc['course_type'] == 2){
        $course_type = 2;
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
    <title>Mua ngay</title>
    <link rel="stylesheet" href="../css/h_footer.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/custom-bootstrap.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_header-home.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_order.css?v=<?=$version?>">
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
                <p>THANH TOÁN ĐƠN HÀNG MUA NGAY</p>
            </div>
        </div>
        <!--Detail Main-->
        <div id="order-main">
            <div class="container">
                <div class="order-main1">
                    <div class="order-info">
                        <div class="order-info1">
                            <hr>
                            <h3>Thông tin đơn hàng</h3>
                        </div>
                        <div class="order-info2">
                            <div class="order-all">
                                <div class="order-img-prd">
                                    <div class="order-img">
                                        <img width="100px" height="100px"
                                            onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                                            src="../img/course/<?=$rowc['course_avatar']?>">
                                    </div>
                                    <div class="order-product">
                                        <a href="<?=urlDetail_courseOffline($rowc['course_id'],$rowc['course_slug'])?>">
                                            <h3><?=$rowc['course_name']?></h3>
                                        </a>
                                        <p><?=$rowc['user_name']?></p>
                                    </div>
                                </div>

                                <div class="order-ma">
                                    <div class="nhapma">
                                        <form method="POST" onsubmit="return v_code();">
                                            <input type="text" id="code_name" name="code_name" placeholder="Nhập mã giảm giá">
                                            <input type="hidden" id="v_use_code" value="0">
                                            <button name="btncode">ÁP DỤNG</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="order-total">
                                    <div class="order-price">
                                        <span class="span1">Tạm tính</span>
                                        <span class="span2" id="v_price"><?php
                                        if ($rowc['price_promotional'] == -1) {
                                            echo number_format($rowc['price_listed']);
                                        }else{
                                            echo number_format($rowc['price_promotional']);
                                        }
                                        ?>
                                            đ</span>
                                    </div>
                                    <div class="order-price">
                                        <span class="span1">Tổng cộng</span>
                                        <span
                                            class="span2" id="v_tamtinh"><?php if ($rowc['price_promotional'] == -1) {
                                            echo number_format($rowc['price_listed']);
                                        }else{
                                            echo number_format($rowc['price_promotional']);
                                        }?>
                                            đ</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="order-info">
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

                    <form method="POST" onsubmit="return v_order_now()">
                        <div class="order-info">
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
                            <?
                        $db_order = new db_query("SELECT course_id,user_student_id FROM orders WHERE user_student_id = $cookie_id AND course_id=$course_id");
                        if (mysql_num_rows($db_order->result)>0) {
                        ?>
                            <a class="a-buy2">KHÓA HỌC ĐÃ ĐƯỢC MUA</a>
                        <?php
                            }else{
                        ?>
                            <div class="order-buy">
                                <label>
                                    <input checked required type="checkbox">
                                    Tôi đã đọc và đồng ý với <a href="https://timviec365.com/thoa-thuan-su-dung.html" target="_blank">Điều khoản sử dụng</a>
                                </label>
                            </div>
                            <button name="btn_buy" class="a-buy">TIẾN HÀNH THANH TOÁN</button>
                        <?php
                            }
                        ?>
                        </div>
                    </form>
                </div>
                <div class="order-main2">
                    <div class="order-info">
                        <div class="order-info1">
                            <hr>
                            <h3>Học viên nói gì <img width="24px" height="24px" src="../img/image/question.svg"
                                    class="quest-danger"></h3>
                        </div>
                        <div class="student-content">
                            <div class="quest-student">
                                <div class="quest-student1">
                                    <p>Sau khi học khoá Typo basics, em đã mua típ Logo 101 và đang gặm hàng ngày. Thực
                                        sự bổ ích và giá trị. Muchhh Loveee ❤</p>
                                </div>
                                <div class="quest-student2">
                                    <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' width="40px"
                                        height="40px" src="../img/avatar/Ellipse 24.png">
                                    <span>Xôi bánh bèo</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="order-infohr">
                        <div class="order-info1">
                            <hr>
                            <h3>Quyền sử dụng một người <img width="14px" height="36px" src="../img/image/danger.svg"
                                    class="quest-danger"></h3>
                        </div>
                        <div class="student-content">
                            <div class="quest-student">
                                <div class="quest-student1">
                                    <p>Bạn đang mua Quyền sử dụng một người cho khoá học này. Khoá này cho phép bạn xem
                                        và tải về tất cả những nội dung bên trong để cho duy nhất một người sử dụng.
                                        Quyền sử dụng một người không cho phép những nội dung bên trong được chia sẻ cho
                                        bất cứ bên nào khác, hay bất kì cá nhân nào khác.</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
    function v_code() {
        var course_id = <?php echo $course_id ?>;
        if ($("#code_name").val().trim() == "") {
            alert("Vui lòng nhập mã giảm giá");
            return false;
        }else{
            $.ajax({
                url: '../ajax/v_magiamgia.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    course_id: course_id,
                    code_name: $("#code_name").val().trim(),
                    user_id: <?php echo $rowc['user_id']; ?>
                },
                success: function (data) {
                    if (data.type == false) {
                        alert(data.msg);
                        $("#v_price").text(data.discount_money);
                        $("#v_tamtinh").text(data.discount_money);
                    }else if (data.type == true) {
                        alert(data.msg);
                        $("#v_use_code").val(1);
                        $("#v_price").text(data.discount_money);
                        $("#v_tamtinh").text(data.discount_money);
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại");
                }
            });
            
        }
        return false;
    }

    function v_order_now() {
        var count = $("#v_tamtinh").text().trim().split("");
        var price = "";
        for (var i = 0; i < count.length; i++) {
            // console.log(Number(count[i]));
            if (!isNaN(count[i])) {
                price = price + count[i];
            }
        }
        $.ajax({
            url: '../ajax/v_order_now.php',
            type: 'POST',
            dataType: 'json',
            data: {
                price: Number(price.trim()),
                course_id: <?php echo $course_id ?>,
                center_teacher_id: <?php echo $rowc['user_id']; ?>,
                code_name: $("#code_name").val().trim(),
                use_code: $("#v_use_code").val()
            },
            success: function (data) {
                if (data.type == false) {
                    alert(data.msg);
                }else{
                    window.location.href = "/mua-khoa-hoc-thanh-cong/id"+data.user_id+"-course"+data.course_id+".html";
                }
            },
            error: function () {
                alert("Có lỗi xảy ra. Vui lòng thử lại");
            }
        });
        
        return false;
    }
</script>
</html>