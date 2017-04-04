<?php 
 require_once '../../class/Reportes.php';
	if ($_GET['get']==1) {
	$rpt = new Reportes();
  $dataPorPersona = $rpt->listaPorPersona();

	 if (count($dataPorPersona)==0) {
	 	echo "No hay Data";
	 }else{
		 	/*Unificar primer registro con el listado*/
			 foreach ($dataPorPersona as $key => $value) {
				$arra1[] = array("operario_res" => $value['operario_res'], "total" => $value['Total']);
			}
			$rpt = new Reportes();
  		 	$dataPorPersona2 = $rpt->listaPorPersona2();

			$arra2[] = array("operario_res" => $dataPorPersona2['operario_res'], "total" => $dataPorPersona2['Total']);
			$arra_res = array_merge( $arra1 , $arra2 );
			
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
				foreach ($arra_res as $key => $value) {
					echo "<td>INCUMPLIMIENTO AL S.G.I</td>";
					echo "<td>".$value['operario_res']."</td>";
					echo "<td>".$value['total']."</td>";
				echo "</tr>";
				}
		echo "</tbody>
		</table></div>";
	 }	
}
?>