<?php 
$totalCR = "SELECT Count(*) AS Total FROM sellado_requisitos where estado = 'pendiente'";
$totalInc = "SELECT Count(*) AS Total FROM sell_inconformidades";
$requisitos_pen = "SELECT * FROM dbo.sellado_requisitos sr inner join usuarios us on sr.Idusuario=us.Idusuario where estado = 'pendiente' order by fecha desc";

$inconformidades_term ="SELECT * FROM dbo.sell_inconformidades sell inner join usuarios us on sell.Idusuario=us.Idusuario  order by fecha desc";

$requisitos_apro = "SELECT * FROM dbo.sellado_requisitos sr inner join usuarios us on sr.Idusuario=us.Idusuario where estado = 'aprobado' order by fecha desc";

if (isset($Idinconf)) {
	$det_inconf = "SELECT * FROM sell_inconformidades inner join usuarios on sell_inconformidades.Idusuario=usuarios.Idusuario where Idsell_inconformidades = '".$Idinconf."'";
}

if (isset($pedido)) {
$contadorSell = "SELECT Count(*) AS Total FROM sellado_requisitos where num_orden = '$pedido'";
$contadorSellRequisitos = "SELECT Count(*) AS Total FROM sellado_requisitos where num_orden = '$pedido'";

$comprobacionSell= "SELECT
dbo.SELLADO.CODIGO,
dbo.SELLADO.NIT,
dbo.MTPROCLI.NOMBRE, 
dbo.MTPROCLI.NOMBRE1, 
dbo.MTPROCLI.NOMBRE2, 
dbo.VMERCIA_SERVICIO.DESCRIPCIO, 
dbo.VMERCIA_SERVICIO.DESCRIP2
FROM dbo.VMERCIA_SERVICIO INNER JOIN (dbo.SELLADO INNER JOIN dbo.MTPROCLI ON dbo.SELLADO.NIT = dbo.MTPROCLI.NIT) ON dbo.VMERCIA_SERVICIO.CODIGO = dbo.SELLADO.CODIGO where dbo.SELLADO.ORDENNRO ='$pedido'";

$leerSell='SELECT dbo.SELLADO.ALTBOLSA,
dbo.SELLADO.ALTCENTRO, 
dbo.SELLADO.ALTURACEN, 
dbo.SELLADO.ALTURADEB, 
dbo.SELLADO.ALTURADER, 
dbo.SELLADO.ALTURAENC, 
dbo.SELLADO.ALTURAIZQ, 
dbo.SELLADO.ANCHO, 
dbo.SELLADO.ANCHOFLL, 
dbo.SELLADO.ANCHOMN, 
dbo.SELLADO.ANCHOMX, 
dbo.SELLADO.ANCHOSOL, 
dbo.SELLADO.BOLSASPD,
dbo.SELLADO.CALIBRE, 
dbo.SELLADO.CALIBREMN, 
dbo.SELLADO.CALIBREMX, 
dbo.SELLADO.CODIGO, 
dbo.SELLADO.DIAMETRO, 
dbo.SELLADO.DIAMETROF, 
dbo.SELLADO.DIAMETROS, 
dbo.SELLADO.EMPXBUL, 
dbo.SELLADO.EMPXPAQ, 
dbo.SELLADO.FECHA, 
dbo.SELLADO.FHENTREGA, 
dbo.SELLADO.FHING, 
dbo.SELLADO.FHMOD, 
dbo.SELLADO.FTIPOBOCA, 
dbo.SELLADO.IDSELLADO, 
dbo.SELLADO.IMAGEN, 
dbo.SELLADO.KILOSPD, 
dbo.SELLADO.LARGO, 
dbo.SELLADO.LARGOMN, 
dbo.SELLADO.LARGOMX, 
dbo.SELLADO.MEDIDAS, 
dbo.SELLADO.NIT, 
dbo.SELLADO.OBSERVA1, 
dbo.SELLADO.OBSERVA2, 
dbo.SELLADO.OBSERVA3, 
dbo.SELLADO.OBSERVA4, 
dbo.SELLADO.OBSERVA5, 
dbo.SELLADO.OBSERVA6, 
dbo.SELLADO.ORDENNRO, 
dbo.SELLADO.PASOPREC1, 
dbo.SELLADO.PASOPREC2, 
dbo.SELLADO.PEDIDO, 
dbo.SELLADO.PERFORAS, 
dbo.SELLADO.PERFORASF, 
dbo.SELLADO.PERFORASS, 
dbo.SELLADO.PESOCAJA, 
dbo.SELLADO.PESOPB, 
dbo.SELLADO.PESOXPAQ, 
dbo.SELLADO.PRECORTE, 
dbo.SELLADO.TIPOBOCA, 
dbo.SELLADO.TIPOFLL, 
dbo.SELLADO.TIPOSLL, 
dbo.SELLADO.TIPOSOL, 
dbo.SELLADO.TIPOTRQ, 
dbo.SELLADO.TPRODUCTO, 
dbo.SELLADO.UNDANCHO, 
dbo.SELLADO.UNDLARGO, 
dbo.SELLADO.USERING, 
dbo.SELLADO.USERMOD, 
dbo.SELLADO.VELSELLE, 
dbo.SELLADO.MAQUINA, 
dbo.SELLADO.UNDTURNO, 
dbo.SELLADO.OBSERVA7, 
dbo.SELLADO.OBSERVA8, 
dbo.SELLADO.TIPOPED, 
dbo.SELLADO.MATERIAL, 
dbo.MTPROCLI.NOMBRE, 
dbo.MTPROCLI.NOMBRE1, 
dbo.MTPROCLI.NOMBRE2, 
dbo.VMERCIA_SERVICIO.DESCRIPCIO, 
dbo.VMERCIA_SERVICIO.DESCRIP2
FROM dbo.VMERCIA_SERVICIO INNER JOIN (dbo.SELLADO INNER JOIN dbo.MTPROCLI ON dbo.SELLADO.NIT = dbo.MTPROCLI.NIT) ON dbo.VMERCIA_SERVICIO.CODIGO = dbo.SELLADO.CODIGO  WHERE ORDENNRO ='.$pedido.'';}
 ?>
