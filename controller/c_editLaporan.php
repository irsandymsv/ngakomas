<?php 
include_once '../allModel.php';
session_start();

$laporan = $_SESSION["laporan"];
$lap = new m_laporan();

$alphaNumeric = "/^[a-zA-Z0-9 ]+$/";

if (empty($_POST["judul"]) || empty($_POST["alamat"]) || empty($_POST["kecamatan"]) || empty($_POST["kelurahan"]) || empty($_POST["tgl_laporan"]) || empty($_POST["deskripsi"]) ) 
{
	$_SESSION["lapor-salah"] = "Harap isi semua kolom yang ada";
	header("Location: ../view/masyarakat/editLaporan.php");
}
elseif (strlen($_POST["judul"]) > 50) {
	$_SESSION["lapor-salah"] = "Harap isi judul dengan maksimal 50 karakter";
	header("Location: ../view/masyarakat/editLaporan.php");
}
elseif (strlen($_POST["alamat"]) > 100) {
	$_SESSION["lapor-salah"] = "Harap isi alamat dengan maksimal 100 karakter";
	header("Location: ../view/masyarakat/editLaporan.php");
}
elseif (strlen($_POST["deskripsi"]) > 200) {
	$_SESSION["lapor-salah"] = "Harap isi deskripsi dengan maksimal 200 karakter";
	header("Location: ../view/masyarakat/editLaporan.php");
}
elseif (!preg_match($alphaNumeric, $_POST["judul"])) {
	$_SESSION["lapor-salah"] = "Harap isi judul dengan huruf, angka, dan spasi saja";
	header("Location: ../view/masyarakat/editLaporan.php");	
}
else{
	$tgl = date_create($_POST["tgl_laporan"]);
	$tgl_laporan = date_format($tgl, "Y-m-d H:i:s");
	// $isiLapor = strip_tags($_POST["deskripsi"]);
	$picture = "";

	if($_FILES["picture"]["size"] <= 0)
	{
		$picture = $laporan->picture;

		if ($_POST["hapusImg"] == "hapus") {
			$picture = "";
			if (!empty($laporan->picture)) {
				if (!unlink("$laporan->picture")) //menghapus gambar
				{
					echo "gambar gagal dihapus";
				}
			}	
		}
		
	}
	else{

		$mime = mime_content_type($_FILES["picture"]["tmp_name"]);
		if ($_FILES["picture"]["size"] > 1000000){
			$_SESSION["lapor-salah"] = "Maksimal ukuran gambar adalah 1MB";
			header("Location: ../view/masyarakat/editLaporan.php");
			exit();
		}
		elseif ($mime != "image/gif" && $mime != "image/jpeg" && $mime != "image/png") {
			$_SESSION["lapor-salah"] = "Harap upload gambar dengan format .gif, .jpeg, atau .png";
			header("Location: ../view/masyarakat/editLaporan.php");
			echo "test image";
			exit();
		}

		if (!empty($laporan->picture)) {
			if (!unlink("$laporan->picture")) //menghapus gambar
			{
				echo "gambar gagal dihapus";
			}
		}

		$dir = "../storage/laporan-pic/";
		$fileType = strtolower(pathinfo(basename($_FILES["picture"]["name"]), PATHINFO_EXTENSION));
		$picture = $dir . $laporan->id . "." . $fileType;
		$upload = move_uploaded_file($_FILES["picture"]["tmp_name"], $picture);

	}

	$newLap = array('id' => $laporan->id,
						'judul' => strip_tags($_POST["judul"]),
						'tgl_laporan' => $tgl_laporan, 
						'deskripsi' => strip_tags($_POST["deskripsi"]),
						'alamat' => strip_tags($_POST["alamat"]),
						'picture' => $picture,
						'id_kecamatan' => $_POST["kecamatan"],
						'id_kelurahan' => $_POST["kelurahan"]
					);
	$hasil = $lap->editLaporan($newLap);

	if ($hasil) {
		header("Location: c_lihatLaporan.php?id=$laporan->id");
	}
	else {
		echo "update data gagal";
	}

}

?>