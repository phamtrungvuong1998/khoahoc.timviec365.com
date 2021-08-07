<?
include_once '../config/config.php';
$cit_id = getValue('cit_id', 'int', 'POST', '', '');
$title_suggest = getValue('title_suggest', 'str', 'POST', '', '');
$content = getValue('content', 'str', 'POST', '', '');
$content_suggest = getValue('content_suggest', 'str', 'POST', '', '');
// $type = getValue('type', 'str', 'POST', '', '');
if ($cit_id != '' && $title_suggest != '' && $content != '' && $content_suggest != '') {
    // $slug = ChangeToSlug($title_suggest);
    $id = [
        'cit_id' => $cit_id,
    ];
    $data = [
        'content' => $content,
        'title_suggest' => $title_suggest,
        'content_suggest' => $content_suggest
    ];
    update('city', $data, $id);
    $result = [
        'result' => false,
        'message' => 'Cập nhật bài viết thành công',
    ];
} else {
    $result = [
        'result' => false,
        'message' => 'Cập nhật bài viết thất bại',
    ];
}
echo json_encode($result);
