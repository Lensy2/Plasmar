<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

  $archivo = 'nuevo_control_req';
  
  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');
  
  include '../../includes/dbconfig.php';
  include '../../includes/extruder/header.php';
  include '../../model/extruder.php';
?>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Extruder
            <small>Control De Requisitos</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Extruder</a></li>
            <li class="active">Control De Requisitos</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header">
                  <h3 class="box-title">
                    Controles de requisitos - Aprobados
                  </h3>
            </div><!-- /.box-header -->
            <div class="box-body">
            <?php
              $registros = sqlsrv_query($connSCPBD, $control_requisitos_apro);
            ?>

            <table id="c_requisitos" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Fecha de Ingreso</th>
                        <th>Orden #</th>
                        <th>Tipo de Extrusion</th>
                        <th>Mezcla #</th>
                        <th>Usuario</th>
                        <th>Operario responsable</th>            
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
                if ($fila->tipo_ext == 'ext_normal'){echo "<td>Normal</td>";}else{echo "<td>Laminación </td>";}
                echo "<td>".$fila->num_mezcla."</td>";
                echo "<td>".$fila->nombre." ".$fila->apellido. "</td>";
                echo "<td>".$fila->operario_res."</td>";
                echo "<td><span class='label label-success'>".$fila->estado."</span></td>";
                echo "<td><i class='fa fa-fw fa-plus-circle'></i><a href='#'' data-toggle='modal' data-target='#modalNuevoCC' data-whatever='$fila->num_orden' data-tipopedido='$fila->tipo_ext' data-idmezcla='$fila->num_mezcla'>Nuevo Control de Calidad</a></td>";
                echo "<td><i class='fa fa-fw fa-eye'></i><a href='detalles_apro.php?pedido=$fila->num_orden&tipo_ext=$fila->tipo_ext'>Detalles</a></td>";
              echo "</tr>";
            }

            sqlsrv_close( $connSCPBD );
            ?>

                </tbody>
            </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- =============================================== -->

<!-- ========== ventanas modales en controles de requisitos ========== -->


  <div class="modal fade" id="modalNuevoCC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel" style="text-align: center;"><i class="fa fa-fw fa-check-square-o"></i>¡Calidad de Rollos por Pedido!</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class='col-md-4' style="text-align: center;">  
                  <b>Orden / Pedido:</b><br>
                  <span id="numpedido"></span>
              </div>
            <div class='col-md-4' style="text-align: center;">
                <b>Tipo de Extrusion:</b><br>
                <span id="tipopedido"></span>
            </div>  
            <div class='col-md-4' style="text-align: center;">
                <b>Mezcla #:</b><br>
                <span id="idmez"></span>
            </div>         
        </div>
        <div class="row">
          <div id="content-validacion"></div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
<!-- /========== ventanas modales en controles de requisitos ========== -->



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