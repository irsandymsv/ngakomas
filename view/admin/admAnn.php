<?php 
  include_once '../../model/admin.php';
  include_once '../../model/pengumuman.php';

  include_once 'adm_session.php';

  $allAnn = $_SESSION["allPengumuman"];
  $kategori = $_SESSION["kategori"];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Pengumuman</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/sidenavAdm.css">
    <style type="text/css">

      .cari{
        float: left;
      }

      #saringan{
        float: left;
        margin-left: 30px;
      }

      .add{
        float: right;
      }

      .table-responsive{
        padding-top: 20px;
        width: 100%;
        font-size: 15px;
      }

      td:first-child{
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
      <div class="col-md-10">

        <div class="breadcrumb">
          <li class="active" id="page">Pengumuman</li>
          <li></li>
        </div>

        <div class="isi">
          <h2>Pengumuan</h2>
          <br>
          <div class="cariFilterBaru">
            <div class="cari">
              <input class="form-control" type="text" name="cari" placeholder="Pencarian..." id="myInput">
            </div>

            <div class="form-inline" id="saringan">
              <b>Kategori</b>
              <select class="form-control" name="id_kategori" id="listKategori">
                <option value="">Semua</option>
                <?php foreach ($kategori as $key) {
                  echo '<option value="'.$key["id"].'">'.$key["nama"].'</option>';
                }

                ?>
              </select>
            </div>

            <div class="add">
              <a href="../../controller/c_buatPengumuman.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>  Buat Pengumuman</a>
            </div>

          </div>

          <div class="table-responsive">
            <table class="table table-striped">
              <tr style="background-color: rgb(50,50,50); color: white;">
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal Dibuat</th>
                <th>Kategori</th>
                <th>Aksi</th>
              </tr>
              <tbody id="body-tab">
                <?php 
                $no = 0;
                foreach ($allAnn as $ann) {
                  $no = $no + 1;
                  $tgl_dibuat = date_create($ann->dibuat, timezone_open('Asia/Jakarta'));
                  echo '<tr class="tampil" id="'.$ann->id.'">';
                    echo "<td>".$no."</td>";
                    echo '<td><a href="../../controller/c_lihatPengumuman.php?id='.$ann->id.'">'.$ann->judul.'</a></td>';
                    echo "<td>".date_format($tgl_dibuat, "d M Y H:i")."</td>";
                    echo '<td>'.$ann->kategori.'</td>';
                    echo '
                    <td>
                    <a href="../../controller/c_annEditPage.php?id='.$ann->id.'" class="btn btn-warning" style="margin-right: 5px;">Ubah</a>
                    <button id="'.$ann->id.'" class="btn btn-danger" name="delBtn" data-toggle="modal" data-target="#myModal">Hapus</Button>
                    </td>';
                  echo '</tr>';
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
                    <button class="btn btn-danger" type="button" id="hapusAnn" data-dismiss="modal" style="padding: 5px 20px;">Ya</button>
                  </div>
                </div>
              </div>
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

    var total = <?php echo count($allAnn) ?>;
    console.log(total);
    paginasi(total);
    carilah(total);

    // $('#hapusAnn').attr('href', '../../controller/c_hapusPengumuman.php?id='+id_ann);
    var id_ann = "";

    //Hapus Pengumuman
    jQuery(document).ready(function($) {
      // var id_ann = "";
      $('button[name="delBtn"]').on('click', function() {
        id_ann = $(this).attr('id');
        console.log('id_ann ='+id_ann);
      });

      $('#hapusAnn').click(function(event) {
        $.ajax({
          url: '../../controller/c_ajax_hapusAnn.php',
          type: 'POST',
          data: {"id_ann": id_ann},
        })
        .done(function(deleted) {
          console.log("success");
          // $('tr#'+id_ann+'').hide();

          $('#body-tab').html(deleted);

          $('button[name="delBtn"]').on('click', function() {
            id_ann = $(this).attr('id');
            console.log('id_ann ='+id_ann);
          });

          var jml=0;
          $('.tampil').each(function(index, el) {
            jml++;
          });
          console.log('jml afer detele= '+jml);
          paginasi(jml);
          carilah(jml);

          $('#listKategori option').each(function(index, el) {
            $(this).removeAttr('selected');
          });
          $('#listKategori option:first-child').attr('selected', 'selected');

        })
        .fail(function(xhr, status, error) {
          console.log("error");
           console.log(xhr.responseText);
        })
        .always(function() {
          console.log("complete");
        });

        console.log('');
        
      });
      
    });
    
    


    //filter pengumuman
    $(document).ready(function() {
      $('#listKategori').change(function() {
        var id_kategori = $(this).val();
        
        $.ajax({
          url: '../../controller/c_filterAnn.php',
          type: 'POST',
          data: {"id_kategori": id_kategori},
        })
        .done(function(hasil) {
          console.log("success");
          $('#body-tab').html(hasil);

          $('button[name="delBtn"]').on('click', function() {
            id_ann = $(this).attr('id');
            console.log('id_ann ='+id_ann);
          });

          var jml=0;
          $('.tampil').each(function(index, el) {
            jml++;
          });
          console.log('jml afer ajax= '+jml);
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
    function carilah(total){
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