<?php

  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

  $archivo = 'limpiezas';    

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
            Impresion
            <small>Limpieza</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Impresion</a></li>
            <li class="active">Limpieza</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header">
                  <h3 class="box-title">
                   Limpiezas - Terminadas
                  </h3>
          </div><!-- /.box-header -->
            <div class="box-body">
            <?php
             $registros = sqlsrv_query($connSCPBD, $limpiezas_term);
            ?>

            <table id="c_requisitos" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Fecha de Ingreso</th>
            <th>Orden #</th>
            <th>Usuario</th>    
            <th>Operario responsable</th>      
            <th>Estado Fotopolimero</th>
            <th>Observaciones</th>
        </tr>
    </thead>
    <tbody>
      <?php
while($fila = sqlsrv_fetch_object($registros)){
  echo "<tr>";
    echo "<td>".date_format($fila->fecha, 'd/m/Y g:i:s A')."</td>";
    echo "<td>".$fila->num_orden."</td>";
    echo "<td>".$fila->nombre." ".$fila->apellido. "</td>";
    echo "<td>".$fila->operario_res."</td>";
    
    if ($fila->estado_foto == 'bueno'){echo "<td><span class='label label-success'>Bueno</span></td>";}elseif($fila->estado_foto == 'malo'){echo "<td><span class='label label-warning'>Malo</span></td>";}
    echo "<td>".$fila->observaciones."</td>";
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

<div class="modal fade" id="modalNuevoCM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Nuevo premontaje</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Pedido:</label>
            <input type="text" class="form-control" id="recipient-name">
            <button type="button" class="btn btn-primary" id="buscar">Buscar</button>

          </div>
        </form>
        
        <div id="content-validacions"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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