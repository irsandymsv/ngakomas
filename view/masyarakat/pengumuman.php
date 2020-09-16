<?php 
  include_once '../../model/masyarakat.php';
  include_once '../../model/pengumuman.php';
  include_once '../../model/notifikasi.php';
  include_once '../../model/connection.php';

  include_once 'masya_session.php';
  $allAnn = $_SESSION["allPengumuman"];
  $kategori = $_SESSION["kategori"];
  $notif_ann = $_SESSION["notif_ann"];
  $konek = new connection();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Pengumuman Polisi</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/sidenavM.css">
    <style type="text/css">
      .cari{
        float: left;
      }

      /*#searching{
        width: 40%;
      }*/

      .saringan{
        float: right;
        
      }

      .table-responsive{
        padding-top: 20px;
        width: 100%;
        font-size: 16px;
      }

      #ball{
        display: inline-block;
        margin-left: 5px;
        width: 15px;
        height: 15px;
        background-color: rgb(0, 170, 0);
        border-radius: 50%;
      }

      .paginate{
        text-align: center;
      }
    </style>
  </head>
  <body>
  <div class="container-fluid">
    <div class="row">
      <?php include("../layout/M-sidebar.php") ?>
      <div class="col-md-10">
        
        <div class="breadcrumb">
          <li class="active" id="page">Pengumuman</li>
          <li></li>
        </div>

        <div class="isi">
          <h2>Pengumuman Polisi</h2>
          <br>
          <div class="form-inline">
            <div class="cari">
              <input class="form-control" type="text" name="cari" placeholder="Pencarian..." id="myInput">
            </div>

            <!-- <div class="saringan">
              <b>Filter Kategori  </b>
              <select class="form-control" name="id_kategori" id="listKategori">
                <option value="">Semua</option>
                <?php foreach ($kategori as $key) {
                  echo '<option value="'.$key["id"].'">'.$key["nama"].'</option>';
                }

                ?>
              </select>
            </div> -->

          </div>

          <div class="table-responsive">
            <table class="table table-striped">
              <tr style="background-color: rgb(100,100,100); color: white;">
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Kategori</th>
              </tr>
              <tbody id="body-tab">
                <?php 

                $limit = 5;
                $hal = isset($_GET["page"])? $_GET["page"]: 1;
                $offset = ($hal-1) * $limit;
                $data = $konek->koneksi()->query('SELECT * FROM pengumuman');
                $jml_data = $data->rowCount();
                $jml_page = ceil($jml_data / $limit);

                $query1 = 'SELECT p.*, k.nama AS "kategori" FROM pengumuman p
                          JOIN kategori k ON p.id_kategori = k.id  
                          ORDER BY dibuat desc 
                          LIMIT '.$offset.','. $limit;
                $run = $konek->koneksi()->query($query1);
                $run->setFetchMode(PDO::FETCH_CLASS, 'pengumuman');
                $res = $run->fetchAll();

                $no = $offset;
                foreach ($res as $ann) {
                  $no = $no + 1;
                  $tgl_dibuat = date_create($ann->dibuat, timezone_open('Asia/Jakarta'));

                  $bola="";
                  if (!empty($notif_ann)) {
                    foreach ($notif_ann as $notif) {
                      if ($notif->id_obyek == $ann->id && empty($notif->dilihat)) {
                        $bola = '<span id="ball"></span>';
                      }
                    }
                  }

                  echo '<tr>';
                    echo "<td>".$no."</td>";
                    echo '<td><a href="../../controller/c_lihatPengumuman.php?id='.$ann->id.'">'.$ann->judul.'</a>'.$bola.'</td>';
                    echo "<td>".date_format($tgl_dibuat, "d M Y H:i")."</td>";
                    echo '<td>'.$ann->kategori.'</td>';
                  echo '</tr>';
                }
                ?>
              </tbody>
            </table>
          </div>

          <div class="paginate">
            <nav aria-label="Page navigation">
              <ul class="pagination">
                  <?php 
                  for ($i=1; $i <= $jml_page; $i++) {
                    if ($hal==$i) {
                      echo '<li class="active"><a href="?page='.$i.'">'.$i.'</a></li>';
                     } 
                     else{
                      echo '<li><a href="?page='.$i.'">'.$i.'</a></li>';
                     }
                  }
                  ?>
              </ul>
            </nav>
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
    
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#body-tab tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

    $(document).ready(function() {
      $('#listKategori').change(function() {
        var id_kategori = $(this).val();
        $('li').attr('class', 'disabled');
        $('li').css("pointer-events","none");

        if (id_kategori == "") {
          $('li').removeAttr('class');
          $('li').css("pointer-events","auto");
        }

        $.ajax({
          url: '../../controller/c_filterAnn.php',
          type: 'POST',
          data: {"id_kategori": id_kategori},
        })
        .done(function(hasil) {
          console.log("success");
          $('#body-tab').html(hasil);
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