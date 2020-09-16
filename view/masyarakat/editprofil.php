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
  <title>Ngakomas - Profil</title>

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
    margin-top: 60px;
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

  img {
    object-fit: cover;
    border-radius: 50%;
    width: 100%;
    height: 100%;
  }

  .btn-upload{
    margin-left: 50px;
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

  .btn.btn-default, .btn.btn-primary{
    font-size: 16px;
    padding: 5px 20px;
  }

  .ruleImg{
    width: 70%;
    margin-top: 10px; 
    text-align: center;
    margin-left: 20px;
    /*margin-right: auto;
    margin-left: auto;*/
    color: grey;
  }

</style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <?php include("../layout/M-sidebar.php") ?> 

      <div class="col-md-10">

        <div class="breadcrumb">
          <li id="page"><a href="profil.php">Profil</a></li>
          <li class="active">Ubah Profil</li>
        </div>

        <form action="../../controller/c_editProfil.php" method="POST" enctype="multipart/form-data">
          <div class="isi">

            <div class="kiri">
              <div class="pic">
                <div class="upload">
                  <img src="../img/profil.png" id="preview">
                </div>
                <div class="btn-upload">
                  <label for="imgInp" class="uploadIcon"><span class="glyphicon glyphicon-cloud-upload"></span> Pilih Gambar</label>
                  <input type="file" name="uploadImage" accept="image/*" id="imgInp">
                </div>
                <div class="ruleImg">
                  <p><i>Maksimal Ukuran gambar 1MB dengan tipe .jpeg, .png, atau .gif</i></p>
                </div>
              </div>
            </div>

            <div class="kanan">
              <div class="atas" style="text-align: center; padding-bottom: 20px;">
                <h3>Ubah Profil</h3>
              </div>
              <?php 
                if (isset($_SESSION["tdk-valid"])) {
                  echo "<div class="." 'alert alert-danger' "." role= "." 'alert' ".">";
                  echo $_SESSION["tdk-valid"];
                  echo "</div>"; 
                }
              ?>
              <div class="form-group">
                <label for="nama">Nama</label><br>
                <input class="form-control" type="text" name="nama" value="<?php echo $user->nama ?>" >
                <!-- <div class="row">
                  <div class="col-xs-6">
                    <label for="namaDepan">Nama Depan</label><br>
                    <input class="form-control" type="text" name="namaDepan" value="Budi" >
                  </div>
                  <div class="col-xs-6">
                    <label for="namaBelakang">Nama Belakang</label><br>
                    <input class="form-control" type="text" name="namaBelakang" value="Susanto" >
                  </div>
                </div> -->
              </div>

              <div class="form-group">
                <label for="nik">NIK</label>
                <input class="form-control" type="text-align" name="nik" value="<?php echo $user->nik ?>" >
              </div>

              <div class="form-group">
                <div class="form-inline">
                  <label for="tgl_lahir" style="padding-right: 30px; font-size: 16px;">Tanggal lahir</label>
                  <input class="form-control" type="date" name="tgl_lahir" value="<?php echo $user->tgl_lahir ?>">
                </div>
              </div>

              <div class="form-group" style="">
                <label for="gender" style="padding-right: 30px;">Jenis Kelamin</label>
                <label class="radio-inline">
                  <input type="radio" name="gender" value="Laki-laki" id="gender"
                  <?php if ($user->gender == "Laki-laki") {
                      echo "checked";
                    } ?>
                  >Laki-laki
                </label>

                <label class="radio-inline">
                  <input type="radio" name="gender" value="Perempuan" " id="gender"
                  <?php if ($user->gender == "Perempuan") {
                      echo "checked";
                    } ?>
                  >Perempuan
                </label>
              </div>

              <div class="form-group">
                <label for="no_hp">No Hp</label>
                <input class="form-control" type="text" name="noHP" value="<?php echo $user->noHP ?>">
              </div>

              <div class="form-group">
                <label for="email">E-mail</label>
                <input class="form-control" type="email" name="email" value="<?php echo $user->email ?>" >
              </div>

              <div class="form-group">
                <div class="form-inline" style="">
                  <label for="alamat">Alamat Tempat Tinggal</label>
                  <textarea class="form-control" type="text" name="alamat" rows="5" style="width: 80%;"><?php echo $user->alamat ?></textarea>
                </div>
              </div><br>

              <div class="form-group" style="text-align: center;">
                <a href="profil.php" class="btn btn-default" type="button" style="margin-right: 10px; background-color: rgb(240,240,240);">Batal</a>
                <button class="btn btn-primary" type="button" name="simpan" data-toggle="modal" data-target="#myModal">Simpan</button>
              </div>

              <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Konfirmasi</h4>
                    </div>

                    <div class="modal-body">
                      <p>Apakah anda yakin ingin mengubah profil?</p>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" style="padding: 5px 15px;">Tidak</button>
                      <button class="btn btn-primary" type="submit" id="submit" name="submit" style="padding: 5px 20px;">Ya</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../js/sideActive.js"></script>
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


    jQuery(document).ready(function($) {
      $('#submit').on('click', function(event) {
        event.preventDefault();
        var nama = $('input[name="nama"]').val();
        var nik = $('input[name="nik"]').val();
        var tgl_lahir = $('input[name="tgl_lahir"]').val();
        var noHP = $('input[name="noHP"]').val();
        var email = $('input[name="email"]').val();
        var gender = $('input[name="gender"]').val();
        var alamat = $('textarea[name="alamat"]').val();

        var alphabet = /^[a-zA-Z' ]+$/;
        var nikReg = /^[0-9]{16}$/;
        var number = /^\d+$/;
        var passRegex = /^(?=.*?[A-Za-z])(?=.*?[0-9]).{8,}$/;
        console.log(nama);
        console.log(alphabet.test(nama));
        console.log('alamat length= '+alamat.length);
        
        if (nama == "" ||  nik == "" || tgl_lahir == "" || noHP == "" || email == ""|| gender == "" || alamat == "") {
          alert("Harap isi data diri dengan lengkap");
        }
        else if(!alphabet.test(nama)){
          alert("Harap isi nama dengan huruf");
        }
        else if(!nikReg.test(nik)){
          alert("Harap isi NIK dengan tepat 16 angka");
        }
        else if(!number.test(noHP)){
          alert("Harap isi nomor HP dengan angka");
        }
        else if(alamat.length > 200){
          alert("Isi alamat dengan maksimal 200 karakter");
        }
        else{
          var today = new Date();
          var tgl_input = $('input[name="tgl_lahir"]').val();
          var tgl_baru = new Date(tgl_input);

          if (today.getTime() < tgl_baru.getTime()) {
            alert("Harap pilih tanggal/waktu sebelum hari/saat ini");
            stop();
          }
          else{
            console.log('in-time');
            $('#submit').off('click').trigger('click');
            // $('form').submit();
          }

        }
      }); 
      
    });


  </script>
</body>
</html>

<?php unset($_SESSION["tdk-valid"]); ?>