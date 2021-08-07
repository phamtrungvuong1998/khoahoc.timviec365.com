<?php
require_once '../includes/Admin_insert.php';
$db_count = new db_query("SELECT count(transaction_id) as total FROM user_transaction INNer JOIN users ON users.user_id = user_transaction.user_id WHERE user_type = 3 OR user_type = 2");
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
    <title>Danh sách rút tiền tiền</title>
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
                            <span class="bolocspan">Giảng viên hoặc trung tâm :</span>
                            <select id="gv_tt" onchange="l_search(1)">
                                <option value="">--Chọn--</option>
                                <option value="2">Giảng viên</option>
                                <option value="3">Trung tâm</option>
                            </select>
                        </div>
                        <div class="boloc chon">
                            <span class="bolocspan">Mã giao dịch :</span>
                            <select id="trans_id" onchange="l_search(1)">
                                <option value="">--Chọn mã cần tìm--</option>
                                <?
                                $db_transaction = new db_query("SELECT transaction_code FROM user_transaction INNER JOIN users ON user_transaction.user_id = users.user_id WHERE user_type = 3 OR user_type = 2 ORDER BY transaction_id DESC");
                                while ($row = mysql_fetch_assoc($db_transaction->result)) {
                                ?>
                                    <option value="<? echo $row['transaction_code'] ?>"><? echo $row['transaction_code'] ?></option>
                                <?
                                }
                                ?>
                            </select>
                        </div>
                        <div class="boloc ten">
                            <span class="bolocspan">Tên :</span>
                            <select id="transname" onchange="l_search(1)">
                                <option value="">--Nhập tên cần tìm--</option>
                                <?
                                $db_trans_name = new db_query("SELECT distinct transaction_name FROM user_transaction INNER JOIN users ON user_transaction.user_id = users.user_id WHERE user_type = 3 OR user_type = 2 ORDER BY transaction_id DESC");
                                while ($row = mysql_fetch_array($db_trans_name->result)) {
                                ?>
                                    <option value="<?= $row['transaction_name']; ?>"><?= $row['transaction_name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="boloc chon">
                            <span class="bolocspan">Từ ngày :</span>
                            <input type="date" id="fromdate" onchange="l_search(1)">
                        </div>
                        <div class="boloc chon">
                            <span class="bolocspan">Đến ngày :</span>
                            <input type="date" id="todate" onchange="l_search(1)">
                        </div>
                        <div class="boloc chon">
                            <a href="../code_xu_ly/l_xls_admin_transaction_center.php" id="v_href_exel"><button type="button" id="v_xls">XUẤT EXCEL</button></a>
                        </div>
                    </form>
                    <div class="l_content" id="l_content">
                        <div class="l_content-title">
                            <div class="l_table-cell">STT</div>
                            <div class="l_table-cell">MÃ GIAO DỊCH</div>
                            <div class="l_table-cell">TÊN CHỦ TÀI KHOẢN</div>
                            <div class="l_table-cell">NỘI DUNG CHUYỂN TIỀN</div>
                            <div class="l_table-cell">NGÀY GIAO DỊCH</div>
                            <div class="l_table-cell">SỐ TIỀN GIAO DỊCH</div>
                            <div class="l_table-cell">SỐ DƯ</div>
                            <div class="l_table-cell">TRẠNG THÁI</div>
                            <div class="l_table-cell">THÀNH CÔNG</div>
                            <div class="l_table-cell">THẤT BẠI</div>
                        </div>
                        <?
                        $arr = [];
                        if ($start < 0) {
                            echo '<div class = "l_font_size">Danh sách rỗng</div>';
                        } else {
                            $db_trans = new db_query("SELECT transaction_id,transaction_name,user_transaction.created_at,transaction_code,transaction_content,transaction_date,withdrawal_amount,total_money,plus_minus,status FROM user_transaction INNER JOIN users ON user_transaction.user_id = users.user_id WHERE user_type = 3 OR user_type = 2 ORDER BY transaction_id DESC LIMIT $start , $limit");
                            $i = 1;
                            while ($row = mysql_fetch_assoc($db_trans->result)) {
                                $arr[] = $row;
                        ?>
                                <div class="l_noidungkh" id="l_noidungkh">
                                    <div class="l_table-cell l_stt"><? echo $i; ?></div>
                                    <div class="l_table-cell "><? echo $row['transaction_code']; ?></div>
                                    <div class="l_table-cell "><? echo $row['transaction_name']; ?></div>
                                    <div class="l_table-cell l_content-list"><? echo $row['transaction_content']; ?></div>
                                    <div class="l_table-cell">
                                        <div>
                                            <?
                                            $date = date_create();
                                            $a = $row['transaction_date'];
                                            date_timestamp_set($date, $a);
                                            echo date_format($date, "d-m-Y") . ' - ' . date_format($date, "H:i:s");
                                            ?>
                                        </div>
                                    </div>
                                    <div class="l_table-cell 
                                    <?
                                    if ($row['plus_minus'] == 0) {
                                        echo 'l_tiengiaodich1';
                                    } else {
                                        echo 'l_tiengiaodich';
                                    }
                                    ?>"><?
                                        if ($row['plus_minus'] == 0) {
                                            echo "-" . format_number($row['withdrawal_amount']) . " ₫";
                                        } else {
                                            echo "+" . format_number($row['withdrawal_amount']) . " ₫";
                                        }
                                        ?></div>
                                    <div class="l_table-cell l_sodu"><? echo format_number($row['total_money']) ?> đ</div>
                                    <div class="l_table-cell " id="status<? echo $row['transaction_id']; ?>">
                                        <?
                                        if ($row['status'] == 0) {
                                            echo "Đang chờ";
                                        } else if ($row['status'] == 1) {
                                            echo 'Thành công';
                                        } else {
                                            echo 'Thất bại';
                                        }
                                        ?>
                                    </div>
                                    <?
                                    if ($row['status'] == 0) {
                                    ?>
                                        <div class="l_table-cell">
                                            <input name="radio<? echo $row['transaction_id'] ?>" class="l_thanhcong" type="radio" id="tc<? echo $row['transaction_id'] ?>" value="1" onchange="l_trangthai(<? echo $row['transaction_id'] ?>,1)">
                                            <label for="tc<? echo $row['transaction_id'] ?>">Thành công</label>
                                        </div>
                                        <div class="l_table-cell">
                                            <input name="radio<? echo $row['transaction_id'] ?>" class="l_thatbai" type="radio" id="tb<? echo $row['transaction_id'] ?>" value="2" onchange="l_trangthai(<? echo $row['transaction_id'] ?>,2)">
                                            <label for="tb<? echo $row['transaction_id'] ?>">Thất bại</label>
                                        </div>
                                    <?
                                    } else if ($row['status'] == 1) {
                                    ?>
                                        <div class="l_table-cell">
                                            <input name="radio<? echo $row['transaction_id'] ?>" class="l_thanhcong" type="radio" id="tc<? echo $row['transaction_id'] ?>" value="1" onchange="l_trangthai(<? echo $row['transaction_id'] ?>,1)" checked>
                                            <label for="tc<? echo $row['transaction_id'] ?>">Thành công</label>
                                        </div>
                                        <div class="l_table-cell">
                                            <input name="radio<? echo $row['transaction_id'] ?>" class="l_thatbai" type="radio" id="tb<? echo $row['transaction_id'] ?>" value="2" onchange="l_trangthai(<? echo $row['transaction_id'] ?>,2)">
                                            <label for="tb<? echo $row['transaction_id'] ?>">Thất bại</label>
                                        </div>
                                    <?
                                    } else {
                                    ?>
                                        <div class="l_table-cell">
                                            <input name="radio<? echo $row['transaction_id'] ?>" class="l_thanhcong" type="radio" id="tc<? echo $row['transaction_id'] ?>" value="1" onchange="l_trangthai(<? echo $row['transaction_id'] ?>,1)">
                                            <label for="tc<? echo $row['transaction_id'] ?>">Thành công</label>
                                        </div>
                                        <div class="l_table-cell">
                                            <input name="radio<? echo $row['transaction_id'] ?>" class="l_thatbai" type="radio" id="tb<? echo $row['transaction_id'] ?>" value="2" onchange="l_trangthai(<? echo $row['transaction_id'] ?>,2)" checked>
                                            <label for="tb<? echo $row['transaction_id'] ?>">Thất bại</label>
                                        </div>
                                    <?
                                    }
                                    ?>
                                    
                                </div>
                        <?
                                $i++;
                            }
                        }
                        ?>
                        <!-- <input type="radio" id="male" name="gender" value="male">
                    <label for="male">Male</label><br> -->
                    </div>
                    <div id="thongbao"></div>
                    <div class="l_phantrang" id="l_phantrang">
                        <?
                        if ($current_page > 1 && $total_page > 1) {
                            echo '<a class="l_phantrang_btn" href="admin_transaction_center.php?page=' . ($current_page - 1) . '">&lt;</a>';
                        }

                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $current_page) {
                                echo '<span class="l_phantrang_btn1">' . $i . '</span>';
                            } else {
                                echo '<a class="l_phantrang_btn" href="admin_transaction_center.php?page=' . $i . '">' . $i . '</a>';
                            }
                        }
                        if ($current_page < $total_page && $total_page > 1) {
                            echo '<a class="l_phantrang_btn" href="admin_transaction_center.php?page=' . ($current_page + 1) . '">&gt;</a>';
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
        $("#transname").select2();
        $("#transtatus").select2();
        $("#trans_id").select2();
        $("#gv_tt").select2();
        // $("#fromdate").select2();
    });

    function l_trangthai(a, b) {
        console.log(b);
        //var tt = $('.l_thatbai').val();
        var data = new FormData();
        data.append('id', a);
        data.append('tt', b);
        $.ajax({
            url: '../ajax/admin_status_center.php',
            type: 'post',
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.result == true) {
                    $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                    setTimeout(function() {
                        $(".alert-success").fadeOut(1000, function() {
                            $(".alert-success").remove();
                        });
                    }, 3000);
                    $("#status" + a).html('');
                    $("#status" + a).html(response.status);

                } else {
                    // $('.remove').remove();
                    // $('#thongbao').html('');
                    // $('#thongbao').html(response.message);
                }
            },
        });
    }

    function l_search(page) {
        var ma = $('#trans_id').val();
        var name = $('#transname').val();
        var startdate = $('#fromdate').val();
        var enddate = $('#todate').val();
        var gv_tt = $('#gv_tt').val();
        // console.log(ma);
        var data = new FormData();
        data.append('page', page);
        data.append('ma', ma);
        data.append('transname', name);
        data.append('fromdate', startdate);
        data.append('enddate', enddate);
        data.append('type', gv_tt);
        $.ajax({
            url: '../ajax/admin_search_transaction_center.php',
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
                    $('#l_phantrang').html('');
                    $('#thongbao').html('');
                    $('#thongbao').html(response.message);
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

        if (startdate == '') {
            var get_startdate = '';
        } else {
            var get_startdate = '&startdate=' + startdate;
        }

        if (enddate == '') {
            var get_enddate = '';
        } else {
            var get_enddate = '&enddate=' + enddate;
        }

        if (gv_tt == '') {
            var get_gv_tt = '';
        } else {
            var get_gv_tt = '&gv_tt=' + gv_tt;
        }

        $("#v_href_exel").attr({
            'href': '../code_xu_ly/l_xls_admin_transaction_center.php?adminId=<? echo $_COOKIE['adm_id'] ?>' + get_id + get_name + get_startdate + get_enddate + get_gv_tt
        });
    }
</script>
<?php require_once '../includes/Admin_permission.php'; ?>

</html>