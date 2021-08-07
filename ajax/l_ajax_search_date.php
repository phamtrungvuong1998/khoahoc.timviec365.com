<?
require_once '../config/config.php';
$from_date = getValue('from', 'str', 'GET', '', '');
$to_date = getValue('to', 'str', 'GET', '', '');

$user_id = $_COOKIE['user_id'];
if ($from_date != '' && $to_date != '') {
    if ($from_date <= $to_date) {
        $from = strtotime($from_date);
        $to = strtotime($to_date);
        $db_count = new db_query("SELECT count(transaction_id) as total FROM user_transaction WHERE user_id = '$user_id' AND transaction_date >='$from' AND transaction_date <='$to'");
        $row = mysql_fetch_assoc($db_count->result);
        $total_records = $row['total'];
        if ($total_records > 0) {
            $current_page = isset($_GET['p']) ? $_GET['p'] : 1;
            $limit = 10;
            $total_page = ceil($total_records / $limit);
            if ($current_page > $total_page) {
                $current_page = $total_page;
            } else if ($current_page < 1) {
                $current_page = 1;
            }
            $start = ($current_page - 1) * $limit;
            $db_date = new db_query("SELECT transaction_id,created_at,transaction_code,transaction_content,transaction_date,withdrawal_amount,total_money,plus_minus FROM user_transaction WHERE user_id = '$user_id' AND transaction_date >='$from' AND transaction_date <='$to' ORDER BY transaction_id DESC LIMIT $start, $limit");
            $i = 1;
            $html = '';
            while ($row = mysql_fetch_assoc($db_date->result)) {
                $arr[] = $row;
                $html .= '<div class="l_noidungkh" id="l_noidungkh"><div class="l_table-cell l_stt"> ' . $i . '</div>
            <div class="l_table-cell ">' . $row['transaction_code'] . '</div>
            <div class="l_table-cell l_content-list">' . $row['transaction_content'] . '</div>
            <div class="l_table-cell">
                            <div>';
                $date = date_create();
                $a = $row['transaction_date'];
                date_timestamp_set($date, $a);
                $html .= date_format($date, "d-m-Y") . ' - ' . date_format($date, "H:i:s");
                $html .= '</div>
                        </div>
                        <div class="l_table-cell ';
                if ($row['plus_minus'] == 0) {
                    $html .= 'l_tiengiaodich1';
                } else {
                    $html .= 'l_tiengiaodich';
                }
                $html .= '">';
                if ($row['plus_minus'] == 0) {
                    $html .= "-" . format_number($row['withdrawal_amount']) . " ₫";
                } else {
                    $html .= "+" . format_number($row['withdrawal_amount']) . " ₫";
                }
                $html .= '</div><div class="l_table-cell l_sodu">' . format_number($row['total_money']) . '</div></div>
            ';
                $i++;
            }
            echo $html;
            echo "l_dsdasdas";
            
            echo '<a href="../code_xu_ly/l_excels.php?from=' . $from . '&&to=' . $to . '">
            <button class="l_btn_excel">
                <img src="../img/image/excel.svg" alt="" class="l_img_excel"> XUẤT EXCEL
            </button></a>';
            echo "l_dsdasdas";
            $mobile = '';
            $j=1;
            foreach ($arr as $value) {
                $mobile .= '<center>
                    <div class="v_content-mb">
                        <div class="flex v_content-mb-div">
                            <p class="v_content-mb-title">' . $j . '</p>
                        </div>
                        <div class="flex v_info-all v_content-mb-div">
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã đơn hàng: </span>' . $value['transaction_code'] . '</div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Nội dung chuyển tiền: </span>' . $value['transaction_content'] . '</div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ngày giao dịch: </span>';

                $date = date_create();
                $a = $value['transaction_date'];
                date_timestamp_set($date, $a);
                $mobile .= date_format($date, "d-m-Y") . ' - ' . date_format($date, "H:i:s");
                $mobile .= '</div><div class="v_content-mb-thongtin ';
                if ($value['plus_minus'] == 0) {
                    $mobile .= 'l_color';
                }
                $mobile .= '"><span class="v_content-mb-span">Số tiền giao dịch: </span>';

                if ($row['plus_minus'] == 0) {
                    $mobile .= "-" . format_number($value['withdrawal_amount']) . " ₫";
                } else {
                    $mobile .= "+" . format_number($value['withdrawal_amount']) . " ₫";
                }
                $mobile .= '</div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số dư: </span>' . format_number($value['total_money']) . '</div>
                        </div>
                    </div>
                </center>';
                $j++;
            }
            echo $mobile;
            echo "l_dsdasdas";
            $t1 = $current_page -1;
            if ($current_page > 1 && $total_page > 1) {
                echo '<a class="l_phantrang_btn" onclick="l_loc(' . $t1 . ')">&lt;</a>';
            }
            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $current_page) {
                    echo '<span class="l_phantrang_btn1">' . $i . '</span>';
                } else {
                    echo '<a class="l_phantrang_btn" onclick="l_loc(' . $i . ')">' . $i . '</a>';
                }
            }
            $t2 = $current_page +1;
            if ($current_page < $total_page && $total_page > 1) {
                echo '<a class="l_phantrang_btn" onclick="l_loc(' . $t2 . ')">&gt;</a>';
            }
        } else {
            echo '<div class="l_no">Không có lịch sử giao dịch</div>';
            
        }
    }
} else {
}
// echo json_encode($data);