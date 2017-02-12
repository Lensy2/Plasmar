<?php

//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

  $archivo = 'nuevo_control_cal';

  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel'); 
  
  include '../../includes/dbconfig.php';
  include '../../includes/extruder/header.php';
  include '../../model/extruder.php';
  require_once '../../class/Extrusion.php';
?>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Extruder
            <small>Controles De Calidad</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Extruder</a></li>
            <li class="active">Controles De Calidad</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
        <div class="box-header">
                  <h3 class="box-title">
                    Controles de Calidad - En Proceso
                  </h3>
            </div><!-- /.box-header -->
            <div class="box-body">
            <?php
              $registros = sqlsrv_query($connSCPBD, $controles_calidad_pend);
            ?>

            <table id="c_requisitos" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Fecha de Ingreso</th>
                        <th>Orden #</th>
                        <th>Tipo de Extrusion</th>
                        <th>Mezcla #</th>
                        <th>Rollo #</th>
                        <th>Usuario</th>
                        <th>Observación</th>              
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
                echo "<td>".$fila->num_rollo."</td>";
                echo "<td>".$fila->nombre." ".$fila->apellido. "</td>";
                /*Buscar descripcion de acuerdo al tipo de extrusion*/
                $ext = new Extrusion();
                $obs = $ext->getDescripciones($fila->num_orden, $fila->tipo_ext);
                echo "<td>".$obs."</td>";
                echo "<td><span class='label label-warning'>".$fila->estado."</span></td>";
                echo "<td><i class='fa fa-fw fa-edit'></i><a href='editar_control_calidad.php?id=$fila->Idcontrol_calidad&pedido=$fila->num_orden&tipo_ext=$fila->tipo_ext&num_rollo=$fila->num_rollo'>Editar</a></td>";
                 echo "<td><i class='fa fa-fw fa-eye'></i><a href='detalles.php?pedido=$fila->num_orden & tipo_ext=$fila->tipo_ext'>Detalles</a></td>";
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