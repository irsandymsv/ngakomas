<?php 
include_once '../allModel.php';
session_start();

$announce = new m_pengumuman();


if ($_POST["id_kategori"] == "") {
	$pengumuman = $announce->getAllPengumuman();
	tampilkan($pengumuman);
}
else{
	$id_kategori = $_POST["id_kategori"];
	$pengumuman = $announce->filterPengumuman($id_kategori);
	tampilkan($pengumuman);
}

function tampilkan($pengumuman)
{
	if ($_SESSION["user"]->id_role == 1) {
		if (count($pengumuman) > 0) {
			$no = 0;
		    foreach ($pengumuman as $ann) {
		      $no = $no + 1;
		      $tgl_dibuat = date_create($ann->dibuat, timezone_open('Asia/Jakarta'));
		      echo '<tr class="tampil">';
		        echo "<td>".$no."</td>";
		        echo '<td><a href="../../controller/c_lihatPengumuman.php?id='.$ann->id.'">'.$ann->judul.'</a></td>';
		        echo "<td>".date_format($tgl_dibuat, "d M Y H:i")."</td>";
		        echo '<td>'.$ann->kategori.'</td>';
		        echo '
			        <td>
			        <a href="../../controller/c_annEditPage.php?id='.$ann->id.'" class="btn btn-warning" style="margin-right: 5px;">Ubah</a>
			        <button id="'.$ann->id.'" class="btn btn-danger" name="delBtn" data-toggle="modal" data-target="#myModal">Hapus</Button>
			        </td>';
		      echo '</tr>';
		    }
		}
		else{
			echo '<tr>
				<td colspan="5" style="text-align: center;">Tidak Ada Data</td>
				</tr>';
		}
	}
	elseif($_SESSION["user"]->id_role == 2){
		$notif_ann = $_SESSION["notif_ann"];
		if (count($pengumuman) > 0) {
			$no = 0;
		    foreach ($pengumuman as $ann) {
		      $no = $no + 1;
		      $tgl_dibuat = date_create($ann->dibuat, timezone_open('Asia/Jakarta'));

		      $bola="";
              if (!empty($notif_ann)) {
                foreach ($notif_ann as $notif) {
                  if ($notif->id_obyek == $ann->id && empty($notif->dilihat)) {
                    $bola = '<span id="ball"></span>';
                  }
                }
              }

		      echo '<tr>';
		        echo "<td>".$no."</td>";
		        echo '<td><a href="../../controller/c_lihatPengumuman.php?id='.$ann->id.'">'.$ann->judul.'</a>'.$bola.'</td>';
		        echo "<td>".date_format($tgl_dibuat, "d M Y H:i")."</td>";
		        echo '<td>'.$ann->kategori.'</td>';
		      echo '</tr>';
		    }
		}
		else{
			echo '<tr>
				<td colspan="4" style="text-align: center;">Tidak Ada Data</td>
				</tr>';
		}
	}
}

?>