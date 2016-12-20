<?php

//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

  $archivo = 'dashboard';

  include '../includes/dbconfig.php';
  include '../model/impresion.php';

 include '../includes/funciones.php';
  $enlace = rutaRecursos('primer_nivel');

  include '../includes/impresion/header.php';

  //Registros pendientes Premontaje
  $registrosPrem = sqlsrv_query($connSCPBD, $totalPrem);
  $fila1 = sqlsrv_fetch_object($registrosPrem);

  //Registros pendientes Controles de Requisitos - Impresion
  $registrosImpReq = sqlsrv_query($connSCPBD, $totalImpReq);
  $fila2 = sqlsrv_fetch_object($registrosImpReq);

  //Registros TERMINADOS Controles de Muestra - Impresor
  $registrosCMImp = sqlsrv_query($connSCPBD, $totalCmImp);
  $fila3 = sqlsrv_fetch_object($registrosCMImp);

  //Registros TERMIANDOS Controles de Muestra - Matizador
  $registrosCmMat = sqlsrv_query($connSCPBD, $totalCmMat);
  $fila4 = sqlsrv_fetch_object($registrosCmMat);

  //Registros pendientes Controles de Muestra - Analista 
  $registrosCmAna = sqlsrv_query($connSCPBD, $totalCmAna);
  $fila5 = sqlsrv_fetch_object($registrosCmAna);

  //Registros pendientes Controles de Muestra - Supervisor
  $registrosCmSup = sqlsrv_query($connSCPBD, $totalCmSup);
  $fila6 = sqlsrv_fetch_object($registrosCmSup);

  //Registros TERMINADORS Limpiezas
  $registrosLimp = sqlsrv_query($connSCPBD, $totalLimp);
  $fila7 = sqlsrv_fetch_object($registrosLimp);

  $registrosInc = sqlsrv_query($connSCPBD, $totalInc);
  $fila8 = sqlsrv_fetch_object($registrosInc);
?>

      <!-- =============================================== -->


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Impresión
            <small>Dashboard</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Impresión</a></li>
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
              if(in_array('im_pr', $_SESSION['menu'])){
            ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <?php                    
                  echo "<h3>".$fila1->Total."</h3>";
                  ?>                  
                  <p>Premontajes</p>
                </div>
                <div class="icon">                  
                  <i class="ion ion-funnel"></i>
                </div>
                <a href="premontajes/premontajes.php" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php } ?>

            <?php 
            if(in_array('im_cr', $_SESSION['menu'])){
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
                <a href="control_requisitos/controles_requisitos_imp.php" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php } ?> 

            <?php 
            if(in_array('im_cmi', $_SESSION['menu'])){
            ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <?php                    
                    echo "<h3>".$fila3->Total."</h3>";
                  ?>  
                  <p>C. Muestras - Impresor</p>
                </div>
                <div class="icon">
                  <i class="ion ion-image"></i>
                </div>
                <a href="muestra_impresor/controles_impresor.php" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php } ?> 

            <?php 
            if(in_array('im_cmm', $_SESSION['menu'])){
            ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <?php                    
                    echo "<h3>".$fila4->Total."</h3>";
                  ?>  
                  <p>C. Muestras - Matizador</p>
                </div>
                <div class="icon">
                  <i class="ion ion-image"></i>
                </div>
                <a href="muestra_matizador/controles_matizdor.php" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php } ?> 

            <?php 
            if(in_array('im_cma', $_SESSION['menu'])){
            ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <?php                    
                    echo "<h3>".$fila5->Total."</h3>";
                  ?>  
                  <p>C. Muestras - Analista Lab</p>
                </div>
                <div class="icon">
                  <i class="ion ion-image"></i>
                </div>
                <a href="muestra_analista/controles_analista.php" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php } ?>

            <?php 
            if(in_array('im_cms', $_SESSION['menu'])){
            ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <?php                    
                    echo "<h3>".$fila6->Total."</h3>";
                  ?>  
                  <p>C. Muestras - Supervisor</p>
                </div>
                <div class="icon">
                  <i class="ion ion-image"></i>
                </div>
                <a href="muestra_supervisor/controles_super.php" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
             <?php } ?>

             <?php 
            if(in_array('im_lp', $_SESSION['menu'])){
            ?>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-blue">
                <div class="inner">
                  <?php                    
                    echo "<h3>".$fila7->Total."</h3>";
                  ?>  
                  
                  <p>Limpiezas</p>
                </div>
                <div class="icon">
                  <i class="ion ion-waterdrop"></i>
                </div>
                <a href="limpiezas/limpiezas.php" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <?php } ?>

            <?php 
            if(in_array('im_inc', $_SESSION['menu'])){
            ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <?php                    
                    echo "<h3>".$fila8->Total."</h3>";
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

<?php include '../includes/impresion/footer.php'; 
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../autenticacion/restrin.php';
  }
}else{

  include '../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>