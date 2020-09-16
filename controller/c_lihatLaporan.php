<?php 
include_once '../allModel.php';
session_start();
unset($_SESSION["laporan"]);
unset($_SESSION["komentar"]);

$lap = new m_laporan();
$komen = new m_komentar();
$notifikasi = new m_notif();

if (!empty($_GET["id"])) {
	$id_lap = $_GET["id"];
}
else {
	echo "id tak ada";
}

$laporan = $lap->getLaporan($id_lap);
$komentar = $komen->getKomentar($id_lap);
// var_dump($laporan->kelurahan);
// exit();

if (!empty($laporan)) {

	$_SESSION["laporan"] = $laporan;
	$_SESSION["komentar"] = $komentar;

	if ($_SESSION["user"]->id_role == 1) {

		foreach ($_SESSION["notif_laporan"] as $notif) {
			if ($notif->id_obyek == $id_lap && empty($notif->dilihat)) {
				date_default_timezone_set("Asia/Jakarta");
				$dilihat = date("Y-m-d H:i:s");

				$notifikasi->markAsRead($notif->id, $dilihat);

				unset($_SESSION["notif_laporan"]);
				$_SESSION["notif_laporan"] = $notifikasi->getNotifLaporan($_SESSION["user"]->id);
			}
		}

		header("Location: ../view/admin/admLihatLaporan.php");	
	}
	elseif($_SESSION["user"]->id_role == 2){
		header("Location: ../view/masyarakat/lihatLaporan.php");
	}
}else {
	echo "data laporan tak ada";
}

?>