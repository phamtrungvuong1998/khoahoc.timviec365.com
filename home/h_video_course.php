<?
require_once '../code_xu_ly/h_home.php';
$course_id = getValue('course_id','int','GET','');
$qrl = new db_query("SELECT * FROM course_lesson JOIN courses on course_lesson.course_id = courses.course_id WHERE course_lesson.course_id = $course_id");
$rowl = mysql_fetch_array($qrl->result);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <title>Video</title>
    <link rel="stylesheet" href="../css/custom-bootstrap.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_footer.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_header-home.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_video.css?v=<?=$version?>">
</head>
<style>
.collapse.in {
    width: 100%;
}

.watched {
    background: rgb(0 0 0 / 26%);
}
</style>

<body>
    <!-- HEADER -->
    <?php
    include '../includes/h_inc_header.php';
    ?>
    <!-- END: HEADER -->

    <!-- MAIN -->
    <main>
        <div id="video-header">
            <div class="container">
                <h1><?=$rowl['course_name']?></h1>
                <!-- <div class="star-rate">
                    <img width="20px" height="20px" src="../img/image/star.svg">
                    <img width="20px" height="20px" src="../img/image/star.svg">
                    <img width="20px" height="20px" src="../img/image/star.svg">
                    <img width="20px" height="20px" src="../img/image/star.svg">
                    <img width="20px" height="20px" src="../img/image/star.svg">
                </div> -->
            </div>
        </div>
        <!--Detail Main-->
        <div class="container">
            <div id="video-course">
                <div class="video-course1">
                    <?
                        $qrv = new db_query("SELECT lesson_id FROM course_lesson WHERE course_id = $course_id AND lesson_parent = 0");
                        $rowv = mysql_fetch_array($qrv->result);
                        $qrv1 = new db_query("SELECT video FROM course_lesson WHERE lesson_parent = ". $rowv['lesson_id']);
                        $rowv1 = mysql_fetch_array($qrv1->result);
                    ?>
                    <video controls>
                        <source src="/document/video/<?=$rowv1['video']?>" type="video/mp4">
                    </video>
                </div>
                <div class="video-course2">
                    <div class="list-video">
                        <?
                        $qrdoc = new db_query("SELECT lesson_id,lesson_name FROM course_lesson WHERE course_id = $course_id AND lesson_parent = 0");
                        while ($row = mysql_fetch_array($qrdoc->result)) {
                            $lesson_id = $row['lesson_id'];
                            ?>
                        <div class="navbar-toggle collapsed" data-toggle="collapse" data-target="#video<?=$lesson_id?>">
                            <h3><?=$row['lesson_name']?></h3>
                            <p>
                                <?
                                $qrdoc1 = new db_query("SELECT * FROM course_lesson WHERE lesson_parent = $lesson_id");
                                        echo mysql_num_rows($qrdoc1->result);
                            ?> bài giảng <img src="../img/ion_caret-back(1).png">
                            </p>
                        </div>
                        <ul class="navbar-collapse collapse" id="video<?=$lesson_id?>" aria-expanded="false"
                            style="height: 1px;">
                            <?
                                    while ($row = mysql_fetch_array($qrdoc1->result)) {
                                ?>
                            <li class="videochild" id="watchvideo_<?=$row['lesson_id']?>"
                                onclick="watchvideo(<?=$row['lesson_id']?>)">
                                <?=$row['lesson_name']?>
                            </li>

                            <?php
                                    }
                                    ?>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div id="nav-course">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#total">Tổng quan</a></li>
                    <li><a data-toggle="tab" href="#tailieu">Tài liệu</a></li>
                    <li><a data-toggle="tab" href="#teacher">Hỏi giảng viên</a></li>
                </ul>

                <div class="tab-content">
                    <div id="total" class="tab-pane fade in active">
                        <p><?=$rowl['general_describe']?></p>
                    </div>
                    <div id="tailieu" class="tab-pane fade">
                        <?
                            $qrdoc2 = new db_query("SELECT lesson_id,document FROM course_lesson WHERE course_id = $course_id AND lesson_parent !=0");
                            while ($row = mysql_fetch_array($qrdoc2->result)) {
                                ?>
                        <div class="tailieu1">
                            <div class="logopdf">
                                <img src="../img/image/tailieupdf2.svg">
                            </div>
                            <div class="namepdf">
                                <p><?=$row['document']?></p>
                                <!-- <span>1,896 mebibytes</span> -->
                            </div>
                            <div class="xem-download">
                                <a href="https://docs.google.com/viewer?url=<?=$domain?>/document/tailieu/<?=$row['document']?>"
                                    target="_blank" class="xem"><img src="../img/image/xem.svg">XEM</a>
                                <a href="/document/tailieu/<?=$row['document']?>" class="download" download=""><img
                                        src="../img/image/download.svg">DOWNLOAD</a>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    <div id="teacher" class="tab-pane fade">
                        <p>Chào Anh/Chị,
                            Hiện tại, khoá học này không hỗ trợ chức năng Hỏi giảng viên.
                            Nếu có bất kỳ thắc mắc nào liên quan đến Khóa học, Anh/Chị vui lòng liên hệ <span>Email:
                                hotro@khoahoc365.com</span> hoặc <span>Hotline: 024.36.36.66.99</span>
                            Rất xin lỗi Anh/Chị vì bất tiện này.
                            Cảm ơn Anh/Chị,
                            Ban quản trị Khoahoc365</p>
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
    <!-- <script src="/js/bootstrap.min.js?v=<?=$version?>"></script> -->
    <script>
    $(document).ready(function() {
        // Select all tabs
        $('.nav-tabs a').click(function() {
            $(this).tab('show');
        })
        // Select tab by name
        $('.nav-tabs a[href="#home"]').tab('show')

        // Select first tab
        $('.nav-tabs a:first').tab('show')

    })

    function watchvideo(id) {
        $.ajax({
            url: "../ajax/h_ajax_video.php",
            type: "POST",
            data: {
                'video': id
            },
            success: function(data) {
                $(".video-course1").html(data);
                if ($(".videochild").hasClass("watched")) {
                    $(".videochild").removeClass("watched")
                }
                $("#watchvideo_" + id).addClass("watched");
            }
        });
    }
    </script>
</body>

</html>