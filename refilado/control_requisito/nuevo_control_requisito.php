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
  } 
  
  include '../../includes/dbconfig.php';
  include '../../model/refilado.php';
  include '../../includes/refilado/header.php';
  require_once  '../../class/Refilado.php';
  $orden_refilado = new Refilado();
  $dataOrden = $orden_refilado->getOrdenProduccion($_GET['pedido']);
?>
<!DOCTYPE html>
<html>
<head>

  <style media="screen" type="text/css">
  .error{
     border: 1px solid rgba(215, 0, 0, 0.75);
     box-shadow:inset 0px 0px 2px 0px rgba(255, 0, 0, 0.75); 
  } 
  </style><!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <title></title>
</head>
<body>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Requisitos <small>Control de requisitos</small></h1>
      <ol class="breadcrumb">
        <li>
          <a href="#"><i class="fa fa-dashboard"></i> Requisitos</a>
        </li>
        <li>
          <a href="#">Control de requisitos</a>
        </li>
        <li class="active">Nuevo</li>
      </ol>
    </section><!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-fw fa-plus-circle"></i>Agregar</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <h3 align="center">Descripción General</h3><br>
          <form accept-charset="utf-8" action="procesar_requisitos.php" method="post">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>REFILADO N°</th>
                    <th>FECHA ENTREGA</th>
                    <th>CLIENTE</th>
                    <th>NIT</th>
                    <th>DESCRIPCION<input class="minimal" name="chkrefilado[]" type="checkbox" value="chk_descripcion"></th>
                    <th>CODIGO<input class="minimal" name="chkrefilado[]" type="checkbox" value="chk_codigo"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input id="num_orden" name="num_orden" type="hidden" value="<?php echo trim($dataOrden['PEDIDO']); ?>"><?php echo $dataOrden['ORDENNRO']; ?></td>
                    <td><?php echo date_format($dataOrden['FHENTREGA'], 'd/m/y') ?></td>
                    <td><?php echo $dataOrden['NOMBRE']; ?></td>
                    <td><?php echo $dataOrden['NIT']; ?></td>
                    <td><?php echo $dataOrden['DESCRIPCIO']."-".$dataOrden['DESCRIP2']; ?></td>
                    <td><?php echo $dataOrden['CODIGO']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div><!--- Detalles Orden de Produccion Laminacion -->
            <h3 align="center">Detalles</h3><br>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>DESTINO</th>
                    <th>Kg PEDIDOS</th>
                    <th>RADIO DE LOS ROLLOS</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $dataOrden['DESTINO']; ?></td>
                    <td><?php echo $dataOrden['KILOSPD']; ?></td>
                    <td><?php echo $dataOrden['RADIORLL']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div><!--- Detalles Orden de Produccion Laminacion -->
            <br>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>FECHA DE REFILADO</th>
                    <th>KILOS REFILADOS</th>
                    <th>TIPO DE PEDIDO<input class="minimal" name="chkrefilado[]" type="checkbox" value="chk_pedido"></th>
                    <th>TIPO DE MATERIAL<input class="minimal" name="chkrefilado[]" type="checkbox" value="chk_material"></th>
                    <th>ALTURA DE LA IMPRESION<input class="minimal" name="chkrefilado[]" type="checkbox" value="chk_impresion"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input class="form-control" data-format="dd/MM/yyyy hh:mm:ss" id="fechrefi" name="fechrefi" required="" type="text"></td>
                    <td><input class="form-control" id="krefi" name="krefi" required="" type="text"></td>
                    <td><?php echo $dataOrden['TIPOPED']; ?></td>
                    <td><?php echo $dataOrden['MATERIAL']; ?></td>
                    <td><?php echo $dataOrden['ALTURAS']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div><!--- Espsificaciones Orden de Produccion Impresion -->
            <h3 align="center">Especificaciones</h3><br>
            <div class="row">
              <div class="col-md-4">
                <h4 align="center">ANCHO BOBINA (cms)<input class="minimal" name="chkrefilado[]" type="checkbox" value="chk_bobina"></h4>
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
                </div><input class="form-control" id="ancho_bobina" required="" type="text">
              </div>
              <div class="col-md-4">
                <h4 align="center">PASO ENTRE GUIAS (cms)<input class="minimal" name="chkrefilado[]" type="checkbox" value="chk_paso"></h4>
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
                </div><input class="form-control" id="peso_guias" required="" type="text">
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
            </div><br>
            <br>
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
                <h4 align="center">EMBALAJE</h4>
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
            </div><br>
            <br>
            <?php 
              //Ruta Imgs Montaje
              $rutaMon = substr($dataOrden['FEMBOBINA'], 2);
              $rutaMonLimpia = trim($rutaMon);
              $imgFinal = strtolower($rutaMonLimpia);
              $numMon = rutaMontaje($imgFinal);
             
              $imgMontaje = "<img src='ftp://192.168.0.19/Plasmar/Producci/$numMon'/>";
                         ?>

            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tr>
                    <th>MONTAJE<input class="minimal" name="chkrefilado[]" type="checkbox" value="chk_montaje"></th>
                    <th>OBSERVACIONES</th>
                  </tr>
                  <tbody>
                    <tr>
                      <td><?php echo $imgMontaje ?></td>
                      <td><?php echo $dataOrden['OBSERVA1'].", ".$dataOrden['OBSERVA2'].", ".$dataOrden['OBSERVA3'].", ".$dataOrden['OBSERVA4'].", ".$dataOrden['OBSERVA5'].", ".$dataOrden['OBSERVA6'].", ".$dataOrden['OBSERVA7'].", ".$dataOrden['OBSERVA8']?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <tr>
                      <th>OBSERVACIONES DE CALIDAD</th>
                    </tr>
                    <tbody>
                      <tr>
                        <td>
                        <?php
                        //Parametros para regresar las observaciones de calidad de refilado de acuerdo al numero de orden
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
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $dataOrden['CORE'];?>Pulgadas</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div><?php 

              $plano = rutaPlano($dataOrden['CODIGO']);

              ?><?php 
                          ?>
              <div class="row">
                <div class="col-xs-4">
                  <label>Maquina refiladora</label> <select class="form-control" id="maquina_ref" required="">
                    <option value="1">
                      1
                    </option>
                    <option value="2">
                      2
                    </option>
                    <option value="3">
                      3
                    </option>
                    <option value="4">
                      4
                    </option>
                    <option value="5">
                      5
                    </option>
                    <option value="6">
                      6
                    </option>
                    <option value="7">
                      7
                    </option>
                    <option value="8">
                      8
                    </option>
                  </select> <label>Tiempo de Curado</label> <input class="form-control" id="tcurado" name="tcurado" required="" type="text"> <label>Gramos/m2</label> <input class="form-control" id="gramosm" name="gramosm" required="" type="text"> 
                 
                  <h4><b>Acumulado: </b><span class="label label-primary">
                      
                      <?php 
                       $orden_refilado = new Refilado();
                       $dataKilos = $orden_refilado->getSumaKilos($_GET['pedido']);
                       echo $dataKilos['kilos_pesados'];

                      ?> KG
                    </span></h4>
                    <label>Kilos pesados </label> 
                  <input class="form-control" id="kilos_p" name="kilos_p" required="" type="number"> <b>Operario responsable</b> <i class="fa fa-times" id="limpiar" style="cursor: pointer;"></i><br>
                  <br>
                  <input class="form-control" id="operarios" name="operario" placeholder="Nombre Operario" required="" type="text">
                </div>
                </form>
                <div class="col-xs-9">
                  <br>
                  <div class="col-md-2">
                  <button class="btn btn-block btn-primary" id="btnAprobar">Aprobar</button>
                  </div>
                  <div class="col-md-2">
                  <button class="btn btn-block btn-primary" id="btnGuardar">Guardar</button>
                  </div>
                  <div class="col-md-2">
                    <a class="btn btn-block btn-primary" href="http://%3C?php%20echo%20$_SERVER['SERVER_NAME'];%20?%3E/apps/impresion/premontajes/premontajes.php" style="text-decoration: none;">Cancelar</a>
                  </div>
                </div>
              </div>
            </div>
          
          <input id="id_usuario" type="hidden" value="<?php echo $_SESSION['idusuario'] ?>"> 
           
          
          <div id="gridData"></div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <!-- =============================================== -->
  <div aria-labelledby="exampleModalLabel" class="modal fade" id="modalPlano" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-fw fa-warning"></i>Plano Mecanico</h4>
        </div>
        <div class="modal-body">
          <div class="row"><img src="ftp://192.168.0.5/PlanoMecanico/Pruebas/JPG%20PRODUCCION/%3C?php%20echo%20$plano%20?%3E.jpg" style="max-width: 100%;"></div>
        </div>
        <div class="modal-footer">
          <a href="ftp://192.168.0.5/PlanoMecanico/Pruebas/JPG%20PRODUCCION/%3C?php%20echo%20$plano%20?%3E.jpg" target="blank"><button class="btn btn-primary" type="button">Abrir en nueva pestaña</button></a> <button class="btn btn-default" data-dismiss="modal" type="button">Cancelar</button>
        </div>
      </div>
    </div>
  </div><?php include '../../includes/refilado/footer.php'; 
  //Incio segunda parte validacion de Pagina y Usuario
    }else{
      include '../../autenticacion/restrin.php';
    }
  }else{

    include '../../autenticacion/no_acceso.php';
  }
  //Fin segunda parte validacion de Pagina y Usuario
  ?>
</body>
</html>