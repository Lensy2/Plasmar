	<?php
	  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
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
	
	$pedido = $_POST['num_orden']; //entra como parametro
	$proveedor = $_POST['proveedor'];
	$pie_imprenta = $_POST['pie_imprenta'];
	$cod_barras = $_POST['cod_barras'];
	$fecha_venlote = $_POST['fecha_venlote'];
	$material = $_POST['material'];
	$micras = $_POST['micras'];
	$ancho = $_POST['ancho'];
	$tension = $_POST['tension'];
	$observa = $_POST['observa'];	
	// ---- Identificador del usuario de la session actual ? esto esta pendiente ----//
	$iduser = $_SESSION['idusuario'];
	$analista = '';

	if (isset($_POST['chkRequisitos'])) {
		$analista = implode(', ', $_POST['chkRequisitos']);
		echo "</br>";
	}

	echo "</br>";
	//$cadena = "INSERT INTO libros SET Titulo='$titulo', Precio='$precio', Formatos='$formatos'";
	$cadena = "UPDATE cm_analista SET num_orden=$pedido,fecha='$fecha',estado_ana='$estado',pie_imprenta=$pie_imprenta,cod_barras='$cod_barras',fecha_venlote='$fecha_venlote',observa3='$observa',proveedor='$proveedor',material='$material',micras='$micras',ancho='$ancho',tension='$tension',analista='$analista',Idusuario='$iduser' WHERE num_orden='$pedido';";
		echo $cadena;
	
	$ver = sqlsrv_query($connSCPBD, $cadena);
	if ($ver) {
		echo "Otimo";
	}else{echo "Repaila";}
	sqlsrv_close( $connSCPBD );

	if ($estado == "pendiente") {
		header("Location:  controles_analista.php");
	} else {
		header("Location:  apro_controles_analista.php");
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