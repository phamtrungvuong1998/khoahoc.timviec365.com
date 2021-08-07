<?php
require_once '../code_xu_ly/h_manager_GV.php';
$db_count = new db_query("SELECT count(transaction_id) FROM user_transaction WHERE user_id = $cookie_id");
$rowCount = mysql_fetch_array($db_count->result);
$pa = $rowCount[0]/10;
$p = getValue('p','str','GET','');

$number_page = 10;

if (!isset($_GET['p']) || $p == 1) {
    $start = 0;
    $end = 10;
}else{
    $start = $number_page * ($p - 1);
    $end = 10;
}

if (!isset($_GET['p'])) {
    $p = 1;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <?php require_once '../includes/v_inc_GV_css.php'; ?>
    <link rel="stylesheet" href="../css/GV-lich-su-giao-dich.css?v=<?=$version?>">
    <script src="../js//v-main.js?v=<?=$version?>"></script>
    <style>
    #v_vi-kh {
        color: #1B6AAB;
    }

    #v_sidebar-tb-3 {
        display: block;
    }

    #v_ls-giao-dich {
        color: #1B6AAB;
    }
    @media(max-width: 1300px){
        #content{
            display: table;
            max-width: 95%;
        }
        #v_content-time{
            width: 95%;
        }
    }
    </style>
    <title>Page lịch sử rút tiền</title>
</head>

<body>
    <div id="v_wrapper" class="flex">
        <!-- Begin: sidebar -->
        <?php require_once("../includes/inc_GV_sidebar.php"); ?>
        <!-- End: sidebar -->

        <!-- Begin: main -->
        <div id="main">
            <!-- Begin: header -->
            <?php require_once '../includes/inc_GV_manager_header.php'; ?>
            <!-- End: header -->

            <!-- Begin: content -->
            <div id="content-box" class="flex">
                <center>
                    <div id="v_content-time">
                        <div class="v_content-time-input">
                            <label for="">Từ ngày</label>
                            <input type="date" id="daystart">
                        </div>
                        <div class="v_content-time-input" id="v_content-tim-ip-2">
                            <label for="">Đến ngày</label>
                            <input type="date" id="dayend">
                        </div>
                        <div id="content-time-btn">
                            <button><img class="lazyload" src="/img/load.gif" data-src="../img/clarity_export-line.svg" alt="Ảnh lỗi">XUẤT EXCEL</button>
                        </div>
                    </div>
                </center>
                <div id="content">
                    <div id="v_content-title">
                        <div class="v_content-title-div">MÃ GIAO DỊCH</div>
                        <div class="v_content-title-div">NỘI DUNG CHUYỂN TIỀN</div>
                        <div class="v_content-title-div">NGÀY GIAO DỊCH</div>
                        <div class="v_content-title-div">SỐ TIỀN RÚT</div>
                        <div class="v_content-title-div">TRẠNG THÁI</div>
                    </div>

                    <div id="filter">
                        <?php 
                        $dbt = new db_query("SELECT * FROM user_transaction WHERE user_id = $cookie_id ORDER BY transaction_id DESC LIMIT $start,$end");
                        if (mysql_num_rows($dbt->result)==0) {
                                echo '<div >Chưa có dữ liệu</div>';
                            }else{
                                while ($rowt = mysql_fetch_array($dbt->result)) {
                            ?>
                        <div class="v_noidungkh" id="v_noidungkh-<?=$rowt['transaction_id'] ?>">
                            <div class="v_content-list"><?=$rowt['transaction_id'] ?> </div>
                            <div class="v_content-list"><?=$rowt['transaction_content'] ?></div>
                            <div class="v_content-list"><?=date("d-m-Y", $rowt['created_at'])?></div>
                            <div class="v_content-list v_trungtam">
                                <?=number_format($rowt['withdrawal_amount']) ?> đ
                            </div>
                            <div class="v_content-list"><?php
                            if ($rowt['status'] == 0) {
                                echo 'Đang chờ';
                            }else if($rowt['status'] == 1){
                                echo 'Thất bại';
                            }else if($rowt['status'] == 2){
                                echo 'Thành công';
                            }
                            ?></div>
                        </div>
                        <?php
                                }
                            } ?>
                    </div>
                </div>

                <div id="filter2">
                    <?php $dbt2 = new db_query("SELECT * FROM user_transaction WHERE user_id = $cookie_id ORDER BY transaction_id DESC LIMIT $start,$end");
                        while($rowt = mysql_fetch_array($dbt2->result)){
                            if($rowt['plus_minus'] == 0){
                                $plus = "-";
                            }else{
                                $plus = "+";
                            } 
                ?>
                    <div class="v_content-mb">
                        <div class="flex v_info-all v_content-mb-div">
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã giao dịch :</span>
                                <?=$rowt['transaction_id'] ?>
                            </div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Nội dung chuyển tiền :
                                </span><?=$rowt['transaction_content'] ?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ngày giao dịch :</span>
                                <?=date("d-m-Y", $rowt['created_at'])?></div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số tiền rút
                                    :</span>
                                <?=number_format($rowt['withdrawal_amount']) ?> đ</div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Trạng thái :</span>
                                <?php
                            if ($rowt['status'] == 0) {
                                echo 'Đang chờ';
                            }else if($rowt['status'] == 1){
                                echo 'Thất bại';
                            }else if($rowt['status'] == 2){
                                echo 'Thành công';
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div id="v_chuyentrang">
                    <a class="v_chuyen-trang-div" href="<?php if($p == 1){
                        echo '/giang-vien-lich-su-giao-dich/id' . $_COOKIE['user_id'] . '-p1.html';
                        }else{
                            echo '/giang-vien-lich-su-giao-dich/id' . $_COOKIE['user_id'] . '-p' . ($p-1).'.html';
                        } ?>">&lt;</a>
                        <?php for ($i = 0; $i  < $pa ; $i++) {
                            ?>
                            <a href="/giang-vien-lich-su-giao-dich/id<?php echo $_COOKIE['user_id']; ?>-p<?php echo $i  + 1; ?>.html"
                                class="v_chuyen-trang-div <?php if($p == ($i+1)){
                                    echo "p_active";
                                } ?>"><?php echo $i + 1; ?></a>
                            <?php } ?>
                            <a href="<?php if($p == $i){
                                echo '/giang-vien-lich-su-giao-dich/id' . $_COOKIE['user_id'] . '-p'. ($i) .'.html';
                                }else{
                                    echo '/giang-vien-lich-su-giao-dich/id' . $_COOKIE['user_id'] . '-p' . ($p+1).'.html';
                                } ?>" class="v_chuyen-trang-div">&gt;</a>
                </div>
            </div>
            <!-- End: content -->

        </div>
        <!-- End: main -->
    </div>

    <!-- Begin: foooter -->
    <?php require_once("../includes/h_inc_footer.php"); ?>
    <!-- End: footer -->
    <script src="../js/bootstrap.min.js?v=<?=$version?>"></script>
    <script src="../js/v-main.js?v=<?=$version?>"></script>
    <script>
    $(document).ready(function() {
        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd'
        });
        $(function() {
            $("#from_date").datepicker();
            $("#to_date").datepicker();
        });
        // $.datepicker.setDefaults({
        //     dateFormat: 'd-m-Y'
        // });
        // $(function() {
        //     $("#dayend").datepicker();
        //     $("#daystart").datepicker();
        // })

        $("#daystart").click(function() {
            $("#dayend").datepicker();
            var cookie_id = <?=$cookie_id?>;
            var search = $("#dayend").val();
            console.log(search);
            var type = "lsgiaodich";
            // if (search != '') {
            //     $.ajax({
            //         url: "../ajax/h_ajax_filter.php",
            //         method: "POST",
            //         data: {
            //             cookie_id: cookie_id,
            //             search: search,
            //             type: type
            //         },
            //         dataType: "text",
            //         success: function(data) {
            //             $("#filter").html(data);
            //         }
            //     });
            // } else {
            //     $("#filter").html("");
            // }
        });
    });
    </script>
</body>

</html>