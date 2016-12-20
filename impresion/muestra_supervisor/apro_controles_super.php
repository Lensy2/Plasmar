<?php

  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
  $archivo = 'Supervisor';

  include '../../includes/dbconfig.php';
  include '../../model/impresion.php';

  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');

  include '../../includes/impresion/header.php';
?>
    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Impresión
            <small>Control Supervisor</small>
          </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Impresion</a></li>
                <li class="active">Control Supervisor</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                    Controles De Muestra Supervisor - Aprobados
                  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
             $registros = sqlsrv_query($connSCPBD, $control_super_apro);
            ?>
                        <table id="c_requisitos" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha de Ingreso</th>
                                    <th>Orden #</th>
                                    <th>Usuario responsable</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
while($fila = sqlsrv_fetch_object($registros))
{
  echo "<tr>";
    echo "<td>".date_format($fila->fecha, 'd/m/Y g:i:s A')."</td>";
    echo "<td>".$fila->num_orden."</td>";
    echo "<td>".$fila->nombre." ".$fila->apellido. "</td>";
    echo "<td><span class='label label-success'>".$fila->estado_sup."</span></td>";
      echo "<td><i class='fa fa-fw fa-plus-circle'></i><a href='#'' data-toggle='modal' data-target='#modalNuevaLim'data-whatever='$fila->num_orden'>Nuevo - Control Limpieza</a></td>";
    echo "<td><i class='fa fa-fw fa-eye'></i><a href='detalles_apro.php?pedido=$fila->num_orden'>Detalles</a></td>";

  echo "</tr>";
}
sqlsrv_close($connSCPBD);
?>
                            </tbody>
                        </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- =============================================== -->
    <!-- ========== ventanas modales en controles de impresion ========== -->
    <div class="modal fade" id="modalNuevaLim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel" style="text-align: center;"><i class="fa fa-fw fa-plus-circle"></i>Nueva - Limpieza de Fotopolimero <small>Orden #</small>  <small id="num_ped"></small></h4>
                </div>

                <div class="modal-body">
                        <h4 align="center"><b>Estado de Fotopolimero</b></h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>BUENO</th>
                                        <th>MALO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="radio" class="minimal" name="es" value="bueno">
                                        </td>
                                        <td>
                                            <input type="radio" class="minimal" name="es" value="malo">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                   
                    <label>Operario responsable:</label>
                    <i id="limpiar" style="cursor: pointer;" class="fa fa-times"></i>
                     <br>
                     <input id="operarios" type="text" class="form-control" placeholder="Nombre de Operario" required>
                     <br>
                      <label>Observaciones:</label>
                    <textarea class="form-control observaciones" style="max-width: 100%;"></textarea>
                     <div id="content-validacions"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="guarda-limp">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /========== ventanas modales en controles de mezclas  ========== -->
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
