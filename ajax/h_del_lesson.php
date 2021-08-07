<?
require_once '../config/config.php';
if (isset($_POST['episode'])) {
    $episode = $_POST['episode'];
    $del = new db_query("DELETE FROM course_lesson WHERE lesson_id = $episode");
}
if (isset($_POST['season'])) {
    $season = $_POST['season'];
    $del = new db_query("DELETE FROM course_lesson WHERE lesson_id = $season ");
    $del1 = new db_query("DELETE FROM course_lesson WHERE lesson_parent = $season");
}
?>