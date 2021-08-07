<?
include_once 'api_info.php';

$db_tran = new db_query("SELECT transaction_id,transaction_code,transaction_content FROM user_transaction Where user_id = '$user_id' ORDER BY transaction_id DESC");
$list_tran = [];
while ($row = mysql_fetch_assoc($db_tran->result)) {
    $list_tran[$row['transaction_id']] = $row;
}
success('',$list_tran);
?>