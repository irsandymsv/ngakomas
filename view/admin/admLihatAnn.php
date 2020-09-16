<?php 
  include_once '../../model/admin.php';
  include_once '../../model/pengumuman.php';

  include_once 'adm_session.php';

  $pengumuman = $_SESSION["pengumuman"];
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

</style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-10">

        <div class="breadcrumb">
          <li><a href="../../controller/c_pengumumanPage.php" id="page">Pengumuman</a></li>
          <li class="active">Detail Pengumuman</li>
          <li></li>
        </div>

        <div class="isi">
          <h2 style="text-align: center;">Detail Pengumuman</h2>
          <br>
          <form method="POST" action="#">
            <div class="image">
              <img src="" id="preview" style="width: 100%;">  
            </div>
            <br>

            <table>
              <tr>
                <td style="width: 80px;"><label for="Judul">Judul</label></td>
                <td><input type="text" name="judul" class="form-control" readonly value="<?php echo $pengumuman->judul ?>" style="width: 760px;"></td>
              </tr>
              <tr>
                <td><label for="dibuat">Tanggal/Waktu</label></td>
                <td><input type="text" name="dibuat" class="form-control" readonly style="width: 30%;" value="<?php echo $pengumuman->dibuat ?>"></td>
              </tr>
              <tr>
                <td><label for="kategori">Kategori</label></td>
                <td>
                  <input class="form-control" type="text" name="kategori" style="width: 20%;" readonly value="<?php echo $pengumuman->kategori ?>" >
                </td>
              </tr>
              <tr>
                <td><label for="dekripsi">Deskripsi</label></td>
                <td>
                  <textarea class="form-control" rows="10" readonly><?php echo $pengumuman->isi ?></textarea>
                </td>
              </tr>
            </table>

            <br>
            <div class="butt">
              <a class="btn btn-default" href="../../controller/c_pengumumanPage.php" type="button" style="padding: 10px 20px; margin-right: 5px; font-size: 15px;">Kembali</a>
              <a href="../../controller/c_annEditPage.php?id=<?php echo $pengumuman->id ?>" class="btn btn-warning" name="ubah" style="padding: 10px 20px; margin-right: 5px; font-size: 15px;">Ubah</a>
              <input href="#" class="btn btn-danger" type="button" style="padding: 10px 20px; font-size: 15px;" value="Hapus" data-toggle="modal" data-target="#myModal">
            </div>
            <div id="myModal" class="modal fade" role="dialog" style="text-align: left;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Konfirmasi</h4>
                  </div>

                  <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus pengumuman ini?</p>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="padding: 5px 15px;">Tidak</button>
                    <a href="../../controller/c_hapusPengumuman.php?id=<?php echo $pengumuman->id ?>" class="btn btn-danger" type="submit" name="submit" style="padding: 5px 20px;">Ya</a>
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

    var lapImg = "<?php echo $_SESSION["pengumuman"]->picture ?>";
    if (lapImg == "") {
      $('#preview').attr('src', '../../storage/no_img.jpg');
    } else {
      $('#preview').attr('src', "../"+lapImg);
    }

    // function readURL(input) {

    //   if (input.files && input.files[0]) {
    //     var reader = new FileReader();

    //     reader.onload = function(e) {
    //       $('#preview').show();
    //       $('#preview').attr('src', e.target.result);
    //       $('#kata').hide();
    //     }

    //     reader.readAsDataURL(input.files[0]);
    //   }
    // }    

    // $("#imgInp").change(function() {
    //   readURL(this);
    // });
  </script>
</body>
</html>