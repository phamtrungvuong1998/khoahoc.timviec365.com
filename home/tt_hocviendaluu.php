<?

include '../includes/v_insert_TT.php';
$db_count = new db_query("SELECT count(save_id) as total FROM save_student WHERE user_teacher_id = " . $user_id);
$row1 = mysql_fetch_assoc($db_count->result);
$total_records = $row1['total'];
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 6;
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
    <title>Danh sách học viên</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <?php
    include '../includes/l_inc_head.php';
    ?>
    <link rel="stylesheet" href="../css/tt_hocviendaluu.css?v=<?=$version?>">
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
            <div class="l_content">

                <? if ($start < 0) {
                    echo '<div class = "l_font_size">Danh sách rỗng</div>';
                } else {
                    $db_student = new db_query("SELECT save_student.save_id ,users.user_id,users.user_slug, users.user_avatar,users.user_name,users.user_birth,users.cate_id,users.district_id,city.cit_id,city.cit_name FROM save_student JOIN users ON save_student.user_student_id = users.user_id JOIN city ON users.cit_id = city.cit_id Where save_student.user_teacher_id = '$user_id' AND users.user_type = 1 ORDER BY save_id DESC LIMIT $start , $limit");

                    while ($row = mysql_fetch_assoc($db_student->result)) {
                ?>
                        <div class="l_content_item">
                            <div class="l_item_img">
                                <img class="l_img lazyload" src="/img/load.gif" data-src="<? echo '../img/avatar/' . $row['user_avatar']; ?>" alt="loading...">
                            </div>
                            <div class="l_item_name"><? echo $row['user_name'] ?></div>
                            <div class="l_monhoc">
                                <div class="l_monhoc_img">
                                    <img class="lazyload" src="/img/load.gif" data-src="../img/image/monhoc.svg" alt="loading...">
                                </div>
                                <div class="l_tenmonhoc">
                                    Môn học quan tâm :
                                    <?
                                    $a = explode(',', $row['cate_id']);
                                    $i = 0;
                                    $j = '';
                                    foreach ($a as $b) {
                                        $db_cat = new db_query("SELECT cate_name FROM categories WHERE cate_id =" . $b);
                                        while ($value = mysql_fetch_assoc($db_cat->result)) {
                                            if ($i == count($a) - 1) {
                                                echo $j . $value['cate_name'];
                                            } else {
                                                echo $j . $value['cate_name'] . ', ';
                                            }
                                            $i++;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="l_monhoc">
                                <div class="l_monhoc_img">
                                    <img class="lazyload" src="/img/load.gif" data-src="../img/image/lichhoc.svg" alt="loading...">
                                </div>
                                <div class="l_tenmonhoc1">
                                    <? $r = date_create($row['user_birth']);
                                    echo date_format($r, "d/m/Y");
                                    ?>
                                </div>
                            </div>
                            <div class="l_monhoc">
                                <div class="l_monhoc_img">
                                    <img class="lazyload" src="/img/load.gif" data-src="../img/image/map.svg" alt="loading...">
                                </div>
                                <div class="l_tenmonhoc1">
                                    <?
                                    $db_city = new db_query("SELECT cit_name FROM city where cit_id =" . $row['district_id']);
                                    $city = mysql_fetch_assoc($db_city->result);
                                    echo $city['cit_name'];
                                    echo ' - ' . $row['cit_name'];
                                    ?>
                                </div>
                            </div>
                            <div class="l_sukien">
                                <div class="l_xemthem">
                                    <a href="/<? echo $row['user_slug'] . '-student' . $row['user_id'] . '.html'; ?>">XEM THÊM</a>
                                </div>
                                <div class="l_btn_item">
                                    <button onclick="l_index_popup(<? echo $row['save_id']; ?>)" class="l_btnXoa">XÓA</button>
                                </div>
                            </div>
                            <!-- modal -->
                            <div id="l_myModal<? echo $row['save_id']; ?>" class="modal">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span onclick="l_close_popup(<? echo $row['save_id']; ?>);" class="close">&times;</span>
                                        <h2>Thông báo</h2>
                                    </div>
                                    <div class="modal-body">
                                        <p>Bạn có muốn xóa học viên khỏi trung tâm không ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="l_text_popup">
                                            <button onclick="l_delete(<? echo $row['save_id']; ?>,<? echo $total_records; ?>,<? echo $limit; ?>,<? echo $current_page; ?>)" class="l_btn_popup">Đồng ý</button>
                                            <button onclick="l_close_popup(<? echo $row['save_id']; ?>);" id="l_cancel" class="l_btn_popup l_color">Quay lại</button>
                                        </div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?
                    }
                }
                ?>
            </div>
            <div class="l_phantrang">
                <?
                if ($current_page > 1 && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-hoc-vien-da-luu/id' . $user_id . '&page' . ($current_page - 1) . '.html ">&lt;</a>';
                }

                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="l_phantrang_btn1">' . $i . '</span>';
                    } else {
                        echo '<a class="l_phantrang_btn" href="/trung-tam-hoc-vien-da-luu/id' . $user_id . '&page' . $i . '.html ">' . $i . '</a>';
                    }
                }
                if ($current_page < $total_page && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-hoc-vien-da-luu/id' . $user_id . '&page' . ($current_page + 1) . '.html">&gt;</a>';
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
    function l_delete(id, nums, limit, page) {
        // var kq = confirm('Bạn có muốn xóa học viên khỏi trung tâm không ?');
        // if (kq == true) {
            var data = new FormData();
            data.append('id', id);
            console.log(id);
            data.append('nums', nums);
            data.append('limit', limit);
            data.append('page', page);
            $.ajax({
                url: "../ajax/l_ajax_xoahocvien.php",
                type: "post",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.result == true) {
                        // console.log(response.message)
                        // alert(response.message);
                        window.location.href = '/trung-tam-hoc-vien-da-luu/id<? echo $user_id ?>&page' + response.pagenew + '.html';
                    } else {
                        alert(response.message)
                    }
                },
            });
        // }
    }
    function l_index_popup(a) {
        document.getElementById("l_myModal"+a).style.display = "block";
    }

    function l_close_popup(a) {
        document.getElementById("l_myModal"+a).style.display = "none";
    }
</script>

</html>