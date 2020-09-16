<?php 
include_once '../allModel.php';
session_start();

$ann = new m_pengumuman();
$notifikasi = new m_notif();

$id_ann="";
if (!empty($_GET["id"])) {
	$id_ann = $_GET["id"];
}
else {
	echo "id tak ada";
}

// $pengumuman = $ann->getPengumuman($id_ann);
$pengumuman = $_SESSION["pengumuman"];
if ($pengumuman->picture != "") {
	unlink("$pengumuman->picture");
}

$hasil = $ann->hapusPengumuman($id_ann);

if ($hasil) {

	$delNotif = $notifikasi->hapusNotifAnn($id_ann);
	if (!$delNotif) {
		echo "gagal hapus notif pengumuman";
	}

	unset($_SESSION["pengumuman"]);
	header("location: c_pengumumanPage.php");
}
else{
	echo "gagal hapus pengumuman";
}

?>