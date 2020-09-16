<?php 
include_once '../allModel.php';
session_start();

$ann = new m_pengumuman();

$_SESSION["kategori"] = $ann->getKategori();

header("location: ../view/admin/admBuatAnn.php");

?>