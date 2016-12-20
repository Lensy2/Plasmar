<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('refilado', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
  $archivo = 'control_req';
  include '../../includes/dbconfig.php';
  include '../../model/refilado.php';
  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');
  include '../../includes/refilado/header.php';
?>
      <!-- =============================================== -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Refilado
            <small>Control De Requisitos</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Refilado</a></li>
            <li class="active">Control De Requisitos</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header">
                  <h3 class="box-title">
                    Controles De Requisitos - Aprobados
                  </h3>
          </div><!-- /.box-header -->
            <div class="box-body">
            <?php
             $registros = sqlsrv_query($connSCPBD, $requisitos_apro);
            ?>

            <table id="c_requisitos" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#Reg</th>
            <th>Fecha de Ingreso</th>
            <th>Orden #</th>
            <th>Usuario</th>
            <th>Operario responsable</th>      
            <th>Estado</th>
            <th>Ver</th>
        </tr>
    </thead>
    <tbody>
      <?php
while($fila = sqlsrv_fetch_object($registros))
{
  echo "<tr>";
    echo "<td>".$fila->Idrefilado_requisitos."</td>";
    echo "<td>".date_format($fila->fecha, 'm/d/Y g:i:s A')."</td>";
    echo "<td>".$fila->num_orden."</td>";
    echo "<td>".$fila->nombre." ".$fila->apellido. "</td>";
    echo "<td>".$fila->operario."</td>";
    echo "<td><span class='label label-success'>".$fila->estado."</span></td>";
    echo "<td><i class='fa fa-fw fa-eye'></i><a href='detalles.php?pedido=$fila->num_orden'>Detalles</a></td>";
  echo "</tr>";
}
sqlsrv_close($connSCPBD);
?>

    </tbody>
</table>
</div><!-- /.box-body -->
</div><!-- /.box -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- =============================================== -->

<!-- ========== ventanas modales en controles de mezclas ========== -->

 <div class="modal fade" id="modalNuevoCRimp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-fw fa-warning"></i>¡Validacion tipo de pedido!<small id="num_ped"></small></h4>
        </div>
        <div class="modal-body">
          <div class="row">
           <div class="col-md-12" id="content-validacion"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

 
<!-- /========== ventanas modales en controles de mezclas  ========== -->


<?php include '../../includes/refilado/footer.php'; 
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>