<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
  $archivo = 'nuevo_control_req';
  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel'); 

if (isset($_GET['pedido']) && $_GET['tipo_ext'])
{
    $pedido = $_GET['pedido'];
    $tipo_ext = $_GET['tipo_ext'];
    $num_mezcla = $_GET['idmezcla'];
}
  include '../../includes/dbconfig.php';
  include '../../includes/extruder/header.php'; 
  include '../../model/extruder.php';

if ($tipo_ext == 'ext_normal'){
    $tipoTabla = $leerExt;
}
elseif ($tipo_ext == 'ext_laminacion'){
    $tipoTabla = $leerExtL;
}

//--- Consulta del pedido en las tablas de extrusion o extrusionl ----//
$registrosExt = sqlsrv_query($connPlas, $tipoTabla);
$fila = sqlsrv_fetch_object($registrosExt);

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Extruder            
        <small>Control De Requisitos</small>
      </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Extrusion</a></li>
            <li><a href="#">Control De Requisitos</a></li>
            <li class="active">Nuevo</li>
          </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Default box -->
      <div class="box">            
        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-fw fa-plus-circle"></i>Nuevo - Control de requisito</h3>
        </div><!-- /.box-header -->
        <div class="box-body">

            <form action="procesar_control_requisito.php" method="post" accept-charset="utf-8">

              <!-- Variable oculta: Numero de Orden -->
              <input type="hidden" name="num_orden" value="<?php echo $pedido; ?>">
              <!-- Variable oculta: Tipo de Extrusion -->
              <input type="hidden" name="tipo_ext" value="<?php echo $tipo_ext; ?>">              
              <!-- Variable oculta: Num Mezcla -->
              <input type="hidden" name="num_mezcla" value="<?php echo $num_mezcla; ?>">

              <table class="table table-bordered table-hover">
                <tr>
                  <td>
                    <b>EXTRUSION No</b>
                    <input type="checkbox" class="chkplas" class="chkplas" id="chk1" value="chk_num_orden"  name="chkRequisito[]" ><br> 
                    <?php echo $fila->PEDIDO; ?>
                  </td>

                  <td>
                    <b>FECHA DE ENTREGA</b><br>
                    <?php echo date_format($fila->FHENTREGA, 'd/m/y') ?><br><br><br>
                  </td>

                  <td>
                    <b>CLIENTE</b> 
                    <br><?php echo $fila->CLIENTE ?> <br><br>
                  </td>

                  <td>
                    <b>NIT</b><br> 
                    <?php echo $fila->NIT ?><br><br>
                  </td>

                </tr>
                <tr>
                  <td colspan="4">
                  <?php echo $fila->CODIGO ?>
                    <b>DESCRIPCION REFERENCIA</b> 
                    <?php echo $fila->DESCRIPCION." ".$fila->DESCRIPCION2 ?> <br><br>
                  </td>
                </tr>

              </table>

              <table class="table table-bordered table-hover">
                <tr>
                  <td>
                    <b>EXTRUSORA No </b>
                      <input type="checkbox" class="chkplas" class="chkplas"   id="chk2" value="chk_extrusura" class="chkplas" name="chkRequisito[]">
                      <br><?php echo $fila->EXTRUSORA ?> <br>
                  </td>

                  <td>
                    <b>KG PEDIDOS </b>
                    <input type="checkbox" class="chkplas" class="chkplas" id="chk3" value="chk_kgpedidos" class="chkplas" name="chkRequisito[]"><br>
                    <?php echo $fila->KGPEDIDOS?><br><br>
                  </td>

                  <td>
                    <b>PESO MAX BOBINA (Kg) </b>
                    <?php echo $fila->PESOMAXBOBINA ?> <br><br>
                  </td>

                  <td>
                    <b>RADIO DE BOBINA (cms)</b>
                    <?php echo $fila->RADIODEBOBINA?><br><br>
                  </td>

                  <td colspan="2">
                    <b>CARACTERISTICAS </b> 
                    <input type="checkbox" class="chkplas" class="chkplas" id="chk4"  value="chk_caracteristicas" name="chkRequisito[]"><br>
                    <?php echo $fila->CARACTERISTICA?>
                  </td>

                  <td>
                    <b>FUELLE </b>
                    <input type="checkbox" class="chkplas" class="chkplas" id="chk5"  value="chk_fuelle" name="chkRequisito[]"><br>
                    <?php echo $fila->FUELLE ?><br><br><br>
                  </td>

                </tr> 

                <tr> 
                  <td>
                    <b>PRESENTACION </b>
                    <input type="checkbox" class="chkplas" class="chkplas" id="chk6"  value="chk_presentacion" name="chkRequisito[]"><br>
                    <?php echo $fila->PRESENTACION ?> <br><br>
                  </td>

                  <td>
                    <b>USO EMPAQUES </b><br>
                    <?php echo $fila->USOEMPAQUE ?><br><br>
                  </td>

                  <td>
                    <b>CORTE(cms) </b><br> 
                    <?php echo $fila->CORTE1 ." - ".$fila->CORTE2 ?><br>
                  </td>

                  <td>
                    <b>TRATAMIENTO </b>
                    <input type="checkbox" class="chkplas" class="chkplas" id="chk7"  value="chk_tratamiento" name="chkRequisito[]"><br>
                    <?php echo $fila->TRATAMTO ?> <br>
                  </td>

                  <td>
                    <b>DINAS </b>
                    <input type="checkbox" class="chkplas" class="chkplas" id="chk8"  value="chk_dinas" name="chkRequisito[]"><br>
                    <?php echo $fila->DINAS ?> <br><br>
                  </td>

                  <td>
                    <b>PLATINAS </b>
                    <input type="checkbox" class="chkplas" class="chkplas" id="chk9"  value="chk_platinas" name="chkRequisito[]"><br>
                    <?php echo $fila->PLATINA ?><br>
                  </td>

                  <td>
                    <b>GRAFILADO </b>
                    <input type="checkbox" class="chkplas" class="chkplas" id="chk10"  value="chk_grafilado" name="chkRequisito[]"><br>
                    <?php if ($fila->GRAFILADO == 0) {echo "NO";}else{echo "SI";}?><br><br>
                  </td><br>

                </tr>
              </table>

              <table class="table table-bordered table-hover">
                <tr>
                    <td>
                      <b>OBSERVACIONES DEL PRODUCTO</b>
                      <input type="checkbox" class="chkplas" class="chkplas" id="chk11"  value="chk_obsproducto" name="chkRequisito[]"><br>
                      <?php echo $fila->OBSERVA1. $fila->OBSERVA2. $fila->OBSERVA3. $fila->OBSERVA4. $fila->OBSERVA5. $fila->OBSERVA6. $fila->OBSERVA7. $fila->OBSERVA8?><br>
                    </td>

                    <td>
                      <b>DESTINO</b>
                      <input type="checkbox" class="chkplas" class="chkplas" id="chk12"  value="chk_destino" name="chkRequisito[]"><br>
                      <?php echo $fila->DESTINO ?><br><br>
                    </td>

                    <td>
                      <b>TIPO DE PEDIDO</b>
                      <input type="checkbox" class="chkplas" class="chkplas" id="chk13"  value="chk_tipo_ped" name="chkRequisito[]"><br>
                      <?php echo $fila->TIPOPED ?><br><br>
                    </td>                    
                </tr>
                <tr>
                    <td colspan="3">
                    <?php $obsCal = "SELECT * FROM dbo.EXTRUSION ext inner join  dbo.OBSCALIDAD cal on ext.NIT = cal.NIT where ext.NIT = '$fila->NIT' and proceso = 'EXTRUSION' and ext.ORDENNRO = '$pedido'";
                         $queryCal = sqlsrv_query($connPlas,$obsCal);
                    ?>

                      <b>OBSERVACIONES DE CALIDAD</b>
                      <input type="checkbox" class="chkplas" class="chkplas" id="chk14"  value="chk_obscalidad" name="chkRequisito[]"><br>

                      <?php 
                        while($row = sqlsrv_fetch_object($queryCal))
                          {
                            echo $row->OBSERVACIO."<br>";
                          }
                      ?>
                    </td><br>
                </tr>

              </table>  
                            
              <div class="row">
                <div class="col-xs-4">
                   <b>Operario responsable</b>
                      <i id="limpiar" style="cursor: pointer;" class="fa fa-times"></i><br><br>
                      <input id="operarios" type="text" class="form-control" placeholder="Nombre Operario" name="op_res" required> 
                </div>
                <div class="col-xs-9">
                    <br>
                    <div class="col-md-2">
                      <input type="submit" class="btn btn-block btn-primary" id="chkrequisitos" name="aprob" value="Aprobar" disabled="disabled">
                    </div>                  
                    <div class="col-md-2">
                      <input type="submit" class="btn btn-block btn-primary" name="guarda" value="Guardar">
                    </div>                      
                    <div class="col-md-2">
                      <a class="btn btn-block btn-primary" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/extruder/control_mezclas/controles_mezclas.php" style="text-decoration: none;">Cancelar</a>
                    </div>
                  </div>
              </div>

            </form>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

<!-- =============================================== -->

<?php
  sqlsrv_close( $connPlas );
?>
<?php include '../../includes/extruder/footer.php';
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
 ?>