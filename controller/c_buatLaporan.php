<?php 
	include_once '../allModel.php';
	session_start();

	$lap = new m_laporan();
	$_SESSION["kecamatan"] = $lap->getAllKecamatan();
	$_SESSION["kelurahan"] = $lap->getAllKelurahan();

	header("Location: ../view/masyarakat/buatLaporan.php");

 ?>