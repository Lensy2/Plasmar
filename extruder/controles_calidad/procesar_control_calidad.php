<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

// Esta funcion recibe como parametro la ultima insercion realizada (Query insertControlM en control de mezclas) en la tabla control de mezclas y devuelve este id, 
	function lastInsertId($queryID) {
		sqlsrv_next_result($queryID);
		sqlsrv_fetch($queryID);
		return sqlsrv_get_field($queryID, 0);
	}
	// --- Identifica el valor del submit y asigna el estado --- //
	if (isset($_POST['guarda'])) {
		$estado = "pendiente";
	}
	elseif (isset($_POST['termin'])) {
	 	$estado = "terminado";
	}elseif (isset($_POST['inc-guardar'])) {
		$estado = "pendiente";
	}elseif (isset($_POST['inc-terminar'])) {
		$estado = "terminado";
	}

	// --- Variables tabla control_calidad --- //
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
	if (isset( $_POST['defecto'])) {
		$defecto = $_POST['defecto'];
	}else{
		$defecto = '';
	}

	// --- Usuarios --- //
	$libero = $_POST['libero'];
	$coordinador  = $_POST['coordinador'];
	$observacion  = $_POST['observacion'];

	$iduser = $_SESSION['idusuario'];

	include '../../includes/dbconfig.php';
	include '../../model/extruder.php';

	echo "</br>";
	
	$cadena = "INSERT INTO controles_calidad (num_orden,tipo_ext,num_mezcla,num_rollo,fecha,estado,calibre1,calibre2,calibre3,calibre4,promcalibre,ancho,tratado,peso,apariencia,defecto,peso1,peso2,peso3,peso4,prompeso,libero,coordinador,observacion,Idusuario) VALUES ($pedido,'$tipo_ext',$num_mezcla,$num_rollo,'$fecha','$estado',$calibre1,$calibre2,$calibre3,$calibre4,$promcalibre,$ancho,$tratado,$peso,'$apariencia','$defecto',$peso1,$peso2,$peso3,$peso4,$prompeso,'$libero','$coordinador','$observacion',$iduser);";
	//echo $cadena;	

	$cadena .= "; SELECT SCOPE_IDENTITY() AS IDENTITY_COLUMN_NAME"; 
	// --- Ejecucion de la query de insercion en tabla control de mezclas --- //
	$insertControlM = sqlsrv_query($connSCPBD, $cadena);	
	// -- Obtenemos el id de la ultima insercion en la tabla control de mezcla --/
	$ultimoid = lastInsertId($insertControlM);
	// -- Validarmos si se ejecuto correctamente la consulta --- //
	echo "<input type='hidden' name='ulid' value=".$ultimoid.">";

	if ($insertControlM) {
		echo "¡Inconformidad almacenada correctamente!";
	} else {
		echo "!Error alamacenando inconformidad!";
	}
	

	sqlsrv_close( $connSCPBD );

		//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>
