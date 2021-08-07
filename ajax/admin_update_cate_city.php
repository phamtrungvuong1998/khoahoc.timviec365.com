<?

include_once '../config/config.php';
// print_r($_POST);
// die();
$city_cate_id = getValue('city_cate_id', 'int', 'POST', '', '');
$title_suggest = getValue('title_suggest', 'str', 'POST', '', '');
$content = getValue('content', 'str', 'POST', '', '');
$content_suggest = getValue('content_suggest', 'str', 'POST', '', '');
if ($city_cate_id != '' && $title_suggest != '' && $content != '' && $content_suggest != '') {
        $data = [
            'content' => $content,
            'title_suggest' => $title_suggest,
            'content_suggest' => $content_suggest
        ];
        $city_cate = [
            'cit_cate_id' => $city_cate_id,
        ];
        update('city_categories',$data,$city_cate);
        $result = [
            'result' => true
        ];
} else {
    $result = [
        'result' => false
    ];
}
echo json_encode($result);

?>