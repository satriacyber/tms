<?php
$auth = "TMS";

function sendapi($api){
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $ips = $_SERVER['REMOTE_ADDR'];
    $sis = $_SERVER['HTTP_USER_AGENT'];
    $token = $_COOKIE['token'];
    $data = array(
        'url' => $url,
        'ips' => $ips,
        'sis' => $sis,
        'token' => $token
    );

    if (is_array($api)) {
        $data = array_merge($data, $api);
    } else {
        $data['api'] = $api;
    }
    
    $data = json_encode($data);
    $data = encrypt($data);
    $server = 'http://app.tms.web.id/server/apis.php';
    $ch = curl_init($server);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: '.$_GLOBALS['auth']
    ));
    $response = curl_exec($ch);
    if ($response === false) {return 0;} 
    else {
        $response = decrypt($response);
        return $response;
    }
    curl_close($ch);
}

function encrypt($str) {
    $hasil = "";
    $karakter = 0;
    $kunci = md5('TMS');
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
        $karakter = chr(ord($karakter)+ord($kuncikarakter));
        $hasil .= $karakter;
    }
	return urlencode($hasil);
}
 
function decrypt($str) {
	$hasil = '';
	$str = urldecode($str);    
    $kunci = md5('TMS');
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
        $karakter = chr(ord($karakter)-ord($kuncikarakter));
        $hasil .= $karakter;        
    }
    return $hasil;
}

function random($panjang)
{
   //$karakter = 'abcdefghijklmnopqrstuvwxyz1234567890';
   $karakter = '1234567890';
   $string = '';
   for($i = 0; $i < $panjang; $i++) {
   $pos = rand(0, strlen($karakter)-1);
   $string .= $karakter[$pos];
   }
   return $string;
}

function rp($rp) {
	$rp = number_format($rp) ;
	$rp = str_replace(",",".",$rp) ;
    return $rp;
}

// fungsi untuk merubah format +62 menjadi 0
function hp0($hp62) {
	 if(substr(trim($hp62), 0, 3)=='+62'){
		$hp62 = substr_replace($hp62,'0',0,3); 
	}	
    return $hp62 ;
}

// fungsi untuk merubah format 0 menjadi +62
function hp62($hp0) {
    $hp0 = str_replace(" ","",$hp0); // kadang ada penulisan no hp 0811 239 345
    $hp0 = str_replace("(","",$hp0); // kadang ada penulisan no hp (0265) 778787
    $hp0 = str_replace(")","",$hp0); // kadang ada penulisan no hp (0265) 778787
    $hp0 = str_replace(".","",$hp0); // kadang ada penulisan no hp 0811.239.345
	$hp0 = str_replace("-","",$hp0); // kadang ada penulisan no hp 0811-239-345

    // cek apakah no hp mengandung karakter + dan 0-9
    if(!preg_match('/[^+0-9]/',trim($hp0))){
        // cek apakah no hp karakter 1-3 adalah +62
        if(substr(trim($hp0), 0, 3)=='+62'){
            $hp = trim($hp0);
        }
        // cek apakah no hp karakter 1 adalah 0
        elseif(substr(trim($hp0), 0, 1)=='0'){
            $hp = '+62'.substr(trim($hp0), 1);
        }
		else {
			$hp = trim($hp0);
		}
    }
    return $hp;
}
?>