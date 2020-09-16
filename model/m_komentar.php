<?php 
	include_once '../allModel.php';
/**
 * 
 */
class m_komentar extends connection
{
	
	function __construct()
	{
		
	}

	public function buatKomentar($komen)
	{
		try {
			date_default_timezone_set("Asia/Jakarta");
			$dibuat = date("Y-m-d H:i:s");

			$stmt = $this->koneksi()->prepare("INSERT INTO komentar (isi, id_laporan, id_penulis, dibuat) VALUES (?, ?, ?, ?)");
			
			$stmt->bindParam(1, $komen["isi"]);
			$stmt->bindParam(2, $komen["id_laporan"]);
			$stmt->bindParam(3, $komen["id_penulis"]);
			$stmt->bindParam(4, $dibuat);
			$masukkan = $stmt->execute();

			$getId = $this->koneksi()->prepare("SELECT MAX(id) FROM komentar");
			$getId->execute();
			$newId = $getId->fetch();

			return array($masukkan, $newId[0]);
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function getKomentar($id_laporan)
	{
		$query ='SELECT k.*, u.nama AS "penulis" 
					FROM komentar k 
					JOIN user u ON k.id_penulis = u.id 
					WHERE id_laporan = ?';
		try {
			$stmt = $this->koneksi()->prepare($query);
			$stmt->bindParam(1, $id_laporan);
			$stmt->execute();

			$stmt->setFetchMode(PDO::FETCH_CLASS, 'komentar');
			$res = $stmt->fetchAll();

			return $res;

		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}

	}

	public function editKomentar($komen)
	{
		date_default_timezone_set("Asia/Jakarta");
		$diubah = date("Y-m-d H:i:s");
		$query = 'UPDATE komentar SET isi = ?, diubah = ? WHERE id = ?';
		try {
			$stmt = $this->koneksi()->prepare($query);
			$stmt->bindParam(1, $komen["isi"]);
			$stmt->bindParam(2, $diubah);
			$stmt->bindParam(3, $komen["id"]);

			$hasil = $stmt->execute();
			return $hasil;

		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function hapusKomentar($id)
	{
		try {
			
			$stmt = $this->koneksi()->prepare('DELETE FROM komentar WHERE id = ?');
			$stmt->bindParam(1, $id);
			$hasil = $stmt->execute();

			return $hasil;

		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
}
?>