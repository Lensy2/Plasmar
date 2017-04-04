<?php 
include '../../includes/dbconfig.php';
  $output = ''; 
  $query = "SELECT * FROM VReporte_Dispo_Final";
  $registros = sqlsrv_query($connSCPBD, $query);
    

     $output .= '
<table class="tg">
  <tr>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">FECHA</th>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">ORDEN</th>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">CLIENTE</th>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">OPERARIO</th>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">TIPO</th>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">REFERENCIA</th>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">DISPOSICION</th>
  </tr>
  ';
            while($fila = sqlsrv_fetch_object($registros))  
            {  
                 $output .= ' 
    <tr>';
     if (isset($fila->fecha)) {
      $output .= '<td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.date_format($fila->fecha, 'd/m/Y H:i:s').'</td>';   
    }else{
      $output .= '<td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">NULL</td>';   
    }
    $output .= '
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$fila->num_orden.'</td>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$fila->cliente.'</td>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$fila->operario_res.'</td>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$fila->tipo_inconf.'</td>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$fila->referencia.'</td>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$fila->dispo_final.'</td>
  </tr>
        ';  
            }  
            $output .= '</table>';  

            //Segundo Bloque
            header("Content-Type: application/xls");   
            header("Content-Disposition: attachment; filename=export_dispofinal.xls");  
            echo $output;  
