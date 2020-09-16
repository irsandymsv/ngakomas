<?php 
	
	/**
	 * 
	 */
	include_once 'user.php';
	class admin extends user
	{
		
		public function __construct($id, $nama, $nik, $tgl_lahir, $noHP, $email, $password, $gender, $alamat, $id_role)
		{
			$this->id = $id;
			$this->nama = $nama;
			$this->nik = $nik;
			$this->tgl_lahir = $tgl_lahir;
			$this->noHP = $noHP;
			$this->email = $email;
			$this->password = $password;
			$this->gender = $gender;
			$this->alamat = $alamat;
			$this->id_role = $id_role;
		}

	}
	
 ?>