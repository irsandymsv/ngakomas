<?php 
  include_once '../../model/admin.php';
  include_once 'adm_session.php';

  $kategori = $_SESSION["kategori"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Buat Pengumuman</title>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/sidenavAdm.css">
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
    margin: auto;
  }

  td{
    padding: 10px;
    /*padding-left: 30px;*/
  }

  .butt{
    text-align: center; 
    font-size: 18px;
  }

  .sign{
    font-family: sans-serif;
    color: red;
    font-size: 16px;
  }

  .fields{
    width: 85%;
    margin-right: auto;
    margin-left: auto;
  }

  #ann-empty{
    width: 60%;
    margin-right: auto;
    margin-left: auto;
    text-align: center;
    font-size: 17px;
    padding: 10px; 
  }

  .ruleImg{
    text-align: center;
    color: grey;
    
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
      <div class="col-md-10">

        <div class="breadcrumb">
          <li><a href="admAnn.php" id="page">Pengumuman</a></li>
          <li class="active">Buat Pengumuman</li>
        </div>

        <div class="isi">
          <h2 style="text-align: center;">Buat Pengumuman Baru</h2>
          <br>
          <form method="POST" action="../../controller/c_pengumumanCreate.php" enctype="multipart/form-data">
            <div class="image">
              <p id="kata"><span class="glyphicon glyphicon-camera"></span> Pilih gambar untuk pengumuman</p>
              <img src="#" id="preview" style="width: 100%;">  
            </div>
            <div class="btn-upload">
              <label for="imgInp" class="uploadIcon"><span class="glyphicon glyphicon-cloud-upload"></span> Pilih Gambar</label>
              <input type="file" name="picture" accept="image/*" id="imgInp">
            </div>

            <div class="ruleImg">
              <p><i>Maksimal Ukuran gambar 1MB dengan tipe .jpeg, .png, atau .gif</i></p>
            </div>
            <br>

            <div class="fields">
              <?php 
              if (!empty($_SESSION["validasi_ann"])) {
                echo '<div class="alert alert-danger" role="alert" id="ann-empty">'.
                        $_SESSION["validasi_ann"]
                      .'</div>'; 
              }
              ?>

              
              <div class="form-group">
                <label for="Judul">Judul<span class="sign">*</span></label>
                <input type="text" name="judul" class="form-control" placeholder="judul pengumuman">
                <p class="ruleForm"><i>Maksimal 50 karakter</i></p>
              </div>

              <div class="form-group">
                <label for="kategori">Kategori <span class="sign">*</span></label>
                <select class="form-control" name="kategori" style="width: 20%;">
                  <option value="">--Pilih Kategori--</option>
                  <?php foreach ($kategori as $key) {
                    echo '<option value="'.$key["id"].'">'.$key["nama"].'</option>';
                  }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="isi">Deskripsi<span class="sign">*</span></label>
                <textarea class="form-control" name="isi" rows="10" placeholder="dekripsi pengumuman"></textarea>
                <p class="ruleForm"><i>Maksimal 1000 karakter</i></p>
              </div>
              <p class="sign">*Harus Diisi</p>
            </div>
            
              
            <br>
            <div class="butt">
              <a class="btn btn-default" href="admAnn.php" type="button" style="font-size:17px; margin-right: 5px;">Batal</a>
              <button class="btn btn-primary" type="button" name="simpan" style="font-size: 17px;" data-toggle="modal" data-target="#myModal">Simpan</button>
            </div>

            <div id="myModal" class="modal fade" role="dialog" style="text-align: left;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Konfirmasi</h4>
                  </div>

                  <div class="modal-body">
                    <p>Apakah anda yakin ingin menyimpan dan menyebarkan pengumuman ini?</p>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="padding: 5px 15px;">Tidak</button>
                    <button class="btn btn-primary" type="submit" id="submit" name="submit" style="padding: 5px 20px;">Ya</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <?php include '../layout/A-sidebar.php'; ?>

    </div>
  </div>

  <script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../js/sideActive.js"></script>
  <script type="text/javascript">
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
        var kategori = $('textarea[name="kategori"]').val();
        var isi = $('textarea[name="isi"]').val();

        var alphaNumeric = /^[a-zA-Z0-9 ]+$/;
        
        if (judul == "" ||  kategori == "" || isi == "") {
          alert("Harap isi data pengumuman dengan lengkap");
        }
        else if(judul.length > 50){
          alert("Harap isi judul dengan maksimal 50 karakter");
        }
        else if(isi.length > 1000){
          alert("Harap isi deskripsi dengan maksimal 1000 karakter ");
        }
        else if(!alphaNumeric.test(judul)) {
          alert("Harap isi judul dengan huruf, angka, dan spasi saja"); 
        }
        else{

          $('#submit').off('click').trigger('click');
          
          // $('form').submit();
        }
      }); 
      
    });


  </script>
</body>
</html>

<?php 
unset($_SESSION["validasi_ann"]);
?>