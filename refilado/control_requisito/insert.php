<?php
	include '../../class/Refilado.php';
	$rf = new Refilado();
	$consecutivo = $rf->consecutivoOrden($_POST['num_orden']);
	echo $consecutivo['ultimo_requisito'];
	if (count($consecutivo) != 0) {
		$rf = new Refilado();
		$insert = $rf->insertRequisito($consecutivo['ultimo_requisito']);
	echo  $insert;
	}else{
		echo "consecutivo no generado";
	}
	

?>