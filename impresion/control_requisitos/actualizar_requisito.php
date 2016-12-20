<?php
	  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

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

	// --- Variables tabla control_requisitos --- //
	$idrequimp = $_POST['Idrequisitoimp'];
	$pedido = $_POST['num_orden']; //entra como parametro
	$op_res = $_POST['operario'];
	// ---- Identificador del usuario de la session actual ? esto esta pendiente ----//
	$iduser = $_SESSION['idusuario'];

	$requisitos = '';

	if (isset($_POST['chkRequisitos'])) {
		$requisitos = implode(', ', $_POST['chkRequisitos']);
	}

	include '../../includes/dbconfig.php';
	include '../../model/extruder.php';

	echo "</br>";
	//$cadena = "INSERT INTO libros SET Titulo='$titulo', Precio='$precio', Formatos='$formatos'";
	$cadena = "UPDATE impresion_requisitos SET num_orden=$pedido,fecha='$fecha',operario='$op_res',estado='$estado',requisitos='$requisitos',Idusuario='$iduser' WHERE Idrequisitoimp='$idrequimp';";
	echo $cadena;	
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