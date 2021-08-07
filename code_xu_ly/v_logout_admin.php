<?php
setcookie('adm_id','',time() - 3600 * 6,'/');
setcookie('adm_type','',time() - 3600 * 6,'/');
header("Location: ../Admin/");
?>