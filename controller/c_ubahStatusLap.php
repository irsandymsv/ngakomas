<?php 
include_once '../allModel.php';
session_start();

$lap = new m_laporan();
$status = $_POST["status"];
// var_dump($_SESSION["laporan"][0]);
// exit();

$ubah = array('status' => $status, 
			'id_ubahStatus'=> $_SESSION["user"]->id,
			'id' => $_SESSION["laporan"]->id
		);

if ($lap->ubahStatus($ubah)) {
	$_SESSION["status-change"] = "Status laporan berhasil diubah";
	header("location: c_lihatLaporan.php?id=".$_SESSION["laporan"]->id);
}else {
	echo "ubah status gagal";
}

?>