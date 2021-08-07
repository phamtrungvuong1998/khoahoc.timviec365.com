<?
require_once '../config/config.php';

if (isset($_POST['lesson1'])) {
    $lesson1 = $_POST['lesson1'];
    $data1= [
            'lesson_name'=>$lesson1,
        ];
    add('course_lesson', $data1);
    $id = mysql_insert_id();
    
    $count = count($_POST['array']);
    for ($i=0;$i<$count;$i++) {
        $lessonname2 = $_POST['array'];
        $data2= [
            'lesson_name'=>$lessonname2[$i],
            'lesson_parent'=>$id
        ];
        add('course_lesson', $data2);
    }
}
?>