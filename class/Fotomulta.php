<?php 
class Fotomulta {

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
        $dbconnect = $this->connection = sqlsrv_connect($mssql_server, $mssql_data);
        if(! $dbconnect){
            return 'Failed to connect to host';
        }
        return $dbconnect;
    }

    public function getTipos ($search) {
        // reset results; is this really needed as object's variable? Can't it be just local function's variable??
        $data_array = array();
        $result = sqlsrv_query($this->connect(), "SELECT Id, Nombre FROM Tipo_inconformidad WHERE Nombre LIKE '%$search%'");
        while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
            $data_array[] = $row;                                                    
        }
        $arr = $data_array;  
        return $arr;                   
    }

    public function getProcesos ($search) {
        // reset results; is this really needed as object's variable? Can't it be just local function's variable??
        $data_array = array();
        $result = sqlsrv_query($this->connect(), "SELECT Id, Nombre FROM Procesos WHERE Nombre LIKE '%$search%'");
        while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
            $data_array[] = $row;                                                    
        }
        $arr = $data_array;  
        return $arr;                   
    }
   

    public function getCausas ($tipo,$procs,$search) {
        // reset results; is this really needed as object's variable? Can't it be just local function's variable??
        $data_array = array();
        $result = sqlsrv_query($this->connect(), "SELECT Id,Causa FROM Inconformidades  WHERE Tipo = '$tipo' AND Proceso = '$procs' AND Causa LIKE '%$search%'");
        while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
            $data_array[] = $row;                                                    
        }
        $arr = $data_array;  
        return $arr;                   
    }



} 
?>