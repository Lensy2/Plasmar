<?php
	
	include 'autenticacion.php';

	$user = $_POST['nombre'];
	$pass = $_POST['pass'];

	$userok = validarUsuario($user,$pass);
	$nombreuser = leerUsario($user);
	$idusuario = leerIduser($user);
	$menu = leerMenu($user);
	$acciones = leerAcciones($user);
	$paginas = leerPaginas($user);

		if ($userok == 1) {
			session_start();
			$_SESSION['usuario'] = $user;
			$_SESSION['nombreuser'] = $nombreuser;
			$_SESSION['idusuario'] = $idusuario;
			$_SESSION['menu'] = $menu;
			$_SESSION['acciones'] = $acciones;
			$_SESSION['paginas'] = $paginas;
			echo $paginas[0];
			
		}else{
			echo "incorrecto";
		}

?>