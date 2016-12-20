<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

	if (isset($_POST['guarda'])) {
		$estado = "pendiente";
	}
	elseif (isset($_POST['aprob'])) {
	 	$estado = "aprobado";
	}

	// --- Variables tabla control_mezclas --- //
	$idcontrol_m = $_POST['idcontrol_m'];
	$num_mezcla = $_POST['num_mezcla'];

	// --- Variables tabla tornillos --- //
	$idtor1 = $_POST['idtor1'];
	$idtor2 = $_POST['idtor2'];
	$idtor3 = $_POST['idtor3'];
	$idtor4 = $_POST['idtor4'];
	$idtor5 = $_POST['idtor5'];
	$idtor6 = $_POST['idtor6'];
	$idtor7 = $_POST['idtor7'];

	$pedido = $_POST['num_orden']; //entra como parametro
	$tipo_ext = $_POST['tipo_ext'];//entra como parametro

	$h = "5";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
	$hm = $h * 60; 
	$ms = $hm * 60;
	$fecha = gmdate("d/m/Y g:i:s A", time()-($ms));
	//$estado = $_POST['estado'];
	$op_res = $_POST['op_res'];

	// --- Variabales tabla tornillos - tornillo 1 --- //
	$tor1 = $_POST['tor1'];
	$componente1 = implode(',', $_POST['comp_A']);
	$kilos1 = implode(',', $_POST['kg_A']);
	$lote1 = implode(',', $_POST['lote_A']);

	// --- Variabales tabla tornillos - tornillo 2 --- //
	$tor2 = $_POST['tor2'];
	$componente2 = implode(',', $_POST['comp_B']);
	$kilos2 = implode(',', $_POST['kg_B']);
	$lote2 = implode(',', $_POST['lote_B']);

	// --- Variabales tabla tornillos - tornillo 3 --- //
	$tor3 = $_POST['tor3'];
	$componente3 = implode(',', $_POST['comp_C']);
	$kilos3 = implode(',', $_POST['kg_C']);
	$lote3 = implode(',', $_POST['lote_C']);

	// --- Variabales tabla tornillos - tornillo 4 --- //
	$tor4 = $_POST['tor4'];
	$componente4 = implode(',', $_POST['comp_D']);
	$kilos4 = implode(',', $_POST['kg_D']);
	$lote4 = implode(',', $_POST['lote_D']);

	// --- Variabales tabla tornillos - tornillo 5 --- //
	$tor5 = $_POST['tor5'];
	$componente5 = implode(',', $_POST['comp_E']);
	$kilos5 = implode(',', $_POST['kg_E']);
	$lote5 = implode(',', $_POST['lote_E']);

	// --- Variabales tabla tornillos - tornillo 6 --- //
	$tor6 = $_POST['tor6'];
	$componente6 = implode(',', $_POST['comp_F']);
	$kilos6 = implode(',', $_POST['kg_F']);
	$lote6 = implode(',', $_POST['lote_F']);

	// --- Variabales tabla tornillos - tornillo 7 --- //
	$tor7 = $_POST['tor7'];
	$componente7 = implode(',', $_POST['comp_G']);
	$kilos7 = implode(',', $_POST['kg_G']);
	$lote7 = implode(',', $_POST['lote_G']);

	$iduser = $_SESSION['idusuario'];

	if (isset($pedido, $tipo_ext, $fecha, $estado, $op_res)){

	include '../../includes/dbconfig.php';
	include '../../model/extruder.php';

	$insertValControlM = "UPDATE control_mezclas SET num_orden=$pedido,tipo_ext='$tipo_ext',fecha='$fecha',estado='$estado',operario_res='$op_res',Idusuario='$iduser' WHERE Idcontrol_mezcla='$idcontrol_m' AND num_mezcla='$num_mezcla';";


	echo "<br>";
	echo $insertValControlM;

	$insertControlM = sqlsrv_query($connSCPBD, $insertValControlM);

	if ($insertControlM) {
		echo "<br>";
		echo "Dato almacenados en control_mezclas</br>";
		//echo "The last inserted row ID is".$ultimoid."<br>";
		echo "<br>";

		$insertValTor1 = "UPDATE tornillos SET num_tornillo=$tor1,componente='$componente1',kilos='$kilos1',lote='$lote1' WHERE Idcontrol_mezcla='$idcontrol_m' AND Idtornillo=$idtor1;";

		$insertValTor2 = "UPDATE tornillos SET num_tornillo=$tor2,componente='$componente2',kilos='$kilos2',lote='$lote2' WHERE Idcontrol_mezcla='$idcontrol_m' AND Idtornillo=$idtor2;";

		$insertValTor3 = "UPDATE tornillos SET num_tornillo=$tor3,componente='$componente3',kilos='$kilos3',lote='$lote3' WHERE Idcontrol_mezcla='$idcontrol_m' AND Idtornillo=$idtor3;";

		$insertValTor4 = "UPDATE tornillos SET num_tornillo=$tor4,componente='$componente4',kilos='$kilos4',lote='$lote4' WHERE Idcontrol_mezcla='$idcontrol_m' AND Idtornillo=$idtor4;";

		$insertValTor5 = "UPDATE tornillos SET num_tornillo=$tor5,componente='$componente5',kilos='$kilos5',lote='$lote5' WHERE Idcontrol_mezcla='$idcontrol_m' AND Idtornillo=$idtor5;";

		$insertValTor6 = "UPDATE tornillos SET num_tornillo=$tor6,componente='$componente6',kilos='$kilos6',lote='$lote6' WHERE Idcontrol_mezcla='$idcontrol_m' AND Idtornillo=$idtor6;";

		$insertValTor7 = "UPDATE tornillos SET num_tornillo=$tor7,componente='$componente7',kilos='$kilos7',lote='$lote7' WHERE Idcontrol_mezcla='$idcontrol_m' AND Idtornillo=$idtor7;";

		echo($insertValTor1);
		echo "<br>";
		echo ($insertValTor2);
		$insertTor1 = sqlsrv_query($connSCPBD, $insertValTor1);
		$insertTor2 = sqlsrv_query($connSCPBD, $insertValTor2);
		$insertTor3 = sqlsrv_query($connSCPBD, $insertValTor3);
		$insertTor4 = sqlsrv_query($connSCPBD, $insertValTor4);
		$insertTor5 = sqlsrv_query($connSCPBD, $insertValTor5);
		$insertTor6 = sqlsrv_query($connSCPBD, $insertValTor6);
		$insertTor7 = sqlsrv_query($connSCPBD, $insertValTor7);

		if ($insertTor1 && $insertTor2) 
		{
			echo "<br>";
			echo "Datos Alamacenados en tornillos";
		}else
		{
			echo "Error al guardar en tornillos";
		}


	}
	else{
		echo "Error al guardar control_mezclas";
	}
	sqlsrv_close( $connSCPBD );

	}

	if ($estado == "pendiente") {
		header("Location:  controles_mezclas.php");
	} else {
		header("Location:  apro_controles_mezclas.php");
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