<?php 
include_once '../allModel.php';
session_start();

$komen = new m_komentar();
$id_komen = "";
if (!empty($_GET["id"])) {
	$id_komen = $_GET["id"];
	echo $id_komen;
	// exit();
}
else {
	echo "id tak ada";
}

if (empty($_POST["isi"])) {
	$_SESSION["editKomen-validasi".$id_komen] = "Harap isi kolom komentar terlebih dahulu";
	if ($_SESSION["user"]->id_role == 1) {
		header("location: ../view/admin/admLihatLaporan.php#komen".$id_komen);
	}
	elseif ($_SESSION["user"]->id_role == 2){
		header("location: ../view/masyarakat/lihatLaporan.php#komen".$id_komen);
	}
}
elseif (strlen($_POST["isi"]) > 500) {
	$_SESSION["editKomen-validasi".$id_komen] = "Harap isi kolom komentar dengan maksimal 500 karakter";
	if ($_SESSION["user"]->id_role == 1) {
		header("location: ../view/admin/admLihatLaporan.php#komen".$id_komen);
	}
	elseif ($_SESSION["user"]->id_role == 2){
		header("location: ../view/masyarakat/lihatLaporan.php#komen".$id_komen);
	}	
}
else{

	$newKomen = array('isi' => strip_tags($_POST["isi"]), 'id' => $id_komen);
	$hasil = $komen->editKomentar($newKomen);
	if ($hasil) {
		unset($_SESSION["komentar"]);
		$komentar = $komen->getKomentar($_SESSION["laporan"]->id);
		$_SESSION["komentar"] = $komentar;
		
		if ($_SESSION["user"]->id_role == 1) {
			// header("Location: c_lihatLaporan.php?id=".$_SESSION["laporan"]->id);
			header("location: ../view/admin/admLihatLaporan.php#komen".$id_komen);
		}
		elseif ($_SESSION["user"]->id_role == 2){
			header("location: ../view/masyarakat/lihatLaporan.php#komen".$id_komen);
		}
	}else{
		echo "update komentar gagal";
	}
}

?>