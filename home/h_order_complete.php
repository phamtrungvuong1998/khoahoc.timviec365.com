<?php
require_once '../code_xu_ly/h_home.php';
if($cookie_type != 1){
    header("location:/");
}

$course_id = getValue('course_id','int','GET','');
$qr_slug = new db_query("SELECT course_slug FROM courses WHERE course_id = $course_id");
$row_slug = mysql_fetch_array($qr_slug->result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <title>Order Complete</title>
    <link rel="stylesheet" href="../css/custom-bootstrap.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_footer.css?v=<?=$version?>">
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
                <p>HOÀN TẤT ĐƠN HÀNG</p>
            </div>
        </div>
        <!--Detail Main-->
        <div class="container">
            <div class="order-info2 the-complete">
                <div class="complete-img">
                    <img width="79px" height="79px" src="../img/image/complete.svg">
                </div>
                <div class="complete-thank">
                    <p>Bạn đã mua khóa học thành công</p>
                    <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi. Chúc bạn có những phút giây học tập hiệu quả !</p>
                </div>
                <div class="complete-return">
                    <a href="/" class="return-home">TRỞ VỀ TRANG CHỦ</a>
                    <a href="<?php echo urlDetail_courseOnline($course_id,$row_slug['course_slug']); ?>" class="go-course">ĐI ĐẾN KHÓA HỌC ĐÃ
                        MUA</a>
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

</html>