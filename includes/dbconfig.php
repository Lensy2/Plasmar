<?php
	/*   ----- Inicio Conexion a DB Plasmarsas ----- */
	$serverName = "hestia";
	//$serverName = "MDE_JHURTADO";
    $connectionInfo = array( "Database"=>"PLASMARSA", "UID"=>"scpbd", "PWD"=>"scpbd");
	$connPlas = sqlsrv_connect( $serverName, $connectionInfo);
	if(!$connPlas){ 
		die( print_r( sqlsrv_errors(), true));
	}
	/*   ----- Fin Conexion a DB Plasmarsas -----   */
	/* ----- Inicio Conexion a DB SCPBD ----- */
	$serverName = "hestia"; //serverName\instanceName
    $connectionInfo = array( "Database"=>"SCPBD", "UID"=>"scpbd", "PWD"=>"scpbd");
	$connSCPBD = sqlsrv_connect( $serverName, $connectionInfo);
	if(!$connSCPBD){ die( print_r( sqlsrv_errors(), true));}
	/* ----- Fin Conexion a DB SCPBD ----- */
?>