<?php
	  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
  $archivo = 'requisitos';

    include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');


  if (isset($_GET['pedido'])){
  	$Idrequisitoimp = $_GET['id'];  	
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
            Requisitos           
            <small>Control De Requisitos</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Impresion</a></li>
            <li><a href="#">Control De Requisitos</a></li>
            <li class="active">Editar</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">            
            <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-fw fa-edit"></i>Editar - Control De Requisitos</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
          
            
            
            
         
            <?php
            	$requisitos = '';
                                   
                  $control_req = "SELECT * FROM impresion_requisitos WHERE Idrequisitoimp = '$Idrequisitoimp'";
                  $leer = sqlsrv_query($connSCPBD, $control_req);
                  $datos = sqlsrv_fetch_array($leer);

                  $Requisitos = explode(', ', $datos['requisitos']);
                


            
            $registrosImp = sqlsrv_query($connPlas, $leerImp);
            $fila = sqlsrv_fetch_object($registrosImp);

            //Depuracion ruta de Cyreles 1 a 8
	            $rutaCy1 = substr($fila->CYREL1, 2);$rutaLimpia1 = trim($rutaCy1);$numCyrel1 = rutaCyrel($rutaLimpia1);
	            $rutaCy2 = substr($fila->CYREL2, 2);$rutaLimpia2 = trim($rutaCy2);$numCyrel2 = rutaCyrel($rutaLimpia2);
	            $rutaCy3 = substr($fila->CYREL3, 2);$rutaLimpia3 = trim($rutaCy3);$numCyrel3 = rutaCyrel($rutaLimpia3);
	            $rutaCy4 = substr($fila->CYREL4, 2);$rutaLimpia4 = trim($rutaCy4);$numCyrel4 = rutaCyrel($rutaLimpia4);
	            $rutaCy5 = substr($fila->CYREL5, 2);$rutaLimpia5 = trim($rutaCy5);$numCyrel5 = rutaCyrel($rutaLimpia5);
	            $rutaCy6 = substr($fila->CYREL6, 2);$rutaLimpia6 = trim($rutaCy6);$numCyrel6 = rutaCyrel($rutaLimpia6);
	            $rutaCy7 = substr($fila->CYREL7, 2);$rutaLimpia7 = trim($rutaCy7);$numCyrel7 = rutaCyrel($rutaLimpia7);
	            $rutaCy8 = substr($fila->CYREL8, 2);$rutaLimpia8 = trim($rutaCy8);$numCyrel8 = rutaCyrel($rutaLimpia8);

	            //Rutas Imgs de Cyreles
	            $imgCyrel1 = "<img src='ftp://hestia/Plasmar/Producci/$numCyrel1'/>";	            
	            $imgCyrel2 = "<img src='ftp://hestia/Plasmar/Producci/$numCyrel2'/>";
	            $imgCyrel3 = "<img src='ftp://hestia/Plasmar/Producci/$numCyrel3'/>";
	            $imgCyrel4 = "<img src='ftp://hestia/Plasmar/Producci/$numCyrel4'/>";
	            $imgCyrel5 = "<img src='ftp://hestia/Plasmar/Producci/$numCyrel5'/>";
	            $imgCyrel6 = "<img src='ftp://hestia/Plasmar/Producci/$numCyrel6'/>";
	            $imgCyrel7 = "<img src='ftp://hestia/Plasmar/Producci/$numCyrel7'/>";
	            $imgCyrel8 = "<img src='ftp://hestia/Plasmar/Producci/$numCyrel8'/>";

	            //Ruta Imgs Montaje
	            $rutaBob = substr($fila->FEMBOBINA, 2);$rutaBobLimpia = trim($rutaBob);$numBob = rutaBobina($rutaBobLimpia);

	            $imgBobina = "<img src='ftp://hestia/Plasmar/Producci/$numBob'/>";

            ?> 
            <form action="actualizar_requisito.php" method="post" accept-charset="utf-8">
            <input type="hidden" name="Idrequisitoimp" value="<?php echo $Idrequisitoimp ?>">
				<!--- Descripcion General Orden de Produccion Extrusion -->
				<h3 align="center">Descripción General</h3>
				<br>

				        <div class="table-responsive"> 
				            <table class="table table-bordered">
				            <thead>
				              <tr>
				                <th>Impresion N°</th>
				                <th>Fecha Entrega</th>
				                <th>Cliente</th>
				                <th>NIT</th>
				                <th>Descripción</th>
				                <th>Codigo</th>
				              </tr>
				              </thead>
				              <tbody> 
				          <tr>
				          <td><input type="hidden" name="num_orden" value='<?php echo $fila->PEDIDO; ?>'><?php echo $fila->ORDENNRO; ?></td>
           				  <td><?php echo date_format($fila->FHENTREGA, 'd/m/y') ?></td>
				          <td><?php echo $fila->NOMBRE; ?></td>
				          <td><?php echo $fila->NIT; ?></td>
				          <td><?php echo $fila->DESCRIPCIO; ?></td>
				          <td><?php echo $fila->CODIGO; ?></td>
				           
				          </tr>
				          </tbody>
				        </table>
				        </div>

				    


			    <!--- Detalles Orden de Produccion Extrusion -->
						<h3 align="center">Detalles</h3>
						<br>
						    

						        <div class="table-responsive"> 
						            <table class="table table-bordered">
						            <thead>
						              <tr>
						               	<th>IMPRESORA N°<input type="checkbox" class="chkplas" class="minimal" value="chk_impresora"<?php if(in_array('chk_impresora', $Requisitos)){echo 'checked="checked"';}?>  name="chkRequisitos[]" ></th>
						               	<th>Kg PEDIDOS<input type="checkbox" class="chkplas" class="minimal" value="chk_kgpedidos"<?php if(in_array('chk_kgpedidos', $Requisitos)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></th>
									    <th>PRESENTACION<input type="checkbox" class="chkplas" class="minimal" value="chk_presentacion"<?php if(in_array('chk_presentacion', $Requisitos)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></th>
									    <th>ANCHO<input type="checkbox" class="chkplas" class="minimal" value="chk_ancho"<?php if(in_array('chk_ancho', $Requisitos)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></th>
									    <th>TIPO IMPRESION<input type="checkbox" class="chkplas" class="minimal" value="chk_tipoimp"<?php if(in_array('chk_tipoimp', $Requisitos)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></th>
									    <th>MONTAJE <input type="checkbox" class="chkplas" class="minimal" value="chk_montaje"<?php if(in_array('chk_montaje', $Requisitos)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></th>
									   </tr>
						              </thead>
						              <tbody> 
						<tr>
				          <td><?php echo $fila->IMPRESORA; ?></td>
				          <td><?php echo $fila->KILOSPD	; ?></td>
				          <td><?php echo $fila->PRESENTA; ?></td>
				          <td><?php echo $fila->ANCHOPRES; ?></td>
				          <td><?php echo $fila->TIPOIMP; ?></td>
				          <td><?php echo $fila->TIPOMON; ?></td>
						</tr>
			          </tbody>
			        </table>
			        </div>
			<!--- Detalles Orden de Produccion Impresion -->

			  
					<br><br>
			        <div class="table-responsive"> 
			            <table class="table table-bordered">
			            <thead>
			              <tr>
			                <th>DESTINO<input type="checkbox" class="chkplas" class="minimal" value="chk_destino" <?php if(in_array('chk_destino', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
			                <th>CODIGO BARRAS</th>
			                <th>LOGO TIPO<input type="checkbox" class="chkplas" class="minimal" value="chk_logo"<?php if(in_array('chk_logo', $Requisitos)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></th>
			                <th>BOCA POR<input type="checkbox" class="chkplas" class="minimal" value="chk_boca" <?php if(in_array('chk_boca', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
			                <th>TIPO PEDIDO<input type="checkbox" class="chkplas" class="minimal" value="chk_tipopedido"<?php if(in_array('chk_tipopedido', $Requisitos)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></th>
			              </tr>
			              </thead>
			              <tbody> 
			          <tr>
				          <td><?php echo $fila->DESTINO; ?></td>
				          <td><?php echo $fila->BARRAS; ?></td>
				          <td><?php echo $fila->LOGOTIPO; ?></td>
				          <td><?php echo $fila->BOCA; ?></td>
				          <td><?php echo $fila->TIPOPED; ?></td>

			           </tr>
			          </tbody>
			        </table>
			        </div>	

				    <div class="row">
				            <div class="col-md-6">
				                <h4 align="center">TAMAÑO FOTOCELDA</h4>
				                    <div class="table-responsive"> 
				                        <table class="table table-bordered"> 
				                            <thead> 
				                                <tr> 
				                                    <th>ANCHO</th> 
				                                    <th>LARGO</th> 
				                                 </tr> 
				                            </thead> 
				                            <tbody> 
				                                <tr>    
										          <td><?php echo $fila->ANCHOFT; ?></td>
										          <td><?php echo $fila->LARGOFT; ?></td>
				                                </tr>           
				                            </tbody> 
				                        </table> 
				                    </div>
				            </div>
				   

				              <div class="col-md-6">
			                <h4 align="center"></h4>
			                    <div class="table-responsive"> 
			                        <table class="table table-bordered"> 
			                            <thead> 
			                                <tr> 
			                                    <th>RODILLO<input type="checkbox" class="chkplas" class="minimal" value="chk_rodillo"<?php if(in_array('chk_rodillo', $Requisitos)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></th> 
			                                    <th>PIÑON<input type="checkbox" class="chkplas" class="minimal" value="chk_pinon"<?php if(in_array('chk_pinon', $Requisitos)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></th> 
			                                </tr> 
			                            </thead> 
			                            <tbody> 
			                                <tr>    
										      <td><?php echo $fila->RODILLO; ?></td>
										      <td><?php echo $fila->PINON; ?></td>

			                                </tr>           
			                            </tbody> 
			                        </table> 
			                    </div>
			            </div>
			         </div>


				    <div class="row">
				            <div class="col-md-12">
				                <h4 align="center">ALTURAS IMPRESION<input type="checkbox" class="chkplas" class="minimal" value="chk_alturas" <?php if(in_array('chk_alturas', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></h4>
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
		
				



			<!--- Espsificaciones Orden de Produccion Impresion -->

				    <h3 align="center">Especificaciones</h3>
				    <br>
				    <div class="row">
				            <div class="col-md-4">
				                <h4 align="center">Ancho (cms)<input type="checkbox" class="chkplas" class="minimal" value="chk_fancho"<?php if(in_array('chk_fancho', $Requisitos)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></h4>
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
										      <td><?php echo $fila->ANCHOMN; ?></td>
										      <td><?php echo $fila->ANCHO; ?></td>
										      <td><?php echo $fila->ANCHOMX; ?></td>

				                                </tr>           
				                            </tbody> 
				                        </table> 
				                    </div>
				            </div>

				            <div class="col-md-4">
				                <h4 align="center">LARGO (cms)<input type="checkbox" class="chkplas" class="minimal" value="chk_flargo"<?php if(in_array('chk_flargo', $Requisitos)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></h4>
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

				  <!--- Montaje Orden de Produccion Impresion -->

				    


				  		<h3 align="center">Montaje</h3>
				                    <div class="table-responsive"> 
				                        <table class="table table-bordered"> 
				                            <thead> 
				                                <tr> 				                                    
				                                    <th></th>
												    <th>TINTERO 1<input type="checkbox" class="chkplas" class="minimal" value="chk_tintero1" <?php if(in_array('chk_tintero1', $Requisitos)){echo 'checked="checked"';}?> name="chkRequisitos[]" ></th>
												    <th>TINTERO 2<input type="checkbox" class="chkplas" class="minimal" value="chk_tintero2" <?php if(in_array('chk_tintero2', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
												    <th>TINTERO 3<input type="checkbox" class="chkplas" class="minimal" value="chk_tintero3" <?php if(in_array('chk_tintero3', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
												    <th>TINTERO 4<input type="checkbox" class="chkplas" class="minimal" value="chk_tintero4" <?php if(in_array('chk_tintero4', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
												  </tr>
												  <tr>
												    <th>COLOR</th>
												      <td><?php echo $fila->COLOR1; ?></td>
												      <td><?php echo $fila->COLOR2; ?></td>
												      <td><?php echo $fila->COLOR3; ?></td>
												      <td><?php echo $fila->COLOR4; ?></td>
												    </tr>
												  <tr>
												    <th>LINEATURA</th>
												      <td><?php echo $fila->LINEAT1; ?></td>
												      <td><?php echo $fila->LINEAT2; ?></td>
												      <td><?php echo $fila->LINEAT3; ?></td>
												      <td><?php echo $fila->LINEAT4; ?></td>
												  </tr>
												  <tr>
												    <th>REFERENCIA STICK</th>
												      <td><?php echo $fila->RSTICK1; ?></td>
												      <td><?php echo $fila->RSTICK2; ?></td>
												      <td><?php echo $fila->RSTICK3; ?></td>
												      <td><?php echo $fila->RSTICK4; ?></td>
												  </tr>
												  <tr>
												    <th>VISCOSIDAD</th>
												      <td><?php echo $fila->VISCO1; ?></td>
												      <td><?php echo $fila->VISCO2; ?></td>
												      <td><?php echo $fila->VISCO3; ?></td>
												      <td><?php echo $fila->VISCO4; ?></td>
												  </tr>
												  <tr>
												    <th>KILOS TINTA</th>
												      <td><?php echo $fila->KILOS1; ?></td>
												      <td><?php echo $fila->KILOS2; ?></td>
												      <td><?php echo $fila->KILOS3; ?></td>
												      <td><?php echo $fila->KILOS4; ?></td>
												  <tr>
												   <th>CARAS</th>
												      <td align="center">
												      	<?php echo $imgCyrel1;?>
														<div class="bg-bobina">
											            <table>
											            	<tr>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T11); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T12); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T13); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T14); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T15); ?> disabled/></td>
											            	</tr>
											            </table>
											            </div>
											            <?php echo $fila->CARAS1; ?>
												      </td>

												      <td align="center">
												      	<?php echo $imgCyrel2;?>
														<div class="bg-bobina">
											            <table>
											            	<tr>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T21); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T22); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T23); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T24); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T25); ?> disabled/></td>
											            	</tr>
											            </table>
											            </div>
											            <?php echo $fila->CARAS2; ?>
												      </td>

												      <td align="center">
												      	<?php echo $imgCyrel3;?>
														<div class="bg-bobina">
											            <table>
											            	<tr>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T31); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T32); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T33); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T34); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T35); ?> disabled/></td>
											            	</tr>
											            </table>
											            </div>
											            <?php echo $fila->CARAS3; ?>
												      </td>
												      <td align="center">
												      	<?php echo $imgCyrel4;?>
														<div class="bg-bobina">
											            <table>
											            	<tr>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T41); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T42); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T43); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T44); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T45); ?> disabled/></td>
											            	</tr>
											            </table>
											            </div>
											            <?php echo $fila->CARAS4; ?>
												      </td>
				                                </tr> 
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
												    <th>TINTERO 5<input type="checkbox" class="chkplas" class="minimal" value="chk_tintero5" <?php if(in_array('chk_tintero5', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
												    <th>TINTERO 6<input type="checkbox" class="chkplas" class="minimal" value="chk_tintero6" <?php if(in_array('chk_tintero6', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
												    <th>TINTERO 7<input type="checkbox" class="chkplas" class="minimal" value="chk_tintero7" <?php if(in_array('chk_tintero7', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
												    <th>TINTERO 8<input type="checkbox" class="chkplas" class="minimal" value="chk_tintero8" <?php if(in_array('chk_tintero8', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
												  </tr>
												  <tr>
												    <th>COLOR</th>
												   	  <td><?php echo $fila->COLOR5; ?></td>
												      <td><?php echo $fila->COLOR6; ?></td>
												      <td><?php echo $fila->COLOR7; ?></td>
												      <td><?php echo $fila->COLOR8; ?></td>
												  </tr>
												  <tr>
												    <th>LINEATURA</th>
												      <td><?php echo $fila->LINEAT5; ?></td>
												      <td><?php echo $fila->LINEAT6; ?></td>
												      <td><?php echo $fila->LINEAT7; ?></td>
												      <td><?php echo $fila->LINEAT8; ?></td>
												  </tr>
												  <tr>
												    <th>REFERENCIA STICK</th>
												      <td><?php echo $fila->RSTICK5; ?></td>
												      <td><?php echo $fila->RSTICK6; ?></td>
												      <td><?php echo $fila->RSTICK7; ?></td>
												      <td><?php echo $fila->RSTICK8; ?></td>
												  </tr>
												  <tr>
												    <th>VISCOSIDAD</th>
												      <td><?php echo $fila->VISCO5; ?></td>
												      <td><?php echo $fila->VISCO6; ?></td>
												      <td><?php echo $fila->VISCO7; ?></td>
												      <td><?php echo $fila->VISCO8; ?></td>
												  </tr>
												  <tr>
												    <th>KILOS TINTA</th>
												      <td><?php echo $fila->KILOS5; ?></td>
												      <td><?php echo $fila->KILOS6; ?></td>
												      <td><?php echo $fila->KILOS7; ?></td>
												      <td><?php echo $fila->KILOS8; ?></td>
				                                </tr>
												  <tr>
												   <th>CARAS</th>
												      <td align="center">
												      	<?php echo $imgCyrel5;?>
														<div class="bg-bobina">
											            <table>
											            	<tr>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T51); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T52); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T53); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T54); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T55); ?> disabled/></td>
											            	</tr>
											            </table>
											            </div>
											            <?php echo $fila->CARAS5; ?>
												      </td>
												      <td align="center">
												      	<?php echo $imgCyrel6;?>
														<div class="bg-bobina">
											            <table>
											            	<tr>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T61); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T62); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T63); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T64); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T65); ?> disabled/></td>
											            	</tr>
											            </table>
											            </div>
											            <?php echo $fila->CARAS6; ?>
												      </td>
												      <td align="center">
												      	<?php echo $imgCyrel7;?>
														<div class="bg-bobina">
											            <table>
											            	<tr>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T71); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T72); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T73); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T74); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T75); ?> disabled/></td>
											            	</tr>
											            </table>
											            </div>
											            <?php echo $fila->CARAS7; ?>
												      </td>
												      <td align="center">
												      	<?php echo $imgCyrel8;?>
														<div class="bg-bobina">
											            <table>
											            	<tr>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T81); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T82); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T83); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T84); ?> disabled/></td>
											            		<td><input type="checkbox" class="chkplas" <?php echo $act = armarRodillo($fila->T85); ?> disabled/></td>
											            	</tr>
											            </table>
											            </div>
											            <?php echo $fila->CARAS8; ?>
												      </td>
												   </tr> 
				                            </thead> 
				                            
				                        </table> 
				                    </div>

				                    

	                    <div class="table-responsive"> 
	                        <table class="table table-bordered"> 
	                            <thead>      
				                   <tr>
								    <th>TIPO DE TINTA<input type="checkbox" class="chkplas" class="minimal" value="chk_tipotinta" <?php if(in_array('chk_tipotinta', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
								    <th>COLORES SEGUN<input type="checkbox" class="chkplas" class="minimal" value="chk_colores" <?php if(in_array('chk_colores', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
								    <th>TIPO MATERIAL<input type="checkbox" class="chkplas" class="minimal" value="chk_material" <?php if(in_array('chk_material', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
								  </tr>

				                	<tr>   
				                		<td><?php echo $fila->TIPOTINTA; ?></td>
									    <td><?php echo $fila->COLORESEN; ?></td>
									    <td><?php echo $fila->MATERIAL; ?></td>
				                    </tr>           
								  
								  <tr>
								    <th>FECHA IMPRESION</th>
								    <th>GUIA PARA FOTOCELDA<input type="checkbox" class="chkplas" class="minimal" value="chk_fotocelda" <?php if(in_array('chk_fotocelda', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
								    <th>RAYA PARA</th>
								  </tr>

				                	<tr>   
			            				<td><?php echo date_format($fila->FECHA, 'd/m/y') ?></td>
									    <td><?php echo $fila->LINEACORTA; ?></td>
									    <td></td>
									</tr>           

								</thead> 
				                            
				            </table> 
				        </div>


				       <div class="table-responsive"> 
	                     <table class="table table-bordered"> 
	                     <thead> 
				         <tr>
					    	<th>MONTAJE<input type="checkbox" class="chkplas" class="minimal" value="chk_montaje" <?php if(in_array('chk_montaje', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
					   	 	<th>OBSERVACIONES<input type="checkbox" class="chkplas" class="minimal" value="chk_observa" <?php if(in_array('chk_observa', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
					  	</tr>

					  		  <tbody> 
				                	<tr> 
				                	<td><?php echo $imgBobina ?></td>  
				                	<td><?php echo $fila->OBSERVA1." ".$fila->OBSERVA2." ".$fila->OBSERVA3." ".$fila->OBSERVA4." ".$fila->OBSERVA5." ".$fila->OBSERVA6?></td>  
				                    </tr>           
				                </tbody> 
								</thead> 
				                            
				            </table> 
				        </div>



				        	<?php
							//conectamos la base de datos de premontaje y traemos los datos de los campos
							//Repeticion,Centros,Rodilloz y observaciones para editarlos

							$control= "SELECT * FROM premontajes where num_orden = '$pedido'";
							$X = sqlsrv_query($connSCPBD, $control);            
						        $resultado = sqlsrv_fetch_object($X)  						          
							?>

				         <div class="table-responsive"> 
	                     <table class="table table-bordered"> 
	                     <thead>
	                     <tr>
					    	<th>OBSERVACIONES CALIDAD</th>
					  	</tr>
				        <tr>
				        	<td> <?php $obsCal = "SELECT * FROM dbo.IMPRESION imp inner join  dbo.OBSCALIDAD cal on imp.NIT = cal.NIT where imp.NIT = '$fila->NIT' and proceso = 'IMPRESION' and imp.ORDENNRO = '$pedido'";
                         $queryCal = sqlsrv_query($connPlas,$obsCal);

                         while($row = sqlsrv_fetch_object($queryCal))
                          {
                            echo $row->OBSERVACIO."<br>";
                          }
                    			?></td>
						      							      	
			            </tr>
				         <tr>
					    	<th>OBSERVACIONES PREMONTADOR<input type="checkbox" class="chkplas" class="minimal" value="chk_observa" <?php if(in_array('chk_impresora', $Requisitos)){echo 'checked="checked"';}?>name="chkRequisitos[]" ></th>
					  	</tr>

					  		  <tbody> 
				                	<tr>   
						      	<td><?php echo $resultado->observa?></td>

			                    </tr>           
				                </tbody> 
								</thead> 
				                            
				            </table> 
				        </div>
<?php 

$plano = rutaPlano($fila->CODIGO);

?>



              <div class="row">
               <div class="col-xs-4">
                    <b>Operario responsable</b>
                      <i id="limpiar" style="cursor: pointer;" class="fa fa-times"></i><br><br>
                      <input id="operarios" type="text" class="form-control" placeholder="Nombre Operario" name="operario" value="<?php echo $datos[3] ?>" required> 
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
                        <a class="btn btn-block btn-primary" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/impresion/control_requisitos/controles_requisitos_imp.php" style="text-decoration: none;">Cancelar</a>
                  </div>
               </div>
            </div>

            </form>


            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->



		            <?php
			       		
			         sqlsrv_close( $connSCPBD );
		            ?>

				                          
            <?php
	         sqlsrv_close( $connPlas );
            ?>

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

