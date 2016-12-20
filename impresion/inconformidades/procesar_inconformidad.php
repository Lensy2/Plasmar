	<?php

//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
// --- Variables informacion de pedidop --- //
	$evidencia = $_POST['evidencia'];
	$pedido = $_POST['pedido']; //entra como parametro
	//entra como parametro
	if (empty($num_rollo = $_POST['num_rollo'])) {$num_rollo = 0;} else {$num_rollo = $_POST['num_rollo'];}
	$referencia =$_POST['referencia'];
	$descripcion =$_POST['descripcion'];
	$nit = $_POST['nit'];
	$cliente = $_POST['nom_cliente'];

	$h = "5";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
	$hm = $h * 60; 
	$ms = $hm * 60;
	$fecha = gmdate("d/m/Y g:i:s A", time()-($ms));

// --- Variables Inconformidad --- //
	$inconformidad = $_POST['tipo_inconf'];
	$maquina = $_POST['maquina'];
	if (empty($cantidad = $_POST['cantidad'])) {$cantidad = 0;} else {$cantidad = $_POST['cantidad'];}
	$detectada_por = $_POST['detectada_por'];
	$cargo = $_POST['cargo'];
	$causa =$_POST['causa'];
	$operario_res =$_POST['op_res'];	
	$descripcion_inc =$_POST['descripcion_inc'];
	$dispo_final = $_POST['dispo_final'];

	$iduser = $_SESSION['idusuario'];
	
	include '../../includes/dbconfig.php';

	$cadena = "INSERT INTO imp_inconformidades (num_orden,nit_cliente,cliente,descripcion,referencia,fecha,tipo_inconf,num_rollo,maquina,cantidad,detectada_por,cargo,operario_res,causa,descripcion_inc,dispo_final,evidencia,Idusuario) VALUES ($pedido,'$nit', '$cliente', '$descripcion', $referencia, '$fecha', '$inconformidad', $num_rollo,$maquina, $cantidad, '$detectada_por', '$cargo', '$operario_res', '$causa', '$descripcion_inc','$dispo_final', '$evidencia', $iduser);";

	echo $cadena;
		$proceso = sqlsrv_query($connSCPBD, $cadena);
		if ($proceso) {
			echo "<h4>¡Guardado con Exito!</h4>";
		} else {
			echo "<h4>¡Error al guardar!</h4>";
		}

	
	sqlsrv_close( $connSCPBD );
	header("Location:  inconformidades.php");
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>

