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
    $num_rollo = $_GET['num_rollo'];
    $id = $_GET['id'];
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
            <li class="active">Editar</li>
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
                        <div class="col-md-3">
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
                        <div class="col-md-3">
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
                        <div class="col-md-3">
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
                        <div class="col-md-3">
                                <div class="table-responsive"> 
                                 <h4 align="center">Velocidades (Hz)</h4>
                                    <table class="table table-bordered"> 
                                        <thead> 
                                            <tr> 
                                                <th>HALADOR</th> 
                                                <th>BOBINADOR</th> 
                                            </tr> 
                                        </thead> 
                                        <tbody> 
                                            <tr>    <td><?php echo $fila2->VELOHALADOR ?></td> 
                                                    <td><?php echo $fila2->VELOBOBINADOR ?></td> 
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
              <?php 
                  $control_req = "SELECT * FROM controles_calidad WHERE Idcontrol_calidad = '$id'";
                  $leer = sqlsrv_query($connSCPBD, $control_req);
                  $datos = sqlsrv_fetch_array($leer);
                ?>
        <!-- Formulario de Calidad -->
        <form action="actualizar_control_calidad.php" method="post" accept-charset="utf-8">
              <!-- Id del control de requisito oculto -->
              <input type="hidden" name="idcontrol_cal" value="<?php echo $datos[0]; ?>" >
              <!-- Variable oculta: Numero de Orden -->
              <input type="hidden" name="num_orden" value="<?php echo $datos[1]; ?>">
              <!-- Variable oculta: Tipo de Extrusion -->
              <input type="hidden" name="tipo_ext" value="<?php echo $datos[2]; ?>">              
              <!-- Variable oculta: Num Mezcla -->
              <input type="hidden" name="num_mezcla" value="<?php echo $datos[3]; ?>">
              <!-- Variable oculta: Num Rollo -->
              <input type="hidden" name="num_rollo" value="<?php echo $datos[4]; ?>">
          
          <div class="row">
            <div class="col-md-6">
                    <div class="col-md-2">
                    <h5><b>Calibre 1</b></h5>  
                      <input  type="number" class="sumcalibre form-control" name="calibre1" step="any"  value="<?php echo $datos[7]; ?>">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Calibre 2</b></h5>  
                      <input class="sumcalibre form-control" name="calibre2" step="any" value="<?php echo $datos[8]; ?>" type="number">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Calibre 3</b></h5>  
                      <input class="sumcalibre form-control" name="calibre3" step="any" value="<?php echo $datos[9]; ?>" type="number">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Calibre 4</b></h5>  
                      <input class="sumcalibre form-control" name="calibre4" step="any" value="<?php echo $datos[10]; ?>" type="number">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Prom</b></h5>  
                      <input class="form-control" id="promcal" name="promcalibre" step="any" value="<?php echo $datos[11]; ?>" type="number" onclick="calcular_promcalibre()">
                    </div>
                  
              </div>
              <div class="col-md-6">
                  <div class="col-md-2">
                      <h5><b>Ancho</b></h5>
                      <input class="form-control" step="any" name="ancho" value="<?php echo $datos[12]; ?>" type="number">
                  </div>
                  <div class="col-md-2">
                      <h5><b>Tratado</b></h5>
                      <input class="form-control" step="any" name="tratado" value="<?php echo $datos[13]; ?>" type="number">
                  </div>
                  <div class="col-md-2">
                      <h5><b>Peso</b></h5>
                      <input class="form-control" step="any" name="peso" value="<?php echo $datos[14]; ?>" type="number">
                  </div>
                   
              </div>
            </div> 
            <!-- /. Primer Row-->
            <div class="row">
              
              <div class="col-md-6">
               
                    <div class="col-md-2">
                      <h5><b>Peso 1</b></h5>
                      <input class="sumpeso form-control" step="any" name="peso1" value="<?php echo $datos[17]; ?>" type="number">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Peso 2</b></h5>
                      <input class="sumpeso form-control" step="any" name="peso2" value="<?php echo $datos[18]; ?>" type="number">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Peso 3</b></h5>
                      <input class="sumpeso form-control" step="any" name="peso3" value="<?php echo $datos[19]; ?>" type="number">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Peso 4</b></h5>
                      <input class="sumpeso form-control" step="any" name="peso4" value="<?php echo $datos[20]; ?>" type="number">
                    </div>
                    <div class="col-md-2">
                    <h5><b>Prom</b></h5>
                      <input class="form-control" id="prompes" name="prompeso" value="<?php echo $datos[21]; ?>" type="number" onclick="calcular_prompeso()">
                    </div>             
            </div>

            <div class="col-md-6">
              <div class="col-md-3">
                      <h5><b>Apariencia</b></h5>
                      
                      <select class='form-control' id="apariencia" name='apariencia'> 
                        <option value='BUENA' <?php if($datos[15] == 'BUENA'){ echo 'selected';}  ?>>BUENA</option>  
                        <option value='MALA' <?php if($datos[15] == 'MALA'){ echo 'selected';}  ?>>MALA</option>
                      </select>

              </div>

                  <div class="col-md-7">
                      <h5><b>Defecto</b></h5>

                        <select class='form-control' id="defecto" name='defecto'>   
                        <option value='<?php echo $datos[16] ?>' selected> <?php echo $datos[16]  ?> </option>
                        <?php 
                          $registrosDef = sqlsrv_query($connPlas, $lista_def);
                          while ( $fila3 = sqlsrv_fetch_object($registrosDef)) {
                                                    
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
                        <option value='<?php echo $datos[22] ?>'> <?php echo $datos[22]  ?> </option>
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
                        <option value='<?php echo $datos[23] ?>'> <?php echo $datos[23]  ?> </option>
                        <?php 
                          $registrosCoor = sqlsrv_query($connPlas, $lista_coord);
                          while ( $fila4 = sqlsrv_fetch_object($registrosCoor)) {
                                                    
                        ?>

                          <option value='<?php echo $fila4->NOMBRE ?>'> <?php echo $fila4->NOMBRE ?> </option>
                        <?php } ?>                        
                      </select>
                  </div>
                  </div>
            </div>
            

            <div class="row">
              <div class="col-md-6">
                   <div class="col-md-10">
                      <h5><b>Observación</b></h5>                      
                      <textarea class="form-control" name="observacion" style="max-width: 100%"><?php echo $datos[24]; ?></textarea>
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

<?php 

  sqlsrv_close( $connSCPBD );
  sqlsrv_close( $connPlas );
?>
<?php include '../../includes/extruder/footer.php'; 
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../autenticacion/restrin.php';
  }
}else{

  include '../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>