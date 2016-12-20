<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

  $archivo = 'dashboard';
   include '../includes/dbconfig.php';
  include '../model/extruder.php';

 include '../includes/funciones.php';
  $enlace = rutaRecursos('primer_nivel');

  include '../includes/extruder/header.php';
  
  //Registros pendientes Controles de Mezclas
  $registrosCM = sqlsrv_query($connSCPBD, $totalCM);
  $fila1 = sqlsrv_fetch_object($registrosCM);

  //Registros pendientes Controles de Requisitos
  $registrosCR = sqlsrv_query($connSCPBD, $totalCR);
  $fila2 = sqlsrv_fetch_object($registrosCR);

  //Registros pendientes Controles de Calidad
  $registrosCC = sqlsrv_query($connSCPBD, $totalCC);
  $fila3 = sqlsrv_fetch_object($registrosCC);

  //Registros Inconformidades realizadas
  $registrosInc = sqlsrv_query($connSCPBD, $totalInc);
  $fila4 = sqlsrv_fetch_object($registrosInc);
?>

      <!-- =============================================== -->


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Extruder
            <small>Dashboard</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Extruder</a></li>
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
            if(in_array('ex_cm', $_SESSION['menu'])){
            ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <?php                    
                    echo "<h3>".$fila1->Total."</h3>";
                  ?>                  
                  <p>Controles de Mezclas</p>
                </div>
                <div class="icon">                  
                  <i class="ion ion-funnel"></i>
                </div>
                <a href="control_mezclas/controles_mezclas.php" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php } ?>

            <!-- Menu Control Requisitos-->
            <?php 
            if(in_array('ex_cr', $_SESSION['menu'])){
            ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">                  
                  <?php                    
                    echo "<h3>".$fila2->Total."</h3>";
                  ?>                  
                  <p>Controles de Requisitos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-document-text"></i>
                </div>
                <a href="control_requisitos/controles_requisitos.php" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php } ?>
            
            <!-- Menu Controles Calidad-->
            <?php 
            if(in_array('ex_cc', $_SESSION['menu'])){
            ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <?php                    
                    echo "<h3>".$fila3->Total."</h3>";
                  ?>  
                  <p>Controles de Calidad</p>
                </div>
                <div class="icon">
                  <i class="ion ion-checkmark-circled"></i>
                </div>
                <a href="controles_calidad/controles_calidad.php" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php } ?>

            <?php 
            if(in_array('ex_cc', $_SESSION['menu'])){
            ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <?php                    
                    echo "<h3>".$fila4->Total."</h3>";
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