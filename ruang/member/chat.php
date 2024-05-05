<?php
error_reporting(E_ALL ^ E_NOTICE);
$idm = $_COOKIE['idm'];
?>

<style>
  .messages {
    max-height: calc(100vh - 150px); /* Sesuaikan dengan tinggi perangkat */
    overflow-y: auto;
  }
</style>

<div class="page no-toolbar" data-name="chat">
    <div class="navbar">
    <div class="navbar-bg"></div>
    <div class="navbar-inner">
      <div class="left">
        <a href="#" class="link back">
          <i class="icon f7-icons arrow-back">arrow_left</i>
        </a>
      </div>
      <div class="title">MEMBER [ <?php echo $idm; ?> ]</div>
      <div class="right">
        <a href="/" data-actions=".confirm-action" class="actions-open">
          <i class="icon f7-icons arrow-back text-color-red">clear</i>
        </a>
      </div>
    </div>
    </div>
  
    <div class="page-content messages-content">
        <div class="messages full-width" id="messageContainer"></div>
    </div>
  
    <div class="toolbar messagebar messagebar-init">
        <div class="toolbar-inner">
            <div class="messagebar-area">
                <textarea placeholder="Ketik Pesan..."></textarea>
            </div>
            <a href="#" class="link send-link"><i class="icon f7-icons">paperplane_fill</i></a>
        </div>
    </div>
  
    <div class="actions-modal confirm-action">
        <div class="actions-group">
            <div class="actions-label">APAKAH ANDA YAKIN ???</div>
            <div class="actions-button actions-button-bold actions-close">
                <a href="#" class="link" id="clearChatLogButton">
                    <div class="actions-button-text">YA Bersihkan</div>
                </a>
            </div>
        </div>
        <div class="actions-group">
            <div class="actions-button color-red actions-close">
                <div class="actions-button-text">TIDAK Batalkan</div>
            </div>
        </div>
    </div>
  
</div>