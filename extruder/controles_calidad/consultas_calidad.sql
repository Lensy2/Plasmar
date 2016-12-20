-- Tablas para generar listas deplegables dentro del formulario de Calidad
select * from dbo.LIBERAN
select * from dbo.COORDINAN
select * from dbo.DEFECTOS
-- ////////////////////////////////////

select ROLLO, CTRABAJO from dbo.ETQPLASMAR where PEDIDO = 100048 and CTRABAJO like 'EXL'
--Rollos EXT en dbo.etqplasmar
/*
151006632 
151006633
151006729
151006730
*/
--Rollos EXT en dbo.etqplasmar
/*
151015735 
151015736 
151015806 
151015807 
--- Los rollo de abajo no tienen calidad
151016574 
151016592 
151018526 
151034041 
151036618 
*/
select * from dbo.CALIDADEXT where PEDIDO = 100048
--Rollos EXT en dbo.calidadext
/*
151006632 
151006633
151006729
151006730
*/
--Rollos EXL en dbo.calidadext
/*
151015735 
151015736 
151015806 
151015807
/*
--Si el pedido es tipo ext_laminacion listar todos los rollo cuando CTRABAJO es igual a EXL
--Si el pedido es tipo ext_normal listar todos los rollo cuando CTRABAJO es igual a EXT

/*
PESON = peso neto
PEDIDO O ORDENNRO = # de pedido
-- REFERENCIA ---
CODIGO = referencia
DESCRIP1 = titulo superior
DESCRIP2 = titulo inferior
-- CLIENTE ---
NIT = nit
NOMBRECLI = nombre de cliente*/

select * from ETQPLASMAR where rollo = 14940749
select * from dbo.CALIDADEXT where ROLLO = 14940749 --and PEDIDO = 97191 
select NOMBRE, COORDINA from dbo.COORDINAN  where COORDINA = 98695078