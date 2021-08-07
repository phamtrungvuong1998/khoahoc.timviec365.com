<?
require_once '../config/config.php';
if (isset($_POST['video'])) {
    $video = $_POST['video'];
    $dbv = new db_query("SELECT `video` FROM `course_lesson` WHERE `lesson_id` = $video");
    while ($row = mysql_fetch_array($dbv->result)) {
        ?>
<video controls>
    <source src="/document/video/<?=$row['video']?>" type="video/mp4">
</video>
<?php
    }
}
?>