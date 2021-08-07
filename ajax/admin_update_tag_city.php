<?

include_once '../config/config.php';
// print_r($_POST);
// die();
$city_tags_id = getValue('city_tags_id', 'int', 'POST', '', '');
// $cit_id = getValue('cit_id', 'int', 'POST', '', '');
$title_suggest = getValue('title_suggest', 'str', 'POST', '', '');
$content = getValue('content', 'str', 'POST', '', '');
$content_suggest = getValue('content_suggest', 'str', 'POST', '', '');
// $type = getValue('type','str','POST','','');
// var_dump($title_suggest);
// die();
if ($city_tags_id != '' && $title_suggest != '' && $content != '' && $content_suggest != '') {
    // $db_qr = new db_query("SELECT * FROM city_tags WHERE tag_id = '$tag_id' AND city_id = '$cit_id'");
    // $row = mysql_num_rows($db_qr->result);
    // if ($row > 0) {
    //     $result = [
    //         'result' => 1,
    //     ];
    // } else {
        $data = [
            // 'city_tag_id' => $city_tags_id,
            // 'tag_id' => $tag_id,
            'content' => $content,
            'title_suggest' => $title_suggest,
            'content_suggest' => $content_suggest
        ];
        $city_tag = [
            'city_tag_id' => $city_tags_id,
        ];
        update('city_tags',$data,$city_tag);
        $result = [
            'result' => true
        ];
    // }
} else {
    $result = [
        'result' => false
    ];
}
echo json_encode($result);

?>