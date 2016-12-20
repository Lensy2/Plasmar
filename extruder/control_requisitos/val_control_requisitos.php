<?php 
$archivo = 'nuevo_control_req';
include '../../includes/funciones.php';
$enlace = rutaRecursos('segundo_nivel');
$pedido = $_GET['pedido'];
$tipo_ext = $_GET['tipoped'];
$idmezcla = $_GET['idmezcla'];


include '../../includes/dbconfig.php'; 
include '../../model/extruder.php';


/*------  Inicio Definicion de variables de las consultas realizadas sobre las tablas dbo.Extrusion y dbo.ExtrusionL -----*/
/*$registrosExt = consulta de los registros de la tabla dbo.Extrusion*/
$registrosExt = sqlsrv_query($connPlas, $comprobacionExt);
/*$registrosExt = consulta de los registros de la tabla dbo.ExtrusionL*/
$registrosExtL = sqlsrv_query($connPlas, $comprobacionExtL);
/* $validarRequisitos = encuentra si exite algun registro anterior con los parametros mencionados */
$validarRequisitos = sqlsrv_query($connSCPBD, $contadorRequisitos);
$fila = sqlsrv_fetch_object($validarRequisitos);
/*------  Fin Definicion de variables de las consultas realizadas sobre las tablas dbo.Extrusion y dbo.ExtrusionL */
//echo $fila->Total;

if ($fila->Total == 0) {   

    if ($tipo_ext == 'ext_laminacion') {
    
    echo "<hr>
            <div class='col-md-8' style='text-align: left;'>  
                <b>Información</b>
                <p>Aun no se ha generado control de requisito para este pedido, para generar presione el boton generar.</p>
            </div>
            <div class='col-md-3' style='text-align: center;'>";            
            echo  "<br><form method='get' action='http://".$_SERVER['SERVER_NAME']."/apps/extruder/control_requisitos/nuevo_control_requisito.php'>
                <input name='pedido' type='hidden' value='".$pedido."'>
                <input name='tipo_ext' type='hidden' value='".$tipo_ext."'>
                <input name='idmezcla' type='hidden' value='".$idmezcla."'>
                <input type='submit' class='btn btn-info' name='submit' value='Generar'>
            </form>";
    echo    "</div>";
   
    }elseif ($tipo_ext == 'ext_normal') {
  echo "<hr>
            <div class='col-md-8' style='text-align: left;'>  
                <b>Información</b>
                <p>Aun no se ha generado control de requisito para este pedido, para generar presione el boton generar.</p>
            </div>
            <div class='col-md-3' style='text-align: center;'>";            
            echo  "<br><form method='get' action='http://".$_SERVER['SERVER_NAME']."/apps/extruder/control_requisitos/nuevo_control_requisito.php'>
                <input name='pedido' type='hidden' value='".$pedido."'>
                <input name='tipo_ext' type='hidden' value='".$tipo_ext."'>
                <input name='idmezcla' type='hidden' value='".$idmezcla."'>
                <input type='submit' class='btn btn-info' name='submit' value='Generar'>
            </form>";
    echo    "</div>";
    }
}else{
echo "<hr>
    <div class='col-md-4' style='text-align: center;'>  
        <b>Información</b>
    </div>
    <div class='col-md-6' style='text-align: center;'>
        <p>Actualmente se encuentra un control de requisito gestionado para este pedido</p>
    </div>";
}

sqlsrv_close( $connPlas );
?>