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
    /*
    *Metodo para regresar la lista de los tipos de inconformidades para ser utilizados en el autocompletar
    */
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
    /*
    *Metodo para regresar la lista de los tipos de procesos para ser utilizados en el autocompletar
    */
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
    /*
    *Metodo para regresar la lista de las causas para ser utilizados en el autocompletar
    */
    public function insertFotoMulta ($tipo_incf) {
    /*Generacion de fecha automatica*/
      $h = '5';
      $hm = $h * 60;
      $ms = $hm * 60;
      $fecha =  gmdate("d/m/Y H:i:s", time()-($ms));

      /*Configuracion de query Transact-SQL*/
      $tsql = "INSERT INTO foto_multas (num_orden,cliente,descripcion,referencia,fecha,tipo_inconf,tipo_proceso,num_rollo,maquina,cantidad,detectada_por,operario_res,causa,descripcion_inc,dispo_final,evidencia,Idusuario,fecha_fotomulta,area,Sistema_afectado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

      /*Configuracion de parametros, los parametros corresponden al orden de los signos de interrogacion*/
      if ($tipo_incf == 'INCUMPLIMIENTO AL S.G.I') {
        $Pedido = 0;
        $Cliente = 'null';
        $Descripcion_1 = 'null';
        $Referencia = 0;
        $Num_rollo = 0;
        $Maquina = 0;
        $Cantidad = 0;
        $Dispo_final = 'null';

        $params = array(
        &$Pedido,
        &$Cliente, 
        &$Descripcion_1, 
        &$Referencia, 
        &$fecha, 
        &$_POST['Tipo_inconf'], 
        &$_POST['Tipo_proceso'], 
        &$Num_rollo, 
        &$Maquina, 
        &$Cantidad, 
        &$_POST['Detectada_por'], 
        &$_POST['Empleado_res'], 
        &$_POST['Causa'], 
        &$_POST['Descripcion_2'],
        &$Dispo_final, 
        &$_POST['Foto_evidencia'], 
        &$_POST['id_usuario'], 
        &$_POST['Fecha_foto'], 
        &$_POST['Area'], 
        &$_POST['Sistema_Afect']);
      } else {
        $params  = array(
        &$_POST['Pedido'], 
        &$_POST['Cliente'], 
        &$_POST['Descripcion_1'], 
        &$_POST['Referencia'], 
        &$fecha, 
        &$_POST['Tipo_inconf'], 
        &$_POST['Tipo_proceso'], 
        &$_POST['Num_rollo'], 
        &$_POST['Maquina'], 
        &$_POST['Cantidad'], 
        &$_POST['Detectada_por'], 
        &$_POST['Empleado_res'], 
        &$_POST['Causa'], 
        &$_POST['Descripcion_2'], 
        &$_POST['Dispo_final'], 
        &$_POST['Foto_evidencia'], 
        &$_POST['id_usuario'], 
        &$_POST['Fecha_foto'], 
        &$_POST['Area'], 
        &$_POST['Sistema_Afect']);
      }
      /* Create the statement.  */
      $stmt = sqlsrv_prepare( $this->connect(), $tsql, $params);  
      if( !$stmt )
      {  
        echo "Error in preparing statement.\n";  
          die( print_r( sqlsrv_errors(), true));
      }  

      /* Execute the statement. Display any errors that occur. */  
      if( !sqlsrv_execute( $stmt))  
      {  
        echo "Error in executing statement.\n";  
          die( print_r( sqlsrv_errors(), true));  
      }else{
        $msg = 'ok';
        return $msg;
      }
    }



} 
?>