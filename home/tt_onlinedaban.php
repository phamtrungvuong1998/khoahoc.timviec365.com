<?
include "../includes/v_insert_TT.php";
$db_count = new db_query("SELECT count(order_id) as total FROM `orders` INNER JOIN users ON orders.user_student_id = users.user_id INNER JOIN courses ON orders.course_id = courses.course_id WHERE orders.course_type = 2 AND courses.user_id = '$user_id'");
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
    <title>Khóa học online đã bán</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <?php
    include '../includes/l_inc_head.php';
    ?>
    <link rel="stylesheet" href="../css/tt_onlinedaban.css?v=<?=$version?>">
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
                <div class="l_timkiem">
                    <button class="l_btn_timkiem"><img class="lazyload" src="/img/load.gif" data-src="../img/l_search.svg" alt="loading..."></button>
                    <input onchange="l_search(<? echo $user_id; ?>,<? echo $current_page ?>)" id="search" type="text" value="" class="l_input" placeholder="Nhập tìm kiếm tên môn học, mã đơn hàng">
                </div>
                <div class="l_excel">
                    <a href="../code_xu_ly/l_xls_onlinedaban.php">
                        <button class="l_btn_excel">
                            <img src="/img/load.gif" data-src="../img/l_excel.svg" alt="loading..." class="l_img_excel lazyload"> XUẤT EXCEL
                        </button>
                    </a>
                </div>
            </div>
            <div class="l_content">
                <?php
                // die();
                $arr = [];
                $thongbao = '';
                if ($start < 0) {
                    $thongbao = '<div class = "l_font_size">Danh sách rỗng</div>';
                } else {
                    ?>
                    <div class="l_content-title">
                        <div class="l_table-cell">MÃ ĐƠN HÀNG</div>
                        <div class="l_table-cell l_size">MÔN HỌC</div>
                        <div class="l_table-cell l_size2">TÊN HỌC VIÊN</div>
                        <div class="l_table-cell">NGÀY GIAO DỊCH</div>
                        <div class="l_table-cell">HỌC PHÍ</div>
                        <!-- <div class="l_table-cell">
                            <img src="../img/More.svg" alt="loading...">
                        </div> -->
                    </div>
                    <?
                    $db_order = new db_query("SELECT * FROM `orders` INNER JOIN users ON orders.user_student_id = users.user_id INNER JOIN courses ON orders.course_id = courses.course_id WHERE orders.course_type = 2 AND courses.user_id = '$user_id' ORDER BY order_id DESC LIMIT $start , $limit");
                    while ($row = mysql_fetch_assoc($db_order->result)) {
                        $arr[] = $row
                ?>
                        <div class="l_noidungkh">
                            <div class="l_table-cell l_table-text">
                                <?
                                echo $row['order_id'];
                                ?>
                            </div>
                            <div class="l_table-cell">
                            <a href="<? echo urlDetail_courseOnline($row['course_id'],$row['course_slug']); ?>"><p class="p">
                                <?
                                echo $row['course_name'];
                                ?></p></a>
                            </div>
                            <div class="l_table-cell l_madonhang">
                                <div class="l_table-cell">
                                    <div class="l_tenhocvien">
                                        <? echo $row['user_name']; ?>
                                    </div>
                                    <div class="l_lienhehocvien">
                                        <? echo $row['user_mail']; ?>
                                    </div>
                                    <div class="l_lienhehocvien">
                                        <? echo $row['user_phone']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="l_table-cell l_content-list"><? echo date('d-m-Y', $row['day_buy']); ?></div>
                            <div class="l_table-cell"><?php 
                            if ($row['price_promotional'] == -1) {
                                echo number_format($row['price_listed']) . " đ";
                            }else{
                                echo number_format($row['price_promotional']) . " đ";
                            }
                            ?></div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="thongbao"><? echo $thongbao; ?></div>
            <div class="mobile">
                <?php foreach ($arr as $value) { ?>
                    <center>
                        <div class="v_content-mb">
                            <div class="flex v_content-mb-div">
                                <p class="v_content-mb-title"><? echo $value['course_name'] ?></p>
                            </div>

                            <div class="flex v_info-all v_content-mb-div">
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã đơn hàng: </span><? echo $value['order_id'] ?></div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tên học viên: </span><? echo $value['user_name'] ?></div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Email: </span><? echo $value['user_mail'] ?></div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số điện thoại: </span><? echo $value['user_phone'] ?></div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ngày giao dịch: </span><? echo date('d-m-Y', $value['day_buy']); ?></div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Học phí: </span><? if ($value['price_promotional'] == -1) {
                                echo number_format($value['price_listed']) . " đ";
                            }else{
                                echo number_format($value['price_promotional']) . " đ";
                            } ?></div>
                            </div>
                        </div>
                    </center>
                <?php } ?>
            </div>
            <div class="l_phantrang">
                <?
                if ($current_page > 1 && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-khoa-hoc-online-da-ban/id' . $user_id . '&page' . ($current_page - 1) . '.html">&lt;</a>';
                }

                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="l_phantrang_btn1">' . $i . '</span>';
                    } else {
                        echo '<a class="l_phantrang_btn" href="/trung-tam-khoa-hoc-online-da-ban/id' . $user_id . '&page' . $i . '.html">' . $i . '</a>';
                    }
                }
                if ($current_page < $total_page && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-khoa-hoc-online-da-ban/id' . $user_id . '&page' . ($current_page + 1) . '.html">&gt;</a>';
                }
                ?>
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
<script>
    // $(document).ready(function(){
    //     $('#l_trangthai')
    // });
    function l_trangthai(p, id) {
        //var b = 'l_trangthai'+ id;
        var a = $('#l_trangthai' + id).val();
        // console.log(a);
        // return false;
        var data = new FormData();
        data.append('value', a);
        data.append('id', id);
        $.ajax({
            url: '../ajax/l_ajax_upStatusOn.php',
            type: 'post',
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.result == true) {
                    window.location.href = 'tt_onlinedaban.php?page=' + p;
                } else {
                    alert('cập nhật thất bại');
                }
            },
        });
    }

    function l_search(id, p) {
        var s = $('#search').val();
        // console.log(p);
        if (s == '') {
            if (p == 0) {
                p = 1;
                window.location.href = '/trung-tam-khoa-hoc-online-da-ban/id' + id + '&page' + p + '.html';
                return false;
            }else{
                window.location.href = '/trung-tam-khoa-hoc-online-da-ban/id' + id + '&page' + p + '.html';
                return false;
            }
        }
        $.get("../ajax/l_ajax_search_onlineDB.php", {
                search: s,
                p: p
            },
            function(data) {
                var arr = data.split("tachchuoi");
                if (arr.length == 1) {
                    $('.thongbao').html('');
                    $('.l_noidungkh').remove();
                    $('.l_excel').html('');
                    $('.v_content-mb').remove();
                    $('.l_phantrang').html('');
                    $('.thongbao').append(arr[0]);
                } else {
                    $('.thongbao').html('');
                    $('.l_noidungkh').remove();
                    $('.l_excel').html('');
                    $('.v_content-mb').remove();
                    $('.l_phantrang').html('');
                    $('.l_excel').html(arr[0]);
                    $('.l_content').append(arr[1]);
                    $('.mobile').append(arr[2]);
                    $('.l_phantrang').html(arr[3]);
                }
                // console.log(arr.length);
            }
        );
    }
</script>

</html>