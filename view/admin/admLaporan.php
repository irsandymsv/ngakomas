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
      .cari{
        float: left;
      }

      #filterStat{
        float: left;
        margin-left: 30px;
      }

      .cariBaru:after{
        content: '';
        display: block;
        clear: both;
      }

      .table-responsive{
        padding-top: 30px;
        width: 100%;
        font-size: 15px;
        /*margin: auto;*/
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
      <div class="col-md-10">

        <div class="breadcrumb">
          <li class="active" id="page">Laporan</li>
          <li></li>
        </div>

        <div class="isi">
          <h2>Laporan Masyarakat</h2>
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
          </div>

          <div class="table-responsive">
            <table class="table table-bordered">
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
                $no=0;
                foreach ($lapAll as $key) {
                  $no = $no + 1;
                  $tgl_dibuat = date_create($key->dibuat, timezone_open('Asia/Jakarta'));
                  $tgl_laporan = date_create($key->tgl_laporan, timezone_open('Asia/Jakarta'));

                  $bola="";
                  if (!empty($notif_laporan)) {
                    foreach ($notif_laporan as $notif) {
                      if ($notif->id_obyek == $key->id && empty($notif->dilihat)) {
                        $bola = '<span id="ball"></span></td>';
                      }
                    }
                  }

                  echo "<tr class='tampil'>";
                  echo "<td>".$no."</td>";
                    echo '<td><a href="../../controller/c_lihatLaporan.php?id='.$key->id.'">'.$key->judul.'</a>'.$bola.'</td>';
                    echo "<td>".date_format($tgl_dibuat, "d M Y H:i")."</td>";
                    echo "<td>".$key->pelapor."</td>";
                    echo "<td>".$key->kecamatan.", ".$key->kelurahan."</td>";
                    echo "<td>".$key->status."</td>";
                  echo "</tr>";
                }
                ?>

              </tbody>
            </table>
          </div>

          <div class="paginate">
            <nav aria-label="Page navigation">
              <ul class="pagination">
                   
              </ul>
            </nav>
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
    // var carikan = $("#body-tab tr");

    var total = <?php echo count($lapAll) ?>;
    console.log(total);
    paginasi(total);
    carilah(total);

    //FILTER
    $(document).ready(function() {
      $('#status').change(function() {
        var stat = $(this).val();
        // var stat = new RegExp($(this).val());
        // console.log(stat);

        // var jmlData_filter=0;
        // if (stat == "/Semua/"){
        //   // $('.lapor').show();
        //   $('#body-tab tr').attr('class','lapor');
        //   carikan = $("#body-tab tr");
        //   paginasi(total);
        // }
        // else{
        //   // $('.lapor').hide();
        //   $('#body-tab tr').attr('class','lapor2');
        //   $('#body-tab tr').filter(function() {
        //     console.log($(this).children('td:last').text());
        //     return stat.test($(this).children('td:last').text());
        //   }).attr('class','lapor');
        //   carikan = $("#body-tab tr.lapor");

        //   $('.lapor').each(function(index, el) {
        //     jmlData_filter++;
        //   });
        //   paginasi(jmlData_filter);
        // }


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

    //PENCARIAN
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
  unset($_SESSION["laporan"]);
?>