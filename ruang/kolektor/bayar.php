<?php
include ('../function.php') ;
$idm = $_COOKIE['idm'];
$bayar = sendapis('bayar');
$bayar = decrypt($bayar);
$bayar = json_decode($bayar, true); //echo $data[1]['id'] ;
$total_pembayaran = 0 ;
if (!empty($bayar)) { foreach ($bayar as $tot) { $total_pembayaran += $tot['bayar']; } }
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
      <div class="title">PEMBAYARAN AKUN <?php echo $grup ; ?></div>
    </div>
  </div>
  <div class="page-content">
    <form class="searchbar searchbar-init searchbar-inline" data-search-container="#message-list"
      data-search-in=".item-content">
      <div class="searchbar-inner">
        <div class="searchbar-input-wrap">
          <input type="search" placeholder="Search">
          <i class="searchbar-icon"></i>
          <span class="input-clear-button"></span>
        </div>
        <span class="searchbar-disable-button if-not-aurora">Cancel</span>
      </div>
    </form>
    <div class="section-title">
        TOTAL : Rp. <?php echo rp($total_pembayaran);?>
    </div>
    <div class="list detailed-list list-outline list-dividers full-width message-list" id="message-list">
      <ul>
        <?php
            if (!empty($bayar)) {
                foreach ($bayar as $dt) {
                    $berita = $dt['berita'];
                    $tanggal = $dt['tanggal'];
                    $jam = $dt['jam'];
                    $jumlah = $dt['bayar'];
                    $total_pembayaran += $jumlah;
        ?>
        <li class="swipeout">
          <div class="swipeout-content">
            <a href="#" class="item-link item-content">
              <div class="item-media"><img src="style/aktif.png" alt=""></div>
              <div class="item-inner">
                <div class="item-title">
                  <div class="item-name"><?php echo $berita ; ?></div>
                  <div class="item-footer item-unread"><?php echo $tanggal ; ?> / <?php echo $jam ; ?></div>
                </div>
                <div class="item-after"><span class="badge bg-color-primary">Rp. <?php echo rp($jumlah) ; ?></span></div>
              </div>
            </a>
          </div>
          <div class="swipeout-actions-right">
            <a href="#" class="link swipeout-delete">Hapus</a>
          </div>
        </li>
        <?php } } ?>
      </ul>
    </div>
    
  </div>
</div>