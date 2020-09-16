<?php 
include_once '../allModel.php';
session_start();

$lap = new m_laporan();

if (!empty($_POST["kec"])) {
	$id_kec = $_POST["kec"];
	$kelurahan =  $lap->getKelurahan($id_kec);

	if (count($kelurahan) > 0) {
		foreach ($kelurahan as $kel) {
			echo '<option value="'.$kel["id"].'">'.$kel["nama"].'</option>';
		}
	}else {
		echo '<option value="">Data Tidak Ada</option>';
	}

}
else{
	echo "bisa kah";
	$kelurahan =  $lap->getAllKelurahan();

	if (count($kelurahan) > 0) {
		echo '<option value="">--Pilih kelurahan--</option>';
		foreach ($kelurahan as $kel) {
			echo '<option value="'.$kel["id"].'">'.$kel["nama"].'</option>';
		}
	}else {
		echo '<option value="">Data Tidak Ada</option>';
	}
}


?>