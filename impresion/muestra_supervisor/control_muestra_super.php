<?php
  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
  $archivo = 'Supervisor';
  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');

 if (isset($_GET['pedido'])){
    $pedido = $_GET['pedido'];
  } 

  include '../../includes/dbconfig.php';
  include '../../model/impresion.php';
  include '../../includes/impresion/header.php';
  

?>

  <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Control De Muestra
            <small>Supervisor</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Supervisor</a></li>
            <li><a href="#">Control De Muestra</a></li>
            <li class="active">Supervisor</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">            
            <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-fw fa-plus-circle"></i>Control De Muestra - Supervisor</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
          
            
                       
            <?php

            $registrosImp = sqlsrv_query($connPlas, $leerImp);
            while($fila = sqlsrv_fetch_object($registrosImp))
            {
              
            ?> 


             
               <?php
              //conectamos la base de datos de impresor y traemos los datos de los campos
              // impresor
               $usuario_imp="SELECT * from dbo.cm_impresor ci inner join dbo.usuarios us on ci.Idusuario=us.Idusuario where ci.num_orden = '$pedido'";
              $usuario_mat="SELECT * from dbo.cm_matizador ca inner join dbo.usuarios us on ca.Idusuario=us.Idusuario where ca.num_orden = '$pedido'";
              $usuario_ana="SELECT * from dbo.cm_analista cmana inner join dbo.usuarios us on cmana.Idusuario=us.Idusuario where cmana.num_orden = '$pedido'";

              $leerUs_imp = sqlsrv_query($connSCPBD,$usuario_imp);               
              $leerUs_mat = sqlsrv_query($connSCPBD,$usuario_mat);
              $leerUs_ana = sqlsrv_query($connSCPBD,$usuario_ana);

              $dataUs_imp = sqlsrv_fetch_array($leerUs_imp);
              $dataUs_mat = sqlsrv_fetch_array($leerUs_mat); 
              $dataUs_ana = sqlsrv_fetch_array($leerUs_ana); 
              $impresor = '';

              $control="SELECT * FROM dbo.cm_impresor ci inner join dbo.cm_matizador ma  on ci.num_orden=ma.num_orden inner join dbo.cm_analista an on an.num_orden=ci.num_orden where ci.num_orden = '$pedido'";
              $leer = sqlsrv_query($connSCPBD,$control);

              

              $datos = sqlsrv_fetch_array($leer);
              $impresor = explode(', ', $datos['impresor']);
              $matizador = explode(', ', $datos['matizador']);
              $analista = explode(', ', $datos['analista']);

              

              ?>



                <h3 align="center">SUPERVISOR</h3><br>
                  

                        <div class="nav-tabs-custom">

                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Impresor</a></li>
                                               <li><a href="#tab_2" data-toggle="tab">Matizador</a></li>
                                               <li><a href="#tab_3" data-toggle="tab">Analista De Laboratorio</a></li>
                                               <li><a href="#tab_4" data-toggle="tab">Supervisor</a></li>
                                               <?php 
                                                $tipopedido = trim($fila->TIPOPED);
                                                if ($tipopedido == 'REPETICION') {
                                                 echo "<li><a href='#tab_5' data-toggle='tab'>Pedido Nuevo</a></li>";
                                               }?>
                            </ul>

                                  <!-- ////// Inicio - formulario que contiene todos los parametros que se van a enviar ///////-->
                            <form action="procesar_cmsuper.php" method="post" accept-charset="utf-8">

                            
                             <div class="tab-content">

                                    <div class="tab-pane active" id="tab_1">
                                        <!--// Inicio Contenido Tornillo 1 \\-->
                                        <input type="hidden" value="1" name="tor1">
                                         
                                            <div class="table-responsive"> 
                                              <table class="table table-bordered"> 
                                                  <thead> 
                                                   <input type="hidden" name="num_orden" value='<?php echo $fila->PEDIDO; ?>'>

                                                  <tr>                                            
                                                  <th>LIMPIEZA MANGUERAS,CANOAS,BOMBAS<input  type="checkbox" class="chkplas"  class="minimal" disabled value="chk_limpieza" <?php if(in_array('chk_limpieza',$impresor)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></th>
                                                  
                                                    
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
                                                                <td><?php echo $datos['observa1']?></td>
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
                                                        <td><?php echo $datos['observa2'] ?></td>
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


                                                          
                                                                  <thead> 
                                                            <tr>                                            
                                                            <th>LISTA</th>
                                                            <th>ANALISTA</th>
                                                          </tr> 
                                                            <th>TONOS</th>
                                                              <td><input  type="checkbox" class="chkplas"  class="minimal" value="chk_tonos"disabled <?php if(in_array('chk_tonos',$analista)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></td>
                                                          </tr>                           
                                                          <tr>
                                                            <th>IMPRESION</th>
                                                              <td><input  type="checkbox" class="chkplas"  class="minimal" value="chk_impresion"disabled <?php if(in_array('chk_impresion',$analista)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></td>
                                                          </tr>
                                                          <tr>
                                                            <th>REGISTRO</th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_registro"disabled <?php if(in_array('chk_registro',$analista)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></td>                                      
                                                          </tr>
                                                          <tr>
                                                            <th>ALTURAS</th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_alturas"disabled <?php if(in_array('chk_alturas',$analista)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></td>
                                                            </tr>
                                                          <tr>
                                                            <th>SENTIDO DE EMBOBINADO</th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_santido"disabled <?php if(in_array('chk_santido',$analista)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></td>
                                                            </tr> 
                                                          <tr>
                                                            <th>PIE IMPRENTA</th>
                                                              <td><input type="number" class="form-control" step="any" value="<?php echo $datos['pie_imprenta']  ?>" name="pie_imprenta" disabled></td>
                                                             
                                                          </tr>
                                                          <tr>
                                                            <th>ADHESION DE TINTA </th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_adhesion"disabled <?php if(in_array('chk_adhesion',$analista)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></td>  
                                                          </tr>
                                                              
                                                          <tr>
                                                            <th>PEDIDO NUEVO/CAMBIO</th>
                                                              <td><input  type="checkbox" class="chkplas"  class="minimal" value="chk_pedido"disabled <?php if(in_array('chk_pedido',$analista)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></td>                              
                                                          </tr>
                                                          <tr>
                                                            <th>MUESTRA ANTERIOR (Codigo Atlas)</th>
                                                              <td><input  type="checkbox" class="chkplas"  class="minimal" value="chk_muestra"disabled <?php if(in_array('chk_muestra',$analista)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></td>
                                                          </tr>
                                                          <tr>
                                                            <th>COD BARRAS</th>
                                                              <td><input type="text" class="form-control" step="any" value="<?php echo $datos['cod_barras']  ?>" name="cod_barras" disabled> </td>
                                                          </tr>
                                                          <tr>
                                                            <th>FECHA/LOTES CORREO</th>
                                                              <td><input type="text" class="form-control" step="any" value="<?php echo $datos['fecha_venlote']  ?>" name="fecha_venlote" disabled></td>
                                                          </tr>
                                                            
                                                            </thead> 
                                                         </table> 
                                                    </div>



                                                      <h4 align="center">MATERIALES ESPECIALES (Papel,Pet,BOPP,MONOPP, etc)</h4>

                                                          <div class="table-responsive"> 
                                                               <table class="table table-bordered"> 
                                                                  <thead> 

                                                                   <th>PROVEEDOR</th>
                                                               <td><?php echo $datos['proveedor'] ?></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <th>TIPO DE MATERIAL</th>
                                                               <td><?php echo $datos['material'] ?></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <th>MICRAS</th>
                                                               <td><?php echo $datos['micras'] ?></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <th>ANCHO</th>
                                                               <td><?php echo $datos['ancho'] ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                    <th>TENSION SUPERFICIAL</th>
                                                               <td><?php echo $datos['tension'] ?></td>
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
                                                      <tr>
                                                                <td><?php echo $datos['observa3'] ?></td>
                                                        </tr>
                                                        <tr>
                                                        <th>RESPONSABLE</th>   
                                                        </tr>
                                                        <td><?php echo $dataUs_ana['nombre']." ".$dataUs_ana['apellido']; ?></td>
                                                          <tbody> 
                                                            <tr>   

                                                            </tr>           
                                                           </tbody> 
                                                      </thead> 
                                                     </table> 
                                                  </div>
                                                      <br>                                                                 
                                                      <br>                                            

                                </div>







                                    <div class="tab-pane" id="tab_4">
                                        <!--// Inicio Contenido Tornillo 1 \\-->
                                        <input type="hidden" value="4" name="">

                                            <div class="table-responsive">    
                                                <table class="table table-bordered">                                                            


                                                          
                                                        <thead> 
                                                            <tr>                                            
                                                            <th>LISTA</th>
                                                            <th>SUPERVISOR</th>
                                                          </tr>
                                                          <tr>
                                                            <th>LIMPIEZA MAQUINA UHT</th>
                                                            <td><input  type="checkbox" class="chkplas"  class="minimal"  value="chk_calidad"   name="chkRequisitos[]" ></td>
                                                            </tr>
                                                            <tr> 
                                                            <th>TONOS</th>
                                                              <td><input  type="checkbox" class="chkplas"  class="minimal" value="chk_tonos"  name="chkRequisitos[]" ></td>
                                                          </tr>                             
                                                          <tr>
                                                            <th>IMPRESION</th>
                                                              <td><input  type="checkbox" class="chkplas"  class="minimal" value="chk_impresion" name="chkRequisitos[]" ></td>
                                                          </tr>
                                                          <tr>
                                                            <th>REGISTRO</th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_registro" name="chkRequisitos[]" ></td>                                      
                                                          </tr>
                                                          <tr>
                                                            <th>ALTURAS</th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_alturas" name="chkRequisitos[]" ></td>
                                                            </tr>
                                                          <tr>
                                                            <th>SENTIDO DE EMBOBINADO</th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_santido" name="chkRequisitos[]" ></td>
                                                            </tr> 
                                                          <tr>
                                                            <th>PIE IMPRENTA</th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_imprenta" name="chkRequisitos[]" ></td>
                                                             
                                                          </tr>
                                                          <tr>
                                                            <th>ADHESION DE TINTA </th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_adhesion" name="chkRequisitos[]" ></td> </tr>
                                                              <tr>
                                                            <th>ANILOX</th>
                                                              <td><input type="text" class="form-control" name="anilox"></td>  
                                                          </tr>  
                                                            <tr>
                                                            <th>VISCOCIDAD DEL BARNIZ, SI ES REFERENCIA CALOR CONSTANTE (SEGUNDOS) o UHT </th>
                                                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_visco" name="chkRequisitos[]" ></td>  
                                                          </tr> 
                                                            <tr>
                                                            <th>VELOCIDAD MAQUINA</th>
                                                              <td><input type="text" class="form-control" name="vel_maquina" ></td>  
                                                          </tr>                                                        
                                                            </thead> 
                                                         </table> 
                                                    </div>

                                                    <div class="table-responsive"> 
                                                        <table class="table table-bordered"> 
                                                        <thead> 
                                                         <tr>
                                                        <th>VISCOCIDAD DEL BARNIZ Y OBSERVACIONES</th>
                                                      </tr>

                                                          <tbody> 
                                                            <tr>   
                                                              <td><div class="col-md-8"><textarea rows="4" cols="70" class="form-control" name="coment4"></textarea></td>

                                                            </tr>           
                                                           </tbody> 
                                                      </thead> 
                                                     </table> 
                                                  </div>
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
                        <a class="btn btn-block btn-primary" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/impresion/premontajes/premontajes.php" style="text-decoration: none;">Cancelar</a>
                  </div>
               </div>
            </div>     
                                </div>


                   <div class="tab-pane" id="tab_5">
                             <!--// Inicio Contenido Tornillo 1 \\-->
                        <input type="hidden" value="2" name="">

                            <h3 align="center">Montaje</h3>
                            <div class="table-responsive"> 
                                <table class="table table-bordered"> 
                                    <thead> 
                                        <tr>                                            
                                            <th></th>
                            <th>TINTERO 1<th>
                            <th>TINTERO 2<th>
                            <th>TINTERO 3<th>
                            <th>TINTERO 4<th>
                          </tr>
                          <tr>
                            <th>STICK</th>
                              <td><input type="text" id="color1" class="form-control" name="color1"><td>
                              <td><input type="text" id="color2" class="form-control" name="color2"><td>
                              <td><input type="text" id="color3" class="form-control" name="color3"><td>
                              <td><input type="text" id="color4" class="form-control" name="color4"><td>
                          </tr>
                          <tr>
                            <th>ANILOX</th>
                              <td><input type="text" id="lineat1" class="form-control" name="lineat1"><td>
                              <td><input type="text" id="lineat2" class="form-control" name="lineat2"><td>
                              <td><input type="text" id="lineat3" class="form-control" name="lineat3"><td>
                              <td><input type="text" id="lineat4" class="form-control" name="lineat4"><td>
                          </tr>

                                        
                                    </thead> 
                                 </table> 
                            </div>
                            <br>
                            <div class="table-responsive"> 
                                <table class="table table-bordered"> 
                                    <thead> 
                                        <tr>                                            
                                            <th></th>
                            <th>TINTERO 5<th>
                            <th>TINTERO 6<th>
                            <th>TINTERO 7<th>
                            <th>TINTERO 8<th>
                          </tr>
                          <tr>
                            <th>STICK</th>
                              <td><input type="text" id="color5" class="form-control" name="color5"><td>
                              <td><input type="text" id="color6" class="form-control" name="color6"><td>
                              <td><input type="text" id="color7" class="form-control" name="color7"><td>
                              <td><input type="text" id="color8" class="form-control" name="color8"><td>
                              </tr>
                          <tr>
                            <th>ANILOX</th>
                              <td><input type="text" id="lineat5" class="form-control" name="lineat5"><td>
                              <td><input type="text" id="lineat6" class="form-control" name="lineat6"><td>
                              <td><input type="text" id="lineat7" class="form-control" name="lineat7"><td>
                              <td><input type="text" id="lineat8" class="form-control" name="lineat8"><td>
                          </tr>


                           </thead> 
                                    
                              </table> 


                              

                            </div>
                  
                        </div>
                  <br>                                            
                                        

                       </div>
                                        
                       </div> <!--// tap content \\-->
                </div>                        
            <?php } sqlsrv_close( $connPlas );?>
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

