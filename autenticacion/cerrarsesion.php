<?php
  session_start();
  unset($_SESSION["usuario"]);
  $_SESSION['nombreuser'];
  $_SESSION['menu'];
	$_SESSION['acciones'];
	$_SESSION['paginas'];
  session_destroy();
  header("Location: ../index.php");
?>