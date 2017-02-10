<?php 

require_once '../class/Fotomulta.php';
$ft = new Fotomulta();
$insert = $ft->insertFotoMulta($_POST['Tipo_inconf']);
echo $insert;


?>