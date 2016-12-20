<?php
	  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
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
// ---- Identificador del usuario de la session actual ? esto esta pendiente ----//
	$iduser = $_SESSION['idusuario'];

	$requisito = '';	

	if (isset($_POST['chkRequisitos'])) {
		$requisito = implode(', ', $_POST['chkRequisitos']);
		echo "</br>";
	}
	var_dump($requisito);


	
	$cadena = "INSERT INTO impresion_requisitos (num_orden,fecha,operario,estado,requisitos,Idusuario) VALUES ('$num_orden','$fecha','$operario','$estado','$requisito','$iduser');";
	
	
	sqlsrv_query($connSCPBD, $cadena);	
	sqlsrv_close( $connSCPBD );

	if ($estado == "pendiente") {
		header("Location:  controles_requisitos_imp.php");
	} else {
		header("Location:  apro_controles_requisitos_imp.php");
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