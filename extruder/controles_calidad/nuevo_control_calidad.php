<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario


  $archivo = 'nuevo_control_cal';
  include '../../includes/funciones.php';
$enlace = rutaRecursos('segundo_nivel');

if (isset($_GET['pedido']) && $_GET['tipo_ext'])
{
    $pedido = $_GET['pedido'];
    $tipo_ext = $_GET['tipo_ext'];
    $num_mezcla = $_GET['idmezcla'];
    $num_rollo = $_GET['num_rollo'];
}

$tipoPedidoEtq = tipoPedidoEtiqueta($tipo_ext);


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
$fila2 = sqlsrv_fetch_object($registrosExt);
//-- Consulta la informacion del rollo //
$registrosExt = sqlsrv_query($connPlas, $infoRollo);
$fila = sqlsrv_fetch_object($registrosExt);

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Extruder            
        <small>Controles De Calidad</small>
      </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Extrusion</a></li>
            <li><a href="#">Controles De Calidad</a></li>
            <li class="active">Nuevo</li>
          </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Default box -->
      <div class="box">            
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-fw fa-plus-circle"></i>Nuevo - Control de calidad</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
        <h4 align="center"><b>Información del Pedido</b></h4>
         <div class="box-body table-responsive no-padding">         
            
                  <table class="table table-striped" >
                    <tbody>
                      <tr>
                        <th >Rollo</th>
                        <th >Peso Neto</th>
                        <th >Pedido #</th>
                        <th >Referencia</th>
                        <th>Descripción</th>
                      </tr>
                      <tr>
                        <td><?php echo "<span class='label label-primary' style='font-size:13px'>".$fila->ROLLO."</span>" ?></td>
                        <td><?php echo $fila->PESON ?></td>
                        <td><?php echo $fila->PEDIDO ?></td> 
                        <td><?php echo $fila->CODIGO ?></td> 
                        <td><?php echo $fila->DESCRIP1." - ".$fila->DESCRIP2 ?></td>   
                      </tr>
                      
                    </tbody>
                  </table>
          </div>
          <div class="box-body table-responsive no-padding">         
            
                  <table class="table table-striped" >
                    <tbody>
                      <tr>
                        <th >NIT</th>
                        <th >Nombre Cliente</th>
                      </tr>
                      <tr>
                        <td><?php echo $fila->NIT ?></td>
                        <td><?php echo $fila->NOMBRECLI ?></td>
                      </tr>
                      
                    </tbody>
                  </table>
          </div> 
          <!--- Especificaciones Orden de Produccion Extrusion -->
                    <h4 align="center"><b>Especificaciones</b></h4>
                        <div class="col-md-4">
                            <h4 align="center">Ancho (cms)</h4>
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
                                            <tr>    <td><?php echo $fila2->ANCHOMN ?></td> 
                                                    <td><?php echo $fila2->ANCHO ?></td> 
                                                    <td><?php echo $fila2->ANCHOMX ?></td> 
                                            </tr>           
                                        </tbody> 
                                    </table> 
                                </div>
                        </div>
                        <div class="col-md-4">
                            <h4 align="center">Calibre (mp)</h4>
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
                                            <tr>    <td><?php echo $fila2->CALIBREMN ?></td> 
                                                    <td><?php echo $fila2->CALIBRE ?></td> 
                                                    <td><?php echo $fila2->CALIBREMX ?></td> 
                                            </tr>           
                                        </tbody> 
                                    </table> 
                                </div>
                        </div>
                        <div class="col-md-4">
                            <h4 align="center">Peso Muestra (g)</h4>
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
                                            <tr>    <td><?php echo $fila2->PESOMOLMN ?></td> 
                                                    <td><?php echo $fila2->PESOMOL ?></td> 
                                                    <td><?php echo $fila2->PESOMOLMX ?></td> 
                                            </tr>           
                                        </tbody> 
                                    </table> 
                                </div>
                        </div>
                        
        </div><!-- /.box-body -->
      </div><!-- /.box -->

      <div class="box">
        <div class="box-header with-border">
          <i class="ion ion-checkmark-circled"></i>
          <h3 class="box-title">Formulario de Calidad</h3>
        </div><!-- /.box-header -->
        <div class="box-body">

        <!-- Formulario de Calidad -->
        <form id="frmCalidad" action="procesar_c_calidad_inconf.php" method="post" accept-charset="utf-8">

              <div id="estadoInc"></div>
              <!-- Variable oculta: Numero de Orden -->
              <input type="hidden" name="num_orden" value="<?php echo $pedido; ?>">
              <!-- Variable oculta: Tipo de Extrusion -->
              <input type="hidden" name="tipo_ext" value="<?php echo $tipo_ext; ?>">              
              <!-- Variable oculta: Num Mezcla -->
              <input type="hidden" name="num_mezcla" value="<?php echo $num_mezcla; ?>">
              <!-- Variable oculta: Num Rollo -->
              <input type="hidden" name="num_rollo" value="<?php echo $num_rollo; ?>">
          
          <div class="row">
            <div class="col-md-6">
                    <div class="col-md-2">
                    <h5><b>Calibre 1</b></h5>  
                      <input class="sumcalibre form-control" name="calibre1" placeholder="Val 1" type="number" step="any">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Calibre 2</b></h5>  
                      <input class="sumcalibre form-control" name="calibre2" placeholder="Val 2" type="number" step="any">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Calibre 3</b></h5>  
                      <input class="sumcalibre form-control" name="calibre3" placeholder="Val 3" type="number" step="any">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Calibre 4</b></h5>  
                      <input class="sumcalibre form-control" name="calibre4" placeholder="Val 4" type="number" step="any">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Prom</b></h5>  
                      <input class="form-control" id="promcal" name="promcalibre" placeholder="Prom" type="number" step="any" onclick="calcular_promcalibre()">
                    </div>                  
            </div>
            <div class="col-md-6">
                  <div class="col-md-2">
                      <h5><b>Ancho</b></h5>
                      <input class="form-control" name="ancho" placeholder="Val 1" type="number" step="any">
                  </div>
                  <div class="col-md-2">
                      <h5><b>Tratado</b></h5>
                      <input class="form-control" name="tratado" placeholder="Val 1" type="number" step="any">
                  </div>
                  <div class="col-md-2">
                      <h5><b>Peso</b></h5>
                      <input class="form-control" name="peso" placeholder="Val 1" type="number" step="any">
                  </div>                   
            </div>
           </div> 
            <!-- /. Primer Row-->
            <div class="row">
              
              <div class="col-md-6">
               
                    <div class="col-md-2">
                      <h5><b>Peso 1</b></h5>
                      <input class="sumpeso form-control" name="peso1" placeholder="Val 1" type="number" step="any">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Peso 2</b></h5>
                      <input class="sumpeso form-control" name="peso2" placeholder="Val 2" type="number" step="any">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Peso 3</b></h5>
                      <input class="sumpeso form-control" name="peso3" placeholder="Val 3" type="number" step="any">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Peso 4</b></h5>
                      <input class="sumpeso form-control" name="peso4" placeholder="Val 4" type="number" step="any">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Prom</b></h5>
                      <input class="form-control" id="prompes" name="prompeso" placeholder="Prom" type="number" step="any" onclick="calcular_prompeso()">
                    </div>             
            </div>

            <div class="col-md-6">
              <div class="col-md-3">
                      <h5><b>Apariencia</b></h5>
                      <select class='form-control' id="apariencia" name='apariencia'> 
                        
                          <option value='BUENA'>BUENA</option>
                          <option value='MALA'>MALA</option>
                                          
                      </select>
                  </div>
                  <div class="col-md-7">
                      <h5><b>Defecto</b></h5>
                      <select class='form-control' id="defecto" name='defecto'>  
                      <option value=''></option> 
                        <?php 
                          $registrosLiberan = sqlsrv_query($connPlas, $lista_def);
                          while ( $fila3 = sqlsrv_fetch_object($registrosLiberan)) {
                        ?>
                          <option value='<?php echo $fila3->NOMBRE ?>'> <?php echo $fila3->NOMBRE ?> </option>
                        <?php } ?>                        
                      </select>
                  </div>

                  
                  
            </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                   <div class="col-md-7">
                      <h5><b>Libero</b></h5>
                      <select class='form-control' name='libero'>
                        <?php 
                          $registrosLiberan = sqlsrv_query($connPlas, $lista_liberan);
                          while ( $fila4 = sqlsrv_fetch_object($registrosLiberan)) {
                        ?>
                          
                          <option value='<?php echo $fila4->NOMBRE ?>'> <?php echo $fila4->NOMBRE ?> </option>
                        <?php } ?>                        
                      </select>
                  </div>
                </div>
                <div class="col-md-6">
                   <div class="col-md-7">
                      <h5><b>Coordinador</b></h5>
                      <select class='form-control' name='coordinador'>
                        <?php 
                          $registrosLiberan = sqlsrv_query($connPlas, $lista_coord);
                          while ( $fila5 = sqlsrv_fetch_object($registrosLiberan)) {
                        ?>                          
                          <option value='<?php echo $fila5->NOMBRE ?>'> <?php echo $fila5->NOMBRE ?> </option>
                        <?php } ?>                        
                      </select>
                  </div>
                  </div>
            </div>
            

            <div class="row">
              <div class="col-md-6">
                   <div class="col-md-10">
                      <h5><b>Observación</b></h5>                      
                      <textarea class="form-control" name="observacion" placeholder="Escribir observación" style="max-width: 100%"></textarea>
                  </div>
              </div>
              <div class="col-md-4  ">
                   <div class="col-md-7">
                      <h5><b>Inconformidad</b></h5>                      
                      <a href='#' data-toggle='modal' data-target='#modalNuevaInc'><button id="nueva_inc" class="btn btn-block btn-danger">Nueva - Inconformidad</button></a>
                  </div>
              </div>
          </div>
              <br>
          <div class="col-xs-9">
              <br>                 
              <div class="col-md-2">
                  <input type="submit" class="btn btn-block btn-primary" name="termin" value="Terminar">
              </div>
               <div class="col-md-2">
                      <input type="submit" class="btn btn-block btn-primary" name="guarda" value="Guardar">
                    </div> 
              <div class="col-md-2">
                  <a class="btn btn-block btn-primary" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/extruder/controles_calidad/controles_calidad.php" style="text-decoration: none;">Cancelar</a>
              </div>
          </div>  

                                   
        </form>
          </div>
        </div>
      </div><!-- /.box-body -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->


  <!-- ========== ventanas modales en controles de requisitos ========== -->


  <div class="modal fade" id="modalNuevaInc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">


        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel" style='text-align: center;'><i class="fa fa-fw fa-warning"></i>Formulario de Inconformidad</h4>
        </div>

<form id="frmInc" action="../inconformidades/procesar_inconformidad.php" method="post" accept-charset="utf-8">
        <div class="modal-body">        
          <h4 align="center"><b>Información del pedido</b></h4>

            <label>Pedido #:</label>
            <span><?php echo $pedido ?></span>
            <input type="hidden" name="pedido" value="<?php echo $pedido ?>">
            <label>Tipo Extrusion:</label>
            <span><?php if($tipo_ext == 'ext_laminacion'){echo "Laminación";}else{echo "Normal";} ?></span>
            <input type="hidden" name="tipo_ext" value="<?php echo $tipo_ext ?>">
            <label>Mezcla #:</label>
            <span><?php echo $num_mezcla ?></span>
            <input type="hidden" name="num_mezcla" value="<?php echo $num_mezcla ?>">
            <label>Rollo #:</label>
            <span><?php echo $num_rollo ?></span>
            <input type="hidden" name="num_rollo" value="<?php echo $num_rollo ?>">
            <br><label>NIT:</label>
            <span><?php echo $fila->NIT ?></span>
            <input type="hidden" name="nit" value="<?php echo $fila->NIT ?>">
            <label>Cliente:</label>
            <span><?php echo $fila->NOMBRECLI ?></span>
            <input type="hidden" name="nom_cliente" value="<?php echo $fila->NOMBRECLI ?>">
            <label>Referencia:</label>
            <span><?php echo $fila->CODIGO ?></span>
            <input type="hidden" name="referencia" value="<?php echo $fila->CODIGO  ?>">

          <h4 align="center"><b>Completar campos</b></h4>
    
            <label>Tipo de Inconformidad</label>
              <select class="form-control" name="tipo_inconf">
                <option value="NO INOCUO">NO INOCUO</option>
                <option value="NO CONFORME">NO CONFORME</option>
                <option value="EN TRANSITO">EN TRANSITO</option>
              </select>
            <label>Maquina(#):</label>
            <input type="number" step="any" class="form-control" name="maquina">

            <label>Cantidad(Kg):</label>
            <input type="number" step="any" class="form-control" name="cantidad" value="<?php echo $fila->PESON ?>">
            <label>Detectada por:</label>
            <input  type="text" class="form-control" name="detectada_por" value="<?php echo $_SESSION["nombreuser"]; ?>" readonly>
            <label>Cargo:</label>
            <input  type="text" class="form-control" name="cargo">
             <label>Operario responsable:</label>
                    <i id="limpiar" style="cursor: pointer;" class="fa fa-times"></i>
                     <br>
                     <input id="operarios" type="text" class="form-control" placeholder="Nombre de Operario" name="op_res" required>
            <label>Causa:</label>
            <textarea id="causas" class="form-control" style="max-width: 100%;" name="causa"></textarea>       
           
            <label>Descripción:</label>
            <textarea class="form-control" style="max-width: 100%;" name="descripcion"></textarea>

            <label>Disposición final</label>
              <select class="form-control" name="dispo_final">
                <option value="DESECHAR">DESECHAR</option>
                <option value="CONCESION">CONCESION</option>
                <option value="REPROCESO">RE-PROCESO</option>
              </select>
          
            <h4 align="center"><b>Adjuntar evidencia</b></h4>
            <!--<input type="file" name="files[]" accept="image/*"  multiple/> -->
            <input id="archivos" name="imagenes[]" type="file" accept="image/*" multiple=true >
            <input id="cadenalista" type="hidden" name="evidencia">         
            <input id="id" type="hidden">
            <div class="msgdiv" id="chatbox"></div>
              
            </div>
        

        <div class="modal-footer">
          <button type="button" id="btn-cerrar" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <input  type="submit" class="btn btn-primary" id="inc-ter" name="inc-terminar" value="Terminar">
          <input  type="submit" class="btn btn-primary" id="inc-guar" name="inc-guardar" value="Guardar">   
        </div>

        </form>
      </div>
    </div>
  </div>
<!-- /========== ventanas modales en controles de requisitos ========== -->


<?php sqlsrv_close( $connPlas ); ?>
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

