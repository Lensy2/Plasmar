<?php
	include '../../includes/dbconfig.php';

	$listaCausas = "SELECT nombre FROM dbo.ext_causas WHERE nombre LIKE '".strtoupper($_GET['name_startsWith'])."%'";
	//echo($listaOperarios);
	$registros = sqlsrv_query($connSCPBD, $listaCausas);
	$data = array();
	while ($row = sqlsrv_fetch_array( $registros, SQLSRV_FETCH_ASSOC)) 
	{
		array_push($data, $row['nombre']);
	}
	echo json_encode($data);


?>