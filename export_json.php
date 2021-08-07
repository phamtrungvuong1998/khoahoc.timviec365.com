<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require("../../../../extension/vendor/autoload.php");

$swagger = \Swagger\scan($_SERVER["DOCUMENT_ROOT"].'/api');
header('Content-Type: application/json');
echo $swagger;

?>