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
	//----Valores de los calibres----///
	if (empty($repeticion = $_POST['repeticion'])) {$repeticion = 0;} else {$calibre1 = $_POST['calibre1'];}
	if (empty($centros = $_POST['centros'])) {$centros = 0;} else {$centros = $_POST['centros'];}
	if (empty($rodilloz = $_POST['rodilloz'])) {$rodilloz = 0;} else {$rodilloz = $_POST['rodilloz'];}
	$observa = $_POST['observa'];

	// ---- Identificador del usuario de la session actual ? esto esta pendiente ----//
	$iduser = $_SESSION['idusuario'];

	$premontaje = '';


	if (isset($_POST['chkPremontaje'])) {
		$premontaje = implode(', ', $_POST['chkPremontaje']);
		echo "</br>";
	}

	
	$cadena = "INSERT INTO premontajes (num_orden,fecha,operario,estado,repeticion,centros,rodilloz,observa,premontaje,Idusuario) VALUES ($num_orden,'$fecha','$operario','$estado',$repeticion,$centros,$rodilloz,'$observa','$premontaje','$iduser');";
	
	echo $cadena;
	sqlsrv_query($connSCPBD, $cadena);
	sqlsrv_close( $connSCPBD );

   if ($estado == "pendiente") {
		header("Location:  premontajes.php");
	} else {
		header("Location:  apro_premontajes.php");
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