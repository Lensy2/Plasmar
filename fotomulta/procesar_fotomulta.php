	<?php

//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
//Fin primera parte validacion de Pagina y Usuario
// --- Variables informacion de pedidop --- //
	$evidencia = $_POST['evidencia'];
	if (empty($pedido = $_POST['pedido'])) {$pedido = 0;} else {$pedido = $_POST['pedido'];}
	if (empty($num_rollo = $_POST['num_rollo'])) {$num_rollo = 0;} else {$num_rollo = $_POST['num_rollo'];}
	if (empty($referencia =$_POST['referencia'])) {$referencia = 0;} else {$referencia =$_POST['referencia'];}

if (empty($descripcion =$_POST['descripcion'])) {$descripcion = 'null';} else {$descripcion =$_POST['descripcion'];}
if (empty($referencia =$_POST['referencia'])) {$referencia = 0;} else {$referencia =$_POST['referencia'];}

if (empty($cliente = $_POST['nom_cliente'])) {$cliente = 'null';} else {$cliente = $_POST['nom_cliente'];}
	

	$h = "5";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
	$hm = $h * 60; 
	$ms = $hm * 60;
	$fecha = gmdate("d/m/Y g:i:s A", time()-($ms));

// --- Variables Inconformidad --- //
	$inconformidad = $_POST['tipo_inconf'];
	$tipo_proceso = $_POST['tipo_proceso'];

	if (empty($maquina = $_POST['maquina'])) {$maquina = 0;} else {$maquina = $_POST['maquina'];}
	if (empty($cantidad = $_POST['cantidad'])) {$cantidad = 0;} else {$cantidad = $_POST['cantidad'];}
	$detectada_por = $_POST['detectada_por'];


	$cargo = $_POST['cargo'];
	$causa =$_POST['causa'];
	$operario_res =$_POST['op_res'];

	if (empty($descripcion_inc =$_POST['descripcion_inc'])) {$descripcion_inc = 'null';} else {$descripcion_inc =$_POST['descripcion_inc'];}
	;
	$dispo_final = $_POST['dispo_final'];

	$iduser = $_SESSION['idusuario'];
	
	include '../includes/dbconfig.php';

	$cadena = "INSERT INTO foto_multas (num_orden,cliente,descripcion,referencia,fecha,tipo_inconf,tipo_proceso,num_rollo,maquina,cantidad,detectada_por,cargo,operario_res,causa,descripcion_inc,dispo_final,evidencia,Idusuario) VALUES ($pedido, '$cliente', '$descripcion', $referencia, '$fecha', '$inconformidad','$tipo_proceso', $num_rollo, $maquina, $cantidad, '$detectada_por', '$cargo', '$operario_res', '$causa', '$descripcion_inc','$dispo_final', '$evidencia', $iduser);";

	echo $cadena;
		$proceso = sqlsrv_query($connSCPBD, $cadena);
		if ($proceso) {
			echo "<h4>¡Guardado con Exito!</h4>";
		} else {
			echo "<h4>¡Error al guardar!</h4>";
		}

	
	sqlsrv_close( $connSCPBD );
	header("Location:  foto_multas.php");

}else{

  include '../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>

