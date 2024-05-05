<?php
include ('../function.php') ;
$setor = sendapis('setoran');
$setor = decrypt($setor);
$setor = json_decode($setor, true); //echo $data[1]['id'] ;
$total_setoran = 0 ;
if (!empty($setor)) { foreach ($setor as $tot) { $total_setoran += $tot['sisa']; } }
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
      <div class="title">SETORAN</div>
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
        TOTAL : Rp. <?php echo rp($total_setoran);?>
    </div>
    <div class="list detailed-list list-outline list-dividers full-width message-list" id="message-list">
      <ul>
        <?php
            if (!empty($setor)) {
                foreach ($setor as $dt) {
                    $idm = $dt['idm'];
                    $grup = $dt['grup'];
                    $tanggal = $dt['tanggal'];
                    $jam = $dt['jam'];
                    $tgl1 = $tanggal;
        			$tgl2 = date("Y-m-d") ;
        			$selisih = strtotime($tgl2) -  strtotime($tgl1);
        			$jmlhari = $selisih/(60*60*24); //60 detik * 60 menit * 24 jam = 1 hari
        			$sisa = $dt['sisa'];
        ?>
        <li class="swipeout">
          <div class="swipeout-content">
            <a href="#" class="item-link item-content">
              <div class="item-media"><?php
                  if ($jmlhari < 1) {?> 
				<img src="style/aktif.png" alt="">
			<?php } else if ($jmlhari <= 7) {if (strlen($jmlhari)==1) {$jmlhari = ' 0'.$jmlhari ;}?>
				<img src="style/aktif.png" alt="">
			<?php } else if ($jmlhari <= 15) {if (strlen($jmlhari)==1) {$jmlhari = ' 0'.$jmlhari ;}?>
				<img src="style/warning.png" alt="">
			<?php } else if ($jmlhari <= 30) {?> 
				 <img src="style/nonaktif.png" alt="">
			<?php } else {?>
				 <img src="style/nonaktif.png" alt="">
		    <?php } ?></div>
              <div class="item-inner">
                <div class="item-title">
                  <div class="item-name">Grup : <?php echo $grup ; ?> (<?php echo $jmlhari ; ?> hr)</div>
                  <div class="item-footer item-unread"><?php echo $tanggal ; ?> / <?php echo $jam ; ?></div>
                </div>
                <div class="item-after"><span class="badge bg-color-primary">Rp. <?php echo rp($sisa) ; ?></span></div>
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