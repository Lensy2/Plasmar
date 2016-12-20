<?php 
$archivo = 'programacion';
$pedido = $_GET['pedido'];
   
  include '../includes/dbconfig.php';
  include '../model/extruder.php';


/*------  Inicio Definicion de variables de las consultas realizadas sobre las tablas dbo.Extrusion y dbo.ExtrusionL -----*/

/*$registrosExtFilas = consulta temporal para validar la existencia de registros en la tabla dbo.Extrusion*/
$registrosExtFilas = sqlsrv_query($connPlas, $comprobacionExt, array(), array( "Scrollable" => 'static' ));
/*$registrosExt = consulta de los registros de la tabla dbo.Extrusion*/
$registrosExt = sqlsrv_query($connPlas, $comprobacionExt);

/*$registrosExtLFilas = consulta temporal para validar la existencia de registros en la tabla dbo.ExtrusionL*/
$registrosExtLFilas = sqlsrv_query($connPlas, $comprobacionExtL, array(), array( "Scrollable" => 'static' ));
/*$registrosExt = consulta de los registros de la tabla dbo.Extrusion*/
$registrosExtL = sqlsrv_query($connPlas, $comprobacionExtL);

/*$contExtFilas = funcion que valida la existencia de registros de acuerdo a lo entregado en la variable registrosExtFilas de la tabla dbo.Extrusion*/
$contExtFilas = sqlsrv_num_rows($registrosExtFilas);
/*$contExtLFilas = funcion que valida la existencia de registros de acuerdo a lo entregado en la variable registrosExtFilas de la tabla dbo.ExtrusionL*/
$contExtLFilas = sqlsrv_num_rows($registrosExtLFilas);
/*El error  sqlsrv_num_rows() expects parameter 1 to be resource hace referencia a que no esta encontrando ninguna tabla en la BD */
/*------  Fin Definicion de variables de las consultas realizadas sobre las tablas dbo.Extrusion y dbo.ExtrusionL -----*/

/*------ Inicio Validaciones de la existencia de un pedido en las tablas Extrusion y ExtrusionL ------*/

/*------ 1. Que sucede si el pedido se encuentra en las tablas Extrusion y ExtrusionL -------*/
if ($contExtFilas != 0 && $contExtLFilas != 0)
{

    echo "<div class='col-md-3'>  
                    <div class='icon' style='text-align: center;'>
                      <i class='fa fa-fw fa-check-square-o' style='font-size: 5em;'></i>
                    </div>                            
              </div>
        <div class='col-md-8'>";
    echo "<b>Importante:</b> se han detectado los siguientes tipos de extrusion para un mismo pedido, para continuar por favor seleccione un tipo.";
    echo    "<form method='post' action='http://".$_SERVER['SERVER_NAME']."/apps/extruder/control_mezclas/nuevo_control_mezcla.php'>
                <input name='pedido' type='hidden' value='".$pedido."'>
                <input name='tipo_ext' type='hidden' value='ext_normal'>
                <input type='submit' class='btn btn-info' name='submit' value='Normal'>
            </form></br>";

    echo    "<form method='post' action='http://".$_SERVER['SERVER_NAME']."/apps/extruder/control_mezclas/nuevo_control_mezcla.php'>
                <input name='pedido' type='hidden' value='".$pedido."'>
                <input name='tipo_ext' type='hidden' value='ext_laminacion'>
                <input type='submit' class='btn btn-info' name='submit' value='Laminación'>
            </form>";
    echo "</div>";
}
/*------ 2. Que sucede si el pedido se encuentra solo en la tabla ExtrusionL -------*/
elseif ($contExtFilas === 0 && $contExtLFilas != 0) 
{

    echo "<div class='col-md-3'>  
                    <div class='icon' style='text-align: center;'>
                      <i class='fa fa-fw fa-check-square-o' style='font-size: 5em;'></i>
                    </div>                            
              </div>
        <div class='col-md-8'>";
    echo "<b>Importante:</b> solo se encuentra un tipo de extrusion para este pedido, para continuar seleccione el tipo.";
    echo    "<form method='post' action='http://".$_SERVER['SERVER_NAME']."/apps/extruder/control_mezclas/nuevo_control_mezcla.php'>
                <input name='pedido' type='hidden' value='".$pedido."'>
                <input name='tipo_ext' type='hidden' value='ext_laminacion'>
                <input type='submit' class='btn btn-info' name='submit' value='Laminación'>
            </form>";
            echo "</div>";
}
/*------ 2. Que sucede si el pedido se encuentra solo en la tabla Extrusion -------*/
if($contExtFilas != 0 && $contExtLFilas === 0)
{

     echo "<div class='col-md-3'>  
                    <div class='icon' style='text-align: center;'>
                      <i class='fa fa-fw fa-check-square-o' style='font-size: 5em;'></i>
                    </div>                            
              </div>
        <div class='col-md-8'>";
        echo "<b>Importante:</b> solo se encuentra un tipo de extrusion para este pedido, para continuar seleccione el tipo.";
    echo    "<form method='post' action='http://".$_SERVER['SERVER_NAME']."//apps/extruder/control_mezclas/nuevo_control_mezcla.php'>
                <input name='pedido' type='hidden' value='".$pedido."'>
                <input name='tipo_ext' type='hidden' value='ext_normal'>
                <input type='submit' class='btn btn-info' name='submit' value='Normal'>
            </form>";
                echo "</div>";
    
}
/*------ 3. Que sucede si el pedido no se encuentra en ninguna de las dos tablas -------*/
elseif ($contExtFilas === 0 && $contExtLFilas === 0) {

        echo "<div class='col-md-3'>  
                    <div class='icon' style='text-align: center;'>
                      <i class='fa fa-fw fa-ban' style='font-size: 5em;'></i>
                    </div>                            
              </div>
        <div class='col-md-6'>          
                  <h5>La Orden # <b>".$pedido."</b> seleccionada aun no ha sido generada, por favor seleccione otro pedido.</h5>
                </div>";
}
/*------ Fin Validaciones de la existencia de un pedido en las tablas Extrusion y ExtrusionL ------*/



sqlsrv_close( $connPlas );
?>