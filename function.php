<?php
function sendapi($data){
    $ips = $_SERVER['REMOTE_ADDR'];
    $sis = $_SERVER['HTTP_USER_AGENT'];
    $data = $data.'$$$'.$ips.'$$$'.$sis ;
    $keycode = encrypt($data);
    $reply = @file_get_contents("http://app.tms.web.id/server/api.php?keycode=".$keycode);
    $reply = decrypt($reply) ;
    return $reply ;
}

function sendapis($api){
    $token = $_COOKIE['token'];
    $data = array(
        'token' => $token
    );

    if (is_array($api)) {
        $data = array_merge($data, $api);
    } else {
        $data['api'] = $api;
    }
    $url = 'http://app.tms.web.id/server/apis.php';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: '.$token
    ));
    $response = curl_exec($ch);
    if ($response === false) {return 0;} else {return $response;}
    curl_close($ch);
}

function sendkc($token, $idm, $msg)
{
	$url = 'http://app.tms.web.id/server/kc.php';
	$ips = $_SERVER['REMOTE_ADDR'];
    $sis = $_SERVER['HTTP_USER_AGENT'];
	$data = array(
        'modem' => '14',
        'token' => $token,
        'idm' => $idm,
        'text' => $msg,
        'ips' => $ips,
        'sis' => $sis
    );
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
	$reply = json_decode($response, true);
	$reply = str_replace("\n","<br>",$reply) ;
	return $reply ;
}

function sendwa($target, $pesan){
    $curl = curl_init();
    $data = [
        'target' => $target,
        'message' => $pesan
    ];
    
    curl_setopt($curl, CURLOPT_HTTPHEADER,
        array(
            "Authorization: v2fYKaxfdUA-63WMTNQV",
        )
    );
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
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