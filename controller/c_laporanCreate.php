<?php 
include_once '../allModel.php';
session_start();
unset($_SESSION["laporan"]);

$alphaNumeric = "/^[a-zA-Z0-9 ]+$/";

if (empty($_POST["judul"]) || empty($_POST["alamat"]) || empty($_POST["kecamatan"]) || empty($_POST["kelurahan"]) || empty($_POST["tgl_laporan"]) || empty($_POST["deskripsi"]) ) 
{
	$_SESSION["lapor-salah"] = "Harap isi semua kolom yang ada";
	header("Location: ../view/masyarakat/buatLaporan.php");
}
elseif (strlen($_POST["judul"]) > 50) {
	$_SESSION["lapor-salah"] = "Harap isi judul dengan maksimal 50 karakter";
	header("Location: ../view/masyarakat/buatLaporan.php");
}
elseif (strlen($_POST["alamat"]) > 100) {
	$_SESSION["lapor-salah"] = "Harap isi alamat dengan maksimal 100 karakter";
	header("Location: ../view/masyarakat/buatLaporan.php");
}
elseif (strlen($_POST["deskripsi"]) > 1000) {
	$_SESSION["lapor-salah"] = "Harap isi deskripsi dengan maksimal 1000 karakter";
	header("Location: ../view/masyarakat/buatLaporan.php");
}
elseif (!preg_match($alphaNumeric, $_POST["judul"])) {
	$_SESSION["lapor-salah"] = "Harap isi judul dengan huruf, angka, dan spasi saja";
	header("Location: ../view/masyarakat/buatLaporan.php");	
}
else{
	$lap = new m_laporan();
	$us = new m_user();
	$notifikasi = new m_notif();

	$tgl = date_create($_POST["tgl_laporan"]);
	$tgl_laporan = date_format($tgl, "Y-m-d H:i:s");

	$picture = "";
	if($_FILES["picture"]["size"] <= 0)
	{
		$laporan = array('judul' => strip_tags($_POST["judul"]),
						'tgl_laporan' => $tgl_laporan, 
						'deskripsi' => strip_tags($_POST["deskripsi"]),
						'alamat' => strip_tags($_POST["alamat"]),
						'picture' => $picture,
						'id_kecamatan' => $_POST["kecamatan"],
						'id_kelurahan' => $_POST["kelurahan"],
						'id_pelapor' => $_SESSION["user"]->id,
						'status' => $_POST["status"]
					);
		$hasil = $lap->buatLaporan($laporan);

		if ($hasil[0]) {

			$idAdmin = $us->getIdAdmin();
			date_default_timezone_set("Asia/Jakarta");
			$dibuat = date("Y-m-d H:i:s");

			$buatNotif = $notifikasi->buatNotifLaporan($hasil[1], $idAdmin, $dibuat);

			header("Location: c_lihatLaporan.php?id=".$hasil[1]);
		}
		else {
			echo "insert data gagal";
		}
	}
	else 
	{

		$mime = mime_content_type($_FILES["picture"]["tmp_name"]);
		if ($_FILES["picture"]["size"] > 1000000){
			$_SESSION["lapor-salah"] = "Maksimal ukuran gambar adalah 1MB";
			header("Location: ../view/masyarakat/buatLaporan.php");
			exit();
		}
		elseif ($mime != "image/gif" && $mime != "image/jpeg" && $mime != "image/png") {
			$_SESSION["lapor-salah"] = "Harap upload gambar dengan format .gif, .jpeg, atau .png";
			header("Location: ../view/masyarakat/buatLaporan.php");
			echo "test image";
			exit();
		}

		$laporan = array('judul' => strip_tags($_POST["judul"]),
						'tgl_laporan' => $tgl_laporan, 
						'deskripsi' => strip_tags($_POST["deskripsi"]),
						'alamat' => strip_tags($_POST["alamat"]),
						'picture' => $picture,
						'id_kecamatan' => $_POST["kecamatan"],
						'id_kelurahan' => $_POST["kelurahan"],
						'id_pelapor' => $_SESSION["user"]->id,
						'status' => $_POST["status"]
					);
		$hasil = $lap->buatLaporan($laporan);

		if ($hasil[0]) {

			$dir = "../storage/laporan-pic/";
			$fileType = strtolower(pathinfo(basename($_FILES["picture"]["name"]), PATHINFO_EXTENSION));
			$picture = $dir . $hasil[1] . "." . $fileType; //set id terbaru sebagai nama pic
			$upload = move_uploaded_file($_FILES["picture"]["tmp_name"], $picture);

			$setPic = $lap->setPicture($picture, $hasil[1]); //set pic untuk laporan terbaru

			if ($setPic) {

				$idAdmin = $us->getIdAdmin();
				date_default_timezone_set("Asia/Jakarta");
				$dibuat = date("Y-m-d H:i:s");

				$notifikasi->buatNotifLaporan($hasil[1], $idAdmin, $dibuat);

				header("Location: c_lihatLaporan.php?id=".$hasil[1]);
			}
			else {
				echo "set picture gagal";
			}
			
		}else {
			echo "insert data gagal";
		}
	}
}


?>