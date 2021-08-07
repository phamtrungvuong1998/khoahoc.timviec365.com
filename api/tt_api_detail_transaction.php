<?
include_once 'api_info.php';
$tran_id = getValue('tran_id', 'int', 'GET', '', '');
if ($tran_id != 0) {
    $db_tran = new db_query("SELECT transaction_id,transaction_code,transaction_content,transaction_date,withdrawal_amount,total_money,plus_minus FROM user_transaction Where transaction_id = '$tran_id' ORDER BY transaction_id DESC");
    $list_tran = [];
    $row = mysql_fetch_assoc($db_tran->result);
    $list_tran[$row['transaction_id']] = $row;
    $total = 0;
    if ($row['plus_minus'] == 0) {
        $total =  "-" . format_number($row['withdrawal_amount']) . " ₫";
    } else {
        $total = "+" . format_number($row['withdrawal_amount']) . " ₫";
    }
    $list_tran[$row['transaction_id']]['transactions'] = $total;
}
success('', $list_tran);
