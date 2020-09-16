<?php 
include_once '../allModel.php';
session_start();

$lap = new m_laporan();
$notif = new m_notif();

$all = $lap->getAllLaporan();
$_SESSION["laporan-all"] = $all;

$notif_laporan = $notif->getNotifLaporan($_SESSION["user"]->id);
// var_dump($notif_laporan[0]->id_obyek);
// exit();

$_SESSION["notif_laporan"] = $notif_laporan;
header("Location: ../view/admin/admBeranda.php");

?>