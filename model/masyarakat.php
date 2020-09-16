<?php 

	/**
	 * 
	 */
	include_once 'user.php';
	class masyarakat extends user
	{
		public $picture;
		
		function __construct($id, $nama, $nik, $tgl_lahir, $noHP, $email, $password, $gender, $alamat, $picture, $id_role, $dibuat, $diubah)
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
			$this->picture = $picture;
			$this->id_role = $id_role;
			$this->dibuat = $dibuat;
			$this->diubah = $diubah;

		}

	}

 ?>