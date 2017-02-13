<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario1
  $archivo = 'nuevo_control_mez';

  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');
  
  $pedido = $_GET['pedido'];
  $tipo_ext = $_GET['tipo_ext'];


include '../../includes/dbconfig.php';
include '../../model/extruder.php';
include '../../includes/extruder/header.php';

if ($tipo_ext == 'ext_normal') {
    $tipoTabla = $leerExt;
}
elseif ($tipo_ext == 'ext_laminacion') {
    $tipoTabla = $leerExtL;
}

//--- Consulta del pedido en las tablas de extrusion o extrusionl ----//
$registrosExt = sqlsrv_query($connPlas, $tipoTabla);
$fila = sqlsrv_fetch_object($registrosExt);

// ---- Consulta de toda la informacion respectiva al control de mezcla y sus tornillos ---- //
$idmezcla = $_GET['id'];

        if (isset($_GET['id'])) {
            $control_m = "SELECT * FROM tornillos tor inner join control_mezclas cm on cm.Idcontrol_mezcla=tor.Idcontrol_mezcla WHERE cm.Idcontrol_mezcla = '$idmezcla'";
            $leerControlM= sqlsrv_query($connSCPBD, $control_m);

                //Leer Componentes en tornillo 1
                $mezclas_tor1 = "SELECT * FROM tornillos tor inner join control_mezclas cm on cm.Idcontrol_mezcla=tor.Idcontrol_mezcla WHERE cm.Idcontrol_mezcla = '$idmezcla' AND tor.num_tornillo = 1";
                $leerTor1= sqlsrv_query($connSCPBD, $mezclas_tor1);
                $datosTor1 = sqlsrv_fetch_array($leerTor1);                 
                    $comp_tor1 = explode(',', $datosTor1['componente']);                    
                    $kilos_tor1 = explode(',', $datosTor1['kilos']);                    
                    $lote_tor1 = explode(',', $datosTor1['lote']);                  
                //Leer componentes en tonillo 2
                $mezclas_tor2 = "SELECT * FROM tornillos tor inner join control_mezclas cm on cm.Idcontrol_mezcla=tor.Idcontrol_mezcla WHERE cm.Idcontrol_mezcla = '$idmezcla' AND tor.num_tornillo = 2";
                $leerTor2= sqlsrv_query($connSCPBD, $mezclas_tor2);
                $datosTor2 = sqlsrv_fetch_array($leerTor2);
                    $comp_tor2 = explode(',', $datosTor2['componente']);
                    $kilos_tor2 = explode(',', $datosTor2['kilos']);
                    $lote_tor2 = explode(',', $datosTor2['lote']);
                //Leer componentes en tonillo 3
                $mezclas_tor3 = "SELECT * FROM tornillos tor inner join control_mezclas cm on cm.Idcontrol_mezcla=tor.Idcontrol_mezcla WHERE cm.Idcontrol_mezcla = '$idmezcla' AND tor.num_tornillo = 3";
                $leerTor3= sqlsrv_query($connSCPBD, $mezclas_tor3);
                $datosTor3 = sqlsrv_fetch_array($leerTor3);
                    $comp_tor3 = explode(',', $datosTor3['componente']);
                    $kilos_tor3 = explode(',', $datosTor3['kilos']);
                    $lote_tor3 = explode(',', $datosTor3['lote']);
                //Leer componentes en tonillo 4
                $mezclas_tor4 = "SELECT * FROM tornillos tor inner join control_mezclas cm on cm.Idcontrol_mezcla=tor.Idcontrol_mezcla WHERE cm.Idcontrol_mezcla = '$idmezcla' AND tor.num_tornillo = 4";
                $leerTor4= sqlsrv_query($connSCPBD, $mezclas_tor4);
                $datosTor4 = sqlsrv_fetch_array($leerTor4);
                    $comp_tor4 = explode(',', $datosTor4['componente']);
                    $kilos_tor4 = explode(',', $datosTor4['kilos']);
                    $lote_tor4 = explode(',', $datosTor4['lote']);
                //Leer componentes en tonillo 5
                $mezclas_tor5 = "SELECT * FROM tornillos tor inner join control_mezclas cm on cm.Idcontrol_mezcla=tor.Idcontrol_mezcla WHERE cm.Idcontrol_mezcla = '$idmezcla' AND tor.num_tornillo = 5";
                $leerTor5= sqlsrv_query($connSCPBD, $mezclas_tor5);
                $datosTor5 = sqlsrv_fetch_array($leerTor5);
                    $comp_tor5 = explode(',', $datosTor5['componente']);
                    $kilos_tor5 = explode(',', $datosTor5['kilos']);
                    $lote_tor5 = explode(',', $datosTor5['lote']);
                //Leer componentes en tonillo 6
                $mezclas_tor6 = "SELECT * FROM tornillos tor inner join control_mezclas cm on cm.Idcontrol_mezcla=tor.Idcontrol_mezcla WHERE cm.Idcontrol_mezcla = '$idmezcla' AND tor.num_tornillo = 6";
                $leerTor6= sqlsrv_query($connSCPBD, $mezclas_tor6);
                $datosTor6 = sqlsrv_fetch_array($leerTor6);
                    $comp_tor6 = explode(',', $datosTor6['componente']);
                    $kilos_tor6 = explode(',', $datosTor6['kilos']);
                    $lote_tor6 = explode(',', $datosTor6['lote']);
                //Leer componentes en tonillo 7
                $mezclas_tor7 = "SELECT * FROM tornillos tor inner join control_mezclas cm on cm.Idcontrol_mezcla=tor.Idcontrol_mezcla WHERE cm.Idcontrol_mezcla = '$idmezcla' AND tor.num_tornillo = 7";
                $leerTor7 = sqlsrv_query($connSCPBD, $mezclas_tor7);
                $datosTor7 = sqlsrv_fetch_array($leerTor7);
                    $comp_tor7 = explode(',', $datosTor7['componente']);
                    $kilos_tor7 = explode(',', $datosTor7['kilos']);
                    $lote_tor7 = explode(',', $datosTor7['lote']);

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
                <li class="active">Editar</li>
            </ol>
        </section>

            <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">            
                <div class="box-header">
                      <h3 class="box-title"><i class='fa fa-fw fa-edit'></i>Editar - Control de Mezcla</h3>
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
                            <form action="actualizar_control_mezcla.php" method="post" accept-charset="utf-8" id="form-mezcla">
                                <!-- Id del control de mezcla oculto -->
                                <input type="hidden" name="idcontrol_m" value="<?php echo $datosTor1[6];?>">
                                <!-- Numero de mezcla a editar -->
                                <input type="hidden" name="num_mezcla" value="<?php echo $datosTor1[12];?>">

                                <!-- Id tornillo 1 oculto -->
                                <input type="hidden" name="idtor1" value="<?php echo $datosTor1[0];?>">
                                <!-- Id tornillo 2 oculto -->
                                <input type="hidden" name="idtor2" value="<?php echo $datosTor2[0];?>">
                                <!-- Id tornillo 3 oculto -->
                                <input type="hidden" name="idtor3" value="<?php echo $datosTor3[0];?>">
                                <!-- Id tornillo 4 oculto -->
                                <input type="hidden" name="idtor4" value="<?php echo $datosTor4[0];?>">
                                <!-- Id tornillo 5 oculto -->
                                <input type="hidden" name="idtor5" value="<?php echo $datosTor5[0];?>">
                                <!-- Id tornillo 6 oculto -->
                                <input type="hidden" name="idtor6" value="<?php echo $datosTor6[0];?>">
                                <!-- Id tornillo 7 oculto -->
                                <input type="hidden" name="idtor7" value="<?php echo $datosTor7[0];?>">

                                <!-- Variable oculta: Numero de Orden -->
                                <input type="hidden" value="<?php echo $datosTor1[7];?>" name="num_orden">
                                <!-- Variable oculta: Tipo de Extrusion -->
                                <input type="hidden" value="<?php echo $datosTor1[8];?>" name="tipo_ext">    
                                
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
                                                        <td><input type="text" class="form-control nom_mezcla c1tor1"  value="<?php echo $comp_tor1[0]; ?>" name="comp_A[]"></td> 
                                                        <td><input type="text" class="form-control c1tor1"  value="<?php echo $kilos_tor1[0];?>" name="kg_A[]"></td> 
                                                        <td><input type="text" class="form-control c1tor1"  value="<?php echo $lote_tor1[0]; ?>" name="lote_A[]"></td>
                                                        <td><i id="limpc1tor1" style="cursor: pointer;" class="fa fa-times"></i>
                                                        </td> 
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c2tor1"  value="<?php echo $comp_tor1[1] ?>" name="comp_A[]"></td> 
                                                        <td><input type="text" class="form-control c2tor1"  value="<?php echo $kilos_tor1[1] ?>" name="kg_A[]"></td> 
                                                        <td><input type="text" class="form-control c2tor1"  value="<?php echo $lote_tor1[1] ?>" name="lote_A[]"></td>
                                                        <td><i id="limpc2tor1" style="cursor: pointer;" class="fa fa-times"></i>
                                                        </td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c3tor1"  value="<?php echo $comp_tor1[2] ?>" name="comp_A[]"></td> 
                                                        <td><input type="text" class="form-control c3tor1"  value="<?php echo $kilos_tor1[2] ?>" name="kg_A[]"></td> 
                                                        <td><input type="text" class="form-control c3tor1"  value="<?php echo $lote_tor1[2] ?>" name="lote_A[]"></td>
                                                        <td><i id="limpc3tor1" style="cursor: pointer;" class="fa fa-times"></i>
                                                        </td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c4tor1"  value="<?php echo $comp_tor1[3] ?>" name="comp_A[]"></td> 
                                                        <td><input type="text" class="form-control c4tor1"  value="<?php echo $kilos_tor1[3] ?>" name="kg_A[]"></td> 
                                                        <td><input type="text" class="form-control c4tor1"  value="<?php echo $lote_tor1[3] ?>" name="lote_A[]"></td>
                                                        <td><i id="limpc4tor1" style="cursor: pointer;" class="fa fa-times"></i>
                                                        </td></tr>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c5tor1"  value="<?php echo $comp_tor1[4] ?>" name="comp_A[]"></td> 
                                                        <td><input type="text" class="form-control c5tor1"  value="<?php echo $kilos_tor1[4] ?>" name="kg_A[]"></td>
                                                        <td><input type="text" class="form-control c5tor1"  value="<?php echo $lote_tor1[4] ?>" name="lote_A[]"></td>
                                                        <td><i id="limpc5tor1" style="cursor: pointer;" class="fa fa-times"></i>
                                                        </td></tr>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c6tor1"  value="<?php echo $comp_tor1[5] ?>" name="comp_A[]"></td> 
                                                        <td><input type="text" class="form-control c6tor1"  value="<?php echo $kilos_tor1[5] ?>" name="kg_A[]"></td> 
                                                        <td><input type="text" class="form-control c6tor1"  value="<?php echo $lote_tor1[5] ?>" name="lote_A[]"></td>
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
                                                        <td><input type="text" class="form-control nom_mezcla c1tor2"  value="<?php echo $comp_tor2[0]; ?>" name="comp_B[]"></td> 
                                                        <td><input type="text" class="form-control c1tor2"  value="<?php echo $kilos_tor2[0];?>" name="kg_B[]"></td> 
                                                        <td><input type="text" class="form-control c1tor2"  value="<?php echo $lote_tor2[0]; ?>" name="lote_B[]"></td>
                                                        <td><i id="limpc1tor2" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c2tor2"  value="<?php echo $comp_tor2[1];?>" name="comp_B[]"></td> 
                                                        <td><input type="text" class="form-control c2tor2"  value="<?php echo $kilos_tor2[1];?>" name="kg_B[]"></td> 
                                                        <td><input type="text" class="form-control c2tor2"  value="<?php echo $lote_tor2[1]; ?>" name="lote_B[]"></td>
                                                        <td><i id="limpc2tor2" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c3tor2"  value="<?php echo $comp_tor2[2];?>" name="comp_B[]"></td> 
                                                        <td><input type="text" class="form-control c3tor2"  value="<?php echo $kilos_tor2[2];?>" name="kg_B[]"></td> 
                                                        <td><input type="text" class="form-control c3tor2"  value="<?php echo $lote_tor2[2]; ?>" name="lote_B[]"></td>
                                                        <td><i id="limpc3tor2" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c4tor2"  value="<?php echo $comp_tor2[3];?>" name="comp_B[]"></td> 
                                                        <td><input type="text" class="form-control c4tor2"  value="<?php echo $kilos_tor2[3];?>" name="kg_B[]"></td> 
                                                        <td><input type="text" class="form-control c4tor2"  value="<?php echo $lote_tor2[3]; ?>" name="lote_B[]"></td>
                                                        <td><i id="limpc4tor2" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c5tor2"  value="<?php echo $comp_tor2[4];?>" name="comp_B[]"></td> 
                                                        <td><input type="text" class="form-control c5tor2"  value="<?php echo $kilos_tor2[4];?>" name="kg_B[]"></td>
                                                        <td><input type="text" class="form-control c5tor2"  value="<?php echo $lote_tor2[4]; ?>" name="lote_B[]"></td>
                                                        <td><i id="limpc5tor2" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control nom_mezcla c6tor2"  value="<?php echo $comp_tor2[5];?>" name="comp_B[]"></td> 
                                                        <td><input type="text" class="form-control c6tor2"  value="<?php echo $kilos_tor2[5];?>" name="kg_B[]"></td> 
                                                        <td><input type="text" class="form-control c6tor2"  value="<?php echo $lote_tor2[5]; ?>" name="lote_B[]"></td>
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
                                                        <td><input type="text" class="form-control nom_mezcla c1tor3"  value="<?php echo $comp_tor3[0] ?>" name="comp_C[]"></td> 
                                                        <td><input type="text" class="form-control c1tor3"  value="<?php echo $kilos_tor3[0] ?>" name="kg_C[]"></td> 
                                                        <td><input type="text" class="form-control c1tor3"  value="<?php echo $lote_tor3[0] ?>" name="lote_C[]"></td> 
                                                        <td><i id="limpc1tor3" style="cursor: pointer;" class="fa fa-times"></i></td>

                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c2tor3"  value="<?php echo $comp_tor3[1] ?>" name="comp_C[]"></td> 
                                                        <td><input type="text" class="form-control c2tor3"  value="<?php echo $kilos_tor3[1] ?>" name="kg_C[]"></td> 
                                                        <td><input type="text" class="form-control c2tor3"  value="<?php echo $lote_tor3[1] ?>" name="lote_C[]"></td>
                                                        <td><i id="limpc2tor3" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c3tor3"  value="<?php echo $comp_tor3[2] ?>" name="comp_C[]"></td> 
                                                        <td><input type="text" class="form-control c3tor3"  value="<?php echo $kilos_tor3[2] ?>" name="kg_C[]"></td> 
                                                        <td><input type="text" class="form-control c3tor3"  value="<?php echo $lote_tor3[2] ?>" name="lote_C[]"></td>
                                                        <td><i id="limpc3tor3" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c4tor3"  value="<?php echo $comp_tor3[3] ?>" name="comp_C[]"></td> 
                                                        <td><input type="text" class="form-control c4tor3"  value="<?php echo $kilos_tor3[3] ?>" name="kg_C[]"></td> 
                                                        <td><input type="text" class="form-control c4tor3"  value="<?php echo $lote_tor3[3] ?>" name="lote_C[]"></td>
                                                        <td><i id="limpc4tor3" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c5tor3"  value="<?php echo $comp_tor3[4] ?>" name="comp_C[]"></td> 
                                                        <td><input type="text" class="form-control c5tor3"  value="<?php echo $kilos_tor3[4] ?>" name="kg_C[]"></td>
                                                        <td><input type="text" class="form-control c5tor3"  value="<?php echo $lote_tor3[4] ?>" name="lote_C[]"></td>
                                                        <td><i id="limpc5tor3" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c6tor3"  value="<?php echo $comp_tor3[5] ?>" name="comp_C[]"></td> 
                                                        <td><input type="text" class="form-control c6tor3"  value="<?php echo $kilos_tor3[5] ?>" name="kg_C[]"></td> 
                                                        <td><input type="text" class="form-control c6tor3"  value="<?php echo $lote_tor3[5] ?>" name="lote_C[]"></td>
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
                                                        <td><input type="text" class="form-control nom_mezcla c1tor4"  value="<?php echo $comp_tor4[0] ?>" name="comp_D[]"></td> 
                                                        <td><input type="text" class="form-control c1tor4"  value="<?php echo $kilos_tor4[0] ?>" name="kg_D[]"></td> 
                                                        <td><input type="text" class="form-control c1tor4"  value="<?php echo $lote_tor4[0] ?>" name="lote_D[]"></td> 
                                                        <td><i id="limpc1tor4" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c2tor4"  value="<?php echo $comp_tor4[1] ?>" name="comp_D[]"></td> 
                                                        <td><input type="text" class="form-control c2tor4"  value="<?php echo $kilos_tor4[1] ?>" name="kg_D[]"></td> 
                                                        <td><input type="text" class="form-control c2tor4"  value="<?php echo $lote_tor4[1] ?>" name="lote_D[]"></td>
                                                        <td><i id="limpc2tor4" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c3tor4"  value="<?php echo $comp_tor4[2] ?>" name="comp_D[]"></td> 
                                                        <td><input type="text" class="form-control c3tor4"  value="<?php echo $kilos_tor4[2] ?>" name="kg_D[]"></td> 
                                                        <td><input type="text" class="form-control c3tor4"  value="<?php echo $lote_tor4[2] ?>" name="lote_D[]"></td>
                                                        <td><i id="limpc3tor4" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c4tor4"  value="<?php echo $comp_tor4[3] ?>" name="comp_D[]"></td> 
                                                        <td><input type="text" class="form-control c4tor4"  value="<?php echo $kilos_tor4[3] ?>" name="kg_D[]"></td> 
                                                        <td><input type="text" class="form-control c4tor4"  value="<?php echo $lote_tor4[3] ?>" name="lote_D[]"></td>
                                                        <td><i id="limpc4tor4" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c5tor4"  value="<?php echo $comp_tor4[4] ?>" name="comp_D[]"></td> 
                                                        <td><input type="text" class="form-control c5tor4"  value="<?php echo $kilos_tor4[4] ?>" name="kg_D[]"></td>
                                                        <td><input type="text" class="form-control c5tor4"  value="<?php echo $lote_tor4[4] ?>" name="lote_D[]"></td>
                                                        <td><i id="limpc5tor4" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c6tor4"  value="<?php echo $comp_tor4[5] ?>" name="comp_D[]"></td> 
                                                        <td><input type="text" class="form-control c6tor4"  value="<?php echo $kilos_tor4[5] ?>" name="kg_D[]"></td> 
                                                        <td><input type="text" class="form-control c6tor4"  value="<?php echo $lote_tor4[5] ?>" name="lote_D[]"></td>
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
                                                        <td><input type="text" class="form-control nom_mezcla c1tor5"  value="<?php echo $comp_tor5[0] ?>" name="comp_E[]"></td> 
                                                        <td><input type="text" class="form-control c1tor5"  value="<?php echo $kilos_tor5[0] ?>" name="kg_E[]"></td> 
                                                        <td><input type="text" class="form-control c1tor5"  value="<?php echo $lote_tor5[0] ?>" name="lote_E[]"></td> 
                                                        <td><i id="limpc1tor5" style="cursor: pointer;" class="fa fa-times"></i> </td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c2tor5"  value="<?php echo $comp_tor5[1] ?>" name="comp_E[]"></td> 
                                                        <td><input type="text" class="form-control c2tor5"  value="<?php echo $kilos_tor5[1] ?>" name="kg_E[]"></td> 
                                                        <td><input type="text" class="form-control c2tor5"  value="<?php echo $lote_tor5[1] ?>" name="lote_E[]"></td>
                                                        <td><i id="limpc2tor5" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c3tor5"  value="<?php echo $comp_tor5[2] ?>" name="comp_E[]"></td> 
                                                        <td><input type="text" class="form-control c3tor5"  value="<?php echo $kilos_tor5[2] ?>" name="kg_E[]"></td> 
                                                        <td><input type="text" class="form-control c3tor5"  value="<?php echo $lote_tor5[2] ?>" name="lote_E[]"></td>
                                                        <td><i id="limpc3tor5" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c4tor5"  value="<?php echo $comp_tor5[3] ?>" name="comp_E[]"></td> 
                                                        <td><input type="text" class="form-control c4tor5"  value="<?php echo $kilos_tor5[3] ?>" name="kg_E[]"></td> 
                                                        <td><input type="text" class="form-control c4tor5"  value="<?php echo $lote_tor5[3] ?>" name="lote_E[]"></td>
                                                        <td><i id="limpc4tor5" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c5tor5"  value="<?php echo $comp_tor5[4] ?>" name="comp_E[]"></td> 
                                                        <td><input type="text" class="form-control c5tor5"  value="<?php echo $kilos_tor5[4] ?>" name="kg_E[]"></td>
                                                        <td><input type="text" class="form-control c5tor5"  value="<?php echo $lote_tor5[4] ?>" name="lote_E[]"></td>
                                                        <td><i id="limpc5tor5" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c6tor5"  value="<?php echo $comp_tor5[5] ?>" name="comp_E[]"></td> 
                                                        <td><input type="text" class="form-control c6tor5"  value="<?php echo $kilos_tor5[5] ?>" name="kg_E[]"></td> 
                                                        <td><input type="text" class="form-control c6tor5"  value="<?php echo $lote_tor5[5] ?>" name="lote_E[]"></td>
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
                                                        <td><input type="text" class="form-control nom_mezcla c1tor6"  value="<?php echo $comp_tor6[0] ?>" name="comp_F[]"></td> 
                                                        <td><input type="text" class="form-control c1tor6"  value="<?php echo $kilos_tor6[0] ?>" name="kg_F[]"></td> 
                                                        <td><input type="text" class="form-control c1tor6"  value="<?php echo $lote_tor6[0] ?>" name="lote_F[]"></td> 
                                                        <td><i id="limpc1tor6" style="cursor: pointer;" class="fa fa-times"></i></td> 
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c2tor6"  value="<?php echo $comp_tor6[1] ?>" name="comp_F[]"></td> 
                                                        <td><input type="text" class="form-control c2tor6"  value="<?php echo $kilos_tor6[1] ?>" name="kg_F[]"></td> 
                                                        <td><input type="text" class="form-control c2tor6"  value="<?php echo $lote_tor6[1] ?>" name="lote_F[]"></td>
                                                        <td><i id="limpc2tor6" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c3tor6"  value="<?php echo $comp_tor6[2] ?>" name="comp_F[]"></td> 
                                                        <td><input type="text" class="form-control c3tor6"  value="<?php echo $kilos_tor6[2] ?>" name="kg_F[]"></td> 
                                                        <td><input type="text" class="form-control c3tor6"  value="<?php echo $lote_tor6[2] ?>" name="lote_F[]"></td>
                                                        <td><i id="limpc3tor6" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c4tor6"  value="<?php echo $comp_tor6[3] ?>" name="comp_F[]"></td> 
                                                        <td><input type="text" class="form-control c4tor6"  value="<?php echo $kilos_tor6[3] ?>" name="kg_F[]"></td> 
                                                        <td><input type="text" class="form-control c4tor6"  value="<?php echo $lote_tor6[3] ?>" name="lote_F[]"></td>
                                                        <td><i id="limpc4tor6" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c5tor6"  value="<?php echo $comp_tor6[4] ?>" name="comp_F[]"></td> 
                                                        <td><input type="text" class="form-control c5tor6"  value="<?php echo $kilos_tor6[4] ?>" name="kg_F[]"></td>
                                                        <td><input type="text" class="form-control c5tor6"  value="<?php echo $lote_tor6[4] ?>" name="lote_F[]"></td>
                                                        <td><i id="limpc5tor6" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c6tor6"  value="<?php echo $comp_tor6[5] ?>" name="comp_F[]"></td> 
                                                        <td><input type="text" class="form-control c6tor6"  value="<?php echo $kilos_tor6[5] ?>" name="kg_F[]"></td> 
                                                        <td><input type="text" class="form-control c6tor6"  value="<?php echo $lote_tor6[5] ?>" name="lote_F[]"></td>
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
                                                        <td><input type="text" class="form-control nom_mezcla c1tor7"  value="<?php echo $comp_tor7[0] ?>" name="comp_G[]"></td> 
                                                        <td><input type="text" class="form-control c1tor7"  value="<?php echo $kilos_tor7[0] ?>" name="kg_G[]"></td> 
                                                        <td><input type="text" class="form-control c1tor7"  value="<?php echo $lote_tor7[0] ?>" name="lote_G[]"></td> 
                                                        <td><i id="limpc1tor7" style="cursor: pointer;" class="fa fa-times"></i></td> 
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c2tor7"  value="<?php echo $comp_tor7[1] ?>" name="comp_G[]"></td> 
                                                        <td><input type="text" class="form-control c2tor7"  value="<?php echo $kilos_tor7[1] ?>" name="kg_G[]"></td> 
                                                        <td><input type="text" class="form-control c2tor7"  value="<?php echo $lote_tor7[1] ?>" name="lote_G[]"></td>
                                                        <td><i id="limpc2tor7" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c3tor7"  value="<?php echo $comp_tor7[2] ?>" name="comp_G[]"></td> 
                                                        <td><input type="text" class="form-control c3tor7"  value="<?php echo $kilos_tor7[2] ?>" name="kg_G[]"></td> 
                                                        <td><input type="text" class="form-control c3tor7"  value="<?php echo $lote_tor7[2] ?>" name="lote_G[]"></td>
                                                        <td><i id="limpc3tor7" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c4tor7"  value="<?php echo $comp_tor7[3] ?>" name="comp_G[]"></td> 
                                                        <td><input type="text" class="form-control c4tor7"  value="<?php echo $kilos_tor7[3] ?>" name="kg_G[]"></td> 
                                                        <td><input type="text" class="form-control c4tor7"  value="<?php echo $lote_tor7[3] ?>" name="lote_G[]"></td>
                                                        <td><i id="limpc4tor7" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c5tor7"  value="<?php echo $comp_tor7[4] ?>" name="comp_G[]"></td> 
                                                        <td><input type="text" class="form-control c5tor7"  value="<?php echo $kilos_tor7[4] ?>" name="kg_G[]"></td>
                                                        <td><input type="text" class="form-control c5tor7"  value="<?php echo $lote_tor7[4] ?>" name="lote_G[]"></td>
                                                        <td><i id="limpc5tor7" style="cursor: pointer;" class="fa fa-times"></i></td>
                                                    </tr>
                                                    <tr>           
                                                        <td><input type="text" class="form-control nom_mezcla c6tor7"  value="<?php echo $comp_tor7[5] ?>" name="comp_G[]"></td> 
                                                        <td><input type="text" class="form-control c6tor7"  value="<?php echo $kilos_tor7[5] ?>" name="kg_G[]"></td> 
                                                        <td><input type="text" class="form-control c6tor7"  value="<?php echo $lote_tor7[5] ?>" name="lote_G[]"></td>
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
                                    <input id="operarios" type="text" class="form-control" placeholder="Nombre Operario" value="<?php echo $datosTor1[11];?>" name="op_res" required> 
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
}
    sqlsrv_close( $connPlas );
    sqlsrv_close( $connSCPBD );
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