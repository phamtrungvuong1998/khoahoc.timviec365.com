<?php
$actived = "online";
require_once '../code_xu_ly/h_home.php';
if (isset($_COOKIE['user_id'])) {
    $id = $_COOKIE['user_id'];
} else {
    $id = 0;
}

if (!isset($_COOKIE['user_id'])) {
    $buy = 0;
} else if ($cookie_type == 1) {
    $buy = 1;
} else {
    $buy = 2;
}
$course_type = 2;

$page = getValue('page', 'int', 'GET', '');

//Môn học
$ca = getValue('ca', 'int', 'GET', '');
if ($ca != 0) {
    $qrCate = " AND courses.cate_id = $ca";
    $qrCate1 = new db_query("SELECT cate_name FROM categories WHERE cate_id = $ca");
    if (mysql_num_rows($qrCate1->result) == 0) {
        header("Location: /khoa-hoc-online.html");
    }
} else {
    $qrCate = "";
}


$ta = getValue('ta', 'int', 'GET', '');

$te = getValue('te', 'int', 'GET', '');

$p = getValue('p', 'int', 'GET', '');

if($p != 0 && $p != 1 && $p != 2){
    header("Location: /khoa-hoc-online.html");
}

$keyword = "";

$ci = 0;

if ($ta != 0) {
    $qrTag = " AND courses.tag_id = $ta";
    $qrCate1 = new db_query("SELECT tag_name FROM tags WHERE tag_id = $ta AND cate_id = $ca");
    if (mysql_num_rows($qrCate1->result) == 0) {
        header("Location: /khoa-hoc-online.html");
    }
} else {
    $qrTag = "";
}

if ($page == 0) {
    $start = 0;
    $end = 6;
} else {
    $start = ($page - 1) * 6;
    $end = 6;
}

if ($te != 0) {
    $qrTeacher = " AND courses.user_id = $te";
    $qrCate1 = new db_query("SELECT user_name FROM users WHERE user_id = $te AND (user_type = 2 OR user_type = 3)");
    if (mysql_num_rows($qrCate1->result) == 0) {
        header("Location: /khoa-hoc-online.html");
    }
} else {
    $qrTeacher = "";
}

if ($p == 0) {
    $qrPrice = " ORDER BY courses.course_id DESC";
} else if ($p == 1) {
    $qrPrice = " ORDER BY courses.price_listed DESC";
} else if ($p == 2) {
    $qrPrice = " ORDER BY courses.price_listed ASC";
}

$qr = new db_query("SELECT *,categories.cate_id FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE courses.course_type = 2 AND courses.price_listed > -1 AND courses.hide_course = 1 AND courses.accept = 1 $qrCate $qrTag $qrTeacher $qrPrice LIMIT $start,$end");

$qrCount = new db_query("SELECT course_id FROM courses WHERE course_type = 2 AND hide_course = 1 AND accept = 1 AND courses.price_listed != -1 $qrCate $qrTag $qrTeacher");

$v_row_count = mysql_num_rows($qrCount->result);
$v_sum = $v_row_count / 6;
if ($page > ceil($v_sum)) {
    header("Location: /khoa-hoc-online.html");
}


$qrTheme = new db_query("SELECT cate_id FROM courses");
$b = [];

while ($rowTheme = mysql_fetch_array($qrTheme->result)) {
    $cate_id2 = $rowTheme['cate_id'];
    $qrCat = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id2'");
    $rowCat = mysql_fetch_array($qrCat->result);
    if (isset($b[$rowCat['cate_name']])) {
        $b[$rowCat['cate_name']]++;
    } else {
        $b[$rowCat['cate_name']] = 1;
    }
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
    <title>Danh sách khóa học online</title>
    <link rel="preload" href="/css/h_category.css?v=<?= $version ?>" as="style">
    <link rel="preload" href="/css/select2.min.css?v=<?= $version ?>" as="style">
    <? require_once '../includes/h_inc_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../css/h_category.css?v=<?= $version ?>">
    <?php if ($cookie_type == 3 || $cookie_type == 2) {
    ?>
        <style>
            .like-product {
                display: none;
            }
        </style>

    <?php
    }

    ?>
</head>

<body>
    <!-- HEADER -->
    <?php
    include '../includes/h_inc_header.php';
    ?>
    <!-- END: HEADER -->

    <!--SEARCH-->
    <?php
    include '../includes/h_inc_search.php';
    ?>
    <!--END: SEARCH-->


    <!-- MAIN -->
    <main>
        <div id="breadcrumb">
            <ol>
                <li><a href="/">Trang chủ</a></li>
                <li style="font-size: 18px;">></li>
                <li>Danh sách online</li>
            </ol>
        </div>
        <div class="container" id="cate-container">
            <div id="title-search">
                <hr>
                <h1>DANH SÁCH KHÓA HỌC ONLINE</h1>
            </div>
            <div id="boloc-search">
                <div class="img-boloc">
                    <span><img class="lazyload" src="/img/load.gif" data-src="../img/image/boloc.svg"></span>
                    <span>Bộ lọc</span>
                </div>
                <div class="select-boloc">
                    <div class="selecboloc">
                        <select name="subject" id="subject" onchange="v_filter_online()">
                            <option value="0">MÔN HỌC</option>
                            <?php $qrCate = new db_query("SELECT `cate_name`,`cate_id` FROM `categories`");
                            while ($rowCate = mysql_fetch_array($qrCate->result)) {
                                if ($ca == $rowCate['cate_id']) {
                                    $select = "selected";
                                } else {
                                    $select = "";
                                }
                            ?>
                                <option value="<?php echo $rowCate['cate_id']; ?>" <?= $select ?>>
                                    <?php echo $rowCate['cate_name']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="selecboloc">
                        <select name="course" id="course" onchange="v_filter_online()">
                            <option value="0">MÔN HỌC CHI TIẾT</option>
                            <?php
                            if ($ca != 0) {
                                $qrTag = new db_query("SELECT tag_id,tag_name FROM tags WHERE cate_id = $ca");
                                $i = 1;
                                while ($rowTag = mysql_fetch_array($qrTag->result)) {
                                    if ($rowTag['tag_id'] == $ta) {
                                        $select = "selected";
                                    } else {
                                        $select = "";
                                    }
                            ?>
                                    <option value="<?= $rowTag['tag_id'] ?>" data-tag="<?=$i?>" <?= $select ?>><?= $rowTag['tag_name'] ?></option>
                            <?php
                                    $i++;
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="selecboloc">
                        <?php
                        $qrGV = new db_query("SELECT user_id, user_name, cate_id FROM users WHERE user_type = 2 OR user_type = 3");
                        $arr_teacher2 = [];
                        $teacher = '';
                        if ($ca != 0) {
                            while ($rowGV = mysql_fetch_array($qrGV->result)) {
                                $cate = explode(",", $rowGV['cate_id']);
                                for ($i = 0; $i < count($cate); $i++) {
                                    if ($cate[$i] == $ca) {
                                        $arr_teacher2[$rowGV['user_id']]['user_id'] = $rowGV['user_id'];
                                        $arr_teacher2[$rowGV['user_id']]['user_name'] = $rowGV['user_name'];
                                    }
                                }
                            }

                            foreach ($arr_teacher2 as $key => $value) {
                                if ($value['user_id'] == $te) {
                                    $select = "selected";
                                } else {
                                    $select = "";
                                }
                                $teacher = $teacher . '<option value="' . $value['user_id'] . '"' . $select . '>' . $value['user_name'] . '</option>';
                            }
                        }
                        ?>
                        <select name="teacher" id="teacher" onchange="v_filter_online()">
                            <option value="0">GIẢNG VIÊN</option>
                            <?= $teacher ?>
                        </select>
                    </div>
                    <select name="prices" id="prices" onchange="v_filter_online()">
                        <option value="0" <?php if ($p == 0) {
                                                echo "selected";
                                            } ?>>GIÁ HỌC</option>
                        <option value="1" <?php if ($p == 1) {
                                                echo "selected";
                                            } ?>>GIÁ TỪ CAO ĐẾN THẤP</option>
                        <option value="2" <?php if ($p == 2) {
                                                echo "selected";
                                            } ?>>GIÁ TỪ THẤP ĐẾN CAO</option>
                    </select>
                </div>
            </div>
            <div id="main-search">
                <div class="main-category1">
                    <!--Category-->
                    <div class="main-category">
                        <div class="category">
                            <div class="cate-title">
                                <hr>
                                <h2>DANH MỤC MÔN HỌC</h2>
                            </div>
                            <ul class="cate-subj">
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/image/allsubj.svg"><a href="/khoa-hoc-online.html">Tất cả môn học</a>
                                </li>
                                <?
                                $db_cat = new db_query("SELECT * FROM `categories`");
                                while ($row = mysql_fetch_array($db_cat->result)) {
                                ?>
                                    <li><img class="lazyload" src="/img/load.gif" data-src="../img/categories/<?= $row['cate_icon'] ?>"><a href="<?php echo urlOnline_cate($row['cate_id'], $row['cate_slug']); ?>"><?= $row['cate_name'] ?></a>
                                    </li>
                                <?php
                                }
                                ?>

                            </ul>
                        </div>
                    </div>

                    <!--Chu de-->
                    <div class="main-topic">
                        <div class="topic">
                            <div class="topic-title">
                                <hr>
                                <h2>CHỦ ĐỀ ĐANG HOT</h2>
                            </div>
                            <div class="topic-feature">
                                <?php
                                arsort($b);
                                $k = 0;
                                foreach ($b as $key => $value) {
                                    if ($k > 2) {
                                        break;
                                    } else {
                                ?>
                                        <div class="topic-item">
                                            <?php
                                            $qrThemeHot = new db_query("SELECT cate_slug, cate_id FROM categories WHERE cate_name = '$key'");
                                            $rowThemeHot = mysql_fetch_array($qrThemeHot->result);
                                            ?>
                                            <a href="<?php echo urlOnline_cate($rowThemeHot['cate_id'], $rowThemeHot['cate_slug']); ?>"><?php echo $key; ?>
                                                ( <?php echo $value; ?> )</a>
                                        </div>
                                <?php
                                        $k++;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!--All Product-->
                <?php
                include '../includes/inc_show_course_category.php';
                ?>
                <!--END Product-->

            </div>
        </div>
    </main>
    <!--END: MAIN-->


    <!-- FOOTER -->
    <?php
    include '../includes/h_popup_dangnhap2.php';
    include '../includes/h_inc_footer.php';
    ?>
    <!-- END: FOOTER -->
    <script src="../js/select2.min.js?v=<?= $version ?>"></script>
    <script type="text/javascript">
        var arr = [];
        $("#city2").select2();
        $("#course").select2();
        $("#teacher").select2();
        $("#subject").select2();
        $("#prices").select2();
        var tag_id = <?php echo $ta; ?>;
        var subjectCate = <?php echo $ca; ?>;

        function v_filter_online() {
            var subject = $("#subject").val();
            var cate_name = $("#subject").children().eq(subject).text().trim();

            var course = $("#course").val();
            var tag_name;
            for (let i = 0; i < $("#course").children().length; i++) {
                if ($("#course").children().eq(i).val() == course) {
                    tag_name = $("#course").children().eq(i).text();
                }
            }

            var teacher = $("#teacher").val();

            var prices = $("#prices").val();

            var type;

            if (prices != 0) {
                var price = "&p=" + prices;
                var price2 = "?p=" + prices;
                type = 1;
            } else {
                var price = "";
                var price2 = "";
                type = 0;
            }
            if (subject != subjectCate) {
                    course = 0;
            }
            var btn_search_online = 1;
            if (subject == 0) {
                window.location.href = '<?= $url2 ?>' + price2;
            } else if (subject != 0) {
                if (course == 0 && teacher == 0) {
                    if (type == 1) {
                        window.location.href = '<?= $url2 ?>' + "?ca=" + subject + price;
                    } else {
                        window.location.href = "../code_xu_ly/v_search.php?keyword1=" + cate_name + "&btn_search_online=" + btn_search_online;
                    }
                } else if (course != 0 && teacher == 0) {
                    if (type == 1) {
                        window.location.href = '<?= $url2 ?>' + "?ca=" + subject + "&ta=" + course + price;
                    } else {
                        window.location.href = "../code_xu_ly/v_search.php?keyword1=" + tag_name + "&btn_search_online=" + btn_search_online;
                    }
                } else if (course == 0 && teacher != 0) {
                    window.location.href = '<?= $url2 ?>' + "?ca=" + subject + "&te=" + teacher + price;
                } else if (course != 0 && teacher != 0) {
                    window.location.href = '<?= $url2 ?>' + "?ca=" + subject + "&ta=" + course + "&te=" + teacher + price;
                }
            }
        }
    </script>
    <script src="../js/v_search.js?v=<?= $version ?>"></script>

</body>

</html>