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

  <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Refilado        

            <small>Detalle</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Refilado</a></li>
            <li><a href="#">Detalle</a></li>
            <li class="active">Nuevo</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">            
            <div class="box-body">

        <!--- Descripcion General Orden de Laminacion -->
        <h3 align="center">Descripción General</h3>
        <br>
            <form action="procesar_requisitos.php" method="post" accept-charset="utf-8">
                <div class="table-responsive"> 
                    <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>IDREG</th>
                        <th>REFILADO N°</th>
                        <th>FECHA ENTREGA</th>
                        <th>CLIENTE</th>
                        <th>NIT</th>
                        <th>DESCRIPCION</th>
                        <th>CODIGO</th>
                      </tr>
                      </thead>
                      <tbody> 
                      
                  <tr>
                  <td><input type="hidden" name="num_orden" value='<?php echo $dataOrden['ORDENNRO']; ?>'><?php echo $dataOrden['ORDENNRO']; ?></td>
                  
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
                                <th>Kg A REFILAR</th>                                
                                <th>RADIO DE LOS ROLLOS</th>
                                <th colspan="4" style="text-align: center;">TAMAÑO DE LA GUIA</th>
                               </tr>
                                    </thead>
                                    <tbody> 
                                    
                                    
                      <tr>
                            <td><?php echo $dataOrden['DESTINO']; ?></td>
                            <td><?php echo $dataOrden['KILOSPD']; ?></td>
                            <td><?php echo $dataOrden['RADIORLL']; ?></td>
                            <th>Ancho (mm)</th><td><?php echo $dataOrden['ANCHOG']; ?></td>
                            <th>Largo (mm)</th><td><?php echo $dataOrden['LARGOG']; ?></td>

                            
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
                                <th>ANCHO BOBINA REAL</th>                                
                                <th>TIPO DE PEDIDO</th>
                                <th>TIPO DE MATERIAL</th>
                                <th>ALTURA DE LA IMPRESION</th>
                               </tr>
                                    </thead>
                                    <tbody> 
                                    
                                    
                      <tr>
                            <td></td>
                            <td></td>
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
                        <h4 align="center">ANCHO BOBINA (cms)</h4>
                            <div class="table-responsive"> 
                                <table class="table table-bordered"> 
                                    <thead> 
                                        <tr> 
                                            <th>MIN</th> 
                                            <th>OBJ</th> 
                                            <th>MAX</th> 
                                            <th>REAL</th> 
                                        </tr> 
                                    </thead> 
                                    <tbody> 
                                    
                                        
                          <td><?php echo $dataOrden['ANCHOMN']; ?></td>
                          <td><?php echo $dataOrden['ANCHO']; ?></td>
                          <td><?php echo $dataOrden['ANCHOMX']; ?></td>
                          <td><?php echo $dataOrden['ANCHOMN']; ?></td>
                                        </tr>          
                                    </tbody> 
                                </table> 
                            </div>
                    </div>

                    <div class="col-md-4">
                        <h4 align="center">PASO ENTRE GUIAS (cms)</h4>
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
                            </div>
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
              $rutaMon = substr($dataOrden['FEMBOBINA'], 2);
              $rutaMonLimpia = trim($rutaMon);
              $numMon = rutaMontaje($rutaMonLimpia);

              $imgMontaje = "<img src='ftp://hestia/Plasmar/Producci/$numMon'/>";
             ?>


                <div class="col-md-12">
                  <div class="table-responsive"> 
                       <table class="table table-bordered"> 
                       <thead> 
                       <tr>
                       <th>MONTAJE</th>
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

            <div class="row">
              
               <div class="col-xs-9">
                 <br>                    
                  <div class="col-md-2">
                        <a class="btn btn-block btn-primary" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/refilado/control_requisito/requisitos.php" style="text-decoration: none;">Vovler</a>
                  </div>
               </div>
            </div>


            </form>


            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- =============================================== -->


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