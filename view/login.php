<?php
	session_start();
	unset($_SESSION["user"]);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Ngakomas - Log In</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<style type="text/css">
		.wadah{
			padding: 50px;
			padding-bottom: 100px;
			text-align: center;
			background-color: rgb(40,40,40);
		}
		.login{
			padding: 5px;
			background-color: rgb(102, 184, 20);
			color: black;
			margin-right: auto;
			margin-left: auto;
			width: 50%;
		}

		.isian{
			padding: 25px;
			padding-top: 60px;
			background-color: white;
			width: 40%;
			margin-right: auto;
			margin-left: auto;
			min-height: 290px;
		}

		.kolom{
			border: none;
			border-bottom: solid 1px lightgrey;
			outline: 0;
			background-color: none;
			width: 60%;
			font-size: 16px;
		}

		.kolom:focus{
			border: none;
			border-bottom: solid 1px black;
			background-color: none;
			outline: 0;
			font-size: 16px;
		}

		.btn.btn-success{
			/*padding: 10px 20px;*/
			width: 40%;
			padding: 10px;
			font-size: 16px;
		}

		.alert.alert-danger{
			padding: 5px;
		}
	</style>
</head>
<body>
	<div class="atas">
		<div class="logo">
    		<img src="img/logo.jpeg">
    	</div>
		<div class="nav">
			<a href="registrasi.php">Register</a>
			<a href="login.php" class="active">Masuk</a>
			<a href="about.html">Tentang</a>
			<a href="home.html">Beranda</a>
		</div>
	</div>

	<div class="wadah">
		<div class="login">
			<h2><b>Login</b></h2>
		</div>
		<div class="isian">
			<form method="POST" action="../controller/c_login.php">
				<div class="form-group">
					<div class="form-inline">
						<span class="glyphicon glyphicon-envelope" style="padding-right: 20px; font-size: 16px;"></span>
						<input class="kolom" type="text" name="email" placeholder="Email address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" >	
					</div>
					<br><br>
					<div class="form-inline">
						<span class="glyphicon glyphicon-lock" style="padding-right: 20px; font-size: 16px;"></span>
						<input class="kolom" type="password" name="password" placeholder="password">	
					</div>
				</div>
				<br>
				<?php 
					if (isset($_SESSION["kosong"])) {
						echo "<div class="." 'alert alert-danger' "." role= "." 'alert' ".">";
						echo $_SESSION["kosong"];
						echo "</div>";	

					}elseif (isset($_SESSION["failed"])) {
						echo "<div class="." 'alert alert-danger' "." role= "." 'alert' ".">";
						echo $_SESSION["failed"];
						echo "</div>";						
					}
				
				?>
				<button class="btn btn-success" type="submit" id="log" name="submit">Log in</button>
			</form>
		</div>
	</div>

	<div class="bawah">
		<div class="foot">
			<h4>Ngakomas - Ngaturaken Perkoro Masyarakat</h4>
		</div>
	</div>
	
	<script src="bootstrap/js/jquery-3.3.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
</body>
</html>
<?php 
	unset($_SESSION["kosong"]); 
	unset($_SESSION["failed"]);
	unset($_SESSION["user"]);
?>