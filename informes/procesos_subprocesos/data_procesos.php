<?php
		function crearSubProcesos($subproces,$fechaInicial,$fechaFinal)
		{
			include '../../includes/dbconfig.php';
			$fechaInicial = date('d/m/Y', strtotime($_GET['inicial']));
			$fechaFinal = date('d/m/Y', strtotime($_GET['final']));
			switch ($subproces) {
			    case 'calidad':
			      $query = "SELECT Count(*) AS ".$subproces."_total FROM foto_multas WHERE tipo_proceso ='CALIDAD'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;
			    
			    case 'desarrollo':
			      $query = "SELECT Count(*) AS ".$subproces."_total FROM foto_multas WHERE tipo_proceso ='DESARROLLO'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

			    case 'elab_orden':
			      $query = "SELECT Count(*) AS ".$subproces."_total FROM foto_multas WHERE tipo_proceso ='ELABORACION ORDEN'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

			    case 'enfuellado':
			      $query = "SELECT Count(*) AS ".$subproces."_total FROM foto_multas WHERE tipo_proceso ='ENFUELLADO'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

			    case 'fotopolimero':
			      $query = "SELECT Count(*) AS ".$subproces."_total FROM foto_multas WHERE tipo_proceso ='FOTOPOLIMERO'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

			    case 'mantenimiento':
			      $query = "SELECT Count(*) AS ".$subproces."_total FROM foto_multas WHERE tipo_proceso ='MANTENIMIENTO'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

			    case 'maquina':
			      $query = "SELECT Count(*) AS ".$subproces."_total FROM foto_multas WHERE tipo_proceso ='MAQUINA'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

			    case 'premontaje':
			      $query = "SELECT Count(*) AS ".$subproces."_total FROM foto_multas WHERE tipo_proceso ='PREMONTAJE'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

			    case 'proceso':
			      $query = "SELECT Count(*) AS ".$subproces."_total FROM foto_multas WHERE tipo_proceso ='PROCESO'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

			    case 'produccion':
			      $query = "SELECT Count(*) AS ".$subproces."_total FROM foto_multas WHERE tipo_proceso ='PRODUCCION '  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

			    case 'proveedor':
			      $query = "SELECT Count(*) AS ".$subproces."_total FROM foto_multas WHERE tipo_proceso ='PROVEEDOR'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

  			}

  			$resultado = sqlsrv_query($connSCPBD, $query);
			$row = sqlsrv_fetch_array($resultado);

  			return ($row);
		}

		function crearProcesos($proceso,$fechaInicial,$fechaFinal)
		{
			include '../../includes/dbconfig.php';
			$fechaInicial = date('d/m/Y', strtotime($_GET['inicial']));
			$fechaFinal = date('d/m/Y', strtotime($_GET['final']));
			switch ($proceso) {
			    case 'ext':
			      $query = "SELECT Count(*) AS ".$proceso."_total FROM ext_inconformidades WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;
			    
			    case 'imp':
			      $query = "SELECT Count(*) AS ".$proceso."_total FROM imp_inconformidades WHERE  fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

			    case 'lam':
			      $query = "SELECT Count(*) AS ".$proceso."_total FROM lam_inconformidades WHERE  fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

			     case 'ref':
			      $query = "SELECT Count(*) AS ".$proceso."_total FROM ref_inconformidades WHERE  fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

			     case 'sell':
			      $query = "SELECT Count(*) AS ".$proceso."_total FROM sell_inconformidades WHERE  fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

  			}

  			$resultado = sqlsrv_query($connSCPBD, $query);
			$row = sqlsrv_fetch_array($resultado);

  			return ($row);
		}

		//Resultados Sub Procesos
		$fila = crearSubProcesos('calidad',$_GET['inicial'],$_GET['final']);
		$fila1 = crearSubProcesos('desarrollo',$_GET['inicial'],$_GET['final']);
		$fila2 = crearSubProcesos('elab_orden',$_GET['inicial'],$_GET['final']);
		$fila3 = crearSubProcesos('enfuellado',$_GET['inicial'],$_GET['final']);
		$fila4 = crearSubProcesos('fotopolimero',$_GET['inicial'],$_GET['final']);
		$fila5 = crearSubProcesos('mantenimiento',$_GET['inicial'],$_GET['final']);
		$fila6 = crearSubProcesos('maquina',$_GET['inicial'],$_GET['final']);
		$fila7 = crearSubProcesos('premontaje',$_GET['inicial'],$_GET['final']);
		$fila8 = crearSubProcesos('proceso',$_GET['inicial'],$_GET['final']);
		$fila9 = crearSubProcesos('produccion',$_GET['inicial'],$_GET['final']);
		$fila10 = crearSubProcesos('proveedor',$_GET['inicial'],$_GET['final']);

		//Resultados Procesos	
		$fila11 = crearProcesos('ext',$_GET['inicial'],$_GET['final']);
		$fila12 = crearProcesos('imp',$_GET['inicial'],$_GET['final']);
		$fila13 = crearProcesos('lam',$_GET['inicial'],$_GET['final']);
		$fila14 = crearProcesos('ref',$_GET['inicial'],$_GET['final']);
		$fila15 = crearProcesos('sell',$_GET['inicial'],$_GET['final']);


		$listaProces = array();
		$listaProces = array('calidad_total' => $fila['calidad_total'], 'desarrollo_total' => $fila1['desarrollo_total'], 'elab_orden_total' => $fila2['elab_orden_total'], 'enfuellado_total' => $fila3['enfuellado_total'], 'fotopolimero_total' => $fila4['fotopolimero_total'], 'mantenimiento_total' => $fila5['mantenimiento_total'], 'maquina_total' => $fila6['maquina_total'], 'premontaje_total' => $fila7['premontaje_total'], 'proceso_total' => $fila8['proceso_total'], 'produccion_total' => $fila9['produccion_total'], 'proveedor_total' =>$fila10['proveedor_total'], 'ext_total' =>$fila11['ext_total'], 'imp_total' =>$fila12['imp_total'], 'lam_total' => $fila13['lam_total'], 'ref_total' => $fila14['ref_total'], 'sell_total' => $fila15['sell_total'],);

		$json_string = json_encode($listaProces);
		echo $json_string;

?>