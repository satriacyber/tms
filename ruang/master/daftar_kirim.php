<?php
error_reporting (E_ALL ^ E_NOTICE);
include ('../function.php') ;
$token = $_COOKIE['token'];
$idm = $_COOKIE['idm'];
if ((isset($_POST['tambah'])) AND ($_POST['ktp'] <> "")) {
	$ktp = trim($_POST['ktp']);
	if (strlen($ktp) == 16)
	{
	    if (ctype_digit($ktp))
	    {
        	$hp1 = trim(hp0($_POST['hp1']));
        	$digit = strlen($hp1) ;
			if ($digit == 10 or $digit == 11 or $digit == 12 or $digit == 13)
			{
                if (ctype_digit($hp1))
	            {    	
                	$nama = trim($_POST['nama']);
                	$nama = str_replace(" ","_",$nama);
                	$nama = strtolower($nama);
                	$rt = trim($_POST['rt']);
                	$rt = strtolower($rt);
                	$rw = trim($_POST['rw']);
                	$rw = strtolower($rw);
                	$dsn = trim($_POST['dusun']);
                	$dsn = str_replace(" ","_",$dsn);
                	$dsn = strtolower($dsn);
                	$desa = trim($_POST['desa']);
                	$desa = str_replace(" ","_",$desa);
                	$desa = strtolower($desa);
                	$desa = $dsn.'/'.$rt.'/'.$rw.'/'.$desa ;
                	$kec = trim($_POST['kec']);
                	$kec = str_replace(" ","_",$kec);
                	$kec = strtolower($kec);
                	$kab = trim($_POST['kab']);
                	$kab = str_replace(" ","_",$kab);
                	$kab = strtolower($kab);
                	$own = '0';
                	$msg = "daftar ".$own." ".$ktp." ".$hp1." ".$nama." ".$desa." ".$kec." ".$kab ;
                	$reply = sendkc($token, $idm, $msg);
                    echo "<script>window.location='../marketing.php?info=$reply'</script>";
	            } else {
            	    $reply = "Nomor HP/WA Harus di isi dengan angka !!!";
            	    echo "<script>window.location='../marketing.php?info=$reply'</script>";
        	    }
        	} else {
        	    $reply = "Nomor HP/WA Salah !!!";
        	    echo "<script>window.location='../marketing.php?info=$reply'</script>";
	        }
	    } else {
    	    $reply = "Nomor KTP/NIK Harus di isi dengan angka !!!";
    	    echo "<script>window.location='../marketing.php?info=$reply'</script>";
	    }
	} else {
	    $reply = "Nomor KTP/NIK Salah !!!";
	    echo "<script>window.location='../marketing.php?info=$reply'</script>";
	}
}
?>
