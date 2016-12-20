<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
 $archivo = 'nueva_inconf_ext';
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
            <small>Inconformidades</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Extruder</a></li>
            <li class="active">Inconformidades</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header">
                   <h3 class="box-title">
                    Inconformidades
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
            <th>Tipo de Extrusion</th> 
            <th>Mezcla #</th>      
            <th>Cliente</th>
            <th>Rollo #</th>            
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
    if ($fila->tipo_ext == 'ext_normal'){echo "<td>Normal</td>";}else{echo "<td>Laminación </td>";}
    echo "<td>".$fila->num_mezcla."</td>";
    echo "<td>".$fila->cliente."</td>";
    echo "<td>".$fila->num_rollo."</td>";
    if ($fila->tipo_inconf == 'NO CONFORME'){echo "<td><span class='label label-danger'>NO CONFORME</span></td>";}elseif($fila->tipo_inconf == 'EN TRANSITO'){echo "<td><span class='label label-warning'>EN TRANSITO</span></td>";}elseif ($fila->tipo_inconf == 'NO INOCUO') {echo "<td><span class='label label-danger'>NO INOCUO</span></td>";}
    echo "<td><a href='det_inconformidad.php?id=$fila->Idext_inconformidades'>Detalle</a><i class='fa fa-fw fa-eye'></i></td>";
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



<?php include '../../includes/extruder/footer.php'; 
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../autenticacion/restrin.php';
  }
}else{

  include '../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>