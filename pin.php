<?php
session_start();
error_reporting (0);
ob_start("ob_gzhandler");
include ('fungsi.php') ;
$token = $_COOKIE['token'];
if(isset($token)) {echo "<script>window.location='home.php'</script>";}

if ((isset($_POST['kirim'])) AND ($_POST['nohp'] <> "")) {
    $nohp = $_POST['nohp'];
    if ($nohp == null) {
        $_COOKIE['pesan'] = "NOMOR HP/WA Salah !!!";
    } else {
        $nohp = hp62($nohp);
        $data = array(
            'api' => 'setpin',
            'nohp' => $nohp
        );
        $kirim = sendapi($data);
        $_COOKIE['pesan'] = "PIN SUKSES Terkirim !!!";
    }
}
?>
<title>TMS Corporation</title>
<meta http-equiv="Content-Type" content="text/html; charset=">
<meta name="viewport" content="width=device-width; minimum-scale=0.5; initial-scale=1; maximum-scale=2; user-scalable=yes;" />
<link rel="shortcut icon" type="image/x-icon" href="style/img/logo.png">
<link rel="stylesheet"type="text/css"href="style/css/style.css"/>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {color: #0099FF}
body {
	background-color: #000000;
}
.style3 {color: #FFFFFF}
.style4 {font-size: 20px}
.style6 {
	color: #FFFFFF;
	font-size: 20px;
}
-->
</style><br><br>
	<h1 align="center" class="judul"><img src="style/img/logo.png" width="150" height="150" border="0"></h1>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="login" id="login">
  <div align="center" class="judul2 style6">
        <?php if (isset($_COOKIE['pesan'])) {echo $_COOKIE['pesan'] ; $_COOKIE['pesan'] = "" ;} ?>        
  </div>
  <table border="0" align="center">
    <tr>
      <td colspan="2" align="center" nowrap class="judul2"><hr></td>
    </tr>
    <tr align="center">
      <td align="center"><span class="judul2 style3"><strong>NOMOR WHATSAPP</strong></span></td>
    </tr>
    <tr align="center">
      <td align="left"><span class="judul2"><strong>
        <input name="nohp" type="text" class="txtbox" id="nohp" value="" maxlength="15">
      </strong></span></td>
    </tr>
    <tr>
      <td align="center">
	  <a href="login.php">
	  <input name="batal" type="button" id="Submit" value="MASUK" class="tombol tombol2">
	  </a><span class="judul2"><strong>
	  <input name="kirim" type="submit" id="kirim" value="KIRIM PIN" class="tombol tombol2">
	  </strong></span>	  
	  </td>
    </tr>
    <tr>
      <td colspan="2" align="center" nowrap class="judul2"><hr></td>
    </tr>
  </table>
  <table  border="0" align="center">
</form>
<div align="center" class="style6"><strong>tms.kotaciamis.com</strong>
</div>