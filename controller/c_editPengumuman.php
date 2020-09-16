<?php 
include_once '../allModel.php';
session_start();

$pengumuman = $_SESSION["pengumuman"];
$ann = new m_pengumuman();

$alphaNumeric = "/^[a-zA-Z0-9 ]+$/";

if (empty($_POST["judul"]) || empty($_POST["isi"]) || empty($_POST["kategori"]) ) 
{
	$_SESSION["validasi_ann"] = "Harap isi semua kolom yang ada";
	header("Location: ../view/admin/admEditAnn.php");
}
elseif (strlen($_POST["judul"]) > 50) {
	$_SESSION["validasi_ann"] = "Harap isi judul dengan maksimal 50 karakter";
	header("Location: ../view/admin/admEditAnn.php");
}
elseif (strlen($_POST["deskripsi"]) > 200) {
	$_SESSION["validasi_ann"] = "Harap isi deskripsi dengan maksimal 200 karakter";
	header("Location: ../view/admin/admEditAnn.php");
}
elseif (!preg_match($alphaNumeric, $_POST["judul"])) {
	$_SESSION["validasi_ann"] = "Harap isi judul dengan huruf, angka, dan spasi saja";
	header("Location: ../view/admin/admEditAnn.php");	
}
else{
	$picture = "";

	if ($_FILES["picture"]["size"] <= 0) {

		$picture = $pengumuman->picture;
		
		if ($_POST["hapusImg"] == "hapus") {
			$picture = "";
			if (!empty($pengumuman->picture)) {
				if (!unlink("$pengumuman->picture")) //menghapus gambar
				{
					echo "gambar gagal dihapus";
				}
			}
		}
		
	}
	else{

		$mime = mime_content_type($_FILES["picture"]["tmp_name"]);
		if ($_FILES["picture"]["size"] > 1000000){
			$_SESSION["validasi_ann"] = "Maksimal ukuran gambar adalah 1MB";
			header("Location: ../view/admin/admEditAnn.php");
			exit();
		}
		elseif ($mime != "image/gif" && $mime != "image/jpeg" && $mime != "image/png") {
			$_SESSION["validasi_ann"] = "Harap upload gambar dengan format .gif, .jpeg, atau .png";
			header("Location: ../view/admin/admEditAnn.php");
			echo "test image";
			exit();
		}

		if (!empty($pengumuman->picture)) {
			if (!unlink("$pengumuman->picture")) //menghapus gambar
			{
				echo "gambar gagal dihapus";
			}
		}

		$dir = "../storage/pengumuman-pic/";
		$fileType = strtolower(pathinfo(basename($_FILES["picture"]["name"]), PATHINFO_EXTENSION));
		$picture = $dir . $pengumuman->id . "." . $fileType; 
		$upload = move_uploaded_file($_FILES["picture"]["tmp_name"], $picture);
	}

	date_default_timezone_set("Asia/Jakarta");
	$diubah = date("Y-m-d H:i:s");

	$newAnn = array('id' => $pengumuman->id,
					'judul' => strip_tags($_POST["judul"]),
					'isi' => strip_tags($_POST["isi"]),
					'picture' => $picture,
					'id_kategori' => $_POST["kategori"],
					'diubah' => $diubah
					);

	$hasil = $ann->editPengumuman($newAnn);

	if ($hasil) {
		header("location: c_lihatPengumuman.php?id=$pengumuman->id");
	}else{
		echo "update gagal";
	}

}

?>