<?php
  //Incio primera parte validacion de Pagina y Usuario
  session_start();
  if (isset($_SESSION['usuario'])) {
    if (in_array('sellado', $_SESSION['paginas'])) {
  //Fin primera parte validacion de Pagina y Usuario
    $archivo = 'control_req'; 
    include '../../includes/funciones.php';
    $enlace = rutaRecursos('segundo_nivel');
  
    if (isset($_GET['pedido'])){
      $pedido = $_GET['pedido'];
      $id = $_GET['id'];
    }
     
    include '../../includes/dbconfig.php';
    include '../../model/sellado.php';
    include '../../includes/sellado/header.php';

    require_once  '../../class/Sellado.php';
    $orden_sellado = new Sellado();
    $dataOrden = $orden_sellado->getOrdenProduccion($_GET['pedido']);
    $dataRequisito = $orden_sellado->getDatosRequisito($id);
    
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
      <small>Control De Requisitos</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Requisitos</a></li>
      <li><a href="#">Control De Requisitos</a></li>
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
          $sellado = explode(',', $dataRequisito['sellado']);
          //Ruta Imgs Boca
          $rutaBoc = substr($dataOrden['FTIPOBOCA'], 2);
          $rutaBocLimpia = trim($rutaBoc); 
          $imgFinal = strtolower($rutaBocLimpia);
          $nomBoc = rutaBoca($imgFinal);
          $imgBoca = "<img src='ftp://hestia/Plasmar/Producci/$nomBoc'/>";
          
          ?> 
        <!--- Descripcion General Orden de Laminacion -->
        <h3 align="center">Descripción General</h3>
        <br>
        <form action="procesar_requisitos.php" method="post" accept-charset="utf-8">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Sellado N°</th>
                  <th>Fecha Entrega</th>
                  <th>Cliente</th>
                  <th>NIT</th>
                  <th>Descripción<input type="checkbox" class="chkplas" class="minimal" value="chk_descripcion" <?php if(in_array('chk_descripcion',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
                  <th>Codigo</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="hidden" id="num_orden" value='<?php echo $dataOrden['PEDIDO']; ?>'><?php echo $dataOrden['ORDENNRO']; ?></td>
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
                  <th>MEDIDAS DE LA BOLSA</th>
                  <th>Kg PEDIDOS<input type="checkbox" class="chkplas" class="minimal" value="chk_kgpedidos" <?php if(in_array('chk_kgpedidos',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
                  <th>BOLSAS PEDIDAS<input type="checkbox" class="chkplas" class="minimal" value="chk_bolsas" <?php if(in_array('chk_bolsas',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
                  <th>VELOCIDAD SELLADO (UNI X MIN)<input type="checkbox" class="chkplas" class="minimal" value="chk_velocidad" <?php if(in_array('chk_velocidad',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
                  <th>BOCA POR</th>
                  <th>BOCA</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $dataOrden['MEDIDAS']; ?></td>
                  <td><?php echo $dataOrden['KILOSPD']; ?></td>
                  <td><?php echo $dataOrden['BOLSASPD']; ?></td>
                  <td><?php echo $dataOrden['VELSELLE']; ?></td>
                  <td><?php echo $dataOrden['TIPOBOCA']; ?></td>
                  <td><?php echo $imgBoca?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!--- Espsificaciones Orden de Produccion Impresion -->
          <h3 align="center">Especificaciones</h3>
          <br>
          <div class="row">
            <div class="col-md-4">
              <h4 align="center">ANCHO (cms)<input type="checkbox" class="chkplas" class="minimal" value="chk_ancho" <?php if(in_array('chk_ancho',$sellado)){echo 'checked="checked"';}?> name="chkrefilado[]" ></h4>
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
                    <td><?php echo $dataOrden['ANCHOMN']; ?></td>
                    <td><?php echo $dataOrden['ANCHO']; ?></td>
                    <td><?php echo $dataOrden['ANCHOMX']; ?></td>
                    </tr>          
                  </tbody>
                </table>
              </div><input class="form-control" id="ancho" required="" type="text" value="<?php echo $dataRequisito['ancho'] ?>">
            </div>
            <div class="col-md-4">
              <h4 align="center">LARGO (cms)<input type="checkbox" class="chkplas" class="minimal" value="chk_largo" <?php if(in_array('chk_largo',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></h4>
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
                      <td><?php echo $dataOrden['LARGOMN']; ?></td>
                      <td><?php echo $dataOrden['LARGO']; ?></td>
                      <td><?php echo $dataOrden['LARGOMX']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div><input class="form-control" id="largo" required="" type="text" value="<?php echo $dataRequisito['largo'] ?>">
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
          <!--- Caracteristicas Orden de Produccion Laminacion -->
          <h3 align="center">Caracteristicas</h3>
          <br>
          <div class="row">
            <div class="col-md-12">
              <h4 align="center">ALTURAS SELLE</h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>IZQ</th>
                      <th>DER</th>
                      <th>ENC</th>
                      <th>DEB</th>
                      <th>CEN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $dataOrden['ALTURAIZQ']; ?></td>
                      <td><?php echo $dataOrden['ALTURADER']; ?></td>
                      <td><?php echo $dataOrden['ALTURAENC']; ?></td>
                      <td><?php echo $dataOrden['ALTURADEB']; ?></td>
                      <td><?php echo $dataOrden['ALTURACEN']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ANCHO FUELLE (cms)</th>
                  <th>TIPO FUELLE</th>
                  <th>ANCHO SOLAPA</th>
                  <th>TIPO DE SOLAPA</th>
                  <th>TIPO DE SELLADO<input type="checkbox" class="chkplas" class="minimal" value="chk_sellado" <?php if(in_array('chk_sellado',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
                  <th>TIPO TROQUEL<input type="checkbox" class="chkplas" class="minimal" value="chk_troquel" <?php if(in_array('chk_troquel',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $dataOrden['ANCHOFLL']; ?></td>
                  <td><?php echo $dataOrden['TIPOFLL']; ?></td>
                  <td><?php echo $dataOrden['ANCHOSOL']; ?></td>
                  <td><?php echo $dataOrden['TIPOSOL']; ?></td>
                  <td><?php echo $dataOrden['TIPOSLL']; ?></td>
                  <td><?php echo $dataOrden['TIPOTRQ']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!--- Caracteristicas Orden de Produccion Sellado -->
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th>PERFORACIONES<input type="checkbox" class="chkplas" class="minimal" value="chk_perforaciones" <?php if(in_array('chk_perforaciones',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
                    <td><?php echo $dataOrden['PERFORAS']; ?></td>
                    <th>DIAMETRO<input type="checkbox" class="chkplas" class="minimal" value="chk_diametro" <?php if(in_array('chk_diametro',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
                    <td><?php echo $dataOrden['DIAMETRO']; ?></td>
                    <th>EMPAQUES X PAQUETE<input type="checkbox" class="chkplas" class="minimal" value="chk_empaque" <?php if(in_array('chk_empaque',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
                    <td><?php echo $dataOrden['EMPXPAQ']; ?></td>
                  </tr>
                  <tr>
                    <th>PERFORACIONES FONDO</th>
                    <td><?php echo $dataOrden['PERFORASF']; ?></td>
                    <th>DIAMETRO</th>
                    <td><?php echo $dataOrden['DIAMETROS']; ?></td>
                    <th>EMPAQUES X BULTO</th>
                    <td><?php echo $dataOrden['EMPXBUL']; ?></td>
                  </tr>
                  <tr>
                    <th>PERFORACIONES SOLAPA</th>
                    <td><?php echo $dataOrden['PERFORASS']; ?></td>
                    <th>DIAMETRO</th>
                    <td><?php echo $dataOrden['DIAMETROS']; ?></td>
                    <th>PESO PAQUETE</th>
                    <td><?php echo $dataOrden['PESOXPAQ']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>PRECORTE</th>
                    <th>PASO DEL PRECORTE</th>
                    <th>MAQUINA</th>
                    <th>UD/TURNO</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $dataOrden['PRECORTE']; ?></td>
                    <td><?php echo $dataOrden['PASOPREC1']." - ".$dataOrden['PASOPREC2']; ?></td>
                    <td><?php echo $dataOrden['MAQUINA']; ?></td>
                    <td><?php echo $dataOrden['UNDTURNO']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>FECHA DE SELLADO</th>
                    <th>BLS SELLADAS</th>
                    <th>TIPO PEDIDO</th>
                    <th>MATERIAL</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $fechabien = date_format($dataRequisito['fechase'], 'd/m/Y H:i:s');
                ?>
                  <tr>
                   <td><input class="form-control" data-format="dd/MM/yyyy hh:mm:ss" id="fechase" name="fechase" required="" type="text" value="<?php echo $fechabien ?>"></td>
                    <td></td>
                    <td><?php echo $dataOrden['TIPOPED']; ?></td>
                    <td ><?php echo $dataOrden['MATERIAL']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>OBSERVACIONES</th>
                  </tr>
                <tbody>
                  <tr>
                    <td><?php echo $dataOrden['OBSERVA1'].", ".$dataOrden['OBSERVA2'].", ".$dataOrden['OBSERVA3'].", ".$dataOrden['OBSERVA4'].", ".$dataOrden['OBSERVA5'].", ".$dataOrden['OBSERVA6'].", ".$dataOrden['OBSERVA7'].", ".$dataOrden['OBSERVA8']?></td>
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
                    <th>OBSERVACIONES DE CALIDAD</th>
                  </tr>
                <tbody>
                  <tr>
                      <?php
                        //Parametros para regresar las observaciones de calidad de refilado de acuerdo al numero de orden
                          $n = $dataOrden['NIT'];
                          $NIT = trim($n);
                          $cod = $dataOrden['CODIGO'];
                          $CODIGO = trim($cod);

                          $orden_sellado = new Sellado();
                          $dataObsCalidad1 = $orden_sellado->getObsCalidadFirst($NIT,$CODIGO);
                          echo $dataObsCalidad1['OBSERVACIO'];
                          echo "<br>";
                          $orden_sellado = new Sellado();
                          $dataObsCalidad = $orden_sellado->getObsCalidad($NIT,$CODIGO);
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
          <?php $plano = rutaPlano($dataOrden['CODIGO']);?>
          <div class="row">

            <div class="col-xs-4">
            <label>Maquina sellado</label> <select class="form-control" id="maquina_sell" required="">
                    <option <?php if ($dataRequisito['maquina_sell'] == 1) echo  'selected'; ?> value="1">
                      1
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 2) echo  'selected'; ?> value="2">
                      2
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 3) echo  'selected'; ?> value="3">
                      3
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 4) echo  'selected'; ?> value="4">
                      4
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 5) echo  'selected'; ?> value="5">
                      5
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 6) echo  'selected'; ?> value="6">
                      6
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 7) echo  'selected'; ?> value="7">
                      7
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 8) echo  'selected'; ?> value="8">
                      8
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 9) echo  'selected'; ?> value="9">
                      9
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 10) echo  'selected'; ?> value="10">
                      10
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 11) echo  'selected'; ?> value="11">
                      11
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 12) echo  'selected'; ?> value="12">
                      12
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 13) echo  'selected'; ?> value="13">
                      13
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 14) echo  'selected'; ?> value="14">
                      14
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 15) echo  'selected'; ?> value="15">
                      15
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 16) echo  'selected'; ?> value="16">
                      16
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 17) echo  'selected'; ?> value="17">
                      17
                    </option>
                    <option <?php if ($dataRequisito['maquina_sell'] == 18) echo  'selected'; ?> value="18">
                      18
                    </option>
                  </select>

              <b>Operario responsable</b>
              <i id="limpiar" style="cursor: pointer;" class="fa fa-times"></i><br><br>
              <input id="operarios" type="text" class="form-control" placeholder="Nombre Operario" name="operario" value="<?php echo $dataRequisito['operario'] ?> " required> 
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
                <a class="btn btn-block btn-primary" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/sellado/control_requisitos/requisitos.php" style="text-decoration: none;">Cancelar</a>
              </div>

            </div>
            <input id="id_requisito" type="hidden" value="<?php echo $dataRequisito['Idsellado_requisitos'] ?>"> 
            <!-- Id del usuario que guarda el requisito -->
            <input id="id_usuario" type="hidden" value="<?php echo $_SESSION['idusuario'] ?>"> 

          </div>
        
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
<<<<<<< HEAD
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
<?php include '../../includes/sellado/footer.php'; 
  //Incio segunda parte validacion de Pagina y Usuario
    }else{
      include '../../autenticacion/restrin.php';
    }
  }else{
  
    include '../../autenticacion/no_acceso.php';
  }
  //Fin segunda parte validacion de Pagina y Usuario
  ?>