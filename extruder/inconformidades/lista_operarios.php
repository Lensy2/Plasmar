<?php
//conection: 
include '../../includes/dbconfig.php';
//consultation:
$q = $_GET['q'];
$page = $_GET['page'];

$return_arr = array();
$ConsultaOperarios = "SELECT * FROM dbo.OPERARIOS where NOMBRE LIKE '%".$q."%' ORDER BY NOMBRE ";

echo $ConsultaOperarios;
$registros = sqlsrv_query($connPlas, $ConsultaOperarios);

$ver = var_dump($registros);
echo $ver;
            
while($fila = sqlsrv_fetch_array( $registros, SQLSRV_FETCH_ASSOC))
{
	$fila_array['NOMBRE'] = $fila['NOMBRE'];
    $fila_array['OPERARIO'] = $fila['OPERARIO'];

    array_push($return_arr,$fila_array); 
}

echo json_encode($return_arr);

sqlsrv_close( $connPlas );
?>
?>