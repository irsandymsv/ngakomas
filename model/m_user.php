<?php 

	/**
	 * 
	 */
	include_once '../allModel.php';

	class m_user extends connection
	{
		// $m1 = new masyarakat();

		function __construct()
		{

		}

		public function buatUser($user)
		{
			try {
				
				
				$stmt = $this->koneksi()->prepare("INSERT INTO user(nama, email, password, nik, tgl_lahir, gender, noHP, alamat, id_role, dibuat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

				$stmt->bindParam(1, $user["nama"]);
				$stmt->bindParam(2, $user["email"]);
				$stmt->bindParam(3, $user["password"]);	
				$stmt->bindParam(4, $user["nik"]);	
				$stmt->bindParam(5, $user["tgl_lahir"]);	
				$stmt->bindParam(6, $user["gender"]);	
				$stmt->bindParam(7, $user["noHP"]);	
				$stmt->bindParam(8, $user["alamat"]);	
				$stmt->bindParam(9, $user["id_role"]);
				$stmt->bindParam(10, $user["dibuat"]);

				$masuk = $stmt->execute();

				$getId = $this->koneksi()->prepare("SELECT MAX(id) FROM user");
				$getId->execute();
				$id = $getId->fetch();
				// $id = $this->koneksi()->lastInsertId();

				$hasil = array($masuk, $id[0]);
				return $hasil;
				
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}

			$konek = $this->koneksi();
			$konek = null;

		}

		public function getUser($id)
		{
			try {
				$stmt = $this->koneksi()->prepare("SELECT * FROM user WHERE id=?");
				$stmt->bindParam(1, $id);
				$stmt->execute();

				$stmt->setFetchMode(PDO::FETCH_CLASS, 'user');
				$res = $stmt->fetch();
				return $res;

				// if ($res["id_role"] == 1) {
				// 	$adm = new admin($res["id"], $res["nama"], $res["nik"], $res["tgl_lahir"], $res["noHP"], $res["email"], $res["password"], $res["gender"], $res["alamat"], $res["id_role"]);

				// 	return $adm;
				// }
				// elseif ($res["id_role"] == 2){
				// 	$masya = new masyarakat($res["id"], $res["nama"], $res["nik"], $res["tgl_lahir"], $res["noHP"], $res["email"], $res["password"], $res["gender"], $res["alamat"], $res["picture"], $res["id_role"], $res["dibuat"], $res["diubah"]);

				// 	return $masya;
				// }
				
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}

		public function getAllUser()
		{
			try {
				$stmt = $this->koneksi()->prepare("SELECT * FROM user");
				$stmt->execute();

				$stmt->setFetchMode(PDO::FETCH_CLASS, 'user');
				$res = $stmt->fetchAll();
				
				return $res;

			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}

		public function login($log)
		{
			try {
				$stmt = $this->koneksi()->prepare("SELECT * FROM `user` WHERE email = ? AND password = ?");
				$stmt->bindParam(1, $log[0]);
				$stmt->bindParam(2, $log[1]);
				$run = $stmt->execute();

				$stmt->setFetchMode(PDO::FETCH_CLASS, 'user');
				$res = $stmt->fetch();

				// $user = "";
				// if ($res["id_role"] == 1) {
				// 	$user = new admin($res["id"], $res["nama"], $res["nik"], $res["tgl_lahir"], $res["noHP"], $res["email"], $res["password"], $res["gender"], $res["alamat"], $res["id_role"]);

				// }elseif($res["id_role"] == 2){
				// 	$user = new masyarakat($res["id"], $res["nama"], $res["nik"], $res["tgl_lahir"], $res["noHP"], $res["email"], $res["password"], $res["gender"], $res["alamat"], $res["picture"], $res["id_role"], $res["dibuat"], $res["diubah"]);
				// }

				return array($run, $res);

			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}			
		}

		public function editProfil($user)
		{
			try {
				date_default_timezone_set("Asia/Jakarta");
				$diubah = date("Y-m-d H:i:s");

				if ($user["picture"] != "") {
					$query = "UPDATE user SET nama=?, email=?, nik=?, tgl_lahir=?, gender=?, noHP=?, alamat=?, picture=?, diubah=? WHERE id = ?";
					$stmt = $this->koneksi()->prepare($query);

					$stmt->bindParam(1, $user["nama"]);
					$stmt->bindParam(2, $user["email"]);
					$stmt->bindParam(3, $user["nik"]);
					$stmt->bindParam(4, $user["tgl_lahir"]);
					$stmt->bindParam(5, $user["gender"]);
					$stmt->bindParam(6, $user["noHP"]);
					$stmt->bindParam(7, $user["alamat"]);
					$stmt->bindParam(8, $user["picture"]);
					$stmt->bindParam(9, $diubah);
					$stmt->bindParam(10, $user["id"]);

					$run = $stmt->execute();
					return $run;
				} 
				else{
					$query = "UPDATE user SET nama=?, email=?, nik=?, tgl_lahir=?, gender=?, noHP=?, alamat=?, diubah=? WHERE id = ?";
					$stmt = $this->koneksi()->prepare($query);

					$stmt->bindParam(1, $user["nama"]);
					$stmt->bindParam(2, $user["email"]);
					$stmt->bindParam(3, $user["nik"]);
					$stmt->bindParam(4, $user["tgl_lahir"]);
					$stmt->bindParam(5, $user["gender"]);
					$stmt->bindParam(6, $user["noHP"]);
					$stmt->bindParam(7, $user["alamat"]);
					$stmt->bindParam(8, $diubah);
					$stmt->bindParam(9, $user["id"]);

					$run = $stmt->execute();
					return $run;

				}
				
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}

		public function editPass($newPass)
		{
			try {
				date_default_timezone_set("Asia/Jakarta");
				$diubah = date("Y-m-d H:i:s");

				$stmt = $this->koneksi()->prepare("UPDATE user SET password = ?, diubah = ? WHERE id = ?");
				$stmt->bindParam(1, $newPass["password"]);
				$stmt->bindParam(2, $diubah);
				$stmt->bindParam(3, $newPass["id"]);

				$run = $stmt->execute();
				return $run;

			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
					
			}
		}

		public function getIdUsersNot($id_userNot)
		{
			try {
				$stmt = $this->koneksi()->prepare('SELECT id FROM user WHERE NOT id = ?');
				$stmt->bindParam(1, $id_userNot);

				$stmt->execute();
				$res = $stmt->fetchAll(PDO::FETCH_NUM);

				return $res;
				
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}

		public function getIdAdmin()
		{
			try {
				$stmt = $this->koneksi()->prepare('SELECT id FROM user WHERE id_role = 1');
				$stmt->execute();

				$res = $stmt->fetch(PDO::FETCH_NUM);
				return $res;

			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}

		}

		public function cekEmail($emailBaru)
		{
			try {
				$stmt = $this->koneksi()->prepare('SELECT COUNT(*) FROM user WHERE email = ?');
				$stmt->bindParam(1, $emailBaru);
				$stmt->execute();

				return $stmt->fetchColumn();
				
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();	
			}
		}

		public function cekNIK($nik)
		{
			try {
				$stmt = $this->koneksi()->prepare('SELECT COUNT(*) FROM user WHERE nik = ?');
				$stmt->bindParam(1, $nik);
				$stmt->execute();

				return $stmt->fetchColumn();
				
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();	
			}
		}

	}

	?>