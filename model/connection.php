<?php 

	/**
	 * 
	 */
	class connection
	{
		public $server = "localhost";
		public $username = "root";
		public $password = "";
		public $db = "ngakomas";
		public $con;

		function __construct()
		{
			
		}

		public function koneksi()
		{
			try {
				// $con = mysqli_connect($this->server, $this->username, $this->password, $this->db);
				$this->con = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
				$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->con->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);
				return $this->con;
			} catch (PDOException $e) {
				echo "Connection failed: " . $e->getMessage();
			}
			
		}

	}

	?>