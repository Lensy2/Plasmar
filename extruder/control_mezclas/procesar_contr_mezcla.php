<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

	// Esta funcion recibe como parametro la ultima insercion realizada (Query insertControlM en control de mezclas) en la tabla control de mezclas y devuelve este id, 
	function lastInsertId($queryID) {
		sqlsrv_next_result($queryID);
		sqlsrv_fetch($queryID);
		return sqlsrv_get_field($queryID, 0);
	}
	// --- Identifica el valor del submit y asigna el estado --- //
	if (isset($_POST['guarda'])) {
		$estado = "pendiente";
	}
	elseif (isset($_POST['aprob'])) {
	 	$estado = "aprobado";
	}

	// --- Variables tabla control_mezclas --- //
	$pedido = $_POST['num_orden']; //entra como parametro
	$tipo_ext = $_POST['tipo_ext'];//entra como parametro

	$h = "5";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
	$hm = $h * 60; 
	$ms = $hm * 60;
	$fecha = gmdate("d/m/Y g:i:s A", time()-($ms));
	
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

	// ---- Identificador del usuario de la session actual ? esto esta pendiente ----//
	$iduser = $_SESSION['idusuario'];

	// -- Validacion de la existencias de estos parametros ---  //
	if (isset($pedido, $tipo_ext, $fecha, $estado, $op_res)){

	include '../../includes/dbconfig.php';
	include '../../model/extruder.php';

	// ---- Esta variable $contadorMezclas define la query para contar el total de controles de mezclas realizados recibiendo dos parametros: numero de pedido y tipo de extrusion ---- // 
	echo $contadorMezclas ."<br>";

	// ---- Instanciamos los objetos de las consulta en la variable $fila, llamamos el campo Total el cual nos trae el valor de las mezclas realizadas dentro de $contMezcla y definimos la variable $contMezInsert en la cual sumamos $contMezcla + 1, entreganos asi el valor para guardar el contador de la mezcla que llevamos --- //
	$registros = sqlsrv_query($connSCPBD, $contadorMezclas);	
	$fila = sqlsrv_fetch_object($registros);
	$contMezcla = $fila->Total;
	$contMezInsert = $contMezcla + 1;

	// -- Query para insertar todos valores en la tabla control de mezcla ---//
	$insertValControlM = "INSERT INTO control_mezclas (num_orden,tipo_ext,fecha,estado,operario_res,num_mezcla,Idusuario) VALUES ($pedido,'$tipo_ext','$fecha','$estado','$op_res','$contMezInsert','$iduser');";
	/*echo $insertVal;
	echo $contMezcla ."<br>";
	echo "Valor para insertar como la siguiente mezcla: ".$contMezInsert;*/
	$insertValControlM .= "; SELECT SCOPE_IDENTITY() AS IDENTITY_COLUMN_NAME"; 
	// --- Ejecucion de la query de insercion en tabla control de mezclas --- //
	$insertControlM = sqlsrv_query($connSCPBD, $insertValControlM);	
	// -- Obtenemos el id de la ultima insercion en la tabla control de mezcla --/
	$ultimoid = lastInsertId($insertControlM);
	// -- Validarmos si se ejecuto correctamente la consulta --- //
	if ($insertControlM) {
		echo "<br>";
		echo "Dato almacenados en control_mezclas</br>";
		echo "The last inserted row ID is".$ultimoid."<br>";
		echo "<br>";
		// -- Insertamos los valores en el tornillo numero 1 y agregamos el ultimo id en el campo Idcontrol_mezcla para asociarlo a este control de mezcla -- //
		$insertValTor1 = "INSERT INTO tornillos (num_tornillo, componente, kilos, lote, Idcontrol_mezcla) VALUES ($tor1,'$componente1','$kilos1', '$lote1',$ultimoid);";

		// -- Insertamos los valores en el tornillo numero 2 y agregamos el ultimo id en el campo Idcontrol_mezcla para asociarlo a este control de mezcla -- //
		$insertValTor2 = "INSERT INTO tornillos (num_tornillo, componente, kilos, lote, Idcontrol_mezcla) VALUES ($tor2,'$componente2','$kilos2', '$lote2',$ultimoid);";

		// -- Insertamos los valores en el tornillo numero 3 y agregamos el ultimo id en el campo Idcontrol_mezcla para asociarlo a este control de mezcla -- //
		$insertValTor3 = "INSERT INTO tornillos (num_tornillo, componente, kilos, lote, Idcontrol_mezcla) VALUES ($tor3,'$componente3','$kilos3', '$lote3',$ultimoid);";

		// -- Insertamos los valores en el tornillo numero 4 y agregamos el ultimo id en el campo Idcontrol_mezcla para asociarlo a este control de mezcla -- //
		$insertValTor4 = "INSERT INTO tornillos (num_tornillo, componente, kilos, lote, Idcontrol_mezcla) VALUES ($tor4,'$componente4','$kilos4', '$lote4',$ultimoid);";

		// -- Insertamos los valores en el tornillo numero 5 y agregamos el ultimo id en el campo Idcontrol_mezcla para asociarlo a este control de mezcla -- //
		$insertValTor5 = "INSERT INTO tornillos (num_tornillo, componente, kilos, lote, Idcontrol_mezcla) VALUES ($tor5,'$componente5','$kilos5', '$lote5',$ultimoid);";

		// -- Insertamos los valores en el tornillo numero 6 y agregamos el ultimo id en el campo Idcontrol_mezcla para asociarlo a este control de mezcla -- //
		$insertValTor6 = "INSERT INTO tornillos (num_tornillo, componente, kilos, lote, Idcontrol_mezcla) VALUES ($tor6,'$componente6','$kilos6', '$lote6',$ultimoid);";

		// -- Insertamos los valores en el tornillo numero 7 y agregamos el ultimo id en el campo Idcontrol_mezcla para asociarlo a este control de mezcla -- //
		$insertValTor7 = "INSERT INTO tornillos (num_tornillo, componente, kilos, lote, Idcontrol_mezcla) VALUES ($tor7,'$componente7','$kilos7', '$lote7',$ultimoid);";

		echo($insertValTor1);
		echo "<br>";
		echo ($insertValTor2);
		echo "<br>";
		echo ($insertValTor3);
		echo "<br>";
		echo ($insertValTor4);
		echo "<br>";
		echo ($insertValTor5);
		echo "<br>";
		echo ($insertValTor6);
		echo "<br>";
		echo ($insertValTor7);
		// --- Ejecutamos las querys de insertar en la tabla de los tornillos --- //
		$insertTor1 = sqlsrv_query($connSCPBD, $insertValTor1);
		$insertTor2 = sqlsrv_query($connSCPBD, $insertValTor2);
		$insertTor3 = sqlsrv_query($connSCPBD, $insertValTor3);
		$insertTor4 = sqlsrv_query($connSCPBD, $insertValTor4);
		$insertTor5 = sqlsrv_query($connSCPBD, $insertValTor5);
		$insertTor6 = sqlsrv_query($connSCPBD, $insertValTor6);
		$insertTor7 = sqlsrv_query($connSCPBD, $insertValTor7);

		// --- Log para validar si fue correcta o incorrecta la insercion -- //
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


	sqlsrv_close( $connSCPBD );	
?>