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
  <title>Buat Laporan</title>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/sidenavM.css">
  <style type="text/css">
    .btn-upload{
      text-align: center;
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

    .image{
      margin: auto;
      width: 50%;
      min-height: 100px;
      border: 2px dashed navy;
    }

    #kata{
      text-align: center; 
      color: lightgrey; 
      line-height: 100px;
    }

    .form-control{
      /*background-color: lightgrey;*/
    }

    table{
      margin-left: 50px;
    }

    td{
      padding: 10px;
      
    }

    .fields{
      width: 80%;
      margin-right: auto;
      margin-left: auto;
    }

    .sign{
      color: red;
      font-family: sans-serif;
      font-size: 16px;
    }

    .butt{
      text-align: center; 
      font-size: 18px;
    }

    .ruleImg{
      text-align: center;
      color: grey;
      margin-top: -20px;
    }

    .ruleForm{
      font-size: 11px;
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
          <li><a href="laporan.php" id="page">Laporan</a></li>
          <li class="active">Buat Laporan</li>
        </div>

        <div class="isi">
          <h2 style="text-align: center;">Buat Laporan Baru</h2>
          <br>
          <form method="POST" action="../../controller/c_laporanCreate.php" enctype="multipart/form-data">

            <div class="image">
              <p id="kata"><span class="glyphicon glyphicon-camera"></span> Pilih gambar untuk laporan anda</p>
              <img src="#" id="preview" style="width: 100%;">  
            </div>
            
            <div class="btn-upload">
              <label for="imgInp" class="uploadIcon"><span class="glyphicon glyphicon-cloud-upload"></span> Pilih Gambar</label>
              <input type="file" name="picture" accept="image/*" id="imgInp">
            </div>
            <br>

            <div class="ruleImg">
              <p><i>Maksimal Ukuran gambar 1MB dengan tipe .jpeg, .png, atau .gif</i></p>
            </div>

            <div class="fields">
              <?php
                if (isset($_SESSION["lapor-salah"])) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo $_SESSION["lapor-salah"];
                    echo '</div>'; 
                }
              ?>

              <br>
              <div class="form-group">
                <label for="judul">Judul<span class="sign">*</span></label>
                <input type="text" name="judul" class="form-control" placeholder="judul laporan anda">
                <p class="ruleForm"><i>Maksimal 50 karakter</i></p>
              </div><br>

              <div class="form-group">
                <label for="alamat">Lokasi<span class="sign">*</span></label>
                <textarea class="form-control" name="alamat" rows="2" placeholder="Alamat"></textarea>
                <p class="ruleForm"><i>Maksimal 100 karakter</i></p>

                <div class="form-inline" style="margin-top: 10px;">
                  <label for="kecamatan">Kecamatan<span class="sign">*</span></label>
                  <select class="form-control" id="kecamatan" name="kecamatan" style="margin-right: 15px;">
                    <option value="">--Pilih Kecamatan--</option>
                    <?php 
                      foreach ($_SESSION["kecamatan"] as $kec) {
                        echo '<option value="'.$kec["id"].'">'.$kec["nama"].'</option>';
                      }
                     ?>
                  </select>
                  <label for="kelurahan">Kelurahan<span class="sign">*</span></label>
                  <select class="form-control" id="kelurahan" name="kelurahan">
                    <option value="">--Pilih kelurahan--</option>
                    <?php 
                      foreach ($_SESSION["kelurahan"] as $kel) {
                        echo '<option value="'.$kel["id"].'">'.$kel["nama"].'</option>';
                      }
                     ?>
                  </select>
                </div>
              </div><br>

              <div class="form-group">
                <label for="tgl_laporan">Tanggal/waktu<span class="sign">*</span></label>
                <input type="datetime-local" name="tgl_laporan" id="tgl_laporan" class="form-control" style="width: 30%;" max="">
              </div><br>

              <div class="form-group">
                <label for="deskripsi">Deskripsi Laporan<span class="sign">*</span></label>
                <textarea class="form-control" name="deskripsi" rows="5" placeholder="dekripsi laporan anda"></textarea>
                <p class="ruleForm"><i>Maksimal 1000 karakter</i></p>
              </div>

              <input type="hidden" name="status" value="Belum diverifikasi">

              <p class="sign">*Harus diisi</p>
            </div>

            <br>
            <div class="butt">
              <a class="btn btn-default" href="laporanPage.php" type="button" style="font-size:17px; margin-right: 5px;">Kembali</a>
              <button class="btn btn-primary" type="button" name="laporkan" style="font-size:17px;" data-toggle="modal" data-target="#myModal">Laporkan</button>
            </div>

            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Konfirmasi</h4>
                  </div>

                  <div class="modal-body">
                    <p>Apakah anda yakin ingin melapor?</p>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button class="btn btn-primary" id="submit" type="submit" name="submit" style="padding: 5px 20px;">Ya</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
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

    var d = new Date();
    $(window).on('load', function() {
      event.preventDefault();
      $('#tgl_laporan').attr('max', d.toISOString());
      
    });
    console.log(d.toISOString());
    
    function readURL(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#preview').show();
          $('#preview').attr('src', e.target.result);
          $('#kata').hide();
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#preview").hide();

    $("#imgInp").change(function() {
      readURL(this);
    });

    jQuery(document).ready(function($) {
      $('#submit').on('click', function(event) {
        event.preventDefault();
        var judul = $('input[name="judul"]').val();
        var alamat = $('textarea[name="alamat"]').val();
        var kecamatan = $('select[name="kecamatan"]').val();
        var kelurahan = $('select[name="kelurahan"]').val();
        var tgl_laporan = $('input[name="tgl_laporan"]').val();
        var deskripsi = $('textarea[name="deskripsi"]').val();

        var alphaNumeric = /^[a-zA-Z0-9 ]+$/;
        
        if (judul == "" ||  alamat == "" || kecamatan == "" || kelurahan == "" || tgl_laporan == ""|| deskripsi == "") {
          alert("Harap isi data laporan dengan lengkap");
        }
        else if(judul.length > 50){
          alert("Harap isi judul dengan maksimal 50 karakter");
        }
        else if(alamat.length > 100){
          alert("Harap isi alamat dengan maksimal 100 karakter");
        }
        else if(deskripsi.length > 1000){
          alert("Harap isi deskripsi dengan maksimal 1000 karakter ");
        }
        else if(!alphaNumeric.test(judul)) {
          alert("Harap isi judul dengan huruf, angka, dan spasi saja"); 
        }
        else{
          var today = new Date();
          var tgl = new Date(tgl_laporan);

          if (today.getTime() < tgl.getTime()) {
            alert("Harap pilih tanggal/waktu sebelum hari/saat ini");
            stop();
          }
          else{
            console.log('in-time');
            $('#submit').off('click').trigger('click');
          }
          // $('form').submit();
        }
      }); 
      
    });

    //AJAX dependent dropdown
    $(document).ready(function() {
      $('#kecamatan').on('change', function(event) {
        event.preventDefault();
        var id_kec = $(this).val();

        $.ajax({
          url: '../../controller/c_ajax_kec-kel.php',
          type: 'POST',
          data: {"kec": id_kec},
        })
        .done(function(hasil) {
          console.log("success");
          $('#kelurahan').html(hasil);
        })
        .fail(function(xhr, status, error) {
          console.log("error");
          console.log(xhr.responseText);
        })
        .always(function() {
          console.log("complete");
        });
          
      });
    });

  </script>
</body>
</html>

<?php 
  unset($_SESSION["lapor-salah"]);

 ?>