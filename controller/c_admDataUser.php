<?php 
	include_once '../allModel.php';
	session_start();

	$us_model = new m_user();
	$users = $us_model->getAllUser();
	
	// $idUsers = $us_model->getIdUsersNot($_SESSION["user"]->id);
	// var_dump(intval($idUsers[2][0]));
	// exit();

	$_SESSION["dataUser"] = $users;
	header("Location: ../view/admin/admDataUser.php");

 ?>