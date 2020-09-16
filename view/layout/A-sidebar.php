<div class="col-md-2">
  <div class="user">
    <h3 style="text-align: center;"><?php echo $user->nama ?></h3>
  </div>

  <div class="sidebar">
    <a name="side" href="admBeranda.php" class="active">Beranda</a>
    <a name="side" href="../../controller/c_laporanPage.php"><?php if (!empty($_SESSION["notif_laporan"])) {
        echo '<span class="badge">'.count($_SESSION["notif_laporan"]).'</span>';
      }?>Laporan</a>
    <a name="side" href="../../controller/c_pengumumanPage.php">Pengumuman</a>
    <a name="side" href="../../controller/c_admDataUser.php">Data User</a>
    <a name="side" href="admUbahPass.php">Ubah Password</a>
    <a name="side" href="../../controller/c_logout.php">Log out</a>
  </div>
</div>