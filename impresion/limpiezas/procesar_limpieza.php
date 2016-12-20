<?php
	//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario  	
	include '../../includes/dbconfig.php';

	$h = "5";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
	$hm = $h * 60; 
	$ms = $hm * 60;
	$fecha = gmdate("d/m/Y g:i:s A", time()-($ms));

	$num_orden = $_POST['num_orden'];
	$estado_fo = $_POST['estado_fo'];
	

	$op_res = $_POST['op_res'];	
	$observaciones = $_POST['observaciones'];
	$iduser = $_SESSION['idusuario'];

	$cadena = "INSERT INTO impresion_limpiezas (num_orden,fecha,estado_foto,operario_res,observaciones,Idusuario) VALUES ($num_orden,'$fecha','$estado_fo','$op_res','$observaciones','$iduser');";

	$insert = sqlsrv_query($connSCPBD, $cadena);
	if ($insert) {
		echo "<br><div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h4><i class='icon fa fa-check'></i> Mensaje!</h4>
                Información de limpieza guardada correctamente.
              </div>";
	}else{
		echo "<br><div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h4><i class='icon fa fa-ban'></i> Mensaje!</h4>
                Error al guardar Información de limpieza.
              </div>";
	}
	sqlsrv_close( $connSCPBD );

	//header('Location: nueva_limp.php');
	
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario

?>