<?php 
include_once '../allModel.php';
session_start();

$announce = new m_pengumuman();
$notifikasi = new m_notif();

$id_ann = $_POST["id_ann"];
$pengumuman = $announce->getPengumuman($id_ann);

if ($pengumuman->picture != "") {
	unlink("$pengumuman->picture");
}

if ($announce->hapusPengumuman($id_ann)) {
	$notifikasi->hapusNotifAnn($id_ann);
	
	$all = $announce->getAllPengumuman();
	$no = 0;
    foreach ($all as $ann) {
    	$no = $no + 1;
    	$tgl_dibuat = date_create($ann->dibuat, timezone_open('Asia/Jakarta'));
    	echo '<tr class="tampil" id="'.$ann->id.'">';
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
	echo "ann tidak terhapus";
}

// else{
// 	echo "id_ann tak ada";;
// }
?>