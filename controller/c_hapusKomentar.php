<?php 
include_once '../allModel.php';
session_start();

$komen = new m_komentar();
$id="";
if (!empty($_GET["id"])) {
	$id = $_GET["id"];
}else{
	echo "id komentar tidak ada";
}

$hasil = $komen->hapusKomentar($id);
if ($hasil) {
	unset($_SESSION["komentar"]);
	$_SESSION["komentar"] = $komen->getKomentar($_SESSION["laporan"]->id);
	if ($_SESSION["user"]->id_role == 1) {
		header("location: ../view/admin/admLihatLaporan.php");
	}
	elseif ($_SESSION["user"]->id_role == 2) {
		header("location: ../view/masyarakat/lihatLaporan.php");	
	}
}
else{
	echo "gagal hapus komen";
}

?>