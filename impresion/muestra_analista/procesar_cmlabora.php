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
	$observa3 = $_POST['coment3'];
	$pie_imprenta = $_POST['pie_imprenta'];
	$cod_barras = $_POST['cod_barras'];
	$fecha_venlote = $_POST['fecha_venlote'];
	$proveedor = $_POST['proveedor'];
	$material = $_POST['material'];
	$micras = $_POST['micras'];
	$ancho = $_POST['ancho'];
	$tension = $_POST['tension'];
	$analista = '';

	if (isset($_POST['chkRequisitos'])) {
		$analista = implode(', ', $_POST['chkRequisitos']);
		echo "</br>";
	}

	
	$cadena = "INSERT INTO cm_analista(num_orden,fecha,estado_ana,pie_imprenta,cod_barras,fecha_venlote,observa3,proveedor,material,micras,ancho,tension,analista,Idusuario) VALUES ($num_orden,'$fecha','$estado',$pie_imprenta,'$cod_barras','$fecha_venlote','$observa3','$proveedor','$material','$micras','$ancho','$tension','$analista','$iduser');";
	echo $cadena;
	$ver = sqlsrv_query($connSCPBD, $cadena);

	if ($ver) {
		echo "Melisimo";
	}else{
		echo "Paila";
	}

	sqlsrv_close( $connSCPBD );

	if ($estado == "pendiente") {
		header("Location:  controles_analista.php");
	} else {
		header("Location:  apro_controles_analista.php");
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