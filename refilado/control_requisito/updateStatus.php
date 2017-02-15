<?php
	include '../../class/Refilado.php';
	$rf = new Refilado();
	$update = $rf->terminarRequisito($_POST['id_requisito']);
	echo  $update;

?>