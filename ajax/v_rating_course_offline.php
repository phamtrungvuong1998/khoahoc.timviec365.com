<?php
require_once '../config/config.php';
$type = getValue('type','int','GET','');
if ($type == 2) {
	$user_student_id = getValue('user_student_id','int','GET','');
	$course_id = getValue('course_id','int','GET','');
	$lession = getValue('lession','int','GET','');
	$teacher = getValue('teacher','int','GET','');
	$comment = getValue('comment','str','GET','');


	$qr = new db_query("SELECT * FROM rate_course WHERE user_student_id = '$user_student_id' AND course_id = '$course_id'");

	$row = mysql_fetch_array($qr->result);
	if ($row != "") {
		$data = [
			'lesson'=>$lession,
			'teacher'=>$teacher,
			'comment_rate'=>$comment
		];

		$dataId = [
			'user_student_id'=>$user_student_id,
			'course_id'=>$course_id,
		];

		update('rate_course', $data, $dataId);

	}else {
		$data = [
			'user_student_id'=>$user_student_id,
			'course_id'=>$course_id,
			'lesson'=>$lession,
			'teacher'=>$teacher,
			'comment_rate'=>$comment,
		];
		add('rate_course', $data);
	}

	$qrComment = new db_query("SELECT * FROM rate_course");
	while ($rowComment = mysql_fetch_array($qrComment->result)) {
		$user_student_id = $rowComment['user_student_id'];
		$qrHV = new db_query("SELECT user_name FROM users WHERE user_id = '$user_student_id'");
		$rowHV = mysql_fetch_array($qrHV->result);
		echo '<div class="cmt-student" id="v_comment-'.$rowComment['rate_id'].'">
		<div class="std-img">
		<img src="../img/Ellipse 24.png">
		</div>
		<div class="std-content">
		<h4>' . $rowHV['user_name'] . '</h4>
		<div class="stdstar">
		<img src="../img/image/star.svg">
		<img src="../img/image/star.svg">
		<img src="../img/image/star.svg">
		<img src="../img/image/star.svg">
		<img src="../img/image/star.svg">
		<span>' . $rowComment['updated_at'] . '</span>
		</div>
		<p>' . $rowComment['comment_rate'] . '</p>
		<div class="answer">
		<button id="clickrep">Phản hồi</button>
		<button id="delcmt" onclick="v_del_comment('.$rowComment['rate_id'].',1,2)">Xóa</button>
		</div>
		</div>
		</div>

		<div class="reply-comment" id="repling">
		<form>
		<textarea></textarea>
		<div class="divreply">
		<button>GỬI</button>
		</div>
		</form>
		</div>';
	}
}
?>