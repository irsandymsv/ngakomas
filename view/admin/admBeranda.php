<?php 
  include_once '../../model/admin.php';
  include_once '../../model/laporan.php';
  include_once '../../model/notifikasi.php';
  
  include_once 'adm_session.php';
  $lapAll = $_SESSION["laporan-all"];
  $notif_laporan = $_SESSION["notif_laporan"];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Laporan</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/sidenavAdm.css">
    <style type="text/css">
      .table-responsive{
        padding-top: 20px;
        width: 100%;
        /*margin: auto;*/
      }

      .laporan{
        padding: 5px;
      }

      .sambutan{
        padding: 15px;
        border-radius: 10px;
        background-color: rgba(70, 185, 74, 0.9);
        color: white;
      }

      .table-responsive{
        font-size: 15px;
      }

      td:first-child{
        text-align: center;
      }

      #ball{
        display: inline-block;
        margin-left: 10px;
        width: 15px;
        height: 15px;
        background-color: rgb(0, 170, 0);
        border-radius: 50%;
      }
    </style>
  </head>
  <body>
  <div class="container-fluid">
    <div class="row">
      
      <div class="col-md-10">

        <div class="breadcrumb">
          <li class="active" id="page">Beranda</li>
          <li></li>
        </div>

        <div class="isi">
          <div class="sambutan">
            <h3>Selamat Datang</h3>
            <p style="font-size: 16px;">Jangan lupa untuk secara rutin mengganti passwors anda</p>
          </div>
          <div class="laporan">
            <h3>Laporan Terbaru</h3>
            <div class="table-responsive">
              <table class="table table-striped">
                <tr style="background-color: rgb(50,50,50); color: white;">
                  <th>No</th>
                  <th>Judul</th>
                  <th>Tanggal Dibuat</th>
                  <th>Pelapor</th>
                  <th>Lokasi</th>
                  <th>Status</th>
                </tr>
                <tbody id="body-tab">

                  <?php 
                  $no = 0;
                  
                  for ($i=0; $i < 4; $i++) { 
                    $no = $no + 1;
                    $tgl_dibuat = date_create($lapAll[$i]->dibuat, timezone_open('Asia/Jakarta'));
                    $tgl_laporan = date_create($lapAll[$i]->tgl_laporan, timezone_open('Asia/Jakarta'));

                    $bola="";
                    if (!empty($notif_laporan)) {
                      foreach ($notif_laporan as $notif) {
                        if ($notif->id_obyek == $lapAll[$i]->id && empty($notif->dilihat)) {
                          $bola = '<span id="ball"></span>';
                          break;
                        }
                      }
                    }

                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo '<td><a href="../../controller/c_lihatLaporan.php?id='.$lapAll[$i]->id.'">'.$lapAll[$i]->judul.'</a>'.$bola.'</td>';
                      echo "<td>".date_format($tgl_dibuat, "d M Y H:i")."</td>";
                      echo "<td>".$lapAll[$i]->pelapor."</td>";
                      echo "<td>".$lapAll[$i]->kecamatan.", ".$lapAll[$i]->kelurahan."</td>";
                      echo "<td>".$lapAll[$i]->status."</td>";
                    echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <a href="../../controller/c_laporanPage.php" style="float: right;">Lihat Semua Laporan</a>
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
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#body-tab tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
  </body>
</html>