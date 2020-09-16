
<div class="col-md-2">
    <div class="foto">
      <img src="../img/profil.png" id="pic">
    </div>
    <h4 style="text-align: center;"><?php echo $user->nama ?></h4>
    <div class="sidebar">
      <a name="side" href="../../controller/c_laporanPage.php">Laporan</a>
      <!-- <a href="#">Buat Laporan</a> -->
      <a name="side" href="../../controller/c_pengumumanPage.php">
        Pengumuman
        <?php if (!empty($_SESSION["notif_ann"])) {
          echo '<span class="badge">'.count($_SESSION["notif_ann"]).'</span>';
        }
        ?>
      </a>
      <a name="side" href="../masyarakat/profil.php">Profil</a>
      <a name="side" href="../../controller/c_logout.php">Log out</a>
    </div>

  </div>