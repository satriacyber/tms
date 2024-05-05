<?php
    session_start();
    error_reporting (E_ALL ^ E_NOTICE);
    include ('fungsi.php') ;
    $reply = sendapi('logout');
    
    unset($_SESSION); 
    session_destroy();
    setcookie('idm', '', strtotime('+1 year'), '/');
    setcookie('token', '', strtotime('+1 year'), '/');
    echo "<script>window.location='login.php';</script>";
    echo "Java script browser anda harus di aktifkan !!!";
?>