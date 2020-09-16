<?php 
  include_once '../../model/masyarakat.php';
  include_once '../../model/pengumuman.php';

  include_once 'masya_session.php';
  $pengumuman = $_SESSION["pengumuman"];
  $tgl_dibuat = date_create($pengumuman->dibuat, timezone_open('Asia/Jakarta'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Lihat Pengumuman</title>

  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/sidenavM.css">
  <style type="text/css">
    .judul{
      padding: 10px;
    }

    .des{
      padding: 10px;
      font-size: 15px;
    }

    .pic{
      float: left;
      width: 380px;
      padding-right: 10px;
      padding-bottom: 10px;
    }

    img{
      width: 100%;
      height: 100%;
    }

  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <?php include("../layout/M-sidebar.php") ?> 

      <div class="col-md-10">

        <div class="breadcrumb">
          <li><a href="../../controller/c_pengumumanPage.php" id="page">Pengumuman</a></li>
          <li class="active">Detail Pengumuman</li>
        </div>

        <div class="isi">
          <div class="judul">
            <h2><?php echo $pengumuman->judul ?></h2>
            <p style="font-size: 15px;"><?php echo date_format($tgl_dibuat, "d M Y H:i"); ?></p>
          </div>
          <div style="height: 2px; background-color: black;"></div>
          
          <div class="des">
            <div class="pic">
              <img src="" id="preview">
            </div>
              <P><?php echo $pengumuman->isi; ?></P>

            <br>
            <p><i>Penulis: <?php echo $pengumuman->penulis; ?></i></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/sideActive.js"></script>
<script type="text/javascript">
  var pic = "<?php echo $_SESSION["user"]->picture ?>" ;
  if (pic == "") {
    $('#pic').attr('src', '../../storage/profil.png');
  } else {
    $('#pic').attr('src', "../"+pic);
  }

  var lapImg = "<?php echo $_SESSION["pengumuman"]->picture ?>";
  if (lapImg == "") {
    $('#preview').attr('src', '../../storage/no_img.jpg');
  } else {
    $('#preview').attr('src', "../"+lapImg);
  }
  

</script>
</body>
</html>