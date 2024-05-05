<?php
error_reporting (E_ALL ^ E_NOTICE);
include ('../../function.php') ;
$token = $_COOKIE['token'];
$idm = $_COOKIE['idm'];
$msg = $_GET['message'] ?? '';
$reply = sendkc($token, $idm, $msg);
echo $reply ;
?>
