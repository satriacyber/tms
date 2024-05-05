<?php 
session_start();
set_time_limit(0) ;
error_reporting (E_ALL ^ E_NOTICE);
date_default_timezone_set("Asia/Jakarta");
include ('fungsi.php') ;
$idm = sendapis('sesi');
if($idm == 0) {echo "<script>window.location='logout.php'</script>";}

$profile = sendapi('profile');
$profile = json_decode($profile, true); //echo $data[1]['id'] ;
$nama = $profile['nama'];
$grup = $profile['up'];
$level = $profile['ul'];
$jabatan = sendapi('jabatan');

echo "IDM : $idm <br>" ;
echo "Nama : $nama <br>" ;
echo "Jabatan : $jabatan <br>" ;
echo "<br>" ;
?>
<a href="logout.php">LOGOUT</a>