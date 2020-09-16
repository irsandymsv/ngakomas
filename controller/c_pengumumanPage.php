<?php 
include_once '../allModel.php';
session_start();
// unset($_SESSION["pengumuman"]);

$ann = new m_pengumuman();

$_SESSION["allPengumuman"] = $ann->getAllPengumuman();
$_SESSION["kategori"] = $ann->getKategori();

if ($_SESSION["user"]->id_role == 1) {
	header("location: ../view/admin/admAnn.php");
}
elseif ($_SESSION["user"]->id_role == 2){
	header("location: ../view/masyarakat/pengumuman.php");
}

?>