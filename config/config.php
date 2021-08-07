<? 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../functions/functions.php"); 
ob_start();
require_once("../functions/function_rewrite.php");
require_once("../functions/send_mail.php");
require_once("../classes/database.php");
// require_once("../cache_file/top-cache.php");
require_once("../functions/pagebreak.php");
require_once("../classes/class.phpmailer.php");
require_once("../classes/class.pop3.php");
require_once("../classes/class.smtp.php");
require_once("../classes/PHPMailerAutoload.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');
if($_SERVER['SERVER_NAME'] == 'localhost'){
	$domain = "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'];
}
else if($_SERVER['SERVER_NAME'] == 'khoahoc.timviec365.com'){
	$domain = "https://".$_SERVER['SERVER_NAME'];
}
else{
	$domain = "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'];
}

$version = 3;

//---Trường 06/07/2021--------
include("../home/sync_login.php");

/*if(!isset($_COOKIE['general_login'])){
    if(isset($_COOKIE['user_type']) || isset($_COOKIE['user_id']) || isset($_COOKIE['PHPSESPASS'])){
        unset($_COOKIE['user_type']);
        unset($_COOKIE['user_id']);
        unset($_COOKIE['PHPSESPASS']);
        setcookie("user_type", null, -1,'/');
        setcookie("user_id", null, -1,'/');
        setcookie("PHPSESPASS", null, -1,'/');
    }
}*/
//-----------

?>