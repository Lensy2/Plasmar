<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('sellado', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
  $archivo = 'control_req';    

  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');

  if (isset($_POST['pedido'])){
    $pedido = $_POST['pedido'];
  } 
//temporal pedido----
  //$pedido=''

  
  include '../../includes/dbconfig.php';
  include '../../model/sellado.php';
  include '../../includes/sellado/header.php';
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

            $registrosSell = sqlsrv_query($connPlas,$leerSell);

            if( $registrosSell === false ) {
            die( print_r( sqlsrv_errors(), true));
            }
    

           
            while ($fila = sqlsrv_fetch_object($registrosSell)) {

               //Ruta Imgs Boca
              $rutaBoc = substr($fila->FTIPOBOCA, 2);
              $rutaBocLimpia = trim($rutaBoc);          
              $nomBoc = rutaBoca($rutaBocLimpia);
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
                        <th>Descripción<input type="checkbox" class="chkplas" class="minimal" value="chk_descripcion" name="chksellado[]" ></th>
                        <th>Codigo</th>
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
                                <th>MEDIDAS DE LA BOLSA</th>
                                <th>Kg PEDIDOS<input type="checkbox" class="chkplas" class="minimal" value="chk_kgpedidos" name="chksellado[]" ></th>
                                <th>BOLSAS PEDIDAS<input type="checkbox" class="chkplas" class="minimal" value="chk_bolsas" name="chksellado[]" ></th>
                                <th>VELOCIDAD SELLADO (UNI X MIN)<input type="checkbox" class="chkplas" class="minimal" value="chk_velocidad" name="chksellado[]" ></th>
                                <th>BOCA POR</th>
                                <th>BOCA</th>
                               </tr>
                                    </thead>
                                    <tbody> 
                                    
                      <tr>
                      
                            <td><?php echo $fila->MEDIDAS; ?></td>
                            <td><?php echo $fila->KILOSPD; ?></td>
                            <td><?php echo $fila->BOLSASPD; ?></td>
                            <td><?php echo $fila->VELSELLE; ?></td>
                            <td><?php echo $fila->TIPOBOCA; ?></td>
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
                        <h4 align="center">ANCHO (cms)<input type="checkbox" class="chkplas" class="minimal" value="chk_ancho" name="chkrefilado[]" ></h4>
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
                        <h4 align="center">LARGO (cms)<input type="checkbox" class="chkplas" class="minimal" value="chk_largo" name="chksellado[]" ></h4>
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
                          <td><?php echo $fila->LARGOMN; ?></td>
                          <td><?php echo $fila->LARGO; ?></td>
                          <td><?php echo $fila->LARGOMX; ?></td>
                          </tr>           
                                    </tbody> 
                                </table> 
                            </div>
                    </div>

                    <div class="col-md-4">
                        <h4 align="center">CALIBRE (mp)<input type="checkbox" class="chkplas" class="minimal" value="chk_calibre" name="chksellado[]" ></h4>
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
                          <td><?php echo $fila->ALTURAIZQ; ?></td>
                          <td><?php echo $fila->ALTURADER; ?></td>
                          <td><?php echo $fila->ALTURAENC; ?></td>
                          <td><?php echo $fila->ALTURADEB; ?></td>
                          <td><?php echo $fila->ALTURACEN; ?></td>




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
                                <th>TIPO DE SELLADO<input type="checkbox" class="chkplas" class="minimal" value="chk_sellado" name="chksellado[]" ></th>
                                <th>TIPO TROQUEL<input type="checkbox" class="chkplas" class="minimal" value="chk_troquel" name="chksellado[]" ></th>
                               </tr>
                                    </thead>
                                    <tbody> 
                                    
                      <tr>
                      
                            <td><?php echo $fila->ANCHOFLL; ?></td>
                            <td><?php echo $fila->TIPOFLL; ?></td>
                            <td><?php echo $fila->ANCHOSOL; ?></td>
                            <td><?php echo $fila->TIPOSOL; ?></td>
                            <td><?php echo $fila->TIPOSLL; ?></td>
                            <td><?php echo $fila->TIPOTRQ; ?></td>
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
                          <th>PERFORACIONES<input type="checkbox" class="chkplas" class="minimal" value="chk_perforaciones" name="chksellado[]" ></th>                              
                          <td><?php echo $fila->PERFORAS; ?></td>
                          <th>DIAMETRO<input type="checkbox" class="chkplas" class="minimal" value="chk_diametro" name="chksellado[]" ></th>
                          <td><?php echo $fila->DIAMETRO; ?></td>
                          <th>EMPAQUES X PAQUETE<input type="checkbox" class="chkplas" class="minimal" value="chk_empaque" name="chksellado[]" ></th>
                          <td><?php echo $fila->EMPXPAQ; ?></td>
                          </tr>     
                          
                          <tr>
                          <th>PERFORACIONES FONDO</th> 
                          <td><?php echo $fila->PERFORASF; ?></td>
                          <th>DIAMETRO</th>
                          <td><?php echo $fila->DIAMETROS; ?></td>
                          <th>EMPAQUES X BULTO</th>
                          <td><?php echo $fila->EMPXBUL; ?></td> 
                          </tr> 

                          <tr>     
                          <th>PERFORACIONES SOLAPA</th> 
                          <td><?php echo $fila->PERFORASS; ?></td>
                          <th>DIAMETRO</th>
                          <td><?php echo $fila->DIAMETROS; ?></td>
                          <th>PESO PAQUETE</th>
                          <td><?php echo $fila->PESOXPAQ; ?></td> 
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
                      
                            <td><?php echo $fila->PRECORTE; ?></td>
                            <td><?php echo $fila->PASOPREC1." - ".$fila->PASOPREC2; ?></td>
                            <td><?php echo $fila->MAQUINA; ?></td>
                            <td><?php echo $fila->UNDTURNO; ?></td>
                            

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
                                    
                      <tr>
                      
                            <td><input type="date" min=2014-01-01 class="form-control" name="fechrefi">   </td>
                            <td></td>
                            <td><?php echo $fila->TIPOPED; ?></td>
                            <td ><?php echo $fila->MATERIAL; ?></td>

                            

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
                        <th>OBSERVACIONES DE CALIDAD</th>
                        </tr>
                       <tbody> 
                          <tr> 
                          <td><?php echo $fila->OBSERVA1.", ".$fila->OBSERVA2.", ".$fila->OBSERVA3.", ".$fila->OBSERVA4.", ".$fila->OBSERVA5.", ".$fila->OBSERVA6.", ".$fila->OBSERVA7.", ".$fila->OBSERVA8?></td>  
                          <td>
                            <?php $obsCal = "SELECT * FROM dbo.SELLADO sell inner join  dbo.OBSCALIDAD cal on sell.NIT = cal.NIT where sell.NIT = '$fila->NIT' and proceso = 'SELLADO' and sell.ORDENNRO = '$pedido'";
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
     <?php $plano = rutaPlano($fila->CODIGO);?>                     
                   <?php
            }
            sqlsrv_close( $connPlas );
            ?>
            <div class="row">
               <div class="col-xs-4">
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
                        <a class="btn btn-block btn-primary" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/db/sellado/control_requisitos/requisitos.php" style="text-decoration: none;">Cancelar</a>
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