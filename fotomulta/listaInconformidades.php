<?php 
 require_once '../class/Fotomulta.php';
 $ft = new Fotomulta();

// strip tags may not be the best method for your project to apply extra layer of security but fits needs for this tutorial
$tipo = $_GET['t'];
$search = strip_tags(trim($_GET['q']));


switch ($tipo) {
	case '1':
	$datosTipos = $ft->getTipos($search);
		// Make sure we have a result
	if(count($datosTipos) > 0){
	   foreach ($datosTipos as $key => $value) {
		$data[] = array('id' => $value['Id'], 'text' => $value['Nombre']);			 	
	   } 
	}/* else {
	   $data[] = array('id' => '0', 'text' => 'No Products Found');
	}*/
	// return the result in json
	echo json_encode($data);
		break;
	
	case '2':
	$datosProcesos = $ft->getProcesos($search);
		// Make sure we have a result
	if(count($datosProcesos) > 0){
	   foreach ($datosProcesos as $key => $value) {
		$data[] = array('id' => $value['Id'], 'text' => $value['Nombre']);			 	
	   } 
	} /*else {
	   $data[] = array('id' => '0', 'text' => 'No Products Found');
	}*/
	// return the result in json
	echo json_encode($data);
		break;

	case '3':
	$tipo_inc = strip_tags(trim($_GET['tipo_inc']));
	$proceso  = strip_tags(trim($_GET['proceso']));
	$datosCausas = $ft->getCausas($tipo_inc,$proceso,$search);
		// Make sure we have a result
	if(count($datosCausas) > 0){
	   foreach ($datosCausas as $key => $value) {
		$data[] = array('id' => $value['Id'], 'text' => $value['Causa']);			 	
	   } 
	} else {
	   $data[] = array('id' => '0', 'text' => 'No Products Found');
	}
	// return the result in json
	echo json_encode($data);
		break;
}


?>