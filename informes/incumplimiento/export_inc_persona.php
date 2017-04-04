<?php 
 require_once '../../class/Reportes.php';

 $rpt = new Reportes();
  $dataPorPersona = $rpt->listaPorPersona();
/*Unificar primer registro con el listado*/
foreach ($dataPorPersona as $key => $value) {
				$arra1[] = array("operario_res" => $value['operario_res'], "total" => $value['Total']);
			}
			$rpt = new Reportes();
  		 	$dataPorPersona2 = $rpt->listaPorPersona2();

			$arra2[] = array("operario_res" => $dataPorPersona2['operario_res'], "total" => $dataPorPersona2['Total']);
			$arra_res = array_merge( $arra1 , $arra2 );

  $output = ''; 
     $output .= '
<table class="tg">
  <tr>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">TIPO</th>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">OPERARIO</th>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">TOTAL</th>
   </tr>
  ';
         foreach ($arra_res as $key => $value)
            {  
                 $output .= ' 
    <tr>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">INCUMPLIMIENTO AL S.G.I</td>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$value['operario_res'].'</td>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$value['total'].'</td></tr> ';  
            }  
            $output .= '</table>';  

            //Segundo Bloque
           header("Content-Type: application/xls");   
            header("Content-Disposition: attachment; filename=export_inc_persona.xls");  
            echo $output;  
?>