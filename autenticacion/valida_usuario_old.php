<?php

$user = $_GET['nombre'];
$pass = $_GET['pass'];

include 'dbconfig.php';
include 'autenticacion.php';


	$usuariook = 'p';
	$passok = '1';



$melo = "lista1,lista2,lista3,lista4,lista5,lista6,lista7";
$verlo = explode(',', $melo);

	if ($user = 'p'){
		$verMenu = 1;
		$verAcc = 1;
		$verPaginas = 1;
	}

	switch ($verMenu) {
		case '1':
			$menu = $verlo;
			break;

		case '2':
			$menu = array('lista1','lista2');
			break;

	}
	switch ($verAcc) {
		case '1':
			$acciones = array('crear','editar','eliminar');
			break;

		case '2':
			$acciones = array('crear','editar');	
			break;

	}
		switch ($verPaginas) {
		case '1':
			$paginas = array('extrusion','impresion');
		break;

		case '2':
			$paginas = array('impresion');	
		break;
	}

	if ($user == $usuariook && $pass == $passok) {
		session_start();
		$_SESSION['usuario'] = $_GET['nombre'];
		$_SESSION['menu'] = $menu;
		$_SESSION['acciones'] = $acciones;
		$_SESSION['paginas'] = $paginas;
		echo $paginas[0];
		
	}else{
		echo "incorrecto";
	}

	/*$sql = "SELECT u.usuario, u.contrasena, u.idcliente, c.nombre cliente " .
    " FROM usuario u, cliente c ".
    " WHERE c.id=u.idcliente and usuario='" . $txtusuario . "'";
  $sqlResultado = mysql_query($sql);
  $row = mysql_fetch_array($sqlResultado);
  $contrasena = $row["contrasena"];
  $idcliente = $row["idcliente"];				
				
   if ($contrasena == md5($txtcontrasena))
   	{				   
     //establecermos las variables de sesión
     $_SESSION["nombre_usuario"] = $row["usuario"];
	  $_SESSION["nombre_cliente"] = $row["cliente"];
    }*/
?>