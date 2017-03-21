<?php
	include '../../class/Sellado.php';
	$sll = new Sellado();
	$update = $sll->updateRequisito($_POST['id_requisito']);
	echo  $update;

?>