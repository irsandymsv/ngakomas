<?php 
include_once '../allModel.php';
session_start();
unset($_SESSION["pengumuman"]);

$ann = new m_pengumuman();
$notifikasi = new m_notif();

if (!empty($_GET["id"])) {
	$id_ann = $_GET["id"];
}
else {
	echo "id tak ada";
}

$pengumuman = $ann->getPengumuman($id_ann);

if (!empty($pengumuman)) {
	$_SESSION["pengumuman"] = $pengumuman;

	if ($_SESSION["user"]->id_role == 1) {
		header("Location: ../view/admin/admLihatAnn.php");	
	}
	elseif($_SESSION["user"]->id_role == 2){

		foreach ($_SESSION["notif_ann"] as $notif) {
			if ($notif->id_obyek == $id_ann && empty($notif->dilihat)) {
				date_default_timezone_set("Asia/Jakarta");
				$dilihat = date("Y-m-d H:i:s");

				$notifikasi->markAsRead($notif->id, $dilihat);

				unset($_SESSION["notif_ann"]);
				$_SESSION["notif_ann"] = $notifikasi->getNotifAnn($_SESSION["user"]->id);
				break;
			}
		}

		header("Location: ../view/masyarakat/lihatAnn.php");
	}
}
else{
	echo "data tidak ada";
}

?>