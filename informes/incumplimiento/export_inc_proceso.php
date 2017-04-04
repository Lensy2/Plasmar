<?php 
 require_once '../../class/Reportes.php';

 $rpt = new Reportes();
  $dataPorProceso = $rpt->listaPorProceso();
/*Unificar primer registro con el listado*/
foreach ($dataPorProceso as $key => $value) {
				$arra1[] = array("tipo_proceso" => $value['tipo_proceso'], "total" => $value['Total']);
			}
			$rpt = new Reportes();
  		 	$dataPorProceso2 = $rpt->listaPorProceso2();

			$arra2[] = array("tipo_proceso" => $dataPorProceso2['tipo_proceso'], "total" => $dataPorProceso2['Total']);
			$arra_res = array_merge( $arra1 , $arra2 );

  $output = ''; 
     $output .= '
<table class="tg">
  <tr>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">TIPO</th>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">PROCESO</th>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">TOTAL</th>
   </tr>
  ';
         foreach ($arra_res as $key => $value)
            {  
                 $output .= ' 
    <tr>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">INCUMPLIMIENTO AL S.G.I</td>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$value['tipo_proceso'].'</td>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$value['total'].'</td></tr> ';  
            }  
            $output .= '</table>';  

            //Segundo Bloque
           header("Content-Type: application/xls");   
            header("Content-Disposition: attachment; filename=export_inc_proceso.xls");  
            echo $output;  
?>