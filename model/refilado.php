<?php 
$totalInc = "SELECT Count(*) AS Total FROM ref_inconformidades";
$totalCR = "SELECT Count(*) AS Total FROM refilado_requisitos where estado = 'pendiente'";

$inconformidades_term ="SELECT * FROM dbo.ref_inconformidades ref inner join usuarios us on ref.Idusuario=us.Idusuario  order by fecha desc";

$requisitos_pen = "SELECT * FROM dbo.refilado_requisitos rr inner join usuarios us on rr.Idusuario=us.Idusuario where estado = 'pendiente' order by fecha desc";

$requisitos_apro = "SELECT * FROM dbo.refilado_requisitos rr inner join usuarios us on rr.Idusuario=us.Idusuario where estado = 'aprobado' order by fecha desc";

if (isset($Idinconf)) {
	$det_inconf = "SELECT * FROM ref_inconformidades inner join usuarios on ref_inconformidades.Idusuario=usuarios.Idusuario where Idref_inconformidades = '".$Idinconf."'";
}

if (isset($pedido)) {
$contadorRefi = "SELECT Count(*) AS Total FROM refilado_requisitos where num_orden = '$pedido'";

$comprobacionRefi= "SELECT
dbo.REFILADO.NIT, 
dbo.REFILADO.CODIGO,
dbo.VMERCIA_SERVICIO.DESCRIPCIO AS DESCRIPCIO, 
dbo.VMERCIA_SERVICIO.DESCRIP2 AS DESCRIP2, 
dbo.MTPROCLI.NOMBRE AS NOMBRE, 
dbo.MTPROCLI.NOMBRE1 AS NOMBRE1, 
dbo.MTPROCLI.NOMBRE2 AS NOMBRE2
FROM dbo.VMERCIA_SERVICIO INNER JOIN (dbo.REFILADO INNER JOIN dbo.MTPROCLI ON dbo.REFILADO.NIT = dbo.MTPROCLI.NIT) ON dbo.VMERCIA_SERVICIO.CODIGO = dbo.REFILADO.CODIGO where dbo.REFILADO.ORDENNRO ='$pedido'";


/*$leerRefi ='SELECT * FROM vORDEN_REFILADO WHERE ORDENNRO='.$pedido.'';*/
$leerRefi ="SELECT r.DESCRIPCIO, r.DESCRIP2, r.NOMBRE1, r.NOMBRE2, r.NOMBRE, r.ANCHO,
       		r.ANCHOG, r.ANCHOMN, r.ANCHOMX, r.CALIBRE, r.CALIBREMN, r.CALIBREMX,
       		r.CODIGO, r.DESTINO, r.EMBALAJE, r.FECHA, 
			REPLACE(REPLACE(r.FEMBOBINA,'\','/'),'//hestia/ofimatica','ftp://192.168.0.19') AS FEMBOBINA,
			r.FHENTREGA,
       		r.FHING, r.FHMOD, r.IDREFILADO, r.IMAGEN, r.KILOSPD, r.LARGOG,
       		r.NEMBOBINA, r.NIT, r.OBSERVA2, r.OBSERVA1, r.OBSERVA3, r.OBSERVA4,
       		r.OBSERVA5, r.OBSERVA6, r.ORDENNRO, r.PASO, r.PASOMN, r.PASOMX,
       		r.PEDIDO, r.PESOB, r.PESOBMN, r.PESOBMX, r.PESON, r.PESONMN, r.PESONMX,
       		r.RADIORLL, r.TARA, r.KTECORE, r.CONTAPA, r.USERING, r.USERMOD, r.CORE,
       		r.OBSERVA7, r.OBSERVA8, r.TIPOPED, r.MATERIAL, r.ALTURAS 
		FROM dbo.vORDEN_REFILADO_SCP r WHERE r.ORDENNRO='$pedido'";

}

 ?>
