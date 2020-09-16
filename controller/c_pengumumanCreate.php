<?php 
include_once '../allModel.php';
session_start();

$alphaNumeric = "/^[a-zA-Z0-9 ]+$/";

$ann = new m_pengumuman();
if (empty($_POST["judul"]) || empty($_POST["isi"]) || empty($_POST["kategori"]) ) 
{
	$_SESSION["validasi_ann"] = "Harap isi semua kolom yang ada";
	header("Location: ../view/admin/admBuatAnn.php");
}
elseif (strlen($_POST["judul"]) > 50) {
	$_SESSION["validasi_ann"] = "Harap isi judul dengan maksimal 50 karakter";
	header("Location: ../view/admin/admBuatAnn.php");
}
elseif (strlen($_POST["deskripsi"]) > 1000) {
	$_SESSION["validasi_ann"] = "Harap isi deskripsi dengan maksimal 200 karakter";
	header("Location: ../view/admin/admBuatAnn.php");
}
elseif (!preg_match($alphaNumeric, $_POST["judul"])) {
	$_SESSION["validasi_ann"] = "Harap isi judul dengan huruf, angka, dan spasi saja";
	header("Location: ../view/admin/admBuatAnn.php");	
}
else{
	$us = new m_user();
	$notifikasi = new m_notif();

	date_default_timezone_set("Asia/Jakarta");
	$dibuat = date("Y-m-d H:i:s");

	$picture = "";
	if ($_FILES["picture"]["size"] <= 0) {
		
		$pengumuman = array('judul' => strip_tags($_POST["judul"]),
							'isi' => strip_tags($_POST["isi"]),
							'picture' => $picture,
							'id_kategori' => $_POST["kategori"],
							'id_penulis' => $_SESSION["user"]->id,
							'dibuat' => $dibuat
							);
		$hasil = $ann->buatPengumuman($pengumuman);

		if ($hasil[0]) {

			$idUsers = $us->getIdUsersNot($_SESSION["user"]->id);
			date_default_timezone_set("Asia/Jakarta");
			$dibuat = date("Y-m-d H:i:s");

			$buatNotif = $notifikasi->buatNotifAnn($hasil[1], $idUsers, $dibuat);
			if (!$buatNotif) {
				echo "gagal buat notif";
				exit();
			}
			header("location: c_lihatPengumuman.php?id=".$hasil[1]);
		}
		else{
			echo "input ann gagal";
		}

	}
	else{

		$mime = mime_content_type($_FILES["picture"]["tmp_name"]);
		if ($_FILES["picture"]["size"] > 1000000){
			$_SESSION["validasi_ann"] = "Maksimal ukuran gambar adalah 1MB";
			header("Location: ../view/admin/admBuatAnn.php");
			exit();
		}
		elseif ($mime != "image/gif" && $mime != "image/jpeg" && $mime != "image/png") {
			$_SESSION["validasi_ann"] = "Harap upload gambar dengan format .gif, .jpeg, atau .png";
			header("Location: ../view/admin/admBuatAnn.php");
			echo "test image";
			exit();
		}
		
		$pengumuman = array('judul' => strip_tags($_POST["judul"]),
							'isi' => strip_tags($_POST["isi"]),
							'picture' => $picture,
							'id_kategori' => $_POST["kategori"],
							'id_penulis' => $_SESSION["user"]->id,
							'dibuat' => $dibuat
							);
		$hasil = $ann->buatPengumuman($pengumuman);

		if ($hasil[0]) {
			$dir = "../storage/pengumuman-pic/";
			$fileType = strtolower(pathinfo(basename($_FILES["picture"]["name"]), PATHINFO_EXTENSION));
			$picture = $dir . $hasil[1] . "." . $fileType; 
			$upload = move_uploaded_file($_FILES["picture"]["tmp_name"], $picture);

			$setPic = $ann->setPicture($picture, $hasil[1]);
			if ($setPic) {

				$idUsers = $us->getIdUsersNot($_SESSION["user"]->id);
				date_default_timezone_set("Asia/Jakarta");
				$dibuat = date("Y-m-d H:i:s");

				$buatNotif = $notifikasi->buatNotifAnn($hasil[1], $idUsers, $dibuat);

				header("location: c_lihatPengumuman.php?id=".$hasil[1]);
			}
			else{
				echo "input gambar gagal";
			}
		}
		else{
			echo "input ann gagal2";
		}

	}

}

?>