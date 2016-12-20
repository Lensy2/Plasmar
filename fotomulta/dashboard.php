<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {

  $archivo = 'dashboard';
  include '../includes/dbconfig.php';
  include '../model/fotomulta.php';
  include '../includes/funciones.php';
  $enlace = rutaRecursos('primer_nivel');
  include '../includes/fotomulta/header.php';
  
  //Registros pendientes Controles de Mezclas
  $registrosFotom = sqlsrv_query($connSCPBD, $totalFotom);
  $fila1 = sqlsrv_fetch_object($registrosFotom);

  //Registros Inconformidades realizadas
  //$registrosInc = sqlsrv_query($connSCPBD, $totalInc);
  //$fila2 = sqlsrv_fetch_object($registrosInc);
?>

      <!-- =============================================== -->


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Foto Multas
            <small>Dashboard</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Foto Multas</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="box">
          <div class="box-header">
                  <h3 class="box-title">Dashboard</h3>
          </div><!-- /.box-header -->
                <div class="box-body">
          <div class="row">

            
           
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <?php                    
                    echo "<h3>".$fila1->Total."</h3>";
                  ?> 
                  <p>Foto Multas</p>
                </div>
                <div class="icon">
                  <i class="ion ion-alert-circled"></i>
                </div>
                <a href="foto_multas.php" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->          
          </div>
</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- =============================================== -->

<?php include '../includes/fotomulta/footer.php'; 

}else{

  include '../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>