<?php 
session_start();
set_time_limit(0) ;
error_reporting (E_ALL ^ E_NOTICE);
date_default_timezone_set("Asia/Jakarta");
include ('function.php') ;
$token = $_COOKIE['token'];
$sesi = 'sesi$$$'.$token ;
$idm = sendapi($sesi);
if($idm == 0) {echo "<script>window.location='logout.php'</script>";}

$profile = sendapis('profile');
$profile = decrypt($profile);
$pf = json_decode($profile, true); //echo $data[1]['id'] ;
$nama = $pf['nama'];
$grup = $pf['up'];
$level = $pf['ul'];
$jabatan = sendapi('jabatan$$$'.$_COOKIE['token']);

if(isset($_GET['info'])) {
    $info = $_GET['info'];
    echo "<script>alert('$info');</script>";
}
?>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="theme-color" content="#ffffff">
    <!-- Your app title -->
    <title>KOCI Mobile</title>
    <link rel="stylesheet" href="style/css/framework7-bundle.css">
    <link rel="stylesheet" href="style/css/framework7-icons.css">
    <link rel="stylesheet" href="style/css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="style/img/logo.png">
  </head>
  <body class="dark color-red">
    <!-- App root element -->
    <div id="app">
      <!-- Left panel -->
      <div class="panel panel-left panel-push panel-init">
        <div class="profile-header">
          <div class="profile-image">
            <img src="style/img/logo.png" alt="">
            <div class="profile-online bg-color-green"></div>
          </div>
          <div class="profile-name"><?php echo "($idm)$nama";?></div>
          <div class="profile-subtitle"><?php echo $jabatan; ?></div>
        </div>
        <div class="list links-list panel-links">
          <ul>
            <li>
              <a href="#" class="panel-close">
                <i class="icon f7-icons">person_crop_circle_fill</i>
                Profile
              </a>
            </li>
            <li>
              <a href="/mutasi/" class="panel-close">
                <i class="icon f7-icons">arrow_up_arrow_down_square_fill</i>
                Mutasi
              </a>
            </li>
            <li>
              <a href="#" class="panel-close">
                <i class="icon f7-icons">money_dollar_circle_fill</i>
                Komisi
              </a>
            </li>
            <li>
              <a href="#" class="panel-close">
                <i class="icon f7-icons">minus_rectangle_fill</i>
                Kredit
              </a>
            </li>
          </ul>
        </div>
        <div class="panel-logout">
          <a href="#" data-actions=".confirm-action" class="link text-color-red actions-open">
            LOGOUT [<?php echo $idm; ?>]
            <i class="icon f7-icons arrow-back text-color-red">square_arrow_right</i>
          </a>
        </div>
      </div>
      
      <!-- Views container -->
      <div class="views tabs">
        
        <div class="view view-init tab view-main tab-active" id="tab-6">
          <div class="page">
            <div class="navbar">
              <div class="navbar-bg"></div>
              <div class="navbar-inner">
                <div class="left">
                  <a href="#" data-panel=".panel-left" class="link icon-only navbar-profile panel-open">
                    <i class="icon f7-icons">bars</i>
                  </a>
                </div>
                <div class="title">
                    <h2>KOCI v.6.0</h2>
                </div>
                <div class="right">
                  <a href="marketing.php" class="link icon-only link external">
                    <i class="icon f7-icons">
                      rectangle_fill_on_rectangle_fill
                      <span class="badge bg-color-primary">1</span>
                    </i>
                  </a>
                </div>
              </div>
            </div>

            <div class="page-content">
              
                <a href="/chat/" class="link link-banner link-chevron bg-color-dark bg-color-black">
                  <img src="style/img/center.png" alt="">
                  <div class="link-banner-text">
                    <div class="link-banner-title">CHAT Transaksi</div>
                    <div class="link-banner-subtitle">transaksi melalui chat</div>
                  </div>
                </a>
              
                <div class="actions-modal confirm-action">
                  <div class="actions-group">
                    <div class="actions-label">APAKAH ANDA YAKIN ???</div>
                    <div class="actions-button actions-button-bold actions-close">
                        <a href="logout.php" class="link external">
                      <div class="actions-button-text">YA Keluar</div>
                        </a>
                    </div>
                  </div>
                  <div class="actions-group">
                    <div class="actions-button color-red actions-close">
                      <div class="actions-button-text">TIDAK</div>
                    </div>
                  </div>
                </div>
              
            </div>
          </div>
        </div>
        
        <div class="toolbar tabbar tabbar-icons toolbar-bottom">
          <div class="toolbar-inner">
            <a href="home.php" class="tab-link tab-link-active link external">
              <i class="icon f7-icons">house_fill</i>
              <span class="tabbar-label">HOME</span>
            </a>
            <a href="/mutasi/" class="tab-link">
              <i class="icon f7-icons">arrow_up_arrow_down_square_fill</i>
              <span class="tabbar-label">MUTASI</span>
            </a>
            <a href="koci.apk" class="tab-link link external">
              <i class="icon f7-icons">logo_android</i>
              <span class="tabbar-label">DOWNLOAD</span>
            </a>
          </div>
        </div>
        
      </div>
    </div>
    <script src="style/js/framework7-bundle.js"></script>
    <!-- <script src="js/app.js"></script> -->
    <!-- Menyertakan skrip JavaScript dengan cache busting -->
    <script>
        // Mendapatkan timestamp saat ini
        var timestamp = new Date().getTime();
        // Membuat elemen skrip baru
        var scriptElement = document.createElement("script");
        // Mengatur atribut src skrip dengan menambahkan timestamp
        scriptElement.src = "style/js/app.js?version=" + timestamp;
        // Menyisipkan elemen skrip ke dalam halaman
        document.body.appendChild(scriptElement);
    </script>
  </body>
</html>
