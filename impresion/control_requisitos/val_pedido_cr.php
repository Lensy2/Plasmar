<?php 
	$pedido = $_GET['pedido'];
	
	include '../../includes/dbconfig.php';
  include '../../model/impresion.php';

  $registrosImpFilas = sqlsrv_query($connPlas, $comprobacionImp, array(), array( "Scrollable" => 'static' ));
  $contImpFilas = sqlsrv_num_rows($registrosImpFilas);
  /* $validarRequisitos = encuentra si exite algun registro anterior con los parametros mencionados */
  $validarImpRequisitos = sqlsrv_query($connSCPBD, $contadorImpRequisitos);
  $fila = sqlsrv_fetch_object($validarImpRequisitos);

if ($fila->Total == 0){
  if ($contImpFilas != 0){

      echo "<div class='col-md-3'>  
                      <div class='icon' style='text-align: center;'>
                        <i class='fa fa-fw fa-check-square-o' style='font-size: 5em;'></i>
                      </div>                            
                </div>
          <div class='col-md-8'>";
      echo "<b>Información:</b> este pedido se encuentra disponible para ser gestionado, para realizar premontaje presione el botón aceptar.";
      echo    "<form method='get' action='http://".$_SERVER['SERVER_NAME']."/apps/impresion/control_requisitos/nuevo_control_requisito_imp.php'>
                  <input name='pedido' type='hidden' value='".$pedido."'>
                  <input type='submit' class='btn btn-info' name='submit' value='Aceptar'>
              </form></br>";
  }
  elseif ($contImpFilas === 0) {

          echo "<div class='col-md-3'>  
                      <div class='icon' style='text-align: center;'>
                        <i class='fa fa-fw fa-ban' style='font-size: 5em;'></i>
                      </div>                            
                </div>
          <div class='col-md-6'>          
                    <h5>La Orden # <b>".$pedido."</b> seleccionada aun no ha sido generada, por favor seleccione otro pedido.</h5>
                  </div>";
  }
}else{
echo " <div class='col-md-4' style='text-align: center;'>  
        <b>Información</b>
    </div>
    <div class='col-md-6' style='text-align: center;'>
        <p>Actualmente se encuentra un control de requisito gestionado para este pedido</p>
    </div>";
}

?>