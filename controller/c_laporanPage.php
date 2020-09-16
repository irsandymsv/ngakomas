<?php 
include_once '../allModel.php';
session_start();

$lap = new m_laporan();
$notifikasi = new m_notif();


if ($_SESSION["user"]->id_role == 1) {
	$all = $lap->getAllLaporan();
	$_SESSION["laporan-all"] = $all;
	header("Location: ../view/admin/admLaporan.php");
}
elseif ($_SESSION["user"]->id_role == 2){

	$lapAll = $lap->getLaporanUser($_SESSION["user"]->id);
	$_SESSION["laporan-user"] = $lapAll;

	$notif_ann = $notifikasi->getNotifAnn($_SESSION["user"]->id);
	$_SESSION["notif_ann"] = $notif_ann;
	// var_dump($notif_ann);
	// exit();

	header("Location: ../view/masyarakat/laporanPage.php");
}

?>