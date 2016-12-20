<?php 
	$totalFotom = "SELECT Count(*) AS Total FROM foto_multas";
	/*$fotom_term ="SELECT * FROM dbo.foto_multas fotom inner join usuarios us on fotom.Idusuario=us.Idusuario  order by fecha desc";*/
	$fotom_term ="SELECT ROW_NUMBER() OVER (ORDER BY fotom.fecha desc) AS IdEvento,  * FROM dbo.foto_multas fotom inner join usuarios us on fotom.Idusuario=us.Idusuario  order by Idfoto_multas DESC";

	if (isset($Idfotom)) {
	$det_fotom = "SELECT * FROM foto_multas inner join usuarios on foto_multas.Idusuario=usuarios.Idusuario where Idfoto_multas = '".$Idfotom."'";
		
}

 ?>