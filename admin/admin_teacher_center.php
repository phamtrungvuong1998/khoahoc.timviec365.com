<?php
require_once '../includes/Admin_insert.php';
$db_count = new db_query("SELECT count(center_teacher_id) as total FROM user_center_teacher");
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danh sách Giảng viên của trung tâm</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
        .alert-success {
            position: fixed;
            width: 20%;
            top: 20px;
            right: 1%;
            z-index: 1;
            background: #dff0d8;
            color: #3c763d;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        #action5 {
            display: block;
        }

        #list_5 {
            background: #18191b;
            border-left: 8px solid #13895F;
        }

        .v_detail_student textarea {
            width: 100%;
        }

        #title_manager {
            width: 100%;
        }

        [id*=admin_edit],
        [id*=remove] {
            cursor: pointer;
            width: 12px;
            height: 12px;
            margin: 0;
            padding: 0;
            border: 0;
            outline: 0;
            font-weight: inherit;
            font-style: inherit;
            vertical-align: baseline;
        }

        .manager {
            display: contents;
        }

        #v_info_ad {
            display: block;
        }

        .v_detail_student {
            display: flex;
            padding-bottom: 20px;
        }

        .v_detail_student>div:first-child {
            flex-basis: 20%;
            text-align: left;
        }

        .v_detail_student>div:last-child {
            flex-basis: 60%;
        }

        .v_detail_student>div:last-child>input,
        .v_detail_student>div:last-child>select {
            width: 100%;
        }

        #update_student {
            border: none;
            background: orange;
            color: white;
            padding: 2px 10px;
        }

        .city {
            flex-basis: 20% !important;
        }

        .l_content {
            width: 95%;
            margin: 30px auto;
            display: table;
            border-collapse: collapse;
            background: white;
        }

        .l_table-cell {
            display: table-cell;
            padding: 20px 10px 20px 10px;
        }

        .l_noidungkh {
            display: table-row;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .l_content-title {
            border: 1px solid rgba(0, 0, 0, 0.1);
            display: table-row;
            background: #F4F2FF;
            font-weight: 700;
            color: #1B6AAB;
            border-radius: 8px 8px 0 0;
        }

        .l_phantrang_btn {
            margin-right: 10px;
            padding: 6px 12px;
            background: no-repeat;
            outline: none;
            opacity: 0.7;
            border: 1px solid rgba(0, 0, 0, 0.3);
            box-sizing: border-box;
            border-radius: 4px;
        }

        .l_phantrang_btn1 {
            margin-right: 10px;
            padding: 6px 12px;
            background: no-repeat;
            outline: none;
            border: 1px solid rgba(0, 0, 0, 0.3);
            box-sizing: border-box;
            border-radius: 4px;
            background: #1B6AAB;
            color: rgb(255, 255, 255);
        }

        .l_phantrang {
            text-align: center;
        }

        .l_form {
            height: 100px;
        }

        #thongbao {
            font-size: 24px;
            text-align: center;
            color: #1B6AAB;
        }
    </style>
</head>

<body>
    <!-- Left column -->
    <div class="templatemo-flex-row">
        <?php require_once '../includes/Admin_sidebar.php'; ?>
        <!-- Main content -->
        <div class="templatemo-content col-1 light-gray-bg">
            <?php require_once '../includes/Admin_nav.php'; ?>
            <center id="v_info_ad">
                <div id="alert"></div>
                <div id="boloc">
                    <form class="l_form">
                        <div class="boloc chon">
                            <span class="bolocspan">Chọn trung tâm :</span>
                            <select id="ma" onchange="l_search(1)">
                                <option value="">--Chọn--</option>
                                <?
                                $db_center = new db_query("SELECT * FROM users WHERE user_type = 3");
                                while ($row = mysql_fetch_assoc($db_center->result)) {
                                ?>
                                    <option value="<? echo $row['user_id'] ?>"><? echo $row['user_name'] ?></option>
                                <?
                                }
                                ?>
                            </select>
                        </div>
                        <div class="boloc chon">
                            <span class="bolocspan">Chọn tên giảng viên :</span>
                            <select id="teacher_name" onchange="l_search(1)">
                                <option value="">--Chọn--</option>
                                <?
                                $db_center = new db_query("SELECT * FROM user_center_teacher");
                                while ($row = mysql_fetch_assoc($db_center->result)) {
                                ?>
                                    <option value="<? echo $row['teacher_name'] ?>"><? echo $row['teacher_name'] ?></option>
                                <?
                                }
                                ?>
                            </select>
                        </div>
                        <div class="boloc chon">
                            <span class="bolocspan">Từ ngày :</span>
                            <input type="date" id="fromdate" onchange="l_search(1)">
                        </div>
                        <div class="boloc chon">
                            <span class="bolocspan">Dến ngày :</span>
                            <input type="date" id="todate" onchange="l_search(1)">
                        </div>
                        <div class="boloc chon">
                            <a href="../code_xu_ly/l_xls_admin_teacher_center.php" id="v_href_exel"><button type="button" id="v_xls">XUẤT EXCEL</button></a>
                        </div>
                    </form>
                    <div class="l_content" id="l_content">
                        <div class="l_content-title">
                            <div class="l_table-cell">STT</div>
                            <div class="l_table-cell">MÃ TRUNG TÂM</div>
                            <div class="l_table-cell">TÊN GIẢNG VIÊN</div>
                            <div class="l_table-cell">MÔN HỌC GIẢNG DẠY</div>
                            <div class="l_table-cell">TRÌNH ĐỘ CHUYÊN MÔN</div>
                            <div class="l_table-cell">NGÀY THAM GIA</div>
                            <div class="l_table-cell">ACTION</div>
                        </div>
                        <?
                        $arr = [];
                        if ($start < 0) {
                            echo '<div class = "l_font_size">Danh sách rỗng</div>';
                        } else {
                            $db_trans = new db_query("SELECT * FROM user_center_teacher order by center_teacher_id DESC LIMIT $start , $limit");
                            $i = 1;
                            while ($row = mysql_fetch_assoc($db_trans->result)) {
                                $arr[] = $row;
                        ?>
                                <div class="l_noidungkh" id="l_noidungkh">
                                    <div class="l_table-cell l_stt"><? echo $i; ?></div>
                                    <div class="l_table-cell "><? echo $row['user_id']; ?></div>
                                    <div class="l_table-cell "><? echo $row['teacher_name']; ?></div>
                                    <div class="l_table-cell ">
                                        <?
                                        $a = explode(',', $row['cate_id']);
                                        $b = 1;
                                        $j = '';
                                        foreach ($a as $value) {
                                            $db_teacher = new db_query("SELECT * FROM categories WHERE cate_id = $value ");
                                            $cate = mysql_fetch_assoc($db_teacher->result);
                                            echo $cate['cate_name'];
                                            if ($b == count($a)) {
                                                echo '';
                                            } else if ($b == count($a) - 1) {
                                                echo ', ';
                                            } else if ($b != count($a) + 1) {
                                                echo ', ';
                                            }
                                            $b++;
                                        }
                                        ?>
                                    </div>
                                    <div class="l_table-cell "><? echo $row['qualification']; ?></div>
                                    <div class="l_table-cell "><? echo date('d-m-Y',$row['date_join']); ?></div>
                                    <div class="l_table-cell l_stt"><a href="admin_update_teacher_center.php?id=<? echo $row['center_teacher_id']; ?>">Chỉnh sửa</a></div>
                                </div>
                        <?
                                $i++;
                            }
                        }

                        ?>
                    </div>
                    <div id="thongbao"></div>
                    <div class="l_phantrang" id="l_phantrang">
                        <?
                        if ($current_page > 1 && $total_page > 1) {
                            echo '<a class="l_phantrang_btn" href="admin_teacher_center.php?page=' . ($current_page - 1) . '">&lt;</a>';
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $current_page) {
                                echo '<span class="l_phantrang_btn1">' . $i . '</span>';
                            } else {
                                echo '<a class="l_phantrang_btn" href="admin_teacher_center.php?page=' . $i . '">' . $i . '</a>';
                            }
                        }
                        if ($current_page < $total_page && $total_page > 1) {
                            echo '<a class="l_phantrang_btn" href="admin_teacher_center.php?page=' . ($current_page + 1) . '">&gt;</a>';
                        }
                        ?>
                    </div>
                    <div class="title_input" id="title_manager">
                    </div>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#ma").select2();
        $("#teacher_name").select2();
        $("#trans_id").select2();
        $("#gv_tt").select2();
        // $("#fromdate").select2();
    });

    // function l_trangthai(a, b) {
    //     console.log(b);
    //     //var tt = $('.l_thatbai').val();
    //     var data = new FormData();
    //     data.append('id', a);
    //     data.append('tt', b);
    //     $.ajax({
    //         url: '../ajax/admin_status_center.php',
    //         type: 'post',
    //         data: data,
    //         dataType: 'json',
    //         contentType: false,
    //         processData: false,
    //         success: function(response) {
    //             if (response.result == true) {
    //                 $("#alert").append('<div class="alert-success">' + response.message + '</div>');
    //                 setTimeout(function() {
    //                     $(".alert-success").fadeOut(1000, function() {
    //                         $(".alert-success").remove();
    //                     });
    //                 }, 3000);
    //                 $("#status" + a).html('');
    //                 $("#status" + a).html(response.status);

    //             } else {
    //                 // $('.remove').remove();
    //                 // $('#thongbao').html('');
    //                 // $('#thongbao').html(response.message);
    //             }
    //         },
    //     });
    // }

    function l_search(page) {
        var ma = $('#ma').val();
        var name = $('#teacher_name').val();
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        // console.log(ma);
        var data = new FormData();
        data.append('page', page);
        data.append('ma', ma);
        data.append('teacher_name', name);
        data.append('fromdate', fromdate);
        data.append('enddate', todate);
        $.ajax({
            url: '../ajax/admin_search_teacher_center.php',
            type: 'post',
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.result == true) {
                    $('.l_noidungkh').remove();
                    $('#thongbao').html('');
                    $('#l_phantrang').html('');
                    $('#l_content').append(response.html);
                    $("#l_phantrang").html(response.phantrang);
                    // $('#title_manager').append(response.html)
                    // $('#v_paginition').html(response.phantrang)
                } else {
                    $('.l_noidungkh').remove();
                    // $('#l_phantrang').html('');
                    // $('#thongbao').html('');
                    // $('#thongbao').html(response.message);
                }
            },
        });

        if (ma == 0) {
            var get_id = '';
        } else {
            var get_id = '&id=' + ma;
        }

        if (name == '') {
            var get_name = '';
        } else {
            var get_name = '&name=' + name;
        }

        if (fromdate == '') {
            var get_fromdate = '';
        } else {
            var get_fromdate = '&fromdate=' + fromdate;
        }

        if (todate == '') {
            var get_todate = '';
        } else {
            var get_todate = '&todate=' + todate;
        }

        $("#v_href_exel").attr({
            'href': '../code_xu_ly/l_xls_admin_teacher_center.php?adminId=<? echo $_COOKIE['adm_id'] ?>' + get_id + get_name + get_fromdate + get_todate
        });
    }
</script>
<?php require_once '../includes/Admin_permission.php'; ?>

</html>