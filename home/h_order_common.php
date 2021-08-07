<?php
session_start();
require_once '../code_xu_ly/h_home.php';
if ($cookie_id == 0 || $cookie_type != 1) {
    header("Location: /");
}
$course_id = getValue('course_id','int','GET','');
$dbc = new db_query("SELECT * FROM courses JOIN users ON users.user_id = courses.user_id WHERE course_id = $course_id");
$rowc = mysql_fetch_array($dbc->result);
if ($rowc['course_type'] == 1) {
    header("Location: /");
}else if ($rowc['quantity_std'] == 0) {
    header("Location: /");
}

$qrCommon = new db_query("SELECT * FROM order_student_common WHERE course_id = $course_id AND user_student_id = " . $_COOKIE['user_id']);
// echo $qrCommon->query;
// echo mysql_num_rows($qrCommon->result);
$qrCommon2 = new db_query("SELECT * FROM order_common WHERE course_id = $course_id AND common_id = (SELECT MAX(common_id) FROM order_common WHERE course_id = $course_id)");
$rowCommon2 = mysql_fetch_array($qrCommon2->result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <title>Mua Chung</title>
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
                <p>THANH TOÁN ĐƠN HÀNG</p>
            </div>
        </div>
        <!--Detail Main-->
        <div id="order-main">
            <div class="container">
                <div class="order-main1">
                    <form method="POST" enctype="multipart/form-data" onsubmit="return v_thanhtoan()">
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
                                        <input type="hidden" name="course_id[]" value="<?=$rowc['course_id']?>">
                                        <input type="hidden" name="order_type" value="<?=$order_type?>">
                                        <div class="order-product">
                                            <a
                                                href="<?=urlDetail_courseOffline($rowc['course_id'],$rowc['course_slug'])?>">
                                                <h3><?=$rowc['course_name']?></h3>
                                            </a>
                                            <p><?=$rowc['user_name']?></p>
                                        </div>
                                    </div>
                                    <div class="order-total">
                                        <div class="order-price">
                                            <span class="span1">Học phí</span>
                                            <span class="span2"><?php
                                            if ($rowc['price_promotional'] == -1) {
                                                echo number_format($rowc['price_listed']) . ' đ';
                                            }else{
                                                echo number_format($rowc['price_promotional']). ' đ';
                                            }
                                            ?></span>
                                        </div>
                                        <div class="order-price">
                                            <span class="span1">Đặt cọc</span>
                                            <span class="span2"><?=number_format($rowc['price_discount'])?> đ</span>
                                        </div>
                                        <div class="order-price">
                                            <span class="span1">Số người đặt cọc </span>
                                            <span class="span2"> <?php
                                            if ($rowCommon2['numbers'] == $rowc['quantity_std'] || mysql_num_rows($qrCommon2->result) == 0) {
                                                echo "0/" . $rowc['quantity_std'];
                                            }else{
                                                echo $rowCommon2['numbers'] . "/" . $rowc['quantity_std'];
                                            }?> </span>
                                        </div>
                                        <div class="order-price">
                                            <span class="span1">Tổng cộng</span>
                                            <span class="span2"><?=number_format($rowc['price_discount'])?> đ</span>
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

                            <div class="order-buy">
                                <label>
                                    <input checked required type="checkbox">
                                    Tôi đã đọc và đồng ý với <a href="https://timviec365.com/thoa-thuan-su-dung.html" target="_blank">Điều khoản sử dụng</a>
                                </label>
                            </div>
                            <?php
                                if(mysql_num_rows($qrCommon->result) > 0){
                            ?>
                            <div class="a-buy">ĐÃ ĐẶT CỌC</div>
                            <?
                                }else{
                            ?>
                            <button name="btn_buy" class="a-buy">TIẾN HÀNH THANH TOÁN</button>
                            <?
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
    function v_thanhtoan(){
        $.ajax({
            url: '../ajax/v_pay_common.php',
            type: 'POST',
            dataType: 'json',
            data: {
                course_id: <?php echo $course_id ?>
            },
            success: function (data) {
                if (data.type == false) {
                    alert(data.msg);
                }else{
                    alert(data.msg);
                    window.location.href = "/hoc-vien-khoa-hoc-mua-chung/id"+data.user_id+".html";
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