<?php 
include_once '../allModel.php';
session_start();

$lap = new m_laporan();
$_SESSION["kecamatan"] = $lap->getAllKecamatan();
$_SESSION["kelurahan"] = $lap->getAllKelurahan();

$id="";
if (!empty($_GET["id"])) {
	$id = $_GET["id"];
}
else {
	echo "id tak ada";
}

$laporan = $lap->getLaporan($id);

if (!empty($laporan)) {
	$_SESSION["laporan"] = $laporan;
	header("Location: ../view/masyarakat/editLaporan.php");

}else {
	echo "data laporan tak ada";
}
	



?>