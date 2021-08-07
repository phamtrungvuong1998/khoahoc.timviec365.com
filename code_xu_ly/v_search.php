<?php
require_once '../config/config.php';
if (isset($_GET['btn_search_offline'])) {
	$keyword = getValue('keyword2','str','GET','');
	$cit_name = getValue('keyword3','str','GET','');
	$keyword = trim($keyword,' ');
	$cit_name = trim($cit_name,' ');
	$keyword_slug = ChangeToSlug($keyword);
	$qrcate = new db_query("SELECT cate_slug, cate_id FROM categories WHERE cate_slug = '$keyword_slug'");
	if (mysql_num_rows($qrcate->result) > 0) {
		$row = mysql_fetch_array($qrcate->result);
		if (strpos($keyword_slug, "khoa-hoc-") !== false) {
			$keyword_slug = substr($keyword_slug, 9);
			$cate_slug = $keyword_slug;
		}else{
			$cate_slug = $row['cate_slug'];
		}
		if ($cit_name == "") {
			header("Location: " . urlOffline_cate($row['cate_id'],$row['cate_slug']));
		}else{
			$qrcity = new db_query("SELECT cit_id, cit_name FROM city WHERE cit_name = '$cit_name'");
			$rowCit = mysql_fetch_array($qrcity->result);
			header("Location: " . urlOffline_catecit($row['cate_id'],$row['cate_slug'],$rowCit['cit_id'],ChangeToSlug($rowCit['cit_name'])));
		}
	}else{
		if (strpos($keyword_slug, "khoa-hoc-") !== false) {
			$keyword_slug = substr($keyword_slug, 9);
		}
		$qrTag = new db_query("SELECT tag_id,tag_slug FROM tags WHERE tag_slug = '$keyword_slug'");
		$countTag = mysql_num_rows($qrTag->result);
		if ($countTag > 0) {
			$rowTag = mysql_fetch_array($qrTag->result);
			if ($cit_name == '') {
				$srcSearch = urlOffline_tag($rowTag['tag_id'], $rowTag['tag_slug']);
			}else if($cit_name != ''){
				$qrCity = new db_query("SELECT cit_id FROM city WHERE cit_name = '$cit_name'");
				$rowCity = mysql_fetch_array($qrCity->result);
				$srcSearch = urlOffline_tagcit($rowTag['tag_id'], $rowTag['tag_slug'],$rowCity['cit_id'],ChangeToSlug($cit_name));
			}

			header("Location:" . $srcSearch);
		}else{
			if ($keyword == "" && $cit_name != "") {
				$qrCity = new db_query("SELECT cit_id FROM city WHERE cit_name = '$cit_name'");
				$rowCity = mysql_fetch_array($qrCity->result);
				$srcSearch = urlOffline_cit($rowCity['cit_id'], ChangeToSlug($cit_name));
				header("Location: " . $srcSearch);
			}else if ($keyword != "" && $cit_name == "") {
				header("Location: /khoa-hoc-offline?keyword=" . ChangeToSlug($keyword));
			}else if ($keyword != "" && $cit_name != "") {
				$qrCity = new db_query("SELECT cit_id FROM city WHERE cit_name = '$cit_name'");
				$rowCity = mysql_fetch_array($qrCity->result);
				header("Location: /khoa-hoc-offline?keyword=" . ChangeToSlug($keyword)."&cit_id=". $rowCity['cit_id'] ."&city=" . ChangeToSlug($cit_name));
			}
		}
	}
}

if (isset($_GET['btn_search_online'])) {
	$keyword = getValue('keyword1','str','GET','');
	$keyword = trim($keyword,' ');
	$keyword_slug = ChangeToSlug($keyword);
	$qrcate = new db_query("SELECT cate_slug, cate_id FROM categories WHERE cate_slug = '$keyword_slug'");
	if (mysql_num_rows($qrcate->result) > 0) {
		if (strpos($keyword_slug, "khoa-hoc-") !== false) {
			$keyword_slug = substr($keyword_slug, 9);
			$cate_slug = $keyword_slug;
		}else{
			$cate_slug = $row['cate_slug'];
		}
		$row = mysql_fetch_array($qrcate->result);
		header("Location: " . urlOnline_cate($row['cate_id'],$row['cate_slug']));
	}else{
		if (strpos($keyword_slug, "khoa-hoc-") !== false) {
			$keyword_slug = substr($keyword_slug, 9);
		}

		$qrTag = new db_query("SELECT tag_slug,tag_id FROM tags WHERE tag_slug = '$keyword_slug'");
		$countTag = mysql_num_rows($qrTag->result);

		if ($countTag > 0) {
			$rowTag = mysql_fetch_array($qrTag->result);
			$srcSearch = urlOnline_tag($rowTag['tag_id'], $rowTag['tag_slug']);
			header("Location: ". $srcSearch);
		}else{
			header("Location: /khoa-hoc-online?keyword=" . ChangeToSlug($keyword));
		}
	}
}	

?>