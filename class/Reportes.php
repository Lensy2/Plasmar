<?php 
class Reportes {

    protected $connection = null;
    protected $connection_plas = null;

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
    /*
    *Metodo para regresar el top 10 de inconfomidades INCUMPLIMIENTO AL S.G.I por proceso
    */
    public function listaPorProceso () {
      $result = sqlsrv_query($this->connect(), "SELECT TOP 10 count(tipo_proceso) as Total, tipo_proceso from foto_multas WHERE tipo_inconf = 'INCUMPLIMIENTO AL S.G.I' GROUP BY tipo_proceso  ORDER BY total DESC");
      $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);

      if ($result === false) {die( print_r( sqlsrv_errors(), true));}   
     while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
            $data_array[] = $row;                                                    
          }

      $arr = $data_array;  
      return $arr; 
       
    }
    /*
    *Metodo para regresar el top 10 de inconfomidades INCUMPLIMIENTO AL S.G.I por proceso
    */
    public function listaPorProceso2 () {
      $result = sqlsrv_query($this->connect(), "SELECT TOP 10 count(tipo_proceso) as Total, tipo_proceso from foto_multas WHERE tipo_inconf = 'INCUMPLIMIENTO AL S.G.I' GROUP BY tipo_proceso  ORDER BY total DESC");
      $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);

      if ($result === false) {die( print_r( sqlsrv_errors(), true));}   
     
      return $row; 
       
    }
    /*
    *Metodo para regresar el top 10 de inconfomidades INCUMPLIMIENTO AL S.G.I por persona
    */
    public function listaPorPersona() {
      $result = sqlsrv_query($this->connect(), "SELECT TOP 11 count(operario_res) as Total, operario_res from foto_multas WHERE tipo_inconf = 'INCUMPLIMIENTO AL S.G.I' GROUP BY operario_res ORDER BY total DESC");
      $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
      if ($result === false) {die( print_r( sqlsrv_errors(), true));}

     while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
            $data_array[] = $row;
          }

      $arr = $data_array;  
      return $arr; 
       
    }
    /*
    *Metodo para regresar el top 10 de inconfomidades INCUMPLIMIENTO AL S.G.I por persona
    */
    public function listaPorPersona2() {
      $result = sqlsrv_query($this->connect(), "SELECT TOP 11 count(operario_res) as Total, operario_res from foto_multas WHERE tipo_inconf = 'INCUMPLIMIENTO AL S.G.I' GROUP BY operario_res ORDER BY total DESC");
      $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
      if ($result === false) {die( print_r( sqlsrv_errors(), true));} 
      return $row; 
       
    }
    /*
    *Metodo para regresar el top 10 de inconfomidades INCUMPLIMIENTO AL S.G.I por persona
    */
    public function listaSAfectCalidad() {
      $res_calidad = sqlsrv_query($this->connect(), "SELECT COUNT(Sistema_afectado) AS Total from foto_multas where Sistema_afectado like '%Calidad%'");
      $row_calidad = sqlsrv_fetch_array($res_calidad,SQLSRV_FETCH_ASSOC);

         return $row_calidad;
       
    }
       /*
    *Metodo para regresar el top 10 de inconfomidades INCUMPLIMIENTO AL S.G.I por persona
    */
    public function listaSAfectAmbiental() {
      
      $res_ambiental = sqlsrv_query($this->connect(), "SELECT COUNT(Sistema_afectado) AS Total from foto_multas where Sistema_afectado like '%Ambiental%'");
      $row_ambiental = sqlsrv_fetch_array($res_ambiental,SQLSRV_FETCH_ASSOC);

         return $row_ambiental;
       
    }
       /*
    *Metodo para regresar el top 10 de inconfomidades INCUMPLIMIENTO AL S.G.I por persona
    */
    public function listaSAfectInocuidad() {

      $res_inocuidad = sqlsrv_query($this->connect(), "SELECT COUNT(Sistema_afectado) AS Total from foto_multas where Sistema_afectado like '%Inocuidad%'");
      $row_inocuidad = sqlsrv_fetch_array($res_inocuidad,SQLSRV_FETCH_ASSOC);

         return $row_inocuidad;
       
    }
        /*
    *Metodo para regresar el top 10 de inconfomidades INCUMPLIMIENTO AL S.G.I por persona
    */
    public function listaSAfectSst() {

      $res_SST = sqlsrv_query($this->connect(), "SELECT COUNT(Sistema_afectado) AS Total from foto_multas where Sistema_afectado like '%SST%'");
      $row_SST = sqlsrv_fetch_array($res_SST,SQLSRV_FETCH_ASSOC);

         return $row_SST;
       
    }
         /*
    *Metodo para regresar el top 10 de inconfomidades INCUMPLIMIENTO AL S.G.I por persona
    */
    public function listaSAfectOtro() {

      $res_otro = sqlsrv_query($this->connect(), "SELECT COUNT(Sistema_afectado) AS Total from foto_multas where Sistema_afectado like '%Otro%'");
      $row_otro = sqlsrv_fetch_array($res_otro,SQLSRV_FETCH_ASSOC);

         return $row_otro;
       
    }


} 
?>