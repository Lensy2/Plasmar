<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

	// --- Identifica el valor del submit y asigna el estado --- //
	if (isset($_POST['guarda'])) {
		$estado = "pendiente";
	}
	elseif (isset($_POST['termin'])) {
	 	$estado = "terminado";
	}

	// --- Variables tabla control_calidad --- //
	$idcontrol_cal = $_POST['idcontrol_cal'];
	$pedido = $_POST['num_orden']; //entra como parametro
	$tipo_ext = $_POST['tipo_ext'];//entra como parametro
	$num_mezcla = $_POST['num_mezcla'];//entra como parametro
	$num_rollo = $_POST['num_rollo'];//entra como parametro

	$h = "5";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
	$hm = $h * 60; 
	$ms = $hm * 60;
	$fecha = gmdate("d/m/Y g:i:s A", time()-($ms));
	
	//----Valores de los calibres----///

	if (empty($calibre1 = $_POST['calibre1'])) {$calibre1 = 0;} else {$calibre1 = $_POST['calibre1'];}
	if (empty($calibre2 = $_POST['calibre2'])) {$calibre2 = 0;} else {$calibre2 = $_POST['calibre2'];}
	if (empty($calibre3 = $_POST['calibre3'])) {$calibre3 = 0;} else {$calibre3 = $_POST['calibre3'];}
	if (empty($calibre4 = $_POST['calibre4'])) {$calibre4 = 0;} else {$calibre4 = $_POST['calibre4'];}
	if (empty($promcalibre = $_POST['promcalibre'])) {$promcalibre = 0;} else {$promcalibre = $_POST['promcalibre'];}

	//----Valores de los pesos----///
	if (empty($peso1 = $_POST['peso1'])) {$peso1 = 0;} else {$peso1 = $_POST['peso1'];}
	if (empty($peso2 = $_POST['peso2'])) {$peso2 = 0;} else {$peso2 = $_POST['peso2'];}
	if (empty($peso3 = $_POST['peso3'])) {$peso3 = 0;} else {$peso3 = $_POST['peso3'];}
	if (empty($peso4 = $_POST['peso4'])) {$peso4 = 0;} else {$peso4 = $_POST['peso4'];}
	if (empty($prompeso = $_POST['prompeso'])) {$prompeso = 0;} else {$prompeso = $_POST['prompeso'];}

	// ---- Ancho ,Tratado y Peso --- //

	if (empty($ancho = $_POST['ancho'])) {$ancho = 0;} else {$ancho = $_POST['ancho'];}
	if (empty($tratado = $_POST['tratado'])) {$tratado = 0;} else {$tratado = $_POST['tratado'];}
	if (empty($peso = $_POST['peso'])) {$peso = 0;} else {$peso = $_POST['peso'];}

	// ---- Apariencia y Defecto ---- //
	$apariencia = $_POST['apariencia'];
	$defecto  = $_POST['defecto'];

	// --- Usuarios --- //
	$libero = $_POST['libero'];
	$coordinador  = $_POST['coordinador'];
	$observacion  = $_POST['observacion'];

	$iduser = $_SESSION['idusuario'];

	include '../../includes/dbconfig.php';
	include '../../model/extruder.php';

	echo "</br>";
	

	$cadena = "UPDATE controles_calidad  SET num_orden=$pedido,tipo_ext='$tipo_ext',num_mezcla=$num_mezcla,num_rollo=$num_rollo,fecha='$fecha',estado='$estado',calibre1=$calibre1,calibre2=$calibre2,calibre3=$calibre3,calibre4=$calibre4,promcalibre=$promcalibre,ancho=$ancho,tratado=$tratado,peso=$peso,apariencia='$apariencia',defecto='$defecto',peso1=$peso1,peso2=$peso2,peso3=$peso3,peso4=$peso4,prompeso=$prompeso,libero='$libero',coordinador='$coordinador',observacion='$observacion',Idusuario=$iduser WHERE Idcontrol_calidad='$idcontrol_cal';"; 
	echo $cadena;	
	sqlsrv_query($connSCPBD, $cadena);	
	sqlsrv_close( $connSCPBD );

	
	if ($estado == "pendiente") {
		header("Location:  controles_calidad.php");
	} else {
		header("Location:  term_controles_calidad.php");
	}

	//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../autenticacion/restrin.php';
  }
}else{

  include '../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>