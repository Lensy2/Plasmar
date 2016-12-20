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
	$observa = $_POST['coment4'];
	$anilox = $_POST['anilox'];
	$vel_maquina = $_POST['vel_maquina'];
	// ---- Identificador del usuario de la session actual ? esto esta pendiente ----//
	$iduser = $_SESSION['idusuario'];
	$supervisor = '';

	if (isset($_POST['chkRequisitos'])) {
		$supervisor = implode(', ', $_POST['chkRequisitos']);
		echo "</br>";
	}


	echo "</br>";
	//$cadena = "INSERT INTO libros SET Titulo='$titulo', Precio='$precio', Formatos='$formatos'";
	$cadena = "UPDATE cm_supervisor SET num_orden=$pedido,fecha='$fecha',estado_sup='$estado',anilox='$anilox', vel_maquina='$vel_maquina', observa4='$observa',supervisor='$supervisor',Idusuario='$iduser' WHERE num_orden='$pedido';";

	//echo $cadena;

	$sql = sqlsrv_query($connSCPBD, $cadena);
$color1 = $_POST['color1'];
		$color2 = $_POST['color2'];
		$color3 = $_POST['color3'];
		$color4 = $_POST['color4'];
		$color5 = $_POST['color5'];
		$color6 = $_POST['color6'];
		$color7 = $_POST['color7'];
		$color8 = $_POST['color8'];

		$lineat1 = $_POST['lineat1'];
		$lineat2 = $_POST['lineat2'];
		$lineat3 = $_POST['lineat3'];
		$lineat4 = $_POST['lineat4'];
		$lineat5 = $_POST['lineat5'];
		$lineat6 = $_POST['lineat6'];
		$lineat7 = $_POST['lineat7'];
		$lineat8 = $_POST['lineat8'];

	if ($sql) {
		
		$cadena2 = "UPDATE super_nuevoprem SET num_orden=$pedido,fecha_nm='$fecha',color1='$color1',color2='$color2',color3='$color3',color4='$color4',color5='$color5',color6='$color6',color7='$color7',color8='$color8',lineat1='$lineat1',lineat2='$lineat2',lineat3='$lineat3',lineat4='$lineat4',lineat5='$lineat5',lineat6='$lineat6',lineat7='$lineat7',lineat8='$lineat8',Idusuario='$iduser' WHERE num_orden='$pedido';";
		$sql2 = sqlsrv_query($connSCPBD, $cadena2);
		echo $cadena2;
		if ($sql2) {
		echo "Nitido";
		} else {
			echo "Paila";
		}
		
	}else{
		echo "Error de Insercion";
	}
	

	if ($estado == "pendiente") {
		header("Location:  controles_super.php");
	} else {
		header("Location:  apro_controles_super.php");
	}
sqlsrv_close( $connSCPBD );
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>