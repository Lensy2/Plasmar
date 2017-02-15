<?php 
 require_once '../../class/Reportes.php';
	if ($_GET['get']==1) {
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

	 if (count($dataCalidad)==0) {
	 	echo "No hay Data";
	 }else{
		 	 echo "<br><div class='responsive-table'><table id='gridListaPorAfecta' class='table table-striped table-bordered' width='100%' cellspacing='0'>
			<thead>
				<tr>
					<th>Sistema Afectado</th>
					<th>Total</th>
				</tr>			
			</thead>
			<tbody>";			
				echo "<tr>";
					echo "<td>Calidad</td>";
					echo "<td>".$dataCalidad['Total']."</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>Ambiental</td>";
					echo "<td>".$dataAmbiental['Total']."</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>Inocuidad</td>";
					echo "<td>".$dataInocuidad['Total']."</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>SST</td>";
					echo "<td>".$dataSst['Total']."</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>Otro</td>";
					echo "<td>".$dataOtro['Total']."</td>";
				echo "</tr>";
		
		echo "</tbody>
		</table></div>";
	 }	
}
?>