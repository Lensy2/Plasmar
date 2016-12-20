<?php
	
	$listaUsuarios = "SELECT * FROM dbo.Usuarios WHERE estado_us = 1";

	$totalUsuarios = "SELECT Count(*) AS Total FROM Usuarios WHERE estado_us = 1";

?>