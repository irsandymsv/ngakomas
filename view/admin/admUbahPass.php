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
  <title>Ubah Password</title>

  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/sidenavAdm.css" rel="stylesheet" type="text/css">
  <style type="text/css">  
  .kepala{
    text-align: center;
    padding: 10px;
    padding-top: 5px;
  }
  .kolom {
    padding: 20px;
    padding-bottom: 30px;
    width: 40%;
    text-align: center;
    margin: auto;
    font-size: 17px;
  }

  .pass{
    border: none;
    border-bottom: solid 1px lightgrey;
    outline: 0;
    background-color: none;
    width: 80%;
  }

  .pass:focus{
    border: none;
    border-bottom: solid 1px black;
    outline: 0;
    background-color: none;
    width: 80%;
  }

  .btn.btn-default, .btn.btn-warning{
    margin-top: 10px;
    font-size: 16px;
    padding: 5px 20px;
  }

  .glyphicon.glyphicon-eye-open{
    cursor: pointer;
  }

  .glyphicon.glyphicon-eye-close{
    cursor: pointer;
  }

</style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-10">

        <div class="breadcrumb">
          <li class="active" id="page">Ubah Password</li>
          <li></li>
        </div>

        <div class="isi">
          <form action="../../controller/c_editPass.php" method="POST">
            <div class="kepala">
              <h2>Ubah Password</h2>
              <hr>
            </div>

            <div class="kolom">
              <?php 
                if (isset($_SESSION["validasi_pass"])) {
                  echo "<div class="." 'alert alert-danger' "." role= "." 'alert' ".">";
                  echo $_SESSION["validasi_pass"];
                  echo "</div>"; 
                }
                // elseif (isset($_SESSION["pasBeda"])) {
                //   echo "<div class="." 'alert alert-danger' "." role= "." 'alert' ".">";
                //   echo $_SESSION["pasBeda"];
                //   echo "</div>";
                // }elseif (isset($_SESSION["old-pass"])){
                //   echo "<div class="." 'alert alert-danger' "." role= "." 'alert' ".">";
                //   echo $_SESSION["old-pass"];
                //   echo "</div>";
                // }
              ?>
              <div class="form-group">
                <input id="p0" class="pass" type="password" name="password-lama" placeholder="password lama"><span id="span0" class="glyphicon glyphicon-eye-open" onclick="show0()"></span>
              </div><br>
              <div class="form-group">
                <input id="p1" class="pass" type="password" name="password-baru" placeholder="password baru"><span id="span1" class="glyphicon glyphicon-eye-open" onclick="show1()"></span>
              </div><br>
              <div class="form-group">
                <input id="p2" class="pass" type="password" name="password-baru2" placeholder="Konfirmasi password baru"><span id="span2" class="glyphicon glyphicon-eye-open" onclick="show2()"></span>
              </div>
            </div>

            <div class="form-group" style="text-align: center;">
              <!-- <button id="batal" class="btn btn-default" type="button" style="margin-right: 10px; background-color: rgb(240,240,240);">Batal</button> -->
              <button class="btn btn-warning" type="button" name="ubah" data-toggle="modal" data-target="#myModal">Ubah</button>
            </div>
            <div id="myModal" class="modal fade" role="dialog" style="text-align: left;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Konfirmasi</h4>
                  </div>

                  <div class="modal-body">
                    <p>Apakah anda yakin ingin mengubah password?</p>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="padding: 5px 15px;">Tidak</button>
                    <button class="btn btn-warning" type="submit" id="submit" name="submit" style="padding: 5px 20px;">Ya</button>
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
    function show0() {
      var x = document.getElementById("p0");
      if (x.type === "password") {
        $('#span0').attr('class', 'glyphicon glyphicon-eye-close');
        x.type = "text";
      } else {
        $('#span0').attr('class', 'glyphicon glyphicon-eye-open');
        x.type = "password";
      }
    }

    function show1() {
      var x = document.getElementById("p1");
      if (x.type === "password") {
        $('#span1').attr('class', 'glyphicon glyphicon-eye-close');
        x.type = "text";
      } else {
        $('#span1').attr('class', 'glyphicon glyphicon-eye-open');
        x.type = "password";
      }
    }

    function show2() {
      var x = document.getElementById("p2");
      if (x.type === "password") {
        $('#span2').attr('class', 'glyphicon glyphicon-eye-close');
        x.type = "text";
      } else {
        $('#span2').attr('class', 'glyphicon glyphicon-eye-open');
        x.type = "password";
      }
    }

    $('#batal').click(function(event) {
      $("input[type='password']").val("");
      $("input[type='text']").val("");
    });

  </script>

  <script type="text/javascript">
    var sukses = '<?php echo isset($_SESSION["suskses-pass"])? $_SESSION["suskses-pass"]: '' ?>' ;
    if (sukses != "") {
      setTimeout(function() {alert(sukses);}, 400);
    }


    //Validasi
    jQuery(document).ready(function($) {
      $('#submit').on('click', function(event) {
        event.preventDefault();
        var passLama = $('input[name="password-lama"]').val();
        var passBaru = $('input[name="password-baru"]').val();
        var passBaru2 = $('input[name="password-baru2"]').val();
        
        var passRegex = /^(?=.*?[A-Za-z])(?=.*?[0-9]).{8,}$/;
        
        if (passLama == "" ||  passBaru == "" || passBaru2 == "") {
          alert("Harap isi semua kolom password dengan lengkap");
        }
        else if (passLama != '<?php echo $_SESSION["user"]->password; ?>' ) {
          alert("Password lama salah");
        }
        else if(passBaru != passBaru2){
          alert("Konfirmasi password baru tidak sesuai");
        }
        else if(!passRegex.test(passBaru) || !passRegex.test(passBaru2)){
          alert("Password minimal 8 karakter, terdiri dari huruf dan angka");
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
  unset($_SESSION["validasi_pass"]);
  unset($_SESSION["suskses-pass"]);
  // unset($_SESSION["pasBeda"]);
  // unset($_SESSION["old-pass"]);
 ?>