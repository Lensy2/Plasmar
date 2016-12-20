<?php
	include '../../includes/dbconfig.php';

	$listaCausas = "SELECT NOMBRE FROM dbo.general_causas WHERE NOMBRE LIKE '".strtoupper($_GET['name_startsWith'])."%'";
	//echo($listaOperarios);
	$registros = sqlsrv_query($connSCPBD, $listaCausas);
	$data = array();
	while ($row = sqlsrv_fetch_array( $registros, SQLSRV_FETCH_ASSOC)) 
	{
		array_push($data, $row['NOMBRE']);
	}
	echo json_encode($data);


?>