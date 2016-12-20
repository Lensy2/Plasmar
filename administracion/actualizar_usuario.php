	<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
	 if (in_array('config', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
	$iduser = $_POST['iduser'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido']; //entra como parametro
	$cedula = $_POST['cedula'];//entra como parametro
	$usuario =$_POST['usuario'];
	$contrasena =$_POST['contrasena'];
	$imagen = 'null';
	$ver_acciones = 'null';

	$h = "5";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
	$hm = $h * 60; 
	$ms = $hm * 60;
	$fecha_reg = gmdate("d/m/Y g:i:s A", time()-($ms));

	$ver_paginas = '';
	if (isset($_POST['ver_paginas'])) {
		$ver_paginas = implode(',', $_POST['ver_paginas']);
	}

	$ver_menus = '';
	if (isset($_POST['ver_menus'])) {
		$ver_menus = implode(',', $_POST['ver_menus']);
	}

	include '../includes/dbconfig.php';

	$cadena = "UPDATE usuarios SET nombre='$nombre',apellido='$apellido',cedula=$cedula,imagen='$imagen',usuario='$usuario',contrasena='$contrasena',ver_menus='$ver_menus', ver_acciones='$ver_acciones', ver_paginas='$ver_paginas', fecha_reg='$fecha_reg', estado_us=1 WHERE Idusuario=$iduser;";

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

