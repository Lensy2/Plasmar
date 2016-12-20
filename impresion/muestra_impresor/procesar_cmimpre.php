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
	// ---- Identificador del usuario de la session actual ? esto esta pendiente ----//
	$iduser = $_SESSION['idusuario'];
	$observa1 = $_POST['coment1'];
	$visco_bar = $_POST['visco_bar'];
	$impresor = '';


	if (isset($_POST['chkImpresor'])) {
		$impresor = implode(', ', $_POST['chkImpresor']);
		echo "</br>";
	}

	
	$cadena = "INSERT INTO cm_impresor(num_orden,fecha,estado_imp,observa1,visco_bar,impresor,Idusuario) VALUES ($num_orden,'$fecha','$estado','$observa1','$visco_bar','$impresor','$iduser');";
echo $cadena;
	$ver = sqlsrv_query($connSCPBD, $cadena);

	if ($ver) {
		echo "Melo";
	}else{echo "Paila";}
	sqlsrv_close( $connSCPBD );

	header("location: controles_impresor.php");

//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>