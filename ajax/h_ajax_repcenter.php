<?
require_once '../config/config.php';
if (isset($_POST['user_center_id'])) {
    $user_student_id = getValue('user_student_id','int','POST','');
    $user_center_id = getValue('user_center_id','int','POST','');
    $rate_id = getValue('rate_id','int','POST','');
    $comment_rep = getValue('comment_rep','str','POST','');

    $data = [
        'user_student_id'=>$user_student_id,
        'center_id'=>$user_center_id,
        'rate_id'=>$rate_id,
        'comment_rep'=>$comment_rep,
    ];
    add('rep_rate_center', $data);
    $rep_id = mysql_insert_id();

    $output = array(
        'comment_rep'=>$comment_rep,
        'rep_id'=>$rep_id
    );

    echo json_encode($output);
}
?>