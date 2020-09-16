<?php 
include_once '../allModel.php';
/**
 * 
 */
class m_notif extends connection
{
	
	function __construct()
	{
		
	}

	public function buatNotifLaporan($id_laporan, $id_penerima, $dibuat)
	{
		try {
			$hasil = true;
			$tipe = "laporan";
			for ($i=0; $i < count($id_penerima); $i++) { 
				$stmt = $this->koneksi()->prepare('INSERT INTO notifikasi (tipe, id_obyek,  id_penerima, dibuat) VALUES (?, ?, ?, ?)');
				$stmt->bindParam(1, $tipe);
				$stmt->bindParam(2, $id_laporan);
				$stmt->bindParam(3, $id_penerima[$i]);
				$stmt->bindParam(4, $dibuat);
				
				if (!$stmt->execute()) {
					break;
					$hasil = false;
					return $hasil;
				}
			}
			
			return $hasil;
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function getNotifLaporan($id_penerima)
	{
		try {
			$tipe = "laporan";
			$dilihat = "";
			$stmt = $this->koneksi()->prepare('SELECT * FROM notifikasi WHERE tipe = ? AND id_penerima = ? AND dilihat IS NULL ');
			$stmt->bindParam(1, $tipe);
			$stmt->bindParam(2, $id_penerima);
			$stmt->execute();

			$stmt->setFetchMode(PDO::FETCH_CLASS, 'notifikasi');
			$res = $stmt->fetchAll();
			return $res;
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function buatNotifAnn($id_ann, $id_penerima, $dibuat)
	{
		try {
			$hasil = true;
			$tipe = "pengumuman";
			for ($i=0; $i < count($id_penerima); $i++) { 
				
				$id_user = intval($id_penerima[$i][0]);
				$stmt = $this->koneksi()->prepare('INSERT INTO notifikasi (tipe, id_obyek,  id_penerima, dibuat) VALUES (?, ?, ?, ?)');
				$stmt->bindParam(1, $tipe);
				$stmt->bindParam(2, $id_ann);
				$stmt->bindParam(3, $id_user);
				$stmt->bindParam(4, $dibuat);
				
				if (!$stmt->execute()) {
					break;
					$hasil = false;
					return $hasil;
				}
			}
			
			return $hasil;
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function getNotifAnn($id_penerima)
	{
		try {
			$tipe = "pengumuman";
			$dilihat = "";
			$stmt = $this->koneksi()->prepare('SELECT * FROM notifikasi WHERE tipe = ? AND id_penerima = ? AND dilihat IS NULL ');
			$stmt->bindParam(1, $tipe);
			$stmt->bindParam(2, $id_penerima);
			$stmt->execute();

			$stmt->setFetchMode(PDO::FETCH_CLASS, 'notifikasi');
			$res = $stmt->fetchAll();
			return $res;
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function markAsRead($id, $dilihat)
	{
		try {
			$stmt = $this->koneksi()->prepare('UPDATE notifikasi SET dilihat = ? WHERE id = ?');
			$stmt->bindParam(1, $dilihat);
			$stmt->bindParam(2, $id);
			$hasil = $stmt->execute();

			return $hasil;
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function hapusNotifAnn($id_obyek)
	{
		try {
			$hasil = true;
			$tipe="pengumuman";
			
			$stmt = $this->koneksi()->prepare('SELECT id FROM notifikasi WHERE tipe = ? AND id_obyek = ?');
			$stmt->bindParam(1, $tipe);
			$stmt->bindParam(2, $id_obyek);
			$stmt->execute();

			$id_notif = $stmt->fetchAll(PDO::FETCH_NUM);

			for ($i=0; $i < count($id_notif); $i++) { 
				$id = intval($id_notif[$i][0]);
				$stmt = $this->koneksi()->prepare('DELETE FROM notifikasi WHERE id = ?');
				$stmt->bindParam(1, $id);

				if (!$stmt->execute()) {
					$hasil = false;
					return $hasil;
				}
			}

			return $hasil;
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
}
?>