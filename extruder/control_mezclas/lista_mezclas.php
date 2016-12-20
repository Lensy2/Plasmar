<?php
	include '../../includes/dbconfig.php';

	$listaMezclas = "SELECT m.CODIGO as NOMBRE ,m.DESCRIPCIO FROM PLASMARSA.dbo.MTMERCIA m WHERE m.TIPOINV='mp' AND m.HABILITADO='1' AND m.CODIGO LIKE'".strtoupper($_GET['name_startsWith'])."%'";
	//echo($listaOperarios);
	$registros = sqlsrv_query($connPlas, $listaMezclas);
	$data = array();
	while ($row = sqlsrv_fetch_array( $registros, SQLSRV_FETCH_ASSOC)) 
	{
		array_push($data, $row['NOMBRE']);
	}
	echo json_encode($data);


?>