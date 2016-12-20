<?php
	include '../../includes/dbconfig.php';

	$listaOperarios = "SELECT OPERARIO, NOMBRE FROM dbo.OPERARIOS WHERE NOMBRE LIKE '".strtoupper($_GET['name_startsWith'])."%'";
	//echo($listaOperarios);
	$registros = sqlsrv_query($connPlas, $listaOperarios);
	$data = array();
	while ($row = sqlsrv_fetch_array( $registros, SQLSRV_FETCH_ASSOC)) 
	{
		array_push($data, $row['NOMBRE']);
	}
	echo json_encode($data);


?>