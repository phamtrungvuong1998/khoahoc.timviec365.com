<?
include_once '../config/config.php';
$tag_id = getValue('tag_id','int','POST','','');
$title_suggest = getValue('title_suggest','str','POST','','');
$content = getValue('content','str','POST','','');
$content_suggest = getValue('content_suggest','str','POST','','');
$type = getValue('type','str','POST','','');
    // var_dump($title_suggest);
    // die();
if ($tag_id != '' && $title_suggest != '' && $content != '' && $content_suggest != '' && $type != '') {
    $slug = ChangeToSlug($title_suggest);
    $id = [
        'tag_id'=> $tag_id,
    ];
    if ($type == 2) {
        $data = [
            'content_on' => $content,
            'title_suggest_on' => $title_suggest,
            'content_suggest_on' => $content_suggest
        ];
        update('tags',$data, $id);
    }else{
        $data = [
            'content_off' => $content,
            'title_suggest_off' => $title_suggest,
            'content_suggest_off' => $content_suggest
        ];
        update('tags',$data, $id);
    }
    $result = [
        'result' => true,
        'message' => 'Cập nhật bài viết thành công',
    ];
}else{
    $result = [
        'result' => false,
        'message' => 'Cập nhật bài viết thất bại',
    ];
}
echo json_encode($result)
?>