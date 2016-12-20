<?php
	//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('refilado', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

	include '../../includes/dbconfig.php';
	// --- Identifica el valor del submit y asigna el estado --- //
	if (isset($_POST['guarda'])) {
		$estado = "pendiente";
	}
	elseif (isset($_POST['aprob'])) {
	 	$estado = "aprobado";
	}

	$h = "5";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
	$hm = $h * 60; 
	$ms = $hm * 60;
	$fecha = gmdate("d/m/Y g:i:s A", time()-($ms));

	$num_orden = $_POST['num_orden'];	
	$operario = $_POST['operario'];
	$fechare = date('d/m/Y', strtotime($_POST['fechrefi']));
	
	$kilos = $_POST['krefi'];
	$tcurado = $_POST['tcurado'];
	$gramosm = $_POST['gramosm'];
	$iduser = $_SESSION['idusuario'];

	$refilado = '';
	if (isset($_POST['chkrefilado'])) {
		$refilado = implode(', ', $_POST['chkrefilado']);
		echo "</br>";
	}

	
	$cadena = "INSERT INTO refilado_requisitos(num_orden,fecha,operario,estado,fechare,kilos,tcurado,gramosm, refilado,Idusuario) VALUES ($num_orden,'$fecha','$operario','$estado','$fechare','$kilos','$tcurado', '$gramosm','$refilado','$iduser');";

	$sql = sqlsrv_query($connSCPBD, $cadena);	
	$ver = sqlsrv_close( $connSCPBD );	
	echo $cadena;
	
	if ($estado == "pendiente") {
		header("Location:  requisitos.php");
	} else {
		header("Location:  apro_requisitos.php");
	}
	
	//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
	
?>