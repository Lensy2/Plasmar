<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
  $archivo = 'nuevo_control_mez';
  
  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');

if (isset($_POST['pedido']) && $_POST['tipo_ext']){
    $pedido = $_POST['pedido'];
    $tipo_ext = $_POST['tipo_ext'];
}

include '../../includes/dbconfig.php';
include '../../model/extruder.php';
include '../../includes/extruder/header.php';

if ($tipo_ext == 'ext_normal'){ $tipoTabla = $leerExt;}
elseif ($tipo_ext == 'ext_laminacion'){$tipoTabla = $leerExtL;}

//--- Consulta del pedido en las tablas de extrusion o extrusionl ----//
$registrosExt = sqlsrv_query($connPlas, $tipoTabla);
$fila = sqlsrv_fetch_object($registrosExt);

?>
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Mezclas            
                <small>Control De Mezcla</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Mezclas</a></li>
                <li><a href="#">Control De Mezcla</a></li>
                <li class="active">Nuevo</li>
            </ol>
        </section>

            <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">            
                <div class="box-header">
                      <h3 class="box-title"><i class="fa fa-fw fa-plus-circle"></i>Nuevo - Control de Mezcla</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                <!--- Descripcion General Orden de Produccion Extrusion -->
                    <h4 align="center"><b>Descripción General</b></h4>
                        <div class="table-responsive"> 
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Extrusion N°</th>
                                        <th>Fecha Entrega</th>
                                        <th>Cliente</th>
                                        <th>NIT</th>
                                        <th>Descripción</th>
                                        <th>Codigo</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                        <td><?php echo $fila->PEDIDO; ?></td>
                                        <td><?php echo date_format($fila->FHENTREGA, 'd/m/y') ?></td>
                                        <td><?php echo $fila->CLIENTE ?></td>
                                        <td><?php echo $fila->NIT ?></td>
                                        <td><?php echo $fila->DESCRIPCION." ".$fila->DESCRIPCION2 ?></td>
                                        <td><?php echo $fila->CODIGO ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <!--- Detalles Orden de Produccion Extrusion -->
                    <h4 align="center"><b>Detalles</b></h4>

                        <!-- Primera fila de detalles -->
                        <div class="table-responsive"> 
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Extrusion N°</th>
                                    <th>Kg Pedidos</th>
                                    <th>Peso Max Bobina (Kg)</th>
                                    <th>Radio de Bobina (cms)</th>
                                    <th>Caracteristicas</th>
                                    <th>Fuelle</th>
                                  </tr>
                                </thead>
                                <tbody> 
                                  <tr>
                                    <td><?php echo $fila->EXTRUSORA ?></td>
                                    <td><?php echo $fila->KGPEDIDOS?></td>
                                    <td><?php echo $fila->PESOMAXBOBINA ?></td>
                                    <td><?php echo $fila->RADIODEBOBINA?></td>
                                    <td><?php echo $fila->CARACTERISTICA?></td>
                                    <td><?php echo $fila->FUELLE?></td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Segunda fila de detalles -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Presentación</th>
                                    <th>Uso Empaque</th>
                                    <th>Corte (cms)</th>
                                    <th>Tratamiento</th>
                                    <th>Dinas</th>
                                    <th>Platinas</th>
                                    <th>Grafilado</th>
                                  </tr>
                                </thead>
                                <tbody> 
                                  <tr>
                                    <td><?php echo $fila->PRESENTACION ?></td>
                                    <td><?php echo $fila->USOEMPAQUE ?></td>
                                    <td><?php echo $fila->CORTE1 ." - ".$fila->CORTE2 ?></td>
                                    <td><?php echo $fila->TRATAMTO ?></td>
                                    <td><?php echo $fila->DINAS ?></td>
                                    <td><?php echo $fila->PLATINA ?></td>
                                    <td><?php if ($fila->GRAFILADO == 0) {
                                        echo "NO";
                                    }else{echo "SI";}?></td>
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
                                            <tr>    <td><?php echo $fila->ANCHOMN ?></td> 
                                                    <td><?php echo $fila->ANCHO ?></td> 
                                                    <td><?php echo $fila->ANCHOMX ?></td> 
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
                                            <tr>    <td><?php echo $fila->CALIBREMN ?></td> 
                                                    <td><?php echo $fila->CALIBRE ?></td> 
                                                    <td><?php echo $fila->CALIBREMX ?></td> 
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
                                            <tr>    <td><?php echo $fila->PESOMOLMN ?></td> 
                                                    <td><?php echo $fila->PESOMOL ?></td> 
                                                    <td><?php echo $fila->PESOMOLMX ?></td> 
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
                                            <tr>    <td><?php echo $fila->VELOHALADOR ?></td> 
                                                    <td><?php echo $fila->VELOBOBINADOR ?></td> 
                                            </tr>           
                                        </tbody> 
                                    </table> 
                                </div>
                        </div>
                    <!--- Información Adicional -->
                    <h4 align="center"><b>Información Adicional</b></h4>
                        <div class="table-responsive"> 
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Destino</th>
                                    <th>Tipo Pedido</th>
                                    <th>Observaciones de Calidad</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><?php echo $fila->DESTINO ?></td>
                                    <td><?php echo $fila->TIPOPED ?></td>
                                    <td><?php
                                        echo $fila->OBSERVA1.", ".$fila->OBSERVA2.", ".$fila->OBSERVA3.", ".$fila->OBSERVA4.", ".$fila->OBSERVA5.", ".$fila->OBSERVA6.", ".$fila->OBSERVA7.", ".$fila->OBSERVA8 
                                        ?>
                                    </td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>

                    <!--- Inicio Velocidades y Mezclas Orden de Produccion Extrusion -->
                    <h4 align="center"><b>Control de Mezclas</b></h4>
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Tornillo 1</a></li>
                                <li><a href="#tab_2" data-toggle="tab">Tornillo 2</a></li>
                                <li><a href="#tab_3" data-toggle="tab">Tornillo 3</a></li>
                                <li><a href="#tab_4" data-toggle="tab">Tornillo 4</a></li>
                                <li><a href="#tab_5" data-toggle="tab">Tornillo 5</a></li>
                                <li><a href="#tab_6" data-toggle="tab">Tornillo 6</a></li>
                                <li><a href="#tab_7" data-toggle="tab">Tornillo 7</a></li>
                            </ul>

                            <!-- ////// Inicio - formulario que contiene todos los parametros que se van a enviar ///////-->
                            <form action="procesar_contr_mezcla.php" method="post" accept-charset="utf-8">

                                <!-- Variable oculta: Numero de Orden -->
                                <input type="hidden" name="num_orden" value="<?php echo $pedido; ?>">
                                <!-- Variable oculta: Tipo de Extrusion -->
                                <input type="hidden" name="tipo_ext" value="<?php echo $tipo_ext; ?>">

                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <!--// Inicio Contenido Tornillo 1 \\-->
                                        <input type="hidden" value="1" name="tor1">
                                        <div class="col-md-5"> 
                                            <div class="table-responsive">    
                                                <table class="table table-bordered"> 
                                                    <thead> 
                                                        <tr> 
                                                            <th>Componente</th> 
                                                            <th>Kg</th> 
                                                        </tr> 
                                                    </thead> 
                                                    <tbody> 
                                                        <tr>           
                                                            <td><?php echo $fila->MEZCLA_A1?></td> 
                                                            <td><?php echo $fila->KILOS_A1?></td> 
                                                        </tr>
                                                        <tr>    
                                                            <td><?php echo $fila->MEZCLA_A2?></td> 
                                                            <td><?php echo $fila->KILOS_A2?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_A3?></td> 
                                                            <td><?php echo $fila->KILOS_A3?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_A4?></td> 
                                                            <td><?php echo $fila->KILOS_A4?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_A5?></td> 
                                                            <td><?php echo $fila->KILOS_A5?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_A6?></td> 
                                                            <td><?php echo $fila->KILOS_A6?></td> 
                                                        </tr>
                                                        
                                                    </tbody> 
                                                </table>                                   
                                            </div>
                                        </div>

                                        <div class="table-responsive"> 
                                            <table class="table table-bordered"> 
                                                <thead> 
                                                    <tr> 
                                                        <th>Componente</th> 
                                                        <th>Kg</th> 
                                                        <th>Lote</th>
                                                        <th>Acción</th> 

                                                    </tr> 
                                                </thead> 
                                                <tbody> 
                                                        
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c1tor1"  value="<?php echo trim($fila->MEZCLA_A1) ?>" name="comp_A[]"></td> 
                                                        <td><input type="text" class="form-control c1tor1"  value="<?php echo trim($fila->KILOS_A1)?>" name="kg_A[]"></td> 
                                                        <td><input type="text" class="form-control c1tor1"  name="lote_A[]"> </td>
                                                        <td><i id="limpc1tor1" style="cursor: pointer;" class="fa fa-times"></i>
                                                        </td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c2tor1"  value="<?php echo trim($fila->MEZCLA_A2)?>" name="comp_A[]"></td> 
                                                        <td><input type="text" class="form-control c2tor1"  value="<?php echo trim($fila->KILOS_A2)?>" name="kg_A[]"></td> 
                                                        <td><input type="text" class="form-control c2tor1"  name="lote_A[]"></td>
                                                        <td><i id="limpc2tor1" style="cursor: pointer;" class="fa fa-times"></i>
                                                        </td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c3tor1"  value="<?php echo trim($fila->MEZCLA_A3)?>" name="comp_A[]"></td> 
                                                        <td><input type="text" class="form-control c3tor1"  value="<?php echo trim($fila->KILOS_A3)?>" name="kg_A[]"></td> 
                                                        <td><input type="text" class="form-control c3tor1"  name="lote_A[]"></td>
                                                        <td><i id="limpc3tor1" style="cursor: pointer;" class="fa fa-times"></i>
                                                        </td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c4tor1"  value="<?php echo trim($fila->MEZCLA_A4)?>" name="comp_A[]"></td> 
                                                        <td><input type="text" class="form-control c4tor1"  value="<?php echo trim($fila->KILOS_A4)?>" name="kg_A[]"></td> 
                                                        <td><input type="text" class="form-control c4tor1"  name="lote_A[]"></td>
                                                        <td><i id="limpc4tor1" style="cursor: pointer;" class="fa fa-times"></i>
                                                        </td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c5tor1"  value="<?php echo trim($fila->MEZCLA_A5)?>" name="comp_A[]"></td> 
                                                        <td><input type="text" class="form-control c5tor1"  value="<?php echo trim($fila->KILOS_A5)?>" name="kg_A[]"></td>
                                                        <td><input type="text" class="form-control c5tor1"  name="lote_A[]"></td>
                                                        <td><i id="limpc5tor1" style="cursor: pointer;" class="fa fa-times"></i>
                                                        </td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c6tor1"  value="<?php echo trim($fila->MEZCLA_A6)?>" name="comp_A[]"></td> 
                                                        <td><input type="text" class="form-control c6tor1"  value="<?php echo trim($fila->KILOS_A6)?>" name="kg_A[]"></td> 
                                                        <td><input type="text" class="form-control c6tor1"  name="lote_A[]"></td>
                                                        <td><i id="limpc6tor1" style="cursor: pointer;" class="fa fa-times"></i>
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody> 
                                            </table>
                                        </div>
                                         <b>Velocidad (Hz): </b><?php echo $fila->VELTOR_A?>
                                      <!--// Fin Contenido Tornillo 1 \\-->     
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane" id="tab_2">
                                        <!--// Inicio Contenido Tornillo 2 \\-->
                                        <input type="hidden" value="2" name="tor2">
                                        <div class="col-md-5"> 
                                            <div class="table-responsive">    
                                                <table class="table table-bordered"> 
                                                    <thead> 
                                                        <tr> 
                                                            <th>Componente</th> 
                                                            <th>Kg</th> 
                                                        </tr> 
                                                    </thead> 
                                                    <tbody> 
                                                        <tr>           
                                                            <td><?php echo $fila->MEZCLA_B1?></td> 
                                                            <td><?php echo $fila->KILOS_B1?></td> 
                                                        </tr>
                                                        <tr>    
                                                            <td><?php echo $fila->MEZCLA_B2?></td> 
                                                            <td><?php echo $fila->KILOS_B2?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_B3?></td> 
                                                            <td><?php echo $fila->KILOS_B3?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_B4?></td> 
                                                            <td><?php echo $fila->KILOS_B4?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_B5?></td> 
                                                            <td><?php echo $fila->KILOS_B5?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_B6?></td> 
                                                            <td><?php echo $fila->KILOS_B6?></td> 
                                                        </tr>
                                                        
                                                    </tbody> 
                                                </table>                                   
                                            </div>
                                        </div>

                                        <div class="table-responsive"> 
                                            <table class="table table-bordered"> 
                                                <thead> 
                                                    <tr> 
                                                        <th>Componente</th> 
                                                        <th>Kg</th> 
                                                        <th>Lote</th> 
                                                        <th>Acción</th>

                                                    </tr> 
                                                </thead> 
                                                <tbody> 
                                                        
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c1tor2"  value="<?php echo trim($fila->MEZCLA_B1)?>" name="comp_B[]"></td> 
                                                        <td><input type="text" class="form-control c1tor2"  value="<?php echo trim($fila->KILOS_B1)?>" name="kg_B[]"></td> 
                                                        <td><input type="text" class="form-control c1tor2"  name="lote_B[]"></td>
                                                        <td><i id="limpc1tor2" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c2tor2"  value="<?php echo trim($fila->MEZCLA_B2)?>" name="comp_B[]"></td> 
                                                        <td><input type="text" class="form-control c2tor2"  value="<?php echo trim($fila->KILOS_B2)?>" name="kg_B[]"></td> 
                                                        <td><input type="text" class="form-control c2tor2"  name="lote_B[]"></td>
                                                        <td><i id="limpc2tor2" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c3tor2"  value="<?php echo trim($fila->MEZCLA_B3)?>" name="comp_B[]"></td> 
                                                        <td><input type="text" class="form-control c3tor2"  value="<?php echo trim($fila->KILOS_B3)?>" name="kg_B[]"></td> 
                                                        <td><input type="text" class="form-control c3tor2"  name="lote_B[]"></td>
                                                        <td><i id="limpc3tor2" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c4tor2"  value="<?php echo trim($fila->MEZCLA_B4)?>" name="comp_B[]"></td> 
                                                        <td><input type="text" class="form-control c4tor2"  value="<?php echo trim($fila->KILOS_B4)?>" name="kg_B[]"></td> 
                                                        <td><input type="text" class="form-control c4tor2"  name="lote_B[]"></td>
                                                        <td><i id="limpc4tor2" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c5tor2"  value="<?php echo trim($fila->MEZCLA_B5)?>" name="comp_B[]"></td> 
                                                        <td><input type="text" class="form-control c5tor2"  value="<?php echo trim($fila->KILOS_B5)?>" name="kg_B[]"></td>
                                                        <td><input type="text" class="form-control c5tor2"  name="lote_B[]"></td>
                                                        <td><i id="limpc5tor2" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c6tor2"  value="<?php echo trim($fila->MEZCLA_B6)?>" name="comp_B[]"></td> 
                                                        <td><input type="text" class="form-control c6tor2"  value="<?php echo trim($fila->KILOS_B6)?>" name="kg_B[]"></td> 
                                                        <td><input type="text" class="form-control c6tor2"  name="lote_B[]"></td>
                                                        <td><i id="limpc6tor2" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    
                                                </tbody> 
                                            </table>
                                        </div>
                                         <b>Velocidad (Hz): </b><?php echo $fila->VELTOR_B?>
                                      <!--// Fin Contenido Tornillo 2 \\-->
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane" id="tab_3">
                                        <!--// Inicio Contenido Tornillo 3 \\-->
                                        <input type="hidden" value="3" name="tor3">
                                        <div class="col-md-5"> 
                                            <div class="table-responsive">    
                                                <table class="table table-bordered"> 
                                                    <thead> 
                                                        <tr> 
                                                            <th>Componente</th> 
                                                            <th>Kg</th> 

                                                        </tr> 
                                                    </thead> 
                                                    <tbody> 
                                                        <tr>           
                                                            <td><?php echo $fila->MEZCLA_C1?></td> 
                                                            <td><?php echo $fila->KILOS_C1?></td> 
                                                        </tr>
                                                        <tr>    
                                                            <td><?php echo $fila->MEZCLA_C2?></td> 
                                                            <td><?php echo $fila->KILOS_C2?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_C3?></td> 
                                                            <td><?php echo $fila->KILOS_C3?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_C4?></td> 
                                                            <td><?php echo $fila->KILOS_C4?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_C5?></td> 
                                                            <td><?php echo $fila->KILOS_C5?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_C6?></td> 
                                                            <td><?php echo $fila->KILOS_C6?></td> 
                                                        </tr>
                                                        
                                                    </tbody> 
                                                </table>                                   
                                            </div>
                                        </div>

                                        <div class="table-responsive"> 
                                            <table class="table table-bordered"> 
                                                <thead> 
                                                    <tr> 
                                                        <th>Componente</th> 
                                                        <th>Kg</th> 
                                                        <th>Lote</th> 
                                                        <th>Acción</th>
                                                    </tr> 
                                                </thead> 
                                                <tbody> 
                                                        
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c1tor3"  value="<?php echo trim($fila->MEZCLA_C1)?>" name="comp_C[]"></td> 
                                                        <td><input type="text" class="form-control c1tor3"  value="<?php echo trim($fila->KILOS_C1)?>" name="kg_C[]"></td> 
                                                        <td><input type="text" class="form-control c1tor3"  name="lote_C[]"></td> 
                                                        <td><i id="limpc1tor3" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c2tor3"  value="<?php echo trim($fila->MEZCLA_C2)?>" name="comp_C[]"></td> 
                                                        <td><input type="text" class="form-control c2tor3"  value="<?php echo trim($fila->KILOS_C2)?>" name="kg_C[]"></td> 
                                                        <td><input type="text" class="form-control c2tor3"  name="lote_C[]"></td>
                                                        <td><i id="limpc2tor3" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c3tor3"  value="<?php echo trim($fila->MEZCLA_C3)?>" name="comp_C[]"></td> 
                                                        <td><input type="text" class="form-control c3tor3"  value="<?php echo trim($fila->KILOS_C3)?>" name="kg_C[]"></td> 
                                                        <td><input type="text" class="form-control c3tor3"  name="lote_C[]"></td>
                                                        <td><i id="limpc3tor3" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c4tor3"  value="<?php echo trim($fila->MEZCLA_C4)?>" name="comp_C[]"></td> 
                                                        <td><input type="text" class="form-control c4tor3"  value="<?php echo trim($fila->KILOS_C4)?>" name="kg_C[]"></td> 
                                                        <td><input type="text" class="form-control c4tor3"  name="lote_C[]"></td>
                                                        <td><i id="limpc4tor3" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c5tor3"  value="<?php echo trim($fila->MEZCLA_C5)?>" name="comp_C[]"></td> 
                                                        <td><input type="text" class="form-control c5tor3"  value="<?php echo trim($fila->KILOS_C5)?>" name="kg_C[]"></td>
                                                        <td><input type="text" class="form-control c5tor3"  name="lote_C[]"></td>
                                                        <td><i id="limpc5tor3" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c6tor3"  value="<?php echo trim($fila->MEZCLA_C6)?>" name="comp_C[]"></td> 
                                                        <td><input type="text" class="form-control c6tor3"  value="<?php echo trim($fila->KILOS_C6)?>" name="kg_C[]"></td> 
                                                        <td><input type="text" class="form-control c6tor3"  name="lote_C[]"></td>
                                                        <td><i id="limpc6tor3" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    
                                                </tbody> 
                                            </table>
                                        </div>
                                        <b>Velocidad (Hz): </b><?php echo $fila->VELTOR_C?>
                                      <!--// Fin Contenido Tornillo 3 \\-->
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane" id="tab_4">
                                        <!--// Inicio Contenido Tornillo 4 \\-->
                                        <input type="hidden" value="4" name="tor4">
                                        <div class="col-md-5"> 
                                            <div class="table-responsive">    
                                                <table class="table table-bordered"> 
                                                    <thead> 
                                                        <tr> 
                                                            <th>Componente</th> 
                                                            <th>Kg</th> 
                                                        </tr> 
                                                    </thead> 
                                                    <tbody> 
                                                        <tr>           
                                                            <td><?php echo $fila->MEZCLA_D1?></td> 
                                                            <td><?php echo $fila->KILOS_D1?></td> 
                                                        </tr>
                                                        <tr>    
                                                            <td><?php echo $fila->MEZCLA_D2?></td> 
                                                            <td><?php echo $fila->KILOS_D2?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_D3?></td> 
                                                            <td><?php echo $fila->KILOS_D3?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_D4?></td> 
                                                            <td><?php echo $fila->KILOS_D4?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_D5?></td> 
                                                            <td><?php echo $fila->KILOS_D5?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_D6?></td> 
                                                            <td><?php echo $fila->KILOS_D6?></td> 
                                                        </tr>
                                                        
                                                    </tbody> 
                                                </table>                                   
                                            </div>
                                        </div>

                                        <div class="table-responsive"> 
                                            <table class="table table-bordered"> 
                                                <thead> 
                                                    <tr> 
                                                        <th>Componente</th> 
                                                        <th>Kg</th> 
                                                        <th>Lote</th> 
                                                        <th>Acción</th>

                                                    </tr> 
                                                </thead> 
                                                <tbody> 
                                                        
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c1tor4"  value="<?php echo trim($fila->MEZCLA_D1)?>" name="comp_D[]"></td> 
                                                        <td><input type="text" class="form-control c1tor4"  value="<?php echo trim($fila->KILOS_D1)?>" name="kg_D[]"></td> 
                                                        <td><input type="text" class="form-control c1tor4"  name="lote_D[]"></td> 
                                                        <td><i id="limpc1tor4" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c2tor4"  value="<?php echo trim($fila->MEZCLA_D2)?>" name="comp_D[]"></td> 
                                                        <td><input type="text" class="form-control c2tor4"  value="<?php echo trim($fila->KILOS_D2)?>" name="kg_D[]"></td> 
                                                        <td><input type="text" class="form-control c2tor4"  name="lote_D[]"></td>
                                                         <td><i id="limpc2tor4" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c3tor4"  value="<?php echo trim($fila->MEZCLA_D3)?>" name="comp_D[]"></td> 
                                                        <td><input type="text" class="form-control c3tor4"  value="<?php echo trim($fila->KILOS_D3)?>" name="kg_D[]"></td> 
                                                        <td><input type="text" class="form-control c3tor4"  name="lote_D[]"></td>
                                                         <td><i id="limpc3tor4" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c4tor4"  value="<?php echo trim($fila->MEZCLA_D4)?>" name="comp_D[]"></td> 
                                                        <td><input type="text" class="form-control c4tor4"  value="<?php echo trim($fila->KILOS_D4)?>" name="kg_D[]"></td> 
                                                        <td><input type="text" class="form-control c4tor4"  name="lote_D[]"></td>
                                                         <td><i id="limpc4tor4" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c5tor4"  value="<?php echo trim($fila->MEZCLA_D5)?>" name="comp_D[]"></td> 
                                                        <td><input type="text" class="form-control c5tor4"  value="<?php echo trim($fila->KILOS_D5)?>" name="kg_D[]"></td>
                                                        <td><input type="text" class="form-control c5tor4"  name="lote_D[]"></td>
                                                         <td><i id="limpc5tor4" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c6tor4"  value="<?php echo trim($fila->MEZCLA_D6)?>" name="comp_D[]"></td> 
                                                        <td><input type="text" class="form-control c6tor4"  value="<?php echo trim($fila->KILOS_D6)?>" name="kg_D[]"></td> 
                                                        <td><input type="text" class="form-control c6tor4"  name="lote_D[]"></td>
                                                         <td><i id="limpc6tor4" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    
                                                </tbody> 
                                            </table>
                                        </div>
                                         <b>Velocidad (Hz): </b><?php echo $fila->VELTOR_D?>
                                      <!--// Fin Contenido Tornillo 4 \\-->
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane" id="tab_5">
                                        <!--// Inicio Contenido Tornillo 5 \\-->
                                        <input type="hidden" value="5" name="tor5">
                                        <div class="col-md-5"> 
                                            <div class="table-responsive">    
                                                <table class="table table-bordered"> 
                                                    <thead> 
                                                        <tr> 
                                                            <th>Componente</th> 
                                                            <th>Kg</th> 
                                                        </tr> 
                                                    </thead> 
                                                    <tbody> 
                                                        <tr>           
                                                            <td><?php echo $fila->MEZCLA_E1?></td> 
                                                            <td><?php echo $fila->KILOS_E1?></td> 
                                                        </tr>
                                                        <tr>    
                                                            <td><?php echo $fila->MEZCLA_E2?></td> 
                                                            <td><?php echo $fila->KILOS_E2?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_E3?></td> 
                                                            <td><?php echo $fila->KILOS_E3?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_E4?></td> 
                                                            <td><?php echo $fila->KILOS_E4?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_E5?></td> 
                                                            <td><?php echo $fila->KILOS_E5?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_E6?></td> 
                                                            <td><?php echo $fila->KILOS_E6?></td> 
                                                        </tr>
                                                        
                                                    </tbody> 
                                                </table>                                   
                                            </div>
                                        </div>

                                        <div class="table-responsive"> 
                                            <table class="table table-bordered"> 
                                                <thead> 
                                                    <tr> 
                                                        <th>Componente</th> 
                                                        <th>Kg</th> 
                                                        <th>Lote</th> 
                                                        <th>Acción</th>
                                                    </tr> 
                                                </thead> 
                                                <tbody> 
                                                        
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c1tor5"  value="<?php echo trim($fila->MEZCLA_E1)?>" name="comp_E[]"></td> 
                                                        <td><input type="text" class="form-control c1tor5"  value="<?php echo trim($fila->KILOS_E1)?>" name="kg_E[]"></td> 
                                                        <td><input type="text" class="form-control c1tor5"  name="lote_E[]"></td>
                                                        <td><i id="limpc1tor5" style="cursor: pointer;" class="fa fa-times"></i> </td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c2tor5"  value="<?php echo trim($fila->MEZCLA_E2)?>" name="comp_E[]"></td> 
                                                        <td><input type="text" class="form-control c2tor5"  value="<?php echo trim($fila->KILOS_E2)?>" name="kg_E[]"></td> 
                                                        <td><input type="text" class="form-control c2tor5"  name="lote_E[]"></td>
                                                        <td><i id="limpc2tor5" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c3tor5"  value="<?php echo trim($fila->MEZCLA_E3)?>" name="comp_E[]"></td> 
                                                        <td><input type="text" class="form-control c3tor5"  value="<?php echo trim($fila->KILOS_E3)?>" name="kg_E[]"></td> 
                                                        <td><input type="text" class="form-control c3tor5"  name="lote_E[]"></td>
                                                        <td><i id="limpc3tor5" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c4tor5"  value="<?php echo trim($fila->MEZCLA_E4)?>" name="comp_E[]"></td> 
                                                        <td><input type="text" class="form-control c4tor5"  value="<?php echo trim($fila->KILOS_E4)?>" name="kg_E[]"></td> 
                                                        <td><input type="text" class="form-control c4tor5"  name="lote_E[]"></td>
                                                        <td><i id="limpc4tor5" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c5tor5"  value="<?php echo trim($fila->MEZCLA_E5)?>" name="comp_E[]"></td> 
                                                        <td><input type="text" class="form-control c5tor5"  value="<?php echo trim($fila->KILOS_E5)?>" name="kg_E[]"></td>
                                                        <td><input type="text" class="form-control c5tor5"  name="lote_E[]"></td>
                                                        <td><i id="limpc5tor5" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c6tor5"  value="<?php echo trim($fila->MEZCLA_E6)?>" name="comp_E[]"></td> 
                                                        <td><input type="text" class="form-control c6tor5"  value="<?php echo trim($fila->KILOS_E6)?>" name="kg_E[]"></td> 
                                                        <td><input type="text" class="form-control c6tor5"  name="lote_E[]"></td>
                                                        <td><i id="limpc6tor5" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    
                                                </tbody> 
                                            </table>
                                        </div>
                                         <b>Velocidad (Hz): </b><?php echo $fila->VELTOR_E?>
                                      <!--// Fin Contenido Tornillo 5 \\-->   
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane" id="tab_6">
                                        <!--// Inicio Contenido Tornillo 6 \\-->
                                        <input type="hidden" value="6" name="tor6">
                                        <div class="col-md-5"> 
                                            <div class="table-responsive">    
                                                <table class="table table-bordered"> 
                                                    <thead> 
                                                        <tr> 
                                                            <th>Componente</th> 
                                                            <th>Kg</th> 
                                                        </tr> 
                                                    </thead> 
                                                    <tbody> 
                                                        <tr>           
                                                            <td><?php echo $fila->MEZCLA_F1?></td> 
                                                            <td><?php echo $fila->KILOS_F1?></td> 
                                                        </tr>
                                                        <tr>    
                                                            <td><?php echo $fila->MEZCLA_F2?></td> 
                                                            <td><?php echo $fila->KILOS_F2?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_F3?></td> 
                                                            <td><?php echo $fila->KILOS_F3?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_F4?></td> 
                                                            <td><?php echo $fila->KILOS_F4?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_F5?></td> 
                                                            <td><?php echo $fila->KILOS_F5?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_F6?></td> 
                                                            <td><?php echo $fila->KILOS_F6?></td> 
                                                        </tr>
                                                        
                                                    </tbody> 
                                                </table>                                   
                                            </div>
                                        </div>

                                        <div class="table-responsive"> 
                                            <table class="table table-bordered"> 
                                                <thead> 
                                                    <tr> 
                                                        <th>Componente</th> 
                                                        <th>Kg</th> 
                                                        <th>Lote</th> 
                                                        <th>Acción</th>

                                                    </tr> 
                                                </thead> 
                                                <tbody> 
                                                        
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c1tor6"  value="<?php echo trim($fila->MEZCLA_F1)?>" name="comp_F[]"></td> 
                                                        <td><input type="text" class="form-control c1tor6"  value="<?php echo trim($fila->KILOS_F1)?>" name="kg_F[]"></td> 
                                                        <td><input type="text" class="form-control c1tor6"  name="lote_F[]"></td>
                                                        <td><i id="limpc1tor6" style="cursor: pointer;" class="fa fa-times"></i></td> 
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c2tor6"  value="<?php echo trim($fila->MEZCLA_F2)?>" name="comp_F[]"></td> 
                                                        <td><input type="text" class="form-control c2tor6"  value="<?php echo trim($fila->KILOS_F2)?>" name="kg_F[]"></td> 
                                                        <td><input type="text" class="form-control c2tor6"  name="lote_F[]"></td>
                                                        <td><i id="limpc2tor6" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c3tor6"  value="<?php echo trim($fila->MEZCLA_F3)?>" name="comp_F[]"></td> 
                                                        <td><input type="text" class="form-control c3tor6"  value="<?php echo trim($fila->KILOS_F3)?>" name="kg_F[]"></td> 
                                                        <td><input type="text" class="form-control c3tor6"  name="lote_F[]"></td>
                                                        <td><i id="limpc3tor6" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c4tor6"  value="<?php echo trim($fila->MEZCLA_F4)?>" name="comp_F[]"></td> 
                                                        <td><input type="text" class="form-control c4tor6"  value="<?php echo trim($fila->KILOS_F4)?>" name="kg_F[]"></td> 
                                                        <td><input type="text" class="form-control c4tor6"  name="lote_F[]"></td>
                                                        <td><i id="limpc4tor6" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control  nom_mezcla c5tor6"  value="<?php echo trim($fila->MEZCLA_F5)?>" name="comp_F[]"></td> 
                                                        <td><input type="text" class="form-control c5tor6"  value="<?php echo trim($fila->KILOS_F5)?>" name="kg_F[]"></td>
                                                        <td><input type="text" class="form-control c5tor6"  name="lote_F[]"></td>
                                                        <td><i id="limpc5tor6" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c6tor6"  value="<?php echo trim($fila->MEZCLA_F6)?>" name="comp_F[]"></td> 
                                                        <td><input type="text" class="form-control c6tor6"  value="<?php echo trim($fila->KILOS_F6)?>" name="kg_F[]"></td> 
                                                        <td><input type="text" class="form-control c6tor6"  name="lote_F[]"></td>
                                                        <td><i id="limpc6tor6" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    
                                                </tbody> 
                                            </table>
                                        </div>
                                         <b>Velocidad (Hz): </b><?php echo $fila->VELTOR_F?>
                                      <!--// Fin Contenido Tornillo 6 \\-->
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane" id="tab_7">
                                        <!--// Inicio Contenido Tornillo 7 \\-->
                                        <input type="hidden" value="7" name="tor7">
                                        <div class="col-md-5"> 
                                            <div class="table-responsive">    
                                                <table class="table table-bordered"> 
                                                    <thead> 
                                                        <tr> 
                                                            <th>Componente</th> 
                                                            <th>Kg</th> 
                                                        </tr> 
                                                    </thead> 
                                                    <tbody> 
                                                        <tr>           
                                                            <td><?php echo $fila->MEZCLA_G1?></td> 
                                                            <td><?php echo $fila->KILOS_G1?></td> 
                                                        </tr>
                                                        <tr>    
                                                            <td><?php echo $fila->MEZCLA_G2?></td> 
                                                            <td><?php echo $fila->KILOS_G2?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_G3?></td> 
                                                            <td><?php echo $fila->KILOS_G3?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_G4?></td> 
                                                            <td><?php echo $fila->KILOS_G4?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_G5?></td> 
                                                            <td><?php echo $fila->KILOS_G5?></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $fila->MEZCLA_G6?></td> 
                                                            <td><?php echo $fila->KILOS_G6?></td> 
                                                        </tr>
                                                        
                                                    </tbody> 
                                                </table>                                   
                                            </div>
                                        </div>

                                        <div class="table-responsive"> 
                                            <table class="table table-bordered"> 
                                                <thead> 
                                                    <tr> 
                                                        <th>Componente</th> 
                                                        <th>Kg</th> 
                                                        <th>Lote</th> 
                                                        <th>Acción</th>

                                                    </tr> 
                                                </thead> 
                                                <tbody> 
                                                        
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c1tor7"  value="<?php echo trim($fila->MEZCLA_G1)?>" name="comp_G[]"></td> 
                                                        <td><input type="text" class="form-control c1tor7"  value="<?php echo trim($fila->KILOS_G1)?>" name="kg_G[]"></td> 
                                                        <td><input type="text" class="form-control c1tor7"  name="lote_G[]"></td>
                                                         <td><i id="limpc1tor7" style="cursor: pointer;" class="fa fa-times"></i></td> 
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c2tor7"  value="<?php echo trim($fila->MEZCLA_G2)?>" name="comp_G[]"></td> 
                                                        <td><input type="text" class="form-control c2tor7"  value="<?php echo trim($fila->KILOS_G2)?>" name="kg_G[]"></td> 
                                                        <td><input type="text" class="form-control c2tor7"  name="lote_G[]"></td>
                                                         <td><i id="limpc2tor7" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c3tor7"  value="<?php echo trim($fila->MEZCLA_G3)?>" name="comp_G[]"></td> 
                                                        <td><input type="text" class="form-control c3tor7"  value="<?php echo trim($fila->KILOS_G3)?>" name="kg_G[]"></td> 
                                                        <td><input type="text" class="form-control c3tor7"  name="lote_G[]"></td>
                                                         <td><i id="limpc3tor7" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c4tor7"  value="<?php echo trim($fila->MEZCLA_G4)?>" name="comp_G[]"></td> 
                                                        <td><input type="text" class="form-control c4tor7"  value="<?php echo trim($fila->KILOS_G4)?>" name="kg_G[]"></td> 
                                                        <td><input type="text" class="form-control c4tor7"  name="lote_G[]"></td>
                                                         <td><i id="limpc4tor7" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c5tor7"  value="<?php echo trim($fila->MEZCLA_G5)?>" name="comp_G[]"></td> 
                                                        <td><input type="text" class="form-control c5tor7"  value="<?php echo trim($fila->KILOS_G5)?>" name="kg_G[]"></td>
                                                        <td><input type="text" class="form-control c5tor7"  name="lote_G[]"></td>
                                                         <td><i id="limpc5tor7" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c6tor7"  value="<?php echo trim($fila->MEZCLA_G6)?>" name="comp_G[]"></td> 
                                                        <td><input type="text" class="form-control c6tor7"  value="<?php echo trim($fila->KILOS_G6)?>" name="kg_G[]"></td> 
                                                        <td><input type="text" class="form-control c6tor7"  name="lote_G[]"></td>
                                                         <td><i id="limpc6tor7" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    
                                                </tbody> 
                                            </table>
                                        </div>
                                         <b>Velocidad (Hz): </b><?php echo $fila->VELTOR_G?>
                                      <!--// Fin Contenido Tornillo 7 \\-->
                                    </div><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->

                                
                            <!-- ////// Fin - formulario que contiene todos los parametros que se van a enviar ///////-->
                        </div><!-- nav-tabs-custom -->
                        <!--- Fin Velocidades y Mezclas Orden de Produccion Extrusion -->

                            <div class="row">
                                <div class="col-xs-4">
                                    <b>Operario responsable</b>
                                    <i id="limpiar" style="cursor: pointer;" class="fa fa-times"></i><br><br>
                                    <input id="operarios" type="text" class="form-control" placeholder="Nombre Operario" name="op_res" required> 
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
                                        <a class="btn btn-block btn-primary" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/extruder/control_mezclas/controles_mezclas.php" style="text-decoration: none;">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </form>                 
               
            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- =============================================== -->
<?php
    sqlsrv_close( $connPlas );
?> 

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