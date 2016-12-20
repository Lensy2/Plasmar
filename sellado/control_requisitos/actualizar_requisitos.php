<?php
	
	//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('sellado', $_SESSION['paginas'])) {
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

	$pedido = $_POST['num_orden'];	
	$operario = $_POST['operario'];
	$fechase = $_POST['fechrefi'];
	$iduser = $_SESSION['idusuario'];
	$sellado = '';
	if (isset($_POST['chksellado'])) {
		$sellado = implode(', ', $_POST['chksellado']);
		echo "</br>";
	}

	$cadena = "UPDATE sellado_requisitos SET num_orden=$pedido,fecha='$fecha',operario='$operario',estado='$estado',fechase='$fechase',sellado='$sellado', Idusuario='$iduser' WHERE num_orden='$pedido';";


	$sql = sqlsrv_query($connSCPBD, $cadena);	
	sqlsrv_close( $connSCPBD );

	

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