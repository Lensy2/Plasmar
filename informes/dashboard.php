<?php
  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
//Fin primera parte validacion de Pagina y Usuario

  $archivo = 'dashboard';
   include '../includes/dbconfig.php';
  include '../model/laminacion.php';

 include '../includes/funciones.php';
  $enlace = rutaRecursos('primer_nivel');

  include '../includes/informes/header.php';
  
?>

      <!-- =============================================== -->


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Informes
            <small>Dashboard</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Informes</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="box">
          <div class="box-header">
                  <h3 class="box-title">INFORMES - NO CONFORME Y EN TRANSITO</h3>
          </div><!-- /.box-header -->
                <div class="box-body bg-gray">
          <div class="row">

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="ion ion-clipboard"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Inconformidades</span>
                <span class="info-box-number"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/informes/disposicion_final">Disposición Final</a></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

           <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">

              <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Inconformidades</span>
                <span class="info-box-number"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/informes/procesos_subprocesos">Procesos y Sub Procesos</a></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

           <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="ion ion-briefcase"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Top 10</span>
                <span class="info-box-number"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/informes/cliente">Inconformidades x Cliente</a></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


           <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="ion ion-man"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Top 10</span>
                <span class="info-box-number"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/informes/operario">Inconformidades x Operario</a></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          </div><!-- /.row -->          
          </div>
      </div>
      <!-- INFORME DE INCUMPLIMIENTO AL S.G.I-->
      <div class="box">
          <div class="box-header">
                  <h3 class="box-title">INFORMES - INCUMPLIMENTO AL S.G.I</h3>
          </div><!-- /.box-header -->
                <div class="box-body bg-gray">
          <div class="row">

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="ion ion-android-walk"></i></span>

              <div class="info-box-content">
                <span class="info-box-number"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/informes/incumplimiento">INCUMPLIMENTO AL S.G.I</a></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          </div><!-- /.row -->          
          </div>
</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- =============================================== -->

<?php include '../includes/informes/footer.php'; 
//Incio segunda parte validacion de Pagina y Usuario

}else{

  include '../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>