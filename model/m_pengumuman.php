<?php
include_once '../allModel.php';
/**
 * 
 */
class m_pengumuman extends connection
{

	function __construct()
	{
		# code...
	}

	public function getKategori()
	{
		try {
			$stmt = $this->koneksi()->prepare("SELECT * FROM kategori");
			$stmt->execute();

			$res = $stmt->fetchAll();

			return $res;
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	
	public function buatPengumuman($ann)
	{
		$query = "INSERT INTO pengumuman (judul, isi, picture, id_kategori, id_penulis, dibuat) VALUES (?, ?, ?, ?, ?, ?)";

		try {

			$stmt = $this->koneksi()->prepare($query);
			$stmt->bindParam(1, $ann["judul"]);
			$stmt->bindParam(2, $ann["isi"]);
			$stmt->bindParam(3, $ann["picture"]);
			$stmt->bindParam(4, $ann["id_kategori"]);
			$stmt->bindParam(5, $ann["id_penulis"]);
			$stmt->bindParam(6, $ann["dibuat"]);
			$masukkan = $stmt->execute();

			$getId = $this->koneksi()->prepare("SELECT MAX(id) FROM pengumuman");
			$getId->execute();
			$id = $getId->fetch();

			return array($masukkan, $id[0]);
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function setPicture($picture, $id)
		{
			try {
				$stmt = $this->koneksi()->prepare("UPDATE pengumuman SET picture = ? WHERE id = ?");
				$stmt->bindParam(1, $picture);
				$stmt->bindParam(2, $id);
				$hasil = $stmt->execute();

				return $hasil;
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			
		}

	public function getPengumuman($id)
	{
		$query = 'SELECT p.*, k.nama AS "kategori", u.nama AS "penulis"
				FROM pengumuman p
				JOIN kategori k ON p.id_kategori = k.id
				JOIN user u ON p.id_penulis = u.id
				WHERE p.id = ?';
		try {
			$stmt = $this->koneksi()->prepare($query);
			$stmt->bindParam(1, $id);
			$stmt->execute();

			$stmt->setFetchMode(PDO::FETCH_CLASS, 'pengumuman');
			$res = $stmt->fetch();

			return $res;
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function getAllPengumuman()
	{
		$query = 'SELECT p.*, k.nama AS "kategori"
		FROM pengumuman p
		JOIN kategori k ON p.id_kategori = k.id 
		ORDER BY p.dibuat DESC';

		try {
			$stmt = $this->koneksi()->prepare($query);
			$stmt->execute();

			$stmt->setFetchMode(PDO::FETCH_CLASS, 'pengumuman');
			$res = $stmt->fetchAll();

			return $res;
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function filterPengumuman($id_kategori)
	{
		$query = 'SELECT p.*, k.nama AS "kategori" 
				FROM pengumuman p
				JOIN kategori k ON p.id_kategori = k.id
				WHERE p.id_kategori = ?
				ORDER BY p.dibuat DESC';

		try {
			$stmt = $this->koneksi()->prepare($query);
			$stmt->bindParam(1, $id_kategori);
			$stmt->execute();

			$stmt->setFetchMode(PDO::FETCH_CLASS, 'pengumuman');
			$res = $stmt->fetchAll();

			return $res;
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function editPengumuman($newAnn)
	{
		$query = 'UPDATE pengumuman SET judul=?, isi=?, picture=?, id_kategori=?, diubah=? WHERE id = ?';
		try {
			$stmt = $this->koneksi()->prepare($query);
			$stmt->bindParam(1, $newAnn["judul"]);
			$stmt->bindParam(2, $newAnn["isi"]);
			$stmt->bindParam(3, $newAnn["picture"]);
			$stmt->bindParam(4, $newAnn["id_kategori"]);
			$stmt->bindParam(5, $newAnn["diubah"]);
			$stmt->bindParam(6, $newAnn["id"]);

			$hasil = $stmt->execute();

			return $hasil;
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function hapusPengumuman($id)
	{
		try {
			$stmt = $this->koneksi()->prepare('DELETE FROM pengumuman WHERE id = ?');
			$stmt->bindParam(1, $id);
			$hasil = $stmt->execute();

			return $hasil;
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

}

?>