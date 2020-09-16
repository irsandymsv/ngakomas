<?php 
	include_once '../allModel.php';
	session_start();
	unset($_SESSION["kosong"]);

	// var_dump($_POST['email']);

	$email = "";
	$pass = "";
	if (empty($_POST['email']) || empty($_POST['password']) ) {

		$_SESSION["kosong"] = "Harap isi Email dan Password untuk login";
		header("Location: ../view/login.php");
	}else{
		// echo "yey";
		$email = $_POST['email'];
		$pass = $_POST['password'];
	}

	$dataLog = array($email, $pass);

	$us = new m_user();
	$hasil = $us->login($dataLog);
	// echo $hasil[1]->nama;

	if (!$hasil[1]) {
		// echo "gagal";
		$_SESSION["failed"] = "Login gagal, pastikan email dan password benar";
		header("Location: ../view/login.php");
	} else{
		echo "sukses";
		$user = $hasil[1];
		if ($user->id_role == 1) {
			$_SESSION["user"] = $hasil[1];
			header("Location: c_admBeranda.php");

		}elseif ($user->id_role == 2) {
			$_SESSION["user"] = $hasil[1];
			header("Location: c_laporanPage.php");
		}
		
	}



 ?>