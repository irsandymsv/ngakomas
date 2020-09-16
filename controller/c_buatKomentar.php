<?php 

include_once '../allModel.php';
session_start();

$komen = new m_komentar();

if (empty($_POST["isiBaru"])) {
	$_SESSION["newKomen-validasi"] = "Harap isi komentar terlebih dahulu";
	if ($_SESSION["user"]->id_role == 1) {
		header("location: ../view/admin/admLihatLaporan.php#newCom");
	}
	elseif ($_SESSION["user"]->id_role == 2){
		header("location: ../view/masyarakat/lihatLaporan.php#newCom");
	}
}
elseif (strlen($_POST["isiBaru"]) > 500) {
	$_SESSION["newKomen-validasi"] = "Harap isi komentar dengan maksimal 500 karakter";
	if ($_SESSION["user"]->id_role == 1) {
		header("location: ../view/admin/admLihatLaporan.php#newCom");
	}
	elseif ($_SESSION["user"]->id_role == 2){
		header("location: ../view/masyarakat/lihatLaporan.php#newCom");
	}	
}
else{
	$komentar = array('isi' => strip_tags($_POST["isiBaru"]),
					'id_laporan' => $_SESSION["laporan"]->id,
					'id_penulis' => $_SESSION["user"]->id);

	$hasil = $komen->buatKomentar($komentar);

	if ($hasil[0]) {
		unset($_SESSION["komentar"]);
		$_SESSION["komentar"] = $komen->getKomentar($_SESSION["laporan"]->id);

		if ($_SESSION["user"]->id_role == 1) {
			
			header("location: ../view/admin/admLihatLaporan.php#komen".$hasil[1]);
		}
		elseif ($_SESSION["user"]->id_role == 2){
			header("location: ../view/masyarakat/lihatLaporan.php#komen".$hasil[1]);
		}

		// header("Location: c_lihatLaporan.php?id=".$_SESSION["laporan"]->id);
	}
	else{
		echo "gagal input komen";
	}

}


?>