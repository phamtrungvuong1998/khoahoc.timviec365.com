<?

function replaceTitle($title){
  $title = html_entity_decode($title, ENT_COMPAT, 'UTF-8');
  $title  = remove_accent($title);
  $title = str_replace('/', '',$title);
  $title = preg_replace('/[^\00-\255]+/u', '', $title);

  if (preg_match("/[\p{Han}]/simu", $title)) {
      $title = str_replace(' ', '-', $title);
  }else{
    $arr_str  = array( "&lt;","&gt;","/"," / ","\\","&apos;", "&quot;","&amp;","lt;", "gt;","apos;", "quot;","amp;","&lt", "&gt","&apos", "&quot","&amp","&#34;","&#39;","&#38;","&#60;","&#62;");

    $title  = str_replace($arr_str, " ", $title);
    $title  = preg_replace('/\p{P}|\p{S}/u', ' ', $title);
    $title = preg_replace('/[^0-9a-zA-Z\s]+/', ' ', $title);

    //Remove double space
    $array = array(
      '    ' => ' ',
      '   ' => ' ',
      '  ' => ' ',
    );
    $title = trim(strtr($title, $array));
    $title  = str_replace(" ", "-", $title);
    $title  = urlencode($title);
    // remove cac ky tu dac biet sau khi urlencode
    $array_apter = array("%0D%0A","%","&");
    $title  = str_replace($array_apter,"-",$title);
    $title  = strtolower($title);
  }
  return $title;
}
//Loại bỏ dấu
function remove_accent($mystring){
	$marTViet=array(
	"à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
	"è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ",
	"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
	"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
	"ỳ","ý","ỵ","ỷ","ỹ",
	"đ",
	"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
	"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
	"Ì","Í","Ị","Ỉ","Ĩ",
	"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
	"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
	"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
	"Đ",
	"'");
	
	$marKoDau=array(
	"a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
	"e","e","e","e","e","e","e","e","e","e","e",
	"i","i","i","i","i",
	"o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o",
	"u","u","u","u","u","u","u","u","u","u","u",
	"y","y","y","y","y",
	"d",
	"A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A",
	"E","E","E","E","E","E","E","E","E","E","E",
	"I","I","I","I","I",
	"O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
	"U","U","U","U","U","U","U","U","U","U","U",
	"Y","Y","Y","Y","Y",
	"D",
	"");
	
	return str_replace($marTViet,$marKoDau,$mystring);
}

function urlDetail_courseOffline($id, $slug){                    // Chi tiết khóa học offline
  return "/$slug-courseOff$id.html";
}
function urlDetail_courseOnline($id, $slug){                    // Chi tiết khóa học online
  return "/$slug-courseOn$id.html";
}
function urlDetail_student($id, $slug){                   // Chi tiết học viên
  return "/$slug-student$id.html";
}
function urlDetail_teacher($id, $slug){                 // Chi tiết giảng viên
  return "/$slug-teacher$id.html";
}
function urlDetail_center($id, $slug){                 // Chi tiết trung tâm
  return "/$slug-center$id.html";
}

//Thanh search offline
function urlOffline_cate($id, $slug){                    // Search khóa học offline theo môn học
  return "/khoa-hoc-offline-$slug-cate$id.html";
}
function urlOffline_cit($id, $slug){                    // Search  khóa học offline the0 tỉnh thành
  return "/khoa-hoc-offline-tai-$slug-cit$id.html";
}
function urlOffline_tagcit($id1, $slug1,$id2,$slug2){               // Search  khóa học offline theo tỉnh thành, môn học
  return "/khoa-hoc-offline-$slug1-tai-$slug2-tag".$id1."cit$id2.html";
}

function urlOffline_catecit($id1, $slug1,$id2,$slug2){               // Search  khóa học offline theo tỉnh thành, môn học
  return "/khoa-hoc-offline-$slug1-tai-$slug2-cate".$id1."cit$id2.html";
}

function urlOffline_tag($id, $slug){                    // Search khóa học offline theo môn học chi tiết
  return "/khoa-hoc-offline-$slug-tag$id.html";
}


//Thanh search online
function urlOnline_cate($id, $slug){                    // Search khóa học online theo môn học
  return "/khoa-hoc-online-$slug-cate$id.html";
}

function urlOnline_tag($id, $slug){                    // Search khóa học online theo môn học chi tiết
  return "/khoa-hoc-online-$slug-tag$id.html";
}

//Mua hang
function urlOrders($id,$course){
  return "/mua-khoa-hoc-ngay/id$id-course$course.html";
}
function urlOrderCommon($id){
  return "/mua-khoa-hoc-chung/course$id.html";
}
function urlAddCart($id){
  return "/them-gio-hang/course$id.html";
}

//bai hoc
function urlBaihoc($id){                    // Search khóa học online theo môn học
  return "/bai-hoc-$id.html";
}

?>