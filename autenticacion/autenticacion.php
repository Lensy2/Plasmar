<?php 
	
	function validarUsuario($usuario,$pass)
	{
		include '../includes/dbconfig.php';
		$consultaUser = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$pass' AND estado_us = 1";
		$resultUser = sqlsrv_query($connSCPBD,$consultaUser);
		$fila = sqlsrv_fetch_object($resultUser);

		if ($fila){
			$flag = 1;
		}else{
			$flag = 0;
		}
		return $flag;
	}

	function leerMenu($usuario)
	{
		include '../includes/dbconfig.php';
		$consultaMenu = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
		$resultUser = sqlsrv_query($connSCPBD,$consultaMenu);
		$fila = sqlsrv_fetch_array($resultUser);

		$menulisto = explode(',', $fila['ver_menus']);		
		return $menulisto;
	}

	function leerAcciones($usuario)
	{
		include '../includes/dbconfig.php';
		$consultaAcciones = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
		$resultUser = sqlsrv_query($connSCPBD,$consultaAcciones);
		$fila = sqlsrv_fetch_array($resultUser);

		$accioneslisto = explode(',', $fila['ver_acciones']);
		return $accioneslisto;
	}

	function leerPaginas($usuario)
	{
		include '../includes/dbconfig.php';
		$consultaPaginas = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
		$resultUser = sqlsrv_query($connSCPBD,$consultaPaginas);
		$fila = sqlsrv_fetch_array($resultUser);

		$paginaslisto = explode(',', $fila['ver_paginas']);
		return $paginaslisto;
	}
	function leerUsario($usuario)
	{
		include '../includes/dbconfig.php';
		$consultaNombre = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
		$resultUser = sqlsrv_query($connSCPBD,$consultaNombre);
		$fila = sqlsrv_fetch_array($resultUser);

		$nombrelisto = $fila['nombre']." ".$fila['apellido'];
		return $nombrelisto;
	}
	function leerIduser($usuario)
	{
		include '../includes/dbconfig.php';
		$consultaNombre = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
		$resultUser = sqlsrv_query($connSCPBD,$consultaNombre);
		$fila = sqlsrv_fetch_array($resultUser);

		$iduserlisto = $fila['Idusuario'];
		return $iduserlisto;
	}
?>