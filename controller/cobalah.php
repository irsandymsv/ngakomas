<?php 

	include_once '../model/user.php';
	session_start();
	// var_dump($_SESSION["user"]);
	$us = $_SESSION["user"];

	// echo $us["nama"] ."<br>";
	// echo $us["nik"] ."<br>";
	// echo $us["noHP"] ."<br>";
	// echo $us["gender"] ."<br>";

	echo $us->getNama();
	// session_unset();
 ?>