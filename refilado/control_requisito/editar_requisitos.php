<?php
  //Incio primera parte validacion de Pagina y Usuario
  session_start();
  if (isset($_SESSION['usuario'])) {
    if (in_array('refilado', $_SESSION['paginas'])) {
  //Fin primera parte validacion de Pagina y Usuario
    $archivo = 'control_req';
    include '../../includes/funciones.php';
    $enlace = rutaRecursos('segundo_nivel');
  
    if (isset($_GET['pedido'])){
      $pedido = $_GET['pedido'];
      $id = $_GET['id'];
    }
    include '../../includes/dbconfig.php';
    include '../../model/refilado.php';
    include '../../includes/refilado/header.php';
    require_once  '../../class/Refilado.php';
    $orden_refilado = new Refilado();
    $dataOrden = $orden_refilado->getOrdenProduccion($_GET['pedido']);
    $dataRequisito = $orden_refilado->getDatosRequisito($id);
  ?>
  <style media="screen" type="text/css">
  .error{
     border: 1px solid rgba(215, 0, 0, 0.75);
     box-shadow:inset 0px 0px 2px 0px rgba(255, 0, 0, 0.75); 
  } 
  </style>
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Requisitos            
      <small>Control de Requisitos</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Requisitos</a></li>
      <li><a href="#">Control de requisitos</a></li>
      <li class="active">Editar</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"><i class="fa fa-pencil-square-o"></i> Editar</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?php
          $refilado = explode(',', $dataRequisito['refilado']);          
        ?>
        <!--- Descripcion General Orden de Laminacion -->
        <h3 align="center">Descripción General</h3>
        <br>
        <form id="update_requisito" method="post" accept-charset="utf-8">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>REFILADO N°</th>
                  <th>FECHA ENTREGA</th>
                  <th>CLIENTE</th>
                  <th>NIT</th>
                  <th>DESCRIPCION<input type="checkbox" class="chkplas" class="minimal" value="chk_descripcion" <?php if(in_array('chk_descripcion',$refilado)){echo 'checked="checked"';}?> name="chkrefilado[]" ></th>
                  <th>CODIGO<input type="checkbox" class="chkplas" class="minimal" value="chk_codigo" <?php if(in_array('chk_codigo',$refilado)){echo 'checked="checked"';}?> name="chkrefilado[]" ></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="hidden"  id="num_orden" name="num_orden" value='<?php echo trim($dataOrden['PEDIDO']); ?>'><?php echo trim($dataOrden['PEDIDO']); ?></td>
                  <td><?php echo date_format($dataOrden['FHENTREGA'], 'd/m/y') ?></td>
                  <td><?php echo $dataOrden['NOMBRE']; ?></td>
                  <td><?php echo $dataOrden['NIT']; ?></td>
                  <td><?php echo $dataOrden['DESCRIPCIO']."-".$dataOrden['DESCRIP2']; ?></td>
                  <td><?php echo $dataOrden['CODIGO']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!--- Detalles Orden de Produccion Laminacion -->
          <h3 align="center">Detalles</h3>
          <br>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>DESTINO</th>
                  <th>Kg PEDIDOS</th>
                  <th>RADIO DE LOS ROLLOS</th>
                  <th colspan="4" style="text-align: center;">TAMAÑO DE LA GUIA</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $dataOrden['DESTINO']; ?></td>
                  <td><?php echo $dataOrden['KILOSPD']; ?></td>
                  <td><?php echo $dataOrden['RADIORLL']; ?></td>
                  <th>Ancho (mm)</th>
                  <td><?php echo $dataOrden['ANCHOG']; ?></td>
                  <th>Largo (mm)</th>
                  <td><?php echo $dataOrden['LARGOG']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!--- Detalles Orden de Produccion Laminacion -->
          <br>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>FECHA DE REFILADO</th>
                  <th>KILOS REFILADOS</th>
                  <th>TIPO DE PEDIDO<input type="checkbox" class="chkplas" class="minimal" value="chk_pedido" <?php if(in_array('chk_pedido',$refilado)){echo 'checked="checked"';}?> name="chkrefilado[]" ></th>
                  <th>TIPO DE MATERIAL<input type="checkbox" class="chkplas" class="minimal" value="chk_material" <?php if(in_array('chk_material',$refilado)){echo 'checked="checked"';}?>  name="chkrefilado[]" ></th>
                  <th>ALTURA DE LA IMPRESION<input type="checkbox" class="chkplas" class="minimal" value="chk_impresion" <?php if(in_array('chk_impresion',$refilado)){echo 'checked="checked"';}?> name="chkrefilado[]" ></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $fechabien = date_format($dataRequisito['fechare'], 'd/m/Y H:i:s');
                ?>
                <tr>
                  <td><input class="form-control" data-format="dd/MM/yyyy hh:mm:ss" id="fechrefi" name="fechrefi" required type="text" value="<?php echo $fechabien ?>"></td>
                  <td><input type="text" class="form-control" id="krefi" value="<?php echo $dataRequisito['kilos'] ?>"  name="krefi" required></td>
                  <td><?php echo $dataOrden['TIPOPED']; ?></td>
                  <td><?php echo $dataOrden['MATERIAL']; ?></td>
                  <td><?php echo $dataOrden['ALTURAS']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!--- Espsificaciones Orden de Produccion Impresion -->
          <h3 align="center">Especificaciones</h3>
          <br>
          <div class="row">
            <div class="col-md-4">
              <h4 align="center">ANCHO BOBINA (cms)<input type="checkbox" class="chkplas" class="minimal" value="chk_bobina" <?php if(in_array('chk_bobina',$refilado)){echo 'checked="checked"';}?>name="chkrefilado[]" ></h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>MIN</th>
                      <th>OBJ</th>
                      <th>MAX</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><?php echo $dataOrden['ANCHOMN']; ?></td>
                    <td><?php echo $dataOrden['ANCHO']; ?></td>
                    <td><?php echo $dataOrden['ANCHOMX']; ?></td>
                    </tr>          
                  </tbody>
                </table>
              </div>
              <input class="form-control" id="ancho_bobina" required="" type="text" value="<?php echo $dataRequisito['ancho_bobina'] ?>">
              </div>
            <div class="col-md-4">
              <h4 align="center">PASO ENTRE GUIAS (cms)<input type="checkbox" class="chkplas" class="minimal" value="chk_paso"  <?php if(in_array('chk_paso',$refilado)){echo 'checked="checked"';}?>name="chkrefilado[]" ></h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>MIN</th>
                      <th>OBJ</th>
                      <th>MAX</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $dataOrden['PASOMN']; ?></td>
                      <td><?php echo $dataOrden['PASO']; ?></td>
                      <td><?php echo $dataOrden['PASOMX']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div><input class="form-control" id="peso_guias" required="" type="text" value="<?php echo $dataRequisito['peso_guias'] ?>">
            </div>
            <div class="col-md-4">
              <h4 align="center">CALIBRE (mp)</h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>MIN</th>
                      <th>OBJ</th>
                      <th>MAX</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $dataOrden['CALIBREMN']; ?></td>
                      <td><?php echo $dataOrden['CALIBRE']; ?></td>
                      <td><?php echo $dataOrden['CALIBREMX']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <br><br>
          <!--- Espsificaciones Orden de Produccion Impresion -->
          <div class="row">
            <div class="col-md-4">
              <h4 align="center">PESO BRUTO ROLLO (Kg)</h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>MIN</th>
                      <th>OBJ</th>
                      <th>MAX</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $dataOrden['PESOBMN']; ?></td>
                      <td><?php echo $dataOrden['PESOB']; ?></td>
                      <td><?php echo $dataOrden['PESOBMX']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-4">
              <h4 align="center">PESO NETO ROLLO (Kg)</h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>MIN</th>
                      <th>OBJ</th>
                      <th>MAX</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $dataOrden['PESONMN']; ?></td>
                      <td><?php echo $dataOrden['PESON']; ?></td>
                      <td><?php echo $dataOrden['PESONMX']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-4">
              <h4 align="center">EMBALAJE </h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <td style="text-align: center;"><?php echo $dataOrden['EMBALAJE']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <br><br>
          <?php 
            //Ruta Imgs Montaje
            $rutaMon = $dataOrden['FEMBOBINA'];
           $rutaMonLimpia = trim($rutaMon);
              $imgFinal = strtolower($rutaMonLimpia);
              $numMon = rutaMontaje($imgFinal);          
            $imgMontaje = "<img src='$numMon'/>";
            
            ?>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>MONTAJE<input type="checkbox" class="chkplas" class="minimal" value="chk_montaje" <?php if(in_array('chk_montaje',$refilado)){echo 'checked="checked"';}?> name="chkrefilado[]" ></th>
                    <th>OBSERVACIONES</th>
                  </tr>
                <tbody>
                  <tr>
                    <td><?php echo $imgMontaje ?></td>
                    <td><?php echo $dataOrden['OBSERVA1'].", ".$dataOrden['OBSERVA2'].", ".$dataOrden['OBSERVA3'].", ".$dataOrden['OBSERVA4'].", ".$dataOrden['OBSERVA5'].", ".$dataOrden['OBSERVA6'].", ".$dataOrden['OBSERVA7'].", ".$dataOrden['OBSERVA8']?></td>
                  </tr>
                </tbody>
                </thead> 
              </table>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                   
                    <th>OBSERVACIONES DE CALIDAD</th>
                  </tr>
                <tbody>
                  <tr>
                    <td>
                      <?php
                       $n = $dataOrden['NIT'];
                          $NIT = trim($n);
                           $cod = $dataOrden['CODIGO'];
                          $CODIGO = trim($cod);

                           $orden_refilado = new Refilado();
                          $dataObsCalidad1 = $orden_refilado->getObsCalidadFirst($NIT,$CODIGO);
                          echo $dataObsCalidad1['OBSERVACIO'];
echo "<br>";
                          $orden_refilado = new Refilado();
                          $dataObsCalidad = $orden_refilado->getObsCalidad($NIT,$CODIGO);
                          foreach ($dataObsCalidad as $key => $value) {
                            echo $value['OBSERVACIO']."<br>";
                          }
                      ?>
                    </td>
                  </tr>
                </tbody>
                </thead> 
              </table>
            </div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>MEDIDA DE CORE</th>
                  </tr>
                <tbody>
                  <tr>
                    <td><?php echo $dataOrden['CORE'];?> Pulgadas</td>
                  </tr>
                </tbody>
                </thead> 
              </table>
            </div>
          </div>
          <?php $plano = rutaPlano($dataOrden['CODIGO']);?>
          <div class="row">
            <div class="col-xs-4">
            <label>Maquina refiladora </label> <select class="form-control" id="maquina_ref" required="">
                    <option <?php if ($dataRequisito['maquina_ref'] == 1) echo  'selected'; ?> value="1">
                      1
                    </option>
                    <option <?php if ($dataRequisito['maquina_ref'] == 2) echo  'selected'; ?> value="2">
                      2
                    </option>
                    <option <?php if ($dataRequisito['maquina_ref'] == 3) echo  'selected';?> value="3">
                      3
                    </option>
                    <option <?php if ($dataRequisito['maquina_ref'] == 4) echo  'selected';?> value="4">
                      4
                    </option>
                    <option <?php if ($dataRequisito['maquina_ref'] == 5) echo  'selected';  ?> value="5">5
                    </option>
                    <option <?php if ($dataRequisito['maquina_ref'] == 6) echo  'selected'; ?> value="6">
                      6
                    </option>
                    <option <?php if ($dataRequisito['maquina_ref'] == 7) echo  'selected'; ?> value="7">
                      7
                    </option>
                    <option <?php if ($dataRequisito['maquina_ref'] == 8) echo  'selected'; ?> value="8">
                      8
                    </option>
                  </select>
              <label>Tiempo de Curado</label>
              <input  type="text" class="form-control"  value="<?php echo $dataRequisito['tcurado'] ?>" name="tcurado" id="tcurado" required> 
              <label>Gramos/m2</label>
              <input  type="text" class="form-control"  value="<?php echo $dataRequisito['gramosm'] ?>" name="gramosm" id="gramosm" required>
                <h4><b>Acumulado: </b><span class="label label-primary">
                      
                      <?php 
                       $orden_refilado = new Refilado();
                       $dataKilos = $orden_refilado->getSumaKilos($_GET['pedido']);
                       echo $dataKilos['kilos_pesados'];

                      ?> KG
                    </span></h4>
              <label>Kilos pesados</label> 
              <input class="form-control" id="kilos_p" name="kilos_p" value="<?php echo $dataRequisito['kilos_p'] ?>" required="" type="number">
              <b>Operario responsable</b>
              <i id="limpiar" style="cursor: pointer;" class="fa fa-times"></i><br><br>
              <input id="operarios" type="text" class="form-control" placeholder="Nombre Operario" value="<?php echo $dataRequisito['operario']?>" name="operario" required> 
            </div>
            </form>
            <div class="col-xs-9">
              <br>
              <div class="col-md-2">
              <button class="btn btn-block btn-primary" id="btnUpAprobar">Aprobar</button> 
              </div>
              <div class="col-md-2">                
                <button class="btn btn-block btn-primary" id="btnUpGuardar">Guardar</button>
              </div>
              <div class="col-md-2">
                <a class="btn btn-block btn-primary" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/impresion/premontajes/premontajes.php" style="text-decoration: none;">Cancelar</a>
              </div>
            </div>
          </div>
        
        <input id="id_requisito" type="hidden" value="<?php echo $dataRequisito['Idrefilado_requisitos'] ?>"> 
        <input id="id_usuario" type="hidden" value="<?php echo $_SESSION['idusuario'] ?>"> 
       
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- =============================================== -->
<div class="modal fade" id="modalPlano" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-fw fa-warning"></i>Plano Mecanico</small></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <img src="ftp://192.168.0.5/PlanoMecanico/Pruebas/JPG PRODUCCION/<?php echo $plano ?>.jpg" style="max-width: 100%;">
        </div>
      </div>
      <div class="modal-footer">
        <a href="ftp://192.168.0.5/PlanoMecanico/Pruebas/JPG PRODUCCION/<?php echo $plano ?>.jpg" target="blank"><button type="button" class="btn btn-primary">Abrir en nueva pestaña</button></a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<?php include '../../includes/refilado/footer.php';
  //Incio segunda parte validacion de Pagina y Usuario
    }else{
      include '../../autenticacion/restrin.php';
    }
  }else{
  
    include '../../autenticacion/no_acceso.php';
  }
  //Fin segunda parte validacion de Pagina y Usuario
  
   ?>