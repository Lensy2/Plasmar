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
  } 


  
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
            Detalles            
            <small>Control De Requisitos</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Detalles</a></li>
            <li><a href="#">Control De Requisitos</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">            
            <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-fw fa-eye"></i>Detalles - Control De Requisitos</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
            
            <?php


            $sellado = "SELECT * FROM sellado_requisitos WHERE num_orden='$pedido' ";

            $registrosSell = sqlsrv_query($connSCPBD,$sellado);
            if( $registrosSell === false ) {
            die( print_r( sqlsrv_errors(), true));
            }
              $datos = sqlsrv_fetch_array($registrosSell);
              $sellado = explode(', ', $datos['sellado']);

               $registrossell_ = sqlsrv_query($connPlas,$leerSell);

               while ($fila = sqlsrv_fetch_object($registrossell_)) {

                  //Ruta Imgs Boca
              $rutaBoc = substr($fila->FTIPOBOCA, 2);
              $rutaBocLimpia = trim($rutaBoc);          
              $nomBoc = rutaBoca($rutaBocLimpia);
              $imgBoca = "<img src='ftp://hestia/Plasmar/Producci/$nomBoc'/>";
             
          
            //$fila = sqlsrv_fetch_object($registrosLam);
            //echo $leerLam;
            ?>
        <!--- Descripcion General Orden de Laminacion -->
        <h3 align="center">Descripción General</h3>
        <br>
            <form action="actualizar_requisitos.php" method="post" accept-charset="utf-8">
                <div class="table-responsive"> 
                    <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Sellado N°</th>
                        <th>Fecha Entrega</th>
                        <th>Cliente</th>
                        <th>NIT</th>
                        <th>Descripción<input type="checkbox" class="chkplas" class="minimal" disabled value="chk_descripcion"  <?php if(in_array('chk_descripcion',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
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
                                <th>Kg PEDIDOS<input type="checkbox" class="chkplas" class="minimal" disabled value="chk_kgpedidos" <?php if(in_array('chk_kgpedidos',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
                                <th>BOLSAS PEDIDAS<input type="checkbox" class="chkplas" class="minimal" disabled value="chk_bolsas" <?php if(in_array('chk_bolsas',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
                                <th>VELOCIDAD SELLADO (UNI X MIN)<input type="checkbox" class="chkplas" class="minimal" disabled value="chk_velocidad" <?php if(in_array('chk_velocidad',$sellado)){echo 'checked="checked"';}?>  name="chksellado[]" ></th>
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
                        <h4 align="center">ANCHO (cms)<input type="checkbox" class="chkplas" class="minimal" disabled value="chk_ancho" <?php if(in_array('chk_ancho',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></h4>
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
                        <h4 align="center">LARGO (cms)<input type="checkbox" class="chkplas" class="minimal" disabled value="chk_largo" <?php if(in_array('chk_largo',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></h4>
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
                        <h4 align="center">CALIBRE (mp)<input type="checkbox" class="chkplas" disabled class="minimal" value="chk_calibre" <?php if(in_array('chk_calibre',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></h4>
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
                                <th>TIPO DE SELLADO<input type="checkbox" class="chkplas" class="minimal" disabled value="chk_sellado" <?php if(in_array('chk_sellado',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
                                <th>TIPO TROQUEL<input type="checkbox" class="chkplas" class="minimal" disabled value="chk_troquel" <?php if(in_array('chk_troquel',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
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
                          <th>PERFORACIONES<input type="checkbox" class="chkplas" class="minimal" disabled value="chk_perforaciones" <?php if(in_array('chk_perforaciones',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>                              
                          <td><?php echo $fila->PERFORAS; ?></td>
                          <th>DIAMETRO<input type="checkbox" class="chkplas" class="minimal" disabled value="chk_diametro" <?php if(in_array('chk_diametro',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
                          <td><?php echo $fila->DIAMETRO; ?></td>
                          <th>EMPAQUES X PAQUETE<input type="checkbox" class="chkplas" class="minimal" disabled value="chk_empaque" <?php if(in_array('chk_empaque',$sellado)){echo 'checked="checked"';}?> name="chksellado[]" ></th>
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
                              
                            <td><input type="date" min=2014-01-01 class="form-control" disabled value="<?php echo date_format($datos['fechase'],'Y-m-d') ?>"  name="fechrefi">   </td>
                            <td><?php?></td>
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
                        </tr>
                       <tbody> 
                          <tr> 
                          <td><?php echo $fila->OBSERVA1.", ".$fila->OBSERVA2.", ".$fila->OBSERVA3.", ".$fila->OBSERVA4.", ".$fila->OBSERVA5.", ".$fila->OBSERVA6.", ".$fila->OBSERVA7.", ".$fila->OBSERVA8?></td>                            
                          </tr>           
                        </tbody> 
                      </thead> 
                                    
                    </table> 
                </div>
              </div>
                         
            <?php
            }
            sqlsrv_close( $connPlas );
            sqlsrv_close( $connSCPBD );
            ?>
           
           <div class="row">
               <div class="col-xs-4">
                    <b>Operario responsable</b>
                      <i id="limpiar" style="cursor: pointer;" class="fa fa-times"></i><br><br>
                      <input id="operarios" type="text" class="form-control" disabled placeholder="Nombre Operario" value="<?php echo $datos['operario']?>" name="operario" required> 
               </div>
               <div class="col-xs-9">
                 <br>
                  
                  <div class="col-md-2">
                        <a class="btn btn-block btn-primary" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/sellado/control_requisitos/requisitos.php" style="text-decoration: none;">Volver</a>
                  </div>
               </div>
            </div>



            </form>


            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- =============================================== -->


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