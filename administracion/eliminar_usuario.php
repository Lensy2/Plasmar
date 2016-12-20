	<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
	 if (in_array('config', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
	$iduser = $_GET['id'];

	include '../includes/dbconfig.php';

	$cadena = "UPDATE usuarios SET estado_us = 0 WHERE Idusuario=$iduser;";
	echo $cadena;
		$proceso = sqlsrv_query($connSCPBD, $cadena);
		if ($proceso) {
			echo "<h4>¡Guardado con Exito!</h4>";
		} else {
			echo "<h4>¡Error al guardar!</h4>";
		}

	
	sqlsrv_close( $connSCPBD );
	header("Location:  usuarios.php");
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../autenticacion/restrin.php';
  } 
}else{

  include '../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>

