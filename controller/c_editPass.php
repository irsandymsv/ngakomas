<?php 
include_once '../allModel.php';
session_start();

$passRegex = '/^(?=.*?[A-Za-z])(?=.*?[0-9]).{8,}$/';

if (empty($_POST["password-lama"]) || empty($_POST["password-baru"]) || empty($_POST["password-baru2"]) ) 
{
	$_SESSION["validasi_pass"] = "Harap isi semua kolom";
	if ($_SESSION["user"]->id_role == 1) {
		header("Location: ../view/admin/admUbahPass.php");
	}
	elseif ($_SESSION["user"]->id_role == 2){
		header("Location: ../view/masyarakat/ubahPassword.php");
	}
}
elseif ($_POST["password-lama"] != $_SESSION["user"]->password)
{
	$_SESSION["validasi_pass"] = "Password lama salah, coba lagi";
	if ($_SESSION["user"]->id_role == 1) {
		header("Location: ../view/admin/admUbahPass.php");
	}
	elseif ($_SESSION["user"]->id_role == 2){
		header("Location: ../view/masyarakat/ubahPassword.php");
	}
}
elseif($_POST["password-baru"] != $_POST["password-baru2"]){
	
	$_SESSION["validasi_pass"] = "Konfirmasi password baru tidak sesuai";

	if ($_SESSION["user"]->id_role == 1) {
		header("Location: ../view/admin/admUbahPass.php");
	}
	elseif ($_SESSION["user"]->id_role == 2){
		header("Location: ../view/masyarakat/ubahPassword.php");
	}
}
elseif (!preg_match($passRegex, $_POST["password-baru"]) || !preg_match($passRegex, $_POST["password-baru2"])) {

	$_SESSION["validasi_pass"] = "Password minimal 8 karakter, terdiri dari huruf dan angka";

	if ($_SESSION["user"]->id_role == 1) {
		header("Location: ../view/admin/admUbahPass.php");
	}
	elseif ($_SESSION["user"]->id_role == 2){
		header("Location: ../view/masyarakat/ubahPassword.php");
	}
}
else {
	$pass = array('id' => $_SESSION["user"]->id,
				'password' => strip_tags($_POST["password-baru"])
	);

	$us_model = new m_user();
	$newPass = $us_model->editPass($pass);

	if ($newPass) {
		$us = $us_model->getUser($_SESSION["user"]->id);
		$_SESSION["user"] = $us;
		$_SESSION["suskses-pass"] = "Password berhasil diubah";

		if ($_SESSION["user"]->id_role == 1) {
			header("Location: ../view/admin/admUbahPass.php");
		}
		elseif ($_SESSION["user"]->id_role == 2){
			header("Location: ../view/masyarakat/profil.php");
		}
	}else{
		echo "Gagal Mengubah password";
	}
}


?>