<?php
session_start();
error_reporting (0);
include ('fungsi.php') ;
$token = $_COOKIE['token'];
if(isset($token)) {echo "<script>window.location='home.php'</script>";}

if ((isset($_POST['submit'])) AND ($_POST['username'] <> "") AND ($_POST['password'] <> "")) {
$un = trim($_POST['username']);
$pw = trim($_POST['password']);
$data = array(
    'api' => 'login',
    'un' => $un,
    'pw' => $pw
);
$reply = sendapi($data);
$reply = str_replace("\"","",$reply);
if($reply == '0'){$_SESSION['pesan'] = "USERNAME SALAH !!!" ;}
else if($reply == '1'){$_SESSION['pesan'] = "PASSWORD SALAH !!!" ;}
else if(strlen($reply) != 32){$_SESSION['pesan'] = "TOKEN SALAH !!!" ;}
else {
        setcookie('token', $reply, strtotime('+1 year'), '/');
        echo "<script>window.location='home.php';</script>";
    }
}
?>

<title>TMS Corporation</title>
<meta http-equiv="Content-Type" content="text/html; charset=">
<meta name="viewport" content="width=device-width; minimum-scale=0.5; initial-scale=1; maximum-scale=2; user-scalable=yes;" />
<link rel="shortcut icon" type="image/x-icon" href="style/img/logo.png">
<link rel="stylesheet"type="text/css"href="style/css/style_tms.css"/>
<style type="text/css">
<!--
.style4 {
	color: #FF0000;
	font-size: 16px
}
body {
	background-color: #000000;
}
.style6 {
	color: #FFFFFF;
	font-size: 20px;
}
-->
</style>

<div class="isix"><br><br>
	<h1 align="center" class="judul"><img src="style/img/logo.png" width="150" height="150" border="0"></h1>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="login" id="login">
  <div align="center" class="judul2 style6">
        <?php if (isset($_SESSION['pesan'])) {echo $_SESSION['pesan'] ; $_SESSION['pesan'] = "" ;} ?>        
  </div>
  <table border="0" align="center">
    <tr>
      <td colspan="2" align="center" nowrap class="judul2"><hr></td>
    </tr>
    <tr align="center">
      <td colspan="2" class="judul2">
      <input name="username" type="text" class="txtbox" id="username" onFocus="focususername();" onBlur="blurusername();" value=" ID Member..." maxlength="15"></td>
      </tr>
    <tr align="center">
      <td colspan="2" class="judul2"><input name="password" type="text" id="password" value=" PIN Passwd..." onFocus="focuspassword();" onBlur="blurpassword();" maxlength="15" class="txtbox"></td>
      </tr>
    <tr>
      <td align="center" nowrap class="judul2">
          <a href="pin.php">
        	      <button type="button" style="
                		font-size: 16px;
                		font-family: roboto;
                		border: 1px solid #FFFFFF;
                		background-color: rgba(255, 255, 255, 0);
                		color: #ffffff;"><b>MINTA PIN</b>
        		    </button>	
		    </a></td>
      <td align="right"><input name="submit" type="submit" id="Submit" value="MASUK" class="tombol tombol2"></td>
    </tr>
    <tr>
      <td colspan="2" align="center" nowrap class="judul2"><hr></td>
    </tr>
  </table>
  <div align="center" class="footer style6"><strong>tms.kotaciamis.com</strong></div>
  </form>
</div>



<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
$(window).load(function() { $(".preload-wrapper").fadeOut("slow"); })
</script>

<script type="text/Javascript">
function focususername() {
  if (document.login.username.value == " ID Member...") {
    document.login.username.value = "";
	document.login.Submit.disabled = true;
  }
}
function blurusername() {
  if (document.login.username.value == "") {
    document.login.username.value = " ID Member...";
    document.login.Submit.value = "MASUK";
    document.login.Submit.disabled = true;
    } else {
	var username = document.login.username.value;
    if (username.length >= 10) {
      	document.login.Submit.value = "MASUK";
    	} else {
      	document.login.Submit.value = "MASUK";
    	}
 	}
	if (document.login.password.value != " PIN Passwd...") {
      if (document.login.username.value != " ID Member...") {
      		document.login.Submit.disabled = false;
    		}
    }
}
function focuspassword() {
  if (document.login.password.value == " PIN Passwd...") {
    document.login.password.value = "";
    document.login.password.type = "password";
    if (document.login.username.value != " ID Member...") {
      document.login.Submit.disabled = false;
    }
  }
}
function blurpassword() {
  if (document.login.password.value == "") {
    document.login.password.value = " PIN Passwd...";
    document.login.password.type = "text";
    document.login.Submit.disabled = true;
  } else if (document.login.password.value == " PIN Passwd...") {
  	document.login.password.value = " PIN Passwd...";
    document.login.password.type = "text";
    document.login.Submit.disabled = true;
   } else {
   	if (document.login.username.value != " ID Member...") {
      document.login.Submit.disabled = false;
    }
   }
}
</script>