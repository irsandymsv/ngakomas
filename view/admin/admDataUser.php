<?php 
  include_once '../../model/admin.php';
  include_once 'adm_session.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Data User</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/sidenavAdm.css">
    <style type="text/css">
      .cari{
        float: left;
      }

      .table-responsive{
        padding-top: 20px;
        width: 100%;
        font-size: 15px;
        /*margin: auto;*/
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
          <li class="active" id="page">Data User</li>
          <li></li>
        </div>

        <div class="isi">
          <h2>Daftar Pengguna</h2>
          <br>
          <div class="cariBaru">
            <div class="cari">
              <input class="form-control" type="text" name="cari" placeholder="Pencarian..." id="myInput">
            </div>

          </div>

          <div class="table-responsive">
            <table class="table table-bordered">
              <tr style="background-color: rgb(50,50,50); color: white;">
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>No. HP</th>
                <!-- <th>E-Mail</th> -->
              </tr>
              <tbody id="body-tab">
                <?php 
                  $no=0;
                  $users = $_SESSION["dataUser"];
                  foreach ($users as $key) {
                    $no = $no + 1;
                    echo "<tr>";
                      echo "<td>".$no."</td>";
                      echo '<td><a class="link" id='.$key->id.' href="../../controller/c_admDetailUser.php?id='.$key->id.'">'.$key->nama.'</a></td>';
                      echo "<td>".$key->nik."</td>";
                      echo "<td>".$key->gender."</td>";
                      echo "<td>".$key->noHP."</td>";
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
    var total = <?php echo count($users) ?>;
    console.log(total);
    paginasi(total);
    carilah(total);

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
  
 ?>