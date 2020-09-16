<?php 
include_once '../allModel.php';
session_start();

$ann = new m_pengumuman();

$_SESSION["kategori"] = $ann->getKategori();


$id_ann="";
if (!empty($_GET["id"])) {
	$id_ann = $_GET["id"];
}
else {
	echo "id tak ada";
}

$pengumuman = $ann->getPengumuman($id_ann);

if (!empty($pengumuman)) {
	$_SESSION["pengumuman"] = $pengumuman;
	header("location: ../view/admin/admEditAnn.php");
}
else{
	echo "pengumuman tidak ada";
}


?>