	<?php

//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
// --- Variables tabla control_calidad --- //
	$evidencia = $_POST['evidencia'];
	$maquina = $_POST['maquina'];
	$pedido = $_POST['pedido']; //entra como parametro
	$tipo_ext = $_POST['tipo_ext'];//entra como parametro
	$num_mezcla = $_POST['num_mezcla'];//entra como parametro
	$num_rollo = $_POST['num_rollo'];//entra como parametro
	$referencia =$_POST['referencia'];
	$nit = $_POST['nit'];
	$cliente = $_POST['nom_cliente'];
	$ultimoid = $_POST['ulid'];

	$h = "5";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
	$hm = $h * 60; 
	$ms = $hm * 60;
	$fecha = gmdate("d/m/Y g:i:s A", time()-($ms));

// --- Variables Inconformidad --- //
	$inconformidad = $_POST['tipo_inconf'];
	if (empty($cantidad = $_POST['cantidad'])) {$cantidad = 0;} else {$cantidad = $_POST['cantidad'];}
	$detectada_por = $_POST['detectada_por'];
	$cargo = $_POST['cargo'];
	$causa =$_POST['causa'];
	$operario_res =$_POST['op_res'];	
	$descripcion =$_POST['descripcion'];
	$dispo_final = $_POST['dispo_final'];

	$iduser = $_SESSION['idusuario'];
	//$ultimoid = 1;
	
	include '../../includes/dbconfig.php';

	$cadena = "INSERT INTO ext_inconformidades (num_orden,tipo_ext,num_mezcla,num_rollo,referencia,nit_cliente,cliente,fecha,tipo_inconf,maquina,cantidad,detectada_por,cargo,causa,operario_res,descripcion,dispo_final,evidencia,Idusuario,Idcontrol_calidad) VALUES ($pedido,'$tipo_ext',$num_mezcla,$num_rollo,$referencia,$nit,'$cliente','$fecha','$inconformidad',$maquina,$cantidad,'$detectada_por','$cargo','$causa','$operario_res','$descripcion','$dispo_final','$evidencia',$iduser,$ultimoid);";

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

