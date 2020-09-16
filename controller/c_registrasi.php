<?php 
	include_once '../allModel.php';
	session_start();

	$daftar = new m_user();

	$namaReg = "/^[a-zA-Z' ]+$/";
	$nikReg = "/^[0-9]{16}$/";
	$nomorReg = "/^\d+$/";
	$passReg = "/^(?=.*?[A-Za-z])(?=.*?[0-9]).{8,}$/";

	if (empty($_POST['namaDepan']) || empty($_POST['namaBelakang']) || empty($_POST['nik']) || empty($_POST['tgl_lahir']) || empty($_POST['noHP']) || empty($_POST['email']) || empty($_POST['password1']) || empty($_POST['password2']) || empty($_POST['gender']) || empty($_POST['alamat']) || empty($_POST['id_role'])) 
	{
		$_SESSION["tdk-valid"] = "Harap isi semua kolom";
		header("Location: ../view/registrasi.php");
	}
	elseif (!preg_match($namaReg, $_POST["namaDepan"]) || !preg_match($namaReg, $_POST["namaBelakang"])) {
		$_SESSION["tdk-valid"] = "Harap isi nama dengan huruf";
		header("Location: ../view/registrasi.php");
	}
	elseif (!preg_match($nikReg, $_POST["nik"])) {
		$_SESSION["tdk-valid"] = "Harap isi  NIK dengan tepat 16 angka";
		header("Location: ../view/registrasi.php");
	}
	elseif (!preg_match($nomorReg, $_POST["noHP"])) {
		$_SESSION["tdk-valid"] = "Harap isi nomor HP dengan angka";
		header("Location: ../view/registrasi.php");
	}
	elseif($_POST['password1'] != $_POST['password2']){
		$_SESSION["tdk-valid"] = "Konfirmasi password tidak sesuai";
		header("Location: ../view/registrasi.php");
	}
	elseif (!preg_match($passReg, $_POST["password1"]) || !preg_match($passReg, $_POST["password2"])) {
		$_SESSION["tdk-valid"] = "Password minimal 8 karakter, terdiri dari huruf dan angka";
		header("Location: ../view/registrasi.php");	
	}
	elseif (strlen($_POST["alamat"]) > 200) {
		$_SESSION["tdk-valid"] = "Isi alamat dengan maksimal 200 karakter";
		header("Location: ../view/registrasi.php");
	}
	elseif ($daftar->cekEmail(strip_tags($_POST['email'])) > 0) {
		$_SESSION["tdk-valid"] = "email telah terdaftar, harap gunakan email lain";
		header("Location: ../view/registrasi.php");
	}
	elseif ($daftar->cekNIK($_POST['nik']) > 0) {
		$_SESSION["tdk-valid"] = "NIK telah terdaftar, harap gunakan NIK lain";
		header("Location: ../view/registrasi.php");	
	}
	else{

		// $nama1 = isset($_POST['namaDepan'])? $_POST['namaDepan']:'';
		// $nama2 = isset($_POST['namaBelakang'])? $_POST['namaBelakang']:'';
		// $nik = isset($_POST['nik'])? $_POST['nik']:'';
		// $tgl_lahir = isset($_POST['tgl_lahir'])? $_POST['tgl_lahir']:'';
		// $noHP = isset($_POST['noHP'])? $_POST['noHP']:'';
		// $email = isset($_POST['email'])? $_POST['email']:'';
		// $password = isset($_POST['password1'])? $_POST['password1']:'';
		// $gender = isset($_POST['gender'])? $_POST['gender']:'';
		// $alamat = isset($_POST['alamat'])? $_POST['alamat']:'';
		// $id_role = isset($_POST['id_role'])? $_POST['id_role']:'';

		// $nama = $nama1." ".$nama2;

		date_default_timezone_set("Asia/Jakarta");
		$dibuat = date("Y-m-d H:i:s");
		$userBaru = array( "nama" => strip_tags($_POST['namaDepan'])." ".strip_tags($_POST['namaBelakang']),
							"email" => strip_tags($_POST['email']),
							"password" => strip_tags($_POST['password1']),
							"nik" => $_POST['nik'],
							"tgl_lahir" => $_POST['tgl_lahir'],
							"gender" => $_POST['gender'],
							"noHP" => $_POST['noHP'],
							"alamat" => strip_tags($_POST['alamat']),
							"id_role" => 2,
							"dibuat" => $dibuat
					);

		// $m1 = new user($nama, $nik, $tgl_lahir, $noHP, $email, $password, $gender, $alamat, $id_role);
		$reg = $daftar->buatUser($userBaru);

		// var_dump($reg[0]);
		// exit();
		// echo $reg[1];

		if ($reg[0]) {
			$_SESSION["user"] = $daftar->getUser($reg[1]);
			header("Location: c_laporanPage.php");
		}
		else{
			$_SESSION["tdk-valid"] = "Registrasi Gagal";
			header("Location: ../view/registrasi.php");
		}

		
	}


?>