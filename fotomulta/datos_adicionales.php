<?php
	include '../includes/dbconfig.php';

	$listaCausas = "SELECT NOMBRE  from mtprocli WHERE NOMBRE LIKE  '".strtoupper($_GET['name_startsWith'])."%'";
	//echo($listaOperarios);
	$registros = sqlsrv_query($connPlas, $listaCausas);
	$data = array();
	while ($row = sqlsrv_fetch_array( $registros, SQLSRV_FETCH_ASSOC)) 
	{
		array_push($data, trim($row['NOMBRE']));
	}
	echo json_encode($data);


?>