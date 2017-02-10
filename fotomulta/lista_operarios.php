<?php
	include '../includes/dbconfig.php';
	$tipo = $_GET['tipo'];
	switch ($tipo) {
		case '1':
				//Tipo 1 para autocompletar Empleado
				$listaOperarios = "SELECT Nombre FROM dbo.Empleados WHERE Nombre LIKE '".strtoupper($_GET['name_startsWith'])."%'";
				$registros = sqlsrv_query($connSCPBD, $listaOperarios);
				$data = array();
				while ($row = sqlsrv_fetch_array( $registros, SQLSRV_FETCH_ASSOC)) 
				{
					array_push($data, $row['Nombre']);
				}
				echo json_encode($data);
			break;
		
		case '2':
			//Tipo 2 para consultar el centro de costos o area
		$areaOperaios = "SELECT CentroCostos FROM dbo.Empleados WHERE Nombre = '".strtoupper($_GET['emp'])."'";
		$registros = sqlsrv_query($connSCPBD, $areaOperaios);
		$fila = sqlsrv_fetch_object($registros);
		echo $fila->CentroCostos;

			break;
	}


?>