<?php 
include_once '../allModel.php';
session_start();

$lap = new m_laporan();
$laporan = "";

if ($_POST["status"] == "Semua") {

	if ($_SESSION["user"]->id_role == 1) {
		$laporan = $lap->getAllLaporan();
	}
	else if($_SESSION["user"]->id_role == 2){
		$laporan = $lap->getLaporanUser($_SESSION["user"]->id);
	}

	tampilkan($laporan);
}
else{
	$status = $_POST["status"];
	if ($_SESSION["user"]->id_role == 1) {
		$laporan = $lap->filterStatus($status);
	}
	else if($_SESSION["user"]->id_role == 2){
		$laporan = $lap->filterLaporanUser($status, $_SESSION["user"]->id);
	}
	tampilkan($laporan);
}

function tampilkan($laporan)
{
	if ($_SESSION["user"]->id_role == 1) {
		$notif_laporan = $_SESSION["notif_laporan"];
		if (count($laporan) > 0){
			$no=0;
	        foreach ($laporan as $key) {
	        	$no = $no + 1;
	          	$tgl_dibuat = date_create($key->dibuat, timezone_open('Asia/Jakarta'));
	          	$tgl_laporan = date_create($key->tgl_laporan, timezone_open('Asia/Jakarta'));

	          	$bola="";
	          	if (!empty($notif_laporan)) {
                  foreach ($notif_laporan as $notif) {
                    if ($notif->id_obyek == $key->id && empty($notif->dilihat)) {
                      $bola = '<span id="ball"></span>';
                        
                    }
                  }
                }

	          	echo "<tr class='tampil'>";
	          	echo "<td>".$no."</td>";
	            echo '<td><a href="../../controller/c_lihatLaporan.php?id='.$key->id.'">'.$key->judul.'</a>'.$bola.'</td>';
	            echo "<td>".date_format($tgl_dibuat, "d M Y H:i")."</td>";
	            echo "<td>".$key->pelapor."</td>";
	            echo "<td>".$key->kecamatan.", ".$key->kelurahan."</td>";
	            echo "<td>".$key->status."</td>";
	          echo "</tr>";
	        }
	    }
	    else{
	    	echo '<tr>
				<td colspan="6" style="text-align: center;">Tidak Ada Data</td>
				</tr>';
	    }
	}
	elseif($_SESSION["user"]->id_role == 2){
		if (count($laporan) > 0){
			$no=0;
            foreach ($laporan as $key) {
            	$no = $no + 1;
              	$tgl_dibuat = date_create($key->dibuat, timezone_open('Asia/Jakarta'));
              	$tgl_laporan = date_create($key->tgl_laporan, timezone_open('Asia/Jakarta'));
              	echo "<tr class='tampil'>";
              		echo "<td>".$no."</td>";
                	echo '<td><a href="../../controller/c_lihatLaporan.php?id='.$key->id.'">'.$key->judul.'</a></td>';
                	echo "<td>".date_format($tgl_dibuat, "d M Y H:i")."</td>";
                	echo "<td>".date_format($tgl_laporan, "d M Y H:i")."</td>";
                	echo "<td>".$key->status."</td>";
                	if ($key->status != "Belum diverifikasi") {
                  	echo "<td>-</td>";
                	}
                	else{
                  	echo '<td><a href="../../controller/c_lapEditPage.php?id='.$key->id.'" class="btn btn-warning">Ubah</a></td>';
                	}
              	echo "</tr>";
            }
	    }
	    else{
	    	echo '<tr>
				<td colspan="6" style="text-align: center;">Tidak Ada Data</td>
				</tr>';
	    }
	}
}


?>