<?php 
 require_once '../../class/Reportes.php';

	$rpt = new Reportes();
	$dataCalidad = $rpt->listaSAfectCalidad();

	$rpt = new Reportes();
	$dataAmbiental = $rpt->listaSAfectAmbiental();

	$rpt = new Reportes();
	$dataInocuidad = $rpt->listaSAfectInocuidad();

	$rpt = new Reportes();
	$dataSst = $rpt->listaSAfectSst();

	$rpt = new Reportes();
	$dataOtro = $rpt->listaSAfectOtro();

  $output = ''; 
     $output .= '
<table class="tg">
  <tr>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">CALIDAD</th>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$dataCalidad['Total'].'</td>
 </tr>
 <tr>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">AMBIENTAL</th>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$dataAmbiental['Total'].'</td>    
</tr>
<tr>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">INOCUIDAD</th>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$dataInocuidad['Total'].'</td>  
</tr>
<tr>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">SST</th>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$dataSst['Total'].'</td>
</tr>
<tr>
    <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">OTRO</th>
    <td style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">'.$dataOtro['Total'].'</td>
</tr>';  
      
            $output .= '</table>';  

            //Segundo Bloque
           header("Content-Type: application/xls");   
            header("Content-Disposition: attachment; filename=export_inc_sistema.xls");  
            echo $output;  
?>