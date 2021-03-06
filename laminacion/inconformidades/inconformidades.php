<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('laminacion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
 $archivo = 'nueva_inconf_ext';
  include '../../includes/funciones.php';
$enlace = rutaRecursos('segundo_nivel');
  include '../../includes/dbconfig.php';
  include '../../includes/laminacion/header.php';
  include '../../model/laminacion.php';
?>
      <!-- =============================================== -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Laminación 
            <small>Inconformidades</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Laminación </a></li>
            <li class="active">Inconformidades</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header">
                   <h3 class="box-title">
                    <a href="#" data-toggle="modal" data-target="#modalNuevaInc" data-whatever="$fila->OrdenNro"><button class="btn btn-block btn-success"><i class="fa fa-fw fa-plus"></i>Nueva - Inconformidad</button></a>
                  </h3>

          </div><!-- /.box-header -->
            <div class="box-body">
            
            <?php
              $registros = sqlsrv_query($connSCPBD, $inconformidades_term);
            ?>

            <table id="c_requisitos" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Fecha de Ingreso</th>
            <th>Orden #</th>        
            <th>Cliente</th>
            <th>Rollo #</th>
            <th>Operario responsable</th>   
            <th>Tipo</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
      <?php
while($fila = sqlsrv_fetch_object($registros))
{
  echo "<tr>";
    echo "<td>".date_format($fila->fecha, 'd/m/Y g:i:s A')."</td>";
    echo "<td>".$fila->num_orden."</td>";
    echo "<td>".$fila->cliente."</td>";
    echo "<td>".$fila->num_rollo."</td>";
    echo "<td>".$fila->operario_res. "</td>";
    if ($fila->tipo_inconf == 'NO CONFORME'){echo "<td><span class='label label-danger'>NO CONFORME</span></td>";}elseif($fila->tipo_inconf == 'EN TRANSITO'){echo "<td><span class='label label-warning'>EN TRANSITO</span></td>";}elseif ($fila->tipo_inconf == 'NO INOCUO') {echo "<td><span class='label label-danger'>NO INOCUO</span></td>";}
    echo "<td><a href='ver_inconformidad.php?id=$fila->Idlam_inconformidades'>Detalle</a><i class='fa fa-fw fa-eye'></i></td>";
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

  <!-- ========== ventanas modales en controles de requisitos ========== -->


  <div class="modal fade" id="modalNuevaInc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel" style="text-align: center;"><i class="fa fa-fw fa-plus-circle"></i>Nueva Inconformidad</h4>
      </div>
      <div class="modal-body">      
          
          <div class="row">
            <div class='col-md-6'>  
                  <b>Información:</b> por favor ingresar el numero de la orden / pedido  para realizar la consulta. 
              </div>
            <div class='col-md-4'>
              <input type="text" placeholder="Ingresar Valor" class="form-control" id="recipient-name">
              
            </div>
            <div class='col-md-2'>
              <button type="button" class="btn btn-primary" id="valida-orden">Buscar</button>
            </div>
          </div>
         <div class="row">
          <div id="content-validacions"></div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /========== ventanas modales en controles de requisitos ========== -->




<?php include '../../includes/laminacion/footer.php'; 
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../autenticacion/restrin.php';
  }
}else{

  include '../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>