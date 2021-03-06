<?php
  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

  $archivo = 'Impresor';

//$rol = $_GET['rol'];
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
            <small>Control De Muestra</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Impresion</a></li>
            <li class="active">Control De Muestra</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header">
                  <h3 class="box-title">
                   Controles De Muestra Impresor - Aprobados
                  </h3>
          </div><!-- /.box-header -->
            <div class="box-body">
            

            <table id="c_requisitos" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Fecha de Ingreso</th>
            <th>Orden #</th>
            <th>Usuario responsable</th>
            <th>Estado</th>
            <th>Accion</th> <!--<?php //if ($rol == 'matizador') {echo "<th>Accion</th>"; } ?>-->
            <th>Ver</th>

        </tr>
    </thead>
    <tbody>
      <?php
    
       $registros = sqlsrv_query($connSCPBD, $control_muestra);

      while($fila = sqlsrv_fetch_object($registros)){
  echo "<tr>";
    echo "<td>".date_format($fila->fecha, 'm/d/Y g:i:s A')."</td>";
    echo "<td>".$fila->num_orden."</td>";
   echo "<td>".$fila->nombre." ".$fila->apellido. "</td>";
    echo "<td><span class='label label-success'>".$fila->estado_imp."</span></td>";
    echo "<td><i class='fa fa-fw fa-plus-circle'></i><a href='#' data-toggle='modal' data-target='#modalNuevoCMmat' data-whatever='$fila->num_orden'>Nuevo - C.M Matizador</a></td>";
    echo "<td><i class='fa fa-fw fa-eye'></i><a href='detalles.php?pedido=$fila->num_orden'>Detalles</a></td>";

    //echo "<td><i class='fa fa-fw fa-plus-circle'></i><a href='../muestra_matizador/control_muestra_mat.php?pedido=$fila->num_orden'>Nuevo - C.M Matizador</a></td>";
    //if ($rol == 'matizador') {echo "<td><i class='fa fa-fw fa-plus-circle'></i><a href='../muestra_matizador/control_muestra_mat.php?pedido=$fila->num_orden'>Nuevo - C.M Matizador</a></td>";}
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
 <div class="modal fade" id="modalNuevoCMmat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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