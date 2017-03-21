<?php
	include '../../class/Sellado.php';
	$sll = new Sellado();
	$update = $sll->terminarRequisito($_POST['id_requisito']);
	echo  $update;

?>