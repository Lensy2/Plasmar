<?php
	include '../../class/Sellado.php';
	$sll = new Sellado();
	$consecutivo = $sll->consecutivoOrden($_POST['num_orden']);
	//echo $consecutivo['ultimo_requisito'];
	if (count($consecutivo) != 0) {
		$sll = new Sellado();
		$insert = $sll->insertRequisito($consecutivo['ultimo_requisito']);
	echo  $insert;
	}else{
		echo "consecutivo no generado";
	}
	

?>