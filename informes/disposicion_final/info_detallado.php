<?php

  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {

//Fin primera parte validacion de Pagina y Usuario
  $archivo = 'dispo_final';  

  include '../../includes/dbconfig.php';
  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');
  include '../../includes/informes/header.php';
?>
      <!-- =============================================== -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Informes
            <small>Inconformidades por Disposición Final</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Informes</a></li>
            <li class="active">Inconformidades por Disposición Final</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
           
           <div class="box-header with-border"> 
               
          <div class="col-md-10" align="center">
              <div class="col-md-3">             
                 <label>Fecha Inicial</label>
                  <input  type="date" class="txtInicial form-control" name="inicial">
              </div>
              <div class="col-md-3">
                <label>Fecha Final</label>
                <input type="date" class="txtFinal form-control" name="final">               
              </div>
              <div class="col-md-3"> 
              <label>Acción</label>     
                <button class="btn btn-block btn-default" id="gen">Generar</button>
              </div>       
          </div>
        </div><!-- /.box-header -->

         <?php 
            $query = "SELECT * FROM ext_inconformidades";
        ?>
            <div class="box-body">
            <?php
             $registros = sqlsrv_query($connSCPBD, $query);
            ?>

            <table id="c_requisitos" class="table table-bordered table-striped" >
    <thead>
        <tr>
            <th>Fecha de Ingreso</th>
            <th>Orden #</th>
            <th>Cliente</th>
            <th>Operario responsable</th>      
            <th>Tipo Inconformidad</th>
            <th>Referencia</th>
            <th>Disposición Final</th>
        </tr>
    </thead>
    <tbody>
      <?php
while($fila = sqlsrv_fetch_object($registros))
{
  echo "<tr>";
    echo "<td>".date_format($fila->fecha, 'm/d/Y g:i:s A')."</td>";
    echo "<td>".$fila->num_orden."</td>";
    echo "<td>".$fila->cliente."</td>";
    echo "<td>".$fila->operario_res."</td>";
    echo "<td><span class='label label-warning'>".$fila->tipo_inconf."</span></td>";
    echo "<td>".$fila->referencia."</td>";
    echo "<td>".$fila->dispo_final."</td>";
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



<?php include '../../includes/informes/footer.php'; 
//Incio segunda parte validacion de Pagina y Usuario

}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>