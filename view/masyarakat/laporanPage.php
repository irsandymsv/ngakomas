<?php 

  include_once '../../model/masyarakat.php';
  include_once '../../model/laporan.php';
  include_once '../../model/connection.php';
  include_once 'masya_session.php';

  $lapAll = $_SESSION["laporan-user"];
  $konek = new connection();
?>
 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ngakomas - Laporan</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/sidenavM.css">
    <style type="text/css">
      .cari{
        float: left;
      }

      #filterStat{
        float: left;
        margin-left: 30px;
      }

      .add{
        float: right;
      }

      .table-responsive{
        padding-top: 20px;
        width: 100%;
        font-size: 16px;
      }

      td:first-child, td:last-child{
        text-align: center;
      }

      .paginate{
        text-align: center;
      }

      .pagination li a{
        cursor: pointer;
      }

      .hilang{
        display: none;
      } 
    </style>
  </head>
  <body>
  <div class="container-fluid">
    <div class="row">
      <?php include("../layout/M-sidebar.php") ?> 
      <div class="col-md-10">

        <div class="breadcrumb">
          <li class="active" id="page">Laporan</li>
          <li></li>
        </div>

        <div class="isi">
          <h2>Laporan Anda</h2>
          <br>
          <div class="cariBaru">
            <div class="cari">
              <input class="form-control" type="text" name="cari" placeholder="Pencarian..." id="myInput">
            </div>

            <div class="form-inline" id="filterStat">
              <b>Status</b>
              <select class="form-control" name="Status" id="status">
                <option value="Semua">Semua</option>
                <option value="Belum diverifikasi">Belum diverifikasi</option>
                <option value="Sedang ditangani">Sedang ditangani</option>
                <option value="Selesai">Selesai</option>
              </select>
            </div>

            <div class="add">
              <a href="../../controller/c_buatLaporan.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>  Buat Laporan</a>
            </div>

          </div>

          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <tr style="background-color: rgb(100,100,100); color: white;">
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal Dibuat</th>
                <th>Tanggal Laporan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
              <tbody id="body-tab">

                <?php 

                // $limit = 5;
                // $hal = isset($_GET["page"])? $_GET["page"]: 1;
                // $offset = ($hal-1) * $limit;
                // $data = $konek->koneksi()->query('SELECT * FROM laporan WHERE id_pelapor = '.$_SESSION["user"]->id);
                // $jml_data = $data->rowCount();
                // $jml_page = ceil($jml_data / $limit);

                // $query1 = 'SELECT * FROM laporan WHERE id_pelapor = '.$_SESSION["user"]->id.'  ORDER BY dibuat desc LIMIT '.$offset.','. $limit;
                // $run = $konek->koneksi()->query($query1);
                // $run->setFetchMode(PDO::FETCH_CLASS, 'laporan');
                // $res = $run->fetchAll();

                $no=0;
                foreach ($lapAll as $key) {
                  $no = $no + 1;
                  $tgl_dibuat = date_create($key->dibuat, timezone_open('Asia/Jakarta'));
                  $tgl_laporan = date_create($key->tgl_laporan, timezone_open('Asia/Jakarta'));
                  echo "<tr class='tampil'>";
                  echo "<td>".$no."</td>";
                    echo '<td><a href="../../controller/c_lihatLaporan.php?id='.$key->id.'">'.$key->judul.'</a></td>';
                    echo "<td>".date_format($tgl_dibuat, "d M Y H:i")."</td>";
                    echo "<td>".date_format($tgl_laporan, "d M Y H:i")."</td>";
                    echo "<td>".$key->status."</td>";
                    if ($key->status != "Belum diverifikasi") {
                      echo "<td>-</td>";
                    }
                    else{
                      echo '<td><a href="../../controller/c_lapEditPage.php?id='.$key->id.'" class="btn btn-warning">Ubah</a></td>';
                    }
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>

          <div class="paginate">
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <?php 
                // for ($i=1; $i <= $jml_page; $i++) {
                //   if ($hal==$i) {
                //     echo '<li class="active"><a href="?page='.$i.'">'.$i.'</a></li>';
                //    } 
                //    else{
                //     echo '<li><a href="?page='.$i.'">'.$i.'</a></li>';
                //    }
                // }
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

    var total = <?php echo count($lapAll) ?>;
    console.log(total);
    paginasi(total);
    carilah(total);

    //FILTER status
    $(document).ready(function() {
      $('#status').change(function() {
        var stat = $(this).val();
        
        $.ajax({
          url: '../../controller/c_filterLaporan.php',
          type: 'POST',
          data: {"status": stat},
        })
        .done(function(hasil) {
          console.log("success");
          $('#body-tab').html(hasil);

          var jml=0;
          $('.tampil').each(function(index, el) {
            jml++;
          });
          paginasi(jml);
          carilah(jml);
          
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
    

    //SEARCHING
    function carilah(total) {
      $(document).ready(function(){
        $("#myInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#body-tab tr").filter(function() {
            // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            if ($(this).text().toLowerCase().indexOf(value) > -1) {
              if (value=="") {
                $('li').removeAttr('class');
                $('li').css("pointer-events","auto");
                paginasi(total);
              }
              else{
                $(this).attr('class', 'tampil');
              }
            }
            else{
              $(this).attr('class', 'hilang');
              $('li').attr('class', 'disabled');
              $('li').css("pointer-events","none");
            }
          });
        });
      });
    }

    //PAGINATION
    function paginasi(total) {
      var limit = 5;
      var jml_page = Math.ceil(total / limit);
      console.log(jml_page);

      var gabung = "";
      for (var i = 1; i <= jml_page; i++) {
        gabung += '<li><a class="page" id="bt'+i+'">'+i+'</a></li>';
      }
      $('.pagination').html(gabung);

      
      $('#body-tab tr').attr('class','hilang');
      for (var i = 1; i <= limit; i++) {
        $('#body-tab tr:nth-child('+i+')').attr('class','tampil');
      }

      $('.pagination li:first-child').attr('class', 'active');

      $('.page').click(function(event) {
        var hal = $(this).text();
        console.log(hal);

        var offset = (hal-1)*limit;
        console.log('offset= '+offset);

        $('li.active').removeAttr('class');
        $(this).closest( "li" ).attr('class', 'active');

        $('#body-tab tr').attr('class','hilang');
        // var newLimit = 0;
        if ((total-offset) < limit) {
          // newLimit = total-offset;
          for (var i = offset+1; i <= total; i++) {
            $('#body-tab tr:nth-child('+i+')').attr('class','tampil');
          }
        }
        else{
          for (var i = offset+1; i <= offset+limit; i++) {
            $('#body-tab tr:nth-child('+i+')').attr('class','tampil');
          } 
        }

      });  
    }
    
  </script>
  </body>
</html>
<?php 
// unset($_SESSION["laporan"]);
 ?>