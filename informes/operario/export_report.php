<?php 
include '../../includes/dbconfig.php';
  $output = ''; 
  $query = "SELECT * FROM VReporte_Top10_Operarios";
  $registros = sqlsrv_query($connSCPBD, $query);
    

     $output .= '
<table class="tg">
  <tr>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">OPERARIO</th>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">TOTAL</th>
    </tr>
  ';
            while($fila = sqlsrv_fetch_object($registros))  
            {  
                 $output .= ' 
    <tr>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$fila->operario_res.'</td>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$fila->Total.'</td>
   </tr>
        ';  
            }  
            $output .= '</table>';  

            //Segundo Bloque
            header("Content-Type: application/xls");   
            header("Content-Disposition: attachment; filename=export_top10_operario.xls");  
            echo $output;  
