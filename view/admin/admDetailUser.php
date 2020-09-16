<?php 
  include_once '../../model/admin.php';
  include_once '../../model/masyarakat.php';

  include_once 'adm_session.php';

  $user = $_SESSION["detailUser"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Profil User</title>

  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/sidenavAdm.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    .kiri{
      float: left;
      width: 30%
    }

    .kanan{
      float: left;
      width: 70%;
    }

    .upload{
      margin-top: 60px;
      width: 230px;
      height: 230px;
    }

    #preview{
      object-fit: cover;
      border-radius: 50%;
      width: 100%;
      height: 100%;
    }

    input[type="file"]{
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0,0,0,0);
        border: 0;
      }

      .uploadIcon{
        margin-top: 20px;
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer; 
      }

      .uploadIcon:hover{
        background-color: lightgrey;
      }

      .btn.btn-warning, .btn.btn-primary{
        font-size: 16px;
        padding: 5px 20px;
      }

  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-10">

        <div class="breadcrumb">
          <li id="page"><a href="../../controller/c_admDataUser.php">Data User</a></li>
          <li>Profil User</li>
        </div>

        <div class="isi">
          <div class="kiri">
            <div class="pic">
              <div class="upload">
                <img src="../img/profil.png" id="preview">
              </div>
            </div>
          </div>

          <div class="kanan">
            <div class="atas" style="text-align: center; padding-bottom: 10px;">
              <h3>Profil User</h3>
            </div>
            <div class="form-group">
              <label for="namaDepan">Nama</label><br>
              <input class="form-control" type="text" name="nama" value="<?php echo $user->nama ?>" readonly>
              <!-- <div class="row">
                <div class="col-xs-6">
                  <label for="namaDepan">Nama Depan</label><br>
                  <input class="form-control" type="text" name="namaDepan" value="Budi" readonly>
                </div>
                <div class="col-xs-6">
                  <label for="namaBelakang">Nama Belakang</label><br>
                  <input class="form-control" type="text" name="namaBelakang" value="Susanto" readonly>
                </div>
              </div> -->
            </div>

            <div class="form-group">
              <label for="nik">NIK</label>
              <input class="form-control" type="text-align" name="nik" readonly value="<?php echo $user->nik ?>" >
            </div>

            <div class="form-group">
              <div class="form-inline">
                <label for="tgl_lahir" style="padding-right: 30px; font-size: 16px;">Tanggal lahir</label>
                <input class="form-control" type="date" name="tgl_lahir" readonly value="<?php echo $user->tgl_lahir ?>">
              </div>
            </div>

            <div class="form-group" style="">
              <label for="gender" style="padding-right: 30px;">Jenis Kelamin</label>
              <label class="radio-inline">
                <input type="radio" name="jenis_kelamin" value="Laki-laki" id="gender" disabled
                <?php 
                  if ($user->gender == "Laki-laki") {
                    echo "checked";
                  }
                 ?>
                >Laki-laki
              </label>

              <label class="radio-inline">
                <input type="radio" name="jenis_kelamin" value="Perempuan" " id="gender" disabled
                <?php 
                  if ($user->gender == "Perempuan") {
                    echo "checked";
                  }
                 ?>
                >Perempuan
              </label>
            </div>

            <div class="form-group">
              <label for="no_hp">No Hp</label>
              <input class="form-control" type="text" name="no_hp" value="<?php echo $user->noHP ?>" readonly>
            </div>

            <div class="form-group">
              <label for="email">E-mail</label>
              <input class="form-control" type="email" name="email" value="<?php echo $user->email ?>" readonly>
            </div>

            <div class="form-group">
              <div class="form-inline" style="">
                <label for="alamat">Alamat Tempat Tinggal</label>
                <textarea class="form-control" type="text" name="alamat" rows="5" style="width: 80%;" readonly><?php echo $user->alamat ?></textarea>
              </div>
            </div><br>

            <div class="form-group" style="text-align: center;">
              <a href="admDataUser.php" class="btn btn-default" type="button" style="margin-right: 10px;">Kembali</a>
            </div>

          </div>
        </div>
      </div>

      <?php include '../layout/A-sidebar.php'; ?>

    </div>
  </div>

<script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/sideActive.js"></script>
  <script type="text/javascript">

    var pic = "<?php echo $_SESSION["detailUser"]->picture ?>" ;
    if (pic == "") {
      $('#preview').attr('src', '../img/profil.png');
      $('#pic').attr('src', '../img/profil.png');
    } else {
      $('#preview').attr('src', "../"+pic);
      $('#pic').attr('src', "../"+pic);
    }

    function readURL(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#preview').show();
          $('#preview').attr('src', e.target.result);
          // $('#kata').hide();
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    // $("#preview").hide();

    $("#imgInp").change(function() {
      readURL(this);
    });
  </script>
</body>
</html>