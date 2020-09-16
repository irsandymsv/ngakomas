<?php 
include_once '../allModel.php';
session_start();

$namaReg = "/^[a-zA-Z' ]+$/";
$nikReg = "/^[0-9]{16}$/";
$nomorReg = "/^\d+$/";
$mimeType = array("image/gif", "image/jpeg", "image/png");

if(empty($_POST['nama']) || empty($_POST['nik']) || empty($_POST['tgl_lahir']) || empty($_POST['gender']) || empty($_POST['noHP']) || empty($_POST['email']) || empty($_POST['alamat']) ) 
{
	$_SESSION["tdk-valid"] = "Harap isi semua data profil";
	header("Location: ../view/masyarakat/editProfil.php");	
}
elseif (!preg_match($namaReg, $_POST["nama"]) ) {
	$_SESSION["tdk-valid"] = "Harap isi nama dengan huruf";
	header("Location: ../view/masyarakat/editProfil.php");
}
elseif (!preg_match($nikReg, $_POST["nik"])) {
	$_SESSION["tdk-valid"] = "Harap isi  NIK dengan tepat 16 angka";
	header("Location: ../view/masyarakat/editProfil.php");
}
elseif (!preg_match($nomorReg, $_POST["noHP"])) {
	$_SESSION["tdk-valid"] = "Harap isi nomor HP dengan angka";
	header("Location: ../view/masyarakat/editProfil.php");
}
else {
	$picture = "";
	if ($_FILES["uploadImage"]["size"] > 0) {
		// var_dump($_FILES["uploadImage"]["size"]);
		// exit();
		$mime = mime_content_type($_FILES["uploadImage"]["tmp_name"]);
		if ($_FILES["uploadImage"]["size"] > 1000000){
			$_SESSION["tdk-valid"] = "Maksimal ukuran gambar adalah 1MB";
			header("Location: ../view/masyarakat/editProfil.php");
			exit();
		}
		elseif ($mime != "image/gif" && $mime != "image/jpeg" && $mime != "image/png") {
			$_SESSION["tdk-valid"] = "Harap upload gambar dengan format .gif, .jpeg, atau .png";
			header("Location: ../view/masyarakat/editProfil.php");
			echo "test image";
			exit();
		}
		else{

			if (!empty($_SESSION["user"]->picture)) {
				if (!unlink($_SESSION["user"]->picture)) {
					echo "hapus gambar lama gagal";
					exit();
				}
			}

			$dir = "../storage/profile-pic/";
			$fileType = strtolower(pathinfo(basename($_FILES["uploadImage"]["name"]), PATHINFO_EXTENSION));
			$picture = $dir . $_SESSION["user"]->id. "." .$fileType;
			$upload = move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $picture);
			// echo $picture;
			if (!$upload) {
				echo "upload gambar gagal";
				exit();
			}
		}

		
	}

	$user = array('id' => $_SESSION["user"]->id,
		'nama' => strip_tags($_POST['nama']),
		'nik' => $_POST['nik'],
		'tgl_lahir' => $_POST['tgl_lahir'],
		'gender' => $_POST['gender'], 
		'noHP' => $_POST['noHP'],
		'email' => strip_tags($_POST['email']),
		'alamat' => strip_tags($_POST['alamat']),
		'picture' => $picture
	);

	$us_model = new m_user();
	$hasil = $us_model->editProfil($user);

	if ($hasil) {
		$newUser = $us_model->getUser($_SESSION["user"]->id);
		$_SESSION["user"] = $newUser;
		header("Location: ../view/masyarakat/profil.php");
	}else {
		echo "update gagal";
	}
}


?>