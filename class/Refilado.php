<?php 
class Refilado {

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
    *Metodo para regresar los valores de una orden de produccion de refilado con el numero de orden
    */
    public function getOrdenProduccion ($search) {
      $result = sqlsrv_query($this->connectPlas(), "SELECT * FROM vORDEN_REFILADO_SCP WHERE ORDENNRO = '$search'");
      $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);

      if ($result === false) {die( print_r( sqlsrv_errors(), true));}   

      return $row;
       
    }
    /*
    *Metodo para regresar las observaciones de calidad de una orden de produccion de el area de Refilado
    */
    public function getObsCalidadFirst($nit,$codigo) {
      $data_array = array();
      $result = sqlsrv_query($this->connectPlas(), "SELECT DISTINCT OBSERVACIO FROM dbo.OBSCALIDAD o WHERE ((o.NIT='$nit' AND o.CODIGO='') OR (o.CODIGO='$codigo') )AND o.OBSERVACIO<>'' AND PROCESO='REFILADO'");
      $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
      if ($result === false) {die( print_r( sqlsrv_errors(), true));}

      return $row; 
    }
    /*
    *Metodo para regresar las observaciones de calidad de una orden de produccion de el area de Refilado
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
    *Metodo para insertar los valores de un requisito de refilado
    */
    public function getDatosRequisito($id)
    {
      $result = sqlsrv_query($this->connect(), "SELECT * FROM refilado_requisitos WHERE Idrefilado_requisitos = '$id'");
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
        $result = sqlsrv_query($this->connect(), "SELECT count(num_orden) as ultimo_requisito from refilado_requisitos where num_orden = '$orden'");
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
     $tsql = "INSERT INTO refilado_requisitos(num_orden,fecha,operario,estado,fechare,kilos,tcurado,gramosm,refilado,Idusuario,ancho_bobina,peso_guias,maquina_ref,kilos_p,consecutivo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

      /*Configuracion de parametros, los parametros corresponden al orden de los signos de interrogacion*/
      //$fecha_terminado = '0000-00-00 00:00:00.000';
      $params = array(
      &$_POST['num_orden'],
      &$fecha,
      &$_POST['operario'],
      &$_POST['estado'],
      &$_POST['fechare'],
      &$_POST['kilos'],
      &$_POST['tcurado'],
      &$_POST['gramosm'],
      &$_POST['refilado'],
      &$_POST['Idusuario'],
      &$_POST['ancho_bobina'],
      &$_POST['peso_guias'],
      &$_POST['maquina_ref'],
      &$_POST['kilos_p'],
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
     
     $tsql = "UPDATE refilado_requisitos SET num_orden=?,fecha=?,operario=?,estado=?,fechare=?,kilos=?,tcurado=?,gramosm=?,refilado=?,Idusuario=?,ancho_bobina=?,peso_guias=?,maquina_ref=?,kilos_p=? WHERE Idrefilado_requisitos = ?;";
      /*Configuracion de parametros, los parametros corresponden al orden de los signos de interrogacion*/
      //$fecha_terminado = '0000-00-00 00:00:00.000';
      $params = array(
      &$_POST['num_orden'],
      &$fecha,
      &$_POST['operario'],
      &$_POST['estado'],
      &$_POST['fechare'],
      &$_POST['kilos'],
      &$_POST['tcurado'],
      &$_POST['gramosm'],
      &$_POST['refilado'],
      &$_POST['Idusuario'],
      &$_POST['ancho_bobina'],
      &$_POST['peso_guias'],
      &$_POST['maquina_ref'],
      &$_POST['kilos_p'],
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
    /*
    *Mostrar total de kilos pesados para un pedido en refilado
    */
    public function getSumaKilos($orden)
    {
       $result = sqlsrv_query($this->connect(), "SELECT sum(kilos_p) as kilos_pesados FROM refilado_requisitos WHERE num_orden = '$orden'");
      $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);

      if ($result === false) {die( print_r( sqlsrv_errors(), true));}   

      return $row;
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
     $tsql = "UPDATE refilado_requisitos SET estado=?,fecha_terminado=? WHERE Idrefilado_requisitos = ?;";

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