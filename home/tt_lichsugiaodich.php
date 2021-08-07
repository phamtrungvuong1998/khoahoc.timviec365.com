<?
include '../includes/v_insert_TT.php';
$db_count = new db_query("SELECT count(transaction_id) as total FROM user_transaction WHERE user_id = " . $user_id);
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
    <title>Lịch sử giao dịch</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <?php
    include '../includes/l_inc_head.php';
    ?>
    <link rel="stylesheet" href="../css/tt_lichsugiaodich.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/datepicker.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/v_tt-mb.css?v=<?=$version?>">
    <style>
        .l_content{
            overflow-x: auto;
            display: block;
            max-width: 985px;
            white-space: nowrap;
        }
        .l_chucnang{
            max-width: 985px;
        }
        .l_content-list p{
            overflow: hidden;
            width: 50%;
            text-overflow: ellipsis;
            -webkit-line-clamp: 1;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            color: rgba(0, 0, 0, 0.54);
            line-height: 19px;
        }
        #tt_nap_tien{
            color: rgba(0, 0, 0, 0.7);
        }
    </style>
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

            <div class="l_title">
                <hr class="l_hr">
                <div class="l_title_text">LỊCH SỬ GIAO DỊCH</div>
            </div>
            <div class="l_chucnang l_height">
                <div>
                    <?
                    $m = date('m');
                    $y = date('Y');
                    $date = mktime(00, 00, 00, $m, 1, $y);
                    ?>
                    Từ ngày: <input name="date" type="date" id="from_date" value="" class="l_input" onchange="l_loc(1)">
                </div>
                <div>
                    Đến ngày: <input name="date" type="date" id="to_date" value="<? echo date("Y-m-t", $date); ?>" class="l_input" onchange="l_loc(1)">
                </div>
                <div class="l_absolute">
                    <a href="../code_xu_ly/l_excels.php">
                        <button class="l_btn_excel">
                            <img src="/img/load.gif" data-src="../img/image/excel.svg" alt="" class="lazyload l_img_excel"> XUẤT EXCEL
                        </button>
                    </a>
                </div>
            </div>


            <div class="l_content" id="l_content">
                <?
                $arr = [];
                $thongbao = '';
                if ($start < 0) {
                    $thongbao = '<div class = "l_font_size">Danh sách rỗng</div>';
                } else {
                    ?>
                    <div class="l_content-title">
                        <div class="l_table-cell">STT</div>
                        <div class="l_table-cell">MÃ GIAO DỊCH</div>
                        <div class="l_table-cell">NỘI DUNG CHUYỂN TIỀN</div>
                        <div class="l_table-cell">NGÀY GIAO DỊCH</div>
                        <div class="l_table-cell">SỐ TIỀN RÚT</div>
                        <div class="l_table-cell">TRẠNG THÁI</div>
                    </div>
                    <?
                    $db_trans = new db_query("SELECT transaction_id,created_at,transaction_code,transaction_content,transaction_date,withdrawal_amount,total_money,plus_minus,status FROM user_transaction Where user_id = '$user_id' ORDER BY transaction_id DESC LIMIT $start , $limit");
                    $i = 1;
                    while ($row = mysql_fetch_assoc($db_trans->result)) {
                        $arr[] = $row;
                ?>
                        <div class="l_noidungkh" id="l_noidungkh">
                            <div class="l_table-cell l_stt"><? echo $i; ?></div>
                            <div class="l_table-cell "><? echo $row['transaction_id']; ?></div>
                            <div class="l_table-cell l_content-list"><p><? echo $row['transaction_content']; ?></p></div>
                            <div class="l_table-cell">
                                <div>
                                    <?php
                                    // $date = date_create();
                                    $a = $row['transaction_date'];
                                    $time = strtotime($a);
                                    echo date("d-m-Y H:i:s",$time);
                                    // date_timestamp_set($date, $a);
                                    // echo date_format($date, "d-m-Y") . ' - ' . date_format($date, "H:i:s");
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
                            <div class="l_table-cell l_sodu"><? 
                            if ($row['status'] == 0) {
                                echo "Đang chờ";
                            }else if($row['status'] == 1){
                                echo "thất bại";
                            }else{
                                echo "thành công";
                            }
                            ?></div>
                        </div>
                <?
                        $i++;
                    }
                }
                ?>
            </div>
            <div id="l_thongbao"><? echo $thongbao; ?></div>
            <div class="l_mobile">
                <?php
                $j = 1;
                foreach ($arr as $value) {
                ?>
                    <center>
                        <div class="v_content-mb">
                            <div class="flex v_content-mb-div">
                                <p class="v_content-mb-title"><? echo $j; ?></p>
                            </div>

                            <div class="flex v_info-all v_content-mb-div">
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã đơn hàng : </span><? echo $value['transaction_code']; ?></div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Nội dung chuyển tiền : </span><?php echo $value['transaction_content']; ?></div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ngày giao dịch : </span>
                                    <?php
                                    // $date = date_create();
                                    $a = $value['transaction_date'];
                                    $time = strtotime($a);
                                    echo date("d-m-Y H:i:s",$time);
                                    // $time = strtotime($a);
                                    // echo date("d-m-Y H-i-s",$time);
                                    // date_timestamp_set($date, $a);
                                    // echo date_format($date, "Y-m-d H:i:s");
                                    ?>
                                </div>
                                <div class="v_content-mb-thongtin
                            <?
                            if ($value['plus_minus'] == 0) {
                                echo 'l_color';
                            }
                            ?>"><span class="v_content-mb-span">Số tiền rút : </span>
                                    <?
                                    if ($value['plus_minus'] == 0) {
                                        echo "-" . format_number($value['withdrawal_amount']) . " ₫";
                                    } else {
                                        echo "+" . format_number($value['withdrawal_amount']) . " ₫";
                                    }
                                    ?>
                                </div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Trạng thái : </span><? 
                            if ($value['status'] == 0) {
                                echo "Đang chờ";
                            }else if($value['status'] == 1){
                                echo "thất bại";
                            }else{
                                echo "thành công";
                            }
                            ?></div>
                            </div>
                        </div>
                    </center>
                <?php
                    $j++;
                }
                ?>
            </div>
            <div class="l_phantrang">
                <?
                if ($current_page > 1 && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-lich-su-giao-dich/id' . $user_id . '&page' . ($current_page - 1) . '.html">&lt;</a>';
                }

                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="l_phantrang_btn1">' . $i . '</span>';
                    } else {
                        echo '<a class="l_phantrang_btn" href="/trung-tam-lich-su-giao-dich/id' . $user_id . '&page' . $i . '.html">' . $i . '</a>';
                    }
                }
                if ($current_page < $total_page && $total_page > 1) {
                    echo '<a class="l_phantrang_btn" href="/trung-tam-lich-su-giao-dich/id' . $user_id . '&page' . ($current_page + 1) . '.html">&gt;</a>';
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
<script src="../js/datepicker.js?v=<?=$version?>"></script>
<script>
    // $( "#from_date" ).datepicker();
    // var datepicker = new DatePicker(document.getElementById('from_date'));
    // var to_date = new DatePicker(document.getElementById('to_date'));
    // start_date = document.getElementById('from_date').value;
    // console.log(start_date);
    // start_date.onclick= function(){
    //     console.log(12313132);
    // };
    // $("input").change(function() {
    //     console.log(12313132);
    // });

    // $('input[name$="date"]').change(function(){
    //     console.log(12313132);
    // });

    function l_loc(p) {
        var from = $('#from_date').val();
        var to = $('#to_date').val();
        // console.log(to);
        if (from == '') {
            return false;
        }
        var arr = [];
        $.get("../ajax/l_ajax_search_date.php", {
            from: from,
            to: to,
            p: p
        }, function(data) {
            var arr = data.split("l_dsdasdas");
            if (arr.length == 1) {
                $('.l_absolute').html('');
                $('.l_noidungkh').remove();
                $('.v_content-mb').remove();
                $('.l_phantrang').html('');
                $('.l_no').html('');
                $('#l_thongbao').html('');
                $('#l_thongbao').append(arr[0]);
            } else {
                $('.l_absolute').html('');
                $('.l_noidungkh').remove();
                $('.v_content-mb').remove();
                $('.l_phantrang').html('');
                $('.l_no').html('');
                $('.l_content').append(arr[0]);
                $('.l_absolute').html(arr[1]);
                $('.l_mobile').append(arr[2]);
                $('.l_phantrang').html(arr[3]);
            }
        });
    }
</script>

</html>