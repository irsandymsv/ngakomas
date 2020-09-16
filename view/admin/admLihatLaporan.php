<?php 
  include_once '../../model/admin.php';
  include_once '../../model/laporan.php';
  include_once '../../model/komentar.php';
  include_once 'adm_session.php';

  $laporan = $_SESSION["laporan"];
  $komentar = $_SESSION["komentar"];
  // $kec =  $_SESSION["laporan"][1];
  // $kel =  $_SESSION["laporan"][2];
  $tgl = date_create($laporan->tgl_laporan, timezone_open('Asia/Jakarta'));

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Ngakomas - Lihat Laporan</title>

  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/sidenavAdm.css">
  <style type="text/css">
  .kepala{
    overflow: hidden;
    padding-bottom: 10px;
  }
  .kiri{
    float: left;
    width: 45%;
  }

  .kanan{
    float: left;
    width: 55%;
    padding: 10px;
    padding-top: 0px;
  }

  .pic{
    overflow: hidden;
    padding: 10px; 
    width: 100%;
    /*height: 200px;*/
    /*background-color: yellow;*/
  }

  .komen{
    margin-top: 0px; 
    /*background-color: green;*/
  }

  .com{
    padding: 10px;
    /*background: lightgrey;*/
    padding-bottom: 1px;
    margin-top: 5px;
  }

  #newCom{
    padding: 10px;
    padding-bottom: 1px;
    margin-top: 10px;
    /*background-color: lightgrey;*/
  }

  .btn.btn-success, .btn.btn-primary, .btn.btn-danger, .btn.btn-default{
    padding: 1px 5px;
    margin-top: 5px;
  }

  .judul{
    float: left;
    width: 70%;
    padding-left: 10px;
  }

  .keterangan{
    margin-top: 10px;
    overflow: hidden;
  }

  .ket{
    padding: 5px;
    width: 40%;
    text-align: center;
    background-color: rgb(235,235,235);
    margin-right: 10px;
    border-radius: 10px;
  }

  .tanggal{
    float: left;
  }

  .status{
    float: right;
    color: white;
  }

  .lokasi{
    padding: 10px;
    margin-top: 10px;
    background-color: rgb(235,235,235);
    margin-right: 10px;
    border-radius: 10px;
  }

  .des{
    padding: 10px;
    margin-top: 10px;
    background-color: rgb(235,235,235);
    font-size: 15px;
    border-radius: 10px;
    white-space: pre-line;
  }

  .confirm{
    float: left;
    width: 30%;
    text-align: right;
    padding: 13px;
    padding-right: 20px;
  }

  .comment_content{
    white-space: pre-wrap;
  }

</style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-10">

        <div class="breadcrumb">
          <li><a href="../../controller/c_laporanPage.php" id="page">Laporan</a></li>
          <li class="active">Detail Laporan</li>
        </div>

        <div class="isi">
          <div class="kepala">
            <div class="judul">
              <h2>
                <?php 
                if (!empty($_SESSION["laporan"])) {
                  echo $laporan->judul; 
                }
                ?>
              </h2>
            </div>

            <?php if($laporan->status != "Selesai") {?>
            <form class="confirm" method="POST" action="../../controller/c_ubahStatusLap.php">
              <input type="hidden" id="lapStatus" name="status" value="<?php echo $laporan->status ?>">
              <button id="toConfirmed" class="btn btn-success" type="button" style="padding: 5px 10px; font-size: 15px;" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-ok" style="margin-right: 10px;"></span>Konfirmasi</button>

              <button id="toDone" class="btn btn-primary" type="button" style="padding: 5px 10px; font-size: 15px;" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-ok" style="margin-right: 10px;"></span>Selesai</button>

              <div id="myModal" class="modal fade" role="dialog" style="text-align: left;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Konfirmasi</h4>
                    </div>

                    <div class="modal-body">
                      <p id="ask"></p>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" style="padding: 5px 15px;">Tidak</button>
                      <button id="btn-toDone" class="btn btn-success" type="submit" name="submit" style="padding: 5px 20px;">Ya</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <?php } ?>
          </div>

          <div class="kiri">
            <div class="pic">
              <img src="#" id="preview" style="width: 100%;">
            </div>
            <div class="komen">
              <br>
              <h4>Komentar</h4>
              <div style="background-color: grey; height: 1px;"></div>

              <?php 
              if (!empty($komentar)) {
                foreach ($komentar as $kom) {
                  $tgl_komen_dibuat = date_create($kom->dibuat, timezone_open('Asia/Jakarta'));
                  $tgl_komen_diubah = date_create($kom->diubah, timezone_open('Asia/Jakarta'));
                  echo '<div class="com" id="komen'.$kom->id.'">
                    <form name="komenEdit'.$kom->id.'" id="'.$kom->id.'" method="POST" action="../../controller/c_editKomentar.php?id='.$kom->id.'" class="form-group">
                      <p>
                      <a href="../../controller/c_admDetailUser.php?id='.$kom->id_penulis.'" >'.$kom->penulis.'</a> 
                      <span style="margin-left: 5px; color: grey;"><i>'.date_format($tgl_komen_dibuat, "d M Y H:i").'</i></span>
                      </p>
                      <p class="comment_content" id="'.$kom->id.'">'.$kom->isi.'</p>
                      <textarea id="'.$kom->id.'" name="isi" class="form-control" rows="2" cols="40" style="display:none;">'.$kom->isi.'</textarea>';

                      if ($kom->diubah != "") {
                        echo '<p style="color: grey;"><i>Terakhir diubah: '.date_format($tgl_komen_diubah, "d M Y H:i").'</i></p>';
                      }
                      
                      if (!empty($_SESSION["editKomen-validasi".$kom->id])) {
                        echo '<p style="color: red;">'.$_SESSION["editKomen-validasi".$kom->id].'</p>';
                        unset($_SESSION["editKomen-validasi".$kom->id]);
                      }
                      
                      if ($kom->id_penulis == $_SESSION["user"]->id) {
                        echo '<div class="form-inline">
                                <input name="sendEdit" id="'.$kom->id.'" class="btn btn-success" type="submit" value="Simpan">
                                <button class="btn btn-primary" type="button" name="edit" id="'.$kom->id.'">Edit</button>
                                <a class="btn btn-default" name="tutup" id="'.$kom->id.'" type="button" >Batal</a>
                                <button class="btn btn-danger" type="button" name="del-btn" id="'.$kom->id.'" data-toggle="modal" data-target="#delModal" >Hapus</button>
                              </div>';
                      }
                      
                    echo '</form>
                    <div style="background-color: grey; height: 1px;"></div>
                  </div>';
                }
              }
              else{
                echo '<p style="font-size: 16px; margin-top: 10px;">Tidak ada komentar</p>';
              }
              ?>

              <div id="delModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Konfirmasi</h4>
                    </div>

                    <div class="modal-body">
                      <p>Apakah anda yakin ingin menghapus komentar ini ?</p>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" style="padding: 5px 15px;">Tidak</button>
                      <a href="#" class="btn btn-danger" type="button" id="deleteKomen" style="padding: 5px 20px;">Ya</a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- <div class="com">
                <form method="POST" action="" class="form-group">
                  <a href="#"><p>Nama orang</p></a>
                  <textarea id="1" name="txt" class="form-control" rows="2" cols="40" readonly >semangat pak!</textarea>
                  <div class="form-inline">
                    <input id="1" class="btn btn-success" type="submit" name="sendEdit" value="Kirim">
                    <button class="btn btn-primary" type="button" name="edit" id="1" >Edit</button>
                    <a class="btn btn-default" name="1" type="button" >Batal</a>
                    <a href="#" class="btn btn-danger">Hapus</a>
                  </div>
                </form>
                <div style="background-color: grey; height: 1px;"></div>
              </div> -->

              <div id="newCom">
                <p><b>Buat komentar baru</b></p>
                <form method="POST" action="../../controller/c_buatKomentar.php" class="form-group">
                  <textarea class="form-control" name="isiBaru" rows="2" cols="40" placeholder="Tulis komentar..."></textarea>
                  <?php 
                  if (!empty($_SESSION["newKomen-validasi"])) {
                    echo '<p style="color: red;">'.$_SESSION["newKomen-validasi"].'</p>';
                  }
                  ?>
                  <button  class="btn btn-success" type="submit" id="komenBaru">Kirim</button>
                </form>
              </div>

              <p style="color: grey;"><i>Maksimal 500 karakter</i></p>
            </div>
          </div>

          <div class="kanan">
            <div class="keterangan">

              <div class="ket tanggal">
                <?php 
                  if (!empty($_SESSION["laporan"])) {
                    echo date_format($tgl, "d M Y")." - ".date_format($tgl, "H:i")." WIB"; 
                  }
                ?>
              </div>
              
              <div class="ket status">
                <?php 
                if (!empty($_SESSION["laporan"])) {
                  echo $laporan->status;
                }
              ?>
              </div>

            </div>

            <div class="lokasi">
                <?php 
                  if (!empty($_SESSION["laporan"])) {
                    echo $laporan->alamat." - ".$laporan->kelurahan." - ".$laporan->kecamatan; 
                  }
                ?>
              </div>

            <div class="des"><?php 
                echo $laporan->deskripsi;
              ?>
            </div>

            <?php
            $diubah = date_create($laporan->diubah, timezone_open('Asia/Jakarta'));
              if ($laporan->diubah != "") {
                echo '<p><i>Terakhir diubah: '.date_format($tgl, "d M Y H:i").'</i></p>';
              }
              
            ?>

          </div>
        </div>
      </div>

      <?php include '../layout/A-sidebar.php'; ?>

    </div>
  </div>
</div>

<script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/sideActive.js"></script>
<script type="text/javascript">

  var lapImg = "<?php echo $_SESSION["laporan"]->picture ?>";
  if (lapImg == "") {
    $('#preview').attr('src', '../../storage/no_img.jpg');
  } else {
    $('#preview').attr('src', "../"+lapImg);
  }

  var statChange = '<?php echo isset($_SESSION["status-change"])? $_SESSION["status-change"]: '' ?>' ;
  if (statChange != "") {
    setTimeout(function() {alert(statChange);}, 300);
  }

  var lapStat = '<?php echo $laporan->status ?>';
  if (lapStat == "Belum diverifikasi") {
    $('.ket.status').css('background-color', '#da190b');
    $('#toConfirmed').show();
    $('#toDone').hide();
    $('#ask').text('Apakah anda yakin ingin mengkonfirmasi laporan ini?');
  }
  else if(lapStat == "Sedang ditangani"){
    $('.ket.status').css('background-color', '#ffa31a');
    $('#toConfirmed').hide();
    $('#toDone').show();
    $('#btn-toDone').attr('class', 'btn btn-primary');
    $('#ask').text('Apakah anda yakin ingin mengubah status laporan ini menjadi selesai?');
  }
  else if (lapStat == "Selesai") {
    $('.ket.status').css('background-color', '#00cc66');
    // $('#toConfirmed').hide();
    // $('#toDone').hide();
  }

  $('#toConfirmed').click(function() {
    $('#lapStatus').val("Sedang ditangani");
  });

  $('#toDone').click(function() {
    $('#lapStatus').val("Selesai");
  });


  $('input[name="sendEdit"]').hide();
  $('a[name="tutup"]').hide();
  var isi ="";
  
  $("button[name='edit']").click(function() {  
    var btn = $(this).attr('id');
    console.log('id edit ='+btn);
    isi = $("textarea[id="+btn+"]").val();
    // $("textarea[id="+btn+"]").removeAttr('readonly');
    $("textarea[id="+btn+"]").show();
    $("p[id="+btn+"]").hide();
    $("button[id="+btn+"]").hide(); //hide edit, delete btn
    $("input[id="+btn+"]").show(); //show simpan btn
    $("a[id="+btn+"]").show(); //show batal btn
  });

  $("a[name='tutup']").click(function() {
    var def = $(this).attr('id');
    console.log('id tutup ='+def);
    // $("textarea[id="+def+"]").attr('readonly', "");
    $("textarea[id="+def+"]").hide();
    $("p[id="+def+"]").show();
    $("textarea[id="+def+"]").val(isi);
    $("button[id="+def+"]").show(); //show edit, delete btn
    $("input[id="+def+"]").hide(); // hide simpan btn
    $("a[id="+def+"]").hide(); //hide batal btn
  });

  $("button[name='del-btn']").click(function() {
    var id = $(this).attr('id');
    $('#deleteKomen').attr('href', '../../controller/c_hapusKomentar.php?id='+id);
  });

  jQuery(document).ready(function($) {
    $('#komenBaru').on('click', function(event) {
      event.preventDefault();
      var newKomen = $('textarea[name="isiBaru"]').val();

      if (newKomen.length > 500) {
        alert("Harap isi komentar dengan maksimal 500 karakter");
      } 
      else {
        $('#komenBaru').off('click').trigger('click');
      }
    }); 

    $('input[name="sendEdit"]').on('click',function(event) {
      event.preventDefault();
      var idKom = $(this).attr('id');

      var isiKomen = $('textarea[id='+idKom+']').val();

      if (isiKomen.length > 500) {
        alert("Harap isi komentar dengan maksimal 500 karakter");
      } 
      else {
        // $('input[type="submit"]').off('click').trigger('click');
        $('form#'+idKom).submit();
      }
    });
  });


  
</script>
</body>
</html>

<?php 
  unset($_SESSION["status-change"]);
  unset($_SESSION["newKomen-validasi"]);
  // unset($_SESSION["editKomen-validasi"]);
?>