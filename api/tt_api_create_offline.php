<?
include_once '../config/config.php';
include_once 'functions.php';
use Firebase\JWT\JWT;
$token = getValue('token','str','POST','','');

$course_name = getValue('course_name', 'str', 'POST', '', '');
$price_listed = getValue('price_listed', 'str', 'POST', '', '');
$price_promotional = getValue('price_promotional', 'str', 'POST', '', '');
$advantages_id = getValue('advantages_id', 'str', 'POST', '', '');
$level_id = getValue('level_id', 'int', 'POST', '', '');
$month_study = getValue('month_study', 'str', 'POST', '', '');
$course_describe = getValue('course_describe', 'str', 'POST', '', '');
$center_teacher_id = getValue('center_teacher_id', 'str', 'POST', '', '');

$general_describe = getValue('general_describe', 'str', 'POST', '', '');
$radio = getValue('radio', 'str', 'POST', '', '');
$level_id = getValue('level_id', 'str', 'POST', '', '');
$cate_id = getValue('cate_id', 'str', 'POST', '', '');
$l_check = getValue('l_check', 'str', 'POST', '', '');
$addtienich = getValue('addtienich', 'str', 'POST', '', '');
if ($token != '') {
    $token = JWT::decode($token, $key, ['HS256']);
    if (isset($token->id) && $token->user_type == 3) {

    }
}
?>