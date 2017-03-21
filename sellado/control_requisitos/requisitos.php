<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('sellado', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
  $archivo = 'control_req';    

  include '../../includes/dbconfig.php';
  include '../../model/sellado.php';

  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');

  include '../../includes/sellado/header.php';
?>
      <!-- =============================================== -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Sellado
            <small>Control De Requisitos</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Sellado</a></li>
            <li class="active">Control De Requisitos</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header">
                  <h3 class="box-title">
                    <a href='#' data-toggle='modal' data-target='#modalNuevoCM' data-whatever='$fila->OrdenNro'><button class="btn btn-block btn-success"><i class="fa fa-fw fa-plus"></i>Nuevo - Control De Requisitos</button></a>
                  </h3>
          </div><!-- /.box-header -->
            <div class="box-body">
            <?php
             $registros = sqlsrv_query($connSCPBD, $requisitos_pen);
            ?>

            <table id="c_requisitos" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Fecha de Ingreso</th>
            <th>Orden #</th>
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
    echo "<td>".date_format($fila->fecha, 'm/d/Y g:i:s A')."</td>";
    echo "<td>".$fila->num_orden."</td>";
    echo "<td>".$fila->nombre." ".$fila->apellido. "</td>";
    echo "<td>".$fila->operario."</td>";
    echo "<td><span class='label label-warning'>".$fila->estado."</span></td>";
    echo "<td><i class='fa fa-fw fa-edit'></i><a href='editar_requisitos.php?id=$fila->Idsellado_requisitos&pedido=$fila->num_orden'>Editar</a></td>";
     echo "<td><i class='fa fa-fw fa-eye'></i><a href='detalles_requisitos.php?pedido=$fila->num_orden'>Detalles</a></td>";
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
        <h4 class="modal-title" id="exampleModalLabel" style="text-align: center;"><i class="fa fa-fw fa-plus-circle"></i>Nuevo control de Requisito</h4>
      </div>
      <div class="modal-body">      
          
          <div class="row">
            <div class='col-md-6'>  
                  <b>Información:</b> por favor ingresar el numero de la orden / pedido  para realizar la consulta. 
              </div>
            <div class='col-md-4'>
              <input type="number" placeholder="Ingresar Valor" class="form-control" id="recipient-name">
              
            </div>
            <div class='col-md-2'>
              <button type="button" class="btn btn-primary" id="buscar">Buscar</button>
            </div>
          </div>
         <div class="row">
         <hr>
          <div id="content-validacions"></div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

 
<!-- /========== ventanas modales en controles de mezclas  ========== -->


<?php include '../../includes/sellado/footer.php'; 

//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>