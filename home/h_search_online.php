<?php
$actived = "online";
$v_actived_type = "online";
require_once '../code_xu_ly/h_home.php';
if (isset($_COOKIE['user_id'])) {
    $id = $_COOKIE['user_id'];
} else {
    $id = 0;
}
$course_type = 2;
if (!isset($_COOKIE['user_id'])) {
    $buy = 0;
} else if ($_COOKIE['user_type'] == 1) {
    $buy = 1;
} else {
    $buy = 2;
}
$ca = 0;
$ta = 0;
$te = 0;
$p = 0;
$ci = 0;

$keyword = getValue('keyword', 'str', 'GET', '');
$tag_id = getValue('tag_id', 'int', 'GET', '');
$cate_id = getValue('cate_id', 'int', 'GET', '');
$cate_id3 = $cate_id;

$arr = [
    'cate_id' => $cate_id,
    'tag_id' => $tag_id,
    'keyword' => $keyword
];

if ($cate_id == 0) {
    unset($arr['cate_id']);
} else {
    $qrCate = new db_query("SELECT cate_slug,cate_id FROM categories WHERE cate_id = $cate_id");
    $rowC = mysql_fetch_array($qrCate->result);
    $url = urlOnline_cate($rowC['cate_id'], $rowC['cate_slug']);
    if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) != $url) {
        header("Location: $url");
    }
}

if ($tag_id == 0) {
    unset($arr['tag_id']);
} else {
    $qrTag = new db_query("SELECT tag_slug,tag_id FROM tags WHERE tag_id = $tag_id");
    $rowT = mysql_fetch_array($qrTag->result);
    $url = urlOnline_tag($rowT['tag_id'], $rowT['tag_slug']);
    if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) != $url) {
        header("Location: $url");
    }
}

if ($keyword == '') {
    unset($arr['keyword']);
}

$arr_keyword = explode("-", $keyword);
$key = "";
for ($i = 0; $i < count($arr_keyword); $i++) {
    if ($i < count($arr_keyword) - 1) {
        $key = $key . $arr_keyword[$i] . " ";
    } else {
        $key = $key . $arr_keyword[$i];
    }
}

$page = getValue('page', 'int', 'GET', '');
if ($page == 0) {
    $start = 0;
    $end = 6;
} else {
    $start = ($page - 1) * 6;
    $end = 6;
}
if ($tag_id != 0) {
    $qr = new db_query("SELECT *,categories.cate_id FROM courses JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON users.user_id = courses.user_id WHERE courses.course_type = 2 AND courses.tag_id = '$tag_id' AND price_listed > -1 AND courses.hide_course = 1 AND courses.accept = 1 ORDER BY courses.course_id DESC LIMIT $start, $end");
    $v_cout = new db_query("SELECT course_id FROM courses WHERE course_type = 2 AND tag_id = '$tag_id' AND price_listed > -1 AND courses.hide_course = 1 AND courses.accept = 1");
    $v_qr = "SELECT * FROM courses JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON users.user_id = courses.user_id WHERE courses.course_type = 2 AND courses.tag_id = '$tag_id'";
    $names = new db_query("SELECT tag_name FROM tags WHERE tag_id = $tag_id");
    $rown = mysql_fetch_array($names->result);
    $search_key = "Danh sách " . $rown['tag_name'];
} else if ($keyword != '') {
    $qr = new db_query("SELECT *,categories.cate_id FROM courses JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON users.user_id = courses.user_id WHERE courses.course_type = 2 AND courses.course_name LIKE '%$key%' AND price_listed > -1 AND courses.hide_course = 1 AND courses.accept = 1 ORDER BY courses.course_id DESC LIMIT $start, $end");
    $v_cout = new db_query("SELECT course_id FROM courses WHERE course_type = 2 AND course_name LIKE '%$key%' AND price_listed > -1 AND courses.hide_course = 1 AND courses.accept = 1");
    $v_qr = "SELECT * FROM courses JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON users.user_id = courses.user_id WHERE courses.course_type = 2 AND courses.course_name LIKE '%$key%' AND price_listed > -1 AND courses.hide_course = 1 AND courses.accept = 1";

    $search_key = "Danh sách Khóa học " . $key;
} else if ($cate_id != 0) {
    $qr = new db_query("SELECT *,categories.cate_id FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE courses.course_type = 2 AND courses.cate_id = $cate_id AND price_listed > -1 AND courses.hide_course = 1 AND courses.accept = 1 ORDER BY courses.course_id DESC LIMIT $start, $end");
    $v_cout = new db_query("SELECT course_id FROM courses WHERE course_type = 2 AND cate_id = $cate_id AND price_listed > -1 AND courses.hide_course = 1 AND courses.accept = 1");

    $v_qr = "SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE courses.course_type = 2 AND courses.cate_id = $cate_id AND price_listed > -1 AND courses.hide_course = 1 AND courses.accept = 1";

    $names = new db_query("SELECT cate_name,cate_slug FROM categories WHERE cate_id = $cate_id");
    $rown = mysql_fetch_array($names->result);
    if (strpos($rown['cate_slug'], "khoa-hoc-") !== false) {
        $cate_name = substr($rown['cate_name'], 12);
    } else {
        $cate_name = $rown['cate_name'];
    }
    $search_key = "Danh sách Khóa học " . $cate_name;
}
// echo $qr->query;
$v_row_count = mysql_num_rows($v_cout->result);

$v_sum = $v_row_count / 6;

if ($page > ceil($v_sum)) {
    header("Location: /khoa-hoc-online.html");
}

$qrTheme = new db_query("SELECT cate_id FROM courses WHERE course_type = 2");
$b = [];

while ($rowTheme = mysql_fetch_array($qrTheme->result)) {
    $theme_cate_id = $rowTheme['cate_id'];
    $qrCat = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$theme_cate_id'");
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
    <title><?= $search_key; ?> </title>
    <link rel="stylesheet" href="../css/select2.min.css?v=<?= $version ?>">
    <? require_once '../includes/h_inc_css.php'; ?>
    <link rel="stylesheet" href="../css/h_category.css?v=<?= $version ?>">
    <style>
        <?php
        if (isset($_COOKIE['user_type'])) {
            if ($_COOKIE['user_type'] == 3 || $_COOKIE['user_type'] == 2) {
        ?>.like-product {
            display: none;
        }

        <?php
            }
        } else if (!isset($_COOKIE['user_type'])) {
        ?>.like-product {
            display: block;
        }

        <?php
        }

        ?>
    </style>
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
                <li><?= $search_key; ?></li>
            </ol>
        </div>
        <div class="container" id="cate-container">
            <div id="title-search">
                <hr>
                <h1><?= $search_key; ?></h1>
            </div>
            <div id="boloc-search">
                <div class="img-boloc">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/image/boloc.svg">
                    <span>Bộ lọc</span>
                </div>
                <div class="select-boloc">
                    <div class="selecboloc">
                        <?php
                        $qrCateTag = new db_query("SELECT cate_id FROM tags WHERE tag_id = $tag_id");
                        $rowCateTag = mysql_fetch_array($qrCateTag->result);
                        if (mysql_num_rows($qrCateTag->result) > 0) {
                            $cate_id = $rowCateTag['cate_id'];
                            $cate_id3 = $rowCateTag['cate_id'];
                        }else{
                            $cate_id3 = $cate_id;
                        }
                        // echo $cate_id;
                        ?>
                        <select name="subject" id="subject" onchange="v_filter_online()">
                            <option value="0">MÔN HỌC</option>
                            <?php
                            $qrCate = new db_query("SELECT `cate_name`,`cate_id` FROM `categories`");
                            $qrCateTag = new db_query("SELECT cate_id FROM tags WHERE tag_id = $tag_id");
                            $rowCateTag = mysql_fetch_array($qrCateTag->result);
                            if (mysql_num_rows($qrCateTag->result) > 0) {
                                $cate_id = $rowCateTag['cate_id'];
                            }
                            while ($rowCate = mysql_fetch_array($qrCate->result)) {
                                if ($rowCate['cate_id'] == $cate_id || $rowCate['cate_id'] == $rowCateTag['cate_id']) {
                                    $checkCate = 'selected';
                                } else {
                                    $checkCate = '';
                                }
                            ?>
                                <option value="<?php echo $rowCate['cate_id']; ?>" <?php echo $checkCate; ?>><?php echo $rowCate['cate_name']; ?>
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
                            $qrTag = new db_query("SELECT * FROM tags WHERE cate_id = $cate_id");
                            while ($rowTag = mysql_fetch_array($qrTag->result)) {
                                if ($rowTag['tag_id'] == $tag_id) {
                                    $select = "selected";
                                } else {
                                    $select = "";
                                }
                            ?>
                                <option value="<?php echo $rowTag['tag_id'] ?>" <?= $select ?>><?php echo $rowTag['tag_name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="selecboloc">
                        <select name="teacher" id="teacher" onchange="v_filter_online()">
                            <option value="0">GIẢNG VIÊN</option>
                            <?php
                            $qrGV = new db_query("SELECT user_id, user_name, cate_id FROM users WHERE user_type = 2 OR user_type = 3");
                            $arr_teacher2 = [];
                            $teacher = "";
                            if ($cate_id != 0) {
                                while ($rowGV = mysql_fetch_array($qrGV->result)) {
                                    $cate = explode(",", $rowGV['cate_id']);
                                    for ($i = 0; $i < count($cate); $i++) {
                                        if ($cate[$i] == $cate_id) {
                                            $arr_teacher2[$rowGV['user_id']]['user_id'] = $rowGV['user_id'];
                                            $arr_teacher2[$rowGV['user_id']]['user_name'] = $rowGV['user_name'];
                                        }
                                    }
                                }

                                foreach ($arr_teacher2 as $key => $value) {
                                    $teacher = $teacher . '<option value="' . $value['user_id'] . '">' . $value['user_name'] . '</option>';
                                }
                            }
                            echo $teacher;
                            ?>
                        </select>
                    </div>
                    <div class="selecboloc">
                        <select name="prices" id="prices" onchange="v_filter_online()">
                            <option value="0">GIÁ HỌC</option>
                            <option value="1">GIÁ TỪ CAO ĐẾN THẤP</option>
                            <option value="2">GIÁ TỪ THẤP ĐẾN CAO</option>
                        </select>
                    </div>
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
        </div>


        <div class="l_bai_viet">
            <div class="mucluc">
                <?
                if ($course_type == 2) {
                    $cate_id = getValue('cate_id', 'int', 'GET', '');
                    $tag_id = getValue('tag_id', 'int', 'GET', '');
                    if ($cate_id != 0) {
                        $db_cate = new db_query("SELECT content_on,title_suggest_on,content_suggest_on FROM categories where cate_id = '$cate_id'");
                        $rows = mysql_fetch_assoc($db_cate->result);
                        $content = $rows['content_on'];
                        $title_suggest = $rows['title_suggest_on'];
                        $content_suggest = $rows['content_suggest_on'];
                        if (isset($content) && $content != '') {
                ?>
                            <div class="box_text_seo">
                                <div class="menu">
                                    <img src="../img/mucluc.png" class="l_img_mucluc" alt="mucluc">
                                    <img src="../img/l_bongden.png" alt="bongden" class="l_bongden">
                                    <? makeML($content, '', ''); ?>
                                </div>
                                <div class="l_content">
                                    <div class="nd">
                                        <?
                                        $content = str_replace('src=', 'src="/images/load.gif" class="lazyload" data-src=', $content);
                                        $content = str_replace('style="font-size:14px;"', '', $content);
                                        echo makeML_content($content, '', '');
                                        ?>
                                    </div>
                                    <?
                                    if (isset($title_suggest)) {
                                    ?>
                                        <div class="box_suggest">
                                            <div class="title_suggest"><?= $title_suggest ?></div>
                                            <div class="content_suggest">
                                                <?= $content_suggest ?>
                                            </div>
                                        </div>
                                    <?
                                    }
                                    ?>
                                </div>
                            </div>
                        <?
                        }
                    }

                    if ($tag_id != 0) {
                        $db_tag = new db_query("SELECT content_on,title_suggest_on,content_suggest_on FROM tags where tag_id = '$tag_id'");
                        $rows = mysql_fetch_assoc($db_tag->result);
                        $content = $rows['content_on'];
                        $title_suggest = $rows['title_suggest_on'];
                        $content_suggest = $rows['content_suggest_on'];
                        if (isset($content) && $content != '') {
                        ?>
                            <div class="box_text_seo">
                                <div class="menu">
                                    <img src="../img/mucluc.png" class="l_img_mucluc" alt="mucluc">
                                    <img src="../img/l_bongden.png" alt="bongden" class="l_bongden">
                                    <? makeML($content, '', ''); ?>
                                </div>
                                <div class="l_content">
                                    <div class="nd">
                                        <?
                                        $content = str_replace('src=', 'src="/images/load.gif" class="lazyload" data-src=', $content);
                                        $content = str_replace('style="font-size:14px;"', '', $content);
                                        echo makeML_content($content, '', '');
                                        ?>
                                    </div>
                                    <?
                                    if (isset($title_suggest)) {
                                    ?>
                                        <div class="box_suggest">
                                            <div class="title_suggest"><?= $title_suggest ?></div>
                                            <div class="content_suggest">
                                                <?= $content_suggest ?>
                                            </div>
                                        </div>
                                    <?
                                    }
                                    ?>
                                </div>
                            </div>
                <?
                        }
                    }
                }
                ?>
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
    <script type="text/javascript" src="../js/select2.min.js?v=<?= $version ?>"></script>
    <script type="text/javascript">
        $("#city2").select2();
        $("#course").select2();
        $("#teacher").select2();
        $("#subject").select2();
        $("#prices").select2();
        var cate_id = <?php echo $cate_id3; ?>;
        var tag_id = <?php echo $tag_id; ?>;

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
                // if (tag_id == course) {
                //     course = 0;
                // }
            }
            if (subject != cate_id) {
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