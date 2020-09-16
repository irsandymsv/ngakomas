<?php 
	session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Ngakomas - Register</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<style type="text/css">
		.col-sm-6{
			padding: 10px;
			background-color: rgb(50,50,50);
			/*height: 100%;*/
			/*min-height: 780px;*/
		}

		.words{
			font-family: Helvetica;
			position: absolute;
			top: 30%;
			width: 60%;
			color: white;
		}

		.judul{
			padding: 5px;
			background-color: maroon;
			text-align: center;
			color: white;
		}

		.warper{
			margin-top: 10px;
			padding: 40px;
			background-color: rgb(110,110,110);
			color: white;
		}

		.btn.btn-danger{
			width: 40%;
			padding: 10px;
			font-size: 22px;
		}

		.alert.alert-danger{
			font-size: 16px;
			padding: 5px;
			text-align: center;
		}
</style>
</head>
<body>

	<div class="atas">
		<div class="logo">
    		<img src="img/logo.jpeg">
    	</div>
		<div class="nav">
			<a href="registrasi.php" class="active">Register</a>
			<a href="login.php">Masuk</a>
			<a href="about.html">Tentang</a>
			<a href="home.html">Beranda</a>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6" id="r1">
				<div class="words">
					<div style="height: 3px; background-color: white;"></div>
					<!-- <br> -->
					<h1 style="font-size: 60px;">Ngakomas</h1>
					<br><br>
					<p style="font-size: 30px;"><i>Membantu masyarakat untuk melaporkan kejadian secara cepat dan tepat</i></p>
					<div style="height: 3px; background-color: white;"></div>
				</div>
			</div>

			<div class="col-sm-6" id="r2" style="background-color: rgb(210,210,210);">
				<div class="judul"><h2>Registrasi Pengguna Baru</h2></div>
				
				<form id="kirim" method="POST" action="../controller/c_registrasi.php">
					<div class="warper">

						<?php 
						if (isset($_SESSION["tdk-valid"])) {
							echo '<div class="alert alert-danger" role="alert">';
		                    echo $_SESSION["tdk-valid"];
		                    echo '</div>';
						}
						// elseif (isset($_SESSION["tdk-valid"])) {
						// 	echo '<div class="alert alert-danger" role="alert">';
		    //                 echo $_SESSION["tdk-valid"];
		    //                 echo '</div>';
						// }
						?>

						<div class="form-group">
							<div class="row">
								<div class="col-xs-6">
									<input class="form-control input-lg" type="text" name="namaDepan" placeholder="Nama Depan">
								</div>
								<div class="col-xs-6">
									<input class="form-control input-lg" type="text" name="namaBelakang" placeholder="Nama Belakang">
								</div>
							</div>
						</div>

						<div class="form-group">
							<input class="form-control input-lg" type="text" name="nik" placeholder="NIK">
						</div>

						<div class="form-group">
							<div class="form-inline">
								<label for="tgl_lahir" style="padding-right: 30px; font-size: 16px;">Tanggal lahir</label>
								<input class="form-control" type="date" name="tgl_lahir">
							</div>
						</div>

						<div class="form-group">
							<input class="form-control input-lg" type="text" name="noHP" placeholder="No. HP">
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-xs-6">
									<input class="form-control input-lg" type="password" name="password1" id="p1" placeholder="password">
								</div>
								<div class="col-xs-6">
									<input class="form-control input-lg" type="password" name="password2" id="p2" placeholder="Konfirmasi password">
								</div>
							</div>
						</div>

						<div class="form-group">
							<input class="form-control input-lg" type="email" name="email" placeholder="Email">
						</div>

						<div class="form-group" style="font-size: 18px;">
							<label for="gender" style="padding-right: 30px;">Jenis Kelamin</label>
							<label class="radio-inline">
								<input type="radio" name="gender" value="Laki-laki" id="gender1">Laki-laki
							</label>

							<label class="radio-inline">
								<input type="radio" name="gender" value="Perempuan" " id="gender2">Perempuan
							</label>
						</div>

						<div class="form-group">
							<div class="form-inline" style="">
								<label for="alamat">Alamat Tempat <br>Tinggal</label>
								<textarea class="form-control" type="text" name="alamat" rows="5" style="width: 80%;"></textarea>
							</div>
						</div>

						<input type="hidden" name="id_role" value="2">

						<br>

						<div class="form-group" style="text-align: center;">
							<button class="btn btn-danger" id="submit" type="submit" name="submit">Daftar</button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="bawah">
		<div class="foot">
			<h4>Ngakomas - Ngaturaken Perkoro Masyarakat</h4>
		</div>
	</div>


	<script src="bootstrap/js/jquery-3.3.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">

		var r1 = $('#r1').height();
		var r2 = $('#r2').height();
		if (r1 > r2) {
			$('#r2').height(r1);
		} else {
			$('#r1').height(r2);			
		}

		jQuery(document).ready(function($) {
			$('#submit').on('click', function(event) {
				event.preventDefault();
				var namaDpn = $('input[name="namaDepan"]').val();
				var namaBlkg = $('input[name="namaBelakang"]').val();
				var nik = $('input[name="nik"]').val();
				var tgl_lahir = $('input[name="tgl_lahir"]').val();
				var noHP = $('input[name="noHP"]').val();
				var pass1 = $('input[name="password1"]').val();
				var pass2 = $('input[name="password2"]').val();
				var email = $('input[name="email"]').val();
				var gender = $('input[name="gender"]').val();
				var alamat = $('textarea[name="alamat"]').val();

				var namaReg = /^[a-zA-Z' ]+$/;
				var nikReg = /^[0-9]{16}$/;
				var number = /^\d+$/;
				var passRegex = /^(?=.*?[A-Za-z])(?=.*?[0-9]).{8,}$/;
				console.log(namaDpn);
				console.log(namaReg.test(namaDpn));
				console.log('alamat length= '+alamat.length);
				
				if (namaDpn == "" || namaBlkg == "" || nik == "" || tgl_lahir == "" || noHP == "" || pass1 == ""  || pass2 == "" || email == ""|| gender == "" || alamat == "") {
					alert("Harap isi data diri dengan lengkap");
				}
				else if(!namaReg.test(namaDpn) || !namaReg.test(namaBlkg)){
					alert("Harap isi nama dengan huruf");
				}
				else if(!nikReg.test(nik)){
					alert("Harap isi NIK dengan tepat 16 angka");
				}
				else if(!number.test(noHP)){
					alert("Harap isi nomor HP dengan angka");
				}
				else if(pass1 != pass2){
					alert("Password konfirmasi tidak sesuai");
				}
				else if(!passRegex.test(pass1) || !passRegex.test(pass2)){
					alert("Password minimal 8 karakter, terdiri dari huruf dan angka");
				}
				else if(alamat.length > 200){
					alert("Isi alamat dengan maksimal 200 karakter");
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
unset($_SESSION["tdk-valid"]);
// unset($_SESSION["pass-beda"]);
?>