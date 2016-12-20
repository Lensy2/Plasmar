<?php
  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('refilado', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
  $archivo = 'control_req';

  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');

  if (isset($_POST['pedido'])){
    $pedido = $_POST['pedido'];
  } 
  
  include '../../includes/dbconfig.php';
  include '../../model/refilado.php';
  include '../../includes/refilado/header.php';
?>

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
            <li class="active">Nuevo</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">            
            <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-fw fa-plus-circle"></i>Nuevo - Control De Requisitos</h3>
            </div><!-- /.box-header -->
            <div class="box-body">

          
          <?php

            $registrosRefi = sqlsrv_query($connPlas,$leerRefi);

            if( $registrosRefi === false ) {
            die( print_r( sqlsrv_errors(), true));
            }
    

            
            while ($fila = sqlsrv_fetch_object($registrosRefi)) {
             
          
            //$fila = sqlsrv_fetch_object($registrosLam);
            //echo $leerLam;
            ?>

        <!--- Descripcion General Orden de Laminacion -->
        <h3 align="center">Descripción General</h3>
        <br>
            <form action="procesar_requisitos.php" method="post" accept-charset="utf-8">
                <div class="table-responsive"> 
                    <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>REFILADO N°</th>
                        <th>FECHA ENTREGA</th>
                        <th>CLIENTE</th>
                        <th>NIT</th>
                        <th>DESCRIPCION<input type="checkbox" class="chkplas" class="minimal" value="chk_descripcion" name="chkrefilado[]" ></th>
                        <th>CODIGO<input type="checkbox" class="chkplas" class="minimal" value="chk_codigo" name="chkrefilado[]" ></th>
                      </tr>
                      </thead>
                      <tbody> 
                      
                  <tr>
                  <td><input type="hidden" name="num_orden" value='<?php echo $fila->PEDIDO; ?>'><?php echo $fila->ORDENNRO; ?></td>
                  
                  <td><?php echo date_format($fila->FHENTREGA, 'd/m/y') ?></td>
                  <td><?php echo $fila->NOMBRE; ?></td>
                  <td><?php echo $fila->NIT; ?></td>
                  <td><?php echo $fila->DESCRIPCIO."-".$fila->DESCRIP2; ?></td>
                  <td><?php echo $fila->CODIGO; ?></td>
                   
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
                            <td><?php echo $fila->DESTINO; ?></td>
                            <td><?php echo $fila->KILOSPD; ?></td>
                            <td><?php echo $fila->RADIORLL; ?></td>
                            <th>Ancho (mm)</th><td><?php echo $fila->ANCHOG; ?></td>
                            <th>Largo (mm)</th><td><?php echo $fila->LARGOG; ?></td>

                            
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
                                <th>TIPO DE PEDIDO<input type="checkbox" class="chkplas" class="minimal" value="chk_pedido" name="chkrefilado[]" ></th>
                                <th>TIPO DE MATERIAL<input type="checkbox" class="chkplas" class="minimal" value="chk_material" name="chkrefilado[]" ></th>
                                <th>ALTURA DE LA IMPRESION<input type="checkbox" class="chkplas" class="minimal" value="chk_impresion" name="chkrefilado[]" ></th>
                               </tr>
                                    </thead>
                                    <tbody> 
                                    
                                    
                      <tr>
                            <td><input type="date" min=2014-01-01 class="form-control" name="fechrefi"></td>
                            <td><input type="text" class="form-control"  name="krefi"></td>
                            <td><?php echo $fila->TIPOPED; ?></td>
                            <td><?php echo $fila->MATERIAL; ?></td>
                            <td><?php echo $fila->ALTURAS; ?></td>
                            
                      </tr>
                          </tbody>
                        </table>
                        </div>


                        <!--- Espsificaciones Orden de Produccion Impresion -->

            <h3 align="center">Especificaciones</h3>
            <br>
            <div class="row">
                    <div class="col-md-4">
                        <h4 align="center">ANCHO BOBINA (cms)<input type="checkbox" class="chkplas" class="minimal" value="chk_bobina" name="chkrefilado[]" ></h4>
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
                                    
                                        
                          <td><?php echo $fila->ANCHOMN; ?></td>
                          <td><?php echo $fila->ANCHO; ?></td>
                          <td><?php echo $fila->ANCHOMX; ?></td>

                                        </tr>          
                                    </tbody> 
                                </table> 
                            </div>
                    </div>

                    <div class="col-md-4">
                        <h4 align="center">PASO ENTRE GUIAS (cms)<input type="checkbox" class="chkplas" class="minimal" value="chk_paso" name="chkrefilado[]" ></h4>
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
                          <td><?php echo $fila->PASOMN; ?></td>
                          <td><?php echo $fila->PASO; ?></td>
                          <td><?php echo $fila->PASOMX; ?></td>
                          </tr>           
                                    </tbody> 
                                </table> 
                            </div>
                    </div>

                    <div class="col-md-4">
                        <h4 align="center">CALIBRE (mp)<input type="checkbox" class="chkplas" class="minimal" value="chk_calibre" name="chkrefilado[]" ></h4>
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
                          <td><?php echo $fila->CALIBREMN; ?></td>
                          <td><?php echo $fila->CALIBRE; ?></td>
                          <td><?php echo $fila->CALIBREMX; ?></td>
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
                          <td><?php echo $fila->PESOBMN; ?></td>
                          <td><?php echo $fila->PESOB; ?></td>
                          <td><?php echo $fila->PESOBMX; ?></td>
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
                          <td><?php echo $fila->PESONMN; ?></td>
                          <td><?php echo $fila->PESON; ?></td>
                          <td><?php echo $fila->PESONMX; ?></td>
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
                          <td style="text-align: center;"><?php echo $fila->EMBALAJE; ?></td>
                          
                          </tr>          
                                    </tbody> 
                                </table> 
                            </div>
                    </div>

                </div>                    
          <br><br>

            <?php 
              //Ruta Imgs Montaje
              $rutaMon = substr($fila->FEMBOBINA, 2);
              $rutaMonLimpia = trim($rutaMon);
              $numMon = rutaMontaje($rutaMonLimpia);

              $imgMontaje = "<img src='ftp://192.168.0.19/Plasmar/Producci/$numMon'/>";
             ?>


                <div class="col-md-12">
                  <div class="table-responsive"> 
                       <table class="table table-bordered"> 
                       <thead> 
                       <tr>
                       <th>MONTAJE<input type="checkbox" class="chkplas" class="minimal" value="chk_montaje" name="chkrefilado[]" ></th>
                        <th>OBSERVACIONES</th>
                        <th>OBSERVACIONES DE CALIDAD</th>
                        </tr>
                       <tbody> 
                       <tr> 
                       <td><?php echo $imgMontaje ?></td>
                          <td><?php echo $fila->OBSERVA1.", ".$fila->OBSERVA2.", ".$fila->OBSERVA3.", ".$fila->OBSERVA4.", ".$fila->OBSERVA5.", ".$fila->OBSERVA6.", ".$fila->OBSERVA7.", ".$fila->OBSERVA8?></td>
                          <td>
                            <?php $obsCal = "SELECT * FROM dbo.REFILADO rf inner join  dbo.OBSCALIDAD cal on rf.NIT = cal.NIT where rf.NIT = '$fila->NIT' and proceso = 'REFILADO' and rf.ORDENNRO = '$pedido'";
                         $queryCal = sqlsrv_query($connPlas,$obsCal);

                         while($row = sqlsrv_fetch_object($queryCal))
                          {
                            echo $row->OBSERVACIO."<br>";
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
                            <td><?php echo $fila->CORE;?> Pulgadas</td>
                          </tr>
                        </tbody>
                       
                      </thead> 
                                    
                    </table> 
                </div>
              </div>
           <?php 

$plano = rutaPlano($fila->CODIGO);

?>
   

           <?php 
                }
            sqlsrv_close( $connPlas );
            ?>
            <div class="row">
               <div class="col-xs-4">
                      <label>Tiempo de Curado</label>
                     <input  type="text" class="form-control"  name="tcurado" > 
                      <label>Gramos/m2</label>
                     <input  type="text" class="form-control"  name="gramosm" > 

                    <b>Operario responsable</b>
                      <i id="limpiar" style="cursor: pointer;" class="fa fa-times"></i><br><br>
                      <input id="operarios" type="text" class="form-control" placeholder="Nombre Operario" name="operario" required> 
               </div>
               <div class="col-xs-9">
                 <br>
                  <div class="col-md-2">
                        <input type="submit" class="btn btn-block btn-primary" name="aprob" value="Aprobar" >
                  </div>                  
                  <div class="col-md-2">
                        <input type="submit" class="btn btn-block btn-primary" name="guarda" value="Guardar">
                  </div>                      
                  <div class="col-md-2">
                        <a class="btn btn-block btn-primary" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/impresion/premontajes/premontajes.php" style="text-decoration: none;">Cancelar</a>
                  </div>
               </div>
            </div>


            </form>


            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

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
      <img src="ftp://192.168.2.8/Pruebas/JPG PRODUCCION/<?php echo $plano ?>.jpg" style="max-width: 100%;">
  
          </div>

        </div>
        <div class="modal-footer">
          <a href="ftp://192.168.2.8/Pruebas/JPG PRODUCCION/<?php echo $plano ?>.jpg" target="blank"><button type="button" class="btn btn-primary">Abrir en nueva pestaña</button></a>
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