<?php
	
	//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('refilado', $_SESSION['paginas'])) {
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
	$idrefiladoreq=$_POST['Idrefilado_requisitos'];
	$operario = $_POST['operario'];
	$fechare = date('d/m/Y', strtotime($_POST['fechrefi']));
	//$fechare = $_POST['fechrefi'];
	$kilos = $_POST['krefi'];	
	$tcurado = $_POST['tcurado'];
	$gramosm = $_POST['gramosm'];
	$iduser = $_SESSION['idusuario'];
	$refilado = '';
	if (isset($_POST['chkrefilado'])) {
		$refilado = implode(', ', $_POST['chkrefilado']);
		echo "</br>";
	}

	
	$cadena = "UPDATE refilado_requisitos SET num_orden=$pedido,fecha='$fecha',operario='$operario',estado='$estado',fechare='$fechare',kilos='$kilos',tcurado='$tcurado', gramosm='$gramosm', refilado='$refilado',Idusuario='$iduser' WHERE num_orden='$pedido' and Idrefilado_requisitos=$idrefiladoreq;";

	$sql = sqlsrv_query($connSCPBD, $cadena);	
	sqlsrv_close( $connSCPBD );

	
	echo $cadena;
	if ($sql) {
		echo "Nitido";
	}else{echo "paila";}

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