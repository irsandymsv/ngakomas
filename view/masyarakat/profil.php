<?php 
  include_once '../../model/masyarakat.php';

  include_once 'masya_session.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Profil</title>

  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/sidenavM.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    .kiri{
      float: left;
      width: 30%
    }

    .kanan{
      float: left;
      width: 70%;
    }

    .pic{
      margin-top: 0px;
      padding: 10px;
    }

    .upload{
      /*margin: auto;*/
      width: 230px;
      height: 230px;
      /*min-height: 100px;*/
      /*border: 2px dashed navy;*/
      /*border-radius: 50%;*/
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
      <?php include("../layout/M-sidebar.php") ?> 

      <div class="col-md-10">

        <div class="breadcrumb">
          <li id="page">Profil</li>
          <li></li>
        </div>

        <div class="isi">
          <div style="text-align: center;">
            <h3><b>Profil</b></h>
          </div>
          <div class="kiri">
            <div class="pic">
              <div class="upload">
                <img src="../img/profil.png" id="preview">
              </div>
              <!-- <div class="btn-upload">
                <label for="imgInp" class="uploadIcon"><span class="glyphicon glyphicon-cloud-upload"></span> Pilih Gambar</label>
                <input type="file" name="image" accept="image/*" id="imgInp">
              </div> -->
            </div>
          </div>

          <div class="kanan">
            <!-- <form action="" method="POST"> -->
              
              <div class="form-group">
                <label for="namaDepan">Nama</label><br>
                <input class="form-control" type="text" name="nama" readonly value="<?php echo $user->nama ?>" >
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
                <input class="form-control" type="text-align" name="nik" value="<?php echo $user->nik ?>" readonly>
              </div>

              <div class="form-group">
                <div class="form-inline">
                  <label for="tgl_lahir" style="padding-right: 30px; font-size: 16px;">Tanggal lahir</label>
                  <input class="form-control" type="date" name="tgl_lahir" value="<?php echo $user->tgl_lahir ?>" readonly>
                </div>
              </div>

              <div class="form-group" style="">
                <label for="gender" style="padding-right: 30px;">Jenis Kelamin</label>
                <label class="radio-inline">
                  <input type="radio" name="gender" value="Laki-laki" id="gender" disabled
                    <?php if ($user->gender == "Laki-laki") {
                      echo "checked";
                    } ?>
                  >Laki-laki
                </label>

                <label class="radio-inline">
                  <input type="radio" name="gender" value="Perempuan" " id="gender" disabled
                  <?php if ($user->gender == "Perempuan") {
                      echo "checked";
                    } ?>
                  >Perempuan
                </label>
              </div>

              <div class="form-group">
                <label for="no_hp">No Hp</label>
                <input class="form-control" type="text" name="noHP" value="<?php echo $user->noHP ?>" readonly>
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
                <a href="editProfil.php" class="btn btn-primary" type="button" style="margin-right: 10px;">Ubah Profil</a>
                <a href="ubahPassword.php" class="btn btn-warning" type="button">Ubah Password</a>
              </div>

            <!-- </form> -->
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/sideActive.js"></script>
<script type="text/javascript">
    var sukses = '<?php echo isset($_SESSION["suskses-pass"])? $_SESSION["suskses-pass"] :"" ?>' ;
    if (sukses != "") {
      setTimeout(function() {alert(sukses);}, 400);
    }
</script>

<script type="text/javascript">
    var pic = "<?php echo $_SESSION["user"]->picture ?>" ;
    if (pic == "") {
      $('#preview').attr('src', '../../storage/profil.png');
      $('#pic').attr('src', '../../storage/profil.png');
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

<?php 
  unset($_SESSION["suskses-pass"]);

?>