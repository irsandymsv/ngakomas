<?php 
	include_once '../allModel.php';

	/**
	 * 
	 */
	class m_laporan extends connection
	{
		
		function __construct()
		{
			# code...
		}

		public function getAllKecamatan()
		{
			try {
				$stmt = $this->koneksi()->prepare("SELECT * FROM kecamatan");
				$stmt->execute();

				$res = $stmt->fetchAll();
				return $res;	

			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			
		}

		public function getAllKelurahan()
		{
			try {
				$stmt = $this->koneksi()->prepare("SELECT * FROM kelurahan");
				$stmt->execute();

				$res = $stmt->fetchAll();
				return $res;
				
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			
		}

		public function getKelurahan($id_kec)
		{
			try {
				$stmt = $this->koneksi()->prepare("SELECT * FROM kelurahan WHERE id_kecamatan = ?");
				$stmt->bindParam(1, $id_kec);
				$stmt->execute();

				$res = $stmt->fetchAll();
				return $res;
				
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			
		}

		public function buatLaporan($lap)
		{
			try {
				date_default_timezone_set("Asia/Jakarta");
				$dibuat = date("Y-m-d H:i:s");

				$stmt = $this->koneksi()->prepare("INSERT INTO laporan (judul, tgl_laporan, deskripsi, alamat, picture, id_kecamatan, id_kelurahan, id_pelapor, status, dibuat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

				$stmt->bindParam(1, $lap["judul"]);
				$stmt->bindParam(2, $lap["tgl_laporan"]);
				$stmt->bindParam(3, $lap["deskripsi"]);
				$stmt->bindParam(4, $lap["alamat"]);
				$stmt->bindParam(5, $lap["picture"]);
				$stmt->bindParam(6, $lap["id_kecamatan"]);
				$stmt->bindParam(7, $lap["id_kelurahan"]);
				$stmt->bindParam(8, $lap["id_pelapor"]);
				$stmt->bindParam(9, $lap["status"]);
				$stmt->bindParam(10, $dibuat);

				$masuk = $stmt->execute();

				$getId = $this->koneksi()->prepare("SELECT MAX(id) FROM laporan");
				$getId->execute();
				$id = $getId->fetch();

				$hasil = array($masuk, $id[0]);
				return $hasil;

			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			
		}

		public function getLaporan($id)
		{
			$query = 'SELECT l.*, u.nama AS "pelapor", kec.nama AS "kecamatan", kel.nama AS "kelurahan" 
						FROM laporan l 
						JOIN user u on l.id_pelapor = u.id
						JOIN kecamatan kec on l.id_kecamatan = kec.id 
						JOIN kelurahan kel on l.id_kelurahan = kel.id 
						WHERE l.id = ?';

			try {
				$stmt = $this->koneksi()->prepare($query);
				$stmt->bindParam(1, $id);
				$stmt->execute();

				// $res = $stmt->fetch(PDO::FETCH_ASSOC);
				// $lap = new laporan($res["id"], $res["judul"], $res["tgl_laporan"], $res["deskripsi"], $res["alamat"], $res["picture"], $res["id_kecamatan"], $res["id_kelurahan"], $res["id_pelapor"], $res["status"], $res["id_ubahStatus"], $res["tgl_ubahStatus"], $res["dibuat"], $res["diubah"]);

				$stmt->setFetchMode(PDO::FETCH_CLASS, 'laporan');
				$res = $stmt->fetch();

				return $res;

			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}

		public function getAllLaporan()
		{
			$query = 'SELECT l.*, u.nama AS "pelapor", k.nama AS "kecamatan", kl.nama AS "kelurahan" 
						FROM laporan l 
						JOIN user u on l.id_pelapor = u.id
						JOIN kecamatan k on l.id_kecamatan = k.id
						JOIN kelurahan kl ON l.id_kelurahan = kl.id
						ORDER BY l.dibuat DESC';
			try {

				$stmt = $this->koneksi()->prepare($query);
				$stmt->execute();

				$stmt->setFetchMode(PDO::FETCH_CLASS, 'laporan');
				$res = $stmt->fetchAll();
				return $res;

			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}

		public function getLaporanUser($pelapor)
		{
			$query = 'SELECT l.*, u.nama AS "pelapor", k.nama AS "kecamatan", kl.nama AS "kelurahan" 
						FROM laporan l 
						JOIN user u on l.id_pelapor = u.id
						JOIN kecamatan k on l.id_kecamatan = k.id
						JOIN kelurahan kl ON l.id_kelurahan = kl.id
						WHERE l.id_pelapor = ?
						ORDER BY l.dibuat DESC';
			try {

				$stmt = $this->koneksi()->prepare($query);
				$stmt->bindParam(1, $pelapor);
				$stmt->execute();

				$stmt->setFetchMode(PDO::FETCH_CLASS, 'laporan');
				$res = $stmt->fetchAll();
				return $res;

			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}

		public function filterStatus($status)
		{
			$query = 'SELECT l.*, u.nama AS "pelapor", k.nama AS "kecamatan", kl.nama AS "kelurahan" 
						FROM laporan l 
						JOIN user u on l.id_pelapor = u.id
						JOIN kecamatan k on l.id_kecamatan = k.id
						JOIN kelurahan kl ON l.id_kelurahan = kl.id
						WHERE l.status = ?
						ORDER BY l.dibuat DESC';
			try {
				$stmt = $this->koneksi()->prepare($query);
				$stmt->bindParam(1, $status);
				$stmt->execute();

				$stmt->setFetchMode(PDO::FETCH_CLASS, 'laporan');
				$res = $stmt->fetchAll();
				return $res;

			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
				
			}
		}

		public function filterLaporanUser($status, $id)
		{
			$query = 'SELECT l.*, u.nama AS "pelapor", k.nama AS "kecamatan", kl.nama AS "kelurahan" 
						FROM laporan l 
						JOIN user u on l.id_pelapor = u.id
						JOIN kecamatan k on l.id_kecamatan = k.id
						JOIN kelurahan kl ON l.id_kelurahan = kl.id
						WHERE l.status = ? AND l.id_pelapor = ?
						ORDER BY l.dibuat DESC';
			try {
				$stmt = $this->koneksi()->prepare($query);
				$stmt->bindParam(1, $status);
				$stmt->bindParam(2, $id);
				$stmt->execute();

				$stmt->setFetchMode(PDO::FETCH_CLASS, 'laporan');
				$res = $stmt->fetchAll();
				return $res;

			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
				
			}
		}

		public function setPicture($picture, $id)
		{
			try {
				$stmt = $this->koneksi()->prepare("UPDATE laporan SET picture = ? WHERE id = ?");
				$stmt->bindParam(1, $picture);
				$stmt->bindParam(2, $id);
				$hasil = $stmt->execute();

				return $hasil;
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			
		}

		public function getKecKel($kec, $kel)
		{
			try {
				$stmt = $this->koneksi()->prepare("SELECT nama FROM kecamatan WHERE id = $kec");
				$stmt->execute();

				$kecamatan = $stmt->fetch();

				$stmt2 = $this->koneksi()->prepare("SELECT nama FROM kelurahan WHERE id = $kel");
				$stmt2->execute();

				$kelurahan = $stmt2->fetch();

				return array($kecamatan[0], $kelurahan[0]);

			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}

		public function editLaporan($lap)
		{
			date_default_timezone_set("Asia/Jakarta");
			$diubah = date("Y-m-d H:i:s");
			$query = "UPDATE laporan SET judul=?, tgl_laporan=?, deskripsi=?, alamat=?, picture=?, id_kecamatan=?, id_kelurahan=?, diubah=? WHERE id = ?";
			
			try {

				$stmt = $this->koneksi()->prepare($query);
				$stmt->bindParam(1, $lap["judul"]);
				$stmt->bindParam(2, $lap["tgl_laporan"]);
				$stmt->bindParam(3, $lap["deskripsi"]);
				$stmt->bindParam(4, $lap["alamat"]);
				$stmt->bindParam(5, $lap["picture"]);
				$stmt->bindParam(6, $lap["id_kecamatan"]);
				$stmt->bindParam(7, $lap["id_kelurahan"]);
				$stmt->bindParam(8, $diubah);
				$stmt->bindParam(9, $lap["id"]);

				$hasil = $stmt->execute();

				return $hasil;
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}

		public function ubahStatus($ubah)
		{
			date_default_timezone_set("Asia/Jakarta");
			$diubah = date("Y-m-d H:i:s");
			$query = "UPDATE laporan SET status=?, id_ubahStatus=?, tgl_ubahStatus=?, diubah=? WHERE id = ?";
			try {
				$stmt = $this->koneksi()->prepare($query);
				$stmt->bindParam(1, $ubah["status"]);
				$stmt->bindParam(2, $ubah["id_ubahStatus"]);
				$stmt->bindParam(3, $diubah);
				$stmt->bindParam(4, $diubah);
				$stmt->bindParam(5, $ubah["id"]);
				$hasil = $stmt->execute();

				return $hasil;
				
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}

		

	}

 ?>