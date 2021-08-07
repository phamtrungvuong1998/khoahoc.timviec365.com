<?
include '../includes/v_insert_TT.php';
$db_count = new db_query("SELECT count(history_point_id) as total FROM history_point WHERE center_teacher_id =" . $user_id);
$row1 = mysql_fetch_assoc($db_count->result);
$total_records = $row1['total'];
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$total_page = ceil($total_records / $limit);
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}
$start = ($current_page - 1) * $limit;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <title>Học viên mua từ điểm</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="../css/reset.css?v=<?=$version?>">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@200&display=swap" rel="stylesheet">
    <?php
    include '../includes/l_inc_head.php';
    ?>
    <link rel="stylesheet" href="../css/tt_hvMuaTuDien.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/v_tt-mb.css?v=<?=$version?>">
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


            <div class="l_chucnang">
                <!-- <div>
                    <button class="l_btn_boloc">
                        <img src="../img/l_bo-loc.svg" alt="loading..."> Bộ lọc
                    </button>
                </div> -->
                <div class="l_timkiem">
                    <button href="" class="l_btn_timkiem"><img class="lazyload" src="/img/load.gif" data-src="../img/l_search.svg" alt="loading..."></button>
                    <input onchange="l_search(<? echo $user_id; ?>,<? echo $current_page ?>)" id="l_search" type="text" value="" class="l_input" placeholder="Nhập tìm kiếm tên học viên, tên môn học">
                </div>
                <div class="l_excel">
                    <a href="../code_xu_ly/l_xls_muaTuDiem.php">
                        <button class="l_btn_excel">
                            <img class="lazyload" src="/img/load.gif" data-src="../img/l_excel.svg" alt="loading..." class="l_img_excel"> XUẤT EXCEL
                        </button>
                    </a>
                </div>
            </div>
            <div class="l_content">
                <?
                $arr = [];
                $thongbao = '';
                if ($start < 0) {
                    $thongbao = '<div class = "l_font_size">Danh sách rỗng</div>';
                } else {
                    ?>
                    <div class="l_content-title">
                        <div class="l_table-cell l_width">TÊN HỌC VIÊN</div>
                        <div class="l_table-cell l_madonhang">MÔN HỌC QUAN TÂM</div>
                        <div class="l_table-cell">ĐỊA CHỈ</div>
                        <div class="l_table-cell">
                            <img class="lazyload" src="/img/load.gif" data-src="../img/image/More.svg" alt="loading...">
                        </div>
                    </div>
                    <?
                    $db_point = new db_query("SELECT * FROM history_point INNER JOIN users ON user_student_id=users.user_id INNER JOIN city ON users.cit_id=city.cit_id Where center_teacher_id = '$user_id' ORDER BY history_point_id DESC LIMIT $start , $limit");

                    while ($row = mysql_fetch_assoc($db_point->result)) {
                        $arr[] = $row;

                        // echo "<pre>";
                        // print_r($a);
                        // echo "</pre>"
                ?>
                        <div class="l_noidungkh">
                            <div class="l_table-cell">
                                <div class="l_tenhocvien">
                                    <?php
                                    echo $row['user_name'];
                                    ?>
                                </div>
                                <div class="l_lienhehocvien">
                                    <?php
                                    echo $row['user_mail'];
                                    ?>
                                </div>
                                <div class="l_lienhehocvien">
                                    <?php
                                    echo $row['user_phone'];
                                    ?>
                                </div>
                            </div>
                            <div class="l_table-cell ">
                                <?
                                $cat = explode(',', $row['cate_id']);
                                $j = '';
                                $i = 0;
                                foreach ($cat as $value) {
                                    $db_cate = new db_query("SELECT cate_name FROM categories WHERE cate_id =" . $value);
                                    $a = mysql_fetch_assoc($db_cate->result);
                                    //echo $a['cate_name'];
                                    if ($i == count($cat) - 1) {
                                        echo $j . $a['cate_name'];
                                    } else {
                                        echo $j . $a['cate_name'] . ', ';
                                    }
                                    $i++;
                                }
                                ?>
                            </div>
                            <div class="l_table-cell l_content-list">
                                <?
                                $db_city = new db_query("SELECT cit_name FROM city where cit_id =" . $row['district_id']);
                                $city = mysql_fetch_assoc($db_city->result);
                                echo $city['cit_name'];
                                echo ' - ' . $row['cit_name'];
                                ?>
                            </div>

                            <div class="l_table-cell"><a href="<? echo urlDetail_student($row['user_id'], $row['user_slug']); ?>" class="l_xemthem">Xem thêm</a>
                            </div>
                        </div>
                <?
                    }
                }
                ?>
            </div>
            <div id="l_thongbao"><? echo $thongbao; ?></div>
            <div id="mobile">
                <?php
                if (count($arr) == 0) {
                    $thongbao = '<center><div class="v_content-mb l_font_size">Danh sách rỗng</div></center>';
                } else {
                    foreach ($arr as $value) {

                ?>
                        <center>
                            <div class="v_content-mb">
                                <!-- <div class="flex v_content-mb-div">
                        <p class="v_content-mb-title">Học SASS và cắt web từ file thiết kế Photoshop theo kiểu SASS...</p>
                        </div> -->

                                <div class="flex v_info-all v_content-mb-div">
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tên học viên: </span><? echo $value['user_name']; ?></div>
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mail: </span><? echo $value['user_mail']; ?></div>
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số điện thoại: </span><? echo $value['user_phone']; ?></div>
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học quan tâm: </span>
                                        <?
                                        $cat = explode(',', $value['cate_id']);
                                        $j = '';
                                        $i = 0;
                                        foreach ($cat as $b) {
                                            $db_cate = new db_query("SELECT cate_name FROM categories WHERE cate_id =" . $b);
                                            $a = mysql_fetch_assoc($db_cate->result);
                                            //echo $a['cate_name'];
                                            if ($i == count($cat) - 1) {
                                                echo $j . $a['cate_name'];
                                            } else {
                                                echo $j . $a['cate_name'] . ', ';
                                            }
                                            $i++;
                                        }
                                        ?>
                                    </div>
                                    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Địa chỉ: </span>
                                        <?
                                        $db_city = new db_query("SELECT cit_name FROM city where cit_id =" . $value['district_id']);
                                        $city = mysql_fetch_assoc($db_city->result);
                                        echo $city['cit_name'];
                                        echo ' - ' . $value['cit_name'];
                                        ?>
                                    </div>
                                    <a href="<? echo urlDetail_student($value['user_id'], $value['user_slug']); ?>"><div class="v_content-mb-thongtin"><span class="v_content-mb-span">Xem thêm</span></div></a>
                                </div>
                            </div>
                        </center>
                <?php }
                } ?>
            </div>
            <div class="l_phantrang">
                <?
                if ($current_page > 1 && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-hoc-vien-mua-tu-diem/id' . $user_id . '&page' . ($current_page - 1) . '.html">&lt;</a>';
                }

                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="l_phantrang_btn1">' . $i . '</span>';
                    } else {
                        echo '<a class="l_phantrang_btn" href="/trung-tam-hoc-vien-mua-tu-diem/id' . $user_id . '&page' . $i . '.html">' . $i . '</a>';
                    }
                }
                if ($current_page < $total_page && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-hoc-vien-mua-tu-diem/id' . $user_id . '&page' . ($current_page + 1) . '.html">&gt;</a>';
                }
                ?>
            </div>
        </div>
        <!-- end content -->
    </div>
    <!-- FOOTER -->
    <?php
    include '../includes/h_inc_footer.php';
    ?>
    <!-- END: FOOTER -->

</body>
<script src="../js/l_trungtam.js?v=<?=$version?>"></script>
<script>
    function l_search(id, p) {
        var s = $('#l_search').val();
        if (s == '') {
            if (p == 0) {
                p = 1;
                window.location.href = '/trung-tam-hoc-vien-mua-tu-diem/id' + id + '&page' + p + '.html';
                return false;
            } else {
                window.location.href = '/trung-tam-hoc-vien-mua-tu-diem/id' + id + '&page' + p + '.html';
                return false;
            }
        }
        $.ajax({
            url: '../ajax/l_ajax_search_MuaTD.php',
            type: 'GET',
            dataType: 'json',
            data: {
                search: s,
                page: p
            },
            success: function(response) {
                if (response.result == 2) {
                    $('#l_thongbao').html('');
                    $('.l_noidungkh').remove();
                    $('.l_excel').html('');
                    $('.v_content-mb').remove();
                    $('.l_phantrang').html('');
                    $('.l_excel').html(response.excel);
                    $('.l_content').append(response.pc);
                    $('#mobile').append(response.mobile);
                    $('.l_phantrang').html(response.phantrang);
                } else {
                    $('#l_thongbao').html('');
                    $('.l_noidungkh').remove();
                    $('.l_excel').html('');
                    $('.v_content-mb').remove();
                    $('.l_phantrang').html('');
                    $('#l_thongbao').html(response.message);
                }
            }
        });
        // $.get("../ajax/l_ajax_search_MuaTD.php", {
        //         search: s,
        //         p: p
        //     },
        //     function(data) {
        //         var arr = data.split("tachchuoi");
        //         if (arr.length == 1) {
        //             alert(arr[0]);
        //         } else {
        //             $('#l_thongbao').html('');
        //             $('.l_noidungkh').remove();
        //             $('.l_excel').html('');
        //             $('.v_content-mb').remove();
        //             $('.l_phantrang').html('');
        //             $('.l_excel').html(arr[0]);
        //             $('.l_content').append(arr[1]);
        //             $('#mobile').append(arr[2]);
        //             $('.l_phantrang').html(arr[3]);
        //         }
        //         console.log(arr.length);
        //     }
        // );
    }
</script>

</html>