<?php
	include '../../class/Refilado.php';
	$rf = new Refilado();
	$update = $rf->updateRequisito($_POST['id_requisito']);
	echo  $update;

?>