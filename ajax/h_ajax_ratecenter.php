<?
require_once '../config/config.php';
if (isset($_POST['user_center_id'])) {
    $user_student_id = getValue('user_student_id','int','POST','');
    $user_center_id = getValue('user_center_id','int','POST','');
    $teacher = getValue('teacher','int','POST','');
    $place_class = getValue('place_class','int','POST','');
    $course_learn = getValue('course_learn','str','POST','');
    $infrastructure = getValue('infrastructure','int','POST','');
    $student_number = getValue('student_number','int','POST','');
    $enviroment = getValue('enviroment','int','POST','');
    $title_rate = getValue('title_rate','str','POST','');
    $student_care = getValue('student_care','int','POST','');
    $practice = getValue('practice','int','POST','');
    $pround_price = getValue('pround_price','int','POST','');
    $advantages = getValue('advantages','str','POST','');
    $self_improvement = getValue('self_improvement','int','POST','');
    $ready_introduct = getValue('ready_introduct','int','POST','');
    $weakness = getValue('weakness','str','POST','');
    $comment_experiment = getValue('comment_experiment','str','POST','');

    $data = [
        'user_student_id'=>$user_student_id,
        'center_id'=>$user_center_id,
        'place_class'=>$place_class,
        'teacher'=>$teacher,
        'course_learn'=>$course_learn,
        'infrastructure'=>$infrastructure,
        'student_number'=>$student_number,
        'enviroment'=>$enviroment,
        'title_rate'=>$title_rate,
        'student_care'=>$student_care,
        'practice'=>$practice,
        'pround_price'=>$pround_price,
        'advantages'=>$advantages,
        'self_improvement'=>$self_improvement,
        'ready_introduct'=>$ready_introduct,
        'weakness'=>$weakness,
        'comment_experiment'=>$comment_experiment,
    ];

    $update = [
        'place_class'=>$place_class,
        'teacher'=>$teacher,
        'infrastructure'=>$infrastructure,
        'student_number'=>$student_number,
        'enviroment'=>$enviroment,
        'student_care'=>$student_care,
        'practice'=>$practice,
        'pround_price'=>$pround_price,
        'advantages'=>$advantages,
        'self_improvement'=>$self_improvement,
        'ready_introduct'=>$ready_introduct,
    ];
    $where = [
        'user_student_id'=>$user_student_id,
        'center_id'=>$user_center_id,
    ];
    update('rate_center',$update,$where);

    add('rate_center', $data);
    $rate_id = mysql_insert_id();

    $output = array(
        'comment_experiment'=>$comment_experiment,
        'rate_id'=>$rate_id
    );

    echo json_encode($output);
}
?>