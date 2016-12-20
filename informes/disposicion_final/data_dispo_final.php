<?php


		function crearConsulta($proceso,$dispo,$fechaInicial,$fechaFinal)
		{
			include '../../includes/dbconfig.php';	

			$fechaInicial = date('d/m/Y', strtotime($_GET['inicial']));
			$fechaFinal = date('d/m/Y', strtotime($_GET['final']));
			switch ($dispo) {
			    case 'concesion':
			      $query = "SELECT Count(*) AS ".$proceso."_concesion FROM ".$proceso."_inconformidades WHERE dispo_final ='Concesion'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;
			    
			    case 'reproceso':
			      $query = "SELECT Count(*) AS ".$proceso."_reproceso FROM ".$proceso."_inconformidades WHERE dispo_final ='Re-Proceso'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

			    case 'desechar':
			      $query = "SELECT Count(*) AS ".$proceso."_desechar FROM ".$proceso."_inconformidades WHERE dispo_final ='Desechar'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

  			}

  			$resultado = sqlsrv_query($connSCPBD, $query);
			$row = sqlsrv_fetch_array($resultado);

  			return ($row);
		}

		function crearConsultaFoto($proceso,$dispo,$fechaInicial,$fechaFinal)
		{
			include '../../includes/dbconfig.php';	

			$fechaInicial = date('d/m/Y', strtotime($_GET['inicial']));
			$fechaFinal = date('d/m/Y', strtotime($_GET['final']));
			switch ($dispo) {
			    case 'concesion':
			      $query = "SELECT Count(*) AS ".$proceso."_concesion FROM foto_multas WHERE dispo_final ='Concesion'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;
			    
			    case 'reproceso':
			      $query = "SELECT Count(*) AS ".$proceso."_reproceso FROM foto_multas WHERE dispo_final ='Re-Proceso'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

			    case 'desechar':
			      $query = "SELECT Count(*) AS ".$proceso."_desechar FROM foto_multas WHERE dispo_final ='Desechar'  AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
			      break;

  			}

  			$resultado = sqlsrv_query($connSCPBD, $query);
			$row = sqlsrv_fetch_array($resultado);

  			return ($row);
		}

		//Resultados Concesion
		$fila = crearConsulta('ext','concesion',$_GET['inicial'],$_GET['final']);
		$fila1 = crearConsulta('imp','concesion',$_GET['inicial'],$_GET['final']);
		$fila2 = crearConsulta('lam','concesion',$_GET['inicial'],$_GET['final']);
		$fila3 = crearConsulta('ref','concesion',$_GET['inicial'],$_GET['final']);
		$fila4 = crearConsulta('sell','concesion',$_GET['inicial'],$_GET['final']);
		$fila5 = crearConsultaFoto('foto','concesion',$_GET['inicial'],$_GET['final']);

		//Resultados Re-Proceso
		$fila6 = crearConsulta('ext','reproceso',$_GET['inicial'],$_GET['final']);
		$fila7 = crearConsulta('imp','reproceso',$_GET['inicial'],$_GET['final']);
		$fila8 = crearConsulta('lam','reproceso',$_GET['inicial'],$_GET['final']);
		$fila9 = crearConsulta('ref','reproceso',$_GET['inicial'],$_GET['final']);
		$fila10 = crearConsulta('sell','reproceso',$_GET['inicial'],$_GET['final']);
		$fila11 = crearConsultaFoto('foto','reproceso',$_GET['inicial'],$_GET['final']);

		//Resultados Desechar
		$fila12 = crearConsulta('ext','desechar',$_GET['inicial'],$_GET['final']);
		$fila13 = crearConsulta('imp','desechar',$_GET['inicial'],$_GET['final']);
		$fila14 = crearConsulta('lam','desechar',$_GET['inicial'],$_GET['final']);
		$fila15 = crearConsulta('ref','desechar',$_GET['inicial'],$_GET['final']);
		$fila16 = crearConsulta('sell','desechar',$_GET['inicial'],$_GET['final']);
		$fila17 = crearConsultaFoto('foto','desechar',$_GET['inicial'],$_GET['final']);

		$total_Concesion = $fila['ext_concesion']+$fila1['imp_concesion']+$fila2['lam_concesion']+$fila3['ref_concesion']+$fila4['sell_concesion']+$fila5['foto_concesion'];
		$total_Re_proceso = $fila6['ext_reproceso']+$fila7['imp_reproceso']+$fila8['lam_reproceso']+$fila9['ref_reproceso']+$fila10['sell_reproceso']+$fila11['foto_reproceso'];
		$total_Desechar = $fila12['ext_desechar']+$fila13['imp_desechar']+$fila14['lam_desechar']+$fila15['ref_desechar']+$fila16['sell_desechar']+$fila17['foto_desechar'];

		

		$dispoFinal = array();
		$dispoFinal = array('total_concesion' => $total_Concesion, 'total_reproceso' => $total_Re_proceso, 'total_desechar' => $total_Desechar);

		$json_string = json_encode($dispoFinal);
		echo $json_string;

?>