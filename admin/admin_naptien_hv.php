<?php
require_once '../includes/Admin_insert.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danh sách khóa học offline</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
    #action7 {
        display: block;
    }

    #adm_naptien {
        background: #18191b;
        border-left: 8px solid #13895F;
    }

    #title_manager {
        width: 100%;
    }

    [id*=delete]{
    	width: 15px;
    	height: 15px;
    	cursor: pointer;
    }

    [id*=success]{
    	cursor: pointer;
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
    .v_detail_student>div:last-child>select,
    .v_detail_student>div:last-child>textarea {
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

    .muachung,
    .chungchi{
        width: 30% !important;
    }

    .trinhdo{
        width: 10% !important;
    }

    .levels{
        width: 100%;
    }

    .certification{
        flex-basis: 31% !important;
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
            <?php
            $qrId = new db_query("SELECT user_id FROM users WHERE user_type = 1 ORDER BY user_id DESC");
            $qrBank = new db_query("SELECT bank_id,bank_name FROM bank");
            $qrCit = new db_query("SELECT * FROM form_recharge");
            ?>
            <div id="v_filter">
                <div class="v_filter">
                    <span>ID học viên:</span>
                    <select name="" id="user_id" class="v_filter_select" onchange="v_filter_bank()">
                        <option value="0">ID học viên</option>
                        <?php while($row_id = mysql_fetch_array($qrId->result)){ ?>
                            <option value="<?=$row_id['user_id']?>"><?echo $row_id['user_id'];?></option> 
                        <?php } ?>
                    </select>
                </div>
                <div class="v_filter">
                    <span>Ngân hàng:</span>
                    <select name="" id="bank" class="v_filter_select" onchange="v_filter_bank()">
                        <option value="0">Ngân hàng</option>
                        <?php while($row_bank = mysql_fetch_array($qrBank->result)){ ?>
                            <option value="<?=$row_bank['bank_id']?>"><?echo $row_bank['bank_name'];?></option> 
                        <?php } ?>
                    </select>
                </div>
                <div class="v_filter">
                    <span>Hình thức chuyển tiền:</span>
                    <select name="" id="form_recharge" class="v_filter_select" onchange="v_filter_bank()">
                        <option value="0">Hình thức chuyển tiền</option>
                        <?php while($rowform = mysql_fetch_array($qrCit->result)){ ?>
                            <option value="<?=$rowform['form_recharge_id']?>"><?echo $rowform['form_recharge_name'];?></option> 
                        <?php } ?>
                    </select>
                </div>
                <div class="v_filter">
                    <span>Trạng thái:</span>
                    <select name="" id="status" class="v_filter_select" onchange="v_filter_bank()">
                        <option value="3">Trạng thái</option>
                        <option value="0">Đang chờ</option>
                        <option value="1">Thất bại</option>
                        <option value="2">Thành công</option>
                    </select>
                </div>
            </div>
            <div class="v_filter">
                <a href="../code_xu_ly/v_admin_xls_naptien.php?user_type=1&status=3" id="v_href_exel"><button id="v_xls">XUẤT EXCEL</button></a>
            </div>
            <center id="v_info_ad">
                <div class="title_input" id="title_manager">
                    <div id="manager">
                        <div class="v_title_student">No</div>
                        <div class="v_title_student">ID học viên</div>
                        <div class="v_title_student">Tên học viên</div>
                        <div class="v_title_student">Số tiền nạp</div>
                        <div class="v_title_student">Ngân hàng</div>
                        <div class="v_title_student">hình thức chuyển tiền</div>
                        <div class="v_title_student">Ngân hàng chuyển tiền</div>
                        <div class="v_title_student">Tên người chuyển tiền</div>
                        <div class="v_title_student">Số tài khoản chuyển tiền</div>
                        <div class="v_title_student">Thời gian chuyển tiền</div>
                        <div class="v_title_student">Nội dung chuyển tiền</div>
                        <div class="v_title_student">Trạng thái</div>
                        <div class="v_title_student">Xác nhận</div>
                        <div class="v_title_student">Thất bại</div>
                    </div>
                    <?php 
                    $i = 1;
                    $qr = new db_query("SELECT * FROM rechange_notice INNER JOIN users ON rechange_notice.user_id = users.user_id INNER JOIN bank ON rechange_notice.bank_id = bank.bank_id INNER JOIN form_recharge ON form_recharge.form_recharge_id = rechange_notice.recharge_form_id ORDER BY recharge_id ASC LIMIT 0,30");
                    $count = new db_query("SELECT recharge_id FROM rechange_notice");
                    $page = ceil(mysql_num_rows($count->result)/30);
                    while($rowHV = mysql_fetch_array($qr->result)){
                    	if ($rowHV['status_recharge'] == 0) {
                    		$status = "Đang chờ";
                    		$success = "";
                    		$danger = "";
                    	}else if ($rowHV['status_recharge'] == 1){
                    		$status = "Thất bại";
                    		$success = "disabled";
                    		$danger = "disabled checked";
                    	}else{
                    		$status = "Thành công";
                    		$success = "disabled checked";
                    		$danger = "disabled";
                    	}
                    ?>
                    <div class="manager" id="manager<?php echo $rowHV['recharge_id'];?>">
                        <div class="v_title_student"><?php echo $i; ?></div>
                        <div class="v_title_student"><?php echo $rowHV['user_id']; ?></div>
                        <div class="v_title_student"><?php echo $rowHV['user_name']; ?>
                        </div>
                        <div class="v_title_student"><?php echo number_format($rowHV['amount']); ?></div>
                        <div class="v_title_student"><?php echo $rowHV['bank_name']; ?></div>
                        <div class="v_title_student"><?php echo $rowHV['form_recharge_name']; ?></div>
                        <?php $qr_bank = new db_query("SELECT bank_name FROM bank WHERE bank_id = " . $rowHV['bank_recharge']);
                        $row_bank = mysql_fetch_array($qr_bank->result);
                        ?>
                        <div class="v_title_student"><?php echo $row_bank['bank_name']; ?></div>
                        <div class="v_title_student"><?php echo $rowHV['recharge_name']; ?></div>
                        <div class="v_title_student"><?php echo $rowHV['bank_account']; ?></div>
                        <div class="v_title_student"><?php echo date("d-m-Y",$rowHV['time_recharge']); ?></div>
                        <div class="v_title_student"><?php echo $rowHV['content_recharge']; ?></div>
                        <div class="v_title_student" id="v_status<?php echo $rowHV['recharge_id']; ?>"><?php echo $status; ?></div>
                        <div class="v_title_student"><input id="success<?php echo $rowHV['recharge_id']; ?>" onclick="v_success(<?php echo $rowHV['recharge_id'];?>,2)" type="checkbox" <?php echo $success; ?>></div>
                        <div class="v_title_student" id="delete<?php echo $rowHV['recharge_id']; ?>"><input id="danger<?php echo $rowHV['recharge_id']; ?>" onclick="v_success(<?php echo $rowHV['recharge_id'];?>,1)" type="checkbox" <?php echo $danger; ?>></div>
                            </div>
                            <?php
                            $i++;
                        }
                        ?>
                    </div>
                    <div id="v_paginition">
                        <ul id="v_ul_paginition">
                            <li id="v_previous" onclick="v_paging('previous')"><</li>
                            <?php for ($i = 1; $i <= $page; $i++) { ?>
                                <li id="v_pa<?=$i?>" class="v_pa" onclick="v_paging(<?=$i?>)"><?=$i?></li>
                            <?php } ?>
                            <li id="v_next" onclick="v_paging('next')">></li>
                        </ul>
                    </div>
                </center>
            </div>
        </div>
    </body>
    <script src="../js/jquery.js"></script>
    <script src="../js/select2.min.js"></script>
    <script type="text/javascript">
        $("#v_name").select2();
        $("#v_select_id").select2();
        $("#v_phone").select2();
        $("#v_email").select2();
        $("#v_pa1").css({
            background: '#1B6AAB',
            color: 'white'
        });

        $(".v_filter_select").select2();

        $("#v_previous").hide();
        if ($(".manager").length == <?php echo mysql_num_rows($count->result); ?>) {
            $("#v_next").hide();
        }

        function v_filter_bank() {
            var user_id = $("#user_id").val();
            if (user_id == 0) {
                var get_id = '';
            }else{
                var get_id = '&user_id='+user_id;
            }
            var bank = $("#bank").val();
            if (bank == 0) {
                var get_bank = '';
            }else{
                var get_bank = '&cate='+bank;
            }
            var form_recharge = $("#form_recharge").val();
            if (form_recharge == 0) {
                var get_form_recharge = '';
            }else{
                var get_form_recharge = '&form_recharge='+form_recharge;
            }

            var status = $("#status").val();
            if (status == 3) {
                var get_status = '&status=3';
            }else{
                var get_status = '&status='+status;
            }


            $("#v_href_exel").attr({'href': '../code_xu_ly/v_admin_xls.php?user_type=1'+get_id+get_bank+get_form_recharge+get_status});
            $.ajax({
                url: '../ajax/v_admin_list_naptien.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    user_id: user_id,
                    bank: bank,
                    form_recharge: form_recharge,
                    status: status,
                    page: 1
                },
                success: function (data) {
                    $('.manager').remove();
                    if (data.html == "") {
                        $("#manager").hide();
                        $("#v_paginition").remove();
                        $('#title_manager').append('<div id="no-list">Không có danh sách</div>');
                    }else{
                        $("#no-list").remove();
                        $("#manager").show();
                        $('#title_manager').append(data.html);
                        $('#v_paginition').html(data.v_paging);
                        $("#v_pa1").css({
                            background: '#1B6AAB',
                            color: 'white'
                        });
                        $("#v_previous").hide();
                        if ($(".v_pa").length == 1) {
                            $("#v_previous").remove();
                            $("#v_next").remove();
                            $(".v_pa").remove();
                        }
                    }
                }
            });
            
        }

        function v_paging(page) {
        	console.log($('#status').val());
            var user_id = $("#user_id").val();
            var bank = $("#bank").val();
            var form_recharge = $("#form_recharge").val();
            var status = $("#status").val();
            if (page == 'next') {
                for (var i = 0; i < $('.v_pa').length; i++) {
                    if ($(".v_pa")[i].style.background == "rgb(27, 106, 171)") {
                        page = i + 2;
                    }
                }
            }else if (page == 'previous') {
                for (var i = 0; i < $('.v_pa').length; i++) {
                    if ($(".v_pa")[i].style.background == "rgb(27, 106, 171)") {
                        page = i;
                    }
                }
            }

            // $("#v_href_exel").attr({'href': '../code_xu_ly/v_admin_xls.php?type=1&page='+page+get_id+get_name+get_phone+get_email+get_startTime+get_endTime});

            $.ajax({
                url: '../ajax/v_admin_list_naptien.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    user_id: user_id,
                    bank: bank,
                    form_recharge: form_recharge,
                    status: status,
                    page: page
                },
                success: function (data) {
                    $('.manager').remove();
                    if (data.html == "") {
                        $("#manager").hide();
                        $("#v_paginition").remove();
                        $('#title_manager').append('<div id="no-list">Không có danh sách</div>');
                    }else{
                        $("#no-list").remove();
                        $("#manager").show();
                        $('#title_manager').append(data.html);
                        $('#v_paginition').html(data.v_paging);
                        $("#v_pa1").css({
                            background: '#1B6AAB',
                            color: 'white'
                        });
                        $("#v_previous").hide();
                        if ($(".v_pa").length == 1) {
                            $("#v_previous").remove();
                            $("#v_next").remove();
                            $(".v_pa").remove();
                        }
                    }
                }
            });
            
        }

    function v_success(recharge_id,status) {
    	if (status == 1) {
    		$("#danger"+recharge_id)[0].disabled = true;
    		$("#danger"+recharge_id)[0].checked = true;
    		$("#success"+recharge_id)[0].disabled = true;
    		$("#v_status"+recharge_id).text("Thất bại");
    	}else{
    		$("#success"+recharge_id)[0].disabled = true;
    		$("#success"+recharge_id)[0].checked = true;
    		$("#danger"+recharge_id)[0].disabled = true;
    		$("#v_status"+recharge_id).text("Thành công");
    	}
    	$.ajax({
    		url: '../ajax/v_naptien_HV.php',
    		type: 'GET',
    		dataType: 'json)',
    		data: {
    			recharge_id: recharge_id,
    			status:status
    		},
    		success: function (data) {
    		}
    	});
    	
    }

</script>
<?php require_once '../includes/Admin_permission.php'; ?>

</html>