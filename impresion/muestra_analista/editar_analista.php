<?php

    //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

  $archivo = 'nuevo_control_mez';
    include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');

  if (isset($_GET['pedido'])){
    $pedido = $_GET['pedido'];
  }
  include '../../includes/dbconfig.php';
  include '../../includes/impresion/header.php';
  include '../../model/impresion.php';

?>

  <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Control De Muestra
            <small>Analista</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Analista</a></li>
            <li><a href="#">Control De Muestra</a></li>
            <li class="active">Analista</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">            
            <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-fw fa-plus-circle"></i>Control De Muestra - Analista Laboratorio </h3>
            </div><!-- /.box-header -->
            <div class="box-body">
          
            

            
            
               <?php
              //conectamos la base de datos de impresor y traemos los datos de los campos
              // impresor
               $usuario_imp="SELECT * from dbo.cm_impresor ci inner join dbo.usuarios us on ci.Idusuario=us.Idusuario where ci.num_orden = '$pedido'";
              $usuario_mat="SELECT * from dbo.cm_matizador ca inner join dbo.usuarios us on ca.Idusuario=us.Idusuario where ca.num_orden = '$pedido'";
              $leerUs_imp = sqlsrv_query($connSCPBD,$usuario_imp);               
              $leerUs_mat = sqlsrv_query($connSCPBD,$usuario_mat);

              $dataUs_imp = sqlsrv_fetch_array($leerUs_imp);
              $dataUs_mat = sqlsrv_fetch_array($leerUs_mat); 
               
              $impresor = '';

              $control="SELECT * FROM dbo.cm_impresor ci inner join dbo.cm_matizador ma  on ci.num_orden=ma.num_orden inner join dbo.cm_analista an on an.num_orden=ci.num_orden where ci.num_orden = '$pedido'";
              $leer = sqlsrv_query($connSCPBD,$control);


              $datos = sqlsrv_fetch_array($leer);
              $impresor = explode(', ', $datos['impresor']);
              //leemos los datos de las tablas matizador e impresor
              $leer_ = sqlsrv_query($connSCPBD,$control);
              $fila = sqlsrv_fetch_object($leer_) ;  
              


              
              ?>


                      <!-- Descripcion General aseo maquina  -->
            <h3 align="center">Analista De Laboratorio</h3><br>
                                            


              

                        <div class="nav-tabs-custom">

                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Impresor</a></li>
                                               <li><a href="#tab_2" data-toggle="tab">Matizador</a></li>
                                               <li><a href="#tab_3" data-toggle="tab">Analista De Laboratorio</a></li>
                            </ul>

                                  <!-- ////// Inicio - formulario que contiene todos los parametros que se van a enviar ///////-->
                            <form action="actualizar_analista.php" method="post" accept-charset="utf-8">

                            
                             <div class="tab-content">

                                    <div class="tab-pane active" id="tab_1">
                                        <!--// Inicio Contenido Tornillo 1 \\-->
                                        <input type="hidden" value="1" name="tor1">
                                         
                                            <div class="table-responsive"> 
                                              <table class="table table-bordered"> 
                                                  <thead> 
                                                   <input type="hidden" name="num_orden" value='<?php echo $fila->num_orden; ?>'>

                                                  <tr>                                            
                                                  <th>LIMPIEZA MANGUERAS,CANOAS,BOMBAS<input  type="checkbox" class="chkplas"  class="minimal" value="chk_limpieza" disabled <?php if(in_array('chk_limpieza',$impresor)){echo 'checked="checked"';}?>name="chkImpresor[]" ></th>
                                                    
                                                  
                                                    
                                                  </tr>
                                               </thead> 
                                               </table> 
                                           </div> 


                                            <div class="table-responsive">    
                                                <table class="table table-bordered"> 
                                               
                                                          <tr>                                            
                                                            <th>LISTA</th>
                                                            <th>IMPRESOR</th>
                                                          </tr>                            
                                                          <tr>
                                                            <th>IMPRESION</th>
                                                              <td><input  type="checkbox" class="chkplas"  class="minimal" value="chk_impresion"disabled <?php if(in_array('chk_impresion',$impresor)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></td>
                                                          </tr>
                                                          <tr>
                                                            <th>REGISTRO</th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_registro"disabled <?php if(in_array('chk_registro',$impresor)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></td>                                      
                                                          </tr>
                                                          <tr>
                                                            <th>ALTURAS</th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_alturas"disabled <?php if(in_array('chk_alturas',$impresor)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></td>
                                                            </tr>
                                                          <tr>
                                                            <th>SENTIDO DE EMBOBINADO</th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_santido"disabled <?php if(in_array('chk_santido',$impresor)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></td>
                                                            </tr> 
                                                          <tr>
                                                            <th>PIE IMPRENTA</th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_imprenta"disabled <?php if(in_array('chk_imprenta',$impresor)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></td>
                                                             
                                                          </tr>
                                                          <tr>
                                                            <th>ADHESION DE TINTA </th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_adhesion"disabled <?php if(in_array('chk_adhesion',$impresor)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></td>  
                                                          </tr>
                                                            <tr>
                                                            <th>VISCOCIDAD DEL BARNIZ, SI ES REFERENCIA CALOR CONSTANTE (SEGUNDOS) </th>
                                                              <td><input type="text" class="form-control" value="<?php echo $dataUs_imp['visco_bar'] ?>" disabled></td>  
                                                          </tr>   
                                                          
                                                    </thead> 

                                                      </table>



                                                  <div class="table-responsive"> 
                                                      <table class="table table-bordered"> 
                                                          <thead> 
                                                              <tr>
                                                              <th>OBSERVACIONES</th>
                                                              </tr>
                                                                <td><?php echo $fila->observa1; ?></td>
                                                              <tr>
                                                              <th>RESPONSABLE</th>
                                                              </tr>
                                                              <td><?php echo $dataUs_imp['nombre']." ".$dataUs_imp['apellido']; ?></td>
                                                          </thead>
                                                          <tbody> 
                                                              <tr>                                                                   
                                                              </tr>           
                                                          </tbody> 
                                                        </table>   
                                                  </div>

                                                               

           

                                              
                                                  <br> 

                                        </div>
                                    </div>



                                 <div class="tab-pane" id="tab_2">
                                        <!--// Inicio Contenido Tornillo 1 \\-->
                                        <input type="hidden" value="2" name="">

                                            <div class="table-responsive">    
                                                <table class="table table-bordered"> 

                                                                <?php 
                                                  $matizador = '';

                                                 $matizador="SELECT * FROM cm_matizador WHERE num_orden = '$pedido'"; 
                                                  $leer = sqlsrv_query($connSCPBD,$matizador);


                                                  $datos = sqlsrv_fetch_array($leer);
                                                  $matizador = explode(', ', $datos['matizador']);
                                                  
                                                  
                                                 ?>
                                                       
                                                                   <thead>                            

                                                                    <tr>                                            
                                                                      <th>LISTA</th>
                                                                      <th>MATIZADOR</th>
                                                                    </tr>  
                                                                    <tr>
                                                                      <th>TONOS</th>
                                                                        <td><input type="checkbox" class="chkplas" class="minimal" value="chk_tonos"disabled <?php if(in_array('chk_tonos',$matizador)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></td>                                      
                                                                    </tr>
                                                                </thead> 
                                                        </table> 
                                                       </div>  


                                                      <div class="table-responsive"> 
                                                          <table class="table table-bordered"> 
                                                          <thead> 
                                                           <tr>
                                                          <th>OBSERVACIONES</th>
                                                        </tr>
                                                          <td><?php echo $fila->observa2; ?></td>
                                                        <tr>
                                                        <th>RESPONSABLE</th>
                                                        </tr>
                                                        <td><?php echo $dataUs_mat['nombre']." ".$dataUs_mat['apellido']; ?></td>
                                                            <tbody> 
                                                              <tr>   

                                                              </tr>           
                                                             </tbody> 
                                                        </thead> 
                                                       </table> 
                                                    </div>
                                                        <br>                                            
                                        

                                              </div>
                                        




                                 <div class="tab-pane" id="tab_3">
                                        <!--// Inicio Contenido Tornillo 1 \\-->
                                        <input type="hidden" value="3" name="">

                                            <div class="table-responsive">    
                                                <table class="table table-bordered">                                                            
                                                      <?php 
                                                  $analista = '';

                                                 $analista="SELECT * FROM cm_analista WHERE num_orden = '$pedido'"; 
                                                  $leer = sqlsrv_query($connSCPBD,$analista);


                                                  $datos = sqlsrv_fetch_array($leer);
                                                  $analista = explode(', ', $datos['analista']);


                                                  





                                                  
                                                 ?>
                                                          
                                                                  <thead> 
                                                            <tr>                                            
                                                            <th>LISTA</th>
                                                            <th>ANALISTA</th>
                                                          </tr>       
                                                           <th>TONOS</th>
                                                                        <td><input type="checkbox" class="chkplas" class="minimal" value="chk_tonos"<?php if(in_array('chk_tonos',$analista)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></td>                                      
                                                            </tr>                     
                                                          <tr>
                                                            <th>IMPRESION</th>
                                                              <td><input  type="checkbox" class="chkplas"  class="minimal" value="chk_impresion"<?php if(in_array('chk_impresion',$analista)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></td>
                                                          </tr>
                                                          <tr>
                                                            <th>REGISTRO</th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_registro"<?php if(in_array('chk_registro',$analista)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></td>                                      
                                                          </tr>
                                                          <tr>
                                                            <th>ALTURAS</th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_alturas"<?php if(in_array('chk_alturas',$analista)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></td>
                                                            </tr>
                                                          <tr>
                                                            <th>SENTIDO DE EMBOBINADO</th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_santido"<?php if(in_array('chk_santido',$analista)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></td>
                                                            </tr> 
                                                          <tr>
                                                            <th>PIE IMPRENTA</th>
                                                              <td><input type="number" class="form-control" step="any" value="<?php echo $datos['pie_imprenta']  ?>" name="pie_imprenta"></td>
                                                             
                                                          </tr>
                                                          <tr>
                                                            <th>ADHESION DE TINTA </th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_adhesion"<?php if(in_array('chk_adhesion',$analista)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></td>  
                                                          </tr>
                                                          <tr>
                                                            <th>PEDIDO NUEVO/CAMBIO</th>
                                                              <td><input  type="checkbox" class="chkplas"  class="minimal" value="chk_pedido"<?php if(in_array('chk_pedido',$analista)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></td>                              
                                                          </tr>
                                                          <tr>
                                                            <th>MUESTRA ANTERIOR (Codigo Atlas)</th>
                                                              <td><input  type="checkbox" class="chkplas"  class="minimal" value="chk_muestra"<?php if(in_array('chk_muestra',$analista)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></td>
                                                          </tr>
                                                          <tr>
                                                            <th>COD BARRAS</th>
                                                              <td><input type="text" class="form-control" step="any" value="<?php echo $datos['cod_barras']  ?>" name="cod_barras"></td>                                                        </tr>
                                                          <tr>
                                                            <th>FECHA/LOTES CORREO</th>
                                                              <td><input type="text" class="form-control" step="any" value="<?php echo $datos['fecha_venlote']  ?>" name="fecha_venlote"></td>
                                                          </tr>

                                                          </thead> 
                                                         </table> 
                                                    </div>



                                                      <h4 align="center">MATERIALES ESPECIALES (Papel,Pet,BOPP,MONOPP, etc)</h4>

                                                          <div class="table-responsive"> 
                                                               <table class="table table-bordered"> 
                                                                  <thead> 

                                                                  <tr>
                                                                    <th>PROVEEDOR</th>
                                                                      <td><div class="col-md-4"><input type="text" class="form-control" value="<?php echo $fila->proveedor; ?>" name="proveedor"></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <th>TIPO DE MATERIAL</th>
                                                                      <td><div class="col-md-4"><input type="text" class="form-control" value="<?php echo $fila->material; ?>" name="material"></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <th>MICRAS</th>
                                                                      <td><div class="col-md-4"><input type="text" class="form-control" value="<?php echo $fila->micras; ?>" name="micras"></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <th>ANCHO</th>
                                                                      <td><div class="col-md-4"><input type="text" class="form-control" value="<?php echo $fila->ancho; ?>" name="ancho"></td>
                                                                    </tr>
                                                                    <tr>
                                                                    <th>TENSION SUPERFICIAL</th>
                                                                      <td><div class="col-md-4"><input type="text" class="form-control" value="<?php echo $fila->tension; ?>" name="tension"></td>
                                                                    </tr>
                                                            </thead> 
                                                         </table> 
                                                    </div>
                                                    





                                                    <div class="table-responsive"> 
                                                        <table class="table table-bordered"> 
                                                        <thead> 
                                                         <tr>
                                                        <th>LOTE Y OBSERVACIONES</th>
                                                      </tr>

                                                          <tbody> 
                                                            <tr>   
                                                              <td><div class="col-md-8"><textarea rows="4" cols="70" class="form-control" name="observa"><?php echo $fila->observa3; ?></textarea></td>
                                                            </tr>           
                                                           </tbody> 
                                                      </thead> 
                                                     </table> 
                                                  </div>
                                                      <br>



                                                                 
                                                        <br>



               <?php
            
           sqlsrv_close( $connPlas );
            ?>                                          
  <div class="row">
               <div class="col-xs-4">
                    <b>Usuario responsable</b>
                      <br><br>
                      <input type="text" class="form-control"  value="<?php echo $_SESSION["nombreuser"]; ?>" disabled>
               </div>
               <div class="col-xs-9">
                 <br>
                  <div class="col-md-2">
                        <input type="submit" class="btn btn-block btn-primary" name="aprob" value="Aprobar">
                  </div>                  
                  <div class="col-md-2">
                        <input type="submit" class="btn btn-block btn-primary" name="guarda" value="Guardar">
                  </div>                      
                  <div class="col-md-2">
                        <a class="btn btn-block btn-primary" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/impresion/muestra_analista/controles_analista.php" style="text-decoration: none;">Cancelar</a>
                  </div>
               </div>
            </div>

            </form>


            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- =============================================== -->


<?php include '../../includes/impresion/footer.php';

//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario 
?>

