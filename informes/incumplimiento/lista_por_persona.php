<?php 
 require_once '../../class/Reportes.php';
	if ($_GET['get']==1) {
	$rpt = new Reportes();
  $dataPorPersona = $rpt->listaPorPersona();

	 if (count($dataPorPersona)==0) {
	 	echo "No hay Data";
	 }else{
		 	 echo "<br><div class='responsive-table'><table id='gridListaPorPersona' class='table table-striped table-bordered' width='100%' cellspacing='0'>
			<thead>
				<tr>
					<th>Tipo</th>
					<th>Operario responsable</th>
					<th>Total</th>
				</tr>
			
			</thead>
			<tbody>";			
				echo "<tr>";
				foreach ($dataPorPersona as $key => $value) {
					echo "<td>INCUMPLIMIENTO AL S.G.I</td>";
					echo "<td>".$value['operario_res']."</td>";
					echo "<td>".$value['Total']."</td>";
				echo "</tr>";
			}		
			 $rpt = new Reportes();
  		 $dataPorPersona2 = $rpt->listaPorPersona2();
			echo "<tr>";
				echo "<td>INCUMPLIMIENTO AL S.G.I</td>";
				echo "<td>".$dataPorPersona2['operario_res']."</td>";
				echo "<td>".$dataPorPersona2['Total']."</td>";
			echo "</tr>";
		echo "</tbody>
		</table></div>";
	 }	
}
?>