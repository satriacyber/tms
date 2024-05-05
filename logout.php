<?php
    session_start();
    error_reporting (E_ALL ^ E_NOTICE);
    include ('function.php') ;
    $idm = $_COOKIE["idm"];
    $token = $_COOKIE["token"];
    $data = 'logout$$$'.$idm.'$$$'.$token ;
    $reply = sendapi($data);
    
    unset($_SESSION); 
    session_destroy();
    setcookie('idm', '', strtotime('+1 year'), '/');
    setcookie('token', '', strtotime('+1 year'), '/');
    echo "<script>window.location='login.php';</script>";
    echo "Java script browser anda harus di aktifkan !!!";
?>