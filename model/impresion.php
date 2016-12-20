<?php 
$progImpresionAD = "SELECT TPE.*,M.PRODUCTO,m2.DESCRIPCIO FROM dbo.tblProgImpresion AS tpe INNER JOIN dbo.MVTRADE AS m ON TPE.OrdenNro=m.NRODCTO
	INNER	JOIN dbo.MTMERCIA AS m2 ON m2.CODIGO = m.PRODUCTO
WHERE tpe.TipoReg='AD'
AND tpe.Habilitado=1 AND M.TIPODCTO='PD' AND m.ORIGEN='FAC'
ORDER BY  tpe.OrdenEjec";
$progImpresionBD = "SELECT TPE.*,M.PRODUCTO,m2.DESCRIPCIO FROM dbo.tblProgImpresion AS tpe INNER JOIN dbo.MVTRADE AS m ON TPE.OrdenNro=m.NRODCTO
	INNER	JOIN dbo.MTMERCIA AS m2 ON m2.CODIGO = m.PRODUCTO
WHERE tpe.TipoReg='BD'
AND tpe.Habilitado=1 AND M.TIPODCTO='PD' AND m.ORIGEN='FAC'
ORDER BY  tpe.OrdenEjec";

$totalInc = "SELECT Count(*) AS Total FROM imp_inconformidades";
$totalPrem = "SELECT Count(*) AS Total FROM premontajes where estado = 'pendiente'";
$totalImpReq = "SELECT Count(*) AS Total FROM impresion_requisitos where estado = 'pendiente'";
$totalCmImp = "SELECT Count(*) AS Total FROM cm_impresor where estado_imp = 'aprobado'";
$totalCmMat = "SELECT Count(*) AS Total FROM cm_matizador where estado_mat = 'aprobado'";
$totalCmAna = "SELECT Count(*) AS Total FROM cm_analista where estado_ana = 'pendiente'";
$totalCmSup = "SELECT Count(*) AS Total FROM cm_supervisor where estado_sup = 'pendiente'";
$totalLimp = "SELECT Count(*) AS Total FROM impresion_limpiezas";
$totalLimp = "SELECT Count(*) AS Total FROM impresion_limpiezas";

$inconformidades_term ="SELECT * FROM dbo.imp_inconformidades imp inner join usuarios us on imp.Idusuario=us.Idusuario  order by fecha desc";

$limpiezas_term = "SELECT * FROM dbo.impresion_limpiezas il inner join usuarios us on il.Idusuario=us.Idusuario  order by fecha desc";

$premontaje_pen = "SELECT * FROM dbo.premontajes cc inner join usuarios us on cc.Idusuario=us.Idusuario where estado = 'pendiente' order by fecha desc";

$premontaje_apro = "SELECT * FROM dbo.premontajes cc inner join usuarios us on cc.Idusuario=us.Idusuario where estado = 'aprobado' order by fecha desc";

$requisito_pen = "SELECT * FROM dbo.impresion_requisitos cc inner join usuarios us on cc.Idusuario=us.Idusuario where estado = 'pendiente' order by fecha desc";

$requisito_apro = "SELECT * FROM dbo.impresion_requisitos cc inner join usuarios us on cc.Idusuario=us.Idusuario where estado = 'aprobado' order by fecha desc";

$control_muestra = "SELECT * FROM dbo.cm_impresor cc inner join usuarios us on cc.Idusuario=us.Idusuario where estado_imp = 'aprobado' order by fecha desc";


$control_matizador = "SELECT * FROM dbo.cm_matizador cc inner join usuarios us on cc.Idusuario=us.Idusuario where estado_mat = 'aprobado' order by fecha desc";

$control_anali_apro = "SELECT * FROM dbo.cm_analista cc inner join usuarios us on cc.Idusuario=us.Idusuario where estado_ana = 'aprobado' order by fecha desc";
$control_analista = "SELECT * FROM dbo.cm_analista cc inner join usuarios us on cc.Idusuario=us.Idusuario where estado_ana = 'pendiente' order by fecha desc";


$control_super_apro = "SELECT * FROM dbo.cm_supervisor cc inner join usuarios us on cc.Idusuario=us.Idusuario where estado_sup = 'aprobado' order by fecha desc";
$control_supervisor = "SELECT * FROM dbo.cm_supervisor cc inner join usuarios us on cc.Idusuario=us.Idusuario where estado_sup = 'pendiente' order by fecha desc";

if (isset($Idinconf)) {
	$det_inconf = "SELECT * FROM imp_inconformidades inner join usuarios on imp_inconformidades.Idusuario=usuarios.Idusuario where Idimp_inconformidades = '".$Idinconf."'";
}


if (isset($pedido)) {
$contadorCMSup = "SELECT Count(*) AS Total FROM cm_supervisor where num_orden = '$pedido'";
$contadorCMAna = "SELECT Count(*) AS Total FROM cm_analista where num_orden = '$pedido'";
$contadorCMMat = "SELECT Count(*) AS Total FROM cm_matizador where num_orden = '$pedido'";
$contadorCMImp = "SELECT Count(*) AS Total FROM cm_impresor where num_orden = '$pedido'";
$contadorImpRequisitos = "SELECT Count(*) AS Total FROM impresion_requisitos where num_orden = '$pedido'";
$contadorPremontajes = "SELECT Count(*) AS Total FROM premontajes where num_orden = '$pedido'";

	
$comprobacionImp = "SELECT * FROM (dbo.VMERCIA_SERVICIO INNER JOIN (dbo.IMPRESION INNER JOIN dbo.MTPROCLI ON dbo.IMPRESION.NIT = dbo.MTPROCLI.NIT)
ON dbo.VMERCIA_SERVICIO.CODIGO = dbo.IMPRESION.CODIGO) INNER JOIN dbo.CYRELESMJ ON dbo.IMPRESION.ORDENNRO = dbo.CYRELESMJ.ORDENNRO
WHERE ((dbo.IMPRESION.ORDENNRO) = '$pedido')";

$leerImp = 'SELECT dbo.CYRELESMJ.CARAS1,
dbo.CYRELESMJ.CARAS2,
dbo.CYRELESMJ.CARAS3, 
dbo.CYRELESMJ.CARAS4, 
dbo.CYRELESMJ.CARAS5,
dbo.CYRELESMJ.CARAS6, 
dbo.CYRELESMJ.CARAS7, 
dbo.CYRELESMJ.CARAS8, 
dbo.CYRELESMJ.CODIGO, 
dbo.CYRELESMJ.COLOR1, 
dbo.CYRELESMJ.COLOR2, 
dbo.CYRELESMJ.COLOR3, 
dbo.CYRELESMJ.COLOR4, 
dbo.CYRELESMJ.COLOR5, 
dbo.CYRELESMJ.COLOR6, 
dbo.CYRELESMJ.COLOR7, 
dbo.CYRELESMJ.COLOR8, 
dbo.CYRELESMJ.CYREL1, 
dbo.CYRELESMJ.CYREL2, 
dbo.CYRELESMJ.CYREL3, 
dbo.CYRELESMJ.CYREL4, 
dbo.CYRELESMJ.CYREL5, 
dbo.CYRELESMJ.CYREL6, 
dbo.CYRELESMJ.CYREL7, 
dbo.CYRELESMJ.CYREL8, 
dbo.CYRELESMJ.FEMBOBINA, 
dbo.CYRELESMJ.IDCYREL, 
dbo.CYRELESMJ.KILOS1, 
dbo.CYRELESMJ.KILOS2, 
dbo.CYRELESMJ.KILOS3, 
dbo.CYRELESMJ.KILOS4, 
dbo.CYRELESMJ.KILOS5, 
dbo.CYRELESMJ.KILOS6, 
dbo.CYRELESMJ.KILOS7, 
dbo.CYRELESMJ.KILOS8, 
dbo.CYRELESMJ.LINEAT1,
dbo.CYRELESMJ.LINEAT2, 
dbo.CYRELESMJ.LINEAT3, 
dbo.CYRELESMJ.LINEAT4,
dbo.CYRELESMJ.LINEAT5,
dbo.CYRELESMJ.LINEAT6, 
dbo.CYRELESMJ.LINEAT7, 
dbo.CYRELESMJ.LINEAT8,
dbo.CYRELESMJ.MONTAJE,
dbo.CYRELESMJ.NEMBOBINA, 
dbo.CYRELESMJ.ORDENNRO, 
dbo.CYRELESMJ.PINON, 
dbo.CYRELESMJ.RODILLO, 
dbo.CYRELESMJ.RSTICK1, 
dbo.CYRELESMJ.RSTICK2, 
dbo.CYRELESMJ.RSTICK3, 
dbo.CYRELESMJ.RSTICK4, 
dbo.CYRELESMJ.RSTICK5, 
dbo.CYRELESMJ.RSTICK6, 
dbo.CYRELESMJ.RSTICK7, 
dbo.CYRELESMJ.RSTICK8, 
dbo.CYRELESMJ.T11, 
dbo.CYRELESMJ.T12, 
dbo.CYRELESMJ.T13, 
dbo.CYRELESMJ.T14, 
dbo.CYRELESMJ.T15, 
dbo.CYRELESMJ.T21,
dbo.CYRELESMJ.T22, 
dbo.CYRELESMJ.T23, 
dbo.CYRELESMJ.T24, 
dbo.CYRELESMJ.T25, 
dbo.CYRELESMJ.T31, 
dbo.CYRELESMJ.T32, 
dbo.CYRELESMJ.T33, 
dbo.CYRELESMJ.T34, 
dbo.CYRELESMJ.T35, 
dbo.CYRELESMJ.T41,
dbo.CYRELESMJ.T42, 
dbo.CYRELESMJ.T43, 
dbo.CYRELESMJ.T44, 
dbo.CYRELESMJ.T45, 
dbo.CYRELESMJ.T51, 
dbo.CYRELESMJ.T52, 
dbo.CYRELESMJ.T53, 
dbo.CYRELESMJ.T54, 
dbo.CYRELESMJ.T55,
dbo.CYRELESMJ.T61, 
dbo.CYRELESMJ.T62, 
dbo.CYRELESMJ.T63,
dbo.CYRELESMJ.T64, 
dbo.CYRELESMJ.T65, 
dbo.CYRELESMJ.T71,
dbo.CYRELESMJ.T72, 
dbo.CYRELESMJ.T73, 
dbo.CYRELESMJ.T74, 
dbo.CYRELESMJ.T75, 
dbo.CYRELESMJ.T81, 
dbo.CYRELESMJ.T82, 
dbo.CYRELESMJ.T83, 
dbo.CYRELESMJ.T84, 
dbo.CYRELESMJ.T85, 
dbo.CYRELESMJ.TMONTAJE, 
dbo.CYRELESMJ.VISCO1,
dbo.CYRELESMJ.VISCO2, 
dbo.CYRELESMJ.VISCO3, 
dbo.CYRELESMJ.VISCO4, 
dbo.CYRELESMJ.VISCO5, 
dbo.CYRELESMJ.VISCO6,
dbo.CYRELESMJ.VISCO7, 
dbo.CYRELESMJ.VISCO8, 
dbo.IMPRESION.ALTCENTRO, 
dbo.IMPRESION.ALTURA, 
dbo.IMPRESION.ALTURACEN, 
dbo.IMPRESION.ALTURADEB, 
dbo.IMPRESION.ALTURADER,
dbo.IMPRESION.ALTURAENC, 
dbo.IMPRESION.ALTURAIZQ, 
dbo.IMPRESION.ANCHO, 
dbo.IMPRESION.ANCHOFT, 
dbo.IMPRESION.ANCHOMN, 
dbo.IMPRESION.ANCHOMX, 
dbo.IMPRESION.ANCHOPRES, 
dbo.IMPRESION.BARRAS, 
dbo.IMPRESION.BOCA, 
dbo.IMPRESION.CALIBRE,
dbo.IMPRESION.CALIBREMN, 
dbo.IMPRESION.CALIBREMX, 
dbo.IMPRESION.CODIGO,
dbo.IMPRESION.COLORES, 
dbo.IMPRESION.COLORESEN, 
dbo.IMPRESION.CONRAYA, 
dbo.IMPRESION.DESTINO, 
dbo.IMPRESION.ESPECIFIC, 
dbo.IMPRESION.FECHA, 
dbo.IMPRESION.FHENTREGA, 
dbo.IMPRESION.FHING, 
dbo.IMPRESION.FHMOD, 
dbo.IMPRESION.IDIMPRES, 
dbo.IMPRESION.IMAGEN, 
dbo.IMPRESION.IMPRESORA, 
dbo.IMPRESION.KILOSPD,
dbo.IMPRESION.LADOFOTOC, 
dbo.IMPRESION.LARGO, 
dbo.IMPRESION.LARGOFT, 
dbo.IMPRESION.LARGOMN, 
dbo.IMPRESION.LARGOMX, 
dbo.IMPRESION.LINEACORTA, 
dbo.IMPRESION.LOGOTIPO, 
dbo.IMPRESION.LONGPRES, 
dbo.IMPRESION.NIT, 
dbo.IMPRESION.OBSERVA1,
dbo.IMPRESION.OBSERVA2, 
dbo.IMPRESION.OBSERVA3,
dbo.IMPRESION.OBSERVA4, 
dbo.IMPRESION.OBSERVA5, 
dbo.IMPRESION.OBSERVA6, 
dbo.IMPRESION.ORDENNRO, 
dbo.IMPRESION.PEDIDO,
dbo.IMPRESION.PRESENTA, 
dbo.IMPRESION.TIPOALT,
dbo.IMPRESION.TIPOIMP, 
dbo.IMPRESION.TIPOMON, 
dbo.IMPRESION.TIPOPED, 
dbo.IMPRESION.TIPOTINTA, 
dbo.IMPRESION.USERING,
dbo.IMPRESION.USERMOD,
dbo.IMPRESION.MATERIAL, 
dbo.IMPRESION.VELMAQ,
dbo.VMERCIA_SERVICIO.DESCRIPCIO, 
dbo.VMERCIA_SERVICIO.DESCRIP2, 
dbo.MTPROCLI.NOMBRE, 
dbo.MTPROCLI.NOMBRE1, 
dbo.MTPROCLI.NOMBRE2
FROM (dbo.VMERCIA_SERVICIO INNER JOIN (dbo.IMPRESION INNER JOIN dbo.MTPROCLI ON dbo.IMPRESION.NIT = dbo.MTPROCLI.NIT)
ON dbo.VMERCIA_SERVICIO.CODIGO = dbo.IMPRESION.CODIGO) INNER JOIN dbo.CYRELESMJ ON dbo.IMPRESION.ORDENNRO = dbo.CYRELESMJ.ORDENNRO
WHERE ((dbo.IMPRESION.ORDENNRO) = '.$pedido.')';
}




?>