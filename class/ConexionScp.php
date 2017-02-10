<?php
abstract class ConexionScp {
	protected $connection = null;

	    public function connect($database = 'SCPBD') {
	        // we don't need to connect twice
	        if ( $this->connection ) {
	            return;
	        }
	        // data for making connection            
	        $mssql_server = 'hestia';
	        $mssql_data = array("UID" => 'scpbd',
	                        "PWD" => 'scpbd',
	                        "Database" => $database);
	        // try to connect                    
	        $mssql = $this->connection = sqlsrv_connect($mssql_server, $mssql_data);
	        if(! $mssql){
	            return 'Fallo al conectarse al servido SQL';
	        }
	        return $mssql;
	    }
      
}
?>