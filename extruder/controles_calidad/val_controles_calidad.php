<?php

$archivo = 'nuevo_control_req';

include '../../includes/funciones.php';
$enlace = rutaRecursos('segundo_nivel');

$pedido = $_GET['pedido'];
$idmezcla = $_GET['idmezcla'];
$tipo_ext =$_GET['tipoped'];

$tipoPedidoEtq = tipoPedidoEtiqueta($tipo_ext);


include '../../includes/dbconfig.php'; 
include '../../model/extruder.php';


echo "<hr>
            <div class='col-md-7' style='text-align: left;'>  
                <b>Informacion:</b> <br>Solo se visualizaran los rollos con su respectivo pesaje realizado y etiqueta generada, para continuar por favor seleccione el numero del rollo o cancelar para salir de la ventana emergente.
            </div>
            <div class='col-md-4' style='text-align: center;'>";            
            echo "<b>Seleccionar rollo:</b><form method='get' action='http://".$_SERVER['SERVER_NAME']."/apps/extruder/controles_calidad/nuevo_control_calidad.php'>";

echo "<select class='form-control' name='num_rollo'>";
/*$registrosRollos = consulta de los registros de la tabla dbo.ETQPLASMAR */
$registrosRollos = sqlsrv_query($connPlas, $numRollos);

//$fila2 = sqlsrv_fetch_array($registrosRollos);


while ( $fila = sqlsrv_fetch_object($registrosRollos)) 
{	
	$counter++;
    echo "<option value='$fila->ROLLO'>$fila->ROLLO</option> "; 
}


/*

while ( $fila = sqlsrv_fetch_object($registrosRollos)) {
    echo "<option value='$fila->ROLLO'>$fila->ROLLO</option> "; 
}
*/
echo "</select>";

echo "<input name='pedido' type='hidden' value='".$pedido."'>
      <input name='tipo_ext' type='hidden' value='".$tipo_ext."'>
      <input name='idmezcla' type='hidden' value='".$idmezcla."'>";

if ($counter == 0) {
      echo "<input type='submit' class='btn btn-info' name='submit' value='Continuar' disabled>";
    } else {
      echo "<input type='submit' class='btn btn-info' name='submit' value='Continuar'>";

    }
  echo "</form>";      
 echo  "</div>";





sqlsrv_close( $connPlas );
?>