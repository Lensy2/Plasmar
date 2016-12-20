<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

  $archivo = 'programacion';
   
  include '../includes/dbconfig.php';
  include '../model/extruder.php';

 include '../includes/funciones.php';
  $enlace = rutaRecursos('primer_nivel');

  include '../includes/extruder/header.php';
?>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Extruder
            <small>Programación</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Extruder</a></li>
            <li class="active">Programación</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header">
                  <h3 class="box-title">Alta Densidad</h3>
          </div><!-- /.box-header -->
            <div class="box-body">
            <?php
              $registros = sqlsrv_query($connPlas, $progExtruderAD);
            ?>

            <table id="prog_ext" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Posición</th>
            <th>Orden #</th>
            <th>Cantidad</th>
            <th>Maquina</th>
            <th>Comentario</th>
            <th>Referencia</th>
            <th>Descripción</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
      <?php
while($fila = sqlsrv_fetch_object($registros))
{
    echo "<tr>";
    echo "<td>".$fila->OrdenEjec."</td>";
    echo "<td>".$fila->OrdenNro."</td>";        
    echo "<td>".$fila->Cantidad."</td>";
    echo "<td>".$fila->Maquina."</td>";
    echo "<td>".$fila->Comentario."</td>";
    echo "<td>".$fila->PRODUCTO."</td>"; 
    echo "<td>".$fila->DESCRIPCIO."</td>"; 
    
    echo "<td><i class='fa fa-fw fa-plus-circle'></i><a href='#'' data-toggle='modal' data-target='#modalProgramacion' data-whatever='$fila->OrdenNro'> Nuevo Control de Mezcla</a></td>";
    echo "</tr>";
}

sqlsrv_close( $connPlas );
?>

    </tbody>
</table>
              
              

            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- =============================================== -->

  <!-- ========== ventanas modales en programacion ========== -->

  <div class="modal fade" id="modalProgramacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel" style="text-align: center;"><i class="fa fa-fw fa-warning"></i>¡Validacion tipo de pedido!<small id="num_ped"></small></h4>
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
  <!-- /========== ventanas modales en programacion ========== -->


<?php include '../includes/extruder/footer.php'; 
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../autenticacion/restrin.php';
  }
}else{

  include '../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>