<?php
include ('../../function.php') ;
$saldo = 'saldo$$$'.$_COOKIE['token'];
$saldo = sendapi($saldo);
$mutasi = sendapis('mutasi');
$mutasi = decrypt($mutasi);
$mutasi = json_decode($mutasi, true); //echo $data[1]['id'] ;
?>
<div class="page">
  <div class="navbar">
    <div class="navbar-bg"></div>
    <div class="navbar-inner">
      <div class="left">
        <a href="#" class="link back">
          <i class="icon f7-icons arrow-back">arrow_left</i>
        </a>
      </div>
      <div class="title">TRANSAKSI</div>
    </div>
  </div>
  <div class="page-content">
    <div class="section-title">
        SALDO : Rp. <?php echo rp($saldo);?>
    </div>
    <div class="list detailed-list list-dividers full-width">
      <ul>
        <?php
            if (!empty($mutasi)) {
                foreach ($mutasi as $dt) {
                    $berita = $dt['berita'];
                    $tanggal = $dt['tanggal'];
                    $jam = $dt['jam'];
                    $masuk = $dt['masuk'];
                    $keluar = $dt['keluar'];
                    if($masuk != 0) {
                        $jumlah = rp($masuk) ;
                        $icon = "plus_rectangle_fill";
                    } else {
                        $jumlah = "- ".rp($keluar);
                        $icon = "minus_rectangle_fill";
                    }
                    if ($dt['proses'] == 0) {$sts = ' Waiting...' ;}
    		        else if ($dt['proses'] == 1) {$sts = ' SUKSES SN:'.$dt['sn'] ;} 
            		else if ($dt['proses'] == 2) {$sts = '' ;}
            		else if ($dt['proses'] == 3) {$sts = ' SUKSES';} 
            		else if ($dt['proses'] == 4) {$sts = '' ;}
        ?>
        <li>
          <a href="#" class="item-link item-content">
            <div class="item-media event-icon"><i class="icon f7-icons"><?php echo $icon ; ?></i></div>
            <div class="item-inner">
              <div class="item-title">
                <div class="item-name"><?php echo $berita ; ?></div>
                <div class="item-footer"><?php echo $sts ; ?> (<?php echo $tanggal ; ?> / <?php echo $jam ; ?>)</div>
              </div>
              <div class="item-after event-time">Rp. <?php echo $jumlah ; ?></div>
            </div>
          </a>
        </li>
        <?php } } ?>
      </ul>
    </div>
  </div>
</div>