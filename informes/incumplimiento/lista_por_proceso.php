<?php 
 require_once '../../class/Reportes.php';
 $rpt = new Reportes();

if ($_GET['get']==1) {
 $dataPorProceso = $rpt->listaPorProceso();

	 if (count($dataPorProceso)==0) {
	 	echo "No hay Data";
	 }else{
		 	 echo "<br><div class='responsive-table'><table id='gridListaPorProceso' class='table table-striped table-bordered' width='100%' cellspacing='0'>
			<thead>
				<tr>
					<th>Tipo</th>
					<th>Proceso o Area</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>";
			foreach ($dataPorProceso as $key => $value) {
				echo "<t>";
					echo "<td>INCUMPLIMIENTO AL S.G.I</td>";
					echo "<td>".$value['tipo_proceso']."</td>";
					echo "<td>".$value['Total']."</td>";
				echo "</tr>";
			}
			$rpt = new Reportes();
  		 $dataPorProceso2 = $rpt->listaPorProceso2();
			echo "<tr>";
				echo "<td>INCUMPLIMIENTO AL S.G.I</td>";
				echo "<td>".$dataPorProceso2['tipo_proceso']."</td>";
				echo "<td>".$dataPorProceso2['Total']."</td>";
			echo "</tr>";
		echo "</tbody>
		</table></div>";
	 }	
}
?>