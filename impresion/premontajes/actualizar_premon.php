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


	// --- Variables tabla control_requisitos --- //
	
	$pedido = $_POST['num_orden']; //entra como parametro	
	$idprem = $_POST['idprem'];
	if (empty($repeticion = $_POST['repeticion'])) {$repeticion = 0;} else {$calibre1 = $_POST['calibre1'];}
	if (empty($centros = $_POST['centros'])) {$centros = 0;} else {$centros = $_POST['centros'];}
	if (empty($rodilloz = $_POST['rodilloz'])) {$rodilloz = 0;} else {$rodilloz = $_POST['rodilloz'];}
	$observa = $_POST['observa'];

	$h = "5";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
	$hm = $h * 60; 
	$ms = $hm * 60;
	$fecha = gmdate("d/m/Y g:i:s A", time()-($ms));

	
	$op_res = $_POST['operario'];
	// ---- Identificador del usuario de la session actual ? esto esta pendiente ----//
	$iduser = $_SESSION['idusuario'];
	$premontaje = '';

	if (isset($_POST['chkPremontaje'])) {
		$premontaje = implode(', ', $_POST['chkPremontaje']);
	}

	include '../../includes/dbconfig.php';
	include '../../model/extruder.php';

	echo "</br>";
	//$cadena = "INSERT INTO libros SET Titulo='$titulo', Precio='$precio', Formatos='$formatos'";
	$cadena = "UPDATE premontajes SET num_orden=$pedido,fecha='$fecha',operario='$op_res',estado='$estado',repeticion='$repeticion',centros=$centros,rodilloz=$rodilloz,observa='$observa',premontaje='$premontaje',Idusuario='$iduser' WHERE num_orden=$pedido AND Idpremontaje = $idprem";
	
	echo $cadena;

	$sql = sqlsrv_query($connSCPBD, $cadena);	
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