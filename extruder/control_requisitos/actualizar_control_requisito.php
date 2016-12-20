<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

	// --- Identifica el valor del submit y asigna el estado --- //
	if (isset($_POST['guarda'])) {
		$estado = "pendiente";
	}
	elseif (isset($_POST['aprob'])) {
	 	$estado = "aprobado";
	}

	// --- Variables tabla control_requisitos --- //
	$idcontrol_r = $_POST['idcontrol_r'];
	$pedido = $_POST['num_orden']; //entra como parametro
	$tipo_ext = $_POST['tipo_ext'];//entra como parametro
	$num_mezcla = $_POST['num_mezcla'];//entra como parametro

	$h = "5";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
	$hm = $h * 60; 
	$ms = $hm * 60;
	$fecha = gmdate("d/m/Y g:i:s A", time()-($ms));
	
	$op_res = $_POST['op_res'];
	$iduser = $_SESSION['idusuario'];
	$requisitos = '';

	if (isset($_POST['chkRequisito'])) {
		$requisitos = implode(', ', $_POST['chkRequisito']);
	}

	include '../../includes/dbconfig.php';
	include '../../model/extruder.php';

	echo "</br>";
	//$cadena = "INSERT INTO libros SET Titulo='$titulo', Precio='$precio', Formatos='$formatos'";
	$cadena = "UPDATE control_requisitos SET num_orden=$pedido,tipo_ext='$tipo_ext',operario_res='$op_res',requisitos='$requisitos',fecha='$fecha',estado='$estado',num_mezcla='$num_mezcla',Idusuario='$iduser' WHERE Idcontrol_requisito='$idcontrol_r';";
	echo $cadena;	
	sqlsrv_query($connSCPBD, $cadena);	
	sqlsrv_close( $connSCPBD );

	if ($estado == "pendiente") {
		header("Location:  controles_requisitos.php");
	} else {
		header("Location:  apro_controles_requisitos.php");
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