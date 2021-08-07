<?php
require_once '../includes/Admin_insert.php';
if ($_COOKIE['adm_type'] == 0) {
    $module = 6;
    $check = new db_query("SELECT * FROM admin_permission WHERE adm_id = $adm_id AND module_id = $module");
    if (mysql_num_rows($check->result) == 0) {
        header("location:/admin/index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lịch sử điểm trừ</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
    #action4 {
        display: block;
    }

    #history_point {
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
                <div class="title_input" id="title_manager">
                    <div id="manager">
                        <div class="v_title_student">No</div>
                        <div class="v_title_student">Tên</div>
                        <div class="v_title_student">Email</div>
                        <div class="v_title_student">Điểm trừ</div>
                        <div class="v_title_student">Lịch sử</div>
                    </div>
                    <?php 
        $i = 1;
        $user_id = $_GET['user_id'];
        $qr = new db_query("SELECT * FROM history_point JOIN users ON users.user_id = history_point.center_teacher_id WHERE center_teacher_id= $user_id ORDER BY history_point_id DESC LIMIT 0, 30");

        while ($rowHV = mysql_fetch_array($qr->result)) {
          if ($rowHV['user_active'] == 1) {
            $user_active = "checked";
          }else{
            $user_active = "";
          }
          if ($rowHV['user_type'] == 2) {
            $link = urlDetail_teacher($rowHV['user_id'],$rowHV['user_slug']);
          }elseif($rowHV['user_type'] == 3){
            $link = urlDetail_center($rowHV['user_id'],$rowHV['user_slug']);
          }
          ?>
                    <div class="manager" id="manager<?php echo $rowHV['user_id'];?>">
                        <div class="v_title_student"><?php echo $i; ?></div>
                        <div class="v_title_student"><a href="<?=$link?>"><?php echo $rowHV['user_name']; ?></a></div>
                        <div class="v_title_student"><?php echo $rowHV['user_mail']; ?></div>
                        <div class="v_title_student"><?php echo $rowHV['point_minus']; ?></div>
                        <div class="v_title_student"><?php echo $rowHV['history_date']; ?></div>
                    </div>
                    <?php
          $i++;
        }
        ?>
                </div>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>

<?php require_once '../includes/Admin_permission.php'; ?>

</html>