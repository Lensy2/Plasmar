<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('refilado', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
  $archivo = 'dashboard';
  include '../includes/dbconfig.php';
  include '../model/refilado.php';
  include '../includes/funciones.php';
  $enlace = rutaRecursos('primer_nivel');
  include '../includes/refilado/header.php';
  
  //Registros pendientes Controles de Mezclas
  $registrosCM = sqlsrv_query($connSCPBD, $totalCR);
  $fila1 = sqlsrv_fetch_object($registrosCM);

  //Registros Inconformidades realizadas
  $registrosInc = sqlsrv_query($connSCPBD, $totalInc);
  $fila2 = sqlsrv_fetch_object($registrosInc);
?>

      <!-- =============================================== -->


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Refilado
            <small>Dashboard</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Refilado</a></li>
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

          <?php 
            if(in_array('re_cr', $_SESSION['menu'])){
           ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">                  
                  <?php                    
                    echo "<h3>".$fila1->Total."</h3>";
                  ?>                  
                  <p>Controles de Requisitos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-document-text"></i>
                </div>
                <a href="control_requisito/requisitos.php" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php
              }
            ?>
            
           <?php 
            if(in_array('re_inc', $_SESSION['menu'])){
            ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <?php                    
                    echo "<h3>".$fila2->Total."</h3>";
                  ?> 
                  <p>Inconformidades</p>
                </div>
                <div class="icon">
                  <i class="ion ion-alert-circled"></i>
                </div>
                <a href="inconformidades/inconformidades.php" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php } ?> 
          </div><!-- /.row -->          
          </div>
</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- =============================================== -->

<?php include '../includes/refilado/footer.php'; 
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../autenticacion/restrin.php';
  }
}else{

  include '../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>