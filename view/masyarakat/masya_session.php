<?php 

  session_start();
  if (!isset($_SESSION["user"])) {
    header("Location: ../login.php");
  }
  else{
  	if ($_SESSION["user"]->id_role != 2) {
  		header("Location: ../login.php");
  	}
  	else{
  		$user = $_SESSION["user"];
  	}
  }

?>