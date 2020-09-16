<?php 

	include_once '../allModel.php';
	session_start();
	unset($_SESSION["detailUser"]);
	
	if (isset($_GET["id"])) {
		$id = $_GET["id"];

		$us_model = new m_user();
		$data = $us_model->getUser($id);
		if (isset($data)) {
			// echo $data->nama;
			$_SESSION["detailUser"] = $data;
			header("Location: ../view/admin/admDetailUser.php");
		}
		else{
			echo "Data tak ada";
		}
	}else{
		echo "Id tak ada";
	}
	

 ?>