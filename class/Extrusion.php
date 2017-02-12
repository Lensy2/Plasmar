<?php 
class Extrusion {

    protected $connection = null;

    public function connect($database = 'PLASMARSA') {
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
    *Metodo para regresar las descripciones de las ordenes de produccion
    */
    public function getDescripciones ($num_orden, $tipo_ext) {
        // reset results; is this really needed as object's variable? Can't it be just local function's variable??
      switch ($tipo_ext) {
        case 'ext_normal':
          $result = sqlsrv_query($this->connect(), "SELECT dbo.MTMERCIA.DESCRIPCIO AS DESCRIPCION, dbo.MTMERCIA.DESCRIP2 AS DESCRIPCION2 FROM dbo.EXTRUSION INNER JOIN dbo.MEZCLASMQ ON dbo.EXTRUSION.ORDENNRO = dbo.MEZCLASMQ.ORDENNRO INNER JOIN dbo.MTCOLOR ON dbo.EXTRUSION.COLOR = dbo.MTCOLOR.CODCOLOR INNER JOIN dbo.MTPROCLI ON  dbo.MTPROCLI.NIT = dbo.EXTRUSION.NIT INNER JOIN dbo.MTMERCIA ON dbo.EXTRUSION.CODIGO =  dbo.MTMERCIA.CODIGO  WHERE EXTRUSION.PEDIDO = '$num_orden'");

          $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
          $obs = $row['DESCRIPCION']." ".$row['DESCRIPCION2'];
          return $obs;
          break;
        
        case 'ext_laminacion':
          $result = sqlsrv_query($this->connect(), "SELECT dbo.MTMERCIA.DESCRIPCIO AS DESCRIPCION, dbo.MTMERCIA.DESCRIP2 AS DESCRIPCION2 FROM dbo.EXTRUSIONL INNER JOIN dbo.MEZCLASMQL ON dbo.EXTRUSIONL.ORDENNRO = dbo.MEZCLASMQL.ORDENNRO INNER JOIN dbo.MTCOLOR ON dbo.EXTRUSIONL.COLOR = dbo.MTCOLOR.CODCOLOR  INNER JOIN dbo.MTPROCLI ON  dbo.MTPROCLI.NIT = dbo.EXTRUSIONL.NIT INNER JOIN dbo.MTMERCIA ON dbo.EXTRUSIONL.CODIGO =  dbo.MTMERCIA.CODIGO WHERE dbo.EXTRUSIONL.PEDIDO='$num_orden'");

          $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
          $obs = $row['DESCRIPCION']." ".$row['DESCRIPCION2'];
          return $obs;
          break;
      }              
    }

} 
?>