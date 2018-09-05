<?php
  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('laminacion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
  $archivo = 'control_req';

  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');

  if (isset($_GET['pedido'])){
    $pedido = $_GET['pedido'];
  } 


  
  include '../../includes/dbconfig.php';
  include '../../model/laminacion.php';
  include '../../includes/laminacion/header.php';
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
            $laminacion='';
            $laminacion = "SELECT * FROM laminacion_requisitos WHERE num_orden = '$pedido'";

            $registrosLam = sqlsrv_query($connSCPBD,$laminacion);
            if( $registrosLam === false ) {
            die( print_r( sqlsrv_errors(), true));
            }
              $datos = sqlsrv_fetch_array($registrosLam);
              $laminacion = explode(', ', $datos['laminacion']);

               $registrosLam_ = sqlsrv_query($connPlas,$leerLam);

               while ($fila = sqlsrv_fetch_object($registrosLam_)) {
            ?> 
        <!--- Descripcion General Orden de Laminacion -->
        <h3 align="center">Descripción General</h3>
        <br>
            <form action="actualizar_requisitos.php" method="post" accept-charset="utf-8">
                <div class="table-responsive"> 
                    <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Laminacion N°</th>
                        <th>Fecha Entrega</th>
                        <th>Cliente<input type="checkbox" class="chkplas" class="minimal" value="chk_cliente"<?php if(in_array('chk_cliente',$laminacion)){echo 'checked="checked"';}?> name="chklaminacion[]" ></th>
                        <th>NIT</th>
                        <th>Descripción<input type="checkbox" class="chkplas" class="minimal" value="chk_descripcion" <?php if(in_array('chk_cliente',$laminacion)){echo 'checked="checked"';}?> name="chklaminacion[]" ></th>
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
                                <th>Kg PEDIDOS</th>
                                <th>TIPO PEDIDO</th>
                                <th>RODILLO</th>
                                <th>GALGA</th>
                                <th>TAPER </th>
                                <th>GRAM</th>
                               </tr>
                                    </thead>
                                    <tbody> 
                                    
                      <tr>
                            <td><?php echo $fila->KILOS; ?></td>
                            <td><?php echo $fila->TIPOPED; ?></td>
                            <td><?php echo $fila->RODILLO; ?></td>
                            <td><?php echo $fila->GALGA; ?></td>
                            <td><?php echo $fila->TAPER; ?></td>
                            <td><?php echo $fila->GRAMAJE; ?></td>
                      </tr>
                          </tbody>
                        </table>
                        </div>



           <!--- AJUSTE DE MAQUINA Orden de Produccion Laminacion -->
           <h3 align="center">Ajuste De Maquina</h3>
            <br>
                        <div class="col-md-12">
                            <div class="table-responsive"> 
                                <table class="table table-bordered"> 
                                    <thead> 
                                        <tr> 
                                            <th>IMAGEN</th>
                                            <th>ANCHO<input type="checkbox" class="chkplas" class="minimal" value="chk_ancho" <?php if(in_array('chk_ancho',$laminacion)){echo 'checked="checked"';}?> name="chklaminacion[]"></th> 
                                            <th>PASO<input type="checkbox" class="chkplas" class="minimal" value="chk_paso" <?php if(in_array('chk_paso',$laminacion)){echo 'checked="checked"';}?> name="chklaminacion[]"></th> 
                                            <th>SUSTRATO</th> 
                                            <th>MATERIAL</th> 
                                            <th>IMP ?</th> 
                                            <th>EXT ?</th> 
                                        </tr> 
                                    </thead> 
                                    <tbody> 
                          <tr>
                          <th>MAX</th>                              
                          <td><?php echo $fila->ANCHOMX; ?></td>
                          <td><?php echo $fila->PASOMX; ?></td>
                          <td><?php echo $fila->SUSTRATO1; ?></td>
                          <td><?php echo $fila->MATERIAL1; ?></td>
                          <td><input type="checkbox" class="chkplas" class="minimal" value="chk_imp" <?php if(in_array('chk_imp',$laminacion)){echo 'checked="checked"';}?> name="chklaminacion[]"></td>
                          <td><input type="checkbox" class="chkplas" class="minimal" value="chk_ext" <?php if(in_array('chk_ext',$laminacion)){echo 'checked="checked"';}?> name="chklaminacion[]"></td> 
                          </tr>     
                          
                          <tr>
                          <th>OPTIMO</th> 
                          <td><?php echo $fila->ANCHO; ?></td>
                          <td><?php echo $fila->PASO; ?></td>
                          <td><?php echo $fila->SUSTRATO2; ?></td>
                          <td><?php echo $fila->MATERIAL2; ?></td>
                          <td></td>
                          <td></td> 
                          </tr> 

                          <tr>     
                          <th>MIN</th> 
                          <td><?php echo $fila->ANCHOMN; ?></td>
                          <td><?php echo $fila->PASOMN; ?></td>
                          <td><?php echo $fila->SUSTRATO3; ?></td>
                          <td><?php echo $fila->MATERIAL3; ?></td>
                          <td></td>
                          <td></td> 
                          </tr>   

                          <tr>   
                          <td></td>
                          <td></td>
                          <td><?php echo $fila->SUSTRATO4; ?></td>
                          <td><?php echo $fila->MATERIAL4; ?></td>
                          <td></td>
                          <td></td> 
                          <td></td> 
                          </tr>    

                                    </tbody> 

                                </table> 
                            </div>
                    </div>


           <!--- AJUSTE DE MAQUINA Orden de Produccion Laminacion -->
           
            <br>
                        <div class="col-md-12">
                            <div class="table-responsive"> 
                                <table class="table table-bordered"> 
                                    <thead> 
                                        <tr> 
                                            <th>NOMBRE</th> 
                                            <th>ANCHO PELICULA</th> 
                                            <th>CALIBRE</th> 
                                            <th>GRAM</th> 
                                            <th>%MAT</th> 
                                            <th>COLOR</th> 
                                        </tr> 
                                    </thead> 
                                                      
                                    <tbody>
                          <tr>
                          <td><?php echo $fila->NOMBRE1; ?></td>
                          <td><?php echo $fila->ANCHO1; ?></td>
                          <td><?php echo $fila->CALIBRE1; ?></td>
                          <td><?php echo $fila->GRAMAJE1; ?></td>
                          <td><?php echo $fila->PCTAJE1; ?></td>
                          <td><?php echo $fila->COLOR1; ?></td>
                          </tr>     
                            
                          <tr>
                          <td><?php echo $fila->NOMBRE2; ?></td>
                          <td><?php echo $fila->ANCHO2; ?></td>
                          <td><?php echo $fila->CALIBRE2; ?></td>
                          <td><?php echo $fila->GRAMAJE2; ?></td>
                          <td><?php echo $fila->PCTAJE2; ?></td>
                          <td><?php echo $fila->COLOR2; ?></td>
                          </tr> 
                            
                          <tr>
                          <td><?php echo $fila->NOMBRE3; ?></td>
                          <td><?php echo $fila->ANCHO3; ?></td>
                          <td><?php echo $fila->CALIBRE3; ?></td>
                          <td><?php echo $fila->GRAMAJE3; ?></td>
                          <td><?php echo $fila->PCTAJE3; ?></td>
                          <td><?php echo $fila->COLOR3; ?></td>
                          </tr>  

                          <tr>
                          <td><?php echo $fila->NOMBRE4; ?></td>
                          <td><?php echo $fila->ANCHO4; ?></td>
                          <td><?php echo $fila->CALIBRE4; ?></td>
                          <td><?php echo $fila->GRAMAJE4; ?></td>
                          <td><?php echo $fila->PCTAJE4; ?></td>
                          <td><?php echo $fila->COLOR4; ?></td>
                          </tr>    

                                    </tbody> 

                                </table> 
                            </div>
                    </div>


                    <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Laminacion 1</a></li>
                                               <li><a href="#tab_2" data-toggle="tab">Laminacion 2</a></li>
                                               <li><a href="#tab_3" data-toggle="tab">Laminacion 3</a></li>
                            </ul>

                                  <!-- ////// Inicio - formulario que contiene todos los parametros que se van a enviar ///////-->

                           

                            
                             <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                  <!--// Inicio Contenido Tornillo 1 \\-->
                                  <input type="hidden" value="1" name="tor1">

                                   <div class="col-md-12">
                                    <div class="table-responsive">                                        
                                        <table class="table table-bordered">
                                                  <thead> 
                                                      <tr> 
                                                          <th>TENSION</th> 
                                                          <th>DESB. 1</th> 
                                                          <th>APLICACION</th> 
                                                          <th>DESB. 2</th> 
                                                          <th>BOBINADO</th> 
                                                          <th>ADHESIVO</th> 
                                                      </tr> 
                                                  </thead> 
                                            <tbody>
                                        <tr>    
                                        <th>MAX(Kg)</th> 
                                        <td><?php echo $fila->TNDESB1MX; ?></td>
                                        <td><?php echo $fila->TNAPLICAMX; ?></td>
                                        <td><?php echo $fila->TNDESB2MX; ?></td>
                                        <td><?php echo $fila->TNEMBOBMX; ?></td>
                                        <td><?php echo $fila->ADHESIVOMX; ?></td>
                                        </tr>     

                                        <tr> 
                                        <th>OPTIMO(Kg)</th> 
                                        <td><?php echo $fila->TNDESB1; ?></td>
                                        <td><?php echo $fila->TNAPLICA; ?></td>
                                        <td><?php echo $fila->TNDESB2; ?></td>
                                        <td><?php echo $fila->TNEMBOB; ?></td>
                                        <td><?php echo $fila->ADHESIVO; ?></td>
                                        </tr> 

                                        <tr> 
                                        <th>MIN(Kg)</th> 
                                        <td><?php echo $fila->TNDESB1MN; ?></td>
                                        <td><?php echo $fila->TNAPLICAMN; ?></td>
                                        <td><?php echo $fila->TNDESB2MN; ?></td>
                                        <td><?php echo $fila->TNEMBOBMN; ?></td>
                                        <td><?php echo $fila->ADHESIVOMN; ?></td>

                                        </tr>      

                                          </tbody> 
                                        </table>
                                       </div>
                                      </div>
                                      
 
                                          

                                  <div class="col-md-7">
                                    <div class="table-responsive">                                       
                                      <table class="table table-bordered"> 
                                                  <thead> 
                                                      <tr> 
                                                          <th>TEMPERATURA</th> 
                                                          <th>APLICADOR</th> 
                                                          <th>LAMINADOR</th> 
                                                      </tr> 
                                                  </thead> 
                                                  <tbody> 
                                        <tr>
                                        <th>MAX(oC)</th> 
                                        <td><?php echo $fila->TMAPLICAMX; ?></td>
                                        <td><?php echo $fila->TMLAMINAMX; ?></td>
                                        </tr>     

                                        <tr>
                                        <th>OPTIMO(oC)</th>     
                                        <td><?php echo $fila->TMAPLICA; ?></td>
                                        <td><?php echo $fila->TMLAMINA; ?></td>
                                        </tr> 

                                        <tr>
                                        <th>MIN(oC)</th>     
                                        <td><?php echo $fila->TMAPLICAMN; ?></td>
                                        <td><?php echo $fila->TMLAMINAMN; ?></td>
                                        </tr>      

                                          </tbody> 
                                        </table>
                                      </div>
                                    </div>                                         

                                  
                                
                                  <div class="col-md-5">
                                    <div class="table-responsive">                                        
                                    <table class="table table-bordered"> 
                                                  <thead> 
                                                      <tr> 
                                                          <th>PRESION</th> 
                                                          <th>APLICADOR</th> 
                                                          <th>LAMINADOR</th> 
                                                      </tr> 
                                                  </thead> 
                                        
                                                  <tbody>
                                        <tr>           
                                        <th>MAX(oC)</th> 
                                        <td><?php echo $fila->PRAPLICAMX; ?></td>
                                        <td><?php echo $fila->PRLAMINAMX; ?></td>
                                        </tr>     

                                        <tr>
                                        <th>OPTIMO(oC)</th>     
                                        <td><?php echo $fila->PRAPLICA; ?></td>
                                        <td><?php echo $fila->PRLAMINA; ?></td>
                                        </tr> 

                                        <tr>
                                        <th>MIN(oC)</th>     
                                        <td><?php echo $fila->PRAPLICAMN; ?></td>
                                        <td><?php echo $fila->PRLAMINAMN; ?></td>
                                        </tr>      

                                          </tbody> 
                                          </table>
                                          </div>
                                          </div>
                                                                              
                                          
                                          

                                    </div><!--// tap 1\\-->




                                <div class="tab-pane" id="tab_2">
                                  <!--// Inicio Contenido Tornillo 1 \\-->
                                  <input type="hidden" value="2" name="tor2">

                                   <div class="col-md-12">
                                    <div class="table-responsive">                                        
                                        <table class="table table-bordered">
                                                  <thead> 
                                                      <tr> 
                                                          <th>TENSION</th> 
                                                          <th>DESB. 1</th> 
                                                          <th>APLICACION</th> 
                                                          <th>DESB. 2</th> 
                                                          <th>BOBINADO</th> 
                                                          <th>ADHESIVO</th> 
                                                      </tr> 
                                                  </thead> 
                                              <tbody> 
                                        <tr>    
                                        <th>MAX(Kg)</th>     
                                        <td><?php echo $fila->TNDESB1MX2; ?></td>
                                        <td><?php echo $fila->TNAPLICAMX2; ?></td>
                                        <td><?php echo $fila->TNDESB2MX2; ?></td>
                                        <td><?php echo $fila->TNEMBOBMX2; ?></td>
                                        <td><?php echo $fila->ADHESIVOMX2; ?></td>
                                        </tr>     

                                        <tr>
                                        <th>OPTIMO(Kg)</th>     
                                        <td><?php echo $fila->TNDESB12; ?></td>
                                        <td><?php echo $fila->TNAPLICA2; ?></td>
                                        <td><?php echo $fila->TNDESB22; ?></td>
                                        <td><?php echo $fila->TNEMBOB2; ?></td>
                                        <td><?php echo $fila->ADHESIVO2; ?></td>
                                        </tr> 

                                        <tr>
                                        <th>MIN(Kg)</th>     
                                        <td><?php echo $fila->TNDESB1MN2; ?></td>
                                        <td><?php echo $fila->TNAPLICAMN2; ?></td>
                                        <td><?php echo $fila->TNDESB2MN2; ?></td>
                                        <td><?php echo $fila->TNEMBOBMN2; ?></td>
                                        <td><?php echo $fila->ADHESIVOMN2; ?></td>
                                        </tr>      

                                          </tbody> 
                                        </table>
                                       </div>
                                      </div>
                                      
 
                                          

                                  <div class="col-md-7">
                                    <div class="table-responsive">                                       
                                      <table class="table table-bordered"> 
                                                  <thead> 
                                                      <tr> 
                                                          <th>TEMPERATURA</th> 
                                                          <th>APLICADOR</th> 
                                                          <th>LAMINADOR</th> 
                                                      </tr> 
                                                  </thead> 
                                                  <tbody> 

                                       <tr>
                                        <th>MAX(oC)</th> 
                                        <td><?php echo $fila->TMAPLICAMX2; ?></td>
                                        <td><?php echo $fila->TMLAMINAMX2; ?></td>
                                        </tr>     

                                        <tr>
                                        <th>OPTIMO(oC)</th>     
                                        <td><?php echo $fila->TMAPLICA2; ?></td>
                                        <td><?php echo $fila->TMLAMINA2; ?></td>
                                        </tr> 

                                        <tr>
                                        <th>MIN(oC)</th>     
                                        <td><?php echo $fila->TMAPLICAMN2; ?></td>
                                        <td><?php echo $fila->TMLAMINAMN2; ?></td>
                                        </tr>  

                                          </tbody> 
                                        </table>
                                      </div>
                                    </div>                                         

                                  
                                
                                  <div class="col-md-5">
                                    <div class="table-responsive">                                        
                                    <table class="table table-bordered"> 
                                                  <thead> 
                                                      <tr> 
                                                          <th>PRESION</th> 
                                                          <th>APLICADOR</th> 
                                                          <th>LAMINADOR</th> 
                                                      </tr> 
                                                  </thead> 
                                                  <tbody> 
                                        <tr>           
                                        <th>MAX(oC)</th> 
                                        <td><?php echo $fila->PRAPLICAMX2; ?></td>
                                        <td><?php echo $fila->PRLAMINAMX2; ?></td>
                                        </tr>     

                                        <tr>
                                        <th>OPTIMO(oC)</th>     
                                        <td><?php echo $fila->PRAPLICA2; ?></td>
                                        <td><?php echo $fila->PRLAMINA2; ?></td>
                                        </tr> 

                                        <tr>
                                        <th>MIN(oC)</th>     
                                        <td><?php echo $fila->PRAPLICAMN2; ?></td>
                                        <td><?php echo $fila->PRLAMINAMN2; ?></td>
                                        </tr>     

                                          </tbody> 
                                          </table>
                                          </div>
                                          </div>
                                                                              
                                          

                                 </div><!--// tap 2 \\-->


                                  <div class="tab-pane" id="tab_3">
                                  <!--// Inicio Contenido Tornillo 1 \\-->
                                  <input type="hidden" value="3" name="tor3">

                                   <div class="col-md-12">
                                    <div class="table-responsive">                                        
                                        <table class="table table-bordered">
                                                  <thead> 
                                                      <tr> 
                                                          <th>TENSION</th> 
                                                          <th>DESB. 1</th> 
                                                          <th>APLICACION</th> 
                                                          <th>DESB. 2</th> 
                                                          <th>BOBINADO</th> 
                                                          <th>ADHESIVO</th> 
                                                      </tr> 
                                                  </thead> 
                                              <tbody> 
                                        <tr>
                                        <th>MAX(Kg)</th>     
                                        <td><?php echo $fila->TNDESB1MX3; ?></td>
                                        <td><?php echo $fila->TNAPLICAMX3; ?></td>
                                        <td><?php echo $fila->TNDESB2MX3; ?></td>
                                        <td><?php echo $fila->TNEMBOBMX3; ?></td>
                                        <td><?php echo $fila->ADHESIVOMX3; ?></td>
                                        </tr>     
                                        <tr>
                                        <th>OPTIMO(Kg)</th>     
                                        <td><?php echo $fila->TNDESB13; ?></td>
                                        <td><?php echo $fila->TNAPLICA3; ?></td>
                                        <td><?php echo $fila->TNDESB23; ?></td>
                                        <td><?php echo $fila->TNEMBOB3; ?></td>
                                        <td><?php echo $fila->ADHESIVO3; ?></td>
                                        </tr> 
                                        <tr>
                                        <th>MIN(Kg)</th>     
                                        <td><?php echo $fila->TNDESB1MN3; ?></td>
                                        <td><?php echo $fila->TNAPLICAMN3; ?></td>
                                        <td><?php echo $fila->TNDESB2MN3; ?></td>
                                        <td><?php echo $fila->TNEMBOBMN3; ?></td>
                                        <td><?php echo $fila->ADHESIVOMN3; ?></td>
                                        </tr>      

                                          </tbody> 
                                        </table>
                                       </div>
                                      </div>
                                      
 
                                          

                                  <div class="col-md-7">
                                    <div class="table-responsive">                                       
                                      <table class="table table-bordered"> 
                                                  <thead> 
                                                      <tr> 
                                                          <th>TEMPERATURA</th> 
                                                          <th>APLICADOR</th> 
                                                          <th>LAMINADOR</th> 
                                                      </tr> 
                                                  </thead> 
                                                  <tbody> 
                                      <tr>
                                        <th>MAX(oC)</th> 
                                        <td><?php echo $fila->TMAPLICAMX3; ?></td>
                                        <td><?php echo $fila->TMLAMINAMX3; ?></td>
                                        </tr>     

                                        <tr>
                                        <th>OPTIMO(oC)</th>     
                                        <td><?php echo $fila->TMAPLICA3; ?></td>
                                        <td><?php echo $fila->TMLAMINA3; ?></td>
                                        </tr> 

                                        <tr>
                                        <th>MIN(oC)</th>     
                                        <td><?php echo $fila->TMAPLICAMN3; ?></td>
                                        <td><?php echo $fila->TMLAMINAMN3; ?></td>
                                        </tr>      

                                          </tbody> 
                                        </table>
                                      </div>
                                    </div>                                         

                                  
                                
                                  <div class="col-md-5">
                                    <div class="table-responsive">                                        
                                    <table class="table table-bordered"> 
                                                  <thead> 
                                                      <tr> 
                                                          <th>PRESION</th> 
                                                          <th>APLICADOR</th> 
                                                          <th>LAMINADOR</th> 
                                                      </tr> 
                                                  </thead> 
                                                  <tbody> 
                                        <tr>           
                                        <th>MAX(oC)</th> 
                                        <td><?php echo $fila->PRAPLICAMX3; ?></td>
                                        <td><?php echo $fila->PRLAMINAMX3; ?></td>
                                        </tr>     

                                        <tr>
                                        <th>OPTIMO(oC)</th>     
                                        <td><?php echo $fila->PRAPLICA3; ?></td>
                                        <td><?php echo $fila->PRLAMINA3; ?></td>
                                        </tr> 

                                        <tr>
                                        <th>MIN(oC)</th>     
                                        <td><?php echo $fila->PRAPLICAMN3; ?></td>
                                        <td><?php echo $fila->PRLAMINAMN3; ?></td>
                                        </tr>     

                                          </tbody> 
                                          </table>
                                          </div>
                                          </div>
                                                                              
                                          

                                 </div><!--// tap 3 \\-->


                         </div><!--// tap content \\-->

                <div class="col-md-12">
                  <div class="table-responsive"> 
                       <table class="table table-bordered"> 
                       <thead> 

                        <tr>
                <th>OBSERVACIONES CALIDAD</th>
              </tr>
                <tr>
                  <td> <?php $obsCal = "SELECT * FROM dbo.LAMINACION lam inner join  dbo.OBSCALIDAD cal on lam.NIT = cal.NIT where lam.NIT = '$fila->NIT' and proceso = 'LAMINACION' and lam.ORDENNRO = '$pedido'";
                         $queryCal = sqlsrv_query($connPlas,$obsCal);

                         while($row = sqlsrv_fetch_object($queryCal))
                          {
                            echo $row->OBSERVACIO."<br>";
                          }
                          ?></td>
                                        
                  </tr>
                       
                       <tr>
                        <th>OBSERVACIONES<input type="checkbox" class="chkplas" class="minimal" value="chk_observa" <?php if(in_array('chk_observa',$laminacion)){echo 'checked="checked"';}?> name="chklaminacion[]" ></th>
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
                <?php $plano = rutaPlano($fila->CODIGO);?>           
            <?php
            }
            sqlsrv_close( $connPlas );
            ?>
            <div class="row">
               <div class="col-xs-4">
                  <label>Numero lote: Adhesivo y Catalizador</label>
                  <input type="text" class="form-control" value="<?php echo $datos['num_loteadca'] ?>" name="num_loteadca"> <br>
                    <b>Operario responsable</b>
                      <i id="limpiar" style="cursor: pointer;" class="fa fa-times"></i><br><br>
                      <input id="operarios" type="text" class="form-control" value="<?php echo $datos['operario']?>" placeholder="Nombre Operario"  name="operario" required> 
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
                        <?php sqlsrv_close( $connSCPBD ); ?>
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
      <img src="ftp://192.168.0.124/Pruebas/JPG PRODUCCION/<?php echo $plano ?>.jpg" style="max-width: 100%;">
  
          </div>

        </div>
        <div class="modal-footer">
          <a href="ftp://192.168.0.124/Pruebas/JPG PRODUCCION/<?php echo $plano ?>.jpg" target="blank"><button type="button" class="btn btn-primary">Abrir en nueva pestaña</button></a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

<?php include '../../includes/laminacion/footer.php';
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
 ?>