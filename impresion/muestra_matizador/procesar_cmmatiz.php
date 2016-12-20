<?php
	  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
	include '../../includes/dbconfig.php';

	// --- Identifica el valor del submit y asigna el estado --- //

	if (isset($_POST['aprob'])) {
	 	$estado = "aprobado";
	}
	$h = "5";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
	$hm = $h * 60; 
	$ms = $hm * 60;
	$fecha = gmdate("d/m/Y g:i:s A", time()-($ms));

	$num_orden = $_POST['num_orden'];	
	// ---- Identificador del usuario de la session actual ? esto esta pendiente ----//
	$iduser = $_SESSION['idusuario'];
	$observa2 = $_POST['coment2'];
	$matizador = '';

	if (isset($_POST['chkMatizador'])) {
		$matizador = implode(', ', $_POST['chkMatizador']);
		echo "</br>";
	}

	
	$cadena = "INSERT INTO cm_matizador(num_orden,fecha,estado_mat,observa2,matizador,Idusuario) VALUES ($num_orden,'$fecha','$estado','$observa2','$matizador','$iduser');";
echo $cadena;
	$ver = sqlsrv_query($connSCPBD, $cadena);
	if ($ver) {
			echo "Melo";
		}	else{
			echo "Paia";
		}
	sqlsrv_close( $connSCPBD );

	header("location: controles_matizdor.php");

//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>