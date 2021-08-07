<?
include_once '../config/config.php';
$cit_id = getValue('cit_id', 'int', 'POST', '', '');
$cate_id = getValue('cate_id', 'int', 'POST', '', '');
$title_suggest = getValue('title_suggest', 'str', 'POST', '', '');
$content = getValue('content', 'str', 'POST', '', '');
$content_suggest = getValue('content_suggest', 'str', 'POST', '', '');
if ($cate_id != '' && $title_suggest != '' && $content != '' && $content_suggest != '' && $cit_id != '') {
    $db_qr = new db_query("SELECT * FROM city_categories WHERE cate_id = '$cate_id' AND city_id = '$cit_id'");
    $row = mysql_num_rows($db_qr->result);
    if ($row > 0) {
        $result = [
            'result' => 1,
        ];
    } else {
        $data = [
            'city_id' => $cit_id,
            'cate_id' => $cate_id,
            'content' => $content,
            'title_suggest' => $title_suggest,
            'content_suggest' => $content_suggest
        ];
        add('city_categories',$data);
        $result = [
            'result' => 2
        ];
    }
} else {
    $result = [
        'result' => 3
    ];
}
echo json_encode($result);
