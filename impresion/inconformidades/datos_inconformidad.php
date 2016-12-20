<?php 
  $pedido = $_GET['pedido'];
  
  include '../../includes/dbconfig.php';
  include '../../model/impresion.php';

  $registrosImpFilas = sqlsrv_query($connPlas, $comprobacionImp, array(), array( "Scrollable" => 'static' ));
  $contImpFilas = sqlsrv_num_rows($registrosImpFilas);
  $fila = sqlsrv_fetch_array($registrosImpFilas);

  if ($contImpFilas != 0){
      echo "<hr><div class='col-md-3'>  
                <div class='icon' style='text-align: center;'>
                  <i class='fa fa-fw fa-check-square-o' style='font-size: 5em;'></i>
                </div>                            
              </div>
            <div class='col-md-8'>";
      echo "<b>Información:</b> este pedido se encuentra disponible para ser gestionado.";
      echo    "<form method='post' action='http://".$_SERVER['SERVER_NAME']."/apps/impresion/inconformidades/nueva_inconformidad.php'>
                  <input name='pedido' type='hidden' value='".$pedido."'>
                  <input name='nit' type='hidden' value='".trim($fila['NIT'])."'>
                  <input name='cliente' type='hidden' value='".trim($fila['NOMBRE'])."'>
                  <input name='descripcion' type='hidden' value='".trim($fila['DESCRIPCIO'])." ".trim($fila['DESCRIP2'])."'>
                  <input name='referencia' type='hidden' value='".trim($fila['CODIGO'])."'>
                  <input type='submit' class='btn btn-danger' name='submit' value='Generar Inconformidad'>
              </form></br>";
  }
  elseif ($contImpFilas === 0){
          echo "<hr><div class='col-md-3'>  
                      <div class='icon' style='text-align: center;'>
                        <i class='fa fa-fw fa-ban' style='font-size: 5em;'></i>
                      </div>                            
                </div>
          <div class='col-md-6'>          
                    <h5>La Orden # <b>".$pedido."</b> seleccionada aun no ha sido generada, por favor seleccione otro pedido.</h5>
                  </div>";
  }
?>