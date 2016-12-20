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
	$pedido = $_POST['num_orden'];	
	$operario = $_POST['operario'];
	$iduser = $_SESSION['idusuario'];
	$num_loteadca = $_POST['num_loteadca'];

	$laminacion = '';
	if (isset($_POST['chklaminacion'])) {
		$laminacion = implode(', ', $_POST['chklaminacion']);
		echo "</br>";
	}

	
	$cadena = "UPDATE laminacion_requisitos SET num_orden=$pedido,fecha='$fecha',num_loteadca='$num_loteadca' ,operario='$operario',estado='$estado',laminacion='$laminacion',Idusuario='$iduser' WHERE num_orden='$pedido';";

	$sql = sqlsrv_query($connSCPBD, $cadena);	
	sqlsrv_close( $connSCPBD );

	
	//echo $cadena;
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