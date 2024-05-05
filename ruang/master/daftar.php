<div class="page">
  <div class="navbar">
    <div class="navbar-bg"></div>
    <div class="navbar-inner">
      <div class="left">
        <a href="#" class="link back">
          <i class="icon f7-icons arrow-back">arrow_left</i>
        </a>
      </div>
      <div class="title">PENDAFTARAN</div>
    </div>
  </div>
  <div class="page-content">
    <div class="centered-text">
      <form action="marketing/daftar_kirim.php" method="post" name="input" id="input">
        <input type="text" id="ktp" name="ktp" placeholder="Nomor KTP/NIK" required>
        <input type="text" id="hp1" name="hp1" placeholder="Nomor HP/WA" required>
        <input type="text" id="nama" name="nama" placeholder="Nama Lengkap" required>
        <div class="form-group">
          <input type="text" id="rt" name="rt" placeholder="RT">
          <input type="text" id="rw" name="rw" placeholder="RW">
        </div>
        <div class="form-group">
          <input type="text" id="dusun" name="dusun" placeholder="Dusun">
          <input type="text" id="desa" name="desa" placeholder="Desa/Kelurahan">
        </div>
        <div class="form-group">
          <input type="text" id="kec" name="kec" placeholder="Kecamatan">
          <input type="text" id="kab" name="kab" placeholder="Kabupaten">
        </div>
        <button type="submit" id="tambah" name="tambah" class="button color-blue button-fill">DAFTAR</button>
      </form>
    </div>
  </div>
</div>