<?php
	  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('laminacion', $_SESSION['paginas'])) {
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
	$iduser = $_SESSION['idusuario'];
	$num_loteadca = $_POST['num_loteadca'];

	$laminacion = '';
	if (isset($_POST['chklaminacion'])) {
		$laminacion = implode(', ', $_POST['chklaminacion']);
		echo "</br>";
	}

	
	$cadena = "INSERT INTO laminacion_requisitos(num_orden,fecha,num_loteadca,operario,estado,laminacion,Idusuario) VALUES ($num_orden,'$fecha','$num_loteadca','$operario','$estado','$laminacion','$iduser');";
	echo $cadena;
	$sql = sqlsrv_query($connSCPBD, $cadena);

	if ($sql) {
		echo "Melo";
	} else {
		echo "Paila";
	}
	
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