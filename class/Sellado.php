<?php 
class Sellado {

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
    public function connectPlas($database = 'PLASMARSA') {
        // we don't need to connect twice
        if ( $this->connection_plas ) {
            return;
        }
        // data for making connection            
        $mssql_server = 'hestia';
        $mssql_data = array("UID" => 'scpbd',
                        "PWD" => 'scpbd',
                        "Database" => $database);
        // try to connect                    
        $dbconnect = $this->connection_plas = sqlsrv_connect($mssql_server, $mssql_data);
        if(! $dbconnect){
            return 'Failed to connect to host';
        }
        return $dbconnect;
    }
      /*
    *Metodo para regresar los valores de una orden de produccion de selado con el numero de orden
    */
    public function getOrdenProduccion ($search) {
      $result = sqlsrv_query($this->connectPlas(), "SELECT * FROM vORDEN_SELLADO_SCP WHERE ORDENNRO = '$search'");
      $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);

      if ($result === false) {die( print_r( sqlsrv_errors(), true));}   

      return $row;
       
    }
    /*
    *Metodo para regresar las observaciones de calidad de una orden de produccion de el area de Sellado
    */
    public function getObsCalidadFirst($nit,$codigo) {
      $data_array = array();
      $result = sqlsrv_query($this->connectPlas(), "SELECT DISTINCT OBSERVACIO FROM dbo.OBSCALIDAD o WHERE ((o.NIT='$nit' AND o.CODIGO='') OR (o.CODIGO='$codigo') )AND o.OBSERVACIO<>'' AND PROCESO='SELLADO'");
      $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
      if ($result === false) {die( print_r( sqlsrv_errors(), true));}

      return $row; 
    }
    /*
    *Metodo para regresar las observaciones de calidad de una orden de produccion de el area de Sellado
    */
    public function getObsCalidad($nit,$codigo) {
      $data_array = array();
      $result = sqlsrv_query($this->connectPlas(), "SELECT DISTINCT OBSERVACIO FROM dbo.OBSCALIDAD o WHERE ((o.NIT='$nit' AND o.CODIGO='') OR (o.CODIGO='$codigo') )AND o.OBSERVACIO<>'' AND PROCESO='REFILADO'");
      $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
      if ($result === false) {die( print_r( sqlsrv_errors(), true));}

      while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
        $data_array[] = $row;                                                    
      }

      $arr = $data_array;  
      return $arr; 
    }
    /**
    *Metodo para insertar los valores de un requisito de sellado
    */
    public function getDatosRequisito($id)
    {
      $result = sqlsrv_query($this->connect(), "SELECT * FROM sellado_requisitos WHERE Idsellado_requisitos = '$id'");
      $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);

      if ($result === false) {die( print_r( sqlsrv_errors(), true));}   

      return $row;
    }
    /*
    *Ultimo id de una insercion
    */
     /*function lastInsertId($queryID) {

        sqlsrv_next_result($queryID);

        sqlsrv_fetch($queryID);

        return sqlsrv_get_field($queryID, 0);

    } */
    /*
    *Contador de requistos gestionado para regresar el consecutivo
    */
    public function consecutivoOrden($orden)
    {
        $result = sqlsrv_query($this->connect(), "SELECT count(num_orden) as ultimo_requisito from sellado_requisitos where num_orden = '$orden'");
      $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);

      if ($result === false) {die( print_r( sqlsrv_errors(), true));}   

      return $row;
      
    }
    /**
    *Metodo para insertar los valores de un requisito de refilado
    */
    public function insertRequisito ($consecutivo) {

    /*Generacion de fecha automatica*/
      $h = '5';
      $hm = $h * 60;
      $ms = $hm * 60;
      $fecha =  gmdate("d/m/Y H:i:s", time()-($ms));

      /*Configuracion de query Transact-SQL*/
     $tsql = "INSERT INTO sellado_requisitos(num_orden,fecha,operario,estado,fechase,sellado,Idusuario,ancho,largo,maquina_sell,consecutivo) VALUES (?,?,?,?,?,?,?,?,?,?,?);";

      /*Configuracion de parametros, los parametros corresponden al orden de los signos de interrogacion*/
      //$fecha_terminado = '0000-00-00 00:00:00.000';
      $params = array(
      &$_POST['num_orden'],
      &$fecha,
      &$_POST['operario'],
      &$_POST['estado'],
      &$_POST['fechase'],
      &$_POST['sellado'],
      &$_POST['Idusuario'],
      &$_POST['ancho'],
      &$_POST['largo'],
      &$_POST['maquina_sell'],
      &$consecutivo
       );
    
      /* Create the statement.  */
      $stmt = sqlsrv_prepare( $this->connect(), $tsql, $params);  
      if( !$stmt )
      {  
        echo "Error in preparing statement.\n";  
          die( print_r( sqlsrv_errors(), true));
      }  

      /* Execute the statement. Display any errors that occur.*/ 
      if( !sqlsrv_execute( $stmt))  
      {  
        echo "Error in executing statement.\n";  
          die( print_r( sqlsrv_errors(), true));  
      }else{
        $msg = 'ok';
        return $msg;
      }
              
    }

    /**
    *Metodo para actualizar los valores de un requisito de refilado
    */
    public function updateRequisito ($id_requisito) {
    /*Generacion de fecha automatica*/
      $h = '5';
      $hm = $h * 60;
      $ms = $hm * 60;
      $fecha =  gmdate("d/m/Y H:i:s", time()-($ms));

      /*Configuracion de query Transact-SQL*/
     
     $tsql = "UPDATE sellado_requisitos SET num_orden=?,fecha=?,operario=?,estado=?,fechase=?,sellado=?,Idusuario=?,ancho=?,largo=?,maquina_sell=? WHERE Idsellado_requisitos = ?;";
      /*Configuracion de parametros, los parametros corresponden al orden de los signos de interrogacion*/
      //$fecha_terminado = '0000-00-00 00:00:00.000';
      $params = array(
      &$_POST['num_orden'],
      &$fecha,
      &$_POST['operario'],
      &$_POST['estado'],
      &$_POST['fechase'],
      &$_POST['sellado'],
      &$_POST['Idusuario'],
      &$_POST['ancho'],
      &$_POST['largo'],
      &$_POST['maquina_sell'],
      &$id_requisito
       );
    
      /* Create the statement.  */
      $stmt = sqlsrv_prepare( $this->connect(), $tsql, $params);  
      if( !$stmt )
      {  
        echo "Error in preparing statement.\n";  
          die( print_r( sqlsrv_errors(), true));
      }  

      /* Execute the statement. Display any errors that occur.*/ 
      if( !sqlsrv_execute( $stmt))  
      {  
        echo "Error in executing statement.\n";  
          die( print_r( sqlsrv_errors(), true));  
      }else{
        $msg = 'ok';
        return $msg;
      }
              
    }

    /**
    *Metodo para insertar los valores de un requisito de refilado
    */
    public function terminarRequisito ($id_requisito) {

    /*Generacion de fecha automatica*/
      $h = '5';
      $hm = $h * 60;
      $ms = $hm * 60;
      $fecha =  gmdate("d/m/Y H:i:s", time()-($ms));

      /*Configuracion de query Transact-SQL*/
     $tsql = "UPDATE sellado_requisitos SET estado=?,fecha_terminado=? WHERE Idsellado_requisitos = ?;";

      /*Configuracion de parametros, los parametros corresponden al orden de los signos de interrogacion*/
      //$fecha_terminado = '0000-00-00 00:00:00.000';
      $params = array(
      &$_POST['estado'],
      &$fecha,
      &$id_requisito
       );
    
      /* Create the statement.  */
      $stmt = sqlsrv_prepare( $this->connect(), $tsql, $params);  
      if( !$stmt )
      {  
        echo "Error in preparing statement.\n";  
          die( print_r( sqlsrv_errors(), true));
      }  

      /* Execute the statement. Display any errors that occur.*/ 
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