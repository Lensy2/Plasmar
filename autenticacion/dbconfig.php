<?php

	/* ----- Inicio Conexion a DB SCPBD ----- */
	//$serverName = "192.168.0.19"; //serverName\instanceName
	$serverName = "MDE_JHURTADO";
    $connectionInfo = array( "Database"=>"SCPBD", "UID"=>"userphp", "PWD"=>"userphp2");
	$connSCPBD = sqlsrv_connect( $serverName, $connectionInfo);
	if(!$connSCPBD){ die( print_r( sqlsrv_errors(), true));}
	/* ----- Fin Conexion a DB SCPBD ----- */

?>